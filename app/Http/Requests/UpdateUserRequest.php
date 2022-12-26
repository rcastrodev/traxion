<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = User::find($this->user_valid);

        return [
            'name'      => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user)],
            'rol'       => ['required'],
            'password'  => ['nullable', 'string', 'confirmed'],
        ];
    }

    public function message()
    {
        return User::MESSAGES;
    }
}

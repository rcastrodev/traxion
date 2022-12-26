<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHomeGenericSectionRequest extends FormRequest
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
        $args = [
            'id' => 'required',
            'content_1' => 'required|string',
            'content_2' => 'required|string',
        ];

        // slider
        if($this->section_id == 1)
            $args['image']  = 'nullable|mimes:jpeg,jpg,png,svg|dimensions:min_width=1300,min_height=400';
        else
            $args['image']  = 'nullable|mimes:jpeg,jpg,png,svg';


        return $args;
        
    }

    public function messages()
    {
        return [
            'id.required'       => 'ID del elemento es requerido',
            'content_1.required'=> 'El título es requerido',
            'content_2.required'=> 'El contenido es requerido',
            'image.mimes'       => 'Solo se aceptan archivos con extension jpeg, jpg, png, svg',
            'image.dimensions'  => 'La imagen debe ser de al menos 1300x400',
            'order'             => 'Orden es requerido'
        ];
    }
}

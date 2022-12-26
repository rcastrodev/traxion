<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class loginAndRegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('clients');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'password'  => ['required', 'string', 'confirmed'],
            'email'     => 'required|email:rfc,dns|unique:clients'
        ], [
            'name.required'         => 'Nombre es requerido',
            'password.required'     => 'Contraseña es requerida',
            'password.confirmed'    => 'Las Contraseñas no son iguales',
            'email.required'        => 'Nombre es requerido',
            'email.email'           => 'Debe tener formato de email',
            'email.unique'          => 'El correo ya se encuentra registrado',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Client::create([
            'name'      => $data['name'],
            'password'  => Hash::make($data['password']),
            'email'     => $data['email']
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        session(['user_id' => Client::where('email', $request->input('email'))->first()->id]);
        
        return response()->json(['status' => 1], 200);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('clients')->attempt($credentials))
            session(['user_id' => Client::where('email', $request->input('email'))->first()->id]);
        else
            return response()->json(['message' => 'Datos no coinciden', 'status' => 0], 200);

        return response()->json(['status' => 1], 200);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        Auth::guard('clients')->logout();
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Data;
use App\Client;
use App\Newsletter;
use App\Mail\QuoteEmail;
use App\Mail\ContactMail;
use App\Mail\CorrugadoMail;
use Illuminate\Http\Request;
use App\Mail\CajaEstandartMail;
use App\Mail\CajasEspecialesMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    
    public function contact(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => 'required|captcha',
            'nombre'    => 'required',
            'email'     => 'required|email:rfc,dns',
            'telefono'  => 'required',
            'termino'   => 'required',
        ],[
            'g-recaptcha-response.required' => 'Debe validar que no es un robot',
            'g-recaptcha-response.captcha'  => 'Debe validar que no es un robot',
            'nombre.required'               => 'Nombre es requerido',
            'email.required'                => 'Correo es requerido',
            'email.email'                   => 'Correo debe tener un formato valido',
            'telefono.required'             => 'Teléfono es requerido',
            'termino.required'              => 'Debe aceptar los terminos',
        ]);

        $email = Data::first()->email;
        
        if(isset($email)){
            try {
                Mail::to($email)  
                    ->send(new ContactMail($request->all()));
                
                $mensaje = 'Correo enviado, nuestro equipo se pondra en contacto con usted';
                $class = 'success';
    
            } catch (\Throwable $th) {
                $mensaje = 'Error al enviar correo';
                $class = 'danger';
                Log::error($th->getMessage());
            }
        }else{
            $mensaje = 'Error al enviar correo';
            $class = 'danger';            
        }

        return back()
            ->with('mensaje', $mensaje)
            ->with('class', $class);
    }
}
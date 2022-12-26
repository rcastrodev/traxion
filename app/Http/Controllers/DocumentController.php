<?php

namespace App\Http\Controllers;

use App\Data;
use App\Client;
use App\Document;
use App\Mail\PurchaseMail;
use Illuminate\Http\Request;
use App\Mail\CustomerOrderMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DocumentController extends Controller
{

    public function purchase(Request $request)
    {
        $request->validate([ 
            'document_id'   => 'required', 
            'terms'         => 'required',
            'delivery'      => 'required',
            'client_id'     => 'required'
        ], [ 
            'document_id.required'  => 'El documento es requerido',
            'terms.required'        => 'Debe aceptar términos y condiciones',
            'delivery.required'     => 'Debe escoger el tipo de entrega',
            'cliente.required'      => 'Cliente es requerido'
        ]);

        $client = Client::findOrFail(intval($request->input('client_id')));
        $data = $request->all();

        if($request->hasFile('file'))
            $data['image'] = $request->file('file')->store('purchase', 'public');
                
        Mail::to([env('CORREO1'), env('CORREO2')])->send(new PurchaseMail($data, $client));
            
        if ($client->email)
            Mail::to($client->email)->send(new CustomerOrderMail($data));
 
        try {                
            $document = Document::findOrFail($request->input('document_id'));
            $document->update(['status' =>'v', 'delivery' => $data['delivery'], 'comment' => $data['comment']]);
            
            $mensaje = 'Correo enviado';
            $class = 'success';
                
        } catch (\Throwable $th) {

            $mensaje = 'Error al enviar correo';
            $class = 'danger';
            Log::error($th->getMessage());

        }  
        
        return back()
            ->with('mensaje', $mensaje)
            ->with('class', $class);
    }


    public function adminUpdate(Request $request)
    {
        $document = Document::findOrFail($request->input('id'));
        $document->update($request->all());
        return back()
            ->with('mensaje', 'Actualizado')
            ->with('class', 'success');
    }
}

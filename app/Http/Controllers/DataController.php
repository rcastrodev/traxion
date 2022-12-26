<?php

namespace App\Http\Controllers;

use App\Data;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    public function content(){
        $company_id = Company::first()->id;
        $data = Data::first();    
        return view('administrator.data.content', compact('company_id', 'data'));
    }

    public function update(Request $request)
    {
        $data = Data::find($request->input('id'));
        $dataNew = $request->all();

        if($request->hasFile('logo_header1')){
            if(Storage::disk('public')->exists($data->logo_header1)){
                Storage::disk('public')->delete($data->logo_header1);
            }
            $dataNew['logo_header1'] = $request->file('logo_header1')->store('images/data', 'public');
        }
        
        if($request->hasFile('logo_header2')){
            if(Storage::disk('public')->exists($data->logo_header2)){
                Storage::disk('public')->delete($data->logo_header2);
            }
            $dataNew['logo_header2'] = $request->file('logo_header2')->store('images/data', 'public');
        }

        if($request->hasFile('logo_footer')){
            if(Storage::disk('public')->exists($data->logo_footer)){
                Storage::disk('public')->delete($data->logo_footer);
            }
            $dataNew['logo_footer'] = $request->file('logo_footer')->store('images/data', 'public');
        }
        
        $data->update($dataNew);

        return back()->with('mensaje', 'Datos de empresa actualizados');

    }
}

<?php

namespace App\Http\Controllers;

use App\Newsletter;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NewsLetterController extends Controller
{

    public function content()
    {
        return view('administrator.newsletter.content');
    }

    public function getList()
    {
        return DataTables::of(Newsletter::query())
        ->addColumn('actions', function($email) {
            return '<button class="btn btn-sm btn-danger rounded-pill float-right" onclick="modalDestroy('.$email->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions'])
        ->make(true);
    }

    public function destroy($id)
    {
        Newsletter::find($id)->delete();
        return response()->json([], 200);
    }

    public function storeNewsletter(Request $request)
    {
        $request->validate(['email' => 'required|unique:newsletters|email:rfc,dns']);
        Newsletter::create($request->all());
    }
}

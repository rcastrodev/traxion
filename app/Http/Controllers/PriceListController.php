<?php

namespace App\Http\Controllers;

use App\Category;
use App\PriceList;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PriceListController extends Controller
{
    public function content()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('administrator.price-list.content', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        if($request->hasFile('archive'))
            $data['archive'] = $request->file('archive')->store('images/price-list','public');

        PriceList::create($data);
        
        return response()->json([], 201);
    }

    public function update(Request $request)
    {
        $element = PriceList::find($request->input('id'));
        $data = $request->all();
        
        if($request->hasFile('archive')){
            if(Storage::disk('public')->exists($element->archive))
                Storage::disk('public')->delete($element->archive);
            
            $data['archive'] = $request->file('archive')->store('images/price-list','public');
        }   

        $element->update($data);
    }

    public function find($id)
    {
        $content = PriceList::find($id);
        return response()->json(['content' => $content]);
    }

    public function destroy($id)
    {
        $element = PriceList::find($id);
        
        if(Storage::disk('public')->exists($element->archive))
            Storage::disk('public')->delete($element->archive);

        $element->delete();
        return response()->json([], 200);
    }

    public function descargarArchivo($id)
    {
        $content = PriceList::findOrFail($id);  
        if (Storage::disk('public')->exists($content->archive))
            return Response::download($content->archive);  
        else
            return back();  
    }

    public function getList()
    {
        return DataTables::of(PriceList::all())
        ->editColumn('category', function($element){
            return $element->category->name;
        })
        ->addColumn('actions', function($element) {
            $button = '<button type="button" class="btn btn-sm btn-primary rounded-pill far fa-edit" data-toggle="modal" data-target="#modal-update-element" onclick="findContent('.$element->id.')"></button><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroy('.$element->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';

            return $button;
        })
        ->rawColumns(['actions'])
        ->make(true);
    }
}

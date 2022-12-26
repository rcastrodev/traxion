<?php

namespace App\Http\Controllers;

use App\Page;
use App\Content;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CompanyInfoRequest;

class CompanyController extends Controller
{
    protected $page;

    public function __construct(){
        $this->page = Page::where('name', 'empresa')->first();
    }

    public function content()
    {
        $section1 = Content::where('section_id', 3)->first();
        return view('administrator.company.content', compact('section1'));
    }
    
    public function storeSlider(Request $request)
    {
        $data = $request->all();
        Content::create($data);
        return back()->with('mensaje', 'Creado con exito');
    }

    public function updateSlider(Request $request)
    {
        Content::find($request->input('id'))->update($request->all());
        return back()->with('mensaje', 'Actualizado con exito');
    }

    public function updateInfo(CompanyInfoRequest $request)
    {
        $element= Content::find($request->input('id'));
        $data   = $request->all();
        
        if($request->hasFile('content_2')){
            if(Storage::disk('public')->exists($element->content_2))
                Storage::disk('public')->delete($element->content_2);
            
            $data['content_2'] = $request->file('content_2')->store('images/company','public');
        } 

        if($request->hasFile('content_3')){
            if(Storage::disk('public')->exists($element->content_3))
                Storage::disk('public')->delete($element->content_3);
            
            $data['content_3'] = $request->file('content_3')->store('images/company','public');
        } 

        if($request->hasFile('content_4')){
            if(Storage::disk('public')->exists($element->content_4))
                Storage::disk('public')->delete($element->content_4);
            
            $data['content_4'] = $request->file('content_4')->store('images/company','public');
        } 

        $element->update($data);

        return back();
    }


    public function destroySlider($id)
    {
        $element = Content::find($id);
        if(Storage::disk('public')->exists($element->image))
            Storage::disk('public')->delete($element->image);
        
        $element->delete();
        return response()->json([], 200);
    }

    public function sliderGetList()
    {
        $sectionSlider = $this->page->sections()->where('name', 'section_2')->first();

        $sliders = $sectionSlider->contents()->orderBy('content_2', 'ASC');

        return DataTables::of($sliders)
        ->addColumn('actions', function($slider) {
            return '<button type="button" class="btn btn-sm btn-primary rounded-pill far fa-edit" data-toggle="modal" data-target="#modal-update-element" onclick="findContent('.$slider->id.')"></button><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroy('.$slider->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'content_1'])
        ->make(true);
    }
}

<?php

namespace App\Http\Controllers;

use App\Page;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function content()
    {
        return view('administrator.product.content');
    }

    public function create()
    {
        $categories = Category::orderBy('order', 'ASC')->get();
        return view('administrator.product.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        if($request->hasFile('data_sheet')) 
            $data['data_sheet'] = $request->file('data_sheet')->store('images/data-sheet', 'public');

        $product = Product::create($data);

        if($request->hasFile('images'))
            foreach($request->file('images') as $image)
                $product->images()->create(['image' => $image->store('images/products', 'public')]);
            
        return redirect()->route('product.content.edit', ['id' => $product->id])->with('mensaje', 'Producto creado');
    }

    public function edit($id)
    {   
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('order', 'ASC')->get();
        return view('administrator.product.edit', compact('product', 'categories'));
    }

    public function update(ProductRequest $request)
    {        
        $data = $request->all();
        $product = Product::find($request->input('id'));

        if($request->hasFile('data_sheet')){
            if (Storage::disk('public')->exists($product->data_sheet))
                    Storage::disk('public')->delete($product->data_sheet);
            
            $data['data_sheet'] = $request->file('data_sheet')->store('images/data-sheet', 'public');
        }

        $product->update($data);

        if($request->hasFile('images'))
            foreach($request->file('images') as $image)
                $product->images()->create(['image' => $image->store('images/products', 'public')]);
                        
        return back()->with('mensaje', 'Producto editado correctamente');
    }

    public function destroy($id)
    {
        $element = Product::find($id);
        if (Storage::disk('public')->exists($element->data_sheet))
            Storage::disk('public')->delete($element->data_sheet);

        $element->delete();
    }

    public function find($id)
    {
        $content = Product::find($id);
        return response()->json(['content' => $content]);
    }

    public function productosPorCategoria($id)
    {
        if ($id) {
            $category = Category::findOrFail($id);
            $products = $category->products;
        }else{
            $products = [];
        }
            
        return response()->json(['products' => $products], 200);
    }

    public function productos(Request $request)
    {
        if (! (int) $request->get('category_id') &&  ! (int) $request->get('product_id')) {
            $products = Product::orderBy('order', 'ASC')->get();
        }elseif((int) $request->get('category_id') &&  ! (int) $request->get('product_id')){
            $category = Category::findOrFail((int) $request->get('category_id'));
            $products = $category->products; 
        }elseif((int) $request->get('category_id') &&  (int) $request->get('product_id')){
            $products = Product::where('id', (int) $request->get('product_id'))->get(); 
        }else{
            $products = Product::orderBy('order', 'ASC')->get();    
        }
          
        return view('paginas.productos', compact('products')); 
    }

    public function getList()
    {
        $products = Product::orderBy('order', 'ASC');
        return DataTables::of($products)
        ->editColumn('description', function($product) {
            return $product->description;
        })
        ->addColumn('category', function($product) {
            return $product->category->name;
        })
        ->addColumn('actions', function($product) {
            return '<a href="'.route('product.content.edit', ["id" => $product->id]).'" class="btn btn-sm btn-primary rounded-pill far fa-edit"></a><button class="btn btn-sm btn-danger rounded-pill" onclick="modalProductDestroy('.$product->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'description'])
        ->make(true);
    }
}

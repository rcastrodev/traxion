<?php

namespace App\Http\Controllers;

use SEO;
use App\Car;
use App\Data;
use App\Page;
use App\Client;
use App\Content;
use App\Product;
use App\Service;
use App\Category;
use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PagesController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data = Data::first();
    }

    public function home()
    {
        $page = Page::where('name', 'home')->first();
        SEO::setTitle('home');
        SEO::setDescription(strip_tags($this->data->description)); 
        $sections   = $page->sections;
        $sliders    = Content::where('section_id', 1)->orderBy('order', 'ASC')->get();
        $section2   = Content::where('section_id', 2)->first();
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('paginas.index', compact('sliders', 'section2', 'categories'));
    }

    public function empresa()
    {
        SEO::setTitle('empresa');
        $section2 = Content::where('section_id', 3)->first();
        $histories = Content::where('section_id', 4)->orderBy('order', 'ASC')->get();
        SEO::setDescription(strip_tags($this->data->description)); 
        return view('paginas.empresa', compact('section2', 'histories'));
    }

    public function categorias()
    {
        $categories = Category::orderBy('order', 'ASC')->get();
        SEO::setTitle('categorías'); 
        SEO::setDescription(strip_tags($this->data->description)); 
        return view('paginas.categorias', compact('categories')); 
    }

    public function categoria($id)
    {
        $category   = Category::findOrFail($id);
        $products   = $category->products()->orderBy('order', 'ASC')->get();
        SEO::setDescription(strip_tags($this->data->description));
        SEO::setTitle($category->name);  
        return view('paginas.categoria', compact('category', 'products')); 
    }

    public function producto($id)
    {
        $product = Product::findOrFail($id);
        SEO::setTitle($product->name);
        SEO::setDescription(strip_tags($product->description));
        return view('paginas.producto', compact('product')); 
    }

    public function procesoProductivo()
    {
        $contents = Content::where('section_id', 5)->orderBy('order', 'ASC')->get();
        SEO::setTitle('proceso productivo');
        SEO::setDescription(strip_tags($this->data->description));
        return view('paginas.proceso-productivo', compact('contents')); 
    }

    public function listaDePrecios()
    {
        $client = Client(session('user_id'));
        $contents = [];

        if ($client) 
            $contents = $client->priceLists;
        
        SEO::setTitle('lista de precios');
        SEO::setDescription(strip_tags($this->data->description));
        return view('paginas.lista-de-precio', compact('contents'));
    }



    public function productos(Request $request)
    {
        $content = Content::where('section_id', 9)->where('content_1', 'Productos')->first();
        $products = Product::orderBy('name', 'ASC')->paginate(15);

        if($request->get('b')){
            $cars = Car::where('name', 'like', "%{$request->get('b')}%")->get();
            if (count($cars)) {
                $products = [];
                foreach ($cars as $car)
                {
                    $productsId = $car->products()->pluck('id')->toArray();
                    if ($productsId) {
                        $products = Product::whereIn('id', $productsId)->paginate(15);
                    }else{
                        $products = Product::where('name', 'like', "%{$request->get('b')}%")->paginate(15);
                    }
                }
            }else{
                $products = Product::where('name', 'like', "%{$request->get('b')}%")->paginate(15);
            }
        }

        $categories = Category::where('name', 'not like', 'Catálogo')->where('name', 'not like', '%list%')->orderBy('name', 'ASC')->get();
        SEO::setTitle('productos');  
        return view('paginas.productos', compact('categories', 'products', 'content')); 
    }


    public function contacto()
    {
        $content = Content::where('section_id', 9)->where('content_1', 'Contacto')->first();
        $page = Page::where('name', 'contacto')->first();
        SEO::setTitle("contacto");
        return view('paginas.contacto', compact('content'));
    }

    public function fichaTecnica($id)
    {
        $producto = Product::findOrFail($id);  
        return Response::download($producto->data_sheet);  
    }

    public function borrarFichaTecnica($id)
    {
        $product = Product::findOrFail($id); 
        
        if(Storage::disk('public')->exists($product->data_sheet))
            Storage::disk('public')->delete($product->data_sheet);

        $product->data_sheet = null;
        $product->save();

        return response()->json([], 200);
    }
}

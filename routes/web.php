<?php

use App\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/', 'PagesController@home')->name('index');
Route::get('/empresa', 'PagesController@empresa')->name('empresa');
Route::get('/categorias', 'PagesController@categorias')->name('categorias');
Route::get('/categoria/{id}', 'PagesController@categoria')->name('categoria');
Route::get('/producto/{id}', 'PagesController@producto')->name('producto');
Route::get('/proceso-productivo', 'PagesController@procesoProductivo')->name('proceso-productivo');
Route::get('/contacto', 'PagesController@contacto')->name('contacto');
Route::post('enviar-contacto', 'MailController@contact')->name('send-contact');
Route::get('/productos', 'ProductController@productos')->name('productos');

Route::post('newsletter', 'NewsLetterController@storeNewsletter')->name('newsletter.store');
Route::get('/ficha-tecnica/{id}', 'PagesController@fichaTecnica')->name('ficha-tecnica');
Route::get('/descargar-archivo/{id}', 'ContentController@descargarArchivo')->name('descargar-archivo');
Route::delete('/ficha-tecnica/{id}', 'PagesController@borrarFichaTecnica')->name('borrar-ficha-tecnica');
Route::post('cliente/authenticate', 'ClientController@authenticate')->name('client.authenticate');
Route::post('cliente/register-async', 'ClientController@registerAsync')->name('client.register-async');
Route::get('cliente/logout', 'ClientController@logout')->name('client.logout');
Route::get('/productos-por-categoria/{id?}', 'ProductController@productosPorCategoria')->name('productos-por-categoria');

Route::middleware(['client'])->group(function () {
    Route::get('/lista-de-precios', 'PagesController@listaDePrecios')->name('lista-de-precios');
    Route::get('/lista-de-precios/descargar/{id}', 'PriceListController@descargarArchivo')->name('lista-de-precios.descargar');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    /** Page Home */
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('home/content', 'HomeController@content')->name('home.content');
    Route::post('home/content/generic-section/store', 'HomeController@store')->name('home.content.store');
    Route::post('home/content/generic-section/update', 'HomeController@update')->name('home.content.update');
    Route::post('home/content/update', 'HomeController@updateSection')->name('home.content.update-section');
    Route::delete('home/content/{id}', 'HomeController@destroy')->name('home.content.destroy');
    Route::get('home/content/slider/get-list', 'HomeController@sliderGetList')->name('home.slider.get-list');
    /** Fin home*/

    /** Page Company */
    Route::get('company/content', 'CompanyController@content')->name('company.content');
    Route::post('company/content/store-slider', 'CompanyController@storeSlider')->name('company.content.storeSlider');
    Route::post('company/content/update-slider', 'CompanyController@updateSlider')->name('company.content.updateSlider');
    Route::post('company/qualities/store', 'CompanyController@createInfo')->name('company.info.store');
    Route::post('company/content/update-info', 'CompanyController@updateInfo')->name('company.content.updateInfo');
    Route::post('company/content/generic-section/update', 'CompanyController@updateHomeGenericSection')->name('company.content.generic-section.update');
    Route::delete('company/content/{id}', 'CompanyController@destroySlider')->name('company.content.destroy');
    Route::get('company/content/slider/get-list', 'CompanyController@sliderGetList')->name('company.slider.get-list');
    Route::get('company/content/service/get-list', 'CompanyController@serviceGetList')->name('company.service.get-list');
    /** Fin company*/

    /** Page Category */
    Route::get('category/content', 'CategoryController@content')->name('category.content');
    Route::post('category/content/store', 'CategoryController@store')->name('category.content.store');
    Route::post('category/content', 'CategoryController@update')->name('category.content.update');
    Route::get('category/content/find/{id?}', 'CategoryController@find')->name('category.content.find');
    Route::delete('category/content/{id}', 'CategoryController@destroy')->name('category.content.destroy');
    Route::get('category/content/get-list', 'CategoryController@getList');
    /** Fin category*/

    /** Page Product */
    Route::get('product/content', 'ProductController@content')->name('product.content');
    Route::get('product/content/create', 'ProductController@create')->name('product.content.create');
    Route::post('product/content/store', 'ProductController@store')->name('product.content.store');
    Route::get('product/content/{id}/edit', 'ProductController@edit')->name('product.content.edit');
    Route::put('product/content', 'ProductController@update')->name('product.content.update');
    Route::delete('product/content/{id}', 'ProductController@destroy')->name('product.content.destroy');
    Route::get('product/content/get-list', 'ProductController@getList')->name('product.content.get-list');
    Route::get('product/content/find-product/{id?}', 'ProductController@find')->name('product.content.find');
    /** Fin product*/

    /** Page Product Picture */
    Route::delete('product-picture/content/destroy/{id}', 'ProductPictureController@destroy')->name('product-picture.content.destroy');
    /** Fin product picture*/

    /** productive-process */
    Route::get('productive-process/content', 'ProductiveProcessController@content')->name('productive-process.content');
    Route::post('productive-process/content/store', 'ProductiveProcessController@store')->name('productive-process.content.store');
    Route::post('productive-process/content', 'ProductiveProcessController@update')->name('productive-process.content.update');
    Route::get('productive-process/content/find/{id?}', 'ProductiveProcessController@find')->name('productive-process.content.find');
    Route::delete('productive-process/content/{id}', 'ProductiveProcessController@destroy')->name('productive-process.content.destroy');
    Route::get('productive-process/content/get-list', 'ProductiveProcessController@getList');
    /** Fin category*/

    /** price list */
    Route::get('price-list/content', 'PriceListController@content')->name('price-list.content');
    Route::post('price-list/content/store', 'PriceListController@store')->name('price-list.content.store');
    Route::post('price-list/content', 'PriceListController@update')->name('price-list.content.update');
    Route::get('price-list/content/find/{id?}', 'PriceListController@find')->name('price-list.content.find');
    Route::delete('price-list/content/{id}', 'PriceListController@destroy')->name('price-list.content.destroy');
    Route::get('price-list/content/get-list', 'PriceListController@getList');
    /** Fin category*/

    Route::get('client/content', 'ClientController@content')->name('client.content');
    Route::post('client/register', 'ClientController@register')->name('client.content.store');
    Route::post('client/update', 'ClientController@update')->name('client.content.update');
    Route::get('client/find/{id?}', 'ClientController@find')->name('client.content.find');
    Route::get('client/content/customer-list-prices/{id?}', 'ClientController@customerListPrices')->name('client.customer-list-prices');
    
    Route::post('client/content/{id}', 'ClientController@destroy')->name('client.content.destroy');
    Route::get('client/content/get-list', 'ClientController@getList');

    /** Page newsletter */
    Route::get('newsletter/content', 'NewsLetterController@content')->name('newsletter.content');
    Route::get('newsletter/content/get-list', 'NewsLetterController@getList')->name('newsletter.content.get-list');
    Route::delete('newsletter/content/{id}', 'NewsLetterController@destroy')->name('newsletter.content.destroy');
    /** Fin newsletter*/

    /** Page company */
    Route::get('data/content', 'DataController@content')->name('data.content');
    Route::put('data/content', 'DataController@update')->name('data.content.update');
    /** Fin company*/

    Route::get('page/content', 'AdminPageController@content')->name('page.content');
    Route::put('page/content', 'AdminPageController@update')->name('page.content.update');

    Route::get('content/', 'ContentController@content')->name('content');
    Route::get('content/{id}', 'ContentController@findContent');
    Route::post('content/hero-update', 'ContentController@heroUpdate')->name('content.hero-update');
    Route::delete('content/image/{id}/{reg}', 'ContentController@destroyImage')->name('content.destroy-image');

    Route::get('user/get-list', 'UserController@getList')->name('user.get-list');
    Route::resource('user', 'UserController');
});

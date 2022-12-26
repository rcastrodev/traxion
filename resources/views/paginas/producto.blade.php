@extends('paginas.partials.app')
@section('content')
<div class="contenedor-breadcrumb bg-celeste">
    <div class="container">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb py-2 font-size-13 m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}" class="color-azul-oscuro text-decoration-none text-dark">inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('categorias') }}" class="color-azul-oscuro text-decoration-none text-dark">Productos</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('categoria', ['id' => $product->category->id]) }}" class="color-azul-oscuro text-decoration-none text-dark">{{ $product->category->name }}</a>
                </li>
                <li class="breadcrumb-item active text-dark" aria-current="page">{{ $product->name }}</li>
            </ol>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <section class="producto col-sm-12 font-size-14">
                <div class="row mb-5">
                    <div class="col-sm-12 col-md-6">
                        <div id="carruselProducto" class="carousel slide carousel-fade border border-light border-2 mb-3" data-bs-ride="carousel" style="">
                            @if (count($product->images))
                                <div class="carousel-indicators d-sm-none d-md-block">
                                    @foreach ($product->images as $pk => $slide)
                                        <button type="button" data-bs-target="#carruselProducto" data-bs-slide-to="{{$pk}}" class="@if (!$pk) active @endif" aria-current="true" aria-label="Slide {{$pk}}"></button>			
                                    @endforeach
                                </div>     
                            @endif
                            <div class="carousel-inner">
                                @if (count($product->images))
                                    @foreach ($product->images as $pk => $pv)
                                        <div class="carousel-item @if(!$pk) active @endif" style="border:1px solid #D8D8D8;">
                                            <img src="{{ asset($pv->image) }}" class="d-block w-100 img-fluid" style="object-fit: contain;
                                            min-width: 100%; max-width: 100%;">
                                        </div>    
                                    @endforeach
                                @else
                                    <div class="carousel-item active" style="border:1px solid #D8D8D8;">
                                        <img src="{{ asset('images/default.jpg') }}" class="d-block w-100 img-fluid" style="object-fit: contain; min-width: 100%; max-width: 100%;" alt="">
                                    </div>   
                                @endif
                            </div>
                        </div> 
                    </div>
                    <div class="col-sm-12 col-md-6 d-flex flex-column justify-content-between">
                        <div class="">
                            <strong class="text-red">COD {{ $product->code }}</strong>
                            <h1 class="mb-3 font-size-26 text-dark mb-3">{{ $product->name }}</h1>
                            @if ($product->description)
                                <div class="font-size-15 mb-md-3 mb-sm-2 mb-md-5">{!! $product->description  !!}</div>
                            @endif
                            <div class="">
                                <h6 class="mb-3 font-size-16">Características técnicas</h6>
                                <div class="table-responsive font-size-15">
                                    <table class="table align-middle table-striped">
                                        @if($product->number_of_teeth)
                                            <tr>
                                                <td><strong>Cantidad de dientes</strong></td>
                                                <td class="text-end pe-3">{{$product->number_of_teeth}}</td>
                                            </tr>                                           
                                        @endif
                                        @if($product->external_diameter)
                                            <tr>
                                                <td><strong>Diámetro exterior [mm]</strong></td>
                                                <td class="text-end pe-3">{{$product->external_diameter}}</td>
                                            </tr>   
                                        @endif
                                        @if($product->inside_diameter)
                                            <tr>
                                                <td><strong>Diámetro interior [mm]</strong></td>
                                                <td class="text-end pe-3">{{$product->inside_diameter}}</td>
                                            </tr>
                                        @endif
                                        @if($product->thickness)
                                            <tr>
                                                <td><strong>Espesor</strong></td>
                                                <td class="text-end pe-3">{{$product->thickness}}</td>
                                            </tr>                    
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-sm-center justify-content-md-start flex-wrap  @if (Auth::guard('clients')->check()) mb-4 @endif">
                            @if(Storage::disk('public')->exists($product->data_sheet))
                                <a href="{{ route('ficha-tecnica', ['id'=>$product->id]) }}" class="text-red w-100 py-2 text-uppercase text-decoration-none text-center d-inline-block mb-2" style="border: 2px solid #CC160E;">descargar ficha</a>       
                            @endif
                            <a href="{{ route('contacto') }}" class="bg-red text-white w-100 py-2 text-uppercase text-decoration-none text-center d-inline-block">consultar</a> 
                        </div>
                    </div>
                </div>          
            </section>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@endpush
@push('head')
<style>
    .table-striped > tbody > tr:nth-of-type(odd){
        --bs-table-accent-bg: #F7F9FC !important;
    }
    .table > :not(caption) > * > *{
        border-bottom-width: 0px !important;
    }
</style>
@endpush

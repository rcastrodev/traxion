@extends('paginas.partials.app')
@section('content')
<div class="contenedor-breadcrumb bg-celeste">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-2 font-size-13 m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}" class="color-azul-oscuro text-decoration-none text-dark">inicio</a>
                </li>
                
                <li class="breadcrumb-item">
                    <a href="{{ route('categorias') }}" class="color-azul-oscuro text-decoration-none text-dark">Productos</a>
                </li>
                <li class="breadcrumb-item active text-dark" aria-current="page">{{ $category->name }}</li>
            </ol>
        </nav>
    </div>
</div>
<div class="jumbotron bg-celeste py-5">
	<div class="container mx-auto"><h1 class="text-blue font-size-30">{{ $category->name }}</h1></div>
</div>
@includeIf('paginas.partials.filtro')
@isset($products)
    @if (count($products))
        <div class="container row mx-auto py-5">
            @foreach ($products as $product)
                <div class="col-sm-12 col-md-3 mb-2">
                    @includeIf('paginas.partials.producto', ['product' => $product])
                </div>
            @endforeach
        </div>       
    @endif
@endisset
@endsection

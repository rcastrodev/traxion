@extends('paginas.partials.app')
@section('content')
<div class="contenedor-breadcrumb bg-celeste">
    <div class="container">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb py-2 font-size-13 m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}" class="color-azul-oscuro text-decoration-none text-dark">inicio</a>
                </li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Productos</li>
            </ol>
        </div>
    </div>
</div>
<div class="jumbotron bg-celeste py-5">
	<div class="container mx-auto"><h1 class="text-blue font-size-30">Productos</h1></div>
</div>
@isset($categories)
    @if (count($categories))
        <div class="container row mx-auto py-5">
            @foreach ($categories as $c)
                <div class="col-sm-12 col-md-3 mb-2">
                    @includeIf('paginas.partials.categoria', ['category' => $c])
                </div>
            @endforeach
        </div>       
    @endif
@endisset
@endsection

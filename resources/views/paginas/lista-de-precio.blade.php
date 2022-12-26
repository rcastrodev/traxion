@extends('paginas.partials.app')
@section('content')
<div class="contenedor-breadcrumb bg-celeste">
    <div class="container">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb py-2 font-size-13 m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}" class="color-azul-oscuro text-decoration-none text-dark">inicio</a>
                </li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Lista de precios</li>
            </ol>
        </div>
    </div>
</div>
<div class="jumbotron bg-celeste py-5">
	<div class="container mx-auto"><h1 class="text-blue font-size-30">Lista de precios</h1></div>
</div>
<div class="container mx-auto my-5">
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
            </tr>
            <tr>
                <th width="600">Nombre</th>
                <th>Formato</th>
                <th></th>
            </tr>
            @foreach ($contents as $content)
                <tr>
                    <td>{{ $content->name }}</td>
                    <td>{{ $content->type }}</td>
                    <td class="text-end pe-3">
                        <a href="{{ route('lista-de-precios.descargar', ['id'=> $content->id]) }}" class="text-red text-decoration-none underline text-uppercase fw-bold">Descargar <i class="fal fa-arrow-to-bottom ms-2"></i></a>
                    </td>
                </tr>   
            @endforeach
        </table>
    </div>
</div>
@endsection
@push('scripts')
@endpush
@push('head')
<style>
</style>
@endpush

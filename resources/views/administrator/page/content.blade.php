@extends('adminlte::page')
@section('title', 'Palabras claves')
@section('content_header')
    <div class="d-flex">
        <h1 class="mr-3">Palabras claves</h1>
    </div>
@stop
@section('content')
    @includeIf('administrator.partials.mensaje-exitoso')
    <form action="{{ route('page.content.update') }}" method="post" class="row">
        @csrf
        @method('put')

        @foreach ($pages as $page)
            <div class="col-sm-12 col-md-3">Página {{Str::replaceArray('-', [' ', ' '], $page->name)}}</div>
            <div class="col-sm-12 col-md-9">
                <div class="form-group">
                    <input type="hidden" name="pages[{{$page->id}}][id]" value="{{$page->id}}">
                    <input type="text" name="pages[{{$page->id}}][keywords]" value="{{$page->keywords}}" class="form-control" placeholder="Palabras claves">
                </div>
            </div>
        @endforeach
        <div class="col-sm-12">
            <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
        </div>
    </form>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/axios.js') }}"></script>
@stop


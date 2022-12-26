@extends('adminlte::page')
@section('title', 'Contenido home')
@section('content_header')
    <div class="d-flex">
        <h1 class="mr-3">Contenido del home</h1>
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-create-element">crear Slider</button>
    </div>
@stop
@section('content')
@if ($errors->any())
    @include('administrator.partials.mensaje-error')
@endif
@includeIf('administrator.partials.mensaje-exitoso')
<div class="row mb-5">
    <div class="col-sm-12">
        <table id="page_table_slider" class="table">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Contenido</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>  
@isset($section2)
    <form action="{{ route('home.content.update-section') }}" method="post" data-sync="no" enctype="multipart/form-data" class="mb-5">
        @csrf
        <input type="hidden" name="id" value="{{$section2->id}}">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="form-group">
                    @if (Storage::disk('public')->exists($section2->image))
                        <img src="{{Storage::disk('public')->url($section2->image)}}" class="img-fluid d-block mb-3">
                    @endif
                    <small>la imagen debe ser al menos 671x463</small>
                    <input type="file" name="image" class="form-control-input">
                    
                </div>
            </div>
            <div class="col-sm-12 col-md-8">
                <div class="form-group">
                    <input type="text" name="content_1" value="{{$section2->content_1}}" placeholder="Título" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="content_2" class="ckeditor">{{$section2->content_2}}</textarea>
                </div>
            </div>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">Actualiar</button>
        </div>
    </form>
@endisset
@includeIf('administrator.home.modals.create')
@includeIf('administrator.home.modals.update')
@stop
@section('css')
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="url" content="{{route('home.content')}}">
    <meta name="content_find" content="{{route('content')}}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('js/admin/index.js') }}"></script>
    <script src="{{ asset('js/admin/home/index.js') }}"></script>
    <script>
        function imgDelete(e)
        {
            e.preventDefault()
            element = e.target
            if(element.classList.contains('image')){
                axios.delete(element.dataset.url)
                    .then(r => {
                        element.closest('div').remove()
                    })
                    .catch(e => console.error(new Error(e)))
            }
        }

        let sections = document.querySelectorAll('.image-delete')
        sections.forEach(element => {
            element.addEventListener('click', imgDelete)
        })
    </script>
@stop


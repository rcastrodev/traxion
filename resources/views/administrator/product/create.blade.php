@extends('adminlte::page')
@section('title', 'Crear producto')
@section('content_header')
    <div class="d-flex">
        <h1 class="mr-3">Crear producto</h1>
        <a href="{{ route('product.content') }}" class="btn btn-sm btn-primary">ver productos</a>
    </div>
@stop
@section('content')
<div class="row">
    @includeIf('administrator.partials.mensaje-exitoso')
    @includeIf('administrator.partials.mensaje-error')
</div>
<div class="card card-primary">
    <div class="card-header"></div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('product.content.store') }}" method="post" enctype="multipart/form-data">
        <div class="card-body row">
            @csrf
            <div class="form-group col-sm-12 col-md-2">
                <label for="">Cod</label>
                <input type="text" name="code" value="{{old('code')}}" class="form-control" placeholder="Código">
            </div>
            <div class="form-group col-sm-12 col-md-4">
                <label for="">Nombre del producto</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Nombre del producto">
            </div>
            <div class="form-group col-sm-12 col-md-4">
                <label for="">Categorías</label>
                <select name="category_id" class="form-control">
                    <option selected disabled>Escoger</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-sm-12 col-md-2">
                <label for="">Orden</label>
                <input type="text" name="order" value="{{old('order')}}" class="form-control" placeholder="Ej AA BB CC">
            </div>
            <div class="form-group col-sm-12">
                <label>Ficha técnica</label>
                <input type="file" name="data_sheet" class="form-control-file">
            </div>  
            <div class="form-group col-sm-12">
                <label for="">Descripción</label>
                <textarea name="description" class="form-control ckeditor" cols="30" rows="2">{{old('description')}}</textarea>
            </div>   
            <div class="col-sm-12 my-4">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Cantidad de dientes</label>
                            <input type="text" name="number_of_teeth" value="{{old('number_of_teeth')}}" class="form-control" placeholder="Cantidad de dientes">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Diámetro exterior</label>
                            <input type="text" name="external_diameter" value="{{old('external_diameter')}}" class="form-control" placeholder="Diámetro exterior">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Diámetro interior</label>
                            <input type="text" name="inside_diameter" value="{{old('inside_diameter')}}" class="form-control" placeholder="Diámetro interior">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label>Espesor</label>
                            <input type="text" name="thickness" value="{{old('thickness')}}" class="form-control" placeholder="Espesor">
                        </div>
                    </div>
                </div>
            </div>  
            <div class="form-group col-sm-12 mt-3">
                <h4>Imágenes de producto</h4>
                <small>la imagen debe ser al menos 225x170px</small>
            </div>  
            @for ($i = 1; $i <= 3; $i++)
                <div class="form-group col-sm-12 col-md-4">
                    <label for="image{{$i}}">imagen {{$i}}</label>
                    <input type="file" name="images[]" class="form-control-file" id="image{{$i}}">
                </div>           
            @endfor
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script>
        $('document').ready(function(){
            $('.select2').select2()
        })
    </script>
@stop

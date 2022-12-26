@extends('adminlte::page')
@section('title', 'Editar producto')
@section('content_header')
    <div class="d-flex">
        <h1 class="mr-3">Editar producto</h1>
        <a href="{{ route('product.content') }}" class="btn btn-sm btn-primary">ver productos</a>
    </div>
@stop
@section('content')
<div class="row">
    @includeIf('administrator.partials.mensaje-exitoso')
    @includeIf('administrator.partials.mensaje-error')
</div>
<form action="{{ route('product.content.update') }}" method="post" enctype="multipart/form-data" class="card card-primary">
    @method('put')
    @csrf
    <input type="hidden" name="id" value="{{ $product->id }}">
    <div class="card-header">Producto</div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="card-body row">
        <div class="form-group col-sm-12 col-md-2">
            <label for="">Cod</label>
            <input type="text" name="code" value="{{$product->code}}" class="form-control" placeholder="Código">
        </div>
        <div class="form-group col-sm-12 col-md-4">
            <label for="">Nombre del producto</label>
            <input type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="Nombre del producto">
        </div>
        <div class="form-group col-sm-12 col-md-4">
            <label for="">Categorías</label>
            <select name="category_id" class="form-control">
                <option selected disabled>Escoger</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-sm-12 col-md-2">
            <label for="">Orden</label>
            <input type="text" name="order" value="{{$product->order}}" class="form-control" placeholder="Ej AA BB CC">
        </div>
        @if ($product->data_sheet)
            <div class="form-group col-sm-12">
                <a href="{{ route('ficha-tecnica', ['id'=> $product->id]) }}" class="btn btn-sm btn-primary rounded-pill" target="_blank">Ficha técnica</a>
                <button class="btn btn-sm rounded-circle btn-danger" id="borrarFicha" data-url="{{ route('borrar-ficha-tecnica', ['id'=> $product->id]) }}">
                    <i class="far fa-trash-alt"></i>
                </button>
            </div>          
        @endif
        <div class="form-group col-sm-12">
            <label>Ficha técnica</label>
            <input type="file" name="data_sheet" class="form-control-file">
        </div>  
        <div class="form-group col-sm-12">
            <label for="">Descripción</label>
            <textarea name="description" class="form-control ckeditor" cols="30" rows="2">{{$product->description}}</textarea>
        </div>
        <div class="col-sm-12 my-4">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Cantidad de dientes</label>
                        <input type="text" name="number_of_teeth" value="{{$product->number_of_teeth}}" class="form-control" placeholder="Cantidad de dientes">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Diámetro exterior</label>
                        <input type="text" name="external_diameter" value="{{$product->external_diameter}}" class="form-control" placeholder="Diámetro exterior">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Diámetro interior</label>
                        <input type="text" name="inside_diameter" value="{{$product->inside_diameter}}" class="form-control" placeholder="Diámetro interior">
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <label>Espesor</label>
                        <input type="text" name="thickness" value="{{$product->thickness}}" class="form-control" placeholder="Espesor">
                    </div>
                </div>
            </div>
        </div>  
        <div class="form-group col-sm-12 mt-3">
            <h4>Imágenes de producto</h4>
            <small>la imagen debe ser al menos 225x170px</small>
        </div>   
        @foreach ($product->images as $pi)
            <div class="form-group col-sm-12 col-md-4 ">
                <div class="position-relative">
                    <button class="position-absolute btn btn-sm btn-danger rounded-pill far fa-trash-alt destroyImgProduct" data-url="{{ route('product-picture.content.destroy', ['id'=> $pi->id]) }}"></button>
                    <img src="{{ asset($pi->image) }}" style="max-width: 350px; min-width:350px; max-height:200px; min-height:200px; object-fit: contain;">
                </div>
                <label>imagen</label>
                <input type="file" name="images[]" class="form-control-file">
            </div>                    
        @endforeach
        @for ($i = count($product->images); $i < 3; $i++)
            <div class="form-group col-sm-12 col-md-4">
                <label for="image">imagen</label>
                <input type="file" name="images[]" class="form-control-file" id="">
            </div>           
        @endfor
    </div>
      <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>
@stop
@section('css')
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="url" content="{{route('product.content')}}">
    <meta name="content_find" content="{{route('content')}}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script>
        $('document').ready(function(){
            $('.select2').select2()
        })
        
        // borrar ficha técnica 
        let borrarFicha = document.getElementById('borrarFicha')
        if (borrarFicha) {
            borrarFicha.addEventListener('click', function(e){
                e.preventDefault()
                axios.delete(this.dataset.url)
                .then(r => {
                    this.closest('div').remove()
                })
                .catch(e => console.error( new Error(e) ))      
            })  
        }

        let buttonsDestroyImgProduct = document.querySelectorAll('.destroyImgProduct')
        function modalDestroy(e)
        {
            e.preventDefault()

            Swal.fire({
                title: 'Deseas eliminar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    elementDestroy(this)
                }
            })
        }

        function elementDestroy(elemet)
        {
            axios.delete(elemet.dataset.url).then(r => {
                Swal.fire(
                    'Eliminado!',
                    '',
                    'success'
                )
            
                elemet.parentElement.remove()
            }).catch(error => console.error(error))

        }

        buttonsDestroyImgProduct.forEach(buttonDestroyImgProduct => {
            buttonDestroyImgProduct.addEventListener('click', modalDestroy)
        });
    </script>
@stop


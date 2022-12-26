@extends('adminlte::page')
@section('title', 'Contenido empresa')
@section('content')
<div class="row">
    @includeIf('administrator.partials.mensaje-error')
    @includeIf('administrator.partials.mensaje-exitoso')
</div>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Datos de la empresa</h3>
    </div>
    <form action="{{ route('data.content.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card-body">
            <input type="hidden" name="id" value="{{$company_id}}">
            <div class="form-group">
                <input type="text" name="address" value="{{$data->address}}" class="form-control" placeholder="Dirección de la empresa">
            </div>
            <div class="form-group">
                <input type="text" name="email" value="{{$data->email}}" class="form-control" placeholder="Email de la empresa">
            </div>
            <div class="form-group">
                <input type="text" name="email2" value="{{$data->email2}}" class="form-control" placeholder="Email de administración y ventas">
            </div>
            <div class="form-group">
                <input type="text" name="email3" value="{{$data->email3}}" class="form-control" placeholder="Email de oficina técnica">
            </div>
            <div class="form-group">
                <input type="text" name="phone1" value="{{$data->phone1}}" class="form-control" placeholder="Teléfono (1) de la empresa">
            </div>
            <div class="form-group">
                <input type="text" name="phone2" value="{{$data->phone2}}" class="form-control" placeholder="Teléfono (2) de la empresa">
            </div>
            <div class="form-group">
                <input type="text" name="phone3" value="{{$data->phone3}}" class="form-control" placeholder="Número de whatsapp">
            </div>
            <div class="form-group">
                <input type="text" name="facebook" value="{{$data->facebook}}" class="form-control" placeholder="Link del canal de facebook">
            </div>
            <div class="form-group">
                <input type="text" name="instagram" value="{{$data->instagram}}" class="form-control" placeholder="Link del canal de instagram">
            </div>
            <div class="form-group">
                <label for="">Descripción del sitio web <small>Importante para buscadores</small></label>
                <textarea name="description" class="ckeditor form-control">{{$data->description}}</textarea>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    @if (Storage::disk('public')->exists($data->logo_header))
                        <div class="mb-3">
                            <img src="{{ asset($data->logo_header) }}" class="img-fluid" style="max-width: 100px; min-width: 100px;
                            max-height: 70px; min-height: 70px; object-fit: contain;">
                        </div>                    
                    @endif
                    <div class="form-group">
                        <label for="logoheader">Logo header</label>
                        <small>Se recomienda 276x80px</small>
                        <input type="file" name="logo_header" class="form-control-file" id="logoheader">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary ">Actualizar</button>
        </div>
    </form>
</div>      

@stop
@section('css')
    <meta name="_token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
    <style>
        .cke_top{
            display: none;
        }
    </style>
@stop
@section('js')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
@stop


@extends('adminlte::page')
@section('title', 'Clientes')
@section('content_header')
    <div class="d-flex">
        <h1 class="mr-3">Clientes</h1>
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-create-element">crear</button>
    </div>
@stop
@section('content')
<div class="row mb-5">
    <div class="col-sm-12">
        <table id="page_table_slider" class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@includeIf('administrator.client.modals.create')
@includeIf('administrator.client.modals.update')
@stop
@section('css')
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="url" content="{{route('client.content')}}">
    <meta name="content_find" content="{{route('client.content.find')}}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
    <style>
        .select2-container--default{
            width: 100% !important;
        }
    </style>
@stop

@section('js')
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('js/admin/index.js') }}"></script>
    <script src="{{ asset('js/admin/client/index.js') }}"></script>
    <script>
        $('.select2').select2()
        $('#priceLists').select2()
    </script>

@stop

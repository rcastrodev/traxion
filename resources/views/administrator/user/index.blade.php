@extends('adminlte::page')

@section('title', 'Admin - usuarios')

@section('content_header')
<div class="d-flex">
    <h1 class="mr-3">Usuarios</h1>
    <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">crear usuarios</a>
</div>

@stop

@section('content')
    <table id="table_users" class="table table-hover">
        <thead>
            <th>Usuario</th>
            <th>Acciones</th>
        </thead>
    </table>
@stop

@section('css')
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="url-user" content="{{route('user.index')}}">
@stop

@section('js')
    <script src="{{ asset('js/user/index.js') }}"></script>
@stop   
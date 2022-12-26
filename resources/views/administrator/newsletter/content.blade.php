@extends('adminlte::page')
@section('title', 'Newsletter')
@section('content_header')
    <div class="d-flex">
        <h1 class="mr-3">Newsletter</h1>
    </div>
@stop
@section('content')
<div class="mb-5">
    <table id="page_table" class="table">
        <thead>
            <tr>
                <th>Correo</th>
                <th class="text-right">Acciones</th>
            </tr>
        </thead>
    </table>
</div>
@stop
@section('css')
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="url" content="{{route('newsletter.content')}}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('js/admin/index.js') }}"></script>
    <script src="{{ asset('js/admin/newsletter/index.js') }}"></script>
@stop


@extends('paginas.partials.app')
@section('content')
<div class="contenedor-breadcrumb bg-celeste">
    <div class="container">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb py-2 font-size-13 m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}" class="color-azul-oscuro text-decoration-none text-dark">inicio</a>
                </li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Proceso productivo</li>
            </ol>
        </div>
    </div>
</div>
<div class="jumbotron bg-celeste py-5">
	<div class="container mx-auto"><h1 class="text-blue font-size-30">Proceso productivo</h1></div>
</div>
<div class="row">
    @foreach ($contents as $k => $content)
        @php ++$k @endphp
        @if ($k % 2)
            <div class="col-sm-12 col-md-6 p-0 d-sm-none d-md-block">
                @if (Storage::disk('public')->exists($content->image))
                    <img src="{{ asset($content->image) }}" class="img-fluid w-100">
                @else
                    <img src="{{ asset('images/default.jpg') }}" class="img-fluid w-100">	
                @endif
            </div>
            <div class="col-sm-12 col-md-6 d-flex align-items-center p-0">
                <div class="ps-sm-2 ps-md-5" style="max-width: 90%;">
                    <h2 class="text-blue font-size-28 mb-3">{{ $content->content_1 }}</h2>
                    <div class="font-size-17 fw-light">{!! $content->content_2 !!}</div>
                </div>
            </div>
        @else
            <div class="col-sm-12 col-md-6 d-flex align-items-center p-0">
                <div class="ps-sm-2 ps-md-5" style="max-width: 90%;">
                    <h2 class="text-blue font-size-28 mb-3">{{ $content->content_1 }}</h2>
                    <div class="font-size-17 fw-light">{!! $content->content_2 !!}</div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 p-0 d-sm-none d-md-block">
                @if (Storage::disk('public')->exists($content->image))
                    <img src="{{ asset($content->image) }}" class="img-fluid w-100">
                @else
                    <img src="{{ asset('images/default.jpg') }}" class="img-fluid w-100">	
                @endif
            </div>
        @endif
    @endforeach
</div>
@endsection
@push('scripts')
@endpush
@push('head')
<style>
</style>
@endpush


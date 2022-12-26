@extends('paginas.partials.app')
@section('content')
<div class="contenedor-breadcrumb bg-celeste">
    <div class="container">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb py-2 font-size-13 m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}" class="color-azul-oscuro text-decoration-none text-dark">inicio</a>
                </li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Contacto</li>
            </ol>
        </div>
    </div>
</div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3281.6546286877733!2d-58.43217818497473!3d-34.66342418044408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bccb8f764d23fd%3A0xea678ea7d890583f!2sTraxi%C3%B3n%20Argentina!5e0!3m2!1ses!2sve!4v1650124019092!5m2!1ses!2sve" height="464" style="border:0; width:100%;" allowfullscreen="" loading="lazy" style="max-width: 100%;"></iframe>
<div class="bg-celeste py-5" style="margin-top: -6px;">
    <div class="container row mx-auto">
        <div class="col-sm-12 col-md-4">
            <h3 class="text-blue mb-4 font-size-22">Contacto</h3>
            <div class="d-flex align-items-center mb-3">
                <i class="fal fa-map-marker-alt text-red d-block me-2" style="font-size: 20px;"></i>
                <address class="d-block text-dark m-0"> {{ $data->address }}</address>
            </div>
            @php $phone = Str::of($data->phone1)->explode('|') @endphp
            @php $phone2 = Str::of($data->phone2)->explode('|') @endphp
            <div class="d-flex align-items-center mb-3">
                <i class="fal fa-phone-alt text-red d-block me-2" style="font-size: 20px;"></i>
                @if(count($phone) == 2)
                    <a href="tel:{{$phone[0]}}" class="text-dark text-decoration-none underline font-size-15">{{ $phone[1] }}</a>
                @else
                    <a href="tel:{{$data->phone1}}" class="text-dark text-decoration-none underline font-size-15">{{ $data->phone1 }}</a>
                @endif
                <span class="text-dark">/</span>
                @if(count($phone2) == 2)
                    <a href="tel:{{$phone2[0]}}" class="text-dark text-decoration-none underline font-size-15">{{ $phone2[1] }}</a>
                @else
                    <a href="tel:{{$data->phone2}}" class="text-dark text-decoration-none underline font-size-15">{{ $data->phone2 }}</a>
                @endif
            </div>
            <div class="d-flex align-items-center mb-3">
                <i class="fal fa-envelope text-red d-block me-2" style="font-size: 20px;"></i><span class="d-block"></span>
                <a href="mailto:{{ $data->email }}" class="text-dark text-decoration-none underline font-size-15">{{ $data->email }}</a>             
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <h3 class="text-blue mb-4 font-size-22">Administración y ventas</h3>
            @foreach (Str::of($data->email2)->explode('|') as $email2)
                <div class="d-flex align-items-center mb-1">
                    <i class="fal fa-envelope text-red d-block me-2" style="font-size: 20px;"></i><span class="d-block"></span>
                    <a href="mailto:{{ $email2 }}" class="text-dark text-decoration-none underline">{{ $email2 }}</a>             
                </div>  
            @endforeach
        </div>
        <div class="col-sm-12 col-md-4">
            <h3 class="text-blue mb-4 font-size-22">Oficina Técnica</h3>
            @foreach (Str::of($data->email3)->explode('|') as $email3)
                <div class="d-flex align-items-center mb-1">
                    <i class="fal fa-envelope text-red d-block me-2" style="font-size: 20px;"></i><span class="d-block"></span>
                    <a href="mailto:{{ $email3 }}" class="text-dark text-decoration-none underline">{{ $email3 }}</a>             
                </div> 
            @endforeach 
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <span class="d-block">{{$error}}</span>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>  
        @endif
        @if (Session::has('mensaje'))
            <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('mensaje') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>                    
        @endif
        <form action="{{ route('send-contact') }}" method="post" class="form-contact">
            @csrf
            <div class="row">       
                <div class="col-sm-12 col-md-11 mx-auto">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="text-center pb-5 font-size-20 mb-5" style="border-bottom: 1px solid #C4C4C4">Complete el formulario para que podamos contactarnos con usted a la brevedad</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Nombre *</label>
                                <input type="text" name="nombre" class="form-control font-size-14">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-sm-3 mb-sm-3">
                            <div class="form-group">
                                <label for="">Correo electrónico *</label>
                                <input type="email" name="email" class="form-control font-size-14">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-sm-3">
                            <div class="form-group">
                                <label for="">Teléfono *</label>
                                <input type="text" name="telefono" placeholder="" class="form-control font-size-14">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Empresa</label>
                                <input type="text" name="empresa" class="form-control font-size-14">
                            </div>
                        </div>
                        <div class="col-sm-12 mb-sm-3 mb-sm-3">
                            <div class="form-group">
                                <textarea name="mensaje" class="form-control font-size-14" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-sm-3 pb-3 mb-3" style="border-bottom: 1px solid #C4C4C4">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="termino" id="termino">
                                <label class="form-check-label font-size-13" for="termino">Acepto los términos y condiciones de privacidad *</label>
                              </div>
                            <div class="form-group">
                                {!! app('captcha')->display() !!}
                            </div>
                        </div>
                        <div class="col-sm-12 mb-sm-3 mb-sm-3 text-center">
                            <button type="submit" class="text-uppercase btn font-size-14 py-2 font-weight-600 mb-sm-3 mb-md-0 ancho-boton text-white px-5 bg-red" style="border-radius:0;">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

<footer class="font-size-14 text-sm-center text-md-start bg-blue">
    <div class="row justify-content-between container mx-auto py-sm-2 py-md-5">
        <div class="col-sm-12 col-md-2 d-sm-none d-md-block">
            <div class="row justify-content-between">
                <div class="col-sm-12">    
                    <div class="row">
                        <h6 class="text-white mb-4 text-sm-start pe-5 pb-2" style="font-weight: 400;">Secciones</h6>
                        <a href="{{ route('index') }}" class="d-block text-decoration-none text-light mb-1 underline">Home</a>
                        <a href="{{ route('empresa') }}" class="d-block text-decoration-none text-light mb-1 underline">Empresa</a>
                        <a href="{{ route('categorias') }}" class="d-block text-decoration-none text-light mb-1 underline">Productos</a>
                        <a href="{{ route('contacto') }}" class="d-block text-decoration-none text-light mb-1 underline">Contacto</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 mb-sm-4 mb-md-0">
            <div class="row">
                <div class="col-sm-12 newsletter">
                    <h6 class="text-white text-sm-start" style="font-weight: 400;">Suscribite al Newsletter</h6>
                    <form action="{{ route('newsletter.store') }}" id="formNewsletter" class="mt-4">
                        @csrf                          
                        <div class="">
                            <label class="visually-hidden" for="">Username</label>
                            <div class="input-group font-size-12">
                                <input type="email" name="email" autocomplete="off" class="form-control font-size-12" placeholder="Ingresa tu email" style="background-color: white; border-radius: 0;">
                                <button type="submit" id="" class="input-group-text bg-white" style="border: none;"><i class="fal fa-arrow-right text-red"></i></button>
                                <div id="text-newsletter" style="width: 100%; margin-top: 10px;color: white;
                                font-size: 15px; text-align: center;"></div>
                            </div>
                        </div>
                    </form>
                    <h6 class="text-white mt-4 text-sm-start" style="font-weight: 400;">Redes sociales</h6>
                    <div class="text-sm-start">
                        @if ($data->facebook)
                            <a href="{{$data->facebook}}" class="font-size-20 tex-decoration-none me-2"><i class="fab fa-facebook-f text-white"></i>
                            </a>
                        @endif
                        @if ($data->instagram)
                            <a href="{{$data->instagram}}" class="font-size-20 tex-decoration-none"><i class="fab fa-instagram text-white"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 font-size-13 px-sm-3 px-md-0">
            <h6 class="text-white mb-4 text-sm-start pe-5 pb-2" style="font-weight: 400;">Contacto</h6>
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fal fa-map-marker-alt text-light d-block me-2" style="font-size: 20px;"></i>
                        <address class="d-block text-light m-0"> {{ $data->address }}</address>
                    </div>
                    @php $phone = Str::of($data->phone1)->explode('|') @endphp
                    @php $phone2 = Str::of($data->phone2)->explode('|') @endphp
                    <div class="d-flex align-items-center mb-3">
                        <i class="fal fa-phone-alt text-light d-block me-2" style="font-size: 20px;"></i>
                        @if(count($phone) == 2)
                            <a href="tel:{{$phone[0]}}" class="text-light text-decoration-none underline">{{ $phone[1] }}</a>
                        @else
                            <a href="tel:{{$data->phone1}}" class="text-light text-decoration-none underline">{{ $data->phone1 }}</a>
                        @endif
                        <span class="text-light">/</span>
                        @if(count($phone2) == 2)
                            <a href="tel:{{$phone2[0]}}" class="text-light text-decoration-none underline">{{ $phone2[1] }}</a>
                        @else
                            <a href="tel:{{$data->phone2}}" class="text-light text-decoration-none underline">{{ $data->phone2 }}</a>
                        @endif
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fal fa-envelope text-light d-block me-2" style="font-size: 20px;"></i><span class="d-block"></span>
                        <a href="mailto:{{ $data->email }}" class="text-light text-decoration-none underline">{{ $data->email }}</a>             
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 font-size-13 px-sm-3 px-md-0">
            <div class="">
                <h6 class="text-white mb-4 text-sm-start pe-5 pb-2" style="font-weight: 400;">Administración y ventas</h6>
                @foreach (Str::of($data->email2)->explode('|') as $email2)
                    <div class="d-flex align-items-center mb-1">
                        <i class="fal fa-envelope text-light d-block me-2" style="font-size: 20px;"></i><span class="d-block"></span>
                        <a href="mailto:{{ $email2 }}" class="text-light text-decoration-none underline">{{ $email2 }}</a>             
                    </div>  
                @endforeach
            </div>
            <div class="">
                <h6 class="text-white mb-2 mt-2 text-sm-start pe-5 pb-2 mt-4" style="font-weight: 400;">Oficina Técnica</h6>
                @foreach (Str::of($data->email3)->explode('|') as $email3)
                    <div class="d-flex align-items-center mb-1">
                        <i class="fal fa-envelope text-light d-block me-2" style="font-size: 20px;"></i><span class="d-block"></span>
                        <a href="mailto:{{ $email3 }}" class="text-light text-decoration-none underline">{{ $email3 }}</a>             
                    </div>  
                @endforeach
            </div>
        </div>
    </div>
    <div class="text-white py-2 bg-white" style="border-top: 1px solid #f9f9f9a1;">
        <div class="container d-flex flex-wrap justify-content-between">
            <span class="text-blue">© Copyright 2022 Traxion. Todos los derechos reservados</span>
            <a href="https://osole.com.ar/" class="text-blue text-decoration-none underline">BY OSOLE</a>
        </div>
    </div>
</footer>
<a href="https://wa.me/{{$data->phone3}}" class="position-fixed" style="background-color: #0DC143; color: white; font-size: 40px; padding: 0px 13px; border-radius: 100%; bottom: 30px; right: 40px;">
    <i class="fab fa-whatsapp"></i>
</a>
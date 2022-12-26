<header class="header bg-red py-1">
    <div class="container d-flex justify-content-end">
        <div class="me-4">
            <i class="fal fa-envelope text-white font-size-16"></i>
            <a href="mailto:{{ $data->email }}" class="text-decoration-none underline text-white font-size-16">{{ $data->email }}</a>
        </div>
        <div class="">
            <i class="fal fa-phone-alt text-white font-size-16 me-1 text-white"></i> 
            @php $phone1 = Str::of($data->phone1)->explode('|') @endphp
            @if (count($phone1) == 2)
                <a href="tel:{{$phone1[0]}}" class="text-white text-decoration-none font-size-16 underline">{{ $phone1[1] }}</a>
            @else 
                <a href="tel:{{$data->phone1}}" class="text-white text-decoration-none font-size-16 underline">{{ $data->phone1 }}</a>
            @endif
            <span class="text-white">/</span>
            @php $phone2 = Str::of($data->phone2)->explode('|') @endphp
            @if (count($phone2) == 2)
                <a href="tel:{{$phone2[0]}}" class="text-white text-decoration-none font-size-16 underline">{{ $phone2[1] }}</a>
            @else 
                <a href="tel:{{$data->phone2}}" class="text-white text-decoration-none font-size-16 underline">{{ $data->phone2 }}</a>
            @endif
        </div>
    </div>
</header>
<nav class="navbar navbar-expand-lg navbar-light w-100">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img src="{{ asset($data->logo_header) }}" class="img-fluid logo-header">
        </a>
        <div class="d-flex">
            <div class="me-2 d-sm-block d-md-none">
                @if (! Auth::guard('clients')->check())
                    <div class="text-uppercase text-white font-size-14 bg-red-2 py-2 px-4" id="zona-cliente2" style="cursor: pointer">Ingresar</div>
                    <div class="formularios2">
                        <form action="{{ route('client.authenticate') }}" method="post" id="form-login2" 
                        class="position-absolute py-5 px-3" autocomplete="off">
                            <div id="login-message2" class="text-center mb-4"></div>
                            <div class="font-size-21 mb-3" style="text-transform: initial;">Zona privada para clientes</div>
                            <div class="form-group mb-3">
                                <label class="font-size-16" style="text-transform: initial;">Correo</label>
                                <input type="email" name="email" class="form-control bg-transparent" placeholder="Ingrese el correo por favor">
                            </div>
                            <div class="form-group mb-3">
                                <label class="font-size-16" style="text-transform: initial;">Contraseña</label>
                                <input type="password" name="password" class="form-control bg-transparent" placeholder="Ingrese la clave">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-red-2 text-white text-uppercase d-block px-4 py-2 mb-3 d-block w-100 mb-3">ingresar</button>
                                <button type="submit" class="btn  text-uppercase text-white d-block px-4 py-2 d-block w-100 crear-cuenta2" style="background-color: transparent; color: #CC160E !important; border: 1px solid #CC160E;">No tienes cuenta ?</button>
                            </div>
                        </form> 
                        <form action="{{ route('client.register-async') }}" method="post" id="form-register2" 
                        class="position-absolute py-5 px-3" autocomplete="off">
                            <div id="register-message2" class="text-center mb-4"></div>
                            <div class="font-size-21 mb-3" style="text-transform: initial;">Zona privada para clientes</div>
                            <div class="form-group mb-3">
                                <label class="font-size-16" style="text-transform: initial;">Usuario</label>
                                <input type="name" name="name" class="form-control bg-transparent">
                            </div>
                            <div class="form-group mb-3">
                                <label class="font-size-16" style="text-transform: initial;">Correo</label>
                                <input type="email" name="email" class="form-control bg-transparent">
                            </div>
                            <div class="form-group mb-3">
                                <label class="font-size-16" style="text-transform: initial;">Contraseña</label>
                                <input type="password" name="password" class="form-control bg-transparent">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn d-block bg-red-2 text-white px-4 py-2 d-block w-100 mb-3" >Crear cuenta</button>
                                <button type="submit" class="btn text-uppercase px-4 py-2 mb-3 bg-red text-uppercase text-white w-100 ingresar2" style="background-color: transparent; color: #CC160E !important; border: 1px solid #CC160E;">crear cuenta</button>
                            </div>
                        </form> 
                    </div>
                @else
                    <a href="{{ route('client.logout') }}" class="text-white font-size-13 bg-red-2 py-2 px-4 text-decoration-none d-block">{{ client()->name }}</a>
                @endif

            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end text-uppercase" id="navbarNav">
            <ul class="navbar-nav position-relative align-items-center justify-content-between">
                @if (! Auth::guard('clients')->check())
                    <li class="nav-item @if(Request::is('empresa')) position-relative @endif">
                        <a class="nav-link font-size-13 text-dark fw-bold @if(Request::is('empresa')) active @endif" href="{{ route('empresa') }}">Empresa</a>
                    </li>
                    <li class="nav-item @if(Request::is('categorias') || Request::is('productos') || Request::is('productos/*') || Request::is('producto/*') || Request::is('categoria/*')) position-relative @endif">
                        <a class="nav-link font-size-13 text-dark fw-bold @if(Request::is('categorias') || Request::is('productos') || Request::is('productos/*') || Request::is('producto/*') || Request::is('categoria/*')) active @endif" href="{{ route('categorias') }}">Productos</a>
                    </li> 
                    <li class="nav-item @if(Request::is('proceso-productivo')) position-relative @endif">
                        <a class="nav-link font-size-13 text-dark fw-bold @if(Request::is('proceso-productivo')) active @endif" href="{{ route('proceso-productivo') }}">Proceso productivo</a>
                    </li>   
                    <li class="nav-item @if(Request::is('contacto')) position-relative @endif">
                        <a class="nav-link font-size-13 text-dark fw-bold @if(Request::is('contacto')) active @endif" href="{{ route('contacto') }}" >Contacto</a>
                    </li>
                    <li class="nav-item d-sm-none d-md-block">
                        <div class="position-relative">
                            <div class="text-uppercase text-white font-size-13 bg-red-2 py-2 px-4" id="zona-cliente" style="cursor: pointer">Ingresar</div>
                            <div class="formularios position-relative">
                                <div class="triangulo-equilatero-bottom position-absolute"></div>
                                <form action="{{ route('client.authenticate') }}" method="post" id="form-login" 
                                class="position-absolute py-5 px-3" autocomplete="off">
                                    <div id="login-message" class="text-center mb-4"></div>
                                    <div class="font-size-21 mb-3" style="text-transform: initial;">Zona privada para clientes</div>
                                    <div class="form-group mb-3">
                                        <label class="font-size-16" style="text-transform: initial;">Correo</label>
                                        <input type="email" name="email" class="form-control bg-transparent" placeholder="Ingrese el correo por favor">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="font-size-16" style="text-transform: initial;">Contraseña</label>
                                        <input type="password" name="password" class="form-control bg-transparent" placeholder="Ingrese la clave">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn text-uppercase bg-red-2 text-white d-block px-4 py-2 mb-3 d-block w-100 mb-3" >ingresar</button>
                                        <button type="submit" class="btn  text-uppercase text-white d-block px-4 py-2 d-block w-100 crear-cuenta" style="background-color: transparent; color: #CC160E !important; border: 1px solid #CC160E;">crear cuenta</button>
                                    </div>
                                </form> 
                                <form action="{{ route('client.register-async') }}" method="post" id="form-register" 
                                class="position-absolute py-5 px-3" autocomplete="off">
                                    <div id="register-message" class="text-center mb-4"></div>
                                    <div class="font-size-21 mb-3" style="text-transform: initial;">Zona privada para clientes</div>
                                    <div class="form-group mb-3">
                                        <label class="font-size-16" style="text-transform: initial;">Usuario</label>
                                        <input type="name" name="name" class="form-control bg-transparent">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="font-size-16" style="text-transform: initial;">Correo</label>
                                        <input type="email" name="email" class="form-control bg-transparent">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="font-size-16" style="text-transform: initial;">Contraseña</label>
                                        <input type="password" name="password" class="form-control bg-transparent">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-red-2 text-white text-uppercase d-block px-4 py-2 d-block w-100 mb-3" >Crear cuenta</button>
                                        <button type="submit" class="btn text-uppercase px-4 py-2 mb-3  text-uppercase  w-100 ingresar" style="background-color: transparent; color: #CC160E !important; border: 1px solid #CC160E;">ingresar</button>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </li>
                @else       
                    <li class="nav-item @if(Request::is('lista-de-precios')) position-relative @endif">
                        <a class="nav-link font-size-13 text-dark fw-bold @if(Request::is('lista-de-precios')) active @endif" href="{{ route('lista-de-precios') }}">Lista de precios</a>
                    </li>
                    <li class="nav-item d-sm-none d-md-block">
                        <a href="{{ route('client.logout') }}" class="text-white font-size-13 me-3 bg-red py-2 px-4 text-decoration-none">{{ client()->name }}</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>  

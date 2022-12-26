<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="root" content="{{ env('APP_URL') }}" id="root">
    @stack('head')
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <meta name="author" content="rcastrodev">
    <link rel="stylesheet" href="{{ asset('css/bootstrapv5.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages.css?version=1') }}">
    {!! SEO::generate() !!}
</head>
<body>
    @include('paginas.partials.header')
    @yield('content')
    @include('paginas.partials.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/axios.js') }}"></script>
    <script src="{{ asset('js/pages/newsletter.js') }}"></script>
    <script src="{{ asset('js/pages/client.js') }}"></script>
    <script>
        $('#category_id').on('change', function(e) {
            axios.get(`${e.target.dataset.url}/${this.value}`).then(r => {
                let option;
                if (r.data.products.length) {
                    r.data.products.forEach(element => {
                        option += `<option value="${element.id}">${element.name}</option>`
                    });
                }else{
                    option = `<option value="0">Selecciona</option>`
                }
                $('#product_id').html(option)
            }).catch(error => console.error(error))
        });
    </script>
    @stack('scripts')
</body>
</html>
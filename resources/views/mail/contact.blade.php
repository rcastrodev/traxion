<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table, th, td{
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Contacto desde el sitio web</h2>
    <div>
        <p><strong>Nombre:</strong>  {{ $data['nombre'] }}  </p>
        <p><strong>Email:</strong>  {{ $data['email'] }} </p>
        <p><strong>Teléfono:</strong>  {{ $data['telefono'] }} </p>
        @if (isset($data['empresa']))
            <p><strong>Empresa:</strong>  {{ $data['empresa'] }} </p>
        @endif   
        @if (isset($data['mensaje']))
            <p><strong>Mensaje:</strong>  {{ $data['mensaje'] }} </p>
        @endif        
    </div>    
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Turismo</title>

    <!-- Google Fonts: Manrope (texto) + Outfit (títulos) + Dancing Script (detalle) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Manrope:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap (ruta corregida: tenía "plugins/plugins") -->
    <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <!-- Tema Turismo -->
    <link rel="stylesheet" href="{{ asset('css/turismo.css') }}">
    @stack('css')
</head>
<body class="hold-transition login-page">
@yield('content')

<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
@stack('scripts')
</body>
</html>
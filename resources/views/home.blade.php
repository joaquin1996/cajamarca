<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{asset('img/logo-color.png')}}" rel="icon">
    <link href="{{asset('img/logo-color.png')}}" rel="apple-touch-icon">
    
    <title>TM Travel - Bienvenido</title>

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/mdbootstrap/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

</head>
<body>
    <img src="{{ asset('img/bg-02.jpg') }}" class="fondo" alt="">

    <div class="logo-welcome">
        <img src="{{ asset('img/logo.png') }}" alt="">
    </div>
    
    <div class="col-md-4 list-group list-group-flush bienvenido-opciones">

        <a href="/home/lugares" class="list-group-item">
          <img src="{{ asset('img/icons/lugares-w.png') }}" alt=""> LUGARES
        </a>
        
        <a href="/home/guia-de-empresas" class="list-group-item">
            <img src="{{ asset('img/icons/guiadeempresas-w.png') }}" alt=""> GUIA DE EMPRESAS
        </a>

        <a href="#" class="list-group-item">
            <img src="{{ asset('img/icons/marketplace.png') }}" alt=""> MARKETPLACE
        </a>

        <a href="#" class="list-group-item">
            <img src="{{ asset('img/icons/utilidades.png') }}" alt=""> UTILIDADES
        </a>

        <a href="#" class="list-group-item">
            <img src="{{ asset('img/icons/ajustes-w.png') }}" alt=""> AJUSTES
        </a>

        <a class="list-group-item" href="/logout"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        
            <img src="{{ asset('img/icons/logout-w.png') }}" alt=""> SALIR
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                @csrf
            </form>
        </a> 

    </div>

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/mdbootstrap/mdb.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
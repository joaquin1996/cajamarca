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
    
    <title>TM Travel</title>

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/mdbootstrap/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

</head>
<body>
    <img src="{{ asset('img/bg-03.jpg') }}" class="fondo" alt="">
    <!-- Sidebar -->
  <div id="wrapper">
    <div id="sidebar-wrapper" class="sidebar-fixed position-fixed">
      
      <a href="#" class="menu-toggle icon-menu-responsive"><i class="ion ion-ios-close"></i></a>
      <div class="datos-usuario row">
          <div class="avatar">
            <img src="{{ asset('img/img-user.png') }}" style="width: 100%" alt="">
          </div>
          <div class="username">
            Hola {{auth()->user()->name}}
          </div>
      </div>

      <div class="list-group list-group-flush">
        <a href="/home/lugares" class="list-group-item">
          <img src="{{ asset('img/icons/lugares.png') }}" alt=""> LUGARES
        </a>
        
        <a href="#" class="list-group-item">
            <img src="{{ asset('img/icons/guiadeempresas.png') }}" alt=""> GUIA DE EMPRESAS
        </a>

        <a href="#" class="list-group-item">
            <img src="{{ asset('img/icons/marketplace-w.png') }}" alt=""> MARKETPLACE
        </a>

        <a href="#" class="list-group-item">
            <img src="{{ asset('img/icons/utilidades-w.png') }}" alt=""> UTILIDADES
        </a>

        <a href="#" class="list-group-item">
            <img src="{{ asset('img/icons/ajustes.png') }}" alt=""> AJUSTES
        </a>

        <a class="list-group-item" href="/logout"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        
            <img src="{{ asset('img/icons/logout.png') }}" alt=""> SALIR
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                @csrf
            </form>
        </a> 

      </div>

    </div>
  </div>
  <!-- Sidebar -->

<div class="content">

    <!-- desplegar menu -->
    <nav  class="navbar">
        <!-- Brand -->
        <a id="nav" class="menu-toggle navbar-brand menu-boton" href="#">
          <i class="fa fa-bars"></i>
        </a>
    </nav>
    <!-- end desplegar menu -->

    @yield('content')


<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/mdbootstrap/mdb.min.js') }}"></script>
<script src="{{ asset('vendor/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/dropzone.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

@yield('scripts')
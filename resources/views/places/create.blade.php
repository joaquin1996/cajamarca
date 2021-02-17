@extends('layouts.app')

@section('content')
<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/iconic/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
<script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<body>
<div class="container" style="margin-top: 2rem">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-head">
                    <h4>Registrar Lugar</h4>
                </div>
                <div class="card-body">
                    <!-- rduarte, formulario para registrar la actividad -->
                    <form method="POST" class="" action="{{ route('save-place') }}" id="create_place" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nombre" aria-label="Username" id="activity-name" name="name" aria-describedby="basic-addon1" value="" required>
                        </div>
                        <div class="input-group mb-3">
                            <textarea cols="30" rows="5" class="form-control" placeholder="Descripción" aria-label="description" id="activity-description" name="description" aria-describedby="basic-addon1" value="" required style="resize: none"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-primary" id="submit">
                                Guardar Lugar
                            </button>
                        <div/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

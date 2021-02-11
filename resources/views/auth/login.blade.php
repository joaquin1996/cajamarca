<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TM Travel</title>

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/iconic/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>


<body style="background: url('../img/bg-01.jpg'); background-size:cover">
   
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                <form method="POST" class="login100-form" action="{{ route('login') }}">
                    @csrf

                    <div class="col-md-12 text-center mb-5">
                        <img src="{{asset('img/logo.png')}}" class="sesion-img" alt="">
                    </div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                        <i class="fa fa-user icon-left"></i>
                        <input class="input100" type="text" name="email" id="email" autocomplete="off" required>
                        <span class="focus-input100" data-placeholder="Correo / Usuario"></span>
                    </div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
                        <i class="zmdi zmdi-lock icon-left"></i>
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye icon-right"></i>
						</span>
						<input class="input100" type="password" name="password" id="password" required>
                        <span class="focus-input100" data-placeholder="Contrase&ntilde;a"></span>
                    </div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Iniciar Sesi&oacute;n
							</button>
						</div>
					</div>

				</form>

                <div class="recuperar">
                    <a href="{{ route('password.request') }}">¿Olvidaste tu Contrase&ntilde;a?</a>
                </div>

                <div class="iniciar-redes">
                    <span>Iniciar con:</span>
                    <i class="fa fa-facebook-square"></i>
                    <i class="fa fa-envelope-o"></i>
                </div>

                <div class="registrate">
                    ¿Aun no tienes una cuenta? <a href="{{ route('register') }}">Registrate</a>
                </div>
				
			</div>
		</div>
	</div>	

    
<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/login.js') }}"></script>
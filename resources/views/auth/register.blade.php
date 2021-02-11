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
                <form method="POST" class="login100-form" action="{{ route('register') }}">
                    @csrf

                    <div class="col-md-12 text-center mb-5">
                        <img src="{{asset('img/logo.png')}}" class="sesion-img" alt="">
                    </div>

					<div class="wrap-input100 validate-input">
                        <i class="fa fa-user icon-left"></i>
                        <input class="input100" type="text" name="name" id="name" autocomplete="off" required>
                        <span class="focus-input100" data-placeholder="Nombre de usuario"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                        <i class="fa fa-envelope icon-left"></i>
                        <input class="input100" type="text" name="email" id="email" autocomplete="off" required>
                        <span class="focus-input100" data-placeholder="E-mail"></span>
                    </div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
                        <i class="zmdi zmdi-lock icon-left"></i>
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye icon-right"></i>
						</span>
						<input class="input100" type="password" name="password" id="password" required>
                        <span class="focus-input100" data-placeholder="Contrase&ntilde;a"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <i class="zmdi zmdi-lock icon-left"></i>
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye icon-right"></i>
						</span>
						<input class="input100" type="password" name="password_confirmation" id="password-confirm" required>
                        <span class="focus-input100" data-placeholder="Confirmar Contrase&ntilde;a"></span>
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
                
                <div class="registrate">
                    ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Iniciar sesi&oacute;n</a>
                </div>
				
			</div>
		</div>
	</div>	

    
<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('js/login.js') }}"></script>


{{-- <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </div>
</form> --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Fonts -->
         <link href="{{ asset('../css/myappcss.css') }}" rel="stylesheet">
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
         <script src="https://use.fontawesome.com/b97719d116.js"></script>
    </head>
    <body>
         <div class="mid-class body">
            <!--Se implementa el Login-->
            <div class="container">                   
                    <form method="POST" action="{{ route('login') }}" class="form-group center">
                        @csrf
                        <h3>Iniciar sesión</h3>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
		                            <div class="input-group-prepend">
		                             <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		                            </div>
		                           <input id="email" type="email" class="form-control form-control-lg control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="alguien@correo.com">
	                            </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
		                            <div class="input-group-prepend">
		                              <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		                            </div>
	                               <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required placeholder="*********">
	                            </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input class="form-check-input largeCheck" type="checkbox" name="remember" id="remember" value="{{ old('remember') ? 'checked' : '' }}">
                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                @endif
                                </div>
                                
                               
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 ">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Iniciar sesión') }}
                                </button>
                                <a class="nav-link" href="{{ route('register') }}">{{ __('¿Aún no tienes cuenta?, regístrate aquí')}}</a>
                            </div>
                           
                        </div>
                    </form>
            <!--/Se implementa el Login-->
        </div>
    </body>
</html>

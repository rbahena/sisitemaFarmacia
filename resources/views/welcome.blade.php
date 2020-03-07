<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Sistema farmacia</title>
   <!--Styles-->
   <link href="{{ asset('../css/myappcss.css') }}" rel="stylesheet">
   <!-- Fonts -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <!--Scripts-->
   <script src="{{ asset('../js/myappscripts.js') }}"></script>
   <script src="https://use.fontawesome.com/b97719d116.js"></script>
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
   </script>
</head>

<body> 
   <div class="mid-class body">
      <!--Se implementa el Login-->
      <div class="container" id="login-form">
         <form method="POST" action="{{ route('login') }}" class="form-group center">
            @csrf
            <h3>Iniciar sesión</h3>
            <div class="form-group row">
               <div class="col-md-8">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                     </div>
                     <input id="email" type="email"
                        class="form-control form-control-lg control-lg @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autofocus placeholder="alguien@correo.com">
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
                     <input id="password" type="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                        required placeholder="*********">
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
                     <input class="form-check-input largeCheck" type="checkbox" name="remember" id="remember"
                        value="{{ old('remember') ? 'checked' : '' }}">
                     <label class="form-check-label" for="remember">
                        {{ __('Recordarme') }}
                     </label>
                     <!-- @if (Route::has('password.request'))
                     <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                     </a>
                     @endif -->
                     @if (Route::has('password.request'))
                     <a class="btn btn-link" href="#" onclick="goResetPassword()">
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
                  <a class="nav-link" onclick="goRegister()"
                     href="#">{{ __('¿Aún no tienes cuenta?, regístrate aquí')}}</a>
                  <!-- <a class="nav-link" href="{{ route('register') }}">{{ __('¿Aún no tienes cuenta?, regístrate aquí')}}</a> -->
               </div>
            </div>
         </form>
      </div>
      <!--/Se implementa el Login-->

      <!--Se implementa el registro de usuarios / empresas-->
      <div class="container" id="register-form" style="display: none;">
         <form method="POST" action="{{ route('register') }}" class="form-group center">
            @csrf
            <h3>Registrate como cliente</h3>
            <div class="form-group row">
               <div class="col-md-8">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                     </div>
                     <input id="sUsrName" type="text"
                        class="form-control  form-control-lg @error('sUsrName') is-invalid @enderror" name="sUsrName"
                        value="{{ old('sUsrName') }}" required autocomplete="sUsrName" autofocus
                        placeholder="Nombre usuario">
                  </div>
                  @error('name')
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
                        <span class="input-group-text"> <i class="fa fa-at"></i> </span>
                     </div>
                     <input id="email" type="email"
                        class="form-control  form-control-lg @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" placeholder="Correo electrónico">
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
                        <span class="input-group-text"> <i class="fa fa-key"></i> </span>
                     </div>
                     <input id="password" type="password"
                        class="form-control  form-control-lg @error('password') is-invalid @enderror" name="password"
                        required autocomplete="new-password" placeholder="Contraseña">
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
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-key"></i> </span>
                     </div>
                     <input id="password-confirm" type="password" class="form-control  form-control-lg"
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="Confirma contraseña">
                  </div>
               </div>
            </div>

            <div class="form-group row mb-0">
               <div class="col-md-8 ">
                  <button type="submit" class="btn btn-primary btn-lg">
                     {{ __('Registrate') }}
                  </button>
                  <a class="nav-link" onclick="goLogin()" href="#">{{ __('¿Ya tienes cuenta?, inicia sesión aquí')}}</a>
                  <!-- <a class="nav-link" href="{{ route('register') }}">{{ __('¿Aún no tienes cuenta?, regístrate aquí')}}</a> -->
               </div>
            </div>
            <br>
            <br>
            <small>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</small>
         </form>
         <!--/Se implementa el registro de usuarios / empresas-->
      </div>

      <!--Se implementa el ResetPassword-->
      <div class="container" id="resetPwdEmail-form" style="display: none;">
         @if (session('status'))
         <div class="alert alert-success" role="alert">
            {{ session('status') }}
         </div>
         @endif

         <form method="POST" action="{{ route('password.email') }}" class="form-group center">
            @csrf
            <h3>Resetear mi contraseña</h3>
            <div class="form-group row">
               <div class="col-md-8">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-at"></i> </span>
                     </div>
                     <input id="email" type="email"
                        class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="Ingresa tu correo electrónico">
                  </div>

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
            </div>

            <div class="form-group row mb-0">
               <div class="col-md-8 ">
                  <button type="submit" class="btn btn-primary btn-lg">
                     {{ __('Enviar') }}
                  </button>
                  <a class="btn btn-primary btn-lg" href="{{ url('/') }}">{{ __('Cancelar')}}</a>
               </div>
            </div>
         </form>
      </div>
      <!--/Se implementa el ResetPassword-->
   </div>
</body>
<!-- Footer -->
<footer class="page-footer font-small blue">
   <!-- Copyright -->
   <div class="footer-copyright text-center py-3">© 2020 Copyright:
      <label>FarmaciasIgualaGro</label>
   </div>
   <!-- Copyright -->
</footer>
<!-- Footer -->

</html>

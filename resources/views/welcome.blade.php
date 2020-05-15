<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Intergenerica</title>
   <!--Styles-->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link href="{{ asset('css/general.css') }}" rel="stylesheet">
   <link href="{{ asset('css/welcomeStyle.css') }}" rel="stylesheet">

   <!--Scripts-->
   <script src="{{ asset('js/welcomeScript.js') }}"></script>
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
</head>

<body>
<div class="mid-class body">
      <!--Se implementa el Login-->
      <div class="container m-azul-o" id="login-form">
         <form method="POST" action="{{ route('login') }}" class="form-group center">
            @csrf
            <h3>Iniciar sesión</h3>
            <div class="form-group row">
               <div class="col-md-10">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user m-azul-o"></i> </span>
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
               <div class="col-md-10">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock m-azul-o"></i> </span>
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

            <div class="row">
               <div class="col-md-10">
                  <div class="form-group form-check">
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

            <div class="form-group row">
               <div class="col-md-10 text-center">
                  <button type="submit" class="btn btn-azul-o btn-lg">
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
      <div class="container m-azul-o" id="register-form" style="display: none;">
         <form method="POST" action="{{ route('register') }}" class="form-group center">
            @csrf
            <h3>Registrate como cliente</h3>
            <div class="form-group row">
               <div class="col-md-10">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user m-azul-o"></i> </span>
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
               <div class="col-md-10">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-at m-azul-o"></i> </span>
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
               <div class="col-md-10">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-key m-azul-o"></i> </span>
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
               <div class="col-md-10">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-key m-azul-o"></i> </span>
                     </div>
                     <input id="password-confirm" type="password" class="form-control  form-control-lg"
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="Confirma contraseña">
                  </div>
               </div>
            </div>

            <div class="form-group row">
               <div class="col-md-10 text-center">
                  <button type="submit" class="btn btn-azul-o btn-lg">
                     {{ __('Registrate') }}
                  </button>
                  <a class="nav-link" onclick="goLogin()" href="#">{{ __('¿Ya tienes cuenta?, inicia sesión aquí')}}</a>
                  <!-- <a class="nav-link" href="{{ route('register') }}">{{ __('¿Aún no tienes cuenta?, regístrate aquí')}}</a> -->
               </div>
            </div>
            <!-- <small>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</small> -->
         </form>
         <!--/Se implementa el registro de usuarios / empresas-->
      </div>

      <!--Se implementa el ResetPassword-->
      <div class="container m-azul-o" id="resetPwdEmail-form" style="display: none;">
         @if (session('status'))
         <div class="alert alert-success" role="alert">
            {{ session('status') }}
         </div>
         @endif

         <form method="POST" action="{{ route('password.email') }}" class="form-group center">
            @csrf
            <h3>Resetear mi contraseña</h3>
            <div class="form-group row">
               <div class="col-md-10">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-at m-azul-o"></i> </span>
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

            <div class="form-group row">
               <div class="col-md-10 text-center">
                  <button type="submit" class="btn btn-azul-o btn-lg">
                     {{ __('Enviar') }}
                  </button>
                  <a class="btn btn-azul-o btn-lg" href="{{ url('/') }}">{{ __('Cancelar')}}</a>
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
   <div class="footer-copyright text-center">© 2020 Copyright:
      <label>medica_intergenerica</label>
   </div>
   <!-- Copyright -->
</footer>
<!-- Footer -->

</html>
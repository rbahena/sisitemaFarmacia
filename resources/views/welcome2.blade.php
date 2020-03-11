<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Intergenerica</title>
   <!--Styles-->
   <link href="{{ asset('../css/welcome2.css') }}" rel="stylesheet">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

   <!--Scripts-->
   <script src="{{ asset('../js/welcome.js') }}"></script>
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
</head>

<body onload="mostrarSaludo()">
 <!-- 
Thanks to:
https://medium.com/@AmJustSam/how-to-do-css-only-frosted-glass-effect-e2666bafab91 
-->

<div class="blurred-box">
  <!--  you dont need the user-login-box html  -->
  <!--  for demo purposes only and its shit  -->
  <div class="user-login-box">
    <span class="user-icon"></span>
    <div class="user-name">
    Iniciar sesión   
    <!-- <div id="txtsaludo"></div> -->
    </div>
    <input class="user-password" type="text" />
  </div>
  
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
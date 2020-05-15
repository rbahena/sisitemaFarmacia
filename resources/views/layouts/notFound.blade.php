@extends('layouts.app')
@section('content')
<style>
h1 {
   font-weight: 800;
   color: #1F2858;
   text-align: center;
   font-size: 2.5em;
   padding-top: 20px;

   @media screen and (max-width: $break) {
      padding-left: 20px;
      padding-right: 20px;
      font-size: 2em;
   }
}
</style>


<html>

<div>
   <div class="text-center">
      <img src="../images/notFound2.gif" class="rounded-circle" height="350px" widht="550px" alt="">
      <h1>Oops! Esta pagina aun esta en desarrollo!</h1>
      <a class="btn btn-danger btn-lg" href="{{ url('/home') }}"><span>Regresar al inicio</span></a>
   </div>

</div>

</html>


@endsection
@extends('layouts.app')
@section('content')

<!-- Page Heading -->
@guest
<li class="nav-item">
   <a class="nav-link" href="{{ url('/') }}">{{ __('Login') }}</a>
</li>
@if (Route::has('register'))
<li class="nav-item">
   <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
</li>
@endif
@else
<div class="d-sm-flex align-items-center justify-content-between mb-4">

   <h3 class="h3 mb-0 text-gray-800"><label id="txtsaludo"> </label> {{ Auth::user()->sUsrName}} </h3>
   <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Ver reportes</a>
</div>
@endguest

<!-- Content Row -->
<div class="row">
   <!-- Realizar venta Card -->
   <!-- <div class="col-xl-3 col-md-6 mb-4 cursorPointer">
      <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-center"><strong>Realizar
                        venta</strong></div>
                  <i class="fas fa-cart-plus      fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div> -->

   <!-- Total de ver inventario -->
   <div class="col-xl-3 col-md-6 mb-4" id="divInventario">
      <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1 text-center"><a href="{{ url('/verInventario')}}" onclick='mostrarLoading()'>Ver inventario</a>
                  </div>
                  <a class="fas fa-clipboard-list fa-2x text-gray-300" href="{{ url('/verInventario') }}"></a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Ver historial de ventas -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a  href="{{ url('/detalleArticulo') }}">AGREGAR ARTICULO</a>
                  </div>
                  <a class="fas fa-clipboard-list fa-2x text-gray-300" href="{{ url('/detalleArticulo') }}"></a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Ventas canceladas -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a  href="{{ url('/ajaxDepartamento') }}">AGREGAR DEPARTAMENTOS</a>
                  </div>
                  <a class="fas fa-comments fa-2x text-gray-300" href="{{ url('/ajaxDepartamento') }}"></a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a  href="{{ url('/ajaxlaboratorio') }}">AGREGAR LABORATORIOS</a>
                  </div>
                  <i class="fas fa-comments fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a  href="{{ url('/ajaxLista') }}">AGREGAR LISTA</a>
                  </div>
                  <i class="fas fa-comments fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>
@endsection

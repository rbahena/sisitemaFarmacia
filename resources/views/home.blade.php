@extends('layouts.app')
@section('content')
<!-- Page Heading -->
@guest
<li class="nav-item">
   <a class="nav-link" href="{{ url('/') }}">{{ __('Login') }}</a>
   <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
</li>
@if (Route::has('register'))
<li class="nav-item">
   <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
</li>
@endif
@else
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Comencemos, {{ Auth::user()->sUsrName}} </h1>
   <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
         class="fas fa-download fa-sm text-white-50"></i> Ver reportes</a>
</div>
@endguest
<!-- Content Row -->
<div class="row">

   <!-- Realizar venta Card -->
   <div class="col-xl-3 col-md-6 mb-4 cursorPointer" onclick="openModalNewVenta()">
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
   </div>

   <!-- Total de ventas Card -->
   <div class="col-xl-3 col-md-6 mb-4" id="divInventario">
      <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1 text-center"> <a  href="{{ url('/inventario') }}">Ver inventario</a>
                  </div>
                  <a class="fas fa-clipboard-list fa-2x text-gray-300" href="{{ url('/inventario') }}"></a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!--Ventas completadas Card -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Ver historial de ventas</div>
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                  <!-- <div class="row no-gutters align-items-center">
                     <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">203</div>
                     </div>
                     <div class="col">
                        <div class="progress progress-sm mr-2">
                           <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                              aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                     </div>
                  </div> -->
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Ventas canceladas Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ventas canceladas
                  </div>
                  <i class="fas fa-comments fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>



<!-- New sales modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
   id="salesModal" data-backdrop="static">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header text-center">
            <h5 class="modal-title text-center" id="exampleModalLabel">Realizar venta</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <form class="form-inline">
               <div class="form-row align-items-center">
                  <div class="col-auto">
                     <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Código de barras">
                  </div>
                  <h5>ó</h5>
                  <div class="col-auto">
                     <div class="input-group mb-2">
                        <select class="custom-select chosen">
                           <option selected>Selecciona el producto</option>
                           <option value="1">Pracetamol</option>
                           <option value="2">Aspirina</option>
                           <option value="3">Ampicilina</option>
                           <option value="3">Desinfriol</option>
                           <option value="3">Pepto Bismol</option>
                           <option value="3">Algodón</option>
                        </select>
                     </div>
                  </div>
                  <!-- <div class="col-auto">
                     <button type="submit" class="btn btn-primary mb-2">Buscar</button>
                  </div> -->
               </div>
            </form>

         </div>
         <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="#" disabled>Buscar</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               @csrf
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /New sales modal -->

@endsection
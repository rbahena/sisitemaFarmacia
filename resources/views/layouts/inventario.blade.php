@extends('layouts.app')
@section('content')
<div class="row">
   <div class="col-xl-3 col-md-6 mb-4" id="divInventario">
      <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1 text-center"><a
                        href="{{ url('/verInventario')}}" onclick='mostrarLoading()'>NUESTRO INVENTARIO</a>
                  </div>
                  <a class="fas fa-clipboard-list fa-2x text-gray-300" href="{{ url('/verInventario') }}"></a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a
                        href="{{ url('/detalleArticulo') }}">ADMINISTRACION DE PRODUCTOS</a>
                  </div>
                  <a class="fas fa-pills text-gray-300" href="{{ url('/detalleArticulo') }}"></a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a
                        href="{{ url('/ajaxDepartamento') }}">DEPARTAMENTOS</a>
                  </div>
                  <a class="fas fa-th-large fa-2x text-gray-300" href="{{ url('/ajaxDepartamento') }}"></a>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1"><a
                        href="{{ url('/ajaxlaboratorio') }}">LABORATORIOS</a>
                  </div>
                  <i class="fas fa-flask text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>

   <divZ class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><a
                        href="{{ url('/ajaxLista') }}">TIPOS DE LISTA</a>
                  </div>
                  <i class="fas fa-list-ol fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </divZ>

   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-dark shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a
                        href="{{ url('/ajaxAlmacen') }}">ALMACENES</a>
                  </div>
                  <i class="fas fa-boxes text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


@endsection
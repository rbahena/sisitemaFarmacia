@extends('layouts.app')
@section('content')
<div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2 text-center">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a  href="{{ url('/ajaxProveedor') }}">ADMINISTRACION DE PROVEEDORES</a>
                  </div>
                  <i class="fas fa-people-carry text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
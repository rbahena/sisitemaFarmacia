@extends('layouts.app')

@section('content')

<a class="btn btn-primary" href="{{ url('/home') }}">Regresar</a>
<hr>


<div class="container-fluid">
   <div class="text-left">
      <button class="btn btn-success" onclick="agregarArticuloModal()">Agregar nuevo articulo</button>
      <p></p>
   </div>
   <div class="table-container">
      <table class="table table-bordred table-striped" id="dataTable">
         <thead>
            <tr>
               <th>Número articulo</th>
               <th>Producto</th>
               <th>Descripción</th>
               <th>Codigo de barras</th>
               <th>Departamento</th>
               <th>Fecha alta</th>
               <th>Editar</th>
               <th>Eliminar</th>
            </tr>
         </thead>
         <tbody>

            @foreach($inventario as $articulo)
            <tr>
               <td>{{!empty($articulo->sNoArticulo) ? $articulo->sNoArticulo:""}}</td>
               <td>{{!empty($articulo->sArticulo) ? $articulo->sArticulo:""}}</td>
               <td>{{!empty($articulo->sDescripcion) ? $articulo->sDescripcion:""}}</td>
               <td>{{!empty($articulo->iCodigoBarra) ? $articulo->iCodigoBarra:""}}</td>
               <td>{{!empty($articulo->relDptoArticulo->sDescripcion) ? $articulo->relDptoArticulo->sDescripcion:""}}
               </td>
               <td>{{!empty($articulo->fFechaAlta) ? $articulo->fFechaAlta:""}}</td>
               <td>
                  <!-- <form action="#" method="POST"> -->
                  <button type="button" class="btn btn-primary btn-sm">
                     <h5><i class="fa fa-edit  text-center"></i></h5>
                  </button>

                  <!-- @csrf
                  @method('DELETE') -->
                  <!-- <button type="submit" class="btn btn-danger">Eliminar</button> -->
                  <!-- </form> -->
               </td>
               <td>
                  <button type="button" class="btn btn-danger btn-sm text-center">
                     <h5><i class="fa fa-trash-alt"></i></h5>
                  </button>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>

<!-- Nuevo articulo modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
   id="nuevoArticuloM" data-backdrop="static">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header text-center">
            <h5 class="modal-title text-center" id="exampleModalLabel">Agregar nuevo articulo</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            
            <form class="container" action="{{route('agregarArticulo')}}" method="post" ectype="multipart/form-data">
               {!!csrf_field()!!}

               <div class="form-group ">
                  <label for="nombreArticulo">*Nombre articulo</label>
                  <input type="text" class="form-control" id="nombreArticulo" required name="nombreArticulo"
                     value="{{old('nombreArticulo')}}" placeholder="Nombre articulo">
               </div>

               <div class="form-group ">
                  <label for="descripcionArticulo">Descripcion</label>
                  <textarea class="form-control" id="descripcionArticulo" name="descripcionArticulo"
                     value="{{old('descripcionArticulo')}}" rows="2"
                     placeholder="Agrega una breve descripcion"></textarea>
               </div>

               <div class="form-group ">
                  <label for="numeroArticulo">Numero de articulo</label>
                  <textarea class="form-control" id="numeroArticulo" name="numeroArticulo"
                     value="{{old('numeroArticulo')}}" rows="2"
                     placeholder="Agrega un numero identificador del articulo"></textarea>
               </div>

               <div class="form-group ">
                  <label for="codigoBarras">Codigo de barras</label>
                  <textarea class="form-control" id="codigoBarras" name="codigoBarras"
                     value="{{old('codigoBarras')}}" rows="2"
                     placeholder="Agrega el codigo de barras"></textarea>
               </div>

               <div class="form-group">
                  <label for="departamentoArt">*Departamento</label>
                  <select id="departamentoArt" required name="departamentoArt" class="form-control">
                     <option selected disabled>Selecciona una opción</option>
                     @foreach($departamentos as $deparamento)
                     <option value='{{$deparamento->kId}}'>{{$deparamento->sDescripcion}}</option>
                     @endforeach
                  </select>
               </div>

               <button type="submit" class="btn btn-primary">Guardar articulo</button>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /New sales modal -->


@endsection
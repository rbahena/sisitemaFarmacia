@extends('layouts.app')

@section('content')
<div class="container-fluid" id="contenido">
<div class="text-center">
<h3>Inventario de productos</h3>
</div>
<hr>
<a class="btn btn-primary" href="{{ url('/home') }}">Regresar</a>
<hr>
   <!-- <div class="text-left">
      <button class="btn btn-success" id="agregaNvoArticulo">Agregar nuevo articulo</button>
      <p></p>
   </div> -->
   <div class="table-container">
      <table class="table table-bordred table-striped" id="dataTable">
         <thead>
            <tr>
               <th>Número articulo</th>
               <th>Nombre producto</th>
               <th>Descripción</th>
               <th>Codigo de barras</th>
               <th>Departamento</th>
               <th>Laboratorio</th>
               <th>Fecha Caducidad</th>
            </tr>
         </thead>
         <tbody>

            @foreach($inventario as $articulo)
            <tr>
               <td>{{!empty($articulo->sNoArticulo) ? $articulo->sNoArticulo:""}}</td>
               <td>{{!empty($articulo->sArticulo) ? $articulo->sArticulo:""}}</td>
               <td>{{!empty($articulo->sDescripcion) ? $articulo->sDescripcion:""}}</td>
               <td>{{!empty($articulo->iCodigoBarra) ? $articulo->iCodigoBarra:""}}</td>
               <td>{{!empty($articulo->relDptoArticulo->sDescripcion) ? $articulo->relDptoArticulo->sDescripcion:""}}</td>
               <td>{{!empty($articulo->relLabArticulo->sDescripcion) ? $articulo->relLabArticulo->sDescripcion:""}}</td>
               <td>{{!empty($articulo->fFechaAlta) ? $articulo->fFechaAlta:""}}</td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>

<div id="data">
</div>
<!-- <div id="post">
</div>

<div class="row col-lg-5">
 <h3>Register form</h3>

   <form id="register" action="#">
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <input type="text" id="uno">
   <input type="text" id="dow">
   <input type="submit" value="register"></input>

   </form>

</div> -->

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
   $('#dataTable').DataTable({
      "language": {
         "sProcessing": "Procesando...",
         "sLengthMenu": "Mostrar _MENU_ registros",
         "sZeroRecords": "No se encontraron resultados",
         "sEmptyTable": "Ningún dato disponible en esta tabla",
         "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
         "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
         "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
         "sInfoPostFix": "",
         "sSearch": "Buscar:",
         "sUrl": "",
         "sInfoThousands": ",",
         "sLoadingRecords": "Cargando...",
         "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
         },
         "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
         }
      }
   });

   $("#agregaNvoArticulo").click(function() {
      $.ajax({
         type: 'get',
         url: 'agregarArticulo',
         success: function(data) {
            debugger;
            console.log(data);
            $("#contenido").empty();
            $("#contenido").append(data);
         }
      });
   });
});

$('#loading').hide(); 
// $('#register').submit(function(){
//  var name1 = $('#uno').val();
//  var name2 = $('#dos').val();

//  $.post('register',{cname1:name1, cname2:name2}, function(data){
//    console.log(data);
//    $("#post").html(data);
//  });
// }); 

</script>
@endsection
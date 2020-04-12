@extends('layouts.app')

@section('content')
<h1>Agrega, edita o elimina laboratorios</h1>
<a class="btn btn-success" href="javascript:void(0)" id="createNewProduct">Agregar nuevo laboratorio</a>
<hr>
<table class="table table-bordered data-table" id="dataTable">
   <thead>
      <tr>
         <th>No</th>
         <th>Nombre</th>
         <th>Clave</th>
         <th width="280px">Accion</th>
      </tr>
   </thead>
   <tbody>
   </tbody>
</table>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="modelHeading"></h4>
         </div>
         <div class="modal-body">
            <form id="productForm" name="productForm" class="form-horizontal">
               <input type="hidden" name="product_id" id="product_id">
               <input type="hidden" name="accion" id="accion">
               <div class="form-group">
                  <label for="name" class="control-label">Nombre laboratorio</label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value=""
                        maxlength="50" required="">
                  </div>
               </div>
               <div class="form-group">
                  <label for="name" class="control-label">Clave</label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" id="clave" name="clave" maxlength="3" placeholder="Ej. LAB"
                        value="" maxlength="50" required="">
                  </div>
               </div>
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Guardar cambios
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$(function() {

   $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

   var table = $('.data-table').DataTable({
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
      },
      processing: true,
      serverSide: true,
      ajax: "{{ route('ajaxlaboratorio.index') }}",
      columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
         },
         {
            data: 'sDescripcion',
            name: 'sDescripcion'
         },
         {
            data: 'sClave',
            name: 'sClave'
         },
         {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
         },
      ]
   });

   $('#createNewProduct').click(function() {
      $('#saveBtn').val("Agregar departamento");
      $('#product_id').val('');
      $('#accion').val("crear");
      $('#productForm').trigger("reset");
      $('#modelHeading').html("Crea nuevo producto");
      $('#ajaxModel').modal('show');
   });

   $('body').on('click', '.editProduct', function() {
      var product_id = $(this).data('id');
      $.get("{{ route('ajaxlaboratorio.index') }}" + '/' + product_id + '/edit', function(data) {
         $('#modelHeading').html("Editar departamento");
         $('#saveBtn').val("Guardar cambios");
         $('#ajaxModel').modal('show');
         $('#product_id').val(data.kId);
         $('#accion').val("editar");
         $('#name').val(data.sDescripcion);
         $('#clave').val(data.sClave);
      })
   });

   $('#saveBtn').click(function(e) {

      $('#loading').show();
      e.preventDefault();
      $.ajax({
         data: $('#productForm').serialize(),
         url: "{{ route('ajaxlaboratorio.store') }}",
         type: "POST",
         dataType: 'json',
         success: function(data) {
            console.log(data);
            if (data.error == 'faltan datos') {
               alert("Debe indicar el nombre del laboratorio y la clave");
            }
            else if(data.error == 'La clave ya existe'){
               alert("La clave ya existe, debe indicar otra diferente");
            }
             else {
               $('#productForm').trigger("reset");
               $('#ajaxModel').modal('hide');
               table.draw();
            }

         },
         error: function(data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes');
         }
      });

      $('#loading').hide();
   });

   $('body').on('click', '.deleteProduct', function() {

      var product_id = $(this).data("id");
      confirm("Estas seguro de que quieres eliminar este laboratorio?");

      $.ajax({
         type: "DELETE",
         url: "{{ route('ajaxlaboratorio.store') }}" + '/' + product_id,
         success: function(data) {
            table.draw();
         },
         error: function(data) {
            console.log('Error:', data);
         }
      });
   });

});
</script>
@endsection
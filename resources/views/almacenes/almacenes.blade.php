@extends('layouts.app')

@section('content')
<div class="text-center">
<h3>Agrega, edita o elimina la lista de almacenes</h3>
</div>
<a class="btn btn-success" href="javascript:void(0)" id="createNewProduct">Agregar almacén</a>
<hr>
<br>
<table class="table table-hover data-table" id="dataTable">
   <thead>
      <tr>
         <th>No</th>
         <th>Nombre</th>
         <th>Clave</th>
         <th width="280px">Funciones</th>
      </tr>
   </thead>
   <tbody>
   </tbody>
</table>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header text-center">
            <h4 class="modal-title" id="modelHeading"></h4>
         </div>
         <div class="modal-body">
            <form id="productForm" name="productForm" class="form-horizontal">
               <input type="hidden" name="almacen_id" id="almacen_id">
               <input type="hidden" name="accion" id="accion">
               <div class="form-group">
                  <label for="name" class="control-label">Alias del almacén</label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" id="name" name="name" placeholder="Ej. Almacen principal" value=""
                        maxlength="50" required="">
                  </div>
                  <br>
                  <label for="clave" class="control-label">Clave</label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" id="clave" name="clave" placeholder="Ej. AL001" value=""
                        maxlength="50" required="">
                  </div>
               </div>
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary" id="saveBtn" value="Agregar">Guardar
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
      ajax: "{{ route('ajaxAlmacen.index') }}",
      columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
         },
         {
            data: 'sAlmacen',
            name: 'sAlmacen'
         },
         {
            data: 'sCveAlmacen',
            name: 'sCveAlmacen'
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
      $('#saveBtn').val("Agregar almacen");
      $('#almacen_id').val('');
      $('#accion').val("crear");
      $('#productForm').trigger("reset");
      $('#modelHeading').html("Agregar nuevo almacen");
      $('#ajaxModel').modal('show');
   });

   $('body').on('click', '.editProduct', function() {
      var almacen_id = $(this).data('id');
      $.get("{{ route('ajaxAlmacen.index') }}" + '/' + almacen_id + '/edit', function(data) {
         $('#modelHeading').html("Editar departamento");
         $('#saveBtn').val("Guardar cambios");
         $('#ajaxModel').modal('show');
         $('#almacen_id').val(data.kId);
         $('#accion').val("editar");
         $('#name').val(data.sAlmacen);
         $('#clave').val(data.sCveAlmacen);
      })
   });

   $('#saveBtn').click(function(e) {
   $('#loading').show();
      e.preventDefault();
      $.ajax({
         data: $('#productForm').serialize(),
         url: "{{ route('ajaxAlmacen.store') }}",
         type: "POST",
         dataType: 'json',
         success: function(data) {
            $('#productForm').trigger("reset");
            $('#ajaxModel').modal('hide');
            table.draw();
         },
         error: function(data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes');
         }
      });

      $('#loading').hide();
   });
   $('body').on('click', '.deleteProduct', function() {
      var almacen_id = $(this).data("id");
      confirm("Estas seguro de que deseas eliminar este registro?");
      $.ajax({
         type: "DELETE",
         url: "{{ route('ajaxAlmacen.store') }}" + '/' + almacen_id,
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

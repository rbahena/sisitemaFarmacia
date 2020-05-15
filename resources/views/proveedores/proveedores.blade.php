@extends('layouts.app')

@section('content')
<h1>Agrega, edita o elimina la lista de proveedores</h1>
<a class="btn btn-success" href="javascript:void(0)" id="createNewProduct">Agregar nuevo proveedor</a>
<hr>
<table class="table table-hover data-table" id="dataTable">
   <thead>
      <tr>
         <th>No</th>
         <th>Nombre</th>
         <th>RFC</th>
         <th>Dirección</th>
         <th>No. Telefono</th>
         <th>Correo electronico</th>
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
            <form id="dataForm" name="dataForm" class="form-horizontal">
               <input type="hidden" name="proveedor_id" id="proveedor_id">
               <input type="hidden" name="accion" id="accion">
               <div class="form-group">
                  <label for="name" class="control-label">Razon social del proveedor</label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" id="name" name="name" value=""
                        maxlength="50" required="">
                  </div>
                  <br>
                  <label for="name" class="control-label">Dirección</label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" id="direccion" name="direccion" value=""
                        maxlength="50" required="">
                  </div>
                  <br>
                  <label for="name" class="control-label">RFC</label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" id="RFC" name="RFC" value=""
                        maxlength="50" required="">
                  </div>
                  <br>
                  <label for="name" class="control-label">Telefono</label>
                  <div class="col-sm-12">
                     <input type="numer" class="form-control" id="telefono" name="telefono" value=""
                        maxlength="10" placeholder="Insertar solo números" required="">
                  </div>
                  <br>
                  <label for="name" class="control-label">Correo electronico</label>
                  <div class="col-sm-12">
                     <input type="email" class="form-control" id="email" name="email" value=""
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
      ajax: "{{ route('ajaxProveedor.index') }}",
      columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
         },
         {
            data: 'sRazonSocial',
            name: 'sRazonSocial'
         },
         {
            data: 'sRFC',
            name: 'sRFC'
         }, 
         {
            data: 'sDomicilio',
            name: 'sDomicilio'
         },
         {
            data: 'iTelefono',
            name: 'iTelefono'
         },
         {
            data: 'sCorreo',
            name: 'sCorreo'
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
      $('#proveedor_id').val('');
      $('#accion').val("crear");
      $('#dataForm').trigger("reset");
      $('#modelHeading').html("Agregar nuevo almacen");
      $('#ajaxModel').modal('show');
   });

   $('body').on('click', '.editProduct', function() {
      var proveedor_id = $(this).data('id');
      $.get("{{ route('ajaxProveedor.index') }}" + '/' + proveedor_id + '/edit', function(data) {
         $('#modelHeading').html("Editar proveedor");
         $('#saveBtn').val("Guardar cambios");
         $('#ajaxModel').modal('show');
         $('#proveedor_id').val(data.kId);
         $('#accion').val("editar");
         $('#name').val(data.sRazonSocial);
         $('#direccion').val(data.sRFC);
         $('#RFC').val(data.sDomicilio);
         $('#telefono').val(data.iTelefono);
         $('#email').val(data.sCorreo);
      })
   });

   $('#saveBtn').click(function(e) {
   $('#loading').show();
      e.preventDefault();
      $.ajax({
         data: $('#dataForm').serialize(),
         url: "{{ route('ajaxProveedor.store') }}",
         type: "POST",
         dataType: 'json',
         success: function(data) {
            $('#dataForm').trigger("reset");
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
      var proveedor_id = $(this).data("id");
      confirm("Estas seguro de que deseas eliminar este registro?");
      $.ajax({
         type: "DELETE",
         url: "{{ route('ajaxProveedor.store') }}" + '/' + proveedor_id,
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
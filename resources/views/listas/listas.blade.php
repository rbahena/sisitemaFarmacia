@extends('layouts.app')

@section('content')
<div class="text-center">
<h3>Agrega, edita o elimina las lista de promociones</h3>
</div>
<a class="btn btn-success" href="javascript:void(0)" id="createNewProduct">Agregar nuevo</a>
<hr>
<br>
<table class="table table-hover data-table" id="dataTable">
   <thead>
      <tr>
         <th>No</th>
         <th>Nombre</th>
         <th>Descripción</th>
         <th>Formúla</th>
         <th width="280px">Funciones</th>
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
                  <label for="name" class="control-label">Nombre de la lista</label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" id="name" name="name" placeholder="Ej. Lista A" value=""
                        maxlength="50" required="">
                  </div>

                  <label for="descripcion" class="control-label">Descripción</label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ej. Esta lista indica un descuento del 15%" value=""
                        maxlength="50" required="">
                  </div>

                  <label for="formaula" class="control-label">Formúla</label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" id="formaula" name="formaula" placeholder="Ej. -15%" value=""
                        maxlength="50" required="">
                  </div>

               </div>
               <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Guardar
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
      ajax: "{{ route('ajaxLista.index') }}",
      columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
         },
         {
            data: 'sLista',
            name: 'sLista'
         },
         {
            data: 'sDescripcion',
            name: 'sDescripcion'
         },
         {
            data: 'sFormula',
            name: 'sFormula'
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
      $('#saveBtn').val("Agregar lista");
      $('#product_id').val('');
      $('#accion').val("crear");
      $('#productForm').trigger("reset");
      $('#modelHeading').html("Crea nueva lista");
      $('#ajaxModel').modal('show');
   });

   $('body').on('click', '.editProduct', function() {
      var product_id = $(this).data('id');
      $.get("{{ route('ajaxLista.index') }}" + '/' + product_id + '/edit', function(data) {
         $('#modelHeading').html("Editar Lista");
         $('#saveBtn').val("Guardar cambios");
         $('#ajaxModel').modal('show');
         $('#product_id').val(data.kId);
         $('#accion').val("editar");
         $('#name').val(data.sLista);
         $('#descripcion').val(data.sDescripcion);
         $('#formaula').val(data.sFormula);
      })
   });

   $('#saveBtn').click(function(e) {
       
   $('#loading').show();
      e.preventDefault();
      $.ajax({
         data: $('#productForm').serialize(),
         url: "{{ route('ajaxLista.store') }}",
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
      var product_id = $(this).data("id");
      confirm("Estas seguro de que deseas eliminar esta lista?");
      $.ajax({
         type: "DELETE",
         url: "{{ route('ajaxLista.store') }}" + '/' + product_id,
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
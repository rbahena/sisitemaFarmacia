@extends('layouts.app')

@section('content')

<div class="container">
<div class="text-center">
<h3>Empleados</h3>
</div>
<a class="btn btn-success" href="javascript:void(0)" id="createNewProduct">Agregar empleado</a>
<hr>
<table class="table table-hover data-table" id="dataTable">
   <thead>
      <tr>
         <th>No</th>
         <th>Nombre</th>
         <th>Apellidos</th>
         <th>Tipo Empleado</th>
         <th width="280px">Accion</th>
      </tr>
   </thead>
   <tbody>
   </tbody>
</table>
</div>

@endsection
@section('script')
<script type="text/javascript">
$('.chosenPredictivo').chosen({
   width: '100%',
   placeholder_text_single: "Seleccione una opción",
   no_results_text: "No se encontró información a mostrar"
});
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
      ajax: "{{ route('ajaxEmpleado.index') }}",
      columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
         },
         {
            data: 'sNombre',
            name: 'sNombre'
         },
         {
            data: 'sApellidoPatterno',
            name: 'sApellidoPatterno'
         },
         {
            data: 'tipoEmpleado',
            name: 'tipoEmpleado',
            format: 'DD/MM/YYYY HH:mm',
            orderable: false,
            searchable: false
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
      $('#empleado_id').val('');
      $('#accion').val("crear");
      $('#dataForm').trigger("reset");
      $('#modelHeading').html("Agregar nuevo empleado");
      $('#ajaxModel').modal('show');
   });

   $('body').on('click', '.editProduct', function() {
      var empleado_id = $(this).data('id');
      $.get("{{ route('ajaxEmpleado.index') }}" + '/' + empleado_id + '/edit', function(data) {
         $('#modelHeading').html("Editar Empleado");
         $('#saveBtn').val("Guardar cambios");
         $('#ajaxModel').modal('show');
         $('#empleado_id').val(data.kId);
         $('#accion').val("editar");
         $('#name').val(data.sNombre);
         $('#apellidoPaterno').val(data.sApellidoPatterno);
         $('#apellidoMaterno').val(data.sApellidoMaterno);
         $('#domicilio').val(data.sDomicilio);
         $('#tipoEmpleado').val(data.iTipoEmpleado);
         $('#claveEmpleado').val(data.iCveEmpleado);
         $('#email').val(data.sCorreo);
         $('#telefono').val(data.sTelefono);
         $('#celular').val(data.sMovil);
         $('#fecha').val(data.fFechaAlta);
      })
   });

   $('#saveBtn').click(function(e) {
      $('#loading').show();
      debugger;
      console.log($('#dataForm').serialize());
      e.preventDefault();
      $.ajax({
         data: $('#dataForm').serialize(),
         url: "{{ route('ajaxEmpleado.store') }}",
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
      var empleado_id = $(this).data("id");
      confirm("Estas seguro de que deseas eliminar este registro?");
      $.ajax({
         type: "DELETE",
         url: "{{ route('ajaxEmpleado.store') }}" + '/' + empleado_id,
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
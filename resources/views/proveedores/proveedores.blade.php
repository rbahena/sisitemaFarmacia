@extends('layouts.app')

@section('content')
<div id="cabecera" hidden>
   <div class="container text-center">
      <h3>Agrega, consulta y/o edita los proveedores</h3>
   </div>
   <hr>
   <nav class="renglon form-inline col-md-5">
      <label for="inputClaveBusqueda">Clave del proveedor:</label>
      <input type="text" name="inputClaveBusqueda" id="inputClaveBusqueda" class="form-control col-md-3"
         placeholder="Ej. 001" value="">&nbsp;
      <button type="button" class="btn btn-primary" id="btnBurcarClave"><i class="fa fa-search"></i></button>
      <hr>
   </nav>
   <nav class="renglon">
      <div class="top-menu col-md-5">
         <div class="controls-mov">
            <button type="button" class="btn btn-primary controlDesplazamiento" id="btnPrimero"
               onclick="fnControles('ultimo',1)" title="Ultimo registro, registro más antiguo que se agregó"><i
                  class="fa fa-step-backward"></i></button>
            <button type="button" class="btn btn-primary controlDesplazamiento" id="btnAnterior"
               onclick="fnControles('anterior',0)" title="Avanza hacia el ultimo registro"><i
                  class="fa fa-fast-backward"></i></button>
            <button type="button" class="btn btn-primary controlDesplazamiento" id="btnSiguiente"
               onclick="fnControles('siguiente',0)" title="Avanza hacia el primer registro"><i
                  class="fa fa-fast-forward"></i></button>
            <button type="button" class="btn btn-primary controlDesplazamiento" id="btnUltimo"
               onclick="fnControles('primero',0)" title="Primer registro, registro más reciente que se agregó"><i
                  class="fa fa-step-forward"></i></button>
         </div>
         <a class="btn btn-success" href="{{ url('/ajaxProveedor') }}">Volver</a>
      </div>
   </nav>
   <hr>
</div>


<div class="container-fluid" id="contenido">
   <h3>Proveedores</h3>
   <button type="button" class="btn btn-success" id="createNewProduct" onclick="agregaProveedor()">Agregar
      proveedor</button>
   <hr>
   <table class="table data-table" id="dataTable">
      <thead>
         <tr>
            <th>No</th>
            <th>Razon social</th>
            <th>Clave del proveedor</th>
            <th width="280px">Accion</th>
         </tr>
      </thead>
      <tbody>
      </tbody>
   </table>
</div>

<div class="modal fade" id="modalDireccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ingresa los datos</h5>
            <button type="button" class="close" id="cerrarModal" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <!-- Modal para agregar direccion -->
         <div class="modal-body">
            <form>
               <div class="row">
                  <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <label for="selectPais">Pais*</label>
                        <select class="form-control chosenPredictivo enable-disabled" name="selectPais" id="selectPais"
                           required>
                           <option value="Elegir" id="AF">Elegir opción</option>
                           <option value="México" id="MX">Mexico</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <label for="selectEstado">Estado*</label>
                        <select class="form-control chosenPredictivo enable-disabled" name="selectEstado"
                           id="selectEstado" required>
                           <option value="Elegir" id="AF">Elegir opción</option>
                           <option value="DIF">Distrito Federal</option>
                           <option value="AGS">Aguascalientes</option>
                           <option value="BCN">Baja California</option>
                           <option value="BCS">Baja California Sur</option>
                           <option value="CAM">Campeche</option>
                           <option value="CHP">Chiapas</option>
                           <option value="CHI">Chihuahua</option>
                           <option value="COA">Coahuila</option>
                           <option value="COL">Colima</option>
                           <option value="DUR">Durango</option>
                           <option value="GTO">Guanajuato</option>
                           <option value="GRO">Guerrero</option>
                           <option value="HGO">Hidalgo</option>
                           <option value="JAL">Jalisco</option>
                           <option value="MEX">M&eacute;xico</option>
                           <option value="MIC">Michoac&aacute;n</option>
                           <option value="MOR">Morelos</option>
                           <option value="NAY">Nayarit</option>
                           <option value="NLE">Nuevo Le&oacute;n</option>
                           <option value="OAX">Oaxaca</option>
                           <option value="PUE">Puebla</option>
                           <option value="QRO">Quer&eacute;taro</option>
                           <option value="ROO">Quintana Roo</option>
                           <option value="SLP">San Luis Potos&iacute;</option>
                           <option value="SIN">Sinaloa</option>
                           <option value="SON">Sonora</option>
                           <option value="TAB">Tabasco</option>
                           <option value="TAM">Tamaulipas</option>
                           <option value="TLX">Tlaxcala</option>
                           <option value="VER">Veracruz</option>
                           <option value="YUC">Yucat&aacute;n</option>
                           <option value="ZAC">Zacatecas</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <label>Ciudad*</label>
                        <input type="text" class="form-control enable-disabled" id="inputCiudad" name="inputCiudad"
                           placeholder="Ej. CDMX" required>
                     </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <label>Municipio*</label>
                        <input type="text" class="form-control enable-disabled" id="inputMunicipio"
                           name="inputMunicipio" placeholder="Ej. Benito Juárez" required>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <label>Colonia*</label>
                        <input type="text" class="form-control enable-disabled" id="inputColonia" name="inputColonia"
                           placeholder="Ej. Narvarte" required>
                     </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <label>Calle*</label>
                        <input type="text" class="form-control enable-disabled" id="inputCalle" name="inputCalle"
                           placeholder="Ej. Eje Central" required>
                     </div>
                  </div>
               </div>


               <div class="row">
                  <div class="col-xs-12 col-md-3">
                     <div class="form-group">
                        <label># Interior</label>
                        <input type="number" class="form-control enable-disabled" id="inputNoInterior"
                           name="inputNoInterior" placeholder="Ej. 123">
                     </div>
                  </div>
                  <div class="col-xs-12 col-md-3">
                     <div class="form-group">
                        <label># Exterior*</label>
                        <input type="number" class="form-control enable-disabled" id="inputNoExterior"
                           name="inputNoExterior" placeholder="Ej. 789" required>
                     </div>
                  </div>
                  <div class="col-xs-12 col-md-6">
                     <div class="form-group">
                        <label>Codigo Postal*</label>
                        <input type="text" class="form-control enable-disabled" id="inputCP" name="inputCP"
                           placeholder="Ej. 13529" required>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="agregarDireccion" onclick="agregarDireccion()">Agregar
               dirección</button>
         </div>
         <!-- /Modal para agregar direccion -->

      </div>
   </div>
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
            data: 'sClaveProveedor',
            name: 'sClaveProveedor'
         },
         {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
         },
      ]
   });
});

function agregaProveedor() {
   $.ajax({
      type: 'get',
      url: 'agregaProveedor',
      success: function(data) {
         $("#cabecera").attr("hidden", false);
         $("#contenido").empty();
         $("#contenido").append(data.html);
         $('#loading').hide();
      },
      error: function(data) {
         $('#loading').hide();
      }
   });
}

function obtenerDetalleProveedor(id) {
   $('#loading').show();
   $.ajax({
      type: 'POST',
      url: "{{ route('ajaxProveedor.store') }}",
      data: {
         id: id,
         funcion: 'obtenerDetalle'
      },
      success: function(data) {
         $("#cabecera").attr("hidden", false);
         $("#contenido").empty();
         $("#contenido").append(data.html);
         $('#loading').hide();
      },
      error: function(data) {
         console.log('Error:', data);
         $('#loading').hide();
      }
   });
}

function guardarProveedor() {
   debugger;
   $('#loading').show();
   var array = [];
   var arrayProveedor = [];
   /* Obtenemos todos los tr del Body*/
   var rowsBody = $("#TablaDirecciones").find('tbody > tr');
   /* Obtenemos todos los th del Thead */
   var rowsHead = $("#TablaDirecciones").find('thead > tr > th');
   /* Iteramos sobre as filas del tbody*/
   for (var i = 0; i < rowsBody.length; i++) {
      var obj = {}; /* auxiliar*/
      for (var j = 0; j < rowsHead.length; j++) /*  Iteramos sobre los th de THead*/
         /*Asignamos como clave el text del th del thead*/
         /*Asignamos como Valor el text del tr del tbody*/
         obj[rowsHead[j].innerText] = rowsBody[i].getElementsByTagName('td')[j].innerText;
      array.push(obj); /* Añadimos al Array Principal*/
   }
   var dataProveedor = $('#proveedorForm').serializeArray();
   for (var i = 0; i < dataProveedor.length; i++) {
      var obj = {};
      obj[dataProveedor[i]['name']] = dataProveedor[i]['value'];
      arrayProveedor.push(obj);
   }

   console.log(arrayProveedor);
   if (array.length <= 0) {
      alert("Debe ingresar al menos 1 dirección");
      $('#loading').hide();
   } else {
      $.ajax({
         type: 'POST',
         url: "{{ route('ajaxProveedor.store') }}",
         data: {
            form: arrayProveedor,
            direcciones: array,
            funcion: 'crear'
         },
         success: function(data) {
            console.log(data);
            $("#contenido").empty();
            $("#contenido").append(data.html);
            $('#loading').hide();
            alert("Registro agregado correctamente");
         },
         error: function(data) {
            console.log('Error:', data);
            $('#loading').hide();
         }
      });
   }
}

function actualizarProveedor() {
   debugger;
   var id = $("#idProveedor").val();
   $('#loading').show();
   var array = [];
   var arrayProveedor = [];
   /* Obtenemos todos los tr del Body*/
   var rowsBody = $("#TablaDirecciones").find('tbody > tr');
   /* Obtenemos todos los th del Thead */
   var rowsHead = $("#TablaDirecciones").find('thead > tr > th');
   /* Iteramos sobre as filas del tbody*/
   for (var i = 0; i < rowsBody.length; i++) {
      var obj = {}; /* auxiliar*/
      for (var j = 0; j < rowsHead.length; j++) /*  Iteramos sobre los th de THead*/
         /*Asignamos como clave el text del th del thead*/
         /*Asignamos como Valor el text del tr del tbody*/
         obj[rowsHead[j].innerText] = rowsBody[i].getElementsByTagName('td')[j].innerText;
      array.push(obj); /* Añadimos al Array Principal*/
   }
   var dataProveedor = $('#proveedorForm').serializeArray();
   for (var i = 0; i < dataProveedor.length; i++) {
      var obj = {};
      obj[dataProveedor[i]['name']] = dataProveedor[i]['value'];
      arrayProveedor.push(obj);
   }

   console.log(arrayProveedor);
   if (array.length <= 0) {
      alert("Debe ingresar al menos 1 dirección");
      $('#loading').hide();
   } else {
      $.ajax({
         type: 'POST',
         url: "{{ route('ajaxProveedor.store') }}",
         data: {
            form: arrayProveedor,
            direcciones: array,
            id: id,
            funcion: 'editar'
         },
         success: function(data) {
            console.log(data);
            $("#contenido").empty();
            $("#contenido").append(data.html);
            $('#loading').hide();
            alert("Registro actualizado correctamente.");
         },
         error: function(data) {
            console.log('Error:', data);
            $('#loading').hide();
         }
      });
   }
}

function agregarDireccion() {
   debugger;
   var rowCount = $('#TablaDirecciones >tbody >tr').length
   var pais = ($("#selectPais option:selected").text() !== 'Elegir opción') ? $(
      "#selectPais option:selected").text() : '';
   var estado = ($("#selectEstado option:selected").text() !== 'Elegir opción') ? $(
      "#selectEstado option:selected").text() : '';
   var ciudad = ($("#inputCiudad").val() !== '') ? $("#inputCiudad").val() : '';
   var Municipio = ($("#inputMunicipio").val() !== '') ? $("#inputMunicipio").val() : '';
   var colonia = ($("#inputColonia").val() !== '') ? $("#inputColonia").val() : '';
   var calle = ($("#inputCalle").val() !== '') ? $("#inputCalle").val() : '';
   var NoInterior = ($("#inputNoInterior").val() !== '') ? $("#inputNoInterior").val() : '';
   var NoExterior = ($("#inputNoExterior").val() !== '') ? $("#inputNoExterior").val() : '';
   var Cp = ($("#inputCP").val() !== '') ? $("#inputCP").val() : '';
   $('#loading').show();
   var htmlTags = '<tr id="r' + rowCount + '">' +
      '<td>' + pais + '</td>' +
      '<td>' + estado + '</td>' +
      '<td>' + ciudad + '</td>' +
      '<td>' + Municipio + '</td>' +
      '<td>' + colonia + '</td>' +
      '<td>' + calle + '</td>' +
      '<td>' + NoInterior + '</td>' +
      '<td>' + NoExterior + '</td>' +
      '<td>' + Cp + '</td>' +
      '<td><button type="submit" class="btn btn-default" onclick="eliminarDireccion(\'#r' + rowCount +
      '\')"><i class="fas fa-trash-alt enable-disabled"></i></button></td>' +
      '</tr>';
   $('#TablaDirecciones tbody').append(htmlTags);
   $("#direccionesProveedor").removeAttr('hidden');
   $('#loading').hide();
   $('#cerrarModal').click();
}

function eliminarDireccion(row) {
   $(row).remove();
}

function editarProveedor() {
   debugger;
   $("input").removeAttr("disabled");
   $("button").removeAttr("disabled");
}

function fnControles(control, id) {
   debugger;
   $('#loading').show();
   if (id != 1)
      id = $("#idProveedor").val();

   if (id == '')
      id = 0;

   $.ajax({
      type: 'get',
      url: 'obtenerArticuloCtrl/{id}/{control}',
      data: {
         id: id,
         control: control
      },
      success: function(data) {
         $("#contenido").empty();
         $("#contenido").append(data.html);
         $('#loading').hide();
         alert("Proveedor recuperado exitosamente");
      },
      error: function(data) {
         var errors = data.responseJSON;
         console.table(errors);
         $('#loading').hide();
      }
   });
}
</script>
@endsection
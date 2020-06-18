@extends('layouts.app')
@section('content')
<div id="herramientasBusqueda">
   <div class="container text-center">
      <h3>Agrega, consulta y/o edita las ordenes de compra</h3>
   </div>
   <hr>
   <nav class="renglon form-inline col-md-5">
      <label for="inputClaveBusqueda">Numero de factura:</label>
      <input type="text" name="inputClaveBusqueda" id="inputClaveBusqueda" class="form-control col-md-3"
         placeholder="Ej. 000001" value="">&nbsp;
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

<div id="ordenCompra" class="container-fluid">
   <form id="formPrimeraSeccion">
      <div id="primeraSeccion">
         <div class="row">
            <div class="col-xs-12 col-md-4">
               <div class="form-group">
                  <label for="selectProveedor">Clave Proveedor*</label>
                  <select class="form-control chosenPredictivo enable-disabled" name="selectProveedor"
                     id="selectProveedor" required>
                     <option selected="true" disabled="disabled">Seleccionar una opción</option>
                     @foreach($proveedores as $proveedor)
                     <option value='{{$proveedor->kId}}'>{{$proveedor->sClaveProveedor}} / {{$proveedor->sRazonSocial}}
                     </option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-xs-12 col-md-4">
               <div class="form-group">
                  <label for="numeroOrden">Numero de Orden*</label>
                  <input type="number" class="form-control enable-disabled" id="inputNumeroOrden"
                     name="inputNumeroOrden" placeholder="Ej: 000001" disabled>
               </div>
            </div>
            <div class="col-xs-12 col-md-4">
               <div class="form-group">
                  <label for="fechaContabilizacion">Fecha contabilización</label>
                  <input type="date" class="form-control enable-disabled" id="inputFechaContabilizacion"
                     name="inputFechaContabilizacion" disabled>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-md-4">
               <div class="form-group">
                  <label for="razonSocial">Razon social*</label>
                  <input type="text" class="form-control enable-disabled" id="inputRazonSocial" name="inputRazonSocial"
                     placeholder="Ej: PROVEEDOR S.A. DE C.V." disabled>
               </div>
            </div>
            <div class="col-xs-12 col-md-4">
               <div class="form-group">
                  <label for="estatusOrden">Estatus de Orden</label>
                  <select class="form-control chosenPredictivo enable-disabled" name="selectEstatusOrden"
                     id="selectEstatusOrden" disabled>
                     <option value="1"><strong>PENDIENTE</strong></option>
                     <option value="2"><strong>COMPLETADA</strong></option>
                  </select>
               </div>

            </div>
            <div class="col-xs-12 col-md-4">
               <div class="form-group">
                  <label for="fechaEntrega">Fecha de entrega</label>
                  <input type="date" class="form-control enable-disabled" id="inputFechaEntrega"
                     name="inputFechaEntrega" required>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-md-4">
               <div class="form-group">
                  <label for="personaContacto">Persona de contacto*</label>
                  <input type="text" class="form-control enable-disabled" id="inputPersonaContacto"
                     name="inputPersonaContacto" placeholder="Ej: LUIS CUEVAS" disabled>
               </div>
            </div>
            <div class="col-xs-12 col-md-4">
               <div class="form-group">
                  <label for="numeroFactura">Numero de factura*</label>
                  <input type="text" class="form-control enable-disabled" id="inputNumeroFactura"
                     name="inputNumeroFactura" placeholder="Ej: ABC-0001" required>
               </div>
            </div>
            <div class="col-xs-12 col-md-4">
               <div class="form-group">
                  <label for="fechaDocumento">Fecha de documento</label>
                  <input type="date" class="form-control enable-disabled" id="inpurFechaDocumento"
                     name="inputFechaDocumento" required>
               </div>
            </div>
         </div>
      </div>
   </form>
   <br>
   <div id="formSegundaSeccion">
      <button type="button" class="btn btn-primary" id="agregarRow"><i class="fas fa-plus"></i>
         Agregar producto</button>
      <br>
      <table class="table table-bordered" id="tableProdcutosOrden">
         <thead>
            <tr>
               <th scope="col"></th>
               <th scope="col">% de Descuento</th>
               <th scope="col">Almacén&nbsp;destino</th>
               <th scope="col">Clave&nbsp;del&nbsp;producto</th>
               <th scope="col">Descripción&nbsp;del&nbsp;producto</th>
               <th scope="col">Articulos&nbsp;por&nbsp;unidad</th>
               <th scope="col">Unidades</th>
               <th scope="col">Impuesto</th>
               <th scope="col">Precio&nbsp;compra</th>
               <th scope="col">Total</th>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>
   </div>

   <br>
   <form id="formTercerSeccion">
      <div id="terceSeccion">
         <div class="row">
            <div class="col-xs-12 col-md-4">
               <label for="encargadoCompra">Encargado de compra*</label>
               <select class="form-control chosenPredictivo enable-disabled" name="selectEncargadoCompra"
                  id="selectEncargadoCompra" required>
                  <option selected="true" disabled="disabled">Seleccionar una opción</option>
                  @foreach($empleados as $empleado)
                  <option value='{{$empleado->kId}}'>{{$empleado->sNombre}} {{$empleado->sApellidos}}</option>
                  @endforeach
               </select>
            </div>
            <div class="col-xs-12 col-md-5">
            </div>
            <div class="col-xs-12 col-md-3">
               <label for="totalAntesDescuento">Total antes del descuento</label>
               <input type="number" class="form-control enable-disabled" id="inputTotalAntesDescuento"
                  name="inputTotalAntesDescuento" disabled>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-md-4">
               <label for="inputComentarios">Comentarios adicionales</label>
               <textarea class="form-control enable-disabled" id="inputComentarios" name="inputComentarios" rows="2"
                  placeholder="Ingresa comentarios relacionados a la orden de compra"></textarea>
            </div>
            <div class="col-xs-12 col-md-5">
            </div>
            <div class="col-xs-12 col-md-3">
               <label for="descuentoGral">Descuento</label>
               <div class="form-inline">
                  <input type="text" class="form-control enable-disabled col-md-1" required>
                  <h5><strong>&nbsp;%&nbsp; </strong></h5>
                  <input type="number" class="form-control enable-disabled col-md-9" id="inputDescuentoGral"
                     name="inputDescuentoGral" disabled>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-md-4">
            </div>
            <div class="col-xs-12 col-md-5">
            </div>
            <div class="col-xs-12 col-md-3">
               <label for="impuesto">Impuesto</label>
               <input type="number" class="form-control enable-disabled" id="inputImpuesto" name="inputImpuesto"
                  disabled>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-md-4">
            </div>
            <div class="col-xs-12 col-md-5">
            </div>
            <div class="col-xs-12 col-md-3">
               <label for="totalPagoVencido">Total pago vencido</label>
               <input type="number" class="form-control enable-disabled" id="inputTotalPagoVencido"
                  name="inputTotalPagoVencido" disabled>

            </div>
         </div>
      </div>
   </form>

   <div class="renglon" id="btnAcciones">
      <a class="btn btn-danger btnAcciones" href="{{ url('/ajaxProveedor') }}">Cancelar</a>
      <button type="button" class="btn btn-warning btnAcciones" id="btnEditar"
         onclick='editarProveedor()'>Editar</button>
      <button type="button" class="btn btn-success btnAcciones" id="btnGuardar" disabled
         onclick='actualizarProveedor()'>Guardar</button>
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
   $("#agregarRow").click();
});

$("#selectProveedor").change(function() {
   $('#loading').show();
   var idProveedor = $("#selectProveedor").val();
   $.ajax({
      type: 'get',
      url: 'obtenerDatosProveedor/{id}',
      data: {
         id: idProveedor
      },
      success: function(data) {
         debugger;
         if (data.success == 'true') {
            $("#inputRazonSocial").val(data.razonSocial['sRazonSocial']);
            $("#inputPersonaContacto").val(data.personaContacto['sPersonaContacto']);
         }
         $('#loading').hide();
      },
      error: function(data) {
         var errors = data.responseJSON;
         console.table(errors);
         $('#loading').hide();
      }
   });
});

function obtenDetalleProd(indice) {
   debugger;
   $('#loading').show();
   var id = "#selectClaveProducto" + indice;
   var idProducto = $(id).val();
   $.ajax({
      type: 'get',
      url: 'obtenerDatosProducto/{id}',
      data: {
         id: idProducto
      },
      success: function(data) {
         debugger;
         if (data.success == 'true') {
            $("#inputDescProducto_" + indice).val(data.data['sDescripcion'])
            $("#inputPrecio_" + indice).val(data.data['dPrecioCompra'])
            if (data.data['bImpIva'] != '0') {
               $("#checkImpuesto_" + indice).toggleClass('fa-circle fa-check-circle');
            }
         }
         $('#loading').hide();
      },
      error: function(data) {
         var errors = data.responseJSON;
         console.table(errors);
         $('#loading').hide();
      }
   });
}

$("#agregarRow").click(function() {
   $('#loading').show();
   var almacenes = getAlmacenes();
   var productos = getProductos();
   var rowCount = $('#tableProdcutosOrden >tbody >tr').length + 1;
   // var rowCount = $('table#productosOrdenCompra tr:last').index() + 1;
   nvoRegistro =
      '<tr id="row_' + rowCount + '">' +
      '<th scope="row">' + rowCount + '</th>' +
      '<td><input type="number" class="form-control enable-disabled" id="inputPorcientoDescuento_' + rowCount +
      '" name="inputPorcientoDescuento_' + rowCount + '" placeholder="Ej: 15"></td>' +
      '<td> <select name="selectAlmacen_' + rowCount + '" id="selectAlmacen_' + rowCount +
      '" class="form-control chosenPredictivo">' +
      almacenes +
      '</select></td>' +
      '<td><select name="selectClaveProducto_' + rowCount + '" id="selectClaveProducto' + rowCount +
      '" class="form-control chosenPredictivo" onchange="obtenDetalleProd(' + rowCount + ');">' +
      productos +
      '</select></td>' +
      '<td> <input type="text" class="form-control enable-disabled" id="inputDescProducto_' + rowCount +
      '" name="inputDescProducto_' + rowCount + '" placeholder="ej. Tabletas 90.10 Grms" disabled></td>' +
      '<td> <input type="number" class="form-control enable-disabled" id="inputArtiXunidad_' + rowCount +
      '" name="inputArtiXunidad_' + rowCount + '" placeholder="Ej: 1000"></td>' +
      '<td> <input type="number" class="form-control enable-disabled" id="inputUnidades_' + rowCount +
      '" name="inputUnidades_' + rowCount + '" placeholder="ej. 40"></td>' +
      '<td> <div class="text-center"> <i class="far fa-circle bigIcon" id="checkImpuesto_' + rowCount +
      '" name ="checkImpuesto_' + rowCount + '" title="Si aplica impuesto"></i> </div> </td>' +
      '<td> <input type="number" class="form-control enable-disabled" id="inputPrecio_' + rowCount +
      '" name="inputPrecio_' + rowCount + '" placeholder="Ej: 35.00" disabled></td>' +
      '<td> <input type="number" class="form-control enable-disabled" id="inputTotal_' + rowCount +
      '" name="inputTotal_' + rowCount + '" placeholder="Ej: 105.00" disabled></td>' +
      '<td> <i class="far fa-save bigIcon" title="Guardar cambios" id="guardar_' + rowCount + '" name="guardar_' +
      rowCount + '"></i></td>' +
      '</tr>';
   $('#tableProdcutosOrden tbody').append(nvoRegistro);
   $('.chosenPredictivo').trigger("chosen:updated");
   $('#loading').hide();
});

function getAlmacenes() {
   var selectAlmacen = '<option selected="true" disabled="disabled">Seleccionar una opción</option>';
   $.ajax({
      async: false,
      type: "post",
      url: 'obtenerAlmacenes',
      success: function(data) {
         $.each(data, function(key, almacen) {
            selectAlmacen = selectAlmacen + '<option value=' + almacen.kId + '>' + almacen.sAlmacen +
               '</option>';
         });
      },
      error: function(data) {
         console.log(data);
         alert('error');
      }
   });
   return selectAlmacen;
}

function getProductos() {
   var selectProductos = '<option selected="true" disabled="disabled">Seleccionar una opción</option>';
   $.ajax({
      async: false,
      type: "post",
      url: 'obtenerProductos',
      success: function(data) {
         $.each(data, function(key, producto) {
            selectProductos = selectProductos + '<option value=' + producto.kId + '>' + producto
               .sArticulo +
               '</option>';
         });
      },
      error: function(data) {
         console.log(data);
         alert('error');
      }
   });
   return selectProductos;
}
</script>
@endsection

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
   <form id="formOrdenCompra">
      <div id="primeraSeccion">
         <div class="row">
            <div class="col-xs-12 col-md-4">
               <div class="form-group">
                  <label for="selectProveedor">Clave Proveedor*</label>
                  <select class="form-control chosenPredictivo enable-disabled" name="selectProveedor"
                     id="selectProveedor" required>
                     <option value="Elegir" id="AF">Elegir opción</option>
                     <option value="1">P-001</option>
                  </select>
               </div>
            </div>
            <div class="col-xs-12 col-md-4">
               <div class="form-group">
                  <label for="numeroOrden">Numero de Orden*</label>
                  <input type="number" class="form-control enable-disabled" id="inputNumeroOrden"
                     name="inputNumeroOrden" placeholder="Ej: 000001" required autocomplete="off">
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
                     <option value="Elegir" id="AF">Elegir opción</option>
                     <option value="1">Abierta</option>
                     <option value="2">Pendiente</option>
                     <option value="3">Completada</option>
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
                  <input type="text" class="form-control enable-disabled" id="personaContacto" name="personaContacto"
                     placeholder="Ej: LUIS CUEVAS" disabled>
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
      <br>
      <div id="tablaOrdenCompra">
         <small class="form-text text-muted enable-disabled" style="cursor: pointer;" id="but_add"><i
               class="fas fa-plus"></i><a disabled>&nbsp;&nbsp; Haz clic para agregar
               una fila más a la tabla
            </a></small>
         <br>
         <table class="table" id="makeEditable">
            <thead>
               <tr>
                  <th>% de descuento</th>
                  <th>Almacén</th>
                  <th>Articulos por unidad</th>
                  <th>Unidades</th>
                  <th>Clave del producto</th>
                  <th>Descripción del articulo</th>
                  <th>Impuestos</th>
                  <th>Precio</th>
                  <th>Total</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>0.00</td>
                  <td></td>
                  <td>0.00</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
               </tr>
            </tbody>
         </table>
      </div>
      <br>
      <div id="segundaSeccion">
         <div class="row">
            <div class="col-xs-12 col-md-4">
               <label for="encargadoCompra">Encargado de compra*</label>
               <select class="form-control chosenPredictivo enable-disabled" name="selectEncargadoCompra"
                  id="selectEncargadoCompra" required>
                  <option value="Elegir" id="AF">Elegir opción</option>
                  <option value="1">Luis</option>
                  <option value="2">Raul</option>
                  <option value="3">Omar</option>
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

$('#makeEditable').SetEditable({
   $addButton: $('#but_add'),
   onEdit: function() {},
   onDelete: function() {},
   onBeforeDelete: function() {},
   onAdd: function() {
      
   }
});
</script>


@endsection
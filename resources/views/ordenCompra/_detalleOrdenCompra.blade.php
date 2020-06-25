<form id="formPrimeraSeccion">
   <h1>detalle</h1>
   <div class="row">
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label for="selectProveedor">Clave Proveedor*</label>
            <select class="form-control chosenPredictivo enable-disabled" name="selectProveedor" id="selectProveedor"
               required disabled>
               <option disabled="disabled">Seleccionar una opción</option>
               @foreach($proveedores as $proveedor)
               @if($proveedor->kId == $ordenCompra->IdProveedor)
               <option value='{{$proveedor->kId}}' selected>{{$proveedor->sClaveProveedor}} /
                  {{$proveedor->sRazonSocial}}
               </option>
               @else
               <option value='{{$proveedor->kId}}'>{{$proveedor->sClaveProveedor}} / {{$proveedor->sRazonSocial}}
               </option>
               @endif
               @endforeach
            </select>
         </div>
      </div>
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label for="numeroOrden">Numero de Orden*</label>
            <input type="number" class="form-control enable-disabled" id="inputNumeroOrden" name="inputNumeroOrden"
               placeholder="Ej: 000001" disabled
               value="{{!empty($ordenCompra->sOrdenCompra) ? $ordenCompra->sOrdenCompra: ''}}">
         </div>
      </div>
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label for="fechaContabilizacion">Fecha contabilización</label>
            <input type="text" class="form-control enable-disabled" id="inputFechaContabilizacion"
               name="inputFechaContabilizacion" disabled
               value="{{!empty($ordenCompra->fFechaContabilizacion) ? \Carbon\Carbon::parse($ordenCompra->fFechaContabilizacion)->format('d/m/Y'): ''}}">
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label for="razonSocial">Razon social*</label>
            <input type="text" class="form-control enable-disabled" id="inputRazonSocial" name="inputRazonSocial"
               placeholder="Ej: PROVEEDOR S.A. DE C.V." disabled
               value="{{!empty($ordenCompra->sRazonSocial) ? $ordenCompra->sRazonSocial: ''}}">
         </div>
      </div>
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label for="estatusOrden">Estatus de Orden</label>
            <select class="form-control chosenPredictivo enable-disabled" name="selectEstatusOrden"
               id="selectEstatusOrden" disabled>
               @if($ordenCompra->bEstatus == 1)
               <option value="1" selected><strong>PENDIENTE</strong></option>
               @else
               <option value="2" selected><strong>COMPLETADA</strong></option>
               @endif
            </select>
         </div>

      </div>
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label for="fechaEntrega">Fecha de entrega*</label>
            <input type="text" class="form-control enable-disabled" id="inputFechaEntrega" name="inputFechaEntrega"
               required
               value="{{!empty($ordenCompra->fFechaFinalizacion) ? \Carbon\Carbon::parse($ordenCompra->fFechaFinalizacion)->format('d/m/Y'): ''}}">
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label for="personaContacto">Persona de contacto*</label>
            <input type="text" class="form-control enable-disabled" id="inputPersonaContacto"
               name="inputPersonaContacto" placeholder="Ej: LUIS CUEVAS" disabled
               value="{{!empty($ordenCompra->sPersonaContacto) ? $ordenCompra->sPersonaContacto: ''}}">
         </div>
      </div>
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label for="numeroFactura">Numero de factura*</label>
            <input type="text" class="form-control enable-disabled" id="inputNumeroFactura" name="inputNumeroFactura"
               placeholder="Ej: ABC-0001" required
               value="{{!empty($ordenCompra->sNumReferencia) ? $ordenCompra->sNumReferencia: ''}}">
         </div>
      </div>
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label for="fechaDocumento">Fecha de documento*</label>
            <input type="text" class="form-control enable-disabled" id="inpurFechaDocumento" name="inputFechaDocumento"
               required
               value="{{!empty($ordenCompra->fFechaDocumento) ? \Carbon\Carbon::parse($ordenCompra->fFechaDocumento)->format('d/m/Y'): ''}}">
         </div>
      </div>
   </div>
</form>
<br>

<div id="tablaProductos">
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
            <th scope="col">Total&nbsp;compra</th>
         </tr>
      </thead>
      <tbody>
         @foreach($pedidos as $pedido)
         <tr id="row_{{$loop->index}}">
            <th scope="row">{{$loop->index}}</th>
            <td>
               <input type="number" class="form-control enable-disabled" id="inputPorcientoDescuento_{{$loop->index}}"
                  name="inputPorcientoDescuento_{{$loop->index}}"
                  value="{{!empty($pedido->iPorcentajeDescuento) ? $pedido->iPorcentajeDescuento: ''}}">
            </td>
            <td>
               <select name="selectAlmacen_{{$loop->index}}" id="selectAlmacen_{{$loop->index}}"
                  class="form-control chosenPredictivo">
               </select>
            </td>
            <td>
               <select name="selectClaveProducto_{{$loop->index}}" id="selectClaveProducto_{{$loop->index}}"
                  class="form-control chosenPredictivo" onchange="obtenDetalleProd('{{$loop->index}}');">
               </select>
            </td>
            <td>
               <input type="text" class="form-control enable-disabled" id="inputDescProducto_{{$loop->index}}"
                  name="inputDescProducto_{{$loop->index}}"
                  value="{{!empty($pedido->sArticulo) ? $pedido->sArticulo: ''}}" disabled>
            </td>
            <td>
               <input type="number" class="form-control enable-disabled" id="inputArtiXunidad_{{$loop->index}}"
                  name="inputArtiXunidad_{{$loop->index}}"
                  value="{{!empty($pedido->iPiezasPorUnidad) ? $pedido->iPiezasPorUnidad: ''}}">
            </td>
            <td>
               <input type="number" class="form-control enable-disabled" id="inputUnidades_{{$loop->index}}"
                  name="inputUnidades_{{$loop->index}}" onchange="calculaTotal('{{$loop->index}}');"
                  value="{{!empty($pedido->iCantidadPorUnidad) ? $pedido->iCantidadPorUnidad: ''}}">
            </td>
            <td>
               <div class="text-center"> <i class="far fa-circle bigIcon" id="checkImpuesto_{{$loop->index}}"
                     name="checkImpuesto_{{$loop->index}}" title="Si aplica impuesto"></i>
               </div>
            </td>
            <td>
               <input type="number" class="form-control enable-disabled" id="inputPrecio_{{$loop->index}}"
                  name="inputPrecio_{{$loop->index}}" placeholder="Ej: 35.00" disabled>
            </td>
            <td>
               <input type="number" class="form-control enable-disabled" id="inputTotal_{{$loop->index}}"
                  name="inputTotal_{{$loop->index}}" placeholder="Ej: 105.00" disabled>
            </td>
            <td>
               <i class="far fa-save bigIcon" title="Guardar cambios" id="guardar_{{$loop->index}}"
                  name="guardar_{{$loop->index}}" onclick="guardarRow('{{$loop->index}}')" style="cursor: pointer;"></i>
               <i class="fas fa-edit bigIcon" title="Editar Cambios" id="editar_{{$loop->index}}"
                  name="editar_{{$loop->index}}" onclick="editarRow('{{$loop->index}}');" style="cursor: pointer;"
                  hidden></i>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>

<br>
<form id="formTercerSeccion">
   <div class="row">
      <div class="col-xs-12 col-md-4">
         <label for="encargadoCompra">Encargado de compra*</label>
         <select class="form-control chosenPredictivo enable-disabled" name="selectEncargadoCompra"
            id="selectEncargadoCompra" required>
            <option disabled="disabled">Seleccionar una opción</option>
            @foreach($empleados as $empleado)
            @if($empleado->kId == $ordenCompra->IdEmpleadoCompra)
            <option value='{{$empleado->kId}}' selected>{{$empleado->sNombre}} {{$empleado->sApellidos}}
            </option>
            @else
            <option value='{{$empleado->kId}}'>{{$empleado->sNombre}} {{$empleado->sApellidos}}</option>
            @endif
            @endforeach
         </select>
      </div>
      <div class="col-xs-12 col-md-5">
      </div>
      <div class="col-xs-12 col-md-3">
         <label for="totalAntesDescuento">Total antes del descuento</label>
         <input type="number" class="form-control enable-disabled" id="inputTotalAntesDescuento"
            name="inputTotalAntesDescuento" disabled value="5000">
      </div>
   </div>
   <div class="row">
      <div class="col-xs-12 col-md-4">
         <label for="inputComentarios">Comentarios adicionales</label>
         <textarea class="form-control enable-disabled" id="inputComentarios" name="inputComentarios" rows="2"
            placeholder="Ingresa comentarios relacionados a la orden de compra">{{ $ordenCompra->sComentario}}</textarea>
      </div>
      <div class="col-xs-12 col-md-5">
      </div>
      <div class="col-xs-12 col-md-3">
         <label for="descuentoGral">Descuento</label>
         <div class="form-inline">
            <input type="text" class="form-control enable-disabled col-md-2" required value="50">
            <h5><strong>&nbsp;%&nbsp; </strong></h5>
            <input type="number" class="form-control enable-disabled col-md-9" id="inputDescuentoGral"
               name="inputDescuentoGral" disabled value="2500">
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
         <input type="number" class="form-control enable-disabled" id="inputImpuesto" name="inputImpuesto" disabled
            value="16">
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
            name="inputTotalPagoVencido" disabled value="2300">

      </div>
   </div>
</form>
<table class="table table-bordered" id="tableOrden" hidden>
   <thead>
      <tr>
         <th scope="col">% de Descuento</th>
         <th scope="col">Almacén&nbsp;destino</th>
         <th scope="col">Clave&nbsp;del&nbsp;producto</th>
         <th scope="col">Articulos&nbsp;por&nbsp;unidad</th>
         <th scope="col">Unidades</th>
         <th scope="col">Total&nbsp;compra</th>
      </tr>
   </thead>
   <tbody>
   </tbody>
</table>
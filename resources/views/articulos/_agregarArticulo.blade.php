@extends('layouts.app')

@section('content')
<div class="container text-center">
   <h3>Agrega, consulta o edita los productos del inventario</h3>
</div>
<hr>
<nav class="renglon">
   <label for="clave">Clave de producto:</label>
   <input type="text" name="nombre" id="txbClave" class="input-control" value="">
   <!-- <Label class="lbFrame"></Label> -->
   <button type="button" class="boton btn-blue" id="btnBurcarClaveProd"><i class="fa fa-search"></i></button>
   <hr>
</nav>
<nav class="renglon">
   <div class="top-menu">
      <div class="controls-mov">
         <!-- <button type="button" class="boton btn-blue" id="btnBurcar">Buscar</button> -->
         <button type="button" class="boton btn-blue" id="btnAnterior"><i class="fa fa-step-backward"></i></button>
         <button type="button" class="boton btn-blue" id="btnPrimero"><i class="fa fa-fast-backward"></i></button>
         <button type="button" class="boton btn-blue" id="btnSiguiente"><i class="fa fa-fast-forward"></i></button>
         <button type="button" class="boton btn-blue" id="btnUltimo"><i class="fa fa-step-forward"></i></button>
      </div>
      <button type="button" class="boton btn-green" id="btnNuevo">Crear Nuevo</button>
   </div>
   <div class="text-right">
      <label class="">Sucursal:</label>
      <label class="lbFrame">Central</label>
   </div>
</nav>
<hr>
<form id="detalleArticulo" name="detalleArticulo">
   <section id="principal">
      <div class="frmPrincipal">
         <div class="renglon col-md-12">
            <label class="inClave">Clave </label>
            <input type="text" name="inClave" id="inClave" class="input-control not-active" required value="">

            <label class="inDescripc">Descripción </label>
            <input type="text" id="inDescripc" name="inDescripc" class="input-control not-active" required value="">
         </div>

         <div class="renglon col-md-12">
            <label class="inSustan">Sustancia </label>
            <input type="text" name="inSustan" id="inSustan" class="input-control not-active" value="">

            <label class="inPresent">Presentación </label>
            <input type="text" name="inPresent" id="inPresent" class="input-control not-active" value="" required>

            <label class="inBarCade">Codigo de Barras </label>
            <input type="text" name="inBarCade" id="inBarCade" class="input-control not-active" value="" required>
         </div>

         <div class="renglon col-md-12">
            <label class="inFecCad">Fecha de Caducidad </label>
            <input type="date" name="inFecCad" id="inFecCad" class="input-control not-active" value="" required>

            <label class="inDepart">Departamento </label>
            <select name="lstDepart" id="lstDepart" class="not-active" required>
               <option value="0">Seleccionar</option>
               @foreach($departamentos as $departamento)
               <option value='{{$departamento->kId}}'>{{$departamento->sDescripcion}}</option>
               @endforeach
            </select>

            <label class="inLab">Laboratorio </label>
            <select name="inLab" id="inLab" class="not-active" required>
               <option value="0">Seleccionar</option>
               @foreach($laboratorios as $laboratorio)
               <option value='{{$laboratorio->kId}}'>{{$laboratorio->sDescripcion}}</option>
               @endforeach
            </select>
         </div>

         <div class="renglon col-md-12">
            <label class="inSATCode">Codigó de unidad de medida SAT</label>
            <select name="inSATCode" id="inSATCode" class="not-active" required>
               <option value="0">Seleccionar</option>
               @foreach($medidaSAT as $medida)
               <option value='{{$medida->kId}}'>{{$medida->sNombre}}</option>
               @endforeach
            </select>

            <label class="inSATProd">Codigó de producto SAT</label>
            <input type="text" name="inSATProd" id="inSATProd" class="input-control not-active" value="">
         </div>

         <div class="renglon col-md-12">
            <label for="inStockMin">Stock Min</label>
            <input type="number" name="inStockMin" id="inStockMin" class="input-control col-md-1 not-active" value=""
               required>
            <label for="inStockMax">Stock Max</label>
            <input type="number" name="inStockMax" id="inStockMax" class="input-control col-md-1 not-active" value=""
               required>
            <label for="inPreComp">Precio de Compra</label>
            <input type="text" name="inPreComp" id="inPreComp" class="input-control col-md-1 not-active" value="">
            <label for="inPrePub">Precio a Publico</label>
            <input type="text" name="inPrePub" id="inPrePub" class="input-control col-md-1 not-active" value="">
         </div>
         <!-- <div class="renglon">
            <label for="lsPrecios">Lista de Precios:</label>
            <select name="lsPrecios" class="" >
               <option value="0"></option>
            </select>
            <label class="lbFrame">Vacio</label>
         </div> -->

      </div>
      <aside>
         <ul>
            <li>Articulo de Inventario <input type="checkbox" name="artInv" id="artInv" class="not-active check"></li>
            <input type="text" name="inArticuloInventario" id="inArticuloInventario"
               class="input-control col-md-1 not-active" value="" hidden>

            <li>Articulo de Compra <input type="checkbox" name="artComp" id="artComp" class="not-active check"></li>
            <input type="text" name="inArticuloCompra" id="inArticuloCompra" class="input-control col-md-1 not-active"
               value="" hidden>

            <li>Articulo de Venta <input type="checkbox" name="artVenta" id="artVenta" class="not-active check"></li>
            <input type="text" name="inArticuloVenta" id="inArticuloVenta" class="input-control col-md-1 not-active"
               value="" hidden>

            <li>Impuesto IVA 16% <input type="checkbox" name="artIVA" id="artIVA" class="not-active check"></li>
            <input type="text" name="inArticuloIVA" id="inArticuloIVA" class="input-control col-md-1 not-active"
               value="" hidden>

            <li>Activo<input type="checkbox" name="artActive" id="artActive" class="not-active" checked disabled></li>
            <input type="text" name="inArticuloActivo" id="inArticuloActivo" class="input-control col-md-1 not-active"
               value="1" hidden>
         </ul>
         <div class="frameImage">

         </div>
      </aside>
   </section>

</form>
<div class="renglon" id="btnAcciones">
   <button type="button" class="boton btn-red not-active" id="btnCancelar">Cancelar</button>
   <!-- <button type="button" class="boton btn-yell not-active" id="btnEditar">Editar</button> -->
   <button type="button" class="boton btn-green not-active" id="btnGuardar">Guardar</button>
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

   $("#btnBurcarClaveProd").click(function() {
      $('#loading').show();
      var claveProd = $('#txbClave').val();
      if (claveProd != '') {
         debugger;
         $.ajax({
            type: 'get',
            url: 'obtenerArticulo/{clave}',
            data: {
               clave: claveProd
            },
            success: function(data) {
               debugger;
               if (data.error != 'undefined' && data.error ==
                  'La clave de producto no existe en base de datos') {
                  alert(data.error);
               } else {
                  $("#detalleArticulo").empty();
                  $("#detalleArticulo").append(data);
                  $("#detalleArticulo input").addClass("not-active");
                  $("#detalleArticulo select").addClass("not-active");
                  $("#detalleArticulo button").addClass("not-active");
                  $("#btnAcciones button").addClass("not-active");
                  $("#btnEditar").removeClass("not-active");
               }
               $('#loading').hide();
            },
            error: function(data) {
               var errors = data.responseJSON;
               console.table(errors);
               debugger;
               $('#loading').hide();
            }
         });
      } else {
         alert("Debe ingresar la clave del producto");
         $('#loading').hide();
      }
   });
});
$("#btnNuevo").click(function() {
   $("input").val("");
   $(".check").prop("checked", false);
   $("#lstDepart").val(0);
   $("#inLab").val(0);
   $("#inSATCode").val(0);
   $("input").removeClass("not-active");
   $("select").removeClass("not-active");
   $("button").removeClass("not-active");
});

$("#btnEditar").click(function() {
   $("#detalleArticulo input").removeClass("not-active");
   $("#detalleArticulo select").removeClass("not-active");
   $("#detalleArticulo button").removeClass("not-active");
   $("#btnAcciones button").removeClass("not-active");
});

$("#btnCancelar").click(function() {
   $("input").val("");
   $('select option[value="0"]').attr("selected", true);
   $("#btnAcciones button").addClass("not-active");
   $("#detalleArticulo input").addClass("not-active");
   $("#detalleArticulo select").addClass("not-active");
   $("#detalleArticulo button").addClass("not-active");
});

$("#btnGuardar").click(function() {
   $('#loading').show();
   if (validateForm()) {
      asignarValorChecks();
      $.ajax({
         data: $('#detalleArticulo').serialize(),
         url: "{{ route('ajaxCreaArticulo.store')}}",
         type: "POST",
         dataType: 'json',
         success: function(data) {

            if (data.error != '') {
               mostrarMensaje('Advertencia', "La clave de producto ya existe");
            } else {
               $('#detalleArticulo').trigger("reset");
               mostrarMensaje('Completado', "Producto agregado con exito!");
            }
            $('#loading').hide();
         },
         error: function(data) {
            debugger;
            console.log('Error:', data);
            $('#loading').hide();
         }
      });
   }
   $('#loading').hide();
});

function asignarValorChecks() {
   $('#artInv').prop('checked') ? $('#inArticuloInventario').val(1) : $('#inArticuloInventario').val(0);
   $('#artComp').prop('checked') ? $('#inArticuloCompra').val(1) : $('#inArticuloCompra').val(0);
   $('#artVenta').prop('checked') ? $('#inArticuloVenta').val(1) : $('#inArticuloVenta').val(0);
   $('#artIVA').prop('checked') ? $('#inArticuloIVA').val(1) : $('#inArticuloIVA').val(0);
   $('#artActive').prop('checked') ? $('#inArticuloActivo').val(1) : $('#inArticuloActivo').val(0);
}

function validateForm() {
   debugger;
   if ($("#inClave").val().length < 1) {
      mostrarMensaje('Advertencia', "El campo Clave es obligatorio");
      return false;
   }
   if ($("#inDescripc").val().length < 1) {
      mostrarMensaje('Advertencia', "El campo Descripción es obligatorio");
      return false;
   }
   if ($("#inSustan").val().length < 1) {
      mostrarMensaje('Advertencia', "El campo Sustancia es obligatorio");
      return false;
   }
   if ($("#inPresent").val().length < 1) {
      mostrarMensaje('Advertencia', "El campo Presentación es obligatorio");
      return false;
   }
   if ($("#inBarCade").val().length < 1) {
      mostrarMensaje('Advertencia', "El campo Codigo de Barras es obligatorio");
      return false;
   }
   if ($("#inFecCad").val().length < 1) {
      mostrarMensaje('Advertencia', "El campo Fecha de Caducidad es obligatorio");
      return false;
   }
   if ($("#inSATProd ").val().length < 1) {
      mostrarMensaje('Advertencia', "El campo Codigó de producto SAT es obligatorio");
      return false;
   }
   if ($("#inStockMin").val().length < 1) {
      mostrarMensaje('Advertencia', "El campo Stock Min es obligatorio");
      return false;
   }
   if ($("#inStockMax").val().length < 1) {
      mostrarMensaje('Advertencia', "El campo Stock Max es obligatorio");
      return false;
   }
   if ($("#inPreComp").val().length < 1) {
      mostrarMensaje('Advertencia', "El campo Precio de Compra es obligatorio");
      return false;
   }
   if ($("#inPrePub").val().length < 1) {
      mostrarMensaje('Advertencia', "El campo Precio a Publico es obligatorio");
      return false;
   }
   if ($('#lstDepart  ').val().trim() === '') {
      mostrarMensaje('Advertencia', "Debe seleccionar un Departamento");
      return false;
   }
   if ($('#inLab  ').val().trim() === '') {
      mostrarMensaje('Advertencia', "Debe seleccionar un Laboratorio");
      return false;
   }
   if ($('#inSATCode ').val().trim() === '') {
      mostrarMensaje('Advertencia',"Debe seleccionar un Codigó de unidad de medida SAT");
      return false;
   }
   return true;
}
</script>
@endsection
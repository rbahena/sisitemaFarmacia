@extends('layouts.app')

@section('content')
<div class="container text-center">
   <h3>Agrega, consulta o edita los productos del inventario</h3>
   <h6>Los campos marcados con * son indispensables para poder registrar un nuevo producto</h6>
</div>
<hr>
<nav class="renglon">
   <input type="number" name="inkIdArticulo" id="inkIdArticulo" class="input-control col-md-1 not-active" value=""
      hidden>
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
         <button type="button" class="boton btn-blue" id="btnPrimero" onclick="fnControles('primero')"
            title="Ver primer registro"><i class="fa fa-step-backward"></i></button>
         <button type="button" class="boton btn-blue" id="btnAnterior" onclick="fnControles('anterior')"
            title="Ver anterior registro"><i class="fa fa-fast-backward"></i></button>
         <button type="button" class="boton btn-blue" id="btnSiguiente" onclick="fnControles('siguiente')"
            title="Ver siguiete registro"><i class="fa fa-fast-forward"></i></button>
         <button type="button" class="boton btn-blue" id="btnUltimo" onclick="fnControles('ultimo')"
            title="Ver ultimo registro"><i class="fa fa-step-forward"></i></button>
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
            <input type="text" name="inkIdArticulo" id="inkIdArticulo" class="input-control col-md-1 not-active"
               value="" hidden>
            <label class="inClave">Clave <small>*</small></label>
            <input type="text" name="inClave" id="inClave" class="input-control not-active" required value=""
               title="Este campo es obligarorio">

            <label class="inDescripc">Descripción <small>*</small></label>
            <input type="text" id="inDescripc" name="inDescripc" class="input-control not-active" required value=""
               title="Este campo es obligarorio">
         </div>

         <div class="renglon col-md-12">
            <label class="inSustan">Sustancia </label>
            <input type="text" name="inSustan" id="inSustan" class="input-control not-active" value="">

            <label class="inPresent">Presentación </label>
            <input type="text" name="inPresent" id="inPresent" class="input-control not-active" value="">

            <label class="inBarCade">Codigo de Barras <small>*</small></label>
            <input type="text" name="inBarCade" id="inBarCade" class="input-control not-active" value="" required
               title="Este campo es obligarorio">
         </div>

         <div class="renglon col-md-12">
            <label class="inFecCad">Fecha de Caducidad <small>*</small></label>
            <input type="date" name="inFecCad" id="inFecCad" class="input-control not-active" value="" required
               title="Este campo es obligarorio">

            <label class="inDepart">Departamento</label>
            <select name="lstDepart" id="lstDepart" class="not-active" required title="Este campo es obligarorio">
               <option value="0">Seleccionar</option>
               @foreach($departamentos as $departamento)
               <option value='{{$departamento->kId}}'>{{$departamento->sDescripcion}}</option>
               @endforeach
            </select>

            <label class="inLab">Laboratorio</label>
            <select name="inLab" id="inLab" class="not-active" required title="Este campo es obligarorio">
               <option value="0">Seleccionar</option>
               @foreach($laboratorios as $laboratorio)
               <option value='{{$laboratorio->kId}}'>{{$laboratorio->sDescripcion}}</option>
               @endforeach
            </select>
         </div>

         <div class="renglon col-md-12">
            <label class="inSATCode">Codigó de unidad de medida SAT <small>*</small></label>
            <select name="inSATCode" id="inSATCode" class="not-active" required title="Este campo es obligarorio">
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
               title="Este campo es obligarorio">
            <label for="inStockMax">Stock Max</label>
            <input type="number" name="inStockMax" id="inStockMax" class="input-control col-md-1 not-active" value="">
            <label for="inPreComp">Precio de Compra $</label>
            <input type="number" step="any" name="inPreComp" id="inPreComp" class="input-control col-md-1 not-active"
               value="" title="Este campo es obligarorio">
            <label for="inPrePub">Precio a Publico $</label>
            <input type="number" step="any" name="inPrePub" id="inPrePub" class="input-control col-md-1 not-active"
               value="">
         </div>
         <!-- <div class="renglon">
            <label for="lsPrecios">Lista de Precios:</label>
            <select name="lsPrecios" class="" >
               <option value="0"></option>
            </select>
            <label class="lbFrame">Vacio</label>
         </div> -->

         <input type="text" name="inArticuloInventario" id="inArticuloInventario" value="1" hidden>
         <input type="text" name="inArticuloCompra" id="inArticuloCompra" value="1" hidden>
         <input type="text" name="inArticuloVenta" id="inArticuloVenta" value="1" hidden>
         <input type="text" name="inArticuloIVA" id="inArticuloIVA" value="1" hidden>
         <input type="text" name="inArticuloActivo" id="inArticuloActivo" value="1" hidden>
      </div>
      <aside>
         <ul>
            <li>Articulo de Inventario <input type="checkbox" name="artInv" id="artInv" class="not-active check"
                  checked></li>

            <li>Articulo de Compra <input type="checkbox" name="artComp" id="artComp" class="not-active check" checked>
            </li>

            <li>Articulo de Venta <input type="checkbox" name="artVenta" id="artVenta" class="not-active check" checked>
            </li>

            <li>Impuesto IVA 16% <input type="checkbox" name="artIVA" id="artIVA" class="not-active check" checked></li>

            <li>Activo <input type="checkbox" name="artActive" id="artActive" class="not-active" checked disabled></li>
         </ul>
         <div class="frameImage">

         </div>
      </aside>
   </section>

</form>
<div class="renglon" id="btnAcciones">
   <button type="button" class="boton btn-red not-active" id="btnCancelar">Cancelar</button>
   <button type="button" class="boton btn-yell not-active" id="btnEditar">Editar</button>
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

function fnControles(control) {
   $('#loading').show();
   var id = 0;
   if ($('form #inkIdArticulo').val() != '') {
    id = $('form #inkIdArticulo').val();
   }
   debugger;
   $.ajax({
      type: 'get',
      url: 'obtenerArticuloCtrl/{id}/{control}',
      data: {
         id: id,
         control: control
      },
      success: function(data) {

         // if (data.error != 'undefined' && data.error ==
         //    'La clave de producto no existe en base de datos') {
         //    alert(data.error);
         // } else {
         $("#detalleArticulo").empty();
         $("#detalleArticulo").append(data);
         $("#detalleArticulo input").addClass("not-active");
         $("#detalleArticulo select").addClass("not-active");
         $("#detalleArticulo button").addClass("not-active");
         $("#btnAcciones button").addClass("not-active");
         $("#btnEditar").removeClass("not-active");
         // }
         $('#loading').hide();
      },
      error: function(data) {
         var errors = data.responseJSON;
         console.table(errors);
         debugger;
         $('#loading').hide();
      }
   });
   // } else {
   //    debugger;
   //    // alert("Debe ingresar la clave del producto");
   //    // $('#loading').hide();
   // }
}


$("#btnNuevo").click(function() {
   $("input").val("");
   // $(".check").prop("checked", false);
   $("#lstDepart").val(0);
   $("#inLab").val(0);
   $("#inSATCode").val(0);
   $("input").removeClass("not-active");
   $("select").removeClass("not-active");
   $("button").removeClass("not-active");
   $("#btnNuevo").addClass("not-active");
   $("#btnPrimero").addClass("not-active");
   $("#btnSiguiente").addClass("not-active");
   $("#btnUltimo").addClass("not-active");
   $("#btnAnterior").addClass("not-active");
});

$("#btnEditar").click(function() {
   $("#detalleArticulo input").removeClass("not-active");
   $("#detalleArticulo select").removeClass("not-active");
   $("#detalleArticulo button").removeClass("not-active");
   $("#btnAcciones button").removeClass("not-active");
   $("#btnGuardar").val("Guardar cambios");
});

$("#btnCancelar").click(function() {
   $("input").val("");
   $('select option[value="0"]').attr("selected", true);
   $("#btnAcciones button").addClass("not-active");
   $("#detalleArticulo input").addClass("not-active");
   $("#detalleArticulo select").addClass("not-active");
   $("#detalleArticulo button").addClass("not-active");
   $("#btnNuevo").removeClass("not-active");
   $("#btnPrimero").removeClass("not-active");
   $("#btnSiguiente").removeClass("not-active");
   $("#btnUltimo").removeClass("not-active");
   $("#btnAnterior").removeClass("not-active");
});

$("#btnGuardar").click(function() {
   debugger;
   $('#loading').show();
   if (validateForm()) {
      asignarValorChecks();
      $.ajax({
         data: $('#detalleArticulo').serialize(),
         url: "{{ route('ajaxCreaArticulo.store')}}",
         type: "POST",
         dataType: 'json',
         success: function(data) {
            debugger;
            console.table(data);
            if (data.error != '') {
               mostrarMensaje('Advertencia', "La clave de producto ya existe");
            } else {
               $('#detalleArticulo').trigger("reset");
               $("#detalleArticulo").empty();
               $("#detalleArticulo").append(data.html);
               $("#detalleArticulo input").addClass("not-active");
               $("#detalleArticulo select").addClass("not-active");
               $("#detalleArticulo button").addClass("not-active");
               $("#btnAcciones button").addClass("not-active");
               $("#btnEditar").removeClass("not-active");
            }
            $('#loading').hide();
         },
         error: function(data) {
            console.log('Error:', data);
            $('#loading').hide();
            debugger;
         }
      });
   }
   $('#loading').hide();
});



function asignarValorChecks() {
   if (!$('#artInv').prop('checked')) {
      $('#inArticuloInventario').val("0");
   } else {
      $('#inArticuloInventario').val("1");
   }

   if (!$('#artComp').prop('checked')) {
      $('#inArticuloCompra').val("0");
   } else {
      $('#inArticuloCompra').val("1");
   }

   if (!$('#artVenta').prop('checked')) {
      $('#inArticuloVenta').val("0");
   } else {
      $('#inArticuloVenta').val("1");
   }

   if (!$('#artIVA').prop('checked')) {
      $('#inArticuloIVA').val("0");
   } else {
      $('#inArticuloIVA').val("1");
   }

   if (!$('#artActive').prop('checked')) {
      $('#inArticuloActivo').val("0");
   } else {
      $('#inArticuloActivo').val("1");
   }

}

function validateForm() {
   if ($("#inClave").val().trim() == '') {
      mostrarMensaje('Advertencia', "El campo Clave es obligatorio");
      return false;
   }
   if ($("#inDescripc").val().length < 1 && $("#inDescripc").val() != 'undefined') {
      mostrarMensaje('Advertencia', "El campo Descripción es obligatorio");
      return false;
   }
   if ($("#inBarCade").val().length < 1 && $("#inBarCade").val() != 'undefined') {
      mostrarMensaje('Advertencia', "El campo Codigo de Barras es obligatorio");
      return false;
   }
   if ($("#inFecCad").val().length < 1 && $("#inFecCad").val() != 'undefined') {
      mostrarMensaje('Advertencia', "El campo Fecha de Caducidad es obligatorio");
      return false;
   }
   if ($('#inSATCode ').val().trim() === '0' && $("#inLab").val() != 'undefined') {
      mostrarMensaje('Advertencia', "Debe seleccionar un Codigó de unidad de medida SAT");
      return false;
   }
   return true;
}
</script>
@endsection
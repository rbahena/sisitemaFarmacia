@extends('layouts.app')

@section('content')
<div class="container text-center">
   <h3>Agrega, consulta y/o edita los productos del inventario</h3>
</div>
<hr>

<nav class="renglon form-inline col-md-5">
   <label for="inputClaveBusqueda">Clave de producto:</label>
   <input type="text" name="inputClaveBusqueda" id="inputClaveBusqueda" class="form-control col-md-3"
      placeholder="Ej. LAB-000" value="">&nbsp;
   <button type="button" class="btn btn-primary" id="btnBurcarClaveProd"><i class="fa fa-search"></i></button>
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
      <button type="button" class="btn btn-success" id="btnNuevo">Crear Nuevo</button>

   </div>
   <!-- <div class="text-right">
         <label class="">Sucursal:</label>
         <label class="lbFrame">Central</label>
      </div> -->
</nav>
<hr>

<form id="detalleArticulo" name="detalleArticulo">
   <section id="principal">
      <div class="frmPrincipal col-md-5">

         <div id="ocultos">
            <input type="number" name="inputIdArticulo" id="inputIdArticulo" class="form-control col-md-1" value=""
               hidden>
            <input type="number" name="checkEsInventario" id="checkEsInventario" value="" hidden>
            <input type="number" name="checkEsCompra" id="checkEsCompra" value="" hidden>
            <input type="number" name="checkEsVenta" id="checkEsVenta" value="" hidden>
            <input type="number" name="checkEsIVA" id="checkEsIVA" value="" hidden>
            <input type="number" name="checkEsActivo" id="checkEsActivo" value="" hidden>
            <input type="text" class="form-control" id="inputCodigosBarras" name="inputCodigosBarras" hidden>
            <input type="number" class="form-control" id="inputNumeroCodigos" name="inputNumeroCodigos" hidden>
            <input type="text" name="inputImgBase64" id="inputImgBase64" value="" hidden>
         </div>

         <div class="form-group">
            <label for="inputNombreFarmaco">Nombre del fármaco</label>
            <input type="text" class="form-control enable-disabled" id="inputNombreFarmaco" name="inputNombreFarmaco"
               placeholder="Ej. Tempra paracetamol" disabled>
            <small id="campoNomObligatorio" class="form-text text-muted">Este campo es obligatorio en la creación de un
               nuevo
               registro.</small>

         </div>

         <div class="form-group">
            <label for="inputDescripcion">Descripción</label>
            <textarea class="form-control enable-disabled" id="inputDescripcion" name="inputDescripcion" rows="2"
               placeholder="Ej. Tempra paracetamol 500 mg  C/20 tb" disabled></textarea>
            <small id="emailHelp" class="form-text text-muted">Este campo es obligatorio en la creación de un nuevo
               registro.</small>
         </div>

         <div class="form-group">
            <label for="inputCodigoSat">Código SAT</label>
            <input type="text" class="form-control enable-disabled" id="inputCodigoSat" name="inputCodigoSat"
               placeholder="Ingresa el código SAT" disabled>
         </div>

         <div class="form-group">
            <label for="codigoBarras_1">Código de barras</label>
            <input type="number" class="form-control enable-disabled" id="codigoBarras_1" name="codigoBarras_1" value=""
               maxlength="50" placeholder="Ej. 1 23 45678 9 10" disabled>
            <!-- maxlength="50" onchange="agregaCodigoBarras('#codigoBarras_1')" placeholder="Ej. 1 23 45678 9 10" -->
            <small id="agregarCodigoBarras" class="form-text text-muted enable-disabled" style="cursor: pointer;"><a
                  onclick='agregarInputCodBarras()' disabled>Haz clic aquí para agregar otro código de barras
                  <i class="fas fa-plus"></i></a></small>

            <div class="DivcodigoBarras">
            </div>
         </div>

         <div class="form-group">
            <label for="selectLaboratorio">Laboratorio</label>
            <div class="select not-active">
               <select class="form-control chosenPredictivo enable-disabled" name="selectLaboratorio"
                  id="selectLaboratorio">
                  @foreach($laboratorios as $laboratorio)
                  @if($laboratorio->kId == 1)
                  <option value='{{$laboratorio->kId}}' selected>{{$laboratorio->sDescripcion}}</option>
                  @else
                  <option value='{{$laboratorio->kId}}'>{{$laboratorio->sDescripcion}}</option>
                  @endif
                  @endforeach
               </select>
            </div>
            <small id="campoNomObligatorio" class="form-text text-muted">Este campo es obligatorio en la creación de un
               nuevo registro.</small>
         </div>

         <div class="form-group">
            <label for="selectDepartamento">Departamento</label>
            <div class="select not-active">
               <select class="form-control chosenPredictivo" name="selectDepartamento" id="selectDepartamento">
                  @foreach($departamentos as $departamento)
                  @if($departamento->kId == 0)
                  <option value='{{$departamento->kId}}' selected>{{$departamento->sDescripcion}}</option>
                  @else
                  <option value='{{$departamento->kId}}'>{{$departamento->sDescripcion}}</option>
                  @endif
                  @endforeach
               </select>
            </div>
         </div>

         <div class="form-group">
            <label for="selectTipoLista">Tipos de lista</label>
            <div class="select not-active">
               <select class="form-control chosenPredictivo enable-disabled" name="selectTipoLista"
                  id="selectTipoLista">
                  @foreach($tipoLista as $lista)
                  @if($lista->kId == 1)
                  <option value='{{$lista->kId}}' selected>{{$lista->sLista}}</option>
                  @else
                  <option value='{{$lista->kId}}'>{{$lista->sLista}}</option>
                  @endif
                  @endforeach
               </select>
            </div>
         </div>

         <div class="form-group">
            <label for="selectUnidadesSat">Unidad SAT</label>
            <div class="select not-active">
               <select class="form-control chosenPredictivo enable-disabled" name="selectUnidadesSat"
                  id="selectUnidadesSat">
                  <option value="0">Seleccionar una opción</option>
                  @foreach($medidaSAT as $medida)
                  <option value='{{$medida->kId}}'>{{$medida->sNombre}} ({{$medida->sClave}})</option>
                  @endforeach
               </select>
            </div>
         </div>


      </div>

      <aside class="col-md-5">

         <div class="form-group">
            <label for="inputColectivo">Colectivo</label>
            <input type="numer" class="form-control enable-disabled" id="inputColectivo" name="inputColectivo"
               placeholder="Ej. 50" disabled>
         </div>
         <div class="form-row">
            <div class="form-group col-md-6">
               <label for="inputSustancia">Sustancia</label>
               <input type="text" class="form-control enable-disabled" id="inputSustancia" name="inputSustancia"
                  placeholder="Ingresa la sustancia del fármaco" disabled>
            </div>
            <div class="form-group col-md-6">
               <label for="inputPresentacion">Presentación</label>
               <input type="text" class="form-control enable-disabled" id="inputPresentacion" name="inputPresentacion"
                  placeholder="Ingresa la presentación" disabled>
            </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-6">
               <label for="inputStockMinimo">Stock Minímo</label>
               <input type="numer" class="form-control enable-disabled" id="inputStockMinimo" name="inputStockMinimo"
                  placeholder="Ej. 25" disabled>
            </div>
            <div class="form-group col-md-6">
               <label for="inputStockMaximo">Stock Máximo</label>
               <input type="numer" class="form-control enable-disabled" id="inputStockMaximo" name="inputStockMaximo"
                  placeholder="Ej. 500" disabled>
            </div>
         </div>

         <div class="form-row">
            <div class="form-group col-md-3">
               <label for="inputPrecioPublico">$ Público</label>
               <input type="numer" step="any" class="form-control enable-disabled" id="inputPrecioPublico"
                  name="inputPrecioPublico" placeholder="Ej. 15.50" disabled>
            </div>
            <div class="form-group col-md-3">
               <label for="inputPrecioMayoreo">$ Mayoreo</label>
               <input type="numer" step="any" class="form-control enable-disabled" id="inputPrecioMayoreo"
                  name="inputPrecioMayoreo" placeholder="Ej. 12.00" disabled>
            </div>
            <div class="form-group col-md-3">
               <label for="inputPrecioNormal">$ Normal</label>
               <input type="numer" step="any" class="form-control enable-disabled" id="inputPrecioNormal"
                  name="inputPrecioNormal" placeholder="Ej. 14.00" disabled>
            </div>
            <div class="form-group col-md-3">
               <label for="inputPrecioLunes">$ Lunes</label>
               <input type="numer" step="any" class="form-control enable-disabled" id="inputPrecioLunes"
                  name="inputPrecioLunes" placeholder="Ej. 13.30" disabled>
            </div>
         </div>
         <ul>
            <li>Articulo de Inventario <input type="checkbox" name="checkInventario" id="checkInventario"
                  class="checkInventario  enable-disabled" checked disabled></li>

            <li>Articulo de Compra <input type="checkbox" name="checkCompra" id="checkCompra"
                  class="check  enable-disabled" checked disabled>
            </li>

            <li>Articulo de Venta <input type="checkbox" name="checkVenta" id="checkVenta"
                  class="check  enable-disabled" checked disabled>
            </li>

            <li>Impuesto IVA 16% <input type="checkbox" name="checkIVA" id="checkIVA" class="check  enable-disabled"
                  disabled>
            </li>

            <li>Activo <input type="checkbox" name="checkActivo" id="checkActivo" class="enable-disabled" checked
                  disabled>
            </li>
         </ul>
         <div class="text-center">
            <input id="inputImagen" name="inputImagen" type='file' class="enable-disabled"
               accept="image/png, image/jpeg" onchange="readFile()" disabled>
         </div>
         <br>
         <div class="text-center">
            <img id="imagen" name="imagen" height="220" class="text-left" width="250"
               src="{{URL::asset('../images/defaultImg.png')}}" class="rounded">
         </div>

      </aside>

   </section>
</form>
<div class="renglon" id="btnAcciones">
   <button type="button" class="btn btn-danger btnAcciones" id="btnCancelar" disabled>Cancelar</button>
   <button type="button" class="btn btn-warning btnAcciones" id="btnEditar" disabled>Editar</button>
   <button type="button" class="btn btn-success btnAcciones" id="btnGuardar" disabled>Guardar</button>
</div>
@endsection

@section('script')
<script type="text/javascript">
$('.chosenPredictivo').chosen({
   width: '100%',
   placeholder_text_single: "Seleccione una opción",
   no_results_text: "No se encontró información a mostrar"
});
var cont = 1;
$(function() {
   $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

   $("#btnBurcarClaveProd").click(function() {
      $('#loading').show();
      var claveProd = $('#inputClaveBusqueda').val();
      if (claveProd != '') {
         $.ajax({
            type: 'get',
            url: 'obtenerArticulo/{clave}',
            data: {
               clave: claveProd
            },
            success: function(data) {
               console.log(data);
               if (data.error != '') {
                  alert(data.error);
               } else {
                  $("#detalleArticulo").empty();
                  $("#detalleArticulo").append(data.html);
                  $("#btnEditar").removeAttr("disabled");
               }
               $('#loading').hide();
            },
            error: function(data) {
               var errors = data.responseJSON;
               console.table(errors);
               $('#loading').hide();
            }
         });
      } else {
         alert("Debe ingresar la clave del producto");
         $('#loading').hide();
      }
   });

   $("#btnNuevo").click(function() {
      $(".enable-disabled").removeAttr("disabled");
      $(".select").removeClass("not-active");
      $('.chosenPredictivo').trigger('chosen:updated');
      $("#btnCancelar").removeAttr("disabled");
      $("#btnGuardar").removeAttr("disabled");
      $(".enable-disabled").val("");
      $('img').attr('src', '{{URL::asset("../images/defaultImg.png")}}');
      $("#btnNuevo").attr("disabled", true);
      $(".controlDesplazamiento").attr("disabled", true);
      $(".DivcodigoBarras").empty();

      if (!$("#codigoBarras_1").length) {
         $("#lblCodigoBarras").after(
            '<input type="number" class="form-control enable-disabled" id="codigoBarras_1" name="codigoBarras_1" ' +
            'value="" maxlength="50">');
      }

      if ($("#inputClave").length) {
         $("#inputClave").remove();
         $(".lbClave").remove();
      }
   });

   $("#btnCancelar").click(function() {
      $(".DivcodigoBarras").empty();
      $(".enable-disabled").attr("disabled", true);
      $(".btnAcciones").attr("disabled", true);
      $(".enable-disabled").val("");
      $("#btnNuevo").removeAttr("disabled");
      $(".controlDesplazamiento").removeAttr("disabled");
      $('img').attr('src', '{{URL::asset("../images/defaultImg.png")}}');
      $(".select").addClass("not-active");
      $(".select option[value='0']").attr("selected", true);
      if ($("#inputClave").length) {
         $("#inputClave").remove();
         $(".lbClave").remove();
      }
      if (!$("#codigoBarras_1").length) {
         $("#lblCodigoBarras").after(
            '<input type="number" class="form-control enable-disabled" id="codigoBarras_1" name="codigoBarras_1" ' +
            'value="" maxlength="50" disabled>');
      }
   });

   $("#btnEditar").click(function() {
      $(".enable-disabled").removeAttr("disabled");
      $(".btnAcciones").removeAttr("disabled");
      var inputCod = ''
      $("a.disabled").removeClass("disabled");
      $("#btnEditar").attr("disabled", true);
      $("#btnNuevo").attr("disabled", true);
      $(".controlDesplazamiento").attr("disabled", true);
   });

   $("#btnGuardar").click(function() {
      $('#loading').show();
       
      console.log($('#inputImgBase64').val());
      $("#btnGuardar").attr("disabled", true);
      $("#btnCancelar").attr("disabled", true);
      if (validateForm()) {
         agregaCodigoBarras();
         asignarValorChecks();
         $.ajax({
            data: $('#detalleArticulo').serialize(),
            url: "{{ route('ajaxCreaArticulo.store')}}",
            type: "POST",
            dataType: 'json',
            success: function(data) {
               console.table(data);
               if (data.error != '') {
                  mostrarMensaje('Advertencia', "Ya existe un articulo con el mismo nombre.");
               } else {
                  $('#detalleArticulo').trigger("reset");
                  $("#detalleArticulo").empty();
                  $("#detalleArticulo").append(data.html);
                  $("#btnEditar").removeAttr("disabled");
                  $("#btnNuevo").removeAttr("disabled");
                  $(".controlDesplazamiento").removeAttr("disabled");
                  mostrarMensaje('Advertencia', "Producto guardado exitosamente.");
               }
               $('#loading').hide();
            },
            error: function(data) {
               console.log('Error:', data);
               $('#loading').hide();
            }
         });
      }
      $('#loading').hide();
   });


});

function asignarValorChecks() {
   if ($('#checkInventario').prop('checked')) {
      $('#checkEsInventario').val(1);
   } else {
      $('#checkEsInventario').val(0);
   }

   if ($('#checkCompra').prop('checked')) {
      $('#checkEsCompra').val(1);
   } else {
      $('#checkEsCompra').val(0);
   }

   if ($('#checkVenta').prop('checked')) {
      $('#checkEsVenta').val(1);
   } else {
      $('#checkEsVenta').val(0);
   }

   if ($('#checkIVA').prop('checked')) {
      $('#checkIVA').val(1);
   } else {
      $('#checkIVA').val(0);
   }

   if ($('#checkActivo').prop('checked')) {
      $('#checkEsActivo').val(1);
   } else {
      $('#checkEsActivo').val(0);
   }
}

function validateForm() {
   if ($("#inputNombreFarmaco").val().length < 1 && $("#inputNombreFarmaco").val() != 'undefined') {
      mostrarMensaje('Advertencia', "Debe agregar el nombre del fármaco");
      return false;
   }

   if ($('#inputDescripcion ').val().trim() === '0' && $("#inputDescripcion").val() != 'undefined') {
      mostrarMensaje('Advertencia', "Debe agregar una breve descripcion del producto.");
      return false;
   }

   if ($('#selectLaboratorio').val() === '1') {
      mostrarMensaje('Advertencia', "Debe seleccionar un laboratorio.");
      return false;
   }
   return true;
}

function readFile() {
   var img = document.getElementById('inputImagen');
   if (img.files && img.files[0]) {
      var FR = new FileReader();
      FR.addEventListener("load", function(e) {
         document.getElementById("imagen").src = e.target.result;
         $('#inputImgBase64').val(e.target.result);
      });

      FR.readAsDataURL(img.files[0]);
   }

}

function agregarInputCodBarras() {
    
   if (!$('#codigoBarras_1').is(':disabled')) {
      cont++;
      newCodigo =
         '<div id="DivCodigoBarras_' + cont + '"">' +
         '<label for="name">Nuevo codigo de barras </label> ' +
         ' <div class="form-inline"> ' +
         ' <input type="text" class="form-control enable-disabled" id="codigoBarras_' + cont + '" name="codigoBarras_' +
         cont +
         '" value="" maxlength="50">&nbsp;<i title="Eliminar este código de barras" class="fa fa-trash-alt" onclick="eliminarImputCodBarrras(\'#DivCodigoBarras_' +
         cont + '\')">' +
         '</div>' +
         '</div>';
      // '<label for="name">Codigo de barras </label> ' +
      // ' <div class="form-inline"><input type="text" class="form-control enable-disabled"  onchange="agregaCodigoBarras(\'#codigoBarras_' +
      // cont + '\')"  id="codigoBarras_' + cont + '" name="codigoBarras_' + cont + '" value="" maxlength="50">&nbsp;<i class="fa fa-trash-alt"></>' +
      // '</div>';
      $(".DivcodigoBarras").append(newCodigo);
   }
}

function eliminarImputCodBarrras($id) {
   $($id).remove();
}

function agregaCodigoBarras() {
   var contador = 1;
   if ($("#codigoBarras_1").length) {
      var nvoCodigo = $("#codigoBarras_1").val();
      $("#inputCodigosBarras").val(nvoCodigo + ',')
   } else {

      var contador = 0;
   }
   var codigos = $("#inputCodigosBarras").val();
   $('.DivcodigoBarras input').each(function() {
      var nvoCodigo = this.value;
      contador++;
      if (nvoCodigo != '') {
         $("#inputCodigosBarras").val(codigos + nvoCodigo + ',');
         codigos = $("#inputCodigosBarras").val();
         console.log($("#inputCodigosBarras").val());
      }
   });
   $("#inputNumeroCodigos").val(contador - 1);
}

function fnControles(control, id) {
   $('#loading').show();
   if (id != 1)
      id = $("#inputIdArticulo").val();

   $.ajax({
      type: 'get',
      url: 'obtenerArticuloCtrl/{id}/{control}',
      data: {
         id: id,
         control: control
      },
      success: function(data) {
         if (data.success == 'success') {
            $("#detalleArticulo").empty();
            $("#detalleArticulo").append(data.html);
            $("#btnEditar").removeAttr("disabled");
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
</script>
@endsection
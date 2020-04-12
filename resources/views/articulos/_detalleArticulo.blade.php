<section id="principal">
   <div class="frmPrincipal col-md-5">

      <div id="ocultos">
         <input type="number" name="inputIdArticulo" id="inputIdArticulo" class="form-control col-md-1"
            value="{{!empty($articulo->kId) ? $articulo->kId:''}}" hidden>
         <input type="text" name="checkEsInventario" id="checkEsInventario" value="{{ $articulo->bInventario}}" hidden>
         <input type="text" name="checkEsCompra" id="checkEsCompra" value="{{$articulo->bCompra}}" hidden>
         <input type="text" name="checkEsVenta" id="checkEsVenta" value="{{$articulo->bVenta}}" hidden>
         <input type="text" name="checkEsIVA" id="checkEsIVA" value="{{$articulo->bImpIVA}}" hidden>
         <input type="text" name="checkEsActivo" id="checkEsActivo" value="{{$articulo->bEstatus}}" hidden>
         <input type="text" class="form-control" id="inputCodigosBarras" name="inputCodigosBarras" hidden>
         <input type="text" class="form-control" id="inputNumeroCodigos" name="inputNumeroCodigos" hidden>
         <input type="text" name="inputImgBase64" id="inputImgBase64" value="" hidden>
      </div>

      <div class="form-group">
         <label for="inputClave" class="lbClave">Clave</label>
         <input type="text" name="inputClave" id="inputClave" class="form-control"
            value="{{!empty($articulo->sClaveLab) ? $articulo->sClaveLab:''}}" disabled>
      </div>

      <div class="form-group">
         <label for="inputNombreFarmaco">Nombre del fármaco</label>
         <input type="text" class="form-control enable-disabled" id="inputNombreFarmaco" name="inputNombreFarmaco"
            value="{{!empty($articulo->sArticulo) ? $articulo->sArticulo:''}}" disabled>
         <small id="campoNomObligatorio" class="form-text text-muted">Este campo es obligatorio en la creación de un
            nuevo registro.</small>
      </div>

      <div class="form-group">
         <label for="inputDescripcion">Descripción</label>
         <textarea class="form-control enable-disabled" id="inputDescripcion" name="inputDescripcion" rows="2" value=""
            disabled>{{!empty($articulo->sDescripcion) ? $articulo->sDescripcion:''}}</textarea>
         <small id="descripcionAyuda" class="form-text text-muted">Este campo es obligatorio en la creación de un nuevo
            registro.</small>
      </div>

      <div class="form-group">
         <label for="inputCodigoSat">Código SAT</label>
         <input type="text" class="form-control enable-disabled" id="inputCodigoSat" name="inputCodigoSat"
            value="{{!empty($articulo->sCodProductoSAT) ? $articulo->sCodProductoSAT: ''}}" disabled>
      </div>
      <div class="form-group">
         <label for="codigoBarras_1" id="lblCodigoBarras">Código de barras</label>
         @if(!empty($catalogos['codigosBarra'][0]))
         <small id="agregarCodigoBarras" class="form-text text-muted" style="cursor: pointer;"><a
               onclick='agregarInputCodBarras()' class="disabled">Haz clic aquí para agregar otro código de barras
               <i class="fas fa-plus disabled"></i></a></small>
         <div class="DivcodigoBarras">
            @foreach($catalogos['codigosBarra'] as $codigo)
            <div id="DivCodigoBarras_{{$loop->index}}">
            <div class="form-inline">
            <input type="number" class="form-control enable-disabled"
               id="codigoBarras_{{!empty($codigo->kId) ? $codigo->kId:''}}"
               name="codigoBarras_{{!empty($codigo->kId) ? $codigo->kId:''}}"
               value="{{!empty($codigo->sCodigoBarra) ? $codigo->sCodigoBarra:''}}" maxlength="50" disabled>
               &nbsp;<i title="Eliminar este codifo de barras" class="fas fa-trash-alt" onclick='eliminarImputCodBarrras("#DivCodigoBarras_{{$loop->index}}")'></i>
            </div>
            </div>
            @endforeach
         </div>
         @else
         <input type="number" class="form-control enable-disabled" id="codigoBarras_1" name="codigoBarras_1"
            maxlength="50" disabled>
         <small id="agregarCodigoBarras" class="form-text text-muted" style="cursor: pointer;"><a
               onclick='agregarInputCodBarras()' class="disabled">Haz clic aquí para agregar otro código de barras
               <i class="fas fa-plus"></i></a></small>
         <div class="DivcodigoBarras">
         </div>
         @endif
         <!-- <input type="text" class="form-control enable-disabled" id="codigoBarras_1" name="codigoBarras_1" value=""
            maxlength="50" onchange="agregaCodigoBarras('#codigoBarras_1')" disabled>
         <small id="agregarCodigoBarras" class="form-text text-muted"><a onclick='agregarInputCodBarras()' href="#">Haz
               clic aquí para agregar otro código de barras <i class="fas fa-plus"></i></a></small> -->
      </div>

      <div class="form-group">
         <label for="selectLaboratorio">Laboratorio</label>
         <select class="form-control chosenPredictivo enable-disabled" name="selectLaboratorio" id="selectLaboratorio"
            required disabled>
            @foreach($catalogos['laboratorios'] as $laboratorio)
            @if($laboratorio->kId == $articulo->fkIdLaboratorio)
            <option value='{{$laboratorio->kId}}' selected>{{$laboratorio->sDescripcion}}</option>
            @else
            <option value='{{$laboratorio->kId}}'>{{$laboratorio->sDescripcion}}</option>
            @endif
            @endforeach
         </select>
         <small id="campoNomObligatorio" class="form-text text-muted">Este campo es obligatorio en la creación de un
            nuevo registro.</small>
      </div>

      <div class="form-group">
         <label for="selectDepartamento">Departamento</label>
         <select class="form-control chosenPredictivo enable-disabled" name="selectDepartamento" id="selectDepartamento"
            disabled>
            <option value="0">No aplica (N/A)</option>
            @foreach($catalogos['departamentos'] as $departamento)
            @if($departamento->kId == $articulo->fkIdDepartamento)
            <option value='{{$departamento->kId}}' selected>{{$departamento->sDescripcion}}</option>
            @else
            <option value='{{$departamento->kId}}'>{{$departamento->sDescripcion}}</option>
            @endif
            @endforeach
         </select>
      </div>

      <div class="form-group">
         <label for="selectTipoLista">Tipos de lista</label>
         <select class="form-control chosenPredictivo enable-disabled" name="selectTipoLista" id="selectTipoLista"
            disabled>
            <option value="0">Seleccionar una opción</option>
            @foreach($catalogos['tipoLista'] as $lista)
            @if(!empty($articulo->fkIdLista) && $lista->kId == $articulo->fkIdLista)
            <option value='{{$lista->kId}}' selected>{{$lista->sLista}}</option>
            @else
            <option value='{{$lista->kId}}'>{{$lista->sLista}}</option>
            @endif
            @endforeach
         </select>
      </div>

      <div class="form-group">
         <label for="selectUnidadesSat">Unidad SAT</label>
         <select class="form-control chosenPredictivo enable-disabled" name="selectUnidadesSat" id="selectUnidadesSat"
            disabled>
            <option value="0">Seleccionar una opción</option>
            @foreach($catalogos['medidaSAT'] as $medida)
            @if(!empty($articulo->fkIdUMedidaSAT) && $articulo->fkIdUMedidaSAT != 'undefined' && $medida->kId
            ==$articulo->fkIdUMedidaSAT)
            <option value='{{$medida->kId}}' selected>{{$medida->sNombre}}</option>
            @else
            <option value='{{$medida->kId}}'>{{$medida->sNombre}}</option>
            @endif
            @endforeach
         </select>
      </div>

   </div>

   <aside class="col-md-5">
      <div class="form-group">
         <label for="inputColectivo">Colectivo</label>
         <input type="numer" class="form-control enable-disabled" id="inputColectivo" name="inputColectivo"
            value="{{!empty($articulo->sColectivo) ? $articulo->sColectivo:''}}" disabled>
      </div>
      <div class="form-row">
         <div class="form-group col-md-6">
            <label for="inputSustancia">Sustancia</label>
            <input type="text" class="form-control enable-disabled" id="inputSustancia" name="inputSustancia"
               value="{{!empty($articulo->sSustancia) ? $articulo->sSustancia:''}}" disabled>
         </div>
         <div class="form-group col-md-6">
            <label for="inputPresentacion">Presentación</label>
            <input type="text" class="form-control enable-disabled" id="inputPresentacion" name="inputPresentacion"
               value="{{!empty($articulo->sPresentacion) ? $articulo->sPresentacion: ''}}" disabled>
         </div>
      </div>
      <div class="form-row">
         <div class="form-group col-md-6">
            <label for="inputStockMinimo">Stock Minímo</label>
            <input type="numer" class="form-control enable-disabled" id="inputStockMinimo" name="inputStockMinimo"
               value="{{!empty($articulo->iMinStock) ? $articulo->iMinStock:''}}" disabled>
         </div>
         <div class="form-group col-md-6">
            <label for="inputStockMaximo">Stock Máximo</label>
            <input type="numer" class="form-control enable-disabled" id="inputStockMaximo" name="inputStockMaximo"
               value="{{!empty($articulo->iMaxStock) ? $articulo->iMaxStock : ''}}" disabled>
         </div>
      </div>

      <div class="form-row">
         <div class="form-group col-md-3">
            <label for="inputPrecioPublico">$ Público</label>
            <input type="numer" class="form-control enable-disabled" id="inputPrecioPublico" name="inputPrecioPublico"
               value="{{!empty($articulo->dPrecioVenta) ? $articulo->dPrecioVenta:''}}" disabled>
         </div>
         <div class="form-group col-md-3">
            <label for="inputPrecioMayoreo">$ Mayoreo</label>
            <input type="numer" class="form-control enable-disabled" id="inputPrecioMayoreo" name="inputPrecioMayoreo"
               value="{{!empty($articulo->dPrecioMayorista) ? $articulo->dPrecioMayorista:''}}" disabled>
         </div>
         <div class="form-group col-md-3">
            <label for="inputPrecioNormal">$ Normal</label>
            <input type="numer" class="form-control enable-disabled" id="inputPrecioNormal" name="inputPrecioNormal"
               value="{{!empty($articulo->dPrecioNormal) ? $articulo->dPrecioNormal:''}}" disabled>
         </div>
         <div class="form-group col-md-3">
            <label for="inputPrecioLunes">$ Lunes</label>
            <input type="numer" class="form-control enable-disabled" id="inputPrecioLunes" name="inputPrecioLunes"
               value="{{!empty($articulo->dPrecioLunes) ? $articulo->dPrecioLunes:''}}" disabled>
         </div>
      </div>

      <ul>
         @if(!empty($articulo->bInventario) && $articulo->bInventario != 'undefined' && $articulo->bInventario === 1)
         <li>Articulo de Inventario <input type="checkbox" name="checkInventario" id="checkInventario" checked
               class="check enable-disabled" disabled></li>
         @else
         <li>Articulo de Inventario <input type="checkbox" name="checkInventario" id="checkInventario"
               class="check enable-disabled" disabled></li>
         @endif

         @if(!empty($articulo->bCompra) && $articulo->bCompra != 'undefined' && $articulo->bCompra === 1)
         <li>Articulo de Compra <input type="checkbox" name="checkCompra" id="checkCompra" checked
               class="check enable-disabled" disabled></li>
         @else
         <li>Articulo de Compra <input type="checkbox" name="checkCompra" id="checkCompra" class="check enable-disabled"
               disabled></li>
         @endif

         @if(!empty($articulo->bVenta) && $articulo->bVenta != 'undefined' && $articulo->bVenta === 1)
         <li>Articulo de Venta <input type="checkbox" name="checkVenta" id="checkVenta" checked
               class="check enable-disabled" disabled></li>
         @else
         <li>Articulo de Venta <input type="checkbox" name="checkVenta" id="checkVenta" class="check enable-disabled"
               disabled></li>
         @endif

         @if(!empty($articulo->bImpIVA) && $articulo->bImpIVA != 'undefined' &&
         $articulo->bImpIVA === 1)
         <li>Impuesto IVA 16% <input type="checkbox" name="checkIVA" id="checkIVA" checked class="check enable-disabled"
               disabled></li>
         @else
         <li>Impuesto IVA 16% <input type="checkbox" name="checkIVA" id="checkIVA" class="check enable-disabled"
               disabled>
         </li>
         @endif

         @if(!empty($articulo->bEstatus) && $articulo->bEstatus != 'undefined' &&
         $articulo->bEstatus === 1)
         <li>Activo<input type="checkbox" name="checkActivo" id="checkActivo" checked class="check enable-disabled"
               disabled></li>
         @else
         <li>Activo<input type="checkbox" name="checkActivo" id="checkActivo" class="check enable-disabled" disabled>
         </li>
         @endif
      </ul>
      <div class="text-center"><input id="inputImagen" name="inputImagen" type='file' class="enable-disabled"
            onchange="readFile()" disabled></div>
      <br>
      <div class="text-center">
         @if(!empty($catalogos['imagen'][0]))
         <img id="imagen" name="imagen" height="220" class="text-left" width="250"
            src="{{!empty($catalogos['imagen'][0]->bImage) ? $catalogos['imagen'][0]->bImage:''}}">
         @else
         <img id="imagen" name="imagen" height="220" class="text-left" width="250"
            src="{{URL::asset('../images/defaultImg.png')}}" class="rounded">
         @endif
      </div>

   </aside>

</section>
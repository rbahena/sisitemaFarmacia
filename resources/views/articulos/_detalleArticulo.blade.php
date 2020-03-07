<section id="principal">
   <div class="frmPrincipal">
      <div class="renglon col-md-12">
         <label class="inClave">Clave </label>
         <input type="text" name="inClave" class="input-control"
            value="{{!empty($articulo->sNoArticulo) ? $articulo->sNoArticulo:''}}">
         <label class="inDescripc">Descripción </label>
         <input type="text" id="inDescripc" name="inDescripc" class="input-control"
            value="{{!empty($articulo->sDescripcion) ? $articulo->sDescripcionArticulo:''}}">
      </div>
      <div class="renglon col-md-12">
         <label class="inSustan">Sustancia </label>
         <input type="text" name="inSustan" class="input-control"
            value="{{!empty($articulo->sSustancia) ? $articulo->sSustancia:''}}">
         <label class="inPresent">Presentación </label>
         <input type="text" name="inPresent" class="input-control"
            value="{{!empty($articulo->sPresentacion) ? $articulo->sPresentacion: ''}}">
         <label class="inBarCade">Codigo de Barras </label>
         <input type="text" name="inBarCade" class="input-control"
            value="{{!empty($articulo->iCodigoBarra) ? $articulo->iCodigoBarra:''}}">
      </div>

      <div class="renglon col-md-12">
         <label class="inFecCad">Fecha de Caducidad </label>
         <input type="date" name="inFecCad" class="input-control"
            value="{{!empty($articulo->fFechaCaducidad) ? \Carbon\Carbon::parse($articulo->fFechaCaducidad)->format('Y-m-d'):''}}">

         <label class="inDepart">Departamento </label>
         <select name="lstDepart" id="lstDepart" class="not-active">
            <option value="0">Seleccionar</option>
            @foreach($departamentos as $departamento)
            @if($departamento->kId == $articulo->fkIdDepartamento)
            <option value='{{$departamento->kId}}' selected>{{$departamento->sDescripcion}}</option>
            @else
            <option value='{{$departamento->kId}}'>{{$departamento->sDescripcion}}</option>
            @endif
            @endforeach
         </select>

         <label class="inLab">Laboratorio </label>
         <select name="inLab" id="inLab" class="not-active">
            <option value="0">Seleccionar</option>
            @foreach($laboratorios as $laboratorio)
            @if($laboratorio->kId == $articulo->fkIdLaboratorio)
            <option value='{{$laboratorio->kId}}' selected>{{$laboratorio->sDescripcion}}</option>
            @else
            <option value='{{$laboratorio->kId}}'>{{$laboratorio->sDescripcion}}</option>
            @endif
            @endforeach
         </select>

      </div>
      <div class="renglon col-md-12">
         <label class="inSATCode">Codigó de unidad de medida SAT</label>
         <select name="inSATCode" id="inSATCode" class="not-active">
            <option value="0">Seleccionar</option>
            @foreach($medidaSAT as $medida)
            @if(!empty($articulo->kIdMedidaSat) && $articulo->kIdMedidaSat != 'undefined' && $medida->kId ==
            $articulo->kIdMedidaSat)
            <option value='{{$medida->kId}}' selected>{{$medida->sNombre}}</option>
            @else
            <option value='{{$medida->kId}}'>{{$medida->sNombre}}</option>
            @endif
            @endforeach
         </select>

         <label class="inSATProd">Codigó de producto SAT</label>
         <input type="text" name="inSATProd" class="input-control"
            value="{{!empty($articulo->sCODProductoSAT) ? $articulo->sCODProductoSAT: ''}}">
      </div>

      <div class="renglon col-md-12">
         <label for="inMin">Stock Min</label>
         <input type="number" name="inSATProd" class="input-control col-md-1"
            value="{{!empty($articulo->iMinStock) ? $articulo->iMinStock:''}}">
         <label for="inMax">Stock Max</label>
         <input type="number" name="inSATProd" class="input-control col-md-1"
            value="{{!empty($articulo->iMaxStock) ? $articulo->iMaxStock : ''}}">
         <label for="inPreComp">Precio de Compra</label>
         <input type="text" name="inPreComp" class="input-control col-md-1"
            value="{{!empty($articulo->dPrecioCompra) ? $articulo->dPrecioCompra:''}}">
         <label for="inPrePub">Precio a Publico</label>
         <input type="text" name="inPrePub" class="input-control col-md-1"
            value="{{!empty($articulo->dPrecioVenta) ? $articulo->dPrecioVenta:''}}">
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
         @if(!empty($articulo->bInventario) && $articulo->bInventario != 'undefined' && $articulo->bInventario === 1)
         <li>Articulo de Inventario <input type="checkbox" name="artInv" checked class="check"></li>
         @else
         <li>Articulo de Inventario <input type="checkbox" name="artInv" class="check"></li>
         @endif

         @if(!empty($articulo->bCompra) && $articulo->bCompra != 'undefined' && $articulo->bCompra === 1)
         <li>Articulo de Compra <input type="checkbox" name="artComp" checked class="check"></li>
         @else
         <li>Articulo de Compra <input type="checkbox" name="artComp" class="check"></li>
         @endif

         @if(!empty($articulo->bVenta) && $articulo->bVenta != 'undefined' && $articulo->bVenta === 1)
         <li>Articulo de Venta <input type="checkbox" name="artVenta" checked class="check"></li>
         @else
         <li>Articulo de Venta <input type="checkbox" name="artVenta" class="check"></li>
         @endif

         @if(!empty($articulo->bEstatusArticulo) && $articulo->bEstatusArticulo != 'undefined' &&
         $articulo->bEstatusArticulo === 1)
         <li>Impuesto IVA 16% <input type="checkbox" name="artIVA" checked class="check"></li>
         @else
         <li>Impuesto IVA 16% <input type="checkbox" name="artIVA" class="check"></li>
         @endif

         @if(!empty($articulo->bEstatusArticulo) && $articulo->bEstatusArticulo != 'undefined' &&
         $articulo->bEstatusArticulo === 1)
         <li>Activo<input type="checkbox" name="artActive" checked class="check"></li>
         @else
         <li>Activo<input type="checkbox" name="artActive" class="check"></li>
         @endif
      </ul>
      <div class="frameImage">

      </div>
   </aside>
</section>
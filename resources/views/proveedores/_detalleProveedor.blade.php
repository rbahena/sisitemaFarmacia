<form id="proveedorForm" name="proveedorForm">
   <input type="number" id="idProveedor" name="idProveedor"
      value="{{!empty($proveedor[0]->kId) ? $proveedor[0]->kId:''}}" hidden>
   <div class="row">
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label>Razón Social</label>
            <input type="text" class="form-control enable-disabled" id="inputRazonSocial" name="inputRazonSocial"
               value="{{!empty($proveedor[0]->sRazonSocial) ? $proveedor[0]->sRazonSocial:''}}"
               placeholder="Ej. Proveedor Central S.A de C.V" disabled>
         </div>
      </div>
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label>RFC</label>
            <input type="text" class="form-control enable-disabled" id="inputRFC" name="inputRFC"
               value="{{!empty($proveedor[0]->sRFC) ? $proveedor[0]->sRFC:''}}" placeholder="Ej. PROCTRL1234895"
               disabled>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Primer Teléfono</label>
            <input type="numer" class="form-control enable-disabled" id="inputPrimerTelefono" name="inputPrimerTelefono"
               value="{{!empty($proveedor[0]->iTelefono1) ? $proveedor[0]->iTelefono1:''}}" placeholder="Ej. 7331441682"
               disabled>
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Segundo Telefono</label>
            <input type="number" class="form-control enable-disabled" id="inputSegundoTelefono"
               value="{{!empty($proveedor[0]->iTelefono2) ? $proveedor[0]->iTelefono2:''}}" name="inputSegundoTelefono"
               placeholder="Ej. 733987654" disabled>
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Telefono Movil</label>
            <input type="number" class="form-control enable-disabled" id="inputMovil" name="inputMovil"
               value="{{!empty($proveedor[0]->iTelefonoMovil) ? $proveedor[0]->iTelefonoMovil:''}}"
               placeholder="Ej. 733987654" disabled>
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Correo Electronico</label>
            <input type="email" class="form-control enable-disabled" id="inputEmail" name="inputEmail"
               value="{{!empty($proveedor[0]->sCorreo) ? $proveedor[0]->sCorreo:''}}"
               placeholder="Ej. alguien@correo.com" disabled>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label>Datos de contacto</label>
            <input type="text" class="form-control enable-disabled" id="inputDatosContacto" name="inputDatosContacto"
               value="{{!empty($proveedor[0]->sPersonaContacto) ? $proveedor[0]->sPersonaContacto:''}}"
               placeholder="Ej. Luis Cuevas Díaz" disabled>
         </div>
      </div>
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label>Haz clic en el boton para agregar una dirección</label>
            <br>
            <button type="button" class="btn btn-outline-secondary btn-block" data-toggle="modal"
               data-target="#modalDireccion" data-whatever="@mdo" id="agregarDirecProve" disabled>Agregar
               dirección</button>
         </div>
      </div>
   </div>
   <br>
   <br>
   <div class="row" id="direccionesProveedor">
      <div class="col-xs-12 col-md-8">
         <div class="text-center">
            <h5>Lista de direcciones agregadas</h5>
         </div>
         <table class="table" id="TablaDirecciones">
            <thead>
               <tr>
                  <th scope="col">Pais</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Ciudad</th>
                  <th scope="col">Municipio</th>
                  <th scope="col">Colonia</th>
                  <th scope="col">Calle</th>
                  <th scope="col">Interior</th>
                  <th scope="col">Exterior</th>
                  <th scope="col">CP</th>
                  <th scope="col"></th>
               </tr>
            </thead>
            <tbody>
               @foreach($direcciones as $direccion)
               <tr id="r{{$loop->index}}">
                  <td>{{!empty($direccion->sPais) ? $direccion->sPais:''}}</td>
                  <td>{{!empty($direccion->sEstado) ? $direccion->sEstado:''}}</td>
                  <td>{{!empty($direccion->sCiudad) ? $direccion->sCiudad:''}}</td>
                  <td>{{!empty($direccion->sMunicipio) ? $direccion->sMunicipio:''}}</td>
                  <td>{{!empty($direccion->sColonia) ? $direccion->sColonia:''}}</td>
                  <td>{{!empty($direccion->sCalle) ? $direccion->sCalle:''}}</td>
                  <td>{{!empty($direccion->sNumInt) ? $direccion->sNumInt:'S/N'}}</td>
                  <td>{{!empty($direccion->sNumExt) ? $direccion->sNumExt:'S/N'}}</td>
                  <td>{{!empty($direccion->iCodigoPostal) ? $direccion->iCodigoPostal:''}}</td>
                  <td>
                     <button type="submit" class="btn btn-default" onclick='eliminarDireccion("#r{{$loop->index}}")'
                        disabled>
                        <i class="fas fa-trash-alt enable-disabled"></i>
                     </button>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>

</form>

<div class="renglon" id="btnAcciones">
   <a class="btn btn-danger btnAcciones" href="{{ url('/ajaxProveedor') }}">Cancelar</a>
   <button type="button" class="btn btn-warning btnAcciones" id="btnEditar" onclick='editarProveedor()'>Editar</button>
   <button type="button" class="btn btn-success btnAcciones" id="btnGuardar" disabled
      onclick='actualizarProveedor()'>Guardar</button>
</div>
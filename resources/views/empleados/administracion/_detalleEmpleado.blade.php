<form id="EmpleadoForm" name="EmpleadoForm">
   <input type="number" id="idEmpleado" name="idEmpleado" hidden>
   <div class="row">
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label>Nombre (s)</label>
            <input type="text" class="form-control enable-disabled" id="inputNombre" name="inputNombre"
               placeholder="Ej. Jose Luis" value="{{!empty($empleado[0]->sNombre) ? $empleado[0]->sNombre:''}}" required
               disabled>
            <small id="campoNomObligatorio" class="form-text text-muted">Este campo es obligatorio en la creación de un
               nuevo registro.</small>
         </div>
      </div>
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label>Apellidos</label>
            <input type="text" class="form-control enable-disabled" id="inputApellidos" name="inputApellidos"
               placeholder="Ej. Perez Gomez" value="{{!empty($empleado[0]->sApellidos) ? $empleado[0]->sApellidos:''}}"
               required disabled>
            <small id="campoNomObligatorio" class="form-text text-muted">Este campo es obligatorio en la creación de un
               nuevo registro.</small>
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Correo Electronico</label>
            <input type="email" class="form-control enable-disabled" id="inputEmail" name="inputEmail"
               placeholder="Ej. alguien@correo.com" value="{{!empty($empleado[0]->sCorreo) ? $empleado[0]->sCorreo:''}}"
               required disabled>
            <small id="campoNomObligatorio" class="form-text text-muted">Este campo es obligatorio en la creación de un
               nuevo registro.</small>
         </div>
      </div>

   </div>

   <div class="row">
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Telefono (opcional)</label>
            <input type="number" class="form-control enable-disabled" id="inputTelefono" name="inputTelefono"
               placeholder="Ej. 733987654" value="{{!empty($empleado[0]->sTelefono) ? $empleado[0]->sTelefono:''}}"
               maxlength="10" disabled>
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Telefono Movil</label>
            <input type="number" class="form-control enable-disabled" id="inputMovil" name="inputMovil"
               placeholder="Ej. 733987654" value="{{!empty($empleado[0]->sMovil) ? $empleado[0]->sMovil:''}}"
               maxlength="10" disabled>
         </div>
      </div>

      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label for="selectPais">Puesto</label>
            <select class="form-control chosenPredictivo enable-disabled" name="selectTipoEmpleado"
               id="selectTipoEmpleado" required disabled>
               @foreach($tipoEmpleado as $tipo)
               @if($tipo->kId == $empleado[0]->iTipoEmpleado)
               <option value='{{$tipo->kId}}' selected>{{$tipo->sDescripcion}}</option>
               @else
               <option value='{{$tipo->kId}}'>{{$tipo->sDescripcion}}</option>
               @endif
               @endforeach
            </select>
         </div>
      </div>

      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Clave del empleado</label>
            <input type="number" class="form-control enable-disabled" id="inputClave" name="inputClave"
               placeholder="Ej. 222734" value="{{!empty($empleado[0]->iCveEmpleado) ? $empleado[0]->iCveEmpleado:''}}"
               maxlength="10" disabled>
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Fecha de ingreso</label>
            <input type="text" class="form-control enable-disabled" id="inputFechaIngreso" name="inputFechaIngreso"
               value="{{!empty($empleado[0]->fFechaAlta) ? \Carbon\Carbon::parse($empleado[0]->fFechaAlta)->format('Y/m/d'):''}}"
               required disabled>
            <small id="campoNomObligatorio" class="form-text text-muted">Este campo es obligatorio en la creación de un
               nuevo registro.</small>
         </div>
      </div>

   </div>
   <div class="row">

      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label>Haz clic en el boton para agregar una dirección</label>
            <br>
            <button type="button" class="btn btn-outline-secondary btn-block" data-toggle="modal"
               data-target="#modalDireccion" data-whatever="@mdo" id="agregarDirecProve" disabled>Agregar
               dirección</button>
            <small id="campoNomObligatorio" class="form-text text-muted">Debera agregar al menos una dirección.</small>
         </div>
      </div>

   </div>
   <br>
   <br>
   <div class="row" id="direccionesEmpleado">
      <div class="col-xs-12 col-md-8">
         <div class="text-center">
            <h5>Lista de direcciones agregadas</h5>
         </div>
         <table class="table" id="TablaDirecciones">
            <thead>
               <tr>
                  <th scope="col" hidden>idDireccion</th>
                  <th scope="col">Pais</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Ciudad</th>
                  <th scope="col">Municipio</th>
                  <th scope="col">Colonia</th>
                  <th scope="col">Calle</th>
                  <th scope="col">Interior</th>
                  <th scope="col">Exterior</th>
                  <th scope="col">CP</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
            <tbody>
               @foreach($direcciones as $direccion)
               <tr id="r{{$loop->index}}">
                  <td hidden>{{!empty($direccion->fkIdDireccion) ? $direccion->fkIdDireccion:''}}</td>
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
                     <button type="submit" class="btn btn-default"
                        onclick='eliminarDireccion("#r{{$loop->index}}",{{$direccion->fkIdDireccion}})' disabled>
                        <i class="fas fa-trash-alt enable-disabled"></i>
                     </button>
                  </td>
               </tr>
               @endforeach
            </tbody>
            </tbody>
         </table>
      </div>
   </div>

</form>

<div class="renglon" id="btnAcciones">
   <a class="btn btn-danger btnAcciones" href="{{ url('/ajaxEmpleado') }}">Cancelar</a>
   <button type="button" class="btn btn-warning btnAcciones" id="btnEditar" onclick='editarEmpleado()'>Editar</button>
   <button type="button" class="btn btn-success btnAcciones" id="btnGuardar" disabled
      onclick='actualizarEmpleado()'>Guardar</button>
</div>
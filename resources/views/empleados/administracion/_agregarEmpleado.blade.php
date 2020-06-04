<form id="EmpleadoForm" name="EmpleadoForm">
   <input type="number" id="idEmpleado" name="idEmpleado" hidden>
   <div class="row">
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label>Nombre (s)</label>
            <input type="text" class="form-control enable-disabled" id="inputNombre" name="inputNombre"
               placeholder="Ej. Jose Luis" required>
            <small id="campoNomObligatorio" class="form-text text-muted">Este campo es obligatorio en la creación de un
               nuevo registro.</small>
         </div>
      </div>
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label>Apellidos</label>
            <input type="text" class="form-control enable-disabled" id="inputApellidos" name="inputApellidos"
               placeholder="Ej. Perez Gomez" required>
            <small id="campoNomObligatorio" class="form-text text-muted">Este campo es obligatorio en la creación de un
               nuevo registro.</small>
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Correo Electronico</label>
            <input type="email" class="form-control enable-disabled" id="inputEmail" name="inputEmail"
               placeholder="Ej. alguien@correo.com" required>
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
               placeholder="Ej. 733987654" maxlength="10">
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Telefono Movil</label>
            <input type="number" class="form-control enable-disabled" id="inputMovil" name="inputMovil"
               placeholder="Ej. 733987654" maxlength="10">
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label for="selectPais">Puesto</label>
            <select class="form-control chosenPredictivo enable-disabled" name="selectTipoEmpleado"
               id="selectTipoEmpleado" required>
               <option value="" id="">Elegir opción</option>
               <option value="0" id="EA">Encargado almacén</option>
               <option value="1" id="VEN">Vendedor</option>
               <option value="2" id="LIM">Limpieza</option>
               <option value="3" id="SIS">Sistemas</option>
               <option value="4" id="ADM">Administrador</option>
               <option value="5" id="CON">Contador</option>
            </select>
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Clave del empleado</label>
            <input type="number" class="form-control enable-disabled" id="inputClave" name="inputClave"
               placeholder="Ej. 222734" maxlength="10">
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Fecha de ingreso</label>
            <input type="date" class="form-control enable-disabled" id="inputFechaIngreso" name="inputFechaIngreso"
               required>
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
               data-target="#modalDireccion" data-whatever="@mdo" id="agregarDirecProve">Agregar
               dirección</button>
            <small id="campoNomObligatorio" class="form-text text-muted">Debera agregar al menos una dirección.</small>
         </div>
      </div>

   </div>
   <br>
   <br>
   <div class="row" id="direccionesEmpleado" hidden>
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

            </tbody>
         </table>
      </div>
   </div>

</form>

<div class="renglon" id="btnAcciones">
   <a class="btn btn-danger btnAcciones" href="{{ url('/ajaxEmpleado') }}">Cancelar</a>
   <button type="button" class="btn btn-success btnAcciones" id="btnGuardar"
      onclick='guardarEmpleado()'>Guardar</button>
</div>
<form id="proveedorForm" name="proveedorForm">
   <input type="number" id="idProveedor" name="idProveedor" hidden>
   <div class="row">
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label>Razón Social</label>
            <input type="text" class="form-control enable-disabled" id="inputRazonSocial" name="inputRazonSocial"
               placeholder="Ej. Proveedor Central S.A de C.V" required>
         </div>
      </div>
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label>RFC</label>
            <input type="text" class="form-control enable-disabled" id="inputRFC" name="inputRFC"
               placeholder="Ej. PROCTRL1234895" required>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Primer Teléfono</label>
            <input type="numer" class="form-control enable-disabled" id="inputPrimerTelefono" name="inputPrimerTelefono"
               placeholder="Ej. 7331441682" required>
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Segundo Telefono</label>
            <input type="number" class="form-control enable-disabled" id="inputSegundoTelefono"
               name="inputSegundoTelefono" placeholder="Ej. 733987654">
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Telefono Movil</label>
            <input type="number" class="form-control enable-disabled" id="inputMovil" name="inputMovil"
               placeholder="Ej. 733987654">
         </div>
      </div>
      <div class="col-xs-12 col-md-2">
         <div class="form-group">
            <label>Correo Electronico</label>
            <input type="email" class="form-control enable-disabled" id="inputEmail" name="inputEmail"
               placeholder="Ej. alguien@correo.com" required>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label>Datos de contacto</label>
            <input type="text" class="form-control enable-disabled" id="inputDatosContacto" name="inputDatosContacto"
               placeholder="Ej. Luis Cuevas Díaz" required>
         </div>
      </div>
      <div class="col-xs-12 col-md-4">
         <div class="form-group">
            <label>Haz clic en el boton para agregar una dirección</label>
            <br>
            <button type="button" class="btn btn-outline-secondary btn-block" data-toggle="modal"
               data-target="#modalDireccion" data-whatever="@mdo" id="agregarDirecProve">Agregar
               dirección</button>
         </div>
      </div>
   </div>
   <br>
   <br>
   <div class="row" id="direccionesProveedor" hidden>
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
   <a class="btn btn-danger btnAcciones" href="{{ url('/ajaxProveedor') }}">Cancelar</a>
   <button type="button" class="btn btn-success btnAcciones" id="btnGuardar"
      onclick='guardarProveedor()'>Guardar</button>
</div>
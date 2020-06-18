<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>Farmacia</title>

   <!-- Fonts -->
   <link href="{{ asset('../css/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

   <!-- Css -->
   <link href="{{ asset('../css/sb-admin-2.min.css') }}" rel="stylesheet">
   <link href="{{ asset('../css/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
   <link href="{{ asset('../css/layoutStyle.css') }}" rel="stylesheet">
   <link href="{{ asset('../css/bootstrap-chosen.css') }}" rel="stylesheet">

   <!-- Jquery para poder usar ajax-->
   <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
   <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   <script src="https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"></script>
   <script src="{{ asset('../js/layoutScript.js') }}"></script>
   <script src="{{ asset('../js/chosen.jquery.js') }}"></script>


</head>

<body id="page-top">
   <!-- Page Wrapper -->
   <div id="wrapper">

      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

         <!-- Sidebar - Brand -->
         <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
            <div class="sidebar-brand-icon ">
            <i class="fas fa-clinic-medical"></i>
               <i class="fas fa-first-aid"></i> -->
         <!-- <img  src="../images/icon-farmacia.png" alt="" width="50" height="50" > -->
         <!-- </div>
            <div class="sidebar-brand-text mx-3">interGenerica</div>
         </a> -->

         <!-- Divider -->
         <hr class="sidebar-divider my-0">

         <!-- Nav Item - Dashboard -->
         <li class="nav-item active">
            <a class="nav-link" href="{{ url('/home') }}">
               <i class="fas fa-clinic-medical"></i>
               <span>Inicio</span></a>
         </li>
         <hr class="sidebar-divider">
         <br>
         <br>
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lstInventario"
               aria-expanded="true" aria-controls="lstInventario">
               <i class="fas fa-file-alt fa-2x"></i>
               <span>Inventario</span>
            </a>
            <div id="lstInventario" class="collapse" aria-labelledby="lstInventario" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item efectoHover" href="{{ url('/moduloInventario')}}"
                     onclick='mostrarLoading()'>Ver todo</a>
                  <a class="collapse-item efectoHover" href="{{ url('/verInventario')}}"
                     onclick='mostrarLoading()'>Nuestro inventario</a>
                  <a class="collapse-item" href="{{ url('/detalleArticulo') }}" onclick='mostrarLoading()'>Admin de
                     productos</a>
                  <a class="collapse-item" href="{{ url('/ajaxDepartamento') }}"
                     onclick='mostrarLoading()'>Departamentos</a>
                  <a class="collapse-item" href="{{ url('/ajaxlaboratorio') }}"
                     onclick='mostrarLoading()'>Laboratorios</a>
                  <a class="collapse-item" href="{{ url('/ajaxLista') }}" onclick='mostrarLoading()'>Tipos de lista</a>
                  <a class="collapse-item" href="{{ url('/ajaxAlmacen') }}" onclick='mostrarLoading()'>Almacenes</a>
               </div>
            </div>
         </li>

         <hr class="sidebar-divider">
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lstAdmin" aria-expanded="true"
               aria-controls="lstAdmin">
               <i class="fas fa-tools"></i>
               <span>Administración</span>
            </a>
            <div id="lstAdmin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="{{ url('/moduloAdministracion') }}" onclick='mostrarLoading()'>Ver
                     todos</a>
                  <a class="collapse-item" href="{{ url('/ajaxEmpleado') }}" onclick='mostrarLoading()'>Empleados</a>
                  <a class="collapse-item" href="{{ url('/ordenCompra') }}" onclick='mostrarLoading()'>Orden de
                     compras</a>
                  <a class="collapse-item" href="{{ url('/notFound') }}">Empresas</a>
                  <a class="collapse-item" href="{{ url('/notFound') }}">Cuentas bancarias</a>
               </div>
            </div>
         </li>

         <hr class="sidebar-divider">
         <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lstProveedores"
               aria-expanded="true" aria-controls="lstProveedores">
               <i class="fas fa-truck-moving"></i>
               <span>Servicios</span>
            </a>
            <div id="lstProveedores" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="{{ url('/moduloServicios') }}" onclick='mostrarLoading()'>Ver todos</a>
                  <a class="collapse-item" href="{{ url('/ajaxProveedor') }}" onclick='mostrarLoading()'>Proveedores</a>
                  <a class="collapse-item" href="{{ url('/notFound') }}" onclick='mostrarLoading()'>Clientes
                     mayoristas</a>
               </div>
            </div>
         </li>

         <!-- Divider -->
         <hr class="sidebar-divider d-none d-md-block">

         <!-- Sidebar Toggler (Sidebar) -->
         <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
         </div>

      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

         <!-- Main Content -->
         <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

               <!-- Sidebar Toggle (Topbar) -->
               <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
               </button>

               <!-- Topbar Search -->
               <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                  <div class="input-group">
                     <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..."
                        aria-label="Search" aria-describedby="basic-addon2">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                           <i class="fas fa-search fa-sm"></i>
                        </button>
                     </div>
                  </div>
               </form>

               <!-- Topbar Navbar -->
               <ul class="navbar-nav ml-auto">

                  <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                  <li class="nav-item dropdown no-arrow d-sm-none">
                     <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                     </a>
                     <!-- Dropdown - Messages -->
                     <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                           <div class="input-group">
                              <input type="text" class="form-control bg-light border-0 small"
                                 placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                              <div class="input-group-append">
                                 <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                 </button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </li>

                  <!-- Nav Item - Alerts -->
                  <li class="nav-item dropdown no-arrow mx-1">
                     <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">3+</span>
                     </a>
                     <!-- Dropdown - Alerts -->
                     <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                           Notificaciones pendientes
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                           <div class="mr-3">
                              <div class="icon-circle bg-primary">
                                 <i class="fas fa-file-alt text-white"></i>
                              </div>
                           </div>
                           <div>
                              <div class="small text-gray-500">Enero 30, 2020</div>
                              <span class="font-weight-bold">Venta realizada con exito!</span>
                           </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                           <div class="mr-3">
                              <div class="icon-circle bg-success">
                                 <i class="fas fa-donate text-white"></i>
                              </div>
                           </div>
                           <div>
                              <div class="small text-gray-500">Enero 30, 2020</div>
                              Venta cancelada por el cliente.
                           </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                           <div class="mr-3">
                              <div class="icon-circle bg-warning">
                                 <i class="fas fa-exclamation-triangle text-white"></i>
                              </div>
                           </div>
                           <div>
                              <div class="small text-gray-500">Enero 30, 2020</div>
                              Ya no contamos con presentacion tabletas para el producto XXXXXXXXXXXXX, favor de pedir a
                              almacen que resurtan la sucursal 1.
                           </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                     </div>
                  </li>

                  <!-- Nav Item - Messages -->
                  <li class="nav-item dropdown no-arrow mx-1">
                     <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter">7</span>
                     </a>
                     <!-- Dropdown - Messages -->
                     <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                           Mensajes recibidos
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                           <div class="dropdown-list-image mr-3">
                              <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                              <div class="status-indicator bg-success"></div>
                           </div>
                           <div class="font-weight-bold">
                              <div class="text-truncate">Hola vendedor, hoy podras cerrar hasta las 10:00 pm</div>
                              <div class="small text-gray-500">Administrador · 58m</div>
                           </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                           <div class="dropdown-list-image mr-3">
                              <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                              <div class="status-indicator"></div>
                           </div>
                           <div>
                              <div class="text-truncate">No se te olvide que el dia lunes es dia festivo, no vamos a
                                 laborar</div>
                              <div class="small text-gray-500">Suc 2 · 1d</div>
                           </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                           <div class="dropdown-list-image mr-3">
                              <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                              <div class="status-indicator bg-warning"></div>
                           </div>
                           <div>
                              <div class="text-truncate">Hola que hace!</div>
                              <div class="small text-gray-500">Suc 4 · 2d</div>
                           </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                           <div class="dropdown-list-image mr-3">
                              <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                              <div class="status-indicator bg-success"></div>
                           </div>
                           <div>
                              <div class="text-truncate">Ya estoy por cerrar el almacen, alguien necesita algo¿?.</div>
                              <div class="small text-gray-500">Chicken the Dog · 2w</div>
                           </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                     </div>
                  </li>

                  <div class="topbar-divider d-none d-sm-block"></div>

                  <!-- Nav Item - User Information -->
                  @guest
                  <li class="nav-item">
                     <a class="nav-link" href="{{ url('/') }}">{{ __('Login') }}</a>
                     <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
                  </li>
                  @if (Route::has('register'))
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
                  @endif
                  @else
                  <li class="nav-item dropdown no-arrow">
                     <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Bienvenido
                           {{ Auth::user()->sUsrName}}</span>
                        <img class="img-profile rounded-circle" src="{{URL::asset('../images/avatar.png')}}">
                     </a>
                     <!-- Dropdown - User Information -->
                     <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                           <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                           Profile
                        </a>
                        <a class="dropdown-item" href="#">
                           <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                           Settings
                        </a>
                        <a class="dropdown-item" href="#">
                           <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                           Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                           <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                           Cerrar sesión
                        </a>
                     </div>
                  </li>
                  @endguest
               </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
               <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="messageTitleModal"></h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body" id="messageBodyModal">
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Entendido!</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="loading" class="Loader"></div>
               <main class="py-4">
                  @yield('content')
               </main>
            </div>
            @yield('script')
            <!-- /.container-fluid -->

         </div>
         <!-- End of Main Content -->

         <!-- Footer -->
         <footer class="sticky-footer bg-white">
            <div class="container my-auto">
               <div class="copyright text-center my-auto">
                  <span>Copyright &copy;FARMACIAS INTERGENERICA 2020 - 2020</span>
               </div>
            </div>
         </footer>
         <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->
   <!-- Scroll to Top Button-->
   <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
   </a>

   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
            </div>
            <div class="modal-body">¿Seguro que quieres cerrar sesión?.</div>
            <div class="modal-footer">
               <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
               <a class="btn btn-primary" href="{{ route('logout') }}"
                  onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar sesión</a>

               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
               </form>
            </div>
         </div>
      </div>
   </div>

   <!-- Js template-->
   <script src="{{ asset('../js/vendor/jquery/jquery.min.js') }}" defer></script>
   <script src="{{ asset('../js/sb-admin-2.js') }}" defer></script>
   <script src="{{ asset('../js/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
   <script src="{{ asset('../vendor/datatables/jquery.dataTables.min.js') }}" defer></script>
   <script src="{{ asset('../vendor/datatables/dataTables.bootstrap4.min.js') }}" defer></script>

</body>

</html>

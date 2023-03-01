<html>
<head>
    <?php $_css->heading(); ?>
  <title>Personal</title>
  <link rel="stylesheet" type="text/css"  href="assets\css\personal.css"></link>
  <!-- Link datatables -->
    <link rel="stylesheet" type="text/css" href="assets/css/DataTables/css/dataTables.bootstrap5.min.css">
</head>
<body>

<!-- PANTALLA CARGA -->

	<div id="contenedor_carga">
		<div id="carga"></div>
	</div>

<?php $_comp->navInicioAdmin(); ?>
	
    <!-- NAVEGACION DE DASHBOARD-->
    
    <div class="container-fluid px-4">
		<div class="card mb-4 mt-4">
            <div class="card-header card-header-principal">
				<i class="fa-solid fa-gears iconTitle"></i>
                <h1 class="m-0 d-inline">Gestionar Personal</h1>
            </div>
			<nav style="--bs-breadcrumb-divider: '>';" class="p-2 nav-Breadcrumb" >
  				<ol	ol class="breadcrumb">
   					<li class="breadcrumb-item"><i class="fa-solid fa-house me-2"></i><a href="?url=dashboard">Panel de Control</a></li>
                    <li class="breadcrumb-item"><a href="?url=dashboard&type=personal">Personal</a></li>
  				</ol>
			</nav>
		</div>

        <!-- TABLA DE ADMINISTRADORES -->

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header fs-5">
                        <i class="fa-solid fa-users-between-lines me-2"></i>
                        Personal
                        <button type="button" class="btn btn-primary h-25 float-end" data-bs-toggle="modal" data-bs-target="#modalPersonal" id="crear"><i class="fa-solid fa-user-plus"></i></button>
                         <button type="button" class="btn btn-danger h-25 float-end me-3" data-bs-toggle="modal" data-bs-target="#reportePersonal" id="reporte"><i class="fa-solid fa-download"></i></button>
                    </div>
					<div class="card-body">
                        <div class="container-fluid table-responsive">
                            <table class="table table-striped mb-4" id="tablePersonal">
                                <thead>
                                    <tr>
                                        <th class="tabla">Cedula</th>
                                        <th class="tabla">Nombre</th>
                                        <th class="tabla">Apellido</th>
                                        <th class="tabla">Rol</th>
                                        <th class="tabla">Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyPersonal">
        
                                </tbody>
                            </table>
                        </div>
					</div> 
                </div>
                
            </div>
    	</div>

        <!-- Tabla de Roles -->
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header fs-5">
                        <i class="fas fa-list me-2"></i>
                        Roles de Usuario
                        <button type="button" class="btn btn-primary h-25 float-end" data-bs-toggle="modal" data-bs-target="#modalRol" id="crearRol"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid table-responsive">
                            <table class="table table-striped mb-4" id="tblRoles"> 
                                <thead>
                                    <tr>
                                        <th class="tabla">Nombre del Rol</th>
                                        <th class="tabla">Descripción del Rol</th>
                                        <th class="tabla">Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyRoles">

                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
                
            </div>
        </div>
	</div>

 		

    <!-- MODAL DEL PERSONAL -->

    <div class="modal fade" id="modalPersonal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="adminForm" target="__blank">
                    <div class="modal-header">
                        <h5 id="tituloModal" class="modal-title"><i class="fa-solid fa-user-plus me-2"></i>Agregar Personal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">V-</span>
                                <div class="form-floating">
                                    <input type="text"  class="form-control" id="adminCedula" placeholder="Numero de cedula"  require="" name="adminCedula" maxlength="8" onkeypress="return !(event.charCode < 48 || event.charCode > 57)" >
                                    <label for="adminCedula">Numero de cedula</label>
                                </div>
                            </div>
                            <div id="errorCed" class="errors"></div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="adminNombre" placeholder="Nombre"  require="" name="adminNombre" onkeypress="return !(event.charCode > 32 && event.charCode < 65)">
                            <label for="adminNombre">Nombre</label>
                            <div id="errorNom" class="errors"></div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="adminApellido" placeholder="Apellido"  require="" name="adminApellido" onkeypress="return !(event.charCode > 32 && event.charCode < 65)">
                            <label for="adminApellido">Apellido</label>
                            <div id="errorApe" class="errors"></div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="adminCorreo" placeholder="correo"  require="" name="adminCorreo">
                            <label for="adminCorreo">Correo</label>
                            <div id="errorEmail" class="errors"></div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" title="La contraseña debe contener 8 caracteres" class="form-control" id="adminClave" placeholder="Contraseña"  require="" name="adminClave">
                            <label for="adminClave">Contraseña</label>
                            <div id="errorPass" class="errors"></div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="adminClaveR" placeholder="Repetir Contraseña"  require="" name="adminClaveR">
                            <label for="adminCorreo">Repetir Contraseña</label>
                            <div id="errorPassR" class="errors"></div>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <select class="form-select" id="adminRol" require="" name="adminRol">
                            </select>
                            <label for="adminRol">¿Cual es el rol del usuario?</label>
                            <div id="errorRol" class="errors"></div>
                        </div>

                        <div class="form-floating mb-3" id="selectEditStatus">
                            <select class="form-select" id="editStatus" require="" name="editStatus">
                                <option value="0">Inactivo</option>
                                <option value="1">Activo</option>
                            </select>
                            <label for="adminRol">Estado del Personal:</label>
                            <div id="errorEditStatus" class="errors"></div>
                        </div>
                        
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark me-2"></i>Cancelar</button>
                        <button type="button" id="envioUser" class="btn btn-success"><i class="fa-solid fa-check me-2"></i>Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <!-- Modal Agregar Rol -->

    <div class="modal fade" id="modalRol" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 id="rolTitulo" class="modal-title fs-5">Agregar Nuevo Rol</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" id="rolForm">
              <div class="mb-3">
                 <div class="form-floating mb-3 me-3 col">
                    <input type="number" class="form-control" id="nroRol" placeholder="Nroº Rol" value="001" require="" name="idRol" disabled readonly>
                    <label for="funcionNro">Nroº de Rol</label>
                </div>
              </div>
              <div class="mb-3">
                <div class="form-floating mb-3 me-3 col">
                    <input type="text" class="form-control" id="nombreRol" placeholder="Nombre del Rol"  require="" name="nombreRol" onkeypress="return !(event.charCode > 32 && event.charCode < 65)">
                     <label for="nombreRol">Nombre del Rol</label>
                    <div id="errorNombreRol" class="errors"></div>
                </div>
              </div>

              <div class="mb-3">
                <div class="form-floating mb-3 me-3 col">
                    <textarea class="form-control" id="descripcionRol" name="descripcionRol" onkeypress="return !(event.charCode > 32 && event.charCode < 65)"></textarea>
                     <label for="descripcionRol">Descripción del Rol</label>
                    <div id="errorDescRol"  class="errors"></div>
                </div>
              </div>
              <div class="form-floating mb-3 me-3" id="selectStatusRol">
                 <select class="form-select" id="statusRol" require="" name="editStatusRol">
                    <option value="0">Inactivo</option>
                    <option value="1">Activo</option>
                    </select>
                    <label for="adminRol">Estado del Rol:</label>
                    <div id="errorStatusRol" class="errors"></div>
                    </div>
            </form>
          </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark me-2"></i>Cancelar</button>
            <button type="button" id="envioRol" class="btn btn-success"><i class="fa-solid fa-check me-2"></i>Guardar</button>
            </div>
        </div>
      </div>
    </div>

    <!-- Modal gestionar permisos -->

    <div class="modal fade" id="modalPermisos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"><i class="fa-solid fa-key me-2"></i>Selecione los Permisos del Rol</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="formPermisos" class="">
                    <div class="form-floating mb-3">
                        <input type="hidden" class="form-control" id="rolPermiso" placeholder="Nro de Rol"  require="" name="rolPermiso" value="">
                    </div>

                        <div id="errorCed"></div>  
            <div class="mb-3 row text-center">
                   <div class="col-6 mb-3">
                       Modulo
                   </div>
                   <div class="col-6 mb-3">
                       Desactivar/Activar
                   </div>
                   <?php foreach ($modulos as $module) { ?>
                   <div class="col-6 mb-3">
                       <?php echo $module["nombreModulo"]; ?>
                   </div>
                   <div class="col-6 mb-3">
                       <div class="form-check form-switch d-flex justify-content-center aling-items-center">
                          <input class="form-check-input" type="checkbox" role="switch" name="permisos<?php echo $module['idModulo']; ?>" value="1">
                        </div>
                   </div>
                    <?php } ?>

               
              </div>
                </div>
                <div class="modal-footer">
                 <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark me-2"></i>Cancelar</button>
                <button type="submit" id="botonPermisos" name="envioPermisos" value="1" class="btn btn-success"><i class="fa-solid fa-check me-2"></i>Guardar</button>
                </form>
            </div>
            </div>
            
        </div>
        
    </div>

    <!-- MODAL DE GENERAR REPORTE -->

    <div class="modal fade" id="reportePersonal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="reporteForm" target="__blank">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-download me-2"></i>Generar Reporte</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                      <div class="mb-3 me-3 col form-check form-switch">
                            <input type="checkbox" class="form-check-input" role="switch" name="fechaRegistro" id="checkFechas" value="1">
                            <label for="checkFechas">Generar por fecha de registro</label>
                        </div>

                        <div id="fechasRegistro">
                         <div class="form-floating mb-3 me-3 col">
                            <input type="date" class="form-control" id="fechaInicial" name="fechaInicial">
                            <label for="fechaInicial">Desde:</label>
                            <div id="errorFechaInicio"></div>
                        </div>

                        <div class="form-floating mb-3  me-3 col">
                            <input type="date" class="form-control" id="fechaFinal" name="fechaFinal">
                            <label for="fechaFinal">Hasta:</label>
                            <div id="errorFechaFinal"></div>
                        </div> 
                        </div>
                        <div class="form-floating mb-3  me-3 col" id="personalSelect">
                            <select class="form-select" id="cargoPersonal" name="tipoPersonal">
                            </select>
                            <label for="cargoPersonal">Seleccione el cargo:</label>
                            <div id="errorCargo"></div>
                        </div>

                        <div class="form-floating mb-3  me-3 col" id="selectEstado">
                            <select class="form-select" id="estadoPersonal" name="estadoPersonal">
                              <option selected="" value="0">Todos</option>
                              <option value="1">Activo</option>
                              <option value="2">Inactivo</option>
                            </select>
                            <label for="estadoPersonal">Seleccione el estado:</label>
                            <div id="errorEstadoPersonal"></div>
                        </div>
                          <div id="errorReporte"></div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark me-2"></i>Cancelar</button>
                        <button type="submit" id="generarReporte" name="generarReporte" class="btn btn-success"><i class="fa-solid fa-check me-2"></i>Generar Reporte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>  

<?php $_comp->footer(); ?>
<?php if(isset($register)){echo $register;}
    if (isset($nuevoRol)) {
        echo $nuevoRol;
    }
    if (isset($reporte)) {
      echo $reporte;
    }
    if (isset($gestionPermisos)) {
        echo $gestionPermisos;
    }
?>
<script src="assets/js/personal.js"></script>
<!-- DataTables Js -->
<script src="assets/js/DataTables/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/DataTables/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>
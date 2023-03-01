<html>
<head>
    <?php $_css->heading(); ?>
    <title>Consultar Cita</title>
    <link rel="stylesheet" type="text/css" href="assets\css\ventas.css">
    <link rel="stylesheet" href="assets\css\DataTables\css\dataTables.bootstrap5.min.css">
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
            <div class="card-header w-100 card-header-principal">
				<i class="fa-solid fa-gears iconTitle"></i>
                <h1 class="m-0 d-inline"> Gestionar Citas</h1>
            </div>
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="p-2 nav-Breadcrumb" >
  				<ol	ol class="breadcrumb">
   					<li class="breadcrumb-item"><i class="fa-solid fa-house me-2"></i><a href="?url=dashboard">Panel de Control</a></li>
                    <li class="breadcrumb-item"><a href="?url=cita&type=consultar">Citas</a></li>
  				</ol>
			</nav>
		</div>

        <!-- TABLA DE VENTAS -->

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header fs-5">
                        <i class="fa-solid fa-calendar-check me-2"></i>
                        Citas

                         <button type="button" class="btn btn-danger h-25 float-end reporte" data-bs-toggle="modal" data-bs-target="#modalReporte" id="myInput"><i class="fa-solid fa-download"></i></button>
                    </div>
					<div class="card-body">
                        <!-- <h4 class="mb-3 ms-3">Filtrar por:</h4>
                        <form action="" method="" class="row align-items-center ms-1 mb-2">

                        	<div class="col-lg-3 col-md-5 ">
                                <div class="form-group my-2">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            Estado:
                                        </span>
                                        <select class="form-select">
                                        	<option value="" selected="">Todas</option>+
                                        	<option value="1">Por verificar</option>
                                            <option value="2">Aceptada</option>
                                            <option value="3">Rechazada</option>
                                            <option value="3">Cancelada</option>
                                        </select>
                                    </div>
                                </div>					
                            </div>

                            <div class="col-lg-3 col-md-5">
                                <div class="form-group my-2">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            Fecha:
                                        </span>
                                        <input type="date" name="filterDate" class="form-control">   
                                    </div>
                                </div>                  
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-12 d-flex justify-content-center">
                                <div class="form-group my-2 w-100">
                                    <button class="btn btn-danger btnVentas w-100">Aplicar</button>
                                </div>
                            </div> -->

                            <!-- <div class="col-lg-3 ms-auto">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control" type="search" placeholder="Buscar..." aria-label="Buscar Función">
                                        <span class="btn btn-success d-flex align-items-center">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div> -->
                        </form>
                        <div class="container-fluid table-responsive">
                            <table class="table table-striped" id="citaTabla">
                                <thead>
                                    <tr>
                                        <th class="tabla">Evento</th>
                                        <th class="tabla">Servicio</th>
                                        <th class="tabla">Fecha</th>
										<th class="tabla">Hora</th>
                                        <th class="tabla">Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="citaCuerpo">
                                </tbody>
                            </table>
                        </div>
					</div> 
                </div>
            </div>
    	</div>
	</div>		

    <!-- MODAL DE MODIFICAR FECHA Y HORA -->

    <div class="modal fade" id="modalModificar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="formUpdate">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-pen-to-square i-modificar"></i> Modificar Fecha y Hora de la Cita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body justify-content-center">

                        <div class="d-flex flex-wrap">

                            <input type="hidden" id="citaNumero" disabled="">

                            <div class="mb-1 col-12" id="errorPeticion"></div>

                            <div class="form-floating mb-3 me-3 col">
                                <input type="date" class="form-control" disabled="" id="fechaActual" require="" name="fechaActual">
                                <label for="fechaActual">Fecha Actual:</label>
                                <div id="errorFechaActual"></div>
                            </div>

                            <div class="form-floating mb-3 col">
                                <input type="time" class="form-control" disabled="" id="horaActual" require="" name="horaActual">
                                <label for="horaActual">Hora Actual:</label>
                                <div id="errorHoraActual"></div>
                            </div>

                        </div>

                        <div class="d-flex flex-wrap">

                            <div class="form-floating mb-1 me-3 col">
                                <input type="date" class="form-control" id="fechaModificar" require="" name="fechaModificar">
                                <label for="fechaModificar">Nueva Fecha:</label>
                                <p id="errorFechaModificar"></p>
                            </div>

                            <div class="form-floating mb-1 col">
                                <input type="time" class="form-control" id="horaModificar" require="" name="horaModificar">
                                <label for="horaModificar">Nueva Hora:</label>
                                <p id="errorHoraModificar"></p>
                            </div>

                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark me-2"></i>Cancelar</button>
                        <button type="button" id="modificarCita" class="btn btn-success"><i class="fa-solid fa-check me-2"></i>Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>        
    </div>

    <!-- MODAL DE GENERAR REPORTE -->

    <div class="modal fade" id="modalReporte" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="funcionForm">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-download me-2"></i>Generar Reporte</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-floating mb-3  me-3 col">
                            <input type="date" class="form-control" id="fechaInicio" require="" name="fechaIncio">
                            <label for="funcionFecha">Desde:</label>
                            <p id="errorFechaInicio"></p>
                        </div>

                        <div class="form-floating mb-3  me-3 col">
                            <input type="date" class="form-control" id="fechaFin" require="" name="fechaFinal">
                            <label for="funcionFecha">Hasta:</label>
                            <p id="errorFechaFinal"></p>
                        </div>

                        <div class="form-floating mb-3  me-3 col">

                            <select  class="form-select" id="estadoCita" name="rEstadoCita">

                                <option value="4">Todas</option>
                                <option value="1">Por Aceptar</option>
                                <option value="2">Aceptada</option>
                                <option value="3">Cancelada</option>
                                <option value="0">Rechazada</option>
                                
                            </select>    

                            <label for="estadoCita">Seleccione Estado de Cita</label>
                            <p id="errorEstadoCita"></p>
                        </div>

                         <div class="form-floating mb-3  me-3 col">

                            <select  class="form-select" id="tipoCita" name="rTipoCita">

                                <option value="0">Todas</option>
                                <option value="1">Persona Natural</option>
                                <option value="2">Empresa Jurídica</option>
                                
                            </select>    

                            <label for="tipoCita">Seleccione el Tipo de Cita</label>
                            <p id="errorTipoCita"></p>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark me-2"></i>Cancelar</button>
                        <button type="button" value="envio" name="generarReporte" id="generarReporteCita" class="btn btn-success modalDeReporte"><i class="fa-solid fa-check me-2"></i>Generar Reporte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>	

<?php  $_comp->footer(); ?>
<script type="text/javascript" src="assets/js/consultarCita.js"></script>
<script type="text/javascript" src="assets/js/DataTables/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/DataTables/js/dataTables.bootstrap5.min.js"></script>
<?php 
    if (isset($modificarData)){
        
        echo $modificarData;
    } 

    else if (isset($data)) {
        echo $data;
    } else {
        echo "";
    }
?>
</body>
</html>
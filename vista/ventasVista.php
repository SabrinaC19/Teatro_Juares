<html>
<head>
    <?php $_css->heading(); ?>
    <title>Ventas #PatiñoHDP</title>
    <link rel="stylesheet" type="text/css" href="assets\css\ventas.css">
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
            <div class="card-header w-100 card-header-principal">
				<i class="fa-solid fa-gears iconTitle"></i>
                <h1 class="m-0 d-inline">Gestión de Ventas</h1>
            </div>
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="p-2 nav-Breadcrumb" >
  				<ol	ol class="breadcrumb">
   					<li class="breadcrumb-item"><i class="fa-solid fa-house me-2"></i><a href="?url=dashboard">Panel de Control</a></li>
                    <li class="breadcrumb-item"><a href="?url=dashboard&type=ventas">Ventas</a></li>
  				</ol>
			</nav>
		</div>

        <!-- TABLA DE VENTAS -->

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header fs-5">
                        <i class="fa-solid fa-film me-2"></i>
                        Ventas

                        <button type="button" class="btn btn-danger h-25 float-end" data-bs-toggle="modal" data-bs-target="#modalReporte" id="myInput"><i class="fa-solid fa-download"></i></button>
                    </div>
					<div class="card-body">
                        <div class="container-fluid table-responsive">
                            <table class="table table-striped" id="tblVentas">
                                <thead>
                                    <tr>
                                        <th class="tabla">Cliente</th>
                                        <th class="tabla">Evento</th>
                                        <th class="tabla">Fecha</th>
                                        <th class="tabla">Hora</th>
										<th class="tabla">Monto</th>
                                        <th class="tabla">Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="ventasBody">
                                    
                                </tbody>
                            </table>
                        </div>
					</div> 
                </div>
            </div>
    	</div>

        <!-- TABLA DE BANCOS -->

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header fs-5">
                        <i class="fas fa-building-columns me-2"></i>
                        Bancos
                        <button type="button" class="btn btn-primary h-25 float-end" data-bs-toggle="modal" data-bs-target="#modalBancos" id="crearBanco"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid table-responsive">
                            <table class="table table-striped mb-4" id="tblBancos">
                                <thead>
                                    <tr>
                                        <th class="tabla">Codigo Banco</th>
                                        <th class="tabla">Nombre del Banco</th>
                                        <th class="tabla">Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="bancosBody">
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
                
            </div>
        </div>

	</div>		

    <!-- MODAL DE GENERAR REPORTE -->

    <div class="modal fade" id="modalReporte" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" id="funcionForm" target="__blank">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fa-solid fa-download me-2"></i>Generar Reporte</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-floating mb-3  me-3 col">
                            <input type="date" class="form-control" id="funcionFecha" require="" name="fechaInicio">
                            <label for="funcionFecha">Desde:</label>
                            <div id="errorFecha"></div>
                        </div>

                        <div class="form-floating mb-3  me-3 col">
                            <input type="date" class="form-control" id="funcionFecha" require="" name="fechaFinal">
                            <label for="funcionFecha">Hasta:</label>
                            <div id="errorFecha"></div>
                        </div>

                        <div class="form-floating mb-3  me-3 col">
                            <select class="form-select" id="tipoCompra" name="tipoCompra">
                                <option value="0" selected="">Todas</option>
                                <option value="1">Taquilla</option>
                                <option value="2">Digital</option>
                            </select>
                            <label for="funcionFecha">Tipo de venta...</label>
                            <div id="errorFecha"></div>
                        </div>

                        <div class="form-floating mb-3  me-3 col">
                            <select class="form-select" id="estadoVenta" name="estadoVenta">
                                <option value="3" selected="">Todos</option>
                                <option value="0">Por verificar</option>
                                <option value="1">Aceptadas</option>
                                <option value="2">Rechazadas</option>
                            </select>
                            <label for="funcionFecha">Seleccionar Estado...</label>
                            <div id="errorFecha"></div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark me-2"></i>Cancelar</button>
                        <button type="submit" name="envioReporte" id="nuevoUser" class="btn btn-success"><i class="fa-solid fa-check me-2"></i>Generar Reporte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>	

    <!-- Modal Agregar Banco -->

    <div class="modal fade" id="modalBancos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="titulo-modal">Agregar Nuevo Banco</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" id="bancosForm">
              <div class="mb-3">
                 <div class="form-floating mb-3 me-3 col">
                    <input type="text" class="form-control" id="codBanco" placeholder="Codigo de Banco" require="" name="idBanco">
                    <label for="codBanco">Codigo de Banco</label>
                    <div id="errorCodigoBanco"></div>
                </div>
              </div>
              <div class="mb-3">
                <div class="form-floating mb-3 me-3 col">
                    <input type="text" class="form-control" id="nombreBanco" placeholder="Nombre del Banco"  require="" name="nombreBanco">
                     <label for="nombreBanco">Nombre del Banco</label>
                    <div id="errorNombreBanco"></div>
                </div>
              </div>

            <div class="form-floating mb-3" id="selectEstado">
                <select class="form-select" id="estadoBanco" require="" name="estadoBanco">
                    <option value="0">Inactivo</option>
                    <option value="1">Activo</option>
                </select>
                <label for="estadoBanco">¿Cual es el estado del banco?</label>
                <div id="errorEstadoBanco"></div>
            </div>
            
          </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark me-2"></i>Cancelar</button>
            <button type="button" id="enviarBanco" class="btn btn-success"><i class="fa-solid fa-check me-2"></i>Guardar</button>
            </div>
        </div>
        </form>
      </div>
    </div>

<?php $_comp->footer(); ?>
<?php if (isset($respuesta)) {
    echo $respuesta;
} 
    if (isset($generarReporte)) {
        echo $generarReporte;
    }
?>
<script type="text/javascript" src="assets/js/ventas.js"></script>
<script src="assets/js/DataTables/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/DataTables/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>
<html>
<head>
    <?php $_css->heading(); ?>
    <title>Panel de Control</title>
    <link rel="stylesheet" type="text/css"  href="assets\css\dashboard.css"></link>
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
            <div class="card-header card-header-principal fs-3">
				<i class="fa-solid fa-gears iconTitle"></i>
                <h1 class="m-0 d-inline">Bienvenido <?php echo utf8_encode($_SESSION["nombre"]); ?></h1>
            </div>
			<nav style="--bs-breadcrumb-divider: '>';" class="p-2 nav-Breadcrumb" >
  				<ol	ol class="breadcrumb">
   					<li class="breadcrumb-item"><i class="fa-solid fa-house me-2"></i><a href="?url=dashboard">Panel de Control</a></li>
  				</ol>
			</nav>
		</div>

        <div class="row">
			<div class="col">
				<div class="card mb-4">
                	<div class="card-header fs-5">
                        <i class="fas fa-chart-bar me-1"></i>
                        Estadísticas
                    </div>
					<div class="row">
                        <?php if ($userSession->requestAccess($_SESSION["rol"], PERSONAL)){ ?>
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="container pe-0 text-center stats">
								<a class="w-100 h-100 d-flex" href="?url=dashboard&type=personal">
									<div class="w-50 h-100 text-white iconStats iconStats-u"><i class="fa-solid fa-users-between-lines me-2"></i></div>
									<div class="w-50 h-100 p-3" >
										Personal
										<div class="fs-5"><?php if(isset($readPersonal)){echo $readPersonal;}?></div>
									</div>
								</a>
							</div>
						</div>
                    <?php } ?>
                    <?php if ($userSession->requestAccess($_SESSION["rol"], CLIENTES)){ ?>
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="container pe-0 text-center stats">
								<a class="w-100 h-100 d-flex" href="?url=dashboard&type=clientes">
									<div class="w-50 h-100 text-white iconStats iconStats-c"><i class="fa-solid fa-user-tag me-2"></i></div>
									<div class="w-50 h-100 p-3">
										Clientes
										<div class="fs-5"><?php if(isset($readClientes)){echo $readClientes;}?></div>
									</div>
								</a>
							</div>
						</div>
                    <?php } ?>
                    <?php if ($userSession->requestAccess($_SESSION["rol"], EVENTOS)){ ?>
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="container pe-0 text-center stats">
								<a class="w-100 h-100 d-flex" href="?url=dashboard&type=eventos">
									<div class="w-50 h-100 text-white iconStats iconStats-f"><i class="fa-solid fa-film me-2"></i></div>
									<div class="w-50 h-100 p-3" >
										Eventos
										<div class="fs-5"><?php if(isset($readEventos)){echo $readEventos;}?></div>
									</div>
								</a>
							</div>
						</div>
                    <?php } ?>
                    <?php if ($userSession->requestAccess($_SESSION["rol"], VENTAS)){ ?>
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="container pe-0 text-center stats">
								<a class="w-100 h-100 d-flex" href="?url=dashboard&type=ventas">
									<div class="w-50 h-100 text-white iconStats iconStats-v"><i class="fa-solid fa-circle-dollar-to-slot me-2"></i></div>
										<div class="w-50 h-100 p-3" >
										Ventas
										<div class="fs-5"><?php if(isset($readCompras)){echo $readCompras;}?></div>
									</div>
								</a>
							</div>
						</div>
                    <?php } ?>
					</div>
				</div>
			</div>
   	 	</div>

        <div class="row">

            <div class="col-xl-6">
            
            	<!-- ULtimas ventas -->
            	<div class="row">
            		<div class="col">
            			<div class="card mb-4">
                    <div class="card-header fs-5">
						<i class="fa-solid fa-money-bill"></i>
                        Ultimas ventas
                    </div>
					<div class="card-body">
						<div class="container-fluid table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="tabla">Nombre</th>
                                        <th class="tabla">Evento</th>
                                        <th class="tabla">Asientos</th>
                                        <th class="tabla">Fecha</th>
										<th class="tabla">Ingreso</th>
                                        <th class="tabla">Estado</th>
                                        <?php if ($userSession->requestAccess($_SESSION["rol"], VENTAS)){ ?>
                                        <th>Acciones</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
										<td class="tabla">Jose Escalona</td>
                                        <td class="tabla">The lord Of The rings</td>
										<td class="tabla">g15,g16</td>
                                        <td class="tabla">15 de mayo 20:00</td>
										<td class="tabla">$30</td>
                                        <td class="tabla">Verificada</td>
                                        <?php if ($userSession->requestAccess($_SESSION["rol"], VENTAS)){ ?>
                                        <td class="acciones"><a href="?url=dashboard&type=comprobante"><button type="button" class="btn btn-primary"><i class="fa-solid fa-eye"></i></button></a></td>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
					</div> 
            		</div>
            		
                </div>
            	</div>
            <?php if ($userSession->requestAccess($_SESSION["rol"], CITAS)){ ?>
            	<!-- Proximas citas -->
            	<div class="row">
            		<div class="col">
            			<div class="card mb-4">
                    <div class="card-header fs-5">
						<i class="fa-solid fa-calendar-check"></i>
                        Proximas Citas
                    </div>
					<div class="card-body">
						<div class="container-fluid table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="tabla">Reservador</th>
                                        <th class="tabla">Evento</th>
                                        <th class="tabla">Servicio</th>
                                        <th class="tabla">Fecha</th>
										<th class="tabla">Hora</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($mostrarCita as $info) { 
                                         $fecha = strtotime($info["fechaCita"]);
                                        $hora = strtotime($info["horaCita"]);
                                        ?>
                                    <tr>
										<td class="tabla">Sabrina Colmenarez</td>
                                        <td class="tabla"><?php echo $info["nombreEvento"]; ?></td>
										<td class="tabla"><?php echo $info["servicio"]; ?></td>
                                        <td class="tabla"><?php echo date("d/m/Y", $fecha); ?></td>
										<td class="tabla"><?php echo date("h:i A", $hora); ?></td>
                                        <td class="acciones"><a href="?url=cita&type=detalles&id=<?php echo $info['nroCita']; ?>"><button type="button" class="btn btn-primary"><i class="fa-solid fa-eye"></i></button></a></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                        	<a href="?url=cita&type=consultar" class="btn btn-primary text-light">Mostrar más...</a>
                        </div>
					</div> 
            		</div>
            		
                </div>
            	</div>
            <?php } ?>
                
            </div>

			<div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header fs-5">
                        <i class="fas fa-chart-area me-1"></i>
                        Venta de boletos
                    </div>
					<form class="d-flex flex-row-reverse">
					  	<div class="input-group mb-2 my-2 w-50 me-2">
 							<input type="date" class="form-control" placeholder="Buscar">
							 <button class="btn btn-outline-secondary" type="submit" id="button-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
						</div>
					</form>
                    <div class="card-body"><canvas id="myPieChart" class="myPieChart" width="100%" height="40%"></canvas></div>
                </div>
            </div>
    	</div>
	</div>			

<?php $_comp->footer();?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js"></script>
<script src="assets/js/dashboard.js"></script>
</body>
</html>
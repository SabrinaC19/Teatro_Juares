<html>
<head>
    <?php $_css->heading(); ?>
    <title>Detalles Cita</title>
    <link rel="stylesheet" type="text/css" href="assets\css\comprobante.css">
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
                <h1 class="m-0 d-inline">Detalles de Cita</h1>
            </div>
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="p-2 nav-Breadcrumb" >
  				<ol	ol class="breadcrumb">
   					<li class="breadcrumb-item"><i class="fa-solid fa-house me-2"></i><a href="?url=dashboard">Panel de Control</a></li>
                    <li class="breadcrumb-item"><a href="?url=cita&type=consultar">Citas</a></li>
                    <li class="breadcrumb-item"><a href="?url=cita&type=detalles&id=<?php echo $detalleCita[0]['nroCita']; ?>">Solicitud de cita <?php echo $detalleCita[0]['nroCita']; ?> </a></li>
  				</ol>
			</nav>
		</div>

        <!-- COMPROBANTE DE CITA -->

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header fs-5">
                       <i class="fa-solid fa-check-to-slot me-2"></i>
                        Solicitud de cita <?php echo $detalleCita[0]['nroCita']; ?>
                    </div>

                    <div class="card-body ">
                        <?php 

                            $nombre = ($detalleCita[0]['tipoCita'] == 2) ? 'Razón Social:' : 'Cliente:' ;

                         ?>
                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder mb-1">Cedula del Solicitante: </p> 
                            </div>
                            <div class="col border-end border-dark border-opacity-25">
                                <p class="text-end text-capitalize mb-1"><?php echo $detalleCita[0]['cedCliente'] ?></p>
                            </div>
                            <div class="col">
                                <p class="fw-bolder mb-1"><?php echo $nombre; ?> </p> 
                            </div>
                            <div class="col">
                                <?php $razonSocial = ($detalleCita[0]['tipoCita'] == 2) ? $detalleCita[0]['razonSocial'] : $detalleCita[0]['nombreCliente'].' '.$detalleCita[0]['apellidoCliente']; ?>
                                <p class="text-end text-capitalize mb-1"><?php echo $razonSocial; ?></p>
                            </div>
                        </div>

                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder mb-1">Correo: </p> 
                            </div>
                            <div class="col border-end border-dark border-opacity-25">
                                 <?php $correo = $detalleCita[0]['correoContacto']; ?>
                                <p class="text-end text-capitalize mb-1"><?php echo $correo; ?></p>
                            </div>
                            <div class="col">
                                <p class="fw-bolder mb-1">Telefono: </p> 
                            </div>
                            <div class="col">
                                 <?php $telefono = $detalleCita[0]['tlfContacto']; ?>
                                <p class="text-end text-capitalize mb-1"><?php echo $telefono; ?></p>
                            </div>
                        </div>

                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder">Evento: </p> 
                            </div>
                            <div class="col border-end border-dark border-opacity-25">
                                <p class="text-end text-capitalize"><?php echo $detalleCita[0]['nombreEvento']; ?></p>
                            </div>
                            <div class="col">
                                <p class="fw-bolder">Tipo de Solicitud: </p> 
                            </div>
                            <div class="col">
                                 <?php $tipoCita = ($detalleCita[0]['tipoCita'] == 2) ? 'Empresa Jurídica' : 'Persona Natural'; ?>
                                <p class="text-end text-capitalize"><?php echo $tipoCita; ?></p>
                            </div>
                        </div>

                         <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder">Fecha de la Cita: </p> 
                            </div>
                            <div class="col border-end border-dark border-opacity-25">
                                <?php $fecha = strtotime($detalleCita[0]['fechaCita']); ?>
                                <p class="text-end text-capitalize"><?php echo date("d/m/Y", $fecha); ?></p>
                            </div>
                            <div class="col">
                                <p class="fw-bolder">Hora de la Cita: </p> 
                            </div>
                            <div class="col">
                                <?php $hora = strtotime($detalleCita[0]['horaCita']); ?>
                                <p class="text-end text-capitalize"><?php echo date("h:i A", $hora); ?></p>
                            </div>
                        </div>

                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder">Servicio: </p> 
                            </div>
                            <div class="col border-end border-dark border-opacity-25">
                                <p class="text-end text-capitalize"><?php echo $detalleCita[0]['servicio']; ?></p>
                            </div>
                            <div class="col">
                                <p class="fw-bolder">Espacio: </p> 
                            </div>
                            <div class="col">
                                <p class="text-end text-capitalize"><?php echo $detalleCita[0]['espacio']; ?></p>
                            </div>
                        </div>
                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col ">
                                <p class="fw-bolder">Carta de Solicitud: </p> 
                            </div>
                            <div class="col border-end border-dark border-opacity-25">
                                <a href="<?php echo $detalleCita[0]['cartaSolicitud']; ?>" download = "" class="text-end text-capitalize float-end">Descargue Aquí</a>
                            </div>

                            <div class="col">
                                <p class="fw-bolder">Estado: </p> 
                            </div>
                            <div class="col">
                                 <?php $estadoCita = ($detalleCita[0]['estadoCita'] == 1) ? 'Por Aceptar' : 'Aceptada'; ?>
                                <p class="text-end text-capitalize"><?php echo $estadoCita; ?></p>
                            </div>
                        </div>
                        <div class="row border-dark border-opacity-25">
                            <div class="col">
                                <p><b>Descripción Evento: </b><?php echo $detalleCita[0]['descripcionEvento']; ?></p> 
                            </div>
                        </div>
					</div> 
                    <div class="card-footer fs-5 text-center">
                        <?php if ($detalleCita[0]['estadoCita'] == 1) { ?>
                        <form method="POST" id="verificacionCita">
                            <input type="hidden" name="idCita" value="<?php echo $detalleCita[0]['nroCita']; ?>">
                            <button type="button" class="btn btn-success mb-3" id="enviarCorreo"><i class="fa-solid fa-check me-2"></i>Aceptar Solicitud</button> 

                            <button type="button" class="btn btn-danger mb-3" id="denegarCorreo"><i class="fa-solid fa-circle-xmark me-2"></i>Rechazar Solicitud</button>
                            
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
    	</div>
	</div>			

<?php echo $_comp->footer(); ?>
<script type="text/javascript" src="assets/js/detallesCita.js"></script>
</body>
</html>
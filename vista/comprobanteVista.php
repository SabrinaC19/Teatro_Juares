<html>
<head>
    <?php $_css->heading(); ?>
    <title>Compromante Cliente</title>
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
                <h1 class="m-0 d-inline">Comprobantes de Compra</h1>
            </div>
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="p-2 nav-Breadcrumb" >
  				<ol	ol class="breadcrumb">
   					<li class="breadcrumb-item"><i class="fa-solid fa-house me-2"></i><a href="?url=dashboard">Panel de Control</a></li>
                    <li class="breadcrumb-item"><a href="?url=dashboard&type=ventas">Ventas</a></li>
                    <li class="breadcrumb-item"><a href="?url=dashboard&type=comprobante">Comprobante de la venta 00001</a></li>
  				</ol>
			</nav>
		</div>

        <!-- COMPROBANTE DE VENTA -->

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header fs-5">
                       <i class="fa-solid fa-check-to-slot me-2"></i>
                        Comprobante de Boleto <?php echo $info[0]["numeroBoleto"]; ?>
                    </div>

                    <div class="card-body">
                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder mb-1">Cedula: </p> 
                            </div>
                            <div class="col border-end border-dark border-opacity-25">
                                <p class="text-end text-capitalize mb-1"><?php echo $info[0]["cedulaCliente"]; ?></p>
                            </div>
                            <div class="col">
                                <p class="fw-bolder mb-1">Cliente: </p> 
                            </div>
                            <div class="col">
                                <p class="text-end text-capitalize mb-1"><?php echo $info[0]["nombreCliente"].' '.$info[0]["apellidoCliente"];?></p>
                            </div>
                        </div>
                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder mb-1">Correo: </p> 
                            </div>
                            <div class="col border-end border-dark border-opacity-25">
                                <p class="text-end text-capitalize mb-1"><?php echo $info[0]["correo"]; ?></p>
                            </div>
                            <div class="col">
                                <p class="fw-bolder mb-1">Telefono: </p> 
                            </div>
                            <div class="col">
                                <p class="text-end text-capitalize mb-1"><?php echo $info[0]["nroTelefono"]; ?></p>
                            </div>
                        </div>
                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder">Evento: </p> 
                            </div>
                            <div class="col">
                                <p class="text-end text-capitalize"><?php echo $info[0]["nombre"]; ?></p>
                            </div>
                        </div>
                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder">Area: </p> 
                            </div>
                            <div class="col border-end border-dark border-opacity-25">
                                <p class="text-end text-capitalize">Galeria</p>
                            </div>
                            <div class="col">
                                <p class="fw-bolder">Asientos: </p> 
                            </div>
                            <div class="col">
                                <p class="text-end text-capitalize">g15,g16</p>
                            </div>
                        </div>
                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder">Metodo de pago: </p> 
                            </div>
                            <div class="col">
                                <p class="text-end text-capitalize"><?php echo $info[0]["metodoPago"]; ?></p>
                            </div>
                        </div>
                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder">Monto: </p> 
                            </div>
                            <div class="col">
                                <p class="text-end text-capitalize"><?php echo $info[0]["montoTotal"]; ?> <b>Bs.S</b></p>
                            </div>
                        </div>
                        <?php if ($info[0]["metodoPago"] != "Efectivo" && $info[0]["metodoPago"] != "Punto de Venta") { ?>
                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder">Referencia: </p> 
                            </div>
                            <div class="col">
                                <p class="text-end text-capitalize"><?php echo $info[0]["referenciaBancaria"]; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder">Estado: </p> 
                            </div>
                            <div class="col">
                                <?php $estado = ($info[0]["status"] == 0) ? "Por verificar" : "Aceptada" ; ?>
                                <p class="text-end text-capitalize"><?php echo $estado; ?></p>
                            </div>
                        </div>
					</div> 
                    <div class="card-footer fs-5 text-center">
                        <?php if ($info[0]["status"] == 0) {
                        ?>
                        <button type="button" class="btn btn-success" id="aceptarCompra" value="<?php echo $info[0]["numeroBoleto"]; ?>"><i class="fa-solid fa-check me-2"></i>Aceptar compra</button> 
						<button type="button" class="btn btn-danger" id="rechazarCompra"  value="<?php echo $info[0]["numeroBoleto"]; ?>"><i class="fa-solid fa-circle-xmark me-2"></i>Compra denegada</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
    	</div>
	</div>			

<?php $_comp->footer(); ?>
<script type="text/javascript" src="assets/js/comprobanteVenta.js"></script>
</body>
</html>
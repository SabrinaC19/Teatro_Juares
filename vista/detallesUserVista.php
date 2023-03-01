<html>
<head>
    <?php $_css->heading(); ?>
    <title>Detalles Clientes</title>
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
                <h1 class="m-0 d-inline">Detalles de Cliente</h1>
            </div>
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="p-2 nav-Breadcrumb" >
  				<ol	ol class="breadcrumb">
   					<li class="breadcrumb-item"><i class="fa-solid fa-house me-2"></i><a href="?url=dashboard">Panel de Control</a></li>
                    <li class="breadcrumb-item"><a href="?url=dashboard&type=clientes">Clientes</a></li>
                    <li class="breadcrumb-item"><a href="?url=dashboard&type=comprobante">Detalles del usuario Jose Escalona</a></li>
  				</ol>
			</nav>
		</div>

        <!-- COMPROBANTE DE VENTA -->

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header fs-5">
                       <i class="fa-solid fa-user-check me-2"></i>
                        Detalles del usuario Jose Escalona
                    </div>

                    <div class="card-body">
                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder mb-1">Cedula: </p> 
                            </div>
                            <div class="col border-end border-dark border-opacity-25">
                                <p class="text-end text-capitalize mb-1">30.088.284</p>
                            </div>
                            <div class="col">
                                <p class="fw-bolder mb-1">Cliente: </p> 
                            </div>
                            <div class="col">
                                <p class="text-end text-capitalize mb-1">jose escalona</p>
                            </div>
                        </div>
                        <div class="row border-bottom border-dark border-opacity-25">
                            <div class="col">
                                <p class="fw-bolder mb-1">Correo: </p> 
                            </div>
                            <div class="col border-end border-dark border-opacity-25">
                                <p class="text-end text-capitalize mb-1">joseaee1505@gmail.com</p>
                            </div>
                            <div class="col">
                                <p class="fw-bolder mb-1">Telefono: </p> 
                            </div>
                            <div class="col">
                                <p class="text-end text-capitalize mb-1">04120587814</p>
                            </div>
                        </div>
					</div> 
                </div>
            </div>
    	</div>
	</div>			

<?php $_comp->footer(); ?>
</body>
</html>
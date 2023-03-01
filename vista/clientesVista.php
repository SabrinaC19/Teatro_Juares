<html>
<head>
    <?php $_css->heading(); ?>
    <title>Clientes</title>
    <link rel="stylesheet" type="text/css" href="assets\css\clientes.css">
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
                <h1 class="m-0 d-inline">Consulta de Clientes</h1>
            </div>
			<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="p-2 nav-Breadcrumb" >
  				<ol	ol class="breadcrumb">
   					<li class="breadcrumb-item"><i class="fa-solid fa-house me-2"></i><a href="?url=dashboard">Panel de Control</a></li>
                    <li class="breadcrumb-item"><a href="?url=dashboard&type=clientes">Clientes</a></li>
  				</ol>
			</nav>
		</div>

        <!-- TABLA DE CLIENTES -->

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header fs-5">
                        <i class="fa-solid fa-user-tag me-2"></i>
                        Clientes
                    </div>
					<div class="card-body">
                        <h4 class="mb-3 ms-3">Filtrar por:</h4>
                        <form action="" method="" class="row align-items-center ms-1 mb-2">

                            <div class="col-lg-3 mb-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input class="form-control" type="search" placeholder="Buscar C.I de Clientes" aria-label="Buscar C.I de Clientes">
                                        <span class="btn btn-success d-flex align-items-center">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="container-fluid table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="tabla">Cedula</th>
                                        <th class="tabla">Nombre</th>
                                        <th class="tabla">Apellido</th>
                                        <th class="tabla">Correo</th>
                                        <th class="tabla">Teléfono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($info as $filas) { ?>

                                    <tr>
                                        <td class="tabla">V-<?php echo $filas["cedulaCliente"]; ?> </td>
                                        <td class="tabla"><?php echo $filas["nombreCliente"]; ?> </td>
                                        <td class="tabla"><?php echo $filas["apellidoCliente"]; ?> </td>
                                        <td class="tabla"><?php echo $filas["correo"]; ?> </td>
                                        <td class="tabla"><?php echo $filas["nroTelefono"]; ?> </td>
                                        <td class="acciones"><a href="?url=dashboard&type=detallesUser"><button type="button" class="btn btn-primary"><i class="fa-solid fa-eye"></i></button></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
					</div> 
                </div>
            </div>
    	</div>
	</div>			

<?php $_comp->footer(); ?>
</body>
</html>
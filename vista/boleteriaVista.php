<html>
<head>
	<?php $_css->heading(); ?>
	<title>Seleccionar Asientos</title>
<link rel="stylesheet" type="text/css" href="assets\css\boleteria.css">
</head>
<body>

	<!-- PANTALLA CARGA -->

 	<div id="contenedor_carga">
		<div id="carga"></div>
	</div>

	<?php 

	if ($userSession->log()) {
		$_comp->navInicioUser();
	}else{
		$_comp->navInicio();
	}

	 ?>

	<!-- SELECCION BUTACAS -->

	<div class="container-fluid">
		<div class="container">

		   	<div class="row bg-danger cuadro my-5 py-4 rounded">
		   		<div class="col-lg-4 ">

		   			<div id="infoEvento my-">
		   				<img src="assets/img/messi.jpg" class="mx-auto d-flex mb-2 rounded">

			   			<div class="mx-auto row d-flex justify-content-center aling-items-center">
							<div class="info mx-2 mb-2 rounded p-3 text-light">
								<!-- Evento -->
				              	<i class="fas fa-film"></i> <?php echo $data[0]["nombre"]; ?>
				              	
				            </div>

				            <div class="card info mx-2 mb-2 rounded p-3 text-light">
				              		<?php echo $data[0]["descripcion"]; ?>
				              	</div>

				            <div class="row text-light text-center d-flex justify-content-center aling-items-center">
				            	<div class="info col mb-2 p-2 rounded-pill">
				            		<i class="fas fa-calendar"></i> <?php echo $data[0]["fechaEvento"]; ?>
				            	</div>

				            	<div class="info col mx-1 mb-2 p-2 rounded-pill">
				            		<i class="fas fa-clock"></i> <?php echo $data[0]["horaInicio"]; ?>
				            	</div>
				            </div>

			            </div>

			            <div class="bg-dark rounded">
				            <h5 class="mb-2 text-center text-light fecha p-2 rounded"><i class="fas fa-circle-info"></i> Información de los asientos:</h5>

				            <div class="d-flex justify-content-center aling-items-center mx-auto" >
				            	<!-- Negro -->
				             	<span class="d-inline-block mx-2" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="No accesible">
			  						<i class="fas fa-chair h2 p-1 bg-light rounded info-icon"></i>
								</span>
					            <!-- Verde -->
					            <span class="d-inline-block mx-2 disponible" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="Disponible">
				  					<i class="fas fa-chair h2 p-1 bg-light rounded info-icon"></i>
								</span>
								<!-- Rojo -->
								<span class="d-inline-block mx-2 noDisponible" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="No disponible">
				  					<i class="fas fa-chair h2 p-1 bg-light rounded info-icon"></i>
								</span>
								<!-- Azul -->
								<span class="d-inline-block mx-2 seleccionado" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="Seleccionado">
				  					<i class="fas fa-chair h2 p-1 bg-light rounded info-icon"></i>
								</span>
			             	</div>
			            </div>

			            <div class="my-3 bg-light rounded">
			            	<h6 class="text-center text-light bg-dark p-1"><i class="fas fa-table-cells-large"></i> Precio por áreas:</h6>
			            	<div class="row mb-2 text-center">
			            		<div class="row mb-2 text-center">
					            	<div class="col border-secondary">
					            		Patio
					            	</div>

					            	<div class="col">
					            		10 Bs
					            	</div>
					            </div>

					            <hr>

					            <div class="row mb-2 text-center">
					            	<div class="col">
					            		Balcón
					            	</div>

					            	<div class="col">
					            		10 Bs
					            	</div>
					            </div>

			            		<hr>

			            		<div class="row mb-2 pb-2 text-center">
			            			<div class="col">
			            				Galería
			            			</div>

			            			<div class="col">
			            				10 Bs
			            			</div>
			            		</div>

			            	</div>
			            	
			            </div>

			            <div class="d-flex justify-content-center aling-items-center">
			            	<button class="btn btn-success mx-auto my-3 rounded text-light" data-bs-toggle="modal" data-bs-target="#modalFactura">
			             		<i class="fas fa-file-lines"></i> Detalles de compra
			             	</button>
			            </div>

		   			</div>
		   		</div>

		   		<div class="col-lg-8">
		   			<section>
		   				<div data-aos="fade-up">
				        	<ul class="nav panel-tabs row d-flex aling-items-center justify-content-center mt-3">
				        		<?php if ($data[0]["patioStatus"] == 1) { 
				        			$activo = ($data[0]["patioStatus"] == 1) ? "active" : "";
				        			?>
				            	<li class="col-lg-3 col-md-3 col-sm-3 col-3 mb-2">
				                <a href="" class="nav-link-bl px-5 rounded <?php echo $activo; ?>" data-bs-toggle="tab" data-bs-target="#tab1">
				                	<h5 class="text-center">Patio <!--<i class="fas fa-chair"></i>--></h5>
				                </a>
				              	</li>
				              <?php } ?>
				              <?php if ($data[0]["palcoStatus"] == 1) { 

				              	$activo = ($data[0]["patioStatus"] == 0) ? "active" : "";

				              	?>
				              	<li class="col-lg-3 col-md-3 col-sm-3 col-3 mb-2">
				                <a href="" class="nav-link-bl px-5 rounded <?php echo $activo; ?>" data-bs-toggle="tab" data-bs-target="#tab2">
				                  <h5 class="text-center">Palcos <!--<i class="fas fa-chair"></i>--></h5>
				                </a>
				              	</li>
				              	<?php } ?>
				              	<?php if ($data[0]["galeriaStatus"] == 1) { 

				              		$activo = ($data[0]["patioStatus"] == 0 && $data[0]["palcoStatus"] == 0) ? "active" : "";

				              	?>
				              	<li class="col-lg-3 col-md-3 col-sm-3 col-3 mb-2">
				                <a href="" class="nav-link-bl px-5 rounded <?php echo $activo; ?>" data-bs-toggle="tab" data-bs-target="#tab3">
				                  <h5 class="text-center">Galeria <!--<i class="fas fa-chair"></i>--></h5>
				                </a>
				              	</li>
				              	<?php } ?>
				            </ul>
		   				</div>

		   				<!-- PATIO BUTACAS -->
		   				<?php if ($data[0]["patioStatus"] == 1) {

		   					$patio = "active";

		   				?>

		   				<div class="tab-content mb-2">
		   					<!-- TAB PANE -->
		   					<div class="tab-pane <?php echo $patio; ?>" id="tab1" data-aos="fade-up">
		   						<div class="my-3">

		   							<div id="seccionOeste">
		   								<div>
		   									<div class="boleteria p-3">
		   										<div class="table-responsive-lg table-responsive-md">
		   											<!-- Seccion -->
		   											<h4 class="text-light text-center">Sección Oeste 
		   												<span tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="right" data-bs-content="Ir a la sección este"><i class="fas fa-circle-arrow-right" type="button" id="irSeccionEste"></i></span>
		   											</h4>
		   											<!-- Tabla -->
		   											<table class="table-bordered bg-light">
		   												<!-- Formulario -->
		   												<form>
		   													<tbody class="text-center">
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">O</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PO1"  class="checkAsi" name="asientoSelect[]" value="PO1"><label class="asiento" for="PO1"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO3"  class="checkAsi" name="asientoSelect[]" value="PO3"><label class="asiento" for="PO3"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO5"  class="checkAsi" name="asientoSelect[]" value="PO5"><label class="asiento" for="PO5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO7"  class="checkAsi" name="asientoSelect[]" value="PO7"><label class="asiento" for="PO7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO9"  class="checkAsi" name="asientoSelect[]" value="PO9"><label class="asiento" for="PO9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO11"  class="checkAsi" name="asientoSelect[]" value="PO11"><label class="asiento" for="PO11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO13"  class="checkAsi" name="asientoSelect[]" value="PO13"><label class="asiento" for="PO13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO15"  class="checkAsi" name="asientoSelect[]" value="PO15"><label class="asiento" for="PO15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO17"  class="checkAsi" name="asientoSelect[]" value="PO17"><label class="asiento" for="PO17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">O</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio  bg-dark text-light">N</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PN1"  class="checkAsi" name="asientoSelect[]" value="PN1"><label class="asiento" for="PN1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PN3"  class="checkAsi" name="asientoSelect[]" value="PN3"><label class="asiento" for="PN3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PN5"  class="checkAsi" name="asientoSelect[]" value="PN5"><label class="asiento" for="PN5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN7"  class="checkAsi" name="asientoSelect[]" value="PN7"><label class="asiento" for="PN7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN9"  class="checkAsi" name="asientoSelect[]" value="PN9"><label class="asiento" for="PN9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN11"  class="checkAsi" name="asientoSelect[]" value="PN11"><label class="asiento" for="PN11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN13"  class="checkAsi" name="asientoSelect[]" value="PN13"><label class="asiento" for="PN13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN15"  class="checkAsi" name="asientoSelect[]" value="PN15"><label class="asiento" for="PN15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN17"  class="checkAsi" name="asientoSelect[]" value="PN17"><label class="asiento" for="PN17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN19"  class="checkAsi" name="asientoSelect[]" value="PN19"><label class="asiento" for="PN19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN21"  class="checkAsi" name="asientoSelect[]" value="PN21"><label class="asiento" for="PN21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN23"  class="checkAsi" name="asientoSelect[]" value="PN23"><label class="asiento" for="PN23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio  bg-dark text-light">N</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio  bg-dark text-light">M</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PM1"  class="checkAsi" name="asientoSelect[]" value="PM1"><label class="asiento" for="PM1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PM3"  class="checkAsi" name="asientoSelect[]" value="PM3"><label class="asiento" for="PM3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PM5"  class="checkAsi" name="asientoSelect[]" value="PM5"><label class="asiento" for="PM5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM7"  class="checkAsi" name="asientoSelect[]" value="PM7"><label class="asiento" for="PM7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM9"  class="checkAsi" name="asientoSelect[]" value="PM9"><label class="asiento" for="PM9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM11"  class="checkAsi" name="asientoSelect[]" value="PM11"><label class="asiento" for="PM11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM13"  class="checkAsi" name="asientoSelect[]" value="PN13"><label class="asiento" for="PM13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM15"  class="checkAsi" name="asientoSelect[]" value="PM15"><label class="asiento" for="PM15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM17"  class="checkAsi" name="asientoSelect[]" value="PM17"><label class="asiento" for="PM17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM19"  class="checkAsi" name="asientoSelect[]" value="PM19"><label class="asiento" for="PM19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM21"  class="checkAsi" name="asientoSelect[]" value="PM21"><label class="asiento" for="PM21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM23"  class="checkAsi" name="asientoSelect[]" value="PM23"><label class="asiento" for="PM23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio  bg-dark text-light">M</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">L</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PL1"  class="checkAsi" name="asientoSelect[]" value="PL1"><label class="asiento" for="PL1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PL3"  class="checkAsi" name="asientoSelect[]" value="PL3"><label class="asiento" for="PL3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PL5"  class="checkAsi" name="asientoSelect[]" value="PL5"><label class="asiento" for="PL5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL7"  class="checkAsi" name="asientoSelect[]" value="PL7"><label class="asiento" for="PL7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL9"  class="checkAsi" name="asientoSelect[]" value="PL9"><label class="asiento" for="PL9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL11"  class="checkAsi" name="asientoSelect[]" value="PL11"><label class="asiento" for="PL11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL13"  class="checkAsi" name="asientoSelect[]" value="PL13"><label class="asiento" for="PL13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL15"  class="checkAsi" name="asientoSelect[]" value="PL15"><label class="asiento" for="PL15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL17"  class="checkAsi" name="asientoSelect[]" value="PL17"><label class="asiento" for="PL17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL19"  class="checkAsi" name="asientoSelect[]" value="PL19"><label class="asiento" for="PL19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL21"  class="checkAsi" name="asientoSelect[]" value="PL21"><label class="asiento" for="PL21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL23"  class="checkAsi" name="asientoSelect[]" value="PL23"><label class="asiento" for="PL23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">L</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">K</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PK1"  class="checkAsi" name="asientoSelect[]" value="PK1"><label class="asiento" for="PK1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PK3"  class="checkAsi" name="asientoSelect[]" value="PK3"><label class="asiento" for="PK3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PK5"  class="checkAsi" name="asientoSelect[]" value="PK5"><label class="asiento" for="PK5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK7"  class="checkAsi" name="asientoSelect[]" value="PK7"><label class="asiento" for="PK7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK9"  class="checkAsi" name="asientoSelect[]" value="PK9"><label class="asiento" for="PK9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK11"  class="checkAsi" name="asientoSelect[]" value="PK11"><label class="asiento" for="PK11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK13"  class="checkAsi" name="asientoSelect[]" value="PK13"><label class="asiento" for="PK13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK15"  class="checkAsi" name="asientoSelect[]" value="PK15"><label class="asiento" for="PK15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK17"  class="checkAsi" name="asientoSelect[]" value="PK17"><label class="asiento" for="PK17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK19"  class="checkAsi" name="asientoSelect[]" value="PK19"><label class="asiento" for="PK19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK21"  class="checkAsi" name="asientoSelect[]" value="PK21"><label class="asiento" for="PK21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK23"  class="checkAsi" name="asientoSelect[]" value="PK23"><label class="asiento" for="PK23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">K</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-danger" colspan="16"></td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 bg-dark text-light">J</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ1"  class="checkAsi" name="asientoSelect[]" value="PJ1"><label class="asiento" for="PJ1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ3"  class="checkAsi" name="asientoSelect[]" value="PJ3"><label class="asiento" for="PJ3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ5"  class="checkAsi" name="asientoSelect[]" value="PJ5"><label class="asiento" for="PJ5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ7"  class="checkAsi" name="asientoSelect[]" value="PJ7"><label class="asiento" for="PJ7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ9"  class="checkAsi" name="asientoSelect[]" value="PJ9"><label class="asiento" for="PJ9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ11"  class="checkAsi" name="asientoSelect[]" value="PJ11"><label class="asiento" for="PJ11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ13"  class="checkAsi" name="asientoSelect[]" value="PJ13"><label class="asiento" for="PJ13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ15"  class="checkAsi" name="asientoSelect[]" value="PJ15"><label class="asiento" for="PJ15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ17"  class="checkAsi" name="asientoSelect[]" value="PJ17"><label class="asiento" for="PJ17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ19"  class="checkAsi" name="asientoSelect[]" value="PJ19"><label class="asiento" for="PJ19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ21"  class="checkAsi" name="asientoSelect[]" value="PJ21"><label class="asiento" for="PJ21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ23"  class="checkAsi" name="asientoSelect[]" value="PJ23"><label class="asiento" for="PJ23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">J</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">I</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PI1"  class="checkAsi" name="asientoSelect[]" value="PI1"><label class="asiento" for="PI1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PI3"  class="checkAsi" name="asientoSelect[]" value="PI3"><label class="asiento" for="PI3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PI5"  class="checkAsi" name="asientoSelect[]" value="PI5"><label class="asiento" for="PI5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI7"  class="checkAsi" name="asientoSelect[]" value="PI7"><label class="asiento" for="PI7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI9"  class="checkAsi" name="asientoSelect[]" value="PI9"><label class="asiento" for="PI9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI11"  class="checkAsi" name="asientoSelect[]" value="PI11"><label class="asiento" for="PI11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI13"  class="checkAsi" name="asientoSelect[]" value="PI13"><label class="asiento" for="PI13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI15"  class="checkAsi" name="asientoSelect[]" value="PI15"><label class="asiento" for="PI15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI17"  class="checkAsi" name="asientoSelect[]" value="PI17"><label class="asiento" for="PI17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI19"  class="checkAsi" name="asientoSelect[]" value="PI19"><label class="asiento" for="PI19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI21"  class="checkAsi" name="asientoSelect[]" value="PI21"><label class="asiento" for="PI21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI23"  class="checkAsi" name="asientoSelect[]" value="PI23"><label class="asiento" for="PI23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">I</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-danger" colspan="16"></td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">H</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PH1"  class="checkAsi" name="asientoSelect[]" value="PH1"><label class="asiento" for="PH1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PH3"  class="checkAsi" name="asientoSelect[]" value="PH3"><label class="asiento" for="PH3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PH5"  class="checkAsi" name="asientoSelect[]" value="PH5"><label class="asiento" for="PH5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH7"  class="checkAsi" name="asientoSelect[]" value="PH7"><label class="asiento" for="PH7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH9"  class="checkAsi" name="asientoSelect[]" value="PH9"><label class="asiento" for="PH9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH11"  class="checkAsi" name="asientoSelect[]" value="PH11"><label class="asiento" for="PH11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH13"  class="checkAsi" name="asientoSelect[]" value="PH13"><label class="asiento" for="PH13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH15"  class="checkAsi" name="asientoSelect[]" value="PH15"><label class="asiento" for="PH15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH17"  class="checkAsi" name="asientoSelect[]" value="PH17"><label class="asiento" for="PH17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH19"  class="checkAsi" name="asientoSelect[]" value="PH19"><label class="asiento" for="PH19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH21"  class="checkAsi" name="asientoSelect[]" value="PH21"><label class="asiento" for="PH21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH23"  class="checkAsi" name="asientoSelect[]" value="PH23"><label class="asiento" for="PH23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PH25"  class="checkAsi" name="asientoSelect[]" value="PH25"><label class="asiento" for="PH25"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PH27"  class="checkAsi" name="asientoSelect[]" value="PH27"><label class="asiento" for="PH27"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">H</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">G</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PG1"  class="checkAsi" name="asientoSelect[]" value="PG1"><label class="asiento" for="PG1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PG3"  class="checkAsi" name="asientoSelect[]" value="PG3"><label class="asiento" for="PG3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PG5"  class="checkAsi" name="asientoSelect[]" value="PG5"><label class="asiento" for="PG5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG7"  class="checkAsi" name="asientoSelect[]" value="PG7"><label class="asiento" for="PG7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG9"  class="checkAsi" name="asientoSelect[]" value="PG9"><label class="asiento" for="PG9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG11"  class="checkAsi" name="asientoSelect[]" value="PG11"><label class="asiento" for="PG11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG13"  class="checkAsi" name="asientoSelect[]" value="PG13"><label class="asiento" for="PG13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG15"  class="checkAsi" name="asientoSelect[]" value="PG15"><label class="asiento" for="PG15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG17"  class="checkAsi" name="asientoSelect[]" value="PG17"><label class="asiento" for="PG17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG19"  class="checkAsi" name="asientoSelect[]" value="PG19"><label class="asiento" for="PG19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG21"  class="checkAsi" name="asientoSelect[]" value="PG21"><label class="asiento" for="PG21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG23"  class="checkAsi" name="asientoSelect[]" value="PG23"><label class="asiento" for="PG23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PG25"  class="checkAsi" name="asientoSelect[]" value="PG25"><label class="asiento" for="PG25"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PG27"  class="checkAsi" name="asientoSelect[]" value="PG27"><label class="asiento" for="PG27"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">G</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">F</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PF1"  class="checkAsi" name="asientoSelect[]" value="PF1"><label class="asiento" for="PF1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PF3"  class="checkAsi" name="asientoSelect[]" value="PF3"><label class="asiento" for="PF3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PF5"  class="checkAsi" name="asientoSelect[]" value="PF5"><label class="asiento" for="PF5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF7"  class="checkAsi" name="asientoSelect[]" value="PF7"><label class="asiento" for="PF7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF9"  class="checkAsi" name="asientoSelect[]" value="PF9"><label class="asiento" for="PF9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF11"  class="checkAsi" name="asientoSelect[]" value="PF11"><label class="asiento" for="PF11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF13"  class="checkAsi" name="asientoSelect[]" value="PF13"><label class="asiento" for="PF13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF15"  class="checkAsi" name="asientoSelect[]" value="PF15"><label class="asiento" for="PF15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF17"  class="checkAsi" name="asientoSelect[]" value="PF17"><label class="asiento" for="PF17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF19"  class="checkAsi" name="asientoSelect[]" value="PF19"><label class="asiento" for="PF19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF21"  class="checkAsi" name="asientoSelect[]" value="PF21"><label class="asiento" for="PF21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF23"  class="checkAsi" name="asientoSelect[]" value="PF23"><label class="asiento" for="PF23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PF25"  class="checkAsi" name="asientoSelect[]" value="PF25"><label class="asiento" for="PF25"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PF27"  class="checkAsi" name="asientoSelect[]" value="PF27"><label class="asiento" for="PF27"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">F</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">E</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PE1"  class="checkAsi" name="asientoSelect[]" value="PE1"><label class="asiento" for="PE1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PE3"  class="checkAsi" name="asientoSelect[]" value="PE3"><label class="asiento" for="PE3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PE5"  class="checkAsi" name="asientoSelect[]" value="PE5"><label class="asiento" for="PE5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE7"  class="checkAsi" name="asientoSelect[]" value="PE7"><label class="asiento" for="PE7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE9"  class="checkAsi" name="asientoSelect[]" value="PE9"><label class="asiento" for="PE9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE11"  class="checkAsi" name="asientoSelect[]" value="PE11"><label class="asiento" for="PE11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE13"  class="checkAsi" name="asientoSelect[]" value="PE13"><label class="asiento" for="PE13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE15"  class="checkAsi" name="asientoSelect[]" value="PE15"><label class="asiento" for="PE15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE17"  class="checkAsi" name="asientoSelect[]" value="PE17"><label class="asiento" for="PE17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE19"  class="checkAsi" name="asientoSelect[]" value="PE19"><label class="asiento" for="PE19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE21"  class="checkAsi" name="asientoSelect[]" value="PE21"><label class="asiento" for="PE21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE23"  class="checkAsi" name="asientoSelect[]" value="PE23"><label class="asiento" for="PE23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PE25"  class="checkAsi" name="asientoSelect[]" value="PE25"><label class="asiento" for="PE25"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PE27"  class="checkAsi" name="asientoSelect[]" value="PE27"><label class="asiento" for="PE27"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">E</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">D</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PD1"  class="checkAsi" name="asientoSelect[]" value="PD1"><label class="asiento" for="PD1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PD3"  class="checkAsi" name="asientoSelect[]" value="PD3"><label class="asiento" for="PD3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PD5"  class="checkAsi" name="asientoSelect[]" value="PD5"><label class="asiento" for="PD5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD7"  class="checkAsi" name="asientoSelect[]" value="PD7"><label class="asiento" for="PD7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD9"  class="checkAsi" name="asientoSelect[]" value="PD9"><label class="asiento" for="PD9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD11"  class="checkAsi" name="asientoSelect[]" value="PD11"><label class="asiento" for="PD11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD13"  class="checkAsi" name="asientoSelect[]" value="PD13"><label class="asiento" for="PD13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD15"  class="checkAsi" name="asientoSelect[]" value="PD15"><label class="asiento" for="PD15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD17"  class="checkAsi" name="asientoSelect[]" value="PD17"><label class="asiento" for="PD17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD19"  class="checkAsi" name="asientoSelect[]" value="PD19"><label class="asiento" for="PD19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD21"  class="checkAsi" name="asientoSelect[]" value="PD21"><label class="asiento" for="PD21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD23"  class="checkAsi" name="asientoSelect[]" value="PD23"><label class="asiento" for="PD23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PD25"  class="checkAsi" name="asientoSelect[]" value="PD25"><label class="asiento" for="PD25"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PD27"  class="checkAsi" name="asientoSelect[]" value="PD27"><label class="asiento" for="PD27"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">D</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">C</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PC1"  class="checkAsi" name="asientoSelect[]" value="PC1"><label class="asiento" for="PC1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PC3"  class="checkAsi" name="asientoSelect[]" value="PC3"><label class="asiento" for="PC3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PC5"  class="checkAsi" name="asientoSelect[]" value="PC5"><label class="asiento" for="PC5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC7"  class="checkAsi" name="asientoSelect[]" value="PC7"><label class="asiento" for="PC7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC9"  class="checkAsi" name="asientoSelect[]" value="PC9"><label class="asiento" for="PC9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC11"  class="checkAsi" name="asientoSelect[]" value="PC11"><label class="asiento" for="PC11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC13"  class="checkAsi" name="asientoSelect[]" value="PC13"><label class="asiento" for="PC13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC15"  class="checkAsi" name="asientoSelect[]" value="PC15"><label class="asiento" for="PC15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC17"  class="checkAsi" name="asientoSelect[]" value="PC17"><label class="asiento" for="PC17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC19"  class="checkAsi" name="asientoSelect[]" value="PC19"><label class="asiento" for="PC19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC21"  class="checkAsi" name="asientoSelect[]" value="PC21"><label class="asiento" for="PC21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC23"  class="checkAsi" name="asientoSelect[]" value="PC23"><label class="asiento" for="PC23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PC25"  class="checkAsi" name="asientoSelect[]" value="PC25"><label class="asiento" for="PC25"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PC27"  class="checkAsi" name="asientoSelect[]" value="PC27"><label class="asiento" for="PC27"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">C</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">B</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PB1"  class="checkAsi" name="asientoSelect[]" value="PB1"><label class="asiento" for="PB1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PB3"  class="checkAsi" name="asientoSelect[]" value="PB3"><label class="asiento" for="PB3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PB5"  class="checkAsi" name="asientoSelect[]" value="PB5"><label class="asiento" for="PB5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB7"  class="checkAsi" name="asientoSelect[]" value="PB7"><label class="asiento" for="PB7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB9"  class="checkAsi" name="asientoSelect[]" value="PB9"><label class="asiento" for="PB9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB11"  class="checkAsi" name="asientoSelect[]" value="PB11"><label class="asiento" for="PB11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB13"  class="checkAsi" name="asientoSelect[]" value="PB13"><label class="asiento" for="PB13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB15"  class="checkAsi" name="asientoSelect[]" value="PB15"><label class="asiento" for="PB15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB17"  class="checkAsi" name="asientoSelect[]" value="PB17"><label class="asiento" for="PB17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB19"  class="checkAsi" name="asientoSelect[]" value="PB19"><label class="asiento" for="PB19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB21"  class="checkAsi" name="asientoSelect[]" value="PB21"><label class="asiento" for="PB21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB23"  class="checkAsi" name="asientoSelect[]" value="PB23"><label class="asiento" for="PB23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PB25"  class="checkAsi" name="asientoSelect[]" value="PB25"><label class="asiento" for="PB25"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PB27"  class="checkAsi" name="asientoSelect[]" value="PB27"><label class="asiento" for="PB27"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">B</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">A</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PA1"  class="checkAsi" name="asientoSelect[]" value="PA1"><label class="asiento" for="PA1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PA3"  class="checkAsi" name="asientoSelect[]" value="PA3"><label class="asiento" for="PA3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PA5"  class="checkAsi" name="asientoSelect[]" value="PA5"><label class="asiento" for="PA5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA7"  class="checkAsi" name="asientoSelect[]" value="PA7"><label class="asiento" for="PA7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA9"  class="checkAsi" name="asientoSelect[]" value="PA9"><label class="asiento" for="PA9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA11"  class="checkAsi" name="asientoSelect[]" value="PA11"><label class="asiento" for="PA11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA13"  class="checkAsi" name="asientoSelect[]" value="PA13"><label class="asiento" for="PA13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA15"  class="checkAsi" name="asientoSelect[]" value="PA15"><label class="asiento" for="PA15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA17"  class="checkAsi" name="asientoSelect[]" value="PA17"><label class="asiento" for="PA17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA19"  class="checkAsi" name="asientoSelect[]" value="PA19"><label class="asiento" for="PA19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA21"  class="checkAsi" name="asientoSelect[]" value="PA21"><label class="asiento" for="PA21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA23"  class="checkAsi" name="asientoSelect[]" value="PA23"><label class="asiento" for="PA23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio bg-dark text-light">A</td>
		   														</tr>
		   													</tbody>
		   												</form>

		   											</table>

		   										</div>
		   									</div>
		   								</div>
		   							</div>

		   							<div id="seccionEste">
		   								<div>
		   									<div class="boleteria p-3">
		   										<div class="table-responsive-lg table-responsive-md">
		   											<!-- Seccion -->
		   											<h4 class="text-light text-center">
		   												<span tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="right" data-bs-content="Ir a la sección oeste"><i class="fas fa-circle-arrow-left" type="button" id="irSeccionOeste"></i></span>
		   												Sección Este
		   											</h4>
		   											<!-- Tabla -->
		   											<table class="table-bordered bg-light">
		   												<!-- Formulario -->
		   												<form>
		   													<tbody class="text-center">
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">O</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PO2"  class="checkAsi" name="asientoSelect[]" value="PO2"><label class="asiento" for="PO2"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO4"  class="checkAsi" name="asientoSelect[]" value="PO4"><label class="asiento" for="PO4"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO6"  class="checkAsi" name="asientoSelect[]" value="PO6"><label class="asiento" for="PO6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO8"  class="checkAsi" name="asientoSelect[]" value="PO8"><label class="asiento" for="PO8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO10"  class="checkAsi" name="asientoSelect[]" value="PO10"><label class="asiento" for="PO10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO12"  class="checkAsi" name="asientoSelect[]" value="PO12"><label class="asiento" for="PO12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO14"  class="checkAsi" name="asientoSelect[]" value="PO14"><label class="asiento" for="PO14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO16"  class="checkAsi" name="asientoSelect[]" value="PO16"><label class="asiento" for="PO16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PO18"  class="checkAsi" name="asientoSelect[]" value="PO18"><label class="asiento" for="PO18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">O</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio  bg-dark text-light">N</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PN2"  class="checkAsi" name="asientoSelect[]" value="PN2"><label class="asiento" for="PN2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PN4"  class="checkAsi" name="asientoSelect[]" value="PN4"><label class="asiento" for="PN4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PN6"  class="checkAsi" name="asientoSelect[]" value="PN6"><label class="asiento" for="PN6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN8"  class="checkAsi" name="asientoSelect[]" value="PN8"><label class="asiento" for="PN8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN10"  class="checkAsi" name="asientoSelect[]" value="PN10"><label class="asiento" for="PN10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN12"  class="checkAsi" name="asientoSelect[]" value="PN12"><label class="asiento" for="PN12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN14"  class="checkAsi" name="asientoSelect[]" value="PN14"><label class="asiento" for="PN14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN16"  class="checkAsi" name="asientoSelect[]" value="PN16"><label class="asiento" for="PN16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN18"  class="checkAsi" name="asientoSelect[]" value="PN18"><label class="asiento" for="PN18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN20"  class="checkAsi" name="asientoSelect[]" value="PN20"><label class="asiento" for="PN20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN22"  class="checkAsi" name="asientoSelect[]" value="PN22"><label class="asiento" for="PN22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PN24"  class="checkAsi" name="asientoSelect[]" value="PN24"><label class="asiento" for="PN24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio  bg-dark text-light">N</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio  bg-dark text-light">M</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PM2"  class="checkAsi" name="asientoSelect[]" value="PM2"><label class="asiento" for="PM2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PM4"  class="checkAsi" name="asientoSelect[]" value="PM4"><label class="asiento" for="PM4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PM6"  class="checkAsi" name="asientoSelect[]" value="PM6"><label class="asiento" for="PM6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM8"  class="checkAsi" name="asientoSelect[]" value="PM8"><label class="asiento" for="PM8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM10"  class="checkAsi" name="asientoSelect[]" value="PM10"><label class="asiento" for="PM10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM12"  class="checkAsi" name="asientoSelect[]" value="PM12"><label class="asiento" for="PM12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM14"  class="checkAsi" name="asientoSelect[]" value="PN14"><label class="asiento" for="PM14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM16"  class="checkAsi" name="asientoSelect[]" value="PM16"><label class="asiento" for="PM16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM18"  class="checkAsi" name="asientoSelect[]" value="PM18"><label class="asiento" for="PM18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM20"  class="checkAsi" name="asientoSelect[]" value="PM20"><label class="asiento" for="PM20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM22"  class="checkAsi" name="asientoSelect[]" value="PM22"><label class="asiento" for="PM22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PM24"  class="checkAsi" name="asientoSelect[]" value="PM24"><label class="asiento" for="PM24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio  bg-dark text-light">M</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">L</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PL2"  class="checkAsi" name="asientoSelect[]" value="PL2"><label class="asiento" for="PL2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PL4"  class="checkAsi" name="asientoSelect[]" value="PL4"><label class="asiento" for="PL4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PL6"  class="checkAsi" name="asientoSelect[]" value="PL6"><label class="asiento" for="PL6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL8"  class="checkAsi" name="asientoSelect[]" value="PL8"><label class="asiento" for="PL8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL10"  class="checkAsi" name="asientoSelect[]" value="PL10"><label class="asiento" for="PL10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL12"  class="checkAsi" name="asientoSelect[]" value="PL12"><label class="asiento" for="PL12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL14"  class="checkAsi" name="asientoSelect[]" value="PL14"><label class="asiento" for="PL14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL16"  class="checkAsi" name="asientoSelect[]" value="PL16"><label class="asiento" for="PL16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL18"  class="checkAsi" name="asientoSelect[]" value="PL18"><label class="asiento" for="PL18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL20"  class="checkAsi" name="asientoSelect[]" value="PL20"><label class="asiento" for="PL20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL22"  class="checkAsi" name="asientoSelect[]" value="PL22"><label class="asiento" for="PL22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PL24"  class="checkAsi" name="asientoSelect[]" value="PL24"><label class="asiento" for="PL24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">L</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">K</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PK2"  class="checkAsi" name="asientoSelect[]" value="PK2"><label class="asiento" for="PK2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PK4"  class="checkAsi" name="asientoSelect[]" value="PK4"><label class="asiento" for="PK4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PK6"  class="checkAsi" name="asientoSelect[]" value="PK6"><label class="asiento" for="PK6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK8"  class="checkAsi" name="asientoSelect[]" value="PK8"><label class="asiento" for="PK8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK10"  class="checkAsi" name="asientoSelect[]" value="PK10"><label class="asiento" for="PK10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK12"  class="checkAsi" name="asientoSelect[]" value="PK12"><label class="asiento" for="PK12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK14"  class="checkAsi" name="asientoSelect[]" value="PK14"><label class="asiento" for="PK14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK16"  class="checkAsi" name="asientoSelect[]" value="PK16"><label class="asiento" for="PK16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK18"  class="checkAsi" name="asientoSelect[]" value="PK18"><label class="asiento" for="PK18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK20"  class="checkAsi" name="asientoSelect[]" value="PK20"><label class="asiento" for="PK20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK22"  class="checkAsi" name="asientoSelect[]" value="PK22"><label class="asiento" for="PK22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PK24"  class="checkAsi" name="asientoSelect[]" value="PK24"><label class="asiento" for="PK24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">K</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-danger" colspan="16"></td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 bg-dark text-light">J</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ2"  class="checkAsi" name="asientoSelect[]" value="PJ2"><label class="asiento" for="PJ2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ4"  class="checkAsi" name="asientoSelect[]" value="PJ4"><label class="asiento" for="PJ4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ6"  class="checkAsi" name="asientoSelect[]" value="PJ6"><label class="asiento" for="PJ6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ8"  class="checkAsi" name="asientoSelect[]" value="PJ8"><label class="asiento" for="PJ8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ10"  class="checkAsi" name="asientoSelect[]" value="PJ10"><label class="asiento" for="PJ10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ12"  class="checkAsi" name="asientoSelect[]" value="PJ12"><label class="asiento" for="PJ12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ14"  class="checkAsi" name="asientoSelect[]" value="PJ14"><label class="asiento" for="PJ14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ16"  class="checkAsi" name="asientoSelect[]" value="PJ16"><label class="asiento" for="PJ16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ18"  class="checkAsi" name="asientoSelect[]" value="PJ18"><label class="asiento" for="PJ18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ20"  class="checkAsi" name="asientoSelect[]" value="PJ20"><label class="asiento" for="PJ20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ22"  class="checkAsi" name="asientoSelect[]" value="PJ22"><label class="asiento" for="PJ22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PJ24"  class="checkAsi" name="asientoSelect[]" value="PJ24"><label class="asiento" for="PJ24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">J</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">I</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PI2"  class="checkAsi" name="asientoSelect[]" value="PI2"><label class="asiento" for="PI2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PI4"  class="checkAsi" name="asientoSelect[]" value="PI4"><label class="asiento" for="PI4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PI6"  class="checkAsi" name="asientoSelect[]" value="PI6"><label class="asiento" for="PI6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI8"  class="checkAsi" name="asientoSelect[]" value="PI8"><label class="asiento" for="PI8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI10"  class="checkAsi" name="asientoSelect[]" value="PI10"><label class="asiento" for="PI10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI12"  class="checkAsi" name="asientoSelect[]" value="PI12"><label class="asiento" for="PI12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI14"  class="checkAsi" name="asientoSelect[]" value="PI14"><label class="asiento" for="PI14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI16"  class="checkAsi" name="asientoSelect[]" value="PI16"><label class="asiento" for="PI16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI18"  class="checkAsi" name="asientoSelect[]" value="PI18"><label class="asiento" for="PI18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI20"  class="checkAsi" name="asientoSelect[]" value="PI20"><label class="asiento" for="PI20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI22"  class="checkAsi" name="asientoSelect[]" value="PI22"><label class="asiento" for="PI22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PI24"  class="checkAsi" name="asientoSelect[]" value="PI24"><label class="asiento" for="PI24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">I</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-danger" colspan="16"></td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">H</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PH2"  class="checkAsi" name="asientoSelect[]" value="PH2"><label class="asiento" for="PH2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PH4"  class="checkAsi" name="asientoSelect[]" value="PH4"><label class="asiento" for="PH4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PH6"  class="checkAsi" name="asientoSelect[]" value="PH6"><label class="asiento" for="PH6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH8"  class="checkAsi" name="asientoSelect[]" value="PH8"><label class="asiento" for="PH8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH10"  class="checkAsi" name="asientoSelect[]" value="PH10"><label class="asiento" for="PH10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH12"  class="checkAsi" name="asientoSelect[]" value="PH12"><label class="asiento" for="PH12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH14"  class="checkAsi" name="asientoSelect[]" value="PH14"><label class="asiento" for="PH14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH16"  class="checkAsi" name="asientoSelect[]" value="PH16"><label class="asiento" for="PH16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH18"  class="checkAsi" name="asientoSelect[]" value="PH18"><label class="asiento" for="PH18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH20"  class="checkAsi" name="asientoSelect[]" value="PH20"><label class="asiento" for="PH20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH22"  class="checkAsi" name="asientoSelect[]" value="PH22"><label class="asiento" for="PH22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PH24"  class="checkAsi" name="asientoSelect[]" value="PH24"><label class="asiento" for="PH24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PH26"  class="checkAsi" name="asientoSelect[]" value="PH26"><label class="asiento" for="PH26"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">H</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">G</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PG2"  class="checkAsi" name="asientoSelect[]" value="PG2"><label class="asiento" for="PG2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PG4"  class="checkAsi" name="asientoSelect[]" value="PG4"><label class="asiento" for="PG4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PG6"  class="checkAsi" name="asientoSelect[]" value="PG6"><label class="asiento" for="PG6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG8"  class="checkAsi" name="asientoSelect[]" value="PG8"><label class="asiento" for="PG8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG10"  class="checkAsi" name="asientoSelect[]" value="PG10"><label class="asiento" for="PG10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG12"  class="checkAsi" name="asientoSelect[]" value="PG12"><label class="asiento" for="PG12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG14"  class="checkAsi" name="asientoSelect[]" value="PG14"><label class="asiento" for="PG14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG16"  class="checkAsi" name="asientoSelect[]" value="PG16"><label class="asiento" for="PG16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG18"  class="checkAsi" name="asientoSelect[]" value="PG18"><label class="asiento" for="PG18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG20"  class="checkAsi" name="asientoSelect[]" value="PG20"><label class="asiento" for="PG20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG22"  class="checkAsi" name="asientoSelect[]" value="PG22"><label class="asiento" for="PG22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PG24"  class="checkAsi" name="asientoSelect[]" value="PG24"><label class="asiento" for="PG24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PG26"  class="checkAsi" name="asientoSelect[]" value="PG26"><label class="asiento" for="PG26"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PG28"  class="checkAsi" name="asientoSelect[]" value="PG28"><label class="asiento" for="PG28"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">G</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">F</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PF2"  class="checkAsi" name="asientoSelect[]" value="PF2"><label class="asiento" for="PF2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PF4"  class="checkAsi" name="asientoSelect[]" value="PF4"><label class="asiento" for="PF4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PF6"  class="checkAsi" name="asientoSelect[]" value="PF6"><label class="asiento" for="PF6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF8"  class="checkAsi" name="asientoSelect[]" value="PF8"><label class="asiento" for="PF8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF10"  class="checkAsi" name="asientoSelect[]" value="PF10"><label class="asiento" for="PF10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF12"  class="checkAsi" name="asientoSelect[]" value="PF12"><label class="asiento" for="PF12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF14"  class="checkAsi" name="asientoSelect[]" value="PF14"><label class="asiento" for="PF14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF16"  class="checkAsi" name="asientoSelect[]" value="PF16"><label class="asiento" for="PF16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF18"  class="checkAsi" name="asientoSelect[]" value="PF18"><label class="asiento" for="PF18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF20"  class="checkAsi" name="asientoSelect[]" value="PF20"><label class="asiento" for="PF20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF22"  class="checkAsi" name="asientoSelect[]" value="PF22"><label class="asiento" for="PF22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PF24"  class="checkAsi" name="asientoSelect[]" value="PF24"><label class="asiento" for="PF24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PF26"  class="checkAsi" name="asientoSelect[]" value="PF26"><label class="asiento" for="PF26"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PF28"  class="checkAsi" name="asientoSelect[]" value="PF28"><label class="asiento" for="PF28"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">F</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">E</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PE2"  class="checkAsi" name="asientoSelect[]" value="PE2"><label class="asiento" for="PE2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PE4"  class="checkAsi" name="asientoSelect[]" value="PE4"><label class="asiento" for="PE4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PE6"  class="checkAsi" name="asientoSelect[]" value="PE6"><label class="asiento" for="PE6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE8"  class="checkAsi" name="asientoSelect[]" value="PE8"><label class="asiento" for="PE8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE10"  class="checkAsi" name="asientoSelect[]" value="PE10"><label class="asiento" for="PE10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE12"  class="checkAsi" name="asientoSelect[]" value="PE12"><label class="asiento" for="PE12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE14"  class="checkAsi" name="asientoSelect[]" value="PE14"><label class="asiento" for="PE14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE16"  class="checkAsi" name="asientoSelect[]" value="PE16"><label class="asiento" for="PE16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE18"  class="checkAsi" name="asientoSelect[]" value="PE18"><label class="asiento" for="PE18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE20"  class="checkAsi" name="asientoSelect[]" value="PE20"><label class="asiento" for="PE20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE22"  class="checkAsi" name="asientoSelect[]" value="PE22"><label class="asiento" for="PE22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PE24"  class="checkAsi" name="asientoSelect[]" value="PE24"><label class="asiento" for="PE24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PE26"  class="checkAsi" name="asientoSelect[]" value="PE26"><label class="asiento" for="PE26"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PE28"  class="checkAsi" name="asientoSelect[]" value="PE28"><label class="asiento" for="PE28"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">E</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">D</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PD2"  class="checkAsi" name="asientoSelect[]" value="PD2"><label class="asiento" for="PD2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PD4"  class="checkAsi" name="asientoSelect[]" value="PD4"><label class="asiento" for="PD4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PD6"  class="checkAsi" name="asientoSelect[]" value="PD6"><label class="asiento" for="PD6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD8"  class="checkAsi" name="asientoSelect[]" value="PD8"><label class="asiento" for="PD8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD10"  class="checkAsi" name="asientoSelect[]" value="PD10"><label class="asiento" for="PD10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD12"  class="checkAsi" name="asientoSelect[]" value="PD12"><label class="asiento" for="PD12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD14"  class="checkAsi" name="asientoSelect[]" value="PD14"><label class="asiento" for="PD14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD16"  class="checkAsi" name="asientoSelect[]" value="PD16"><label class="asiento" for="PD16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD18"  class="checkAsi" name="asientoSelect[]" value="PD18"><label class="asiento" for="PD18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD20"  class="checkAsi" name="asientoSelect[]" value="PD20"><label class="asiento" for="PD20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD22"  class="checkAsi" name="asientoSelect[]" value="PD22"><label class="asiento" for="PD22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PD24"  class="checkAsi" name="asientoSelect[]" value="PD24"><label class="asiento" for="PD24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PD26"  class="checkAsi" name="asientoSelect[]" value="PD26"><label class="asiento" for="PD26"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PD28"  class="checkAsi" name="asientoSelect[]" value="PD28"><label class="asiento" for="PD28"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">D</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">C</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PC2"  class="checkAsi" name="asientoSelect[]" value="PC2"><label class="asiento" for="PC2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PC4"  class="checkAsi" name="asientoSelect[]" value="PC4"><label class="asiento" for="PC4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PC6"  class="checkAsi" name="asientoSelect[]" value="PC6"><label class="asiento" for="PC6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC8"  class="checkAsi" name="asientoSelect[]" value="PC8"><label class="asiento" for="PC8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC10"  class="checkAsi" name="asientoSelect[]" value="PC10"><label class="asiento" for="PC10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC12"  class="checkAsi" name="asientoSelect[]" value="PC12"><label class="asiento" for="PC12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC14"  class="checkAsi" name="asientoSelect[]" value="PC14"><label class="asiento" for="PC14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC16"  class="checkAsi" name="asientoSelect[]" value="PC16"><label class="asiento" for="PC16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC18"  class="checkAsi" name="asientoSelect[]" value="PC18"><label class="asiento" for="PC18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC20"  class="checkAsi" name="asientoSelect[]" value="PC20"><label class="asiento" for="PC20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC22"  class="checkAsi" name="asientoSelect[]" value="PC22"><label class="asiento" for="PC22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PC24"  class="checkAsi" name="asientoSelect[]" value="PC24"><label class="asiento" for="PC24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PC26"  class="checkAsi" name="asientoSelect[]" value="PC26"><label class="asiento" for="PC26"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PC28"  class="checkAsi" name="asientoSelect[]" value="PC28"><label class="asiento" for="PC28"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">C</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">B</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PB2"  class="checkAsi" name="asientoSelect[]" value="PB2"><label class="asiento" for="PB2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PB4"  class="checkAsi" name="asientoSelect[]" value="PB4"><label class="asiento" for="PB4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PB6"  class="checkAsi" name="asientoSelect[]" value="PB6"><label class="asiento" for="PB6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB8"  class="checkAsi" name="asientoSelect[]" value="PB8"><label class="asiento" for="PB8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB10"  class="checkAsi" name="asientoSelect[]" value="PB10"><label class="asiento" for="PB10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB12"  class="checkAsi" name="asientoSelect[]" value="PB12"><label class="asiento" for="PB12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB14"  class="checkAsi" name="asientoSelect[]" value="PB14"><label class="asiento" for="PB14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB16"  class="checkAsi" name="asientoSelect[]" value="PB16"><label class="asiento" for="PB16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB18"  class="checkAsi" name="asientoSelect[]" value="PB18"><label class="asiento" for="PB18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB20"  class="checkAsi" name="asientoSelect[]" value="PB20"><label class="asiento" for="PB20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB22"  class="checkAsi" name="asientoSelect[]" value="PB22"><label class="asiento" for="PB22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PB24"  class="checkAsi" name="asientoSelect[]" value="PB24"><label class="asiento" for="PB24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PB26"  class="checkAsi" name="asientoSelect[]" value="PB26"><label class="asiento" for="PB26"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">B</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">A</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PA2"  class="checkAsi" name="asientoSelect[]" value="PA2"><label class="asiento" for="PA2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PA4"  class="checkAsi" name="asientoSelect[]" value="PA4"><label class="asiento" for="PA4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="PA6"  class="checkAsi" name="asientoSelect[]" value="PA6"><label class="asiento" for="PA6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA8"  class="checkAsi" name="asientoSelect[]" value="PA8"><label class="asiento" for="PA8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA10"  class="checkAsi" name="asientoSelect[]" value="PA10"><label class="asiento" for="PA10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA12"  class="checkAsi" name="asientoSelect[]" value="PA12"><label class="asiento" for="PA12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA14"  class="checkAsi" name="asientoSelect[]" value="PA14"><label class="asiento" for="PA14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA16"  class="checkAsi" name="asientoSelect[]" value="PA16"><label class="asiento" for="PA16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA18"  class="checkAsi" name="asientoSelect[]" value="PA18"><label class="asiento" for="PA18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA20"  class="checkAsi" name="asientoSelect[]" value="PA20"><label class="asiento" for="PA20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA22"  class="checkAsi" name="asientoSelect[]" value="PA22"><label class="asiento" for="PA22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="PA24"  class="checkAsi" name="asientoSelect[]" value="PA24"><label class="asiento" for="PA24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio bg-dark text-light">A</td>
		   														</tr>
		   													</tbody>
		   												</form>

		   											</table>

		   										</div>
		   									</div>
		   								</div>
		   							</div>

		   						</div>
		   					</div>
		   				<?php } ?>
		        		<!---------- End Tab content --------------->
		        		<?php if ($data[0]["palcoStatus"] == 1) {

		        			$palco = ($data[0]["patioStatus"] = 0) ? "active" : ""; 

		        		?>
		        		<!-- BALCON BUTACAS -->
		        			<div class="tab-pane <?php echo $palco; ?>" id="tab2">
		   						<div class="my-3">

		   							<div>
		   								<div class="boleteria p-3">
		   									<div class="table-responsive-lg table-responsive-md">
		   										<div class="text-light row">
		   											<div class="col-6">
		   												<h4 class="text-center">Balcon Oeste</h4>
		   											</div>
		   											<div class="col-6">
		   												<h4 class="text-center">Balcon Este</h4>
		   											</div>  
		   										</div>
		   										<!-- Tabla -->
		   										<table class="table-bordered bg-light">
		   											<!-- Formulario -->
		   											<form>
		   												<tbody class="text-center">
		   													<tr>
		   														<td class="p-2 h5 vacio bg-dark text-light">O</td>  
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"><input type="checkbox" id="BO1"  class="checkAsi" name="asientoSelect[]" value="BO1"><label class="asiento" for="BO1"><i class="fas fa-chair h4"></i></label></td> 
							                                    <td class="p-2 vacio"></td>   
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                   	<td class="p-2 vacio"><input type="checkbox" id="BE2"  class="checkAsi" name="asientoSelect[]" value="BE2"><label class="asiento" for="BE2"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 h5 vacio bg-dark text-light">E</td>  
		   													</tr>
		   													<tr>
		   														<td class="p-2 h5 vacio bg-dark text-light">O</td>  
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"><input type="checkbox" id="BO3"  class="checkAsi" name="asientoSelect[]" value="BO3"><label class="asiento" for="BO3"><i class="fas fa-chair h4"></i></label></td> 
							                                    <td class="p-2 vacio"></td>   
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                   	<td class="p-2 vacio"><input type="checkbox" id="BE4"  class="checkAsi" name="asientoSelect[]" value="BE4"><label class="asiento" for="BE4"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 h5 vacio bg-dark text-light">E</td>  
		   													</tr>
		   													<tr>
		   														<td class="p-2 h5 vacio bg-dark text-light">O</td>  
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"><input type="checkbox" id="BO5"  class="checkAsi" name="asientoSelect[]" value="BO5"><label class="asiento" for="BO5"><i class="fas fa-chair h4"></i></label></td> 
							                                    <td class="p-2 vacio"></td>   
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                   	<td class="p-2 vacio"><input type="checkbox" id="BE6"  class="checkAsi" name="asientoSelect[]" value="BE6"><label class="asiento" for="BE6"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 h5 vacio bg-dark text-light">E</td>  
		   													</tr>
		   													<tr>
		   														<td class="p-2 h5 vacio bg-dark text-light">O</td>  
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"><input type="checkbox" id="BO7"  class="checkAsi" name="asientoSelect[]" value="BO7"><label class="asiento" for="BO7"><i class="fas fa-chair h4"></i></label></td> 
							                                    <td class="p-2 vacio"></td>   
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                   	<td class="p-2 vacio"><input type="checkbox" id="BE8"  class="checkAsi" name="asientoSelect[]" value="BE8"><label class="asiento" for="BE8"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 h5 vacio bg-dark text-light">E</td>  
		   													</tr>
		   													<tr>
		   														<td class="p-2 h5 vacio bg-dark text-light">O</td>  
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"><input type="checkbox" id="BO9"  class="checkAsi" name="asientoSelect[]" value="BO9"><label class="asiento" for="BO9"><i class="fas fa-chair h4"></i></label></td> 
							                                    <td class="p-2 vacio"></td>   
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                   	<td class="p-2 vacio"><input type="checkbox" id="BE10"  class="checkAsi" name="asientoSelect[]" value="BE10"><label class="asiento" for="BE10"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 h5 vacio bg-dark text-light">E</td>  
		   													</tr>
		   													<tr>
		   														<td class="p-2 h5 vacio bg-dark text-light">O</td>  
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"><input type="checkbox" id="BO15"  class="checkAsi" name="asientoSelect[]" value="BO15"><label class="asiento" for="BO15"><i class="fas fa-chair h4"></i></label></td> 
							                                    <td class="p-2 vacio"><input type="checkbox" id="BO13"  class="checkAsi" name="asientoSelect[]" value="BO13"><label class="asiento" for="BO13"><i class="fas fa-chair h4"></i></label></td> 
							                                    <td class="p-2 vacio"><input type="checkbox" id="BO11"  class="checkAsi" name="asientoSelect[]" value="BO11"><label class="asiento" for="BO11"><i class="fas fa-chair h4"></i></label></td> 
							                                    <td class="p-2 vacio"></td>   
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                   	<td class="p-2 vacio"><input type="checkbox" id="BE12"  class="checkAsi" name="asientoSelect[]" value="BE12"><label class="asiento" for="BE12"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 vacio"><input type="checkbox" id="BE14"  class="checkAsi" name="asientoSelect[]" value="BE14"><label class="asiento" for="BE14"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 vacio"><input type="checkbox" id="BE16"  class="checkAsi" name="asientoSelect[]" value="BE16"><label class="asiento" for="BE16"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 h5 vacio bg-dark text-light">E</td>  
		   													</tr>
		   													<tr>
		   														<td class="p-2 h5 vacio bg-dark text-light">O</td>  
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"><input type="checkbox" id="BO19"  class="checkAsi" name="asientoSelect[]" value="BO19"><label class="asiento" for="BO19"><i class="fas fa-chair h4"></i></label></td> 
							                                    <td class="p-2 vacio"><input type="checkbox" id="BO17"  class="checkAsi" name="asientoSelect[]" value="BO17"><label class="asiento" for="BO17"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>   
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                   	<td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"><input type="checkbox" id="BE18"  class="checkAsi" name="asientoSelect[]" value="BE18"><label class="asiento" for="BE18"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 vacio"><input type="checkbox" id="BE20"  class="checkAsi" name="asientoSelect[]" value="BE20"><label class="asiento" for="BE20"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 h5 vacio bg-dark text-light">E</td>  
		   													</tr>
		   													<tr>
		   														<td class="p-2 h5 vacio bg-dark text-light">O</td>  
							                                    <td class="p-2 vacio"><input type="checkbox" id="BO23"  class="checkAsi" name="asientoSelect[]" value="BO23"><label class="asiento" for="BO23"><i class="fas fa-chair h4"></i></label></td> 
							                                    <td class="p-2 vacio"><input type="checkbox" id="BO21"  class="checkAsi" name="asientoSelect[]" value="BO21"><label class="asiento" for="BO21"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td>
							                                   	<td class="p-2 vacio"></td>
							                                    <td class="p-2 vacio"></td> 
							                                    <td class="p-2 vacio"><input type="checkbox" id="BE22"  class="checkAsi" name="asientoSelect[]" value="BE22"><label class="asiento" for="BE22"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 vacio"><input type="checkbox" id="BE24"  class="checkAsi" name="asientoSelect[]" value="BE24"><label class="asiento" for="BE24"><i class="fas fa-chair h4"></i></label></td>
							                                    <td class="p-2 h5 vacio bg-dark text-light">E</td>  
		   													</tr>
		   												</tbody>
		   											</form>
		   										</table>
		   									</div>
		   								</div>
		   							</div>

		   						</div>
		   					</div>

		        		<?php } ?>
		        		<!---------- End Tab content --------------->
		        		<?php if ($data[0]["galeriaStatus"] == 1) {

		        			$galeria = ($data[0]["patioStatus"] == 0 && $data[0]["palcoStatus"] == 0) ? "active" : ""; 

		        		?>
		        		<!-- BALCON BUTACAS -->
		        			<div class="tab-pane <?php echo $galeria; ?>" id="tab3">
		   						<div class="my-3">

		   							<div id="galeriaOeste">
		   								<div>
		   									<div class="boleteria p-3">
		   										<div class="table-responsive-lg table-responsive-md">
		   											<!-- Seccion -->
		   											<h4 class="text-light text-center">Galería Oeste 
		   												<span tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="right" data-bs-content="Ir a la galería este"><i class="fas fa-circle-arrow-right" type="button" id="irGaleriaEste"></i></span>
		   											</h4>
		   											<!-- Tabla -->
		   											<table class="table-bordered bg-light">
		   												<!-- Formulario -->
		   												<form>
		   													<tbody class="text-center">
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">L</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GL1"  class="checkAsi" name="asientoSelect[]" value="GL1"><label class="asiento" for="GL1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GL3"  class="checkAsi" name="asientoSelect[]" value="GL3"><label class="asiento" for="GL3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GL5"  class="checkAsi" name="asientoSelect[]" value="GL5"><label class="asiento" for="GL5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL7"  class="checkAsi" name="asientoSelect[]" value="GL7"><label class="asiento" for="GL7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL9"  class="checkAsi" name="asientoSelect[]" value="GL9"><label class="asiento" for="GL9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL11"  class="checkAsi" name="asientoSelect[]" value="GL11"><label class="asiento" for="GL11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL13"  class="checkAsi" name="asientoSelect[]" value="GL13"><label class="asiento" for="GL13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL15"  class="checkAsi" name="asientoSelect[]" value="GL15"><label class="asiento" for="GL15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL17"  class="checkAsi" name="asientoSelect[]" value="GL17"><label class="asiento" for="GL17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL19"  class="checkAsi" name="asientoSelect[]" value="GL19"><label class="asiento" for="GL19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL21"  class="checkAsi" name="asientoSelect[]" value="GL21"><label class="asiento" for="GL21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL23"  class="checkAsi" name="asientoSelect[]" value="GL23"><label class="asiento" for="GL23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GL25"  class="checkAsi" name="asientoSelect[]" value="GL25"><label class="asiento" for="GL25"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GL27"  class="checkAsi" name="asientoSelect[]" value="GL27"><label class="asiento" for="GL27"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">L</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">K</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GK1"  class="checkAsi" name="asientoSelect[]" value="GK1"><label class="asiento" for="GK1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GK3"  class="checkAsi" name="asientoSelect[]" value="GK3"><label class="asiento" for="GK3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GK5"  class="checkAsi" name="asientoSelect[]" value="GK5"><label class="asiento" for="GK5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK7"  class="checkAsi" name="asientoSelect[]" value="GK7"><label class="asiento" for="GK7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK9"  class="checkAsi" name="asientoSelect[]" value="GK9"><label class="asiento" for="GK9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK11"  class="checkAsi" name="asientoSelect[]" value="GK11"><label class="asiento" for="GK11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK13"  class="checkAsi" name="asientoSelect[]" value="GK13"><label class="asiento" for="GK13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK15"  class="checkAsi" name="asientoSelect[]" value="GK15"><label class="asiento" for="GK15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK17"  class="checkAsi" name="asientoSelect[]" value="GK17"><label class="asiento" for="GK17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK19"  class="checkAsi" name="asientoSelect[]" value="GK19"><label class="asiento" for="GK19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK21"  class="checkAsi" name="asientoSelect[]" value="GK21"><label class="asiento" for="GK21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK23"  class="checkAsi" name="asientoSelect[]" value="GK23"><label class="asiento" for="GK23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GK25"  class="checkAsi" name="asientoSelect[]" value="GK25"><label class="asiento" for="GK25"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GK27"  class="checkAsi" name="asientoSelect[]" value="GK27"><label class="asiento" for="GK27"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">K</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 bg-dark text-light">J</td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ1"  class="checkAsi" name="asientoSelect[]" value="GJ1"><label class="asiento" for="GJ1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ3"  class="checkAsi" name="asientoSelect[]" value="GJ3"><label class="asiento" for="GJ3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ5"  class="checkAsi" name="asientoSelect[]" value="GJ5"><label class="asiento" for="GJ5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ7"  class="checkAsi" name="asientoSelect[]" value="GJ7"><label class="asiento" for="GJ7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ9"  class="checkAsi" name="asientoSelect[]" value="GJ9"><label class="asiento" for="GJ9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ11"  class="checkAsi" name="asientoSelect[]" value="GJ11"><label class="asiento" for="GJ11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ13"  class="checkAsi" name="asientoSelect[]" value="GJ13"><label class="asiento" for="GJ13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ15"  class="checkAsi" name="asientoSelect[]" value="GJ15"><label class="asiento" for="GJ15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ17"  class="checkAsi" name="asientoSelect[]" value="GJ17"><label class="asiento" for="GJ17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ19"  class="checkAsi" name="asientoSelect[]" value="GJ19"><label class="asiento" for="GJ19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ21"  class="checkAsi" name="asientoSelect[]" value="GJ21"><label class="asiento" for="GJ21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ23"  class="checkAsi" name="asientoSelect[]" value="GJ23"><label class="asiento" for="GJ23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ25"  class="checkAsi" name="asientoSelect[]" value="GJ25"><label class="asiento" for="GJ25"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ27"  class="checkAsi" name="asientoSelect[]" value="GJ27"><label class="asiento" for="GJ27"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">J</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">I</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GI1"  class="checkAsi" name="asientoSelect[]" value="GI1"><label class="asiento" for="GI1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GI3"  class="checkAsi" name="asientoSelect[]" value="GI3"><label class="asiento" for="GI3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GI5"  class="checkAsi" name="asientoSelect[]" value="GI5"><label class="asiento" for="GI5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI7"  class="checkAsi" name="asientoSelect[]" value="GI7"><label class="asiento" for="GI7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI9"  class="checkAsi" name="asientoSelect[]" value="GI9"><label class="asiento" for="GI9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI11"  class="checkAsi" name="asientoSelect[]" value="GI11"><label class="asiento" for="GI11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI13"  class="checkAsi" name="asientoSelect[]" value="GI13"><label class="asiento" for="GI13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI15"  class="checkAsi" name="asientoSelect[]" value="GI15"><label class="asiento" for="GI15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI17"  class="checkAsi" name="asientoSelect[]" value="GI17"><label class="asiento" for="GI17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI19"  class="checkAsi" name="asientoSelect[]" value="GI19"><label class="asiento" for="GI19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI21"  class="checkAsi" name="asientoSelect[]" value="GI21"><label class="asiento" for="GI21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI23"  class="checkAsi" name="asientoSelect[]" value="GI23"><label class="asiento" for="GI23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">I</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">H</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GH1"  class="checkAsi" name="asientoSelect[]" value="GH1"><label class="asiento" for="GH1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GH3"  class="checkAsi" name="asientoSelect[]" value="GH3"><label class="asiento" for="GH3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GH5"  class="checkAsi" name="asientoSelect[]" value="GH5"><label class="asiento" for="GH5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH7"  class="checkAsi" name="asientoSelect[]" value="GH7"><label class="asiento" for="GH7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH9"  class="checkAsi" name="asientoSelect[]" value="GH9"><label class="asiento" for="GH9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH11"  class="checkAsi" name="asientoSelect[]" value="GH11"><label class="asiento" for="GH11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH13"  class="checkAsi" name="asientoSelect[]" value="GH13"><label class="asiento" for="GH13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH15"  class="checkAsi" name="asientoSelect[]" value="GH15"><label class="asiento" for="GH15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH17"  class="checkAsi" name="asientoSelect[]" value="GH17"><label class="asiento" for="GH17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH19"  class="checkAsi" name="asientoSelect[]" value="GH19"><label class="asiento" for="GH19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH21"  class="checkAsi" name="asientoSelect[]" value="GH21"><label class="asiento" for="GH21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH23"  class="checkAsi" name="asientoSelect[]" value="GH23"><label class="asiento" for="GH23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio bg-dark text-light">H</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">G</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GG1"  class="checkAsi" name="asientoSelect[]" value="GG1"><label class="asiento" for="GG1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GG3"  class="checkAsi" name="asientoSelect[]" value="GG3"><label class="asiento" for="GG3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GG5"  class="checkAsi" name="asientoSelect[]" value="GG5"><label class="asiento" for="GG5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG7"  class="checkAsi" name="asientoSelect[]" value="GG7"><label class="asiento" for="GG7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG9"  class="checkAsi" name="asientoSelect[]" value="GG9"><label class="asiento" for="GG9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG11"  class="checkAsi" name="asientoSelect[]" value="GG11"><label class="asiento" for="GG11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG13"  class="checkAsi" name="asientoSelect[]" value="GG13"><label class="asiento" for="GG13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG15"  class="checkAsi" name="asientoSelect[]" value="GG15"><label class="asiento" for="GG15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG17"  class="checkAsi" name="asientoSelect[]" value="GG17"><label class="asiento" for="GG17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG19"  class="checkAsi" name="asientoSelect[]" value="GG19"><label class="asiento" for="GG19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG21"  class="checkAsi" name="asientoSelect[]" value="GG21"><label class="asiento" for="GG21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG23"  class="checkAsi" name="asientoSelect[]" value="GG23"><label class="asiento" for="GG23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio bg-dark text-light">G</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">F</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GF1"  class="checkAsi" name="asientoSelect[]" value="GF1"><label class="asiento" for="GF1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GF3"  class="checkAsi" name="asientoSelect[]" value="GF3"><label class="asiento" for="GF3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GF5"  class="checkAsi" name="asientoSelect[]" value="GF5"><label class="asiento" for="GF5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF7"  class="checkAsi" name="asientoSelect[]" value="GF7"><label class="asiento" for="GF7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF9"  class="checkAsi" name="asientoSelect[]" value="GF9"><label class="asiento" for="GF9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF11"  class="checkAsi" name="asientoSelect[]" value="GF11"><label class="asiento" for="GF11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF13"  class="checkAsi" name="asientoSelect[]" value="GF13"><label class="asiento" for="GF13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF15"  class="checkAsi" name="asientoSelect[]" value="GF15"><label class="asiento" for="GF15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF17"  class="checkAsi" name="asientoSelect[]" value="GF17"><label class="asiento" for="GF17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF19"  class="checkAsi" name="asientoSelect[]" value="GF19"><label class="asiento" for="GF19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF21"  class="checkAsi" name="asientoSelect[]" value="GF21"><label class="asiento" for="GF21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF23"  class="checkAsi" name="asientoSelect[]" value="GF23"><label class="asiento" for="GF23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio bg-dark text-light">F</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">E</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GE1"  class="checkAsi" name="asientoSelect[]" value="GE1"><label class="asiento" for="GE1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GE3"  class="checkAsi" name="asientoSelect[]" value="GE3"><label class="asiento" for="GE3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GE5"  class="checkAsi" name="asientoSelect[]" value="GE5"><label class="asiento" for="GE5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE7"  class="checkAsi" name="asientoSelect[]" value="GE7"><label class="asiento" for="GE7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE9"  class="checkAsi" name="asientoSelect[]" value="GE9"><label class="asiento" for="GE9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE11"  class="checkAsi" name="asientoSelect[]" value="GE11"><label class="asiento" for="GE11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE13"  class="checkAsi" name="asientoSelect[]" value="GE13"><label class="asiento" for="GE13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE15"  class="checkAsi" name="asientoSelect[]" value="GE15"><label class="asiento" for="GE15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE17"  class="checkAsi" name="asientoSelect[]" value="GE17"><label class="asiento" for="GE17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE19"  class="checkAsi" name="asientoSelect[]" value="GE19"><label class="asiento" for="GE19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE21"  class="checkAsi" name="asientoSelect[]" value="GE21"><label class="asiento" for="GE21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE23"  class="checkAsi" name="asientoSelect[]" value="GE23"><label class="asiento" for="GE23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio bg-dark text-light">E</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">D</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GD1"  class="checkAsi" name="asientoSelect[]" value="GD1"><label class="asiento" for="GD1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GD3"  class="checkAsi" name="asientoSelect[]" value="GD3"><label class="asiento" for="GD3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GD5"  class="checkAsi" name="asientoSelect[]" value="GD5"><label class="asiento" for="GD5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD7"  class="checkAsi" name="asientoSelect[]" value="GD7"><label class="asiento" for="GD7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD9"  class="checkAsi" name="asientoSelect[]" value="GD9"><label class="asiento" for="GD9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD11"  class="checkAsi" name="asientoSelect[]" value="GD11"><label class="asiento" for="GD11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD13"  class="checkAsi" name="asientoSelect[]" value="GD13"><label class="asiento" for="GD13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD15"  class="checkAsi" name="asientoSelect[]" value="GD15"><label class="asiento" for="GD15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD17"  class="checkAsi" name="asientoSelect[]" value="GD17"><label class="asiento" for="GD17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD19"  class="checkAsi" name="asientoSelect[]" value="GD19"><label class="asiento" for="GD19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD21"  class="checkAsi" name="asientoSelect[]" value="GD21"><label class="asiento" for="GD21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD23"  class="checkAsi" name="asientoSelect[]" value="GD23"><label class="asiento" for="GD23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio bg-dark text-light">D</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">C</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GC1"  class="checkAsi" name="asientoSelect[]" value="GC1"><label class="asiento" for="GC1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GC3"  class="checkAsi" name="asientoSelect[]" value="GC3"><label class="asiento" for="GC3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GC5"  class="checkAsi" name="asientoSelect[]" value="GC5"><label class="asiento" for="GC5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC7"  class="checkAsi" name="asientoSelect[]" value="GC7"><label class="asiento" for="GC7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC9"  class="checkAsi" name="asientoSelect[]" value="GC9"><label class="asiento" for="GC9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC11"  class="checkAsi" name="asientoSelect[]" value="GC11"><label class="asiento" for="GC11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC13"  class="checkAsi" name="asientoSelect[]" value="GC13"><label class="asiento" for="GC13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC15"  class="checkAsi" name="asientoSelect[]" value="GC15"><label class="asiento" for="GC15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC17"  class="checkAsi" name="asientoSelect[]" value="GC17"><label class="asiento" for="GC17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC19"  class="checkAsi" name="asientoSelect[]" value="GC19"><label class="asiento" for="GC19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC21"  class="checkAsi" name="asientoSelect[]" value="GC21"><label class="asiento" for="GC21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC23"  class="checkAsi" name="asientoSelect[]" value="GC23"><label class="asiento" for="GC23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GC25"  class="checkAsi" name="asientoSelect[]" value="GC25"><label class="asiento" for="GC25"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">C</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">B</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GB1"  class="checkAsi" name="asientoSelect[]" value="GB1"><label class="asiento" for="GB1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GB3"  class="checkAsi" name="asientoSelect[]" value="GB3"><label class="asiento" for="GB3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GB5"  class="checkAsi" name="asientoSelect[]" value="GB5"><label class="asiento" for="GB5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB7"  class="checkAsi" name="asientoSelect[]" value="GB7"><label class="asiento" for="GB7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB9"  class="checkAsi" name="asientoSelect[]" value="GB9"><label class="asiento" for="GB9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB11"  class="checkAsi" name="asientoSelect[]" value="GB11"><label class="asiento" for="GB11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB13"  class="checkAsi" name="asientoSelect[]" value="GB13"><label class="asiento" for="GB13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB15"  class="checkAsi" name="asientoSelect[]" value="GB15"><label class="asiento" for="GB15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB17"  class="checkAsi" name="asientoSelect[]" value="GB17"><label class="asiento" for="GB17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB19"  class="checkAsi" name="asientoSelect[]" value="GB19"><label class="asiento" for="GB19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB21"  class="checkAsi" name="asientoSelect[]" value="GB21"><label class="asiento" for="GB21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB23"  class="checkAsi" name="asientoSelect[]" value="GB23"><label class="asiento" for="GB23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GB25"  class="checkAsi" name="asientoSelect[]" value="GB25"><label class="asiento" for="GB25"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">B</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">A</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GA1"  class="checkAsi" name="asientoSelect[]" value="GA1"><label class="asiento" for="GA1"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GA3"  class="checkAsi" name="asientoSelect[]" value="GA3"><label class="asiento" for="GA3"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GA5"  class="checkAsi" name="asientoSelect[]" value="GA5"><label class="asiento" for="GA5"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA7"  class="checkAsi" name="asientoSelect[]" value="GA7"><label class="asiento" for="GA7"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA9"  class="checkAsi" name="asientoSelect[]" value="GA9"><label class="asiento" for="GA9"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA11"  class="checkAsi" name="asientoSelect[]" value="GA11"><label class="asiento" for="GA11"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA13"  class="checkAsi" name="asientoSelect[]" value="GA13"><label class="asiento" for="GA13"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA15"  class="checkAsi" name="asientoSelect[]" value="GA15"><label class="asiento" for="GA15"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA17"  class="checkAsi" name="asientoSelect[]" value="GA17"><label class="asiento" for="GA17"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA19"  class="checkAsi" name="asientoSelect[]" value="GA19"><label class="asiento" for="GA19"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA21"  class="checkAsi" name="asientoSelect[]" value="GA21"><label class="asiento" for="GA21"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA23"  class="checkAsi" name="asientoSelect[]" value="GA23"><label class="asiento" for="GA23"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GA25"  class="checkAsi" name="asientoSelect[]" value="GA25"><label class="asiento" for="GA25"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">A</td>
		   														</tr>
		   													</tbody>
		   												</form>

		   											</table>

		   										</div>
		   									</div>
		   								</div>
		   							</div>

		   							<div id="galeriaEste">
		   								<div>
		   									<div class="boleteria p-3">
		   										<div class="table-responsive-lg table-responsive-md">
		   											<!-- Seccion -->
		   											<h4 class="text-light text-center">
		   												<span tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="right" data-bs-content="Ir a la galería oeste"><i class="fas fa-circle-arrow-left" type="button" id="irGaleriaOeste"></i></span>
		   												Galería Este
		   											</h4>
		   											<!-- Tabla -->
		   											<table class="table-bordered bg-light">
		   												<!-- Formulario -->
		   												<form>
		   													<tbody class="text-center">
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">L</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GL2"  class="checkAsi" name="asientoSelect[]" value="GL2"><label class="asiento" for="GL2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GL4"  class="checkAsi" name="asientoSelect[]" value="GL4"><label class="asiento" for="GL4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GL6"  class="checkAsi" name="asientoSelect[]" value="GL6"><label class="asiento" for="GL6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL8"  class="checkAsi" name="asientoSelect[]" value="GL8"><label class="asiento" for="GL8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL10"  class="checkAsi" name="asientoSelect[]" value="GL10"><label class="asiento" for="GL10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL12"  class="checkAsi" name="asientoSelect[]" value="GL12"><label class="asiento" for="GL12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL14"  class="checkAsi" name="asientoSelect[]" value="GL14"><label class="asiento" for="GL14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL16"  class="checkAsi" name="asientoSelect[]" value="GL16"><label class="asiento" for="GL16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL18"  class="checkAsi" name="asientoSelect[]" value="GL18"><label class="asiento" for="GL18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL20"  class="checkAsi" name="asientoSelect[]" value="GL20"><label class="asiento" for="GL20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL22"  class="checkAsi" name="asientoSelect[]" value="GL22"><label class="asiento" for="GL22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GL24"  class="checkAsi" name="asientoSelect[]" value="GL24"><label class="asiento" for="GL24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GL26"  class="checkAsi" name="asientoSelect[]" value="GL26"><label class="asiento" for="GL26"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">L</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">K</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GK2"  class="checkAsi" name="asientoSelect[]" value="GK2"><label class="asiento" for="GK2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GK4"  class="checkAsi" name="asientoSelect[]" value="GK4"><label class="asiento" for="GK4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GK6"  class="checkAsi" name="asientoSelect[]" value="GK6"><label class="asiento" for="GK6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK8"  class="checkAsi" name="asientoSelect[]" value="GK8"><label class="asiento" for="GK8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK10"  class="checkAsi" name="asientoSelect[]" value="GK10"><label class="asiento" for="GK10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK12"  class="checkAsi" name="asientoSelect[]" value="GK12"><label class="asiento" for="GK12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK14"  class="checkAsi" name="asientoSelect[]" value="GK14"><label class="asiento" for="GK14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK16"  class="checkAsi" name="asientoSelect[]" value="GK16"><label class="asiento" for="GK16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK18"  class="checkAsi" name="asientoSelect[]" value="GK18"><label class="asiento" for="GK18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK20"  class="checkAsi" name="asientoSelect[]" value="GK20"><label class="asiento" for="GK20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK22"  class="checkAsi" name="asientoSelect[]" value="GK22"><label class="asiento" for="GK22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GK24"  class="checkAsi" name="asientoSelect[]" value="GK24"><label class="asiento" for="GK24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GK26"  class="checkAsi" name="asientoSelect[]" value="GK26"><label class="asiento" for="GK26"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">K</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 bg-dark text-light">J</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ2"  class="checkAsi" name="asientoSelect[]" value="GJ2"><label class="asiento" for="GJ2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ4"  class="checkAsi" name="asientoSelect[]" value="GJ4"><label class="asiento" for="GJ4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ6"  class="checkAsi" name="asientoSelect[]" value="GJ6"><label class="asiento" for="GJ6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ8"  class="checkAsi" name="asientoSelect[]" value="GJ8"><label class="asiento" for="GJ8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ10"  class="checkAsi" name="asientoSelect[]" value="GJ10"><label class="asiento" for="GJ10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ12"  class="checkAsi" name="asientoSelect[]" value="GJ12"><label class="asiento" for="GJ12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ14"  class="checkAsi" name="asientoSelect[]" value="GJ14"><label class="asiento" for="GJ14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ16"  class="checkAsi" name="asientoSelect[]" value="GJ16"><label class="asiento" for="GJ16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ18"  class="checkAsi" name="asientoSelect[]" value="GJ18"><label class="asiento" for="GJ18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ20"  class="checkAsi" name="asientoSelect[]" value="GJ20"><label class="asiento" for="GJ20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ22"  class="checkAsi" name="asientoSelect[]" value="GJ22"><label class="asiento" for="GJ22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GJ24"  class="checkAsi" name="asientoSelect[]" value="GJ24"><label class="asiento" for="GJ24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">J</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 h5 vacio bg-dark text-light">I</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GI2"  class="checkAsi" name="asientoSelect[]" value="GI2"><label class="asiento" for="GI2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GI4"  class="checkAsi" name="asientoSelect[]" value="GI4"><label class="asiento" for="GI4"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI6"  class="checkAsi" name="asientoSelect[]" value="GI6"><label class="asiento" for="GI6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI8"  class="checkAsi" name="asientoSelect[]" value="GI8"><label class="asiento" for="GI8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI10"  class="checkAsi" name="asientoSelect[]" value="GI10"><label class="asiento" for="GI10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI12"  class="checkAsi" name="asientoSelect[]" value="GI12"><label class="asiento" for="GI12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI14"  class="checkAsi" name="asientoSelect[]" value="GI14"><label class="asiento" for="GI14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI16"  class="checkAsi" name="asientoSelect[]" value="GI16"><label class="asiento" for="GI16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI18"  class="checkAsi" name="asientoSelect[]" value="GI18"><label class="asiento" for="GI18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GI20"  class="checkAsi" name="asientoSelect[]" value="GI20"><label class="asiento" for="GI20"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GI22"  class="checkAsi" name="asientoSelect[]" value="GI22"><label class="asiento" for="GI22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 h5 vacio bg-dark text-light">I</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">H</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GH2"  class="checkAsi" name="asientoSelect[]" value="GH2"><label class="asiento" for="GH2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GH4"  class="checkAsi" name="asientoSelect[]" value="GH4"><label class="asiento" for="GH4"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH6"  class="checkAsi" name="asientoSelect[]" value="GH6"><label class="asiento" for="GH6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH8"  class="checkAsi" name="asientoSelect[]" value="GH8"><label class="asiento" for="GH8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH10"  class="checkAsi" name="asientoSelect[]" value="GH10"><label class="asiento" for="GH10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH12"  class="checkAsi" name="asientoSelect[]" value="GH12"><label class="asiento" for="GH12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH14"  class="checkAsi" name="asientoSelect[]" value="GH14"><label class="asiento" for="GH14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH16"  class="checkAsi" name="asientoSelect[]" value="GH16"><label class="asiento" for="GH16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH18"  class="checkAsi" name="asientoSelect[]" value="GH18"><label class="asiento" for="GH18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GH20"  class="checkAsi" name="asientoSelect[]" value="GH20"><label class="asiento" for="GH20"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GH22"  class="checkAsi" name="asientoSelect[]" value="GH22"><label class="asiento" for="GH22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio bg-dark text-light">H</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">G</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GG2"  class="checkAsi" name="asientoSelect[]" value="GG2"><label class="asiento" for="GG2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GG4"  class="checkAsi" name="asientoSelect[]" value="GG4"><label class="asiento" for="GG4"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG6"  class="checkAsi" name="asientoSelect[]" value="GG6"><label class="asiento" for="GG6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG8"  class="checkAsi" name="asientoSelect[]" value="GG8"><label class="asiento" for="GG8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG10"  class="checkAsi" name="asientoSelect[]" value="GG10"><label class="asiento" for="GG10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG12"  class="checkAsi" name="asientoSelect[]" value="GG12"><label class="asiento" for="GG12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG14"  class="checkAsi" name="asientoSelect[]" value="GG14"><label class="asiento" for="GG14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG16"  class="checkAsi" name="asientoSelect[]" value="GG16"><label class="asiento" for="GG16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG18"  class="checkAsi" name="asientoSelect[]" value="GG18"><label class="asiento" for="GG18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GG20"  class="checkAsi" name="asientoSelect[]" value="GG20"><label class="asiento" for="GG20"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GG22"  class="checkAsi" name="asientoSelect[]" value="GG22"><label class="asiento" for="GG22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio bg-dark text-light">G</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">F</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GF2"  class="checkAsi" name="asientoSelect[]" value="GF2"><label class="asiento" for="GF2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GF4"  class="checkAsi" name="asientoSelect[]" value="GF4"><label class="asiento" for="GF4"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF6"  class="checkAsi" name="asientoSelect[]" value="GF6"><label class="asiento" for="GF6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF8"  class="checkAsi" name="asientoSelect[]" value="GF8"><label class="asiento" for="GF8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF10"  class="checkAsi" name="asientoSelect[]" value="GF10"><label class="asiento" for="GF10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF12"  class="checkAsi" name="asientoSelect[]" value="GF12"><label class="asiento" for="GF12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF14"  class="checkAsi" name="asientoSelect[]" value="GF14"><label class="asiento" for="GF14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF16"  class="checkAsi" name="asientoSelect[]" value="GF16"><label class="asiento" for="GF16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF18"  class="checkAsi" name="asientoSelect[]" value="GF18"><label class="asiento" for="GF18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GF20"  class="checkAsi" name="asientoSelect[]" value="GF20"><label class="asiento" for="GF20"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GF22"  class="checkAsi" name="asientoSelect[]" value="GF22"><label class="asiento" for="GF22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio bg-dark text-light">F</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">E</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GE2"  class="checkAsi" name="asientoSelect[]" value="GE2"><label class="asiento" for="GE2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GE4"  class="checkAsi" name="asientoSelect[]" value="GE4"><label class="asiento" for="GE4"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE6"  class="checkAsi" name="asientoSelect[]" value="GE6"><label class="asiento" for="GE6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE8"  class="checkAsi" name="asientoSelect[]" value="GE8"><label class="asiento" for="GE8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE10"  class="checkAsi" name="asientoSelect[]" value="GE10"><label class="asiento" for="GE10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE12"  class="checkAsi" name="asientoSelect[]" value="GE12"><label class="asiento" for="GE12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE14"  class="checkAsi" name="asientoSelect[]" value="GE14"><label class="asiento" for="GE14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE16"  class="checkAsi" name="asientoSelect[]" value="GE16"><label class="asiento" for="GE16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE18"  class="checkAsi" name="asientoSelect[]" value="GE18"><label class="asiento" for="GE18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GE20"  class="checkAsi" name="asientoSelect[]" value="GE20"><label class="asiento" for="GE20"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GE22"  class="checkAsi" name="asientoSelect[]" value="GE22"><label class="asiento" for="GE22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio bg-dark text-light">E</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">D</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GD2"  class="checkAsi" name="asientoSelect[]" value="GD2"><label class="asiento" for="GD2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GD4"  class="checkAsi" name="asientoSelect[]" value="GD4"><label class="asiento" for="GD4"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD6"  class="checkAsi" name="asientoSelect[]" value="GD6"><label class="asiento" for="GD6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD8"  class="checkAsi" name="asientoSelect[]" value="GD8"><label class="asiento" for="GD8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD10"  class="checkAsi" name="asientoSelect[]" value="GD10"><label class="asiento" for="GD10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD12"  class="checkAsi" name="asientoSelect[]" value="GD12"><label class="asiento" for="GD12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD14"  class="checkAsi" name="asientoSelect[]" value="GD14"><label class="asiento" for="GD14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD16"  class="checkAsi" name="asientoSelect[]" value="GD16"><label class="asiento" for="GD16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD18"  class="checkAsi" name="asientoSelect[]" value="GD18"><label class="asiento" for="GD18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GD20"  class="checkAsi" name="asientoSelect[]" value="GD20"><label class="asiento" for="GD20"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GD22"  class="checkAsi" name="asientoSelect[]" value="GD22"><label class="asiento" for="GD22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio bg-dark text-light">D</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">C</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GC2"  class="checkAsi" name="asientoSelect[]" value="GC2"><label class="asiento" for="GC2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GC4"  class="checkAsi" name="asientoSelect[]" value="GC4"><label class="asiento" for="GC4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GC6"  class="checkAsi" name="asientoSelect[]" value="GC6"><label class="asiento" for="GC6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC8"  class="checkAsi" name="asientoSelect[]" value="GC8"><label class="asiento" for="GC8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC10"  class="checkAsi" name="asientoSelect[]" value="GC10"><label class="asiento" for="GC10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC12"  class="checkAsi" name="asientoSelect[]" value="GC12"><label class="asiento" for="GC12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC14"  class="checkAsi" name="asientoSelect[]" value="GC14"><label class="asiento" for="GC14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC16"  class="checkAsi" name="asientoSelect[]" value="GC16"><label class="asiento" for="GC16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC18"  class="checkAsi" name="asientoSelect[]" value="GC18"><label class="asiento" for="GC18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC20"  class="checkAsi" name="asientoSelect[]" value="GC20"><label class="asiento" for="GC20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC22"  class="checkAsi" name="asientoSelect[]" value="GC22"><label class="asiento" for="GC22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GC24"  class="checkAsi" name="asientoSelect[]" value="GC24"><label class="asiento" for="GC24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio bg-dark text-light">C</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">B</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GB2"  class="checkAsi" name="asientoSelect[]" value="GB2"><label class="asiento" for="GB2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GB4"  class="checkAsi" name="asientoSelect[]" value="GB4"><label class="asiento" for="GB4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GB6"  class="checkAsi" name="asientoSelect[]" value="GB6"><label class="asiento" for="GB6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB8"  class="checkAsi" name="asientoSelect[]" value="GB8"><label class="asiento" for="GB8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB10"  class="checkAsi" name="asientoSelect[]" value="GB10"><label class="asiento" for="GB10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB12"  class="checkAsi" name="asientoSelect[]" value="GB12"><label class="asiento" for="GB12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB14"  class="checkAsi" name="asientoSelect[]" value="GB14"><label class="asiento" for="GB14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB16"  class="checkAsi" name="asientoSelect[]" value="GB16"><label class="asiento" for="GB16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB18"  class="checkAsi" name="asientoSelect[]" value="GB18"><label class="asiento" for="GB18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB2'"  class="checkAsi" name="asientoSelect[]" value="GB2'"><label class="asiento" for="GB2'"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB22"  class="checkAsi" name="asientoSelect[]" value="GB22"><label class="asiento" for="GB22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GB24"  class="checkAsi" name="asientoSelect[]" value="GB24"><label class="asiento" for="GB24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GB26"  class="checkAsi" name="asientoSelect[]" value="GB26"><label class="asiento" for="GB26"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">B</td>
		   														</tr>
		   														<tr>
		   															<td class="p-2 vacio bg-dark text-light">A</td>
		   															<td class="p-2 vacio"></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GA2"  class="checkAsi" name="asientoSelect[]" value="GA2"><label class="asiento" for="GA2"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GA4"  class="checkAsi" name="asientoSelect[]" value="GA4"><label class="asiento" for="GA4"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GA6"  class="checkAsi" name="asientoSelect[]" value="GA6"><label class="asiento" for="GA6"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA8"  class="checkAsi" name="asientoSelect[]" value="GA8"><label class="asiento" for="GA8"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA10"  class="checkAsi" name="asientoSelect[]" value="GA10"><label class="asiento" for="GA10"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA12"  class="checkAsi" name="asientoSelect[]" value="GA12"><label class="asiento" for="GA12"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA14"  class="checkAsi" name="asientoSelect[]" value="GA14"><label class="asiento" for="GA14"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA16"  class="checkAsi" name="asientoSelect[]" value="GA16"><label class="asiento" for="GA16"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA18"  class="checkAsi" name="asientoSelect[]" value="GA18"><label class="asiento" for="GA18"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA20"  class="checkAsi" name="asientoSelect[]" value="GA20"><label class="asiento" for="GA20"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA22"  class="checkAsi" name="asientoSelect[]" value="GA22"><label class="asiento" for="GA22"><i class="fas fa-chair h4"></i></label></td> 
		   															<td class="p-2 vacio"><input type="checkbox" id="GA24"  class="checkAsi" name="asientoSelect[]" value="GA24"><label class="asiento" for="GA24"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio"><input type="checkbox" id="GA26"  class="checkAsi" name="asientoSelect[]" value="GA26"><label class="asiento" for="GA26"><i class="fas fa-chair h4"></i></label></td>
		   															<td class="p-2 vacio bg-dark text-light">A</td>
		   														</tr>
		   													</tbody>
		   												</form>

		   											</table>

		   										</div>
		   									</div>
		   								</div>
		   							</div>

		   						</div>
		   					</div>

		   				</div>

		   				<?php } ?>

		   				<div class="text-center text-light mb-3 h5 d-block w-75 p-2 mx-auto rounded bg-dark">
		   					Asientos Seleccionados:<span class="text-light"> 0 <i class="fas fa-chair seleccionado"></i></span>
		   				</div>

		   			</section>
		   		</div>

		   		<div class="mb-3 text-center mx-auto">
					<a href="?url=cartelera&type=mostrar" class="btn btn-dark text-light">
						<i class="fas fa-circle-xmark"></i> Cancelar
					</a>
					<a href="?url=boleteria&type=pagar&event=<?php echo $data[0]["nroEvento"]; ?>" class="btn btn-success text-light">
						<i class="fas fa-circle-check"></i> Continuar
					</a>
				</div>

		   	</div>
		</div>
	</div>


	<div class="modal fade" id="modalFactura" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header bg-light ">
                        <h5 class="modal-title"><i class="fa-solid fa-file-lines me-2"></i>Detalles de compra</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="p-3">
                            <div class="row">
                            	<div class="d-flex mb-2">
                            		<div class="col-6">
                            			<b>Nombre del evento:</b>
                            		</div>
                            		<div class="col-6">
                            			<?php echo $data[0]["nombre"]; ?>
                            		</div>
                            	</div>
                            	<div class="d-flex mb-2">
                            		<div class="col-6">
                            			<b>Fecha del evento:</b>
                            		</div>
                            		<div class="col-6">
                            			<?php echo $data[0]["fechaEvento"]; ?>
                            		</div>
                            	</div>
                            	<div class="d-flex mb-2">
                            		<div class="col-6">
                            			<b>Hora del evento:</b>
                            		</div>
                            		<div class="col-6">
                            			<?php echo $data[0]["horaInicio"]; ?>
                            		</div>
                            	</div>
                            	<div class="d-flex mb-2">
                            		<div class="col-6">
                            			<b>Areas:</b>
                            		</div>
                            		<div class="col-6">
                            			Patio
                            		</div>
                            	</div>
                            	<div class="d-flex mb-2">
                            		<div class="col-6">
                            			<b>Asientos:</b>
                            		</div>
                            		<div class="col-6">
                            			A12, A13
                            		</div>
                            	</div>
                            	<hr>
                            	<div class="d-flex mb-2">
                            		<div class="col-6">
                            			<b>Monto:</b>
                            		</div>
                            		<div class="col-6">
                            			10Bs
                            		</div>
                            	</div>
                            	<div class="d-flex mb-2">
                            		<div class="col-6">
                            			<b>IVA:</b>
                            		</div>
                            		<div class="col-6">
                            			1,2Bs
                            		</div>
                            	</div>
                            	<div class="d-flex mb-2">
                            		<div class="col-6">
                            			<b>Monto Total:</b>
                            		</div>
                            		<div class="col-6">
                            			11,2Bs
                            		</div>
                            	</div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-circle-check me-2"></i>Aceptar</button>
                    </div>
            </div>
        </div>
    </div>

	<?php $_comp->footer(); ?>
	<script src="assets/js/boleteria.js"></script>
	<script>
	 	const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
		const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
	</script>

</body>
</html>
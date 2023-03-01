<html>
<head>
	<?php $_css->heading(); ?>
<title>Cartelera</title>
<link rel="stylesheet" type="text/css" href="assets/css/estiloCartelera.css">
</head>
<body>

	<?php if ($userSession->log()) {
		$_comp->navInicioUser();
	}else{
		$_comp->navInicio();
	}  ?>


	<div class="bg-cartelera p-4 mb-5 title-banner">
		
	</div>


	<div class="mx-3 filter mb-4">
		<h4 class="mb-3 tituloFiltro rounded">Filtrar por:</h4>

			<form action="" method="" class="row align-items-center">
				<div class="col-lg-3 col-md-5 ">
					<div class="form-group my-2">
						<div class="input-group">

							<span class="input-group-text">
								Categoria:
							</span>

							<select class="form-select">
								<option value="">Todos</option>
								<option value="">Danza</option>
								<option value="">Musical</option>
								<option value="">Comedia</option>
								<option value="">Infantil</option>
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
						<button type="submit" class="btn btn-success w-100">Aplicar</button>
					</div>

				</div>

				<div class="col-lg-3 ms-auto">
					<div class="form-group">

						<div class="input-group">
							<input class="form-control" type="search" placeholder="Search" aria-label="Search">
							<span class="btn btn-success d-flex align-items-center">
								<i class="fas fa-search"></i>
							</span>
						</div>
					</div>
				</div>

				


			</form>
	</div>
	
	<div class="mx-5 mb-5">
		<div class="row container_eventos">
			<?php foreach ($data as $evento) { ?> 
			<div class="col-sm-12 col-md-6 col-lg-4 event mb-3">
				<div class="event-box">
				<div class="card_front">
					<?php 

					if (file_exists("assets/img/Eventos/".$evento['nroEvento']."/principal.jpg")) {
						$imgEvento = "assets/img/Eventos/".$evento['nroEvento']."/principal.jpg";
					} else {
						$imgEvento = "assets/img/Eventos/imgNOT.png";
					}
					
					$fechaEvento = strtotime($evento["fechaEvento"]);
					$horaEvento = strtotime($evento["horaInicio"]);

					 ?>

					<img src="<?php echo $imgEvento; ?>" class="w-100 rounded">
				</div>
				<div class="card_back">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title text-center h2 mb-3 mt-2"><?php echo $evento['nombre']; ?></h4>
							<h6 class="card-title text-center h5 mb-5" style="color: #939393;"><?php echo utf8_encode($evento['nombreCategoria']); ?></h6>
							<div class="row text-center mt-5">
								<div class="col-6">
									<p class="card-text"><b>Fecha:</b><br> <?php echo date("d/m/Y",$fechaEvento); ?></p>
								</div>
								<div class="col-6">
									<p class="card-text"><b>Hora:</b><br> <?php echo date("h:i A",$horaEvento); ?></p>
								</div>
							</div>
							
							
							<a href="?url=cartelera&type=informacion&id=<?php echo $evento['nroEvento']; ?>" class="btn btn-success my-5 w-50 mx-auto">Ver mas ...</a>
						</div>
					</div>
				</div>
				</div>
			</div>
			<?php  } ?>
		</div>
	</div>



<script src="assets/js/main.js"></script>
<?php $_comp->footer(); ?>
</body>
</html>
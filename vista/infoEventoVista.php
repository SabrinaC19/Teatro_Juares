<html>
	<head>
	<?php $_css->heading(); ?>
	<title>Detalles Evento</title>
	<link rel="stylesheet" type="text/css" href="assets/css/infoEvento.css">
	</head>

	<body>

		<?php if ($userSession->log()) {
			$_comp->navInicioUser();
		}else{
			$_comp->navInicio();
		} ?>

		<div class="container-fluid p-3">
			<div class="row mt-4 mb-4">
				<div class="col-sm-4">
					<img src="assets/img/Eventos/1/principal.jpg" alt="" class="img-fluid rounded mb-3">
					<a href="?url=boleteria&type=seleccionar&event=<?php echo $data[0]['nroEvento']; ?>" class="btn btn-success mx-auto mb-3 fs-5 d-flex justify-content-center align-items-center"> Comprar Boleto <i class="fa-solid fa-ticket mx-1"></i></a>
				</div>
				<div class="col-sm-8">
					<h2 class="text-center datos text-light rounded p-1" style="color: #710014"><i class="fas fa-film"></i> <?php echo $data[0]["nombre"]; ?></h2>

					<div class="row p-2 my-auto">
						
						<div class="col-lg-6 col-md-12 col-sm-12 col-12">
							<!-- <p class="descripcion my-2 p-3"><?php echo $data[0]["descripcion"]; ?></p> -->
							Lorem ipsum dolor sit amet, consectetur adipisicing, elit. Repudiandae minus, fuga maiores iure quos, illo quibusdam possimus incidunt velit cumque ipsa, saepe impedit quia beatae aliquam consequuntur hic, aliquid distinctio? Lorem ipsum dolor sit amet, consectetur adipisicing, elit. Repudiandae minus, fuga maiores iure quos, illo quibusdam possimus incidunt velit cumque ipsa, saepe impedit quia beatae aliquam consequuntur hic, aliquid distinctio?

							<div class="row d-flex mx-auto text-center text-light justify-content-center align-items-center my-3">
								
								<div class="col-lg-4 col-md-5 col-sm-3 col-12 mx-3 mb-2 datos rounded-pill p-2">
									<i class="fas fa-calendar"></i> <?php echo ($data[0]["fechaEvento"]); ?>
								</div>

								<div class="col-lg-4 col-md-5 col-sm-3 col-12 mx-3 mb-2 datos rounded-pill p-2">
									<i class="fas fa-clock"></i> <?php echo ($data[0]["horaInicio"]); ?>
								</div>

							</div>

						</div>

						<div class="col-lg-6 col-md-12 col-sm-12 col-12">


							<div class="d-flex mx-auto rounded text-light p-2 datos justify-content-center align-items-center mb-2">
								<i class="fas fa-user me-1"></i> Director: <?php echo ($data[0]["director"]); ?>
							</div>

							<div class="d-flex mx-auto rounded text-light p-2 datos justify-content-center align-items-center mb-2">
								<i class="fas fa-palette me-1"></i> Categoría: <?php echo ($data[0]["nombreCategoria"]); ?>
							</div>

							<div class="my-3 bg-light rounded">
			            		<h6 class="text-center text-light bg-dark p-1"><i class="fas fa-table-cells-large"></i> Precio por áreas:</h6>
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

					</div>
				</div>
			</div>
		</div>
		
		<?php $_comp->footer(); ?>
		<script type="text/javascript" src="assets/js/owlCarousel.js"></script>
	</body>
</html>
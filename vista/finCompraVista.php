<!DOCTYPE html>
<html>
<head>
	<?php $_css->heading(); ?>
    <title>Compra Exitosa</title>
    <link rel="stylesheet" type="text/css" href="assets\css\ventas.css">
    <link rel="stylesheet" type="text/css" href="assets/css/usuario.css">
</head>
<body class="bg-login">

	<div id="contenedor_carga">
		<div id="carga"></div>
	</div>

	<div class="container w-50 my-auto mx-auto p-5 rounded justify-content-center align-items-center bg-light">

		<h2 class="text-center text-success"><i class="fas fa-circle-check"></i></h2>
		<h5 class="h2 text-center text-success mb-2">Su compra esta siendo verificada</h5>
		<p class="text-center text-secondary h5 my-3">
			Sea paciente, su compra esta siendo verificada por nuestro equipo. Se le notificara mediante su correo electronico el resultado de la misma. ¡Gracias por usar nuestro servicio!
		</p>

		<div class="d-flex justify-content-center align-items-center ">
			<a href="?url=inicio" class="btn btn-danger botonIniciar mt-3">
				Volver a inicio <i class="fas fa-home"></i>
			</a>
		</div>
		
	</div>

	<?php 
	 	$_comp->linksFooter();
	?>

</body>
</html>
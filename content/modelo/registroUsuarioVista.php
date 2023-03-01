<!DOCTYPE html>
<html>
<?php echo $varHeader;?>
<link rel="stylesheet" type="text/css" href="assets/css/usuario.css">
<link rel="stylesheet" type="text/css" href="assets/icons/font.css">
</head>
	<body class="bg-register">

		<!-- PANTALLA CARGA -->

		<div id="contenedor_carga">
			<div id="carga"></div>
		</div>

		<div class="row container-xxl col-12 col-sm-10 col-md-8 col-lg-6 mx-auto">

			<div class="card py-3 px-4 form-control" id="formulario-registro">

				<div class="container-md">
					<img src="assets/img/Logo teatro.png" height="70" width="90" id="logo-login" class="mx-auto d-flex mb-2">
				</div>

				<h2 class="card-title text-center mb-2 pb-3" id="titulo-registro">Registro de Usuario</h2>

				<form class="row g-3" method="POST" id="formRegisUser">
					<div class="col-md-6 col-sm-6  mb-2 px-4 form-floating">
						<input type="text" class="form-control" id="nombre" name="nombre" id="floatingInput" placeholder="Nombre">
						
						<div class="error" id="errorNombre"></div>
						<label for="floatingInput" class="ms-3">Nombre <i class="fas fa-user"></i></label>
					</div>
					<div class="col-md-6 col-sm-6  mb-2 px-4 form-floating">
						<input type="text" class="form-control" id="apellido" name="apellido" id="floatingInput" placeholder="Apellido">
						<div class="error" id="errorApellido"></div>
						<label for="floatingInput" class="ms-3">Apellido <i class="fas fa-user"></i></label>
					</div> 
					<div class="col-md-6 col-sm-6  mb-2 px-4 form-floating">
						<input type="text" class="form-control" id="cedula" name="cedula" id="floatingInput" placeholder="Cédula">
						<div class="error" id="errorCedula"></div>
						<label for="floatingInput" class="ms-3">Cédula <i class="fas fa-id-card"></i></label>
					</div>
					<div class="col-md-6 col-sm-6  mb-2 px-4 form-floating">
						<input type="email" class="form-control" id="email" name="email" id="floatingInput" placeholder="Correo">
						<div class="error" id="errorEmail"></div>
						<label for="floatingInput" class="ms-3">Correo <i class="fas fa-envelope"></i></label>
					</div>
					<div class="col-md-6 col-sm-6  mb-2 px-4 form-floating">
						<input type="password" class="form-control" id="contra" name="password" id="floatingInput" placeholder="Contraseña">
						<div class="error" id="errorContra"></div>
						<label for="floatingInput" class="ms-3">Contraseña <i class="fas fa-key"></i></label>
					</div>
					<div class="col-md-6 col-sm-6  mb-2 px-4 form-floating">
						<input type="password" class="form-control" id="contra2" id="floatingInput" placeholder="Repita Contraseña">
						<div class="error" id="errorContra2"></div>
						<label for="floatingInput" class="ms-3">Repita Contraseña <i class="fas fa-key"></i></label>
					</div>
					
					<div id="error"></div>
					<?php 
						if (isset($RegistroUsuario)) {
						 	echo $RegistroUsuario;
						 } else {
						 	echo " ";
						 } ?>
						<div class="text-center"> 
							<button type="submit" class="btn btn-success col-lg-3 col-md-3 col-sm-3 col-3 mx-auto" id="envio">Enviar</button> 
							<button type="reset" class="btn btn-danger col-lg-3 col-md-3 col-sm-3 col-3 mx-auto" id="limpiar">Limpiar</button>
						</div>
					<div class="text-center mb-2"  id="cuenta"> 
						¿Tienes Una cuenta? <a href="?url=usuario&type=login">¡Ingresa!</a>
						<div class="text-center my-2">
							<span><a href="?url=inicio">Volver <i class="fas fa-home"></i></a></span>
						</div> 
					</div>			
		</div>
		<?php echo $varLinksFooter;?>
		<script type="text/javascript" src="assets/js/registro.js"></script>
	</body>
</html>
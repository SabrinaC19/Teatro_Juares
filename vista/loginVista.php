<!DOCTYPE html>
<html>
	<head>
		<?php $_css->heading(); ?>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="assets/css/usuario.css">
		<link rel="stylesheet" type="text/css" href="assets/icons/font.css">
	</head>

	<body class="bg-login">

	 	<div id="contenedor_carga">
			<div id="carga"></div>
		</div>

		<div class="container logo-login col-10 col-sm-8 col-md-6 col-lg-4 mx-auto row entrar" id="formulario-login">
			<div class="card px-4 py-3">

				<div class="container-md">
					<img src="assets/img/Logo teatro.png" height="70" width="90" id="logo-login" class="mx-auto d-flex">
				</div>

				<h2 class="card-title text-center mb-3 pb-3" id="titulo-login">¡Inicia tu Sesión!</h2>

				<form class="row g-3" method="POST" id="formLogin">
					<div class="col-sm-12 my-2 px-4 form-floating">
						<input type="text" id="cedula" name="cedula" id="floatingInput" class="form-control cedulaLogin" placeholder="Cédula">
						<div class="error" id="errorCedula"></div>
						<label for="floatingInput" class="ms-3">Cedula <i class="fas fa-id-card"></i></label>
					</div>
					<div class="col-sm-12 my-2 px-4 form-floating">
						<input type="password" name="password" class="form-control claveLogin" id="clave" id="floatingInput"  placeholder="Contraseña">
						<div class="error" id="errorContra"></div>
						<label for="floatingInput" class="ms-3">Contraseña <i class="fas fa-key"></i></label>
					</div>
					<div style="color: red; text-align: center;" id="error">
					</div>
					<?php 
						if (isset($error)) {
						 	echo $error;
						 } else {
						 	echo " ";
						 } ?>
					<div class="d-grid col-sm-12 mb-2">
						<button type="submit" class="btn btn-danger botonIniciar" id="send">Iniciar Sesión</button>
					</div>

					<div class="my-3">
						<div class="text-center mb-2">
							<span>¿No tienes cuenta? <a href="?url=usuario&type=registro">Regístrate</a></span>
						</div>
						<div class="text-center mb-2">
							<span><a href="?url=usuario&type=recoverPass">Recuperar Contraseña</a></span>
						</div>
						<div class="text-center mb-2">
							<span><a href="?url=inicio">Volver <i class="fas fa-home"></i></a></span>
						</div>
					</div>
				</form>
			</div>
		</div>

		<?php $_comp->linksFooter();?>
		<script type="text/javascript" src="assets/js/login.js"></script>
	</body>
</html>
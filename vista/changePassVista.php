<!DOCTYPE html>
<html lang="en">
<head>
    <?php $_css->heading(); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cambiar Contraseña</title>
	 <link rel="stylesheet" type="text/css" href="assets/css/usuario.css">
</head>
<body class="bg-recover">
	
	<div class="container-md col-sm-8 col-md-6 col-lg-5 my-3" 
            id="recoverPaso3">
                <div class="main-section mx-auto mb-5">
                <div class="modal-content">
                    <div class="col-12 user-img userImg3 text-center">
                        <img src="assets/img/llave.png">
                    </div>
                    <form class="col-12 mt-2" id="cambioPass" method="POST">
                        <h4 class="recover-title mb-3 text-center">Ingresa una nueva Contraseña</h4>
                        <div class="mb-2 px-4 form-floating" id="user-group">
                            <input type="password" class="form-control" id="passRecover" name="newPass" id="floatingInput" placeholder="New Contraseña">
                            <label for="floatingInput" class="ms-3">Nueva Contraseña <i class="fas fa-key"></i></label>
                        </div>
                        <h4 class="recover-title my-3 text-center">Repite la Contraseña</h4>
                        <div class="mb-2 px-4 form-floating" id="contrasena-group">
                            <input type="password" class="form-control" id="confirmar" name="confirmPass" id="floatingInput" placeholder="Confirme New Contraseña">
                            <label for="floatingInput" class="ms-3">Confirma Contraseña <i class="fas fa-key"></i></label>
                        </div>
                        <input type="hidden" name="user" value="<?php echo $_GET['token'] ?>"> 
                        <div style="color: red; text-align: center;" id="error3" class="mb-3"></div>

                        <button type="button" class="btn btn-danger mx-auto d-flex justify-content-center align-items-center recoverBoton" id="envioRecover"><i class="fa-solid fa-key icono3"></i>Finalizar</button>

                        <a href="?url=usuario&type=login" type="submit" class="btn btn-danger mx-auto d-flex justify-content-center align-items-center recoverBoton" id="envioRecover">
                        Iniciar Sesion </a>

                        <div class="text-center mb-2">
                        <span><a href="?url=inicio" id="volver">Volver <i class="fas fa-home"></i></a></span>
                        </div>
                    </form>
                </div>
                </div>
            </div>


<?php $_comp->linksFooter(); ?>
<script src="assets/js/recover.js"></script>
</body>
</html>
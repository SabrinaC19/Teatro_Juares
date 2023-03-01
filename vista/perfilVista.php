<html>
<head>
    <?php $_css->heading(); ?>
	<title>Perfil</title>
	<link rel="stylesheet" type="text/css" href="assets\css\menuUsuario.css">
</head>
<body>

<!-- PANTALLA CARGA -->

	<div id="contenedor_carga">
		<div id="carga"></div>
	</div>

	<?php $_comp->navInicioUser(); ?>


	<!------- CONTENIDO ------->
    <div class="foto-usuario bg-usuario p-2">
                <div class="row p-3">
                    <div class="perfil col-lg-3 col-md-3 col-sm-3 col-12">
                        <img src="assets/img/usuario.jpg" class=" profile-user-img img-fluid img-usuario"><br><br>
                        
                        <h4 class=" profile-username text-center nombre-usuario p-2"><?php echo $infoUser[0]["nombre"]." ".$infoUser[0]["apellido"];?></h4><i class="h6 fas fa-circle green"></i>
                    </div>
                </div>
            </div>  
    <div class="container-fluid p-5 mb-5">
        <div class="container">
                <div class="row mb-4">
                    
                    <div class="col-lg-4 col-md-4 col-sm-8 col-8 mx-auto">
                        <div class="card mb-5 p-4">
                            <button class="option btn btn-danger p-2 my-2" id="irMisDatos">Datos Personales <i class="fas fa-user px-1"></i></button>
                            <button class="option btn btn-danger p-2 my-2" id="irMisCompras">Mis compras <i class="fas fa-ticket px-1"></i></button>
                            <button type="button" value="<?php echo $infoUser[0]["cedula"];?>" class="btn eliminarUser btn-danger p-2 my-2" id="eliminar">Eliminar cuenta <i class="fa-solid fa-user-minus i-borrar"></i></button>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                        <div class="card" id="misDatos">
                            <div class="card-header mb-2 fs-5">
                                <i class="fa-solid fa-user me-2"></i>
                                DATOS PERSONALES
                                <button type="button" value="<?php echo $infoUser[0]["cedula"]; ?>" class="btn btn-primary h-25 float-end" data-bs-toggle="modal" data-bs-target="#modalPersonal" id="editarUsuario"><i class="fa-solid fa-pencil"></i></button>
                            </div>
                            <div class="card-body">
                            <div class="container-fluid table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="tabla">Identificación:</th>
                                        <td class="tabla"><?php echo $infoUser[0]["cedula"]; ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="tabla">Nombre:</th>
                                        <td class="tabla"><?php echo $infoUser[0]["nombre"]; ?></td>
                                    </tr>
                                    <tr>
                                        <th class="tabla">Apellido:</th>
                                        <td class="tabla"><?php echo $infoUser[0]["apellido"];?></td>
                                    </tr>
                                    <tr>
                                        <th class="tabla">Correo:</th>
                                        <td class="tabla"><?php echo $infoUser[0]["correo"];?></td>
                                    </tr>
                                    <tr>
                                        <th class="tabla">Telefono:</th>
                                        <td class="tabla"><?php echo $infoUser[0]["telefono"];?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>

                        <div class="card" id="misCompras">
                            <div class="card-header mb-4 fs-5">
                                <i class="fa-solid fa-film me-2"></i>
                                MIS COMPRAS
                            </div>
                            <div class="container-fluid table-responsive">
                            <table class="table table-striped mb-4">
                                <thead>
                                    <tr>
                                        <th class="tabla">Evento:</th>
                                        <th class="tabla">Asientos:</th>
                                        <th class="tabla">Fecha:</th>
                                        <th class="tabla">Precio:</th>
                                        <th class="tabla">Estado:</th>
                                        <th class="tabla">Detalles:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="tabla">Mario Bros </td>
                                        <td class="tabla">A13</td>
                                        <td class="tabla">30 de Febrero</td>
                                        <td class="tabla">10bs.S</td>
                                        <td class="tabla">Verificado</td>
                                        <td class="tabla d-flex justify-content-center align-items-center mx-auto"><button type="button" class="btn btn-primary"><i class="fa-solid fa-eye"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DEL PERSONAL -->

    <div class="modal fade" id="modalPersonal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="adminForm">
                    <div class="modal-header bg-primary text-light">
                        <h5 class="modal-title"><i class="fa-solid fa-user-pen me-2"></i>Actualizar Datos</h5>
                        <button type="button" class="btn btn-primary ms-2 mt-1 b-modificar btnModificar" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="userNombre" placeholder="Nombre"  require="" name="userNombre" value= "<?php echo utf8_encode($infoUser[0]["nombre"]);?>" >
                            <label for="userNombre">Nombre</label>
                            <div id="errorNombre"></div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="userApellido" placeholder="Apellido"  require="" name="userApellido" value="<?php echo utf8_encode($infoUser[0]["apellido"]); ?>" >
                            <label for="userApellido">Apellido</label>
                            <div id="errorApellido"></div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="userCorreo" placeholder="correo"  require="" name="userCorreo" value= "<?php echo $infoUser[0]["correo"]; ?>">
                            <label for="userCorreo">Correo</label>
                            <div id="errorEmail"></div>
                        </div>

                         <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="userTelefono" placeholder="Telefono"  require="" name="userCorreo" value= "<?php echo $infoUser[0]["telefono"]; ?>">
                            <label for="userTelefono">Telefono</label>
                            <div id="errorTelefono"></div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="userClave" placeholder="Contraseña"  require="" name="userClave" >
                            <label for="userClave">Contraseña</label>
                            <div id="errorContra"></div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="userClaveR" placeholder="Repetir Contraseña"  require="" name="userClaveR">
                            <label for="adminCorreo">Repetir Contraseña</label>
                            <div id="errorContra2"></div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark me-2"></i>Cancelar</button>
                        <button type="button" id="enviarEditar" class="btn btn-success"><i class="fa-solid fa-check me-2"></i>Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<?php $_comp->footer(); ?>

	<script src="assets/js/seccionUsuario.js"></script>
</body>
</html>
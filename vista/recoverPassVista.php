<html>
    <head>
        <?php $_css->heading(); ?>
        <title>Recuperar Contraseña</title>
        <link rel="stylesheet" type="text/css" href="assets/css/usuario.css">
    </head>

    <body class="bg-recover">

        <!-- PANTALLA CARGA -->
        <div id="contenedor_carga">
             <div id="carga"></div>
        </div>

            <div class="container-md col-sm-11 col-md-10 col-lg-6 my-5" 
            id="recoverPaso1">
                <div class=" main-section mx-auto">
                    <div class="modal-content">
                        <div class="col-12 user-img text-center">
                            <img src="assets/img/email.png">
                        </div>
                        <form class="col-12 mt-2" method="POST">
                            <h4 class="recover-title text-center mb-3">Por favor ingrese su correo electrónico</h4>
                            <div class="mb-4 px-4 form-floating" id="user-group">
                                <input type="email" class="form-control" id="emailRecover" name="correoRecover" id="floatingInput" placeholder="Correo">
                                <label for="floatingInput" class="ms-3">Correo <i class="fas fa-envelope"></i></label>
                            </div>
                            <div style="color: red; text-align: center;" id="error" class="mb-3"> <?php if (isset($info)) {
                               echo $info;
                            }?></div>
                            <div class="d-flex justify-content-center align-items-center">
                            <a href="?url=inicio" type="submit" class="btn btn-danger mb-3 mx-3">
                                <i class="fa-solid fa-house"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-danger mb-3 mx-3" id="irPaso2">Siguiente
                                <i class="fa-solid fa-arrow-right-long px-1"></i>
                            </button>
                            
                            </div>
                        </form>       
                    </div>
                </div>
            </div>

            

            

        <?php $_comp->linksFooter(); ?>        

        <script src="assets/js/recover.js"></script>
    </body>
</html>

<!--
-->
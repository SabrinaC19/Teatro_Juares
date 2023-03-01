<?php 

use TeatroJuares\Content\component\headElement as headElement;
use TeatroJuares\Content\component\initComponent as initComponent;
use TeatroJuares\Content\modelo\usuarioModelo as usuarioModelo;
use TeatroJuares\Content\helpers\authSession as authSession;

	$userSession = new authSession();
	$userModel = new usuarioModelo();

	$_css = new headElement();
	$_comp = new initComponent();
	

if (isset($_GET["type"])) {
		if ($_GET["type"] == "login") {

			$userSession->_isLog();
			// Modelo

			//instancia
			if(isset($_POST['cedula'])&& 
				isset($_POST['password'])){
				$respuesta = $userModel->getLoginSistema($_POST['cedula'], $_POST['password']);				
			
				if ($respuesta == false){
					$error = "<p class='text-center text-danger'><b>Error en Cedula o Contraseña</b>.</p>";

				}else{
					$userSession->setUserSession($respuesta);
				}
			}
			// Vista
			if (file_exists("vista/loginVista.php")) {
				require_once("vista/loginVista.php");
			}else {
				die ("<script>window.location='?url=inicio'</script>");
			}
		} 
		// End login
		else if ($_GET["type"] == "registro") {
			
		$userSession->_isLog();
		// Modelo
		
		if (isset($_POST["registroUsuario"])) {

			$RegistroUsuario = $userModel->getRegistroUsuario($_POST["nombre"], $_POST["apellido"], $_POST["cedula"], $_POST["correo"], $_POST["password"]);
		}

		if (isset($_POST["activarUser"])) {
			$activarUser = $userModel->getHabilitarUser($_POST["cedula"],$_POST["password"]);
		}
			// Vista
			if (file_exists("vista/registroUsuarioVista.php")) {
				require_once("vista/registroUsuarioVista.php");
			}else {
				die ("<script>window.location='?url=inicio'</script>");
			}	
		}
		// End registro
		else if ($_GET["type"] == "recoverPass") {

			$userSession->_isLog();

			if (isset($_POST["correoRecover"])) {
				
				$info = $userModel->recoverPass($_POST["correoRecover"]);
			}
			
			if (file_exists("vista/recoverPassVista.php")) {
				require_once("vista/recoverPassVista.php");
			}else {
				die ("<script>window.location='?url=inicio'</script>");
			}
		}

		else if ($_GET["type"] == "changePass" && isset($_GET["token"])){ 

			$userSession->_isLog();

			if ($userModel->existsUser($_GET["token"])) {
				if (isset($_POST["newPass"]) && isset($_POST["user"])) {
				$userModel->changePass($_POST["user"],$_POST["newPass"]);
				}
			} else{

				die("<script>window.location='?url=inicio'</script>");
			}
			
			if (file_exists("vista/changePassVista.php")) {
				require_once("vista/changePassVista.php");
			}else {
				die ("<script>window.location='?url=inicio'</script>");
			}
		}

		// End recoverPass
		else if ($_GET["type"] == "perfil") {
			

			// Modelo
			$userSession->notLog();

			if(isset($_SESSION["idUser"])){

				$infoUser = $userModel->getUsuarito($_SESSION["idUser"]);
			}

			if(isset($_POST['modificarUsuario'])){
				$modificar = $userModel->modificarUser($_POST["idUser"],$_POST["nombreUser"], $_POST["apellidoUser"], $_POST["correoUser"], $_POST["telefonoUser"], $_POST["password"]);
			}

			if(isset($_POST['deleteUser'])){

				$eliminar = $userModel->eliminarUser($_POST['cedula']);
			}
			
			// Vista
			if (file_exists("vista/perfilVista.php")) {
				require_once("vista/perfilVista.php");
			}else {
				die ("<script>window.location='?url=inicio'</script>");
			}	
		}
		// End Perfil
		elseif($_GET["type"]==="logout"){
			
			$userSession->logout();
		}
		else{
			die ("<script>window.location='?url=inicio'</script>");
		}
		
		

	} else{
		require_once("vista/loginVista.php");
	}

 ?>
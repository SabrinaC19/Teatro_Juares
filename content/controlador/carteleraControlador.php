<?php 

	use TeatroJuares\Content\component\headElement as headElement;
	use TeatroJuares\Content\component\initComponent as initComponent;
	use TeatroJuares\Content\modelo\eventoModelo as eventoModelo;
	use TeatroJuares\Content\helpers\authSession as authSession;

	$userSession = new authSession();

	$eventModel = new eventoModelo();

	$_css = new headElement();
	$_comp = new initComponent();

	if (isset($_GET["type"])) {
		
		if ($_GET["type"] === "mostrar") {
			
			// Modelo

			// Instaciacion

			$data = $eventModel->mostrarCartelera();
			
			// Vista
			if (file_exists("vista/carteleraVista.php")) {
				require_once("vista/carteleraVista.php");
			}else {
				die ("<script>window.location='?url=inicio'</script>");
			}
		}

		else if($_GET["type"] === "informacion" && isset($_GET["id"])){

			$data = $eventModel->getEvento($_GET["id"]);
			


			// Vista
			if (file_exists("vista/infoEventoVista.php")) {
				require_once("vista/infoEventoVista.php");
			}else {
				die ("<script>window.location='?url=inicio'</script>");
			}
		}

		else{

			die ("<script>window.location='?url=cartelera'</script>");
		}		

	}else{

		die ("<script>window.location='?url=cartelera'</script>");
	}



 ?>
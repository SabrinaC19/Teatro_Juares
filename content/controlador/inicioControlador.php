<?php 

	
	use TeatroJuares\Content\component\headElement as headElement;
	use TeatroJuares\Content\component\initComponent as initComponent;
	use TeatroJuares\Content\helpers\authSession as authSession;

	$userSession = new authSession();

	$_css = new headElement();
	$_comp = new initComponent();
	$_css->heading();

	if (isset($_GET["type"])) {
		// Trastelon
		if ($_GET["type"] === "trastelon") {
			if (file_exists("vista/trastelonVista.php")) {
					require_once("vista/trastelonVista.php");
				}
				else{
					die ("<script>window.location='?url=inicio'</script>");
				}			
		}
		// Ayuda
		elseif ($_GET["type"] === "ayuda"){

			if (file_exists("vista/ayudaVista.php")) {
				require_once("vista/ayudaVista.php");
			}
			else{
				die ("<script>window.location='?url=inicio'</script>");
				}		
		}
		else{
			die ("<script>window.location='?url=inicio'</script>");
		}
	}
	else{

		require_once("vista/inicioVista.php");
	}

?>
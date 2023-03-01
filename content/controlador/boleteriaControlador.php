<?php 

	use TeatroJuares\Content\component\headElement as headElement;
	use TeatroJuares\Content\component\initComponent as initComponent;
	use TeatroJuares\Content\modelo\eventoModelo as eventoModelo;
	use TeatroJuares\Content\modelo\ventasModelo as ventasModelo;
	use TeatroJuares\Content\helpers\authSession as authSession;

	$userSession = new authSession();

	$eventModel = new eventoModelo();
	$ventasObject = new ventasModelo();

	$_css = new headElement();
	$_comp = new initComponent();

	if (!$userSession->log()) {
		die("<script>window.location='?url=usuario&type=login'</script>");
	}

	if(isset($_GET["type"])){

		

		if($_GET["type"] === "seleccionar" && isset($_GET["event"])){

			$data = $eventModel->getEvento($_GET["event"]);


		// Llamar vista
			if(file_exists("vista/boleteriaVista.php")){
				require_once("vista/boleteriaVista.php");
			}
			else {
				die("<script>window.location='?url=inicio'</script>");
			}
		}
		else if($_GET["type"] === "pagar" && isset($_GET["event"])) {
			// Consultar bancos
			$bancos = $ventasObject->seleccionarBancos();

			if (isset($_POST["buscarCliente"])) {
				$cliente = $ventasObject->getCliente($_POST["cedCliente"]);
			}

			if (isset($_POST["registrarCliente"])) {
				if (isset($_POST["telefonoCliente"])) {
					$tlfCliente = $_POST["telefonoCliente"];
				}
				else {
					$tlfCliente = NULL;
				}

				$register = $ventasObject->cargarCliente($_POST["cedCliente"], $_POST["nombreCliente"], $_POST["apellidoCliente"], $_POST["correoCliente"], $tlfCliente);
			}

			// Registrar Compra

			if (isset($_POST["registroCompra"])) {
				if ($_POST["metodoPago"] == 1 || $_POST["metodoPago"] == 2) {
					$respuesta = $ventasObject->getCompra($_POST["metodoPago"], $_POST["fechaCompra"], $_POST["horaCompra"], $_POST["banco"], $_POST["referencia"], null, $_POST["monto"], $_GET["event"], $_POST["cedCliente"]);
				}
				elseif ($_POST["metodoPago"] == 3) {
					$respuesta = $ventasObject->getCompra($_POST["metodoPago"], $_POST["fechaCompra"], $_POST["horaCompra"], $_POST["banco"], null, $_POST["numTarj"], $_POST["monto"], $_GET["event"], $_POST["cedCliente"]);
				}
				elseif ($_POST["metodoPago"] == 4) {
					$respuesta = $ventasObject->getCompra($_POST["metodoPago"], $_POST["fechaCompra"], $_POST["horaCompra"], null, null, null, $_POST["monto"], $_GET["event"], $_POST["cedCliente"]);
				}else{
					$respuesta = array('status' => 0, 'descripcion' =>  "Metodo de pago invalido");
					echo json_encode($respuesta);
					die();
				}
			}

			

			

			// Llamar vista
			if (file_exists("vista/pagarVista.php")) {
				require_once("vista/pagarVista.php");
			}else {
				die("<script>window.location='?url=inicio'</script>");
			}
		}
		else if ($_GET["type"] === "finCompra") {
			if (file_exists("vista/finCompraVista.php")) {
				require_once("vista/finCompraVista.php");
			}else {
				die("<script>window.location='?url=inicio'</script>");
			}
		}

	}else{
		die("<script>window.location='?url=inicio'</script>");
	}












 ?>
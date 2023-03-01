<?php 

	use TeatroJuares\Content\component\headElement as headElement;
	use TeatroJuares\Content\component\initComponent as initComponent;
	use TeatroJuares\Content\modelo\dashboardModelo as dashboardModelo;
	use TeatroJuares\Content\modelo\clientesModelo as clientesModelo;
	use TeatroJuares\Content\modelo\personalModelo as personalModelo;
	use TeatroJuares\Content\modelo\eventoModelo as eventoModelo;
	use TeatroJuares\Content\modelo\ventasModelo as ventasModelo;
	use TeatroJuares\Content\helpers\authSession as authSession;

	$userSession = new authSession();

	$eventModel = new eventoModelo();
	$statsObject = new dashboardModelo();
	$clienteModel = new clientesModelo();
	$adminModel = new personalModelo();
	$ventasObject = new ventasModelo();

	$_css = new headElement();
	$_comp = new initComponent();

	$userSession->notLog();

	if (!$userSession->_isAdmin()) {
		die("<script>window.location='?url=inicio'</script>");
	}

	if (isset($_GET["type"])) {
		if ($_GET["type"] == "clientes") {

			if (!$userSession->requestAccess($_SESSION["rol"], CLIENTES)) {
				die("<script>window.location='?url=dashboard'</script>");
			}
			
			$info = $clienteModel->mostrarClientes();

			// Vista
			if (file_exists("vista/clientesVista.php")) {
			require_once("vista/clientesVista.php");
			}else {
			die ("<script>window.location='?url=inicio'</script>");
			}
		}	
	// End Clientes
		else if ($_GET["type"] == "personal") {

			if (!$userSession->requestAccess($_SESSION["rol"], PERSONAL)) {
				die("<script>window.location='?url=dashboard'</script>");
			}
			
			if (isset($_POST["seleccionarRol"])) {
				$data = $adminModel->seleccionarRol();
			}

			if (isset($_POST["consultarPersonal"])) {
				$consulta = $adminModel->mostrarPersonal();
			}

			if (isset($_POST["consultarRoles"])) {
				$roles = $adminModel->mostrarRoles();
			}


			
			//Obtener datos de un personal
			if (isset($_POST["usuarioP"])) {
				$response = $adminModel->obtenerPersonal($_POST["cedPersonal"]);
			}

			// Insertar usuarios administradores
			if (isset($_POST["envioPersonal"])) {
				if ($_POST["option"] == 1) {
					$register = $adminModel->getRegisterPersonal($_POST["adminCedula"], $_POST["adminNombre"], $_POST["adminApellido"], $_POST["adminCorreo"],$_POST["adminClave"], $_POST["adminRol"]);
				}
				if ($_POST["option"] == 2) {
					$update = $adminModel->updatePersonal($_POST["adminCedula"], $_POST["adminNombre"], $_POST["adminApellido"], $_POST["adminCorreo"],$_POST["adminClave"], $_POST["adminRol"], $_POST["adminStatus"]);
				}
			}
			//Inhabilitar personal
			if (isset($_POST["deleteUser"])) {
				$delete = $adminModel->deleteAdmin($_POST["id_user"]);
			}

			//Obtener datos de un rol
			if (isset($_POST["obtenerRol"])) {
				$response = $adminModel->obtenerRol($_POST["nroRol"]);
			}
			//Insertar y editar roles
			if (isset($_POST["envioRol"])) {
				//Insertar
				if ($_POST["option"] == 1) {
					$register = $adminModel->getRoles($_POST["nombreRol"], $_POST["descripcionRol"]);
				}
				//Editar
				if ($_POST["option"] == 2) {
					$update = $adminModel->updateRol($_POST["nroRol"], $_POST["nombreRol"], $_POST["descripcionRol"], $_POST["estadoRol"]);
				}
			}

			// Inhabilitar rol
			if (isset($_POST["deleteRol"])) {
				$delete = $adminModel->deleteRol($_POST["rol_id"]);
			}
			// Gestionar permisos
			$modulos = $adminModel->mostrarModulos();

			// Obtener permisos
			if (isset($_POST["obtenerPermisos"])) {
				$permisos = $adminModel->obtenerPermisos($_POST["rol_id"]);
			}

			if (isset($_REQUEST["envioPermisos"])) {
				$i = 1;
				foreach ($modulos as $row) {
					if (isset($_POST["permisos".$i])) {
						$estado = 1;
					}else{
						$estado = 0;
					}

					$gestionPermisos = $adminModel->gestionPermisos($_POST["rolPermiso"], $row["idModulo"], $estado);
				$i++;
				}
			}

			// Generar reporte

			if (isset($_REQUEST["generarReporte"])) {
				if (isset($_POST["fechaRegistro"])) {
					$reporte = $adminModel->reporteConsulta($_POST["fechaRegistro"], $_POST["fechaInicial"], $_POST["fechaFinal"], $_POST["tipoPersonal"], $_POST["estadoPersonal"]);
				}else{
					$reporte = $adminModel->reporteConsulta(null, null, null, $_POST["tipoPersonal"], $_POST["estadoPersonal"]);
				}
		
	}

			// Vista
			if (file_exists("vista/personalVista.php")) {
				require_once("vista/personalVista.php");
			}else {
				die ("<script>window.location='?url=inicio'</script>");
			}
		}
	// End administradores
		else if ($_GET["type"] == "eventos") {

			// CRUD Evento

			if (isset($_POST["nroEvento"])){

				$nroEventos = $eventModel->nroEventos();
			}

			if (isset($_POST["optEvento"])){
				
				switch($_POST["optEvento"]){

					case "c":

						if(!isset($_POST["patioCheck"])){

							$_POST["patioCheck"] = null;
						}

						if(!isset($_POST["palcosCheck"])){

							$_POST["palcosCheck"] = null;
						}

						if(!isset($_POST["galeriaCheck"])){

							$_POST["galeriaCheck"] = null;
						}

						$crearEvento= $eventModel->getCEvento($_POST["eventoNom"], $_POST["eventoDirec"], $_POST["eventoFech"],
						$_POST["eventoHorIni"], $_POST["eventoHorFin"], $_POST["eventoCateg"], $_POST["eventoDes"], $_POST["eventoFot"],
						$_POST["patioCheck"], $_POST["palcosCheck"], $_POST["galeriaCheck"]);

						break;

					case "u":

						if(!isset($_POST["patioCheck"])){

							$_POST["patioCheck"] = null;
						}

						if(!isset($_POST["palcosCheck"])){

							$_POST["palcosCheck"] = null;
						}

						if(!isset($_POST["galeriaCheck"])){

							$_POST["galeriaCheck"] = null;
						}

						$actualizarEvento= $eventModel->getUEvento($_POST["eventoNro"], $_POST["eventoNom"], $_POST["eventoDirec"], $_POST["eventoFech"],
						$_POST["eventoHorIni"], $_POST["eventoHorFin"], $_POST["eventoCateg"], $_POST["eventoDes"], $_POST["eventoFot"],
						$_POST["patioCheck"], $_POST["palcosCheck"], $_POST["galeriaCheck"]);

						break;

					case "d":

						$borrarEvento = $eventModel->getDeventos($_POST["eventoNro"]);

						break;
				}
			}

			if (isset($_POST["consultarEventos"])){

				$consultaEventos = $eventModel->consultarEvento();
			}

			if(isset($_POST["busEventoModificar"])){
				
				$busEvento = $eventModel->actualizarEventoBuscar($_POST["busEventoModificar"]);
			}

			//Asientos Evento

			if(isset($_POST["busEventoAsientos"])){
				
				$busAsientos = $eventModel->consultarAsientos($_POST["busEventoAsientos"]);
			}

			if(isset($_POST["actualizarAsientos"])){
				
				if(isset($_POST["asientosPat"])){

					$asientosPat = $_POST["asientosPat"];
				}
				else{

					$asientosPat = 0;
				}
				if(isset($_POST["asientosPal"])){
				
					$asientosPal = $_POST["asientosPal"];
				}
				else{

					$asientosPal = 0;
				}
				if(isset($_POST["asientosGal"])){

					$asientosGal = $_POST["asientosGal"];
				}
				else{

					$asientosGal = 0;
				}
				if(isset($_POST["asientosActuPat"])){

					$asientosActuPat = $_POST["asientosActuPat"];
				}
				else{

					$asientosActuPat = 0;
				}
				if(isset($_POST["asientosActuPal"])){

					$asientosActuPal = $_POST["asientosActuPal"];
				}
				else{

					$asientosActuPal = 0;
				}
				if(isset($_POST["asientosActuGal"])){

					$asientosActuGal = $_POST["asientosActuGal"];
				}
				else{

					$asientosActuGal = 0;
				}

				$actualizarAsientos = $eventModel->getUAsientos($_POST["asientoNro"], $_POST["precioPat"],
									$_POST["precioPal"], $_POST["precioGal"], $asientosPat, $asientosPal, 
									$asientosGal, $asientosActuPat,$asientosActuPal,$asientosActuGal);	
			}				

			//Reporte Evento

			if(isset($_POST["generarReporteEventos"])){
				
				$crearReporte = $eventModel->reporteConsulta($_POST["fechaIniReporte"], $_POST["fechaFinReporte"], $_POST["categReporte"], $_POST["estadoEventoReporte"]);
			}
			
			//CRUD Categoria

			if (isset($_POST["nroCateg"])){

				$nroCategorias = $eventModel->nroCategorias();
			}

			if (isset($_POST["optCateg"])){
				
				switch($_POST["optCateg"]){

					case "c":
						
						$crearCategoria = $eventModel->getCCategoria($_POST["categNom"]);

						break;

					case "u":

						$actualizarCategoria = $eventModel->getUCategoria($_POST["categNro"], $_POST["categNom"]);

						break;

					case "d":

						$borrarCategoria = $eventModel->getDCategoria($_POST["categNro"]);

						break;
				}
			}

			if (isset($_POST["consultarCategoria"])){

				$consultaCategorias = $eventModel->consultarCategorias();
			}

			if(isset($_POST["busCategModificar"])){

				$busCategoria = $eventModel->actualizarCategBuscar($_POST["busCategModificar"]);
			}

			// Vista
			if (file_exists("vista/eventosVista.php")) {
				
				require_once("vista/eventosVista.php");
			}else {

				die ("<script>window.location='?url=inicio'</script>");
			}
		}
	// End funciones
		else if ($_GET["type"] == "ventas") {

			if (!$userSession->requestAccess($_SESSION["rol"], VENTAS)) {
				die("<script>window.location='?url=dashboard'</script>");
			}

			// Modelo
			if (isset($_POST["consultarVentas"])) {
				$infoVentas = $ventasObject->consultaVentas();
			}
			
			if (isset($_POST["consultarBancos"])) {
				$bancos = $ventasObject->consultarBancos();
			}
			
			if (isset($_POST["updateBanco"])) {
				$response = $ventasObject->obtenerBanco($_POST["codBanco"]);
			}

			if (isset($_POST["deleteBanco"])) {
				$resultado = $ventasObject->borrarBanco($_POST["codBanco"]);
			}

			if (isset($_POST["envioBanco"])) {
				if ($_POST["option"] == 1) {
					$respuesta = $ventasObject->getBanco($_POST["idBanco"], $_POST["nombreBanco"]);
				}
				elseif ($_POST["option"] == 2) {
					$data = $ventasObject->modificarBancos($_POST["idBanco"], $_POST["nombreBanco"], $_POST["estadoBanco"]);
				}
			}

			if (isset($_REQUEST["envioReporte"])) {
				
				$generarReporte = $ventasObject->generarReporteVentas($_POST["fechaInicio"], $_POST["fechaFinal"], $_POST["estadoVenta"], $_POST["tipoCompra"]);
			}
 
			// Vista
			if (file_exists("vista/ventasVista.php")) {
				require_once("vista/ventasVista.php");
			}else {
				die ("<script>window.location='?url=inicio'</script>");
			}
		}
	// End ventas
		else if ($_GET["type"] == "comprobante" && isset($_GET["nro"])) {

			if (!$userSession->requestAccess($_SESSION["rol"], VENTAS)) {
				die("<script>window.location='?url=dashboard'</script>");
			}
			// Modelo
			$info = $ventasObject->comprobanteVenta($_GET["nro"]);

			if (isset($_POST["envioCompra"])) {
				$accept = $ventasObject->opcionCompra($_POST["nroBoleto"], $_POST["option"]);
			}

			// Vista
			if (file_exists("vista/comprobanteVista.php")) {
				require_once("vista/comprobanteVista.php");
			}else {
				die ("<script>window.location='?url=inicio'</script>");
			}
		}
	// End comprobante
		else if ($_GET["type"] == "detallesUser") {

			if (!$userSession->requestAccess($_SESSION["rol"], CLIENTES)) {
				die("<script>window.location='?url=dashboard'</script>");
			}
			// Modelo

			// Vista
			if (file_exists("vista/detallesUserVista.php")) {
				require_once("vista/detallesUserVista.php");
			}else {
				die ("<script>window.location='?url=inicio'</script>");
			}
		}

		else if ($_GET["type"] == "ayuda") {
			// Modelo

			// Vista
			if (file_exists("vista/ayudaAdministradoresVista.php")) {
				require_once("vista/ayudaAdministradoresVista.php");
			}else {
				die ("<script>window.location='?url=inicio'</script>");
			}
		}
		// End ayuda

		else{

			die ("<script>window.location='?url=dashboard'</script>");
		}	
	// End inicio
	}else{
		
		$readPersonal = $statsObject->nroPersonal();
		$readClientes = $statsObject->nroClientes();
		$readEventos = $statsObject->nroEventos();
		$readCompras = $statsObject->nroCompras();
		$mostrarCita = $statsObject->getMostrarCita();

		if (file_exists("vista/dashboardVista.php")) {
		require_once("vista/dashboardVista.php");
		}else {
		die ("<script>window.location='?url=inicio'</script>");
		}
	}



 ?>
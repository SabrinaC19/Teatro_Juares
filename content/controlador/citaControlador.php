<?php 

use TeatroJuares\Content\component\headElement as headElement;
use TeatroJuares\Content\component\initComponent as initComponent;
use TeatroJuares\Content\modelo\citaModelo as citaModelo;
use TeatroJuares\Content\helpers\authSession as authSession;

	$userSession = new authSession();

	$dateModel = new citaModelo(); 

	$_css = new headElement();
	$_comp = new initComponent();


	$userSession->notLog();

	if (isset($_GET["type"])) {

	if ($_GET["type"] == "solicitar") {

		//instancia

		if (isset($_POST['checkEmpresa'])) {

			if (isset($_POST["nombreEvento"])&&
				isset($_POST["fecha"])&&
				isset($_POST["hora"])&&
				isset($_POST["servicio"])&&
				isset($_POST["espacio"])&&
				isset($_POST["descripcion"])&&
				isset($_POST["razonSocial"])&&
				isset($_POST["correo"])&&
				isset($_POST["codigoC"])&&
				isset($_POST["telefonoC"])&&
				isset($_FILES['archivoPDF']['name'])) {

				if (isset($_POST["otroServicio"])) {
					$otroServicio = $_POST["otroServicio"];
				}else {
					$otroServicio = "";
					}

				if ($_FILES['archivoPDF']['type'] == 'application/pdf') {

					if($_FILES['archivoPDF']['size'] < 3150000) {

						$ruta = "assets/cartasPDF/".$_FILES['archivoPDF']['name'];
						move_uploaded_file($_FILES['archivoPDF']['tmp_name'], $ruta);

						$registro = $dateModel->getRegistrarCita($_POST["nombreEvento"], $_POST["fecha"], $_POST["hora"], $_POST["servicio"], $otroServicio, $_POST["espacio"], $_POST["descripcion"], $_POST["checkEmpresa"] ,$_POST["razonSocial"], $_POST["correo"], $_POST["codigoC"], $_POST["telefonoC"], $ruta, $_SESSION["idUser"]);
					}else {

						echo("<script>
	            			
	            			alert('funciona Validacion');
				           		
				       	</script>");
					}
					
				} else {

					echo("<script>
            			
            			alert('funciona Validacion');
			           		
			       	</script>");
				}
			}

		} else {

			$tipoCita = NULL;

			if (isset($_POST["nombreEvento"])&&
				isset($_POST["fecha"])&&
				isset($_POST["hora"])&&
				isset($_POST["servicio"])&&
				isset($_POST["espacio"])&&
				isset($_POST["descripcion"])&&
				isset($_FILES['archivoPDF']['name'])) {

				if (isset($_POST["otroServicio"])) {
					$otroServicio = $_POST["otroServicio"];
				}else {
					$otroServicio = "";
					}


				if ($_FILES['archivoPDF']['type'] == 'application/pdf') {

					if($_FILES['archivoPDF']['size'] < 3150000) {

						$ruta = "assets/cartasPDF/".$_FILES['archivoPDF']['name'];
						move_uploaded_file($_FILES['archivoPDF']['tmp_name'], $ruta);

						if ($_POST["razonSocial"] == NULL && $_POST["correo"] == NULL && $_POST["codigoC"] == "0" && $_POST["telefonoC"] == NULL) {
					
							$registro = $dateModel->getRegistrarCita($_POST["nombreEvento"], $_POST["fecha"], $_POST["hora"], $_POST["servicio"], $otroServicio, $_POST["espacio"], $_POST["descripcion"],$tipoCita , $_POST["razonSocial"], $_POST["correo"], $_POST["codigoC"], $_POST["telefonoC"], $ruta, $_SESSION["idUser"]);					
						}
					} else {

						echo("<script>
            			
            			alert('funciona Validacion peso');
			           		
			       		</script>");
			       		
					}

				} else {

					echo("<script>
            			
            			alert('funciona Validacion');
			           		
			       	</script>");
			       		
				}
			}
		}
	

		// vista
		if (file_exists('vista/citaVista.php')) {

			require_once('vista/citaVista.php');

		} else {

			die("<script>window.location='?url=inicio'</script>");

		}
	}
	
	
	else if ($_GET["type"] == "consultar") {

		if (!$userSession->requestAccess($_SESSION["rol"], CITAS)) {
				die("<script>window.location='?url=dashboard'</script>");
			}
		
		//instancia

		if (isset($_POST["consultarCita"])) {
			
			$mostrar = $dateModel->consultarCita();
		}
		

		if (isset($_POST["obtenerCita"])) {
			
			$mostrarData = $dateModel->obtenerCita($_POST["nroCita"]);
		}

		if (isset($_POST["updateCita"])) {

			if ($_POST["fechaNueva"] == "") {
				$_POST["fechaNueva"] = null;
			}

			if ($_POST["horaNueva"] == "") {
				$_POST["horaNueva"] = null;
			}

			$modificarData = $dateModel->getModificarCita($_POST["nroCita"], $_POST["fechaNueva"], $_POST["horaNueva"]);
		}


		if (isset($_POST["fechaIncio"]) && isset($_POST["fechaFinal"]) && isset($_POST["rEstadoCita"]) && isset($_POST["rTipoCita"])) {

				$data = $dateModel->reporteCita($_POST["fechaIncio"], $_POST["fechaFinal"], $_POST["rEstadoCita"], $_POST["rTipoCita"]);

		}


		if (isset($_POST["eliminarCita"])) {
			
			$dateModel->getAnularCita($_POST["nroCita"]);
		}

		// vista
		if (file_exists('vista/consultarCitaVista.php')) {

			require_once('vista/consultarCitaVista.php');

		} else {

			die("<script>window.location='?url=inicio'</script>");
		}
	}

	else if ($_GET["type"] == "detalles" && isset($_GET["id"])) {
		
		if (!$userSession->requestAccess($_SESSION["rol"], CITAS)) {
				die("<script>window.location='?url=dashboard'</script>");
			}

		//modelo
		$detalleCita = $dateModel->getCita($_GET["id"]);


		if (isset($_POST["idCita"])&&isset($_REQUEST["aceptar"])) {
			
			$dateModel->verificarCita($_POST["idCita"], $_REQUEST["aceptar"]);
		}

		elseif (isset($_POST["idCita"])&&isset($_REQUEST["rechazar"])) {
			
			$dateModel->verificarCita($_POST["idCita"], $_REQUEST["rechazar"]);

		}
		// vista
		if (file_exists('vista/detallesCitaVista.php')) {

			require_once('vista/detallesCitaVista.php');

		} else {

			die("<script>window.location='?url=inicio'</script>");
		}
	}

	else {

		die("<script>window.location='?url=cita&type=solicitar'</script>");
	}

}

else {
	die("<script>window.location='?url=inicio'</script>");
}

 ?>
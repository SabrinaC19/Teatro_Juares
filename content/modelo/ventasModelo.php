<?php 

	namespace TeatroJuares\Content\modelo;

	use TeatroJuares\Content\config\connect\connectDB as connectDB;
	use TeatroJuares\Content\modelo\reporteModelo as reporteModelo;

	class ventasModelo extends connectDB{

		//Clientes
		private $cedCliente;
		private $nombreCliente;
		private $apellidoCliente;
		private $correoCliente;
		private $telefonoCliente;

		//Compras
		private $metodoPago;
		private $fechaCompra;
		private $horaCompra;
		private $banco;
		private $refBancaria;
		private $numeroTarj;
		private $montoTotal;
		private $evento;

		//Bancos
		private $idBanco;
		private $nombreBanco;
		private $estadoBanco;


		public function __construct(){
		
		parent::__construct();

		$this->conex = parent::activeDB();
		}

		// CLIENTES TAQUILLA

		public function getCliente($cedCliente){

			//Status 0 = Error en consulta
			//Status 1 = Existe cliente
			//Status 2 = No existe cliente

		if (preg_match_all("/^[0-9]{8,9}$/", $cedCliente)) {
			$this->cedCliente = $cedCliente;
		} else {
			$respuesta = array('status' => 0, 'descripcion' =>  "Cedula ingresada invalida");
			echo json_encode($respuesta);
			die();
		}

			$existCliente = $this->conex->prepare("SELECT * FROM `tblclientes` WHERE `cedulaCliente` = ?");
			$existCliente->bindValue(1, $this->cedCliente);
			$existCliente->execute();

			$datosCliente = $existCliente->fetchAll(\PDO::FETCH_OBJ);

			if (isset($datosCliente[0])) {
				
				echo json_encode($datosCliente);
				die();
			}else {
				$respuesta = array('status' => 2, 'descripcion' =>  "No se encontro un cliente con esta cedula");
				echo json_encode($respuesta);
				die();
			}

		}

		public function cargarCliente($cedCliente, $nombreCliente, $apellidoCliente, $correoCliente, $telefonoCliente){

			if (preg_match_all("/^[0-9]{8,9}$/", $cedCliente)) {
				$this->cedCliente = $cedCliente;
			}
			else {
				$respuesta = array('status' => 0, 'descripcion' =>  "Cedula ingresada invalida");
				echo json_encode($respuesta);
				die();
			}

			if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1]{3,20}$/", $nombreCliente)) {
				$this->nombreCliente = $nombreCliente;
			}
			else {
				$respuesta = array('status' => 0, 'descripcion' =>  "Nombre ingresado invalido");
				echo json_encode($respuesta);
				die();
			}

			if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1]{3,20}$/", $apellidoCliente)) {
				$this->apellidoCliente = $apellidoCliente;
			}
			else {
				$respuesta = array('status' => 0, 'descripcion' =>  "Apellido ingresado invalido");
				echo json_encode($respuesta);
				die();
			}

			if (preg_match_all("/^[a-zA-Z0-9_\.\-]+@[a-z0-9\-]+\.[a-zA-Z0-9\-]{2,4}$/", $correoCliente)) {
				$this->correoCliente = $correoCliente;
			}
			else {
				$respuesta = array('status' => 0, 'descripcion' =>  "Correo ingresado invalido");
				echo json_encode($respuesta);
				die();
			}

			if ($telefonoCliente != NULL) {
				if (preg_match_all("/^[0-9]{10,11}$/", $telefonoCliente)) {
				$this->telefonoCliente = $telefonoCliente;
				}
				else {
					$respuesta = array('status' => 0, 'descripcion' =>  "Teléfono ingresado invalido");
					echo json_encode($respuesta);
					die();
				}
			}else{
				$this->telefonoCliente = NULL;
			}
			

			$existCliente = $this->conex->prepare("SELECT `cedulaCliente` FROM `tblclientes` WHERE `cedulaCliente` = ?");
			$existCliente->bindValue(1, $this->cedCliente);
			$existCliente->execute();

			$datosCliente = $existCliente->fetchAll();

			if (isset($datosCliente[0])) {
				$respuesta = array('status' => 0, 'descripcion' =>  "El usuario ya se encuentra registrado");
				echo json_encode($respuesta);
				die();
			}else{

				return $this->registrarCliente();
			}

		}

		private function registrarCliente(){
			try {
				$registrarCliente = $this->conex->prepare("INSERT INTO `tblclientes` (`cedulaCliente`, `nombreCliente`, `apellidoCliente`, `correo`, `nroTelefono`) VALUES (?,?,?,?,?)");
				$registrarCliente->bindValue(1, $this->cedCliente);
				$registrarCliente->bindValue(2, $this->nombreCliente);
				$registrarCliente->bindValue(3, $this->apellidoCliente);
				$registrarCliente->bindValue(4, $this->correoCliente);
				$registrarCliente->bindValue(5, $this->telefonoCliente);
				$registrarCliente->execute();

				$respuesta = array('status' => 1, 'descripcion' =>  "Usuario registrado correctamente");
				echo json_encode($respuesta);
				die();

			} catch (Exception $e) {
				
			}
		}

		// CRUD VENTAS

		// Validacion

		public function getCompra($metodoPago, $fechaCompra, $horaCompra, $banco, $refBancaria, $numeroTarj, $monto, $evento, $cedCliente){

			if (preg_match_all("/^[0-9]{8,9}$/", $cedCliente)) {
			$this->cedCliente = $cedCliente;
			} else {
				$respuesta = array('status' => 0, 'descripcion' =>  "Cedula ingresada invalida");
				echo json_encode($respuesta);
				die();
			}
			
			$existCliente = $this->conex->prepare("SELECT `cedulaCliente` FROM `tblclientes` WHERE `cedulaCliente` = ?");
			$existCliente->bindValue(1, $this->cedCliente);
			$existCliente->execute();

			$datosCliente = $existCliente->fetchAll();

			if (!isset($datosCliente[0])) {
				$respuesta = array('status' => 0, 'descripcion' =>  "Este cliente no se encuentra registrado");
				echo json_encode($respuesta);
				die();
			}

			// Metodo Pago
			switch ($metodoPago) {
				case 1:
					$this->metodoPago = "Transferencia";
					break;
				case 2:
					$this->metodoPago = "Pago Movil";
					break;
				case 3:
					$this->metodoPago = "Punto de Venta";
					break;
				case 4:
					$this->metodoPago = "Efectivo";
					break;
				
				default:
					$respuesta = array('status' => 0, 'descripcion' =>  "Metodo de pago invalido");
					echo json_encode($respuesta);
					die();
					break;
			}

			// Fecha
			date_default_timezone_set("America/Caracas");
			$hoy = date("Y-m-d");

			if (strtotime($fechaCompra) > strtotime($hoy)) {
				$respuesta = array('status' => 0, 'descripcion' =>  "Fecha invalida");
				echo json_encode($respuesta);
				die();
			}
			if (strtotime($hoy) >= strtotime($fechaCompra) && strtotime($fechaCompra) < strtotime("{$hoy}- 1week") ) {
				$respuesta = array('status' => 0, 'descripcion' =>  "La fecha no puede ser menor a una semana");
				echo json_encode($respuesta);
				die();
			}

			$this->fechaCompra = $fechaCompra;

			// Hora

			$horaActual = date("H:i");

			if ($fechaCompra == $hoy) {
				if (strtotime($horaCompra) <= strtotime($horaActual)) {
					$this->horaCompra = $horaCompra;
				}
				else {
					$respuesta = array('status' => 0, 'descripcion' =>  "Hora invalida");
					echo json_encode($respuesta);
					die();
				}
			}
			else {
				$this->horaCompra = $horaCompra;
			}

			// Banco

			if (isset($banco)) {
				if (preg_match_all("/^[0-9]{4}$/", $banco)) {
					$this->banco = $banco;
				}
				else {
					$respuesta = array('status' => 0, 'descripcion' =>  "Banco invalido");
				echo json_encode($respuesta);
				die();
				}

				$validate = $this->conex->prepare("SELECT `idBanco` FROM `tblbanco` WHERE `idBanco` = ?");
				$validate->bindValue(1, $this->banco);
				$validate->execute();
				$exist = $validate->fetchAll();

				if (!isset($exist[0])) {
					$respuesta = array('status' => 0, 'descripcion' =>  "El banco que ingreso es invalido");
					echo json_encode($respuesta);
					die();
				}
			}else{
				$this->banco = NULL;
			}
			

			// Referencia Bancaria

			if (isset($refBancaria)) {
				
				if (preg_match_all("/^[0-9]{4,12}$/", $refBancaria)) {
					$this->refBancaria = $refBancaria;
				}
				else {
					$respuesta = array('status' => 0, 'descripcion' =>  "Formato de referencia invalido");
					echo json_encode($respuesta);
					die();
				}

				$valid = $this->conex->prepare("SELECT * FROM `tblcompras` WHERE `referenciaBancaria` = ?");
				$valid->bindValue(1, $this->refBancaria);
				$valid->execute();
				$confirm = $valid->fetchAll();

				if (isset($confirm[0])) {
					$respuesta = array('status' => 0, 'descripcion' =>  "Esta referencia ya esta registrada a una compra");
					echo json_encode($respuesta);
					die();
				}

			}else{
				$this->refBancaria = NULL;
			}
			

			

			// Numero Tarjeta
			if (isset($numeroTarj)) {
				if (preg_match_all("/^[0-9\ ]{4,19}$/", $numeroTarj)) {
				$this->numeroTarj = $numeroTarj;
				}
				else {
					$respuesta = array('status' => 0, 'descripcion' =>  "Número de tarjeta invalido");
				echo json_encode($respuesta);
				die();
				}
			}
			

			// Monto
				

			if (preg_match_all("/^\d{0,6}(\.\d{1})?\d{0,2}$/", $monto) && $monto != "") {
				$this->montoTotal = $monto;
			}
			else {
				$respuesta = array('status' => 0, 'descripcion' =>  "Monto invalido");
				echo json_encode($respuesta);
				die();
			}

			if (preg_match_all("/^[0-9]{1,11}$/", $evento)) {
				$this->evento = $evento;
			}
			else {
				$respuesta = array('status' => 0, 'descripcion' =>  "Evento invalido");
				echo json_encode($respuesta);
				die();
			}

			$validarEvento = $this->conex->prepare("SELECT `nroEvento` FROM `tbleventos` WHERE `nroEvento` = ?");
			$validarEvento->bindValue(1, $this->evento);
			$validarEvento->execute();
			$confirmarEvento = $validarEvento->fetchAll();

			if (!isset($confirmarEvento[0])) {
				$respuesta = array('status' => 0, 'descripcion' =>  "El evento al cual desea realizar la compra no se encuentra disponible");
				echo json_encode($respuesta);
				die();
			}

			
			return $this->registrarCompra();	
		}

		private function registrarCompra(){
			try {
				
				$regis = $this->conex->prepare("INSERT INTO `tblcompras`(`metodoPago`, `fechaCompra`, `horaCompra`, `banco`, `tipoCompra`, `referenciaBancaria`, `numeroTarjeta`, `montoTotal`, `cedCliente`) VALUES (?,?,?,?,default, ?,?,?,?)");
				$regis->bindValue(1, $this->metodoPago);
				$regis->bindValue(2, $this->fechaCompra);
				$regis->bindValue(3, $this->horaCompra);
				$regis->bindValue(4, $this->banco);
				$regis->bindValue(5, $this->refBancaria);
				$regis->bindValue(6, $this->numeroTarj);
				$regis->bindValue(7, $this->montoTotal);
				$regis->bindValue(8, $this->cedCliente);
				$regis->execute();

				$this->generarBoleto();

				$respuesta = array('status' => 1, 'descripcion' =>  "Su compra se ha registrado exitosamente");
				echo json_encode($respuesta);
				die();

			} catch (Exception $error) {
				return $error;
			}
		}

		private function generarBoleto(){
			$maxCompra = $this->conex->prepare("SELECT MAX(`numeroCompra`) FROM `tblcompras`");
			$maxCompra->execute();
			$ultimaCompra = $maxCompra->fetchAll();

			$nroCompra = $ultimaCompra[0]['MAX(`numeroCompra`)'];

			try {
				$insertBoleto = $this->conex->prepare("INSERT INTO `tblboletos` (`status`, `numCompra`,`precioBoleto`, `numEvento`) VALUES (default,?,?,?)");
				$insertBoleto->bindValue(1, $nroCompra);
				$insertBoleto->bindValue(2, $this->montoTotal);
				$insertBoleto->bindValue(3, $this->evento);
				$insertBoleto->execute();

			} catch (Exception $e) {
				
			}


		}

		public function consultaVentas(){
			$verVentas = $this->conex->prepare("SELECT b.numeroBoleto, b.status, e.nombre, c.fechaCompra, c.horaCompra, c.montoTotal, cl.nombreCliente FROM `tblboletos` AS b INNER JOIN `tbleventos` AS e INNER JOIN `tblcompras` AS c INNER JOIN `tblclientes` as cl on e.nroEvento = b.numEvento AND c.numeroCompra = b.numCompra AND cl.cedulaCliente = c.cedCliente WHERE b.status != 2");
			$verVentas->execute();

			$infoVentas = $verVentas->fetchAll(\PDO::FETCH_OBJ);

			echo json_encode($infoVentas);
			die();
		}

		public function comprobanteVenta($idBoleto){

			if (preg_match_all("/^[0-9]{1,11}$/", $idBoleto)) {
				$this->nroBoleto = $idBoleto;
			}else{
				header('Location:'._ROUTE_.'?url=dashboard&type=ventas');
			}

			$existBoleto = $this->conex->prepare("SELECT `numeroBoleto` FROM `tblboletos` WHERE `numeroBoleto` = ? AND `status` != 2");
			$existBoleto->bindValue(1, $this->nroBoleto);
			$existBoleto->execute();

			$validarBoleto = $existBoleto->fetchAll();

			if (!isset($validarBoleto[0])) {
				header('Location:'._ROUTE_.'?url=dashboard&type=ventas');
			}

			$verComprobante = $this->conex->prepare("SELECT cl.*, e.nombre, c.montoTotal, c.metodoPago, c.referenciaBancaria, b.status, b.numeroBoleto FROM `tblboletos` AS b INNER JOIN `tbleventos` AS e INNER JOIN `tblcompras` AS c INNER JOIN `tblclientes` AS cl ON b.numCompra = c.numeroCompra AND c.cedCliente = cl.cedulaCliente AND b.numEvento = e.nroEvento WHERE b.numeroBoleto = ?");
			$verComprobante->bindValue(1, $this->nroBoleto);
			$verComprobante->execute();

			$mostrarComprobante = $verComprobante->fetchAll();

			return $mostrarComprobante;

		}

		public function opcionCompra($nroBoleto, $option){

			if ($option != 1 && $option != 2) {
				$respuesta = array('status' => 0, "descripcion" => "Opcion invalida");

				echo json_encode($respuesta);
				die();
			}

			
			if (preg_match_all("/^[0-9]{1,11}$/", $nroBoleto)) {
				$this->nroBoleto = $nroBoleto;
			}else{
				$respuesta = array('status' => 0, "descripcion" => "El número de boleto es invalido");

				echo json_encode($respuesta);
				die();
			}

			$existBoleto = $this->conex->prepare("SELECT `numeroBoleto` FROM `tblboletos` WHERE `numeroBoleto` = ? AND `status` = 0");
			$existBoleto->bindValue(1, $this->nroBoleto);
			$existBoleto->execute();

			$validarBoleto = $existBoleto->fetchAll();

			if (!isset($validarBoleto[0])) {
				$respuesta = array('status' => 0, "descripcion" => "No se ha podido aceptar la compra");

				echo json_encode($respuesta);
				die();
			}
			if ($option == 1) {
				return $this->aceptarCompra();
			}
			else {
				return $this->rechazarCompra();
			}
			
		}

		private function aceptarCompra(){
			try {
				$actualizar = $this->conex->prepare("UPDATE `tblboletos` SET `status` = 1 WHERE `numeroBoleto` = ?");
				$actualizar->bindValue(1, $this->nroBoleto);
				$actualizar->execute();

				$respuesta = array('status' => 1, "descripcion" => "La compra ha sido aceptada exitosamente");

				echo json_encode($respuesta);
				die();

			} catch (Exception $e) {
				
			}
		}

		private function rechazarCompra(){
			try {
				$actualizar = $this->conex->prepare("UPDATE `tblboletos` SET `status` = 2 WHERE `numeroBoleto` = ?");
				$actualizar->bindValue(1, $this->nroBoleto);
				$actualizar->execute();

				$respuesta = array('status' => 1, "descripcion" => "La compra ha sido rechazada exitosamente");

				echo json_encode($respuesta);
				die();

			} catch (Exception $e) {
				
			}
		}


		// ----------------------------------------------------------------------------- 

		// CRUD BANCOS

		public function getBanco($idBanco, $nombreBanco){

			if (preg_match_all("/^[0-9]{4}$/",$idBanco)) {
				
				$this->idBanco = $idBanco;
			}
			else {

				$respuesta = array('status' => 0, "descripcion" => "Codigo de banco invalido");
				echo json_encode($respuesta);
				die();
			}

			if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1\ \-]{3,20}$/",$nombreBanco)) {
				
				$this->nombreBanco = $nombreBanco;
			}
			else {

				$respuesta = array('status' => 0, "descripcion" => "Nombre de Banco invalido");
				echo json_encode($respuesta);
				die();
			}

			return $this->validarBanco();
		}

		private function validarBanco(){

			$validar = $this->conex->prepare("SELECT * FROM `tblbanco` WHERE `estadoBanco` = 1 and idBanco = ?");
			$validar->bindValue(1,$this->idBanco);
			$validar->execute();
			$bancos = $validar->fetchAll();

			if (isset($bancos[0])) {
				$respuesta = array('status' => 0, "descripcion" => "Este banco ya se encuentra registrado");
				echo json_encode($respuesta);
				die();
			}
			else {
				return $this->registrarBanco();
			}
		}

		private function registrarBanco(){
			try {

			$insert = $this->conex->prepare("INSERT INTO `tblbanco`(`idBanco`, `nombreBanco`, `estadoBanco`) VALUES (?,?,default)");
			$insert->bindValue(1,$this->idBanco);
			$insert->bindValue(2,utf8_decode($this->nombreBanco));
			$insert->execute();

			$respuesta = array('status' => 1, "descripcion" => "Banco agregado exitosamente");
			echo json_encode($respuesta);
			die();
				
			} catch (Exception $error) {
				
			}
		}

		public function consultarBancos(){
			$select = $this->conex->prepare("SELECT * FROM `tblbanco`");
			$select->execute();
			$bancosMostrar = $select->fetchAll(\PDO::FETCH_OBJ);

			// $json = array();

			// if (isset($bancosMostrar[0])) {
			// 	foreach ($bancosMostrar as $row) {
			// 		$nombreBanco = utf8_encode($row['nombreBanco']);
			// 		$json[] = array('idBanco' => $row['idBanco'], 'nombreBanco' => $nombreBanco,'status' => $row['estadoBanco']);

			// 	}
			// 	echo json_encode($json);
			// 	die();
			// }

			echo json_encode($bancosMostrar);
			die();
		}

		public function seleccionarBancos(){
			$select = $this->conex->prepare("SELECT * FROM `tblbanco` WHERE `estadoBanco` = 1");
			$select->execute();
			$data = $select->fetchAll();

			return $data;
		}

		public function obtenerBanco($idBanco){
			$this->idBanco = $idBanco;
			$select = $this->conex->prepare("SELECT * FROM `tblbanco` WHERE `idBanco` = ?");
			$select->bindValue(1,$this->idBanco);
			$select->execute();
			$data = $select->fetchAll();

			$json = array();

				foreach ($data as $row) {
					$nombreBanco = utf8_encode($row['nombreBanco']);
					$json[] = array('idBanco' => $row['idBanco'], 'nombreBanco' => $nombreBanco,'estadoBanco' => $row['estadoBanco']);
				}

			echo json_encode($json);
			die();
		}

		public function modificarBancos($idBanco, $nombreBanco, $estadoBanco){
			if (preg_match_all("/^[0-9]{4}$/",$idBanco)) {
				
				$this->idBanco = $idBanco;
			}
			else {

				$respuesta = array('status' => 0, "descripcion" => "Codigo de banco invalido");
				echo json_encode($respuesta);
				die();
			}

			if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1\ \-]{3,20}$/",$nombreBanco)) {
				
				$this->nombreBanco = $nombreBanco;
			}
			else {

				$respuesta = array('status' => 0, "descripcion" => "Nombre de Banco invalido");
				echo json_encode($respuesta);
				die();
			}

			if ($estadoBanco == 1 || $estadoBanco == 0 ) {
				
				$this->estadoBanco = $estadoBanco;
			}
			else {

				$respuesta = array('status' => 0, "descripcion" => "Estado de banco invalido");
				echo json_encode($respuesta);
				die();
			}

			$exist = $this->conex->prepare("SELECT `idBanco` FROM `tblbanco` WHERE `idBanco` = ?");
			$exist->bindValue(1, $this->idBanco);
			$exist->execute();

			$banco = $exist->fetchAll();

			if (isset($banco[0])) {
			
				return $this->updateBanco();
			}
			else {

				$respuesta = array('status' => 0, "descripcion" => "El banco que intenta modificar no existe");
				echo json_encode($respuesta);
				die();
			}

		}

		private function updateBanco(){
			try {
				$update = $this->conex->prepare("UPDATE `tblbanco` SET `nombreBanco` = ?, `estadoBanco` = ? WHERE `idBanco` = ?");
				$update->bindValue(1,utf8_decode($this->nombreBanco));
				$update->bindValue(2,$this->estadoBanco);
				$update->bindValue(3,$this->idBanco);
				$update->execute();
				
				$respuesta = array('status' => 1, "descripcion" => "Banco modificado exitosamente");
				echo json_encode($respuesta);
				die();
			} catch (Exception $error) {
				
			}
		}

		public function borrarBanco($idBanco){
			
			if (preg_match_all("/^[0-9]{1,11}$/", $idBanco)) {
				$this->idBanco = $idBanco;
			}else{
				$respuesta = array('status' => 0, "descripcion" => "El banco que intenta eliminar no existe");
				echo json_encode($respuesta);
				die();
			}

			

			$exist = $this->conex->prepare("SELECT `idBanco` FROM `tblbanco` WHERE `idBanco` = ? AND `estadoBanco` = 1");
			$exist->bindValue(1, $this->idBanco);
			$exist->execute();

			$banco = $exist->fetchAll();

			if (isset($banco[0])) {
			
				return $this->deleteBanco();
			}
			else {

				$respuesta = array('status' => 0, "descripcion" => "No se ha podido eliminar el banco");
				echo json_encode($respuesta);
				die();
			}
		}

		private function deleteBanco(){

			try {
				$update = $this->conex->prepare("UPDATE `tblbanco` SET `estadoBanco` = 0 WHERE `idBanco` = ?");
				$update->bindValue(1,$this->idBanco);
				$update->execute();
				
				$respuesta = array('status' => 1, "descripcion" => "Banco eliminado exitosamente");
				echo json_encode($respuesta);
				die();
			} catch (Exception $e) {
				
			}
		}


		public function generarReporteVentas($fechaInicio, $fechaFinal, $estado, $tipoCompra){

		date_default_timezone_set('America/caracas');
		$hoy = date('Y-m-d');

		if (strtotime($hoy) < strtotime($fechaInicio)) {
			
			return ("<script>
            
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })
 
          Toast.fire({
              icon: 'error',
              title: 'Fecha inicio invalida'
          })
        </script>");
		}

		if (strtotime($fechaInicio) > strtotime($fechaFinal) || strtotime($fechaFinal) > strtotime($hoy)) {
			
			return ("<script>
            
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
              icon: 'error',
              title: 'Fecha final invalida'
          })
        </script>");
		}

		$this->fechaInicio = $fechaInicio;
		$this->fechaFinal = $fechaFinal;

		if (preg_match_all("/^[0-3]{1}$/", $estado)) {
			if ($estado != 3) {
				$this->estado = $estado;
			}
		}else{
			return ("<script>
            
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
              icon: 'error',
              title: 'Estado invalido'
          })
        </script>");
		}

		if (preg_match_all("/^[0-2]{1}$/", $tipoCompra)) {
			if ($tipoCompra != 0) {
				$this->tipoCompra = $tipoCompra;
			}
		}else{
			return ("<script>
            
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
              icon: 'error',
              title: 'Tipo de compra invalida'
          })
        </script>");
		}
		// Reporte completo
		if (isset($this->fechaInicio) && isset($this->fechaFinal) && isset($this->estado) && isset($this->tipoCompra)) {
			$sql = "SELECT cl.*, e.nombre, c.montoTotal, c.metodoPago, c.tipoCompra, c.referenciaBancaria, b.status, b.numeroBoleto, c.fechaCompra FROM `tblboletos` AS b INNER JOIN `tbleventos` AS e INNER JOIN `tblcompras` AS c INNER JOIN `tblclientes` AS cl ON b.numCompra = c.numeroCompra AND c.cedCliente = cl.cedulaCliente AND b.numEvento = e.nroEvento WHERE c.fechaCompra BETWEEN :fechaInicio AND :fechaFinal AND b.status = :estado AND c.tipoCompra = :tipoCompra";

			$execute = [":fechaInicio" => $this->fechaInicio, ":fechaFinal" => $this->fechaFinal, ":estado" => $this->estado,":tipoCompra" => $this->tipoCompra];

		}
		// Reporte solo fechas
		elseif (isset($this->fechaInicio) && isset($this->fechaFinal) && !isset($this->estado) && !isset($this->tipoCompra)){
			$sql = "SELECT cl.*, e.nombre, c.montoTotal, c.metodoPago, c.tipoCompra, c.referenciaBancaria, b.status, b.numeroBoleto, c.fechaCompra FROM `tblboletos` AS b INNER JOIN `tbleventos` AS e INNER JOIN `tblcompras` AS c INNER JOIN `tblclientes` AS cl ON b.numCompra = c.numeroCompra AND c.cedCliente = cl.cedulaCliente AND b.numEvento = e.nroEvento WHERE c.fechaCompra BETWEEN :fechaInicio AND :fechaFinal";

			$execute = [":fechaInicio" => $this->fechaInicio, ":fechaFinal" => $this->fechaFinal];
		}
		// Reporte fechas y tipo compra 
		elseif (isset($this->fechaInicio) && isset($this->fechaFinal) && !isset($this->estado) && isset($this->tipoCompra)){
			$sql = "SELECT cl.*, e.nombre, c.montoTotal, c.metodoPago, c.tipoCompra, c.referenciaBancaria, b.status, b.numeroBoleto, c.fechaCompra FROM `tblboletos` AS b INNER JOIN `tbleventos` AS e INNER JOIN `tblcompras` AS c INNER JOIN `tblclientes` AS cl ON b.numCompra = c.numeroCompra AND c.cedCliente = cl.cedulaCliente AND b.numEvento = e.nroEvento WHERE c.fechaCompra BETWEEN :fechaInicio AND :fechaFinal AND c.tipoCompra = :tipoCompra";

			$execute = [":fechaInicio" => $this->fechaInicio, ":fechaFinal" => $this->fechaFinal,":tipoCompra" => $this->tipoCompra];
		}
		// Reporte fechas y estado
		elseif (isset($this->fechaInicio) && isset($this->fechaFinal) && isset($this->estado) && !isset($this->tipoCompra)){
			$sql = "SELECT cl.*, e.nombre, c.montoTotal, c.metodoPago, c.tipoCompra, c.referenciaBancaria, b.status, b.numeroBoleto, c.fechaCompra FROM `tblboletos` AS b INNER JOIN `tbleventos` AS e INNER JOIN `tblcompras` AS c INNER JOIN `tblclientes` AS cl ON b.numCompra = c.numeroCompra AND c.cedCliente = cl.cedulaCliente AND b.numEvento = e.nroEvento WHERE c.fechaCompra BETWEEN :fechaInicio AND :fechaFinal AND b.status = :estado";

			$execute = [":fechaInicio" => $this->fechaInicio, ":fechaFinal" => $this->fechaFinal, ":estado" => $this->estado];
		}
		else{
			return ("<script>
            
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
              icon: 'error',
              title: 'Tipo de reporte invalido'
          })
        </script>");
		}
		

		$consulta = $this->conex->prepare($sql);

		$consulta->execute($execute);

		$reporte = $consulta->fetchAll();

		if (isset($reporte[0])) {
			
			$pdf = new reporteModelo();
			$pdf->SetTitle("Reporte de Ventas");
			return $pdf->crearReporteVentas($reporte);

		}else{
			return ("<script>
            
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
              icon: 'error',
              title: 'No se han encontrado datos'
          })
        </script>");
		}
		}

	}

	


 ?>
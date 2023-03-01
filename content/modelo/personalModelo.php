<?php 

	namespace TeatroJuares\Content\modelo;

	use TeatroJuares\Content\config\connect\connectDB as connectDB;
	use \PDO;
	use \PDOException;
	use TeatroJuares\Content\modelo\reporteModelo as reporteModelo;


class personalModelo extends connectDB{

	//Variables de personal
	private $cedula;
	private $nombre;
	private $apellido;
	private $email;
	private $password;
	private $rol;
	private $statusUser;

	// Variables de rol
	private $nombreRol;
	private $descripcionRol;

	//Variables de modulos
	private $modulo;
	private $estadoModulo;

	private $conex;

	public function __construct(){
		parent::__construct();

		$this->conex = parent::activeDB();
	}

	//Alerta personalizada
	private function customAlert($mensaje){

      return("<script>
            
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
              title: '$mensaje'
          })
        </script>");
    }


	// CRUD PERSONAL
	public function getRegisterPersonal($cedula, $nombre, $apellido, $email, $password, $rol){

		if (preg_match_all("/^[0-9]{7,8}$/", $cedula)) {
			$this->cedula = $cedula;
		} else {
			$respuesta = array('status' => 0, 'descripcion' =>  "Error en la Cedula del personal");
			echo json_encode($respuesta);
			die();
		}
		
		if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1]{3,20}$/", $nombre)) {
			$this->nombre = $nombre;
		} else {
			$respuesta = array('status' => 0, 'descripcion' =>  "Error en el nombre del personal");
			echo json_encode($respuesta);
			die();
		}

		if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1]{3,20}$/", $apellido)) {
			$this->apellido = $apellido;
		} else {
			$respuesta = array('status' => 0, 'descripcion' =>  "Error en el apellido del personal");
			echo json_encode($respuesta);
			die();
		}
		
		if (preg_match_all("/^[a-zA-Z0-9_\.\-]+@[a-z0-9\-]+\.[a-zA-Z0-9\-]{2,4}$/", $email)) {
			$this->email = $email;
		} else {
			$respuesta = array('status' => 0, 'descripcion' =>  "Error en el correo del personal");
			echo json_encode($respuesta);
			die();
		}

		if (preg_match_all("/^[a-zA-Z0-9_\.\-]{8}$/", $password)) {
			$this->password = $password;
		} else {
			$respuesta = array('status' => 0, 'descripcion' =>  "Error en la contraseña del personal");
			echo json_encode($respuesta);
			die();
		}

		
		if (preg_match_all("/^[0-9]{1,11}$/", $rol)) {
			$this->rol = $rol;
		}else{
			$respuesta = array('status' => 0, 'descripcion' =>  "El rol que seleccionó es invalido");
			echo json_encode($respuesta);
			die();
		}

		$validate = $this->conex->prepare("SELECT `idRol` FROM `tblroles` WHERE `idRol` = ? AND `idRol` != 1 AND `idRol` != 2");
		$validate->bindValue(1, $this->rol);

		$validate->execute();
		$roles = $validate->fetchAll();

		if (!isset($roles[0])) {
			$respuesta = array('status' => 0, 'descripcion' =>  "El rol que seleccionó es invalido");
			echo json_encode($respuesta);
			die();
		}

		
		return $this->validarUsuario();

	}

	private function validarUsuario(){

		$consulta = $this->conex->prepare("SELECT `cedula` FROM `tblusuarios` WHERE `cedula` = ? AND `rol_Id` = 1");
		$consulta->bindValue(1, $this->cedula);
		$consulta->execute();

		$isCliente = $consulta->fetchAll();

		if (isset($isCliente[0])) {
			return $this->ascenderUser();
		}

		$validate = $this->conex->prepare("SELECT `cedula`, `correo`  FROM `tblusuarios` WHERE `cedula` = ? OR `correo` = ? AND `rol_Id` != 1");
		$validate->bindValue(1, $this->cedula);
		$validate->bindValue(2, $this->email);

		$validate->execute();
		$usuarios = $validate->fetchAll();
	
		if (isset($usuarios[0])) {
			$respuesta = array('status' => 0, 'descripcion' =>  "El usuario que ingreso ya esta registrado");
			echo json_encode($respuesta);
			die();
		}else{

			return $this->registerUsuario();
		}
	}

	private function ascenderUser(){

		try {
			$ascenso = $this->conex->prepare("UPDATE `tblusuarios` SET `rol_Id` = ?, `clave` = ? WHERE `cedula` = ?");
			$ascenso->bindValue(1, $this->rol);
			$ascenso->bindValue(2, $this->password);
			$ascenso->bindValue(3, $this->cedula);
			$ascenso->execute();

			$respuesta = array('status' => 1, 'descripcion' =>  "Se ha actualizado el rol del usuario");
			echo json_encode($respuesta);
			die();
			
		} catch (Exception $error) {
			return $error;
		}
	}

	private function registerUsuario(){

		try{
			
			$new = $this->conex->prepare("INSERT INTO `tblusuarios`(`cedula`, `nombre`, `apellido`, `correo`, `clave`, `fecha_reg`, `rol_Id`, `status`) VALUES (?,?,?,?,?,NOW(),?,default)");
			$new->bindValue(1, $this->cedula);
			$new->bindValue(2, utf8_decode($this->nombre));
			$new->bindValue(3, utf8_decode($this->apellido));
			$new->bindValue(4, $this->email);
			$new->bindValue(5, $this->password);
			$new->bindValue(6, $this->rol);	
			$new->execute();

			$respuesta = array('status' => 1, 'descripcion' =>  "Nuevo usuario creado correctamente");
			echo json_encode($respuesta);
			die();


		} catch(exception $error){
			return $error;
		}

	}

	public function mostrarPersonal(){

		$select = $this->conex->prepare("SELECT `cedula`, `nombre`, `apellido`, `rol_Id`, `status`, tblroles.nombreRol FROM `tblusuarios` INNER JOIN `tblroles` ON `rol_Id` = tblroles.idRol WHERE `rol_Id` != 1 AND `rol_Id` != 2");
		$select->execute();
		$tabla = $select->fetchAll();

		$json = array();

		foreach ($tabla as $row) {
			$nombre = utf8_encode($row["nombre"]);
			$apellido = utf8_encode($row["apellido"]);
			$nombreRol = utf8_encode($row["nombreRol"]);

			$json[] = array("cedula" => $row["cedula"], "nombre" => $nombre, "apellido" => $apellido,
			"rol_Id" => $row["rol_Id"], "status" => $row["status"], "nombreRol" => $nombreRol);
		}

		echo json_encode($json);
		die();
	}

	public function obtenerPersonal($cedula){

		try {

			$query = $this->conex->prepare("SELECT * FROM `tblusuarios` WHERE `cedula`= ?");
			$query->bindValue(1, $cedula);
			$query->execute();
			$user = $query->fetchAll();

			$json = array();

			foreach ($user as $usuario) {
				$nombre = utf8_encode($usuario["nombre"]);
				$apellido = utf8_encode($usuario["apellido"]);

				$json[] = array('cedula' => $usuario["cedula"], 
					'nombre' => $nombre, 
					'apellido' => $apellido,
					'correo' => $usuario["correo"], 
					'rol_Id' => $usuario["rol_Id"],
					'status' => $usuario["status"]);
			}

			echo json_encode($json);
			die();
			
		} catch (Exception $error) {
			return $error;
		}

	}

	public function updatePersonal($cedula, $nombre, $apellido, $email, $password, $rol, $estado){

		if (preg_match_all("/^[0-9]{7,9}$/", $cedula)) {
			$this->cedula = $cedula;
		} else {
			$respuesta = array('status' => 0, 'descripcion' =>  "Error en la Cedula del personal");
			echo json_encode($respuesta);
			die();
		}
		
		if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1]{1,20}$/", $nombre)) {
			$this->nombre = $nombre;
		} else {
			$respuesta = array('status' => 0, 'descripcion' =>  "Error en el nombre del personal");
			echo json_encode($respuesta);
			die();
		}

		if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1]{1,20}$/", $apellido)) {
			$this->apellido = $apellido;
		} else {
			$respuesta = array('status' => 0, 'descripcion' =>  "Error en el apellido del personal");
			echo json_encode($respuesta);
			die();
		}
		
		if (preg_match_all("/^[a-zA-Z0-9_\.\-]+@[a-z0-9\-]+\.[a-zA-Z0-9\-]{2,4}$/", $email)) {
			$this->email = $email;
		} else {
			$respuesta = array('status' => 0, 'descripcion' =>  "Error en el correo del personal");
			echo json_encode($respuesta);
			die();
		}

		if (preg_match_all("/^[a-zA-Z0-9_\.\-]{8}$/", $password)) {
			$this->password = $password;
		} else {
			$respuesta = array('status' => 0, 'descripcion' =>  "Error en la contraseña del personal");
			echo json_encode($respuesta);
			die();
		}

		
		if (preg_match_all("/^[1-9]{1,11}$/", $rol)) {
			$this->rol = $rol;
		}else{
			$respuesta = array('status' => 0, 'descripcion' =>  "El rol que intenta introducir es invalido");
			echo json_encode($respuesta);
			die();
		}

		$validate = $this->conex->prepare("SELECT `idRol` FROM `tblroles` WHERE `idRol` = ? AND `idRol` != 1 AND `idRol` != 2");
		$validate->bindValue(1, $this->rol);

		$validate->execute();
		$roles = $validate->fetchAll();

		if (!isset($roles[0])) {
			$respuesta = array('status' => 0, 'descripcion' =>  "El rol que seleccionó es invalido");
			echo json_encode($respuesta);
			die();
		}

		if ($estado != 0 && $estado != 1) {
			$respuesta = array('status' => 0, 'descripcion' =>  "Seleccione un estado valido");
			echo json_encode($respuesta);
			die();
		}else{

			$this->statusUser = $estado;
		}

		$validate = $this->conex->prepare("SELECT `correo` FROM `tblusuarios` WHERE `correo` = ? AND `cedula` != ?");
		$validate->bindValue(1, $this->email);
		$validate->bindValue(2, $this->cedula);
		$validate->execute();

		$users = $validate->fetchAll();

		if (isset($users[0])) {
			$respuesta = array('status' => 0, 'descripcion' =>  "El correo que ha ingresado ya se encuentra registrado");
			echo json_encode($respuesta);
			die();
		}else{
			return $this->actualizarUsuario();
		}
	}

	private function actualizarUsuario(){

		try {

			$update = $this->conex->prepare("UPDATE `tblusuarios` SET `nombre` = ?, `apellido` = ?, `correo` = ?, `clave` = ?, `rol_Id` = ?, `status` = ? WHERE `cedula`= ?");
			$update->bindValue(1, utf8_decode($this->nombre));
			$update->bindValue(2, utf8_decode($this->nombre));
			$update->bindValue(3, $this->email);
			$update->bindValue(4, $this->password);
			$update->bindValue(5, $this->rol);
			$update->bindValue(6, $this->statusUser);
			$update->bindValue(7, $this->cedula);
			$update->execute();
			
			$respuesta = array('status' => 1, 'descripcion' =>  "El usuario ha sido modificado correctamente");
			echo json_encode($respuesta);
			die();
			
		} catch (Exception $error) {
			return $error;
		}
	}

	public function deleteAdmin($cedula){


		if (preg_match_all("/^[0-9]{7,9}$/", $cedula)) {
			$this->cedula = $cedula;
		} else {
			$respuesta = array('status' => 0, 'descripcion' =>  "El usuario que intenta eliminar es incorrecto");
			echo json_encode($respuesta);
			die();
		}

		$query = $this->conex->prepare("SELECT `cedula` FROM `tblusuarios` WHERE `cedula`= ? and `status` = 1");
		$query->bindValue(1, $this->cedula);
		$query->execute();

		$exists = $query->fetchAll();

		if (isset($exists[0])) {

			return $this->inhabilitarUsuario();
		}else{

			$respuesta = array('status' => 0, 'descripcion' =>  "No se ha podido eliminar el usuario");
			echo json_encode($respuesta);
			die();
		}

	}

	private function inhabilitarUsuario(){

		try {

			$delete = $this->conex->prepare("UPDATE `tblusuarios` SET `status` = 0 WHERE `cedula`= ?");
			$delete->bindValue(1, $this->cedula);
			$delete->execute();
			
			$respuesta = array('status' => 1, 'descripcion' =>  "El usuario ha sido eliminado correctamente");
			echo json_encode($respuesta);
			die();
			
		} catch (Exception $error) {
			return $error;
		}
	}

	//CRUD DE ROLES

	public function getRoles($nombreRol, $descripcionRol){

		if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1\ \-]{4,60}$/",$nombreRol)) {
			
			$this->nombreRol = $nombreRol;
		}else{

			$respuesta = array('status' => 0, 'descripcion' =>  "Nombre de rol invalido");
			echo json_encode($respuesta);
			die();
		}

		$validar = $this->conex->prepare("SELECT `nombreRol` FROM `tblroles` WHERE `nombreRol` = ?");
		$validar->bindValue(1, $this->nombreRol);
		$validar->execute();

		$isRegister = $validar->fetchAll();

		if (isset($isRegister[0])) {
			$respuesta = array('status' => 0, 'descripcion' =>  "Este rol ya se encuentra registrado");
			echo json_encode($respuesta);
			die();
		}

		if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1\ \-]{10,120}$/",$descripcionRol)) {
		
		$this->descripcionRol = $descripcionRol;

		}else{

			$respuesta = array('status' => 0, 'descripcion' =>  "Descripción del rol invalida");
			echo json_encode($respuesta);
			die();
		}

		return $this->agregarRoles();

	}

	private function agregarRoles(){

		try{
			
			$rol = $this->conex->prepare("INSERT INTO `tblroles`(`nombreRol`, `descripcionRol`, `estado`) VALUES (?,?,1)");
			$rol->bindValue(1, utf8_decode($this->nombreRol));
			$rol->bindValue(2, utf8_decode($this->descripcionRol));	
			$rol->execute();

			$respuesta = array('status' => 1, 'descripcion' =>  "Nuevo rol agregado correctamente");
			echo json_encode($respuesta);
			die();

		} catch(exception $error){
			return $error;
		}
	}

	public function mostrarRoles(){

		$mostrar = $this->conex->prepare("SELECT * FROM `tblroles` WHERE idRol != 1 and idRol != 2");
		$mostrar->execute();
		$mostrarRoles = $mostrar->fetchAll();

		$json = array();

		foreach ($mostrarRoles as $row) {
			$nombreRol = utf8_encode($row["nombreRol"]);
			$descripcionRol = utf8_encode($row["descripcionRol"]);

			$json[] = array("idRol" => $row["idRol"], "nombreRol" => $nombreRol, "descripcionRol" => $descripcionRol,
			"estado" => $row["estado"]);
		}

		echo json_encode($json);
		die();

	}

	public function updateRol($idRol, $nombreRol, $descripcionRol, $estadoRol){

		if (preg_match_all("/^[0-9]{1,11}$/", $idRol)) {
			$this->rol = $idRol;
		}else{
			$respuesta = array('status' => 0, 'descripcion' =>  "El rol que intenta introducir es invalido");
			echo json_encode($respuesta);
			die();
		}

		$validate = $this->conex->prepare("SELECT `idRol` FROM `tblroles` WHERE `idRol` = ? AND `idRol` != 1 AND `idRol` != 2");
		$validate->bindValue(1, $this->rol);

		$validate->execute();
		$roles = $validate->fetchAll();

		if (!isset($roles[0])) {
			$respuesta = array('status' => 0, 'descripcion' =>  "El rol que seleccionó es invalido");
			echo json_encode($respuesta);
			die();
		}

		if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1\ \-]{4,60}$/",$nombreRol)) {
			
			$this->nombreRol = $nombreRol;
		}else{

			$respuesta = array('status' => 0, 'descripcion' =>  "Nombre del rol invalido");
			echo json_encode($respuesta);
			die();
		}

		$validar = $this->conex->prepare("SELECT `nombreRol` FROM `tblroles` WHERE `nombreRol` = ? AND `idRol` !=  ?");
		$validar->bindValue(1, $this->nombreRol);
		$validar->bindValue(2, $this->rol);
		$validar->execute();

		$isRegister = $validar->fetchAll();

		if (isset($isRegister[0])) {
			$respuesta = array('status' => 0, 'descripcion' =>  "Este rol ya se encuentra registrado");
			echo json_encode($respuesta);
			die();
		}

		if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1\ \-]{10,120}$/",$descripcionRol)) {
		
		$this->descripcionRol = $descripcionRol;

		}else{

			$respuesta = array('status' => 0, 'descripcion' =>  "Descripción del rol invalida");
			echo json_encode($respuesta);
			die();
		}

		if ($estadoRol == 1 || $estadoRol == 0) {
		
		$this->estadoRol = $estadoRol;

		}else{

			$respuesta = array('status' => 0, 'descripcion' =>  "Seleccione un estado valido");
			echo json_encode($respuesta);
			die();
		}


		

	return $this->actualizarRoles();
	

	}

	private function actualizarRoles(){
		try {

			$update = $this->conex->prepare("UPDATE `tblroles` SET `nombreRol` = ?, `descripcionRol` = ?, `estado` = ? WHERE `idRol`= ?");
			$update->bindValue(1, utf8_decode($this->nombreRol));
			$update->bindValue(2, utf8_decode($this->descripcionRol));
			$update->bindValue(3, $this->estadoRol);
			$update->bindValue(4, $this->rol);
			$update->execute();
			
			$respuesta = array('status' => 1, 'descripcion' =>  "Rol modificado correctamente");
			echo json_encode($respuesta);
			die();
			
		} catch (Exception $error) {
			return $error;
		}
	}

	public function deleteRol($idRol){

		if (preg_match_all("/^[1-9]{1,11}$/", $idRol)) {
			$this->rol = $idRol;
		}else{
			$respuesta = array('status' => 0, 'descripcion' =>  "El rol que intenta eliminar es incorrecto");
			echo json_encode($respuesta);
			die();
		}

		

		$query = $this->conex->prepare("SELECT `idRol` FROM `tblroles` WHERE `idRol`= ? and `estado` = 1 AND `idRol`!= 1 and `idRol`!= 2");
		$query->bindValue(1, $this->rol);
		$query->execute();

		$exists = $query->fetchAll();

		if (isset($exists[0])) {

			return $this->inhabilitarRol();
		}else{

			$respuesta = array('status' => 0, 'descripcion' =>  "No se ha podido eliminar el rol");
			echo json_encode($respuesta);
			die();
		}

	}

	private function inhabilitarRol(){

		try {

			$delete = $this->conex->prepare("UPDATE `tblroles` SET `estado` = 0 WHERE `idRol`= ?");
			$delete->bindValue(1, $this->rol);
			$delete->execute();
			
			$respuesta = array('status' => 1, 'descripcion' =>  "El rol ha sido eliminado correctamente");
			echo json_encode($respuesta);
			die();
			
		} catch (Exception $error) {
			return $error;
		}
	}

	public function obtenerRol($id_rol){

		try {

			$query = $this->conex->prepare("SELECT * FROM `tblroles` WHERE `idRol`= ? AND `idRol`
				!= 1 AND `idRol`!= 2");
			$query->bindValue(1, $id_rol);
			$query->execute();
			$infoRol = $query->fetchAll();

			$json = array();

			foreach ($infoRol as $rol) {
				$nombreRol = utf8_encode($rol["nombreRol"]);
				$descripcionRol = utf8_encode($rol["descripcionRol"]);

				$json[] = array('idRol' => $rol["idRol"], 
					'nombreRol' => $nombreRol, 
					'descripcionRol' => $descripcionRol,
					'estado' => $rol["estado"]
					);
			}

			echo json_encode($json);
			die();
			
		} catch (Exception $error) {
			return $error;
		}
	}

	public function seleccionarRol(){

		$consulta = $this->conex->prepare("SELECT `idRol`,`nombreRol` FROM `tblroles` WHERE `idRol`!= 1 and `idRol`!=2 AND `estado`=1");
		$consulta->execute();
		$resultado = $consulta->fetchAll();

		foreach ($resultado as $row) {
			$nombreRol = utf8_encode($row["nombreRol"]);

			$json[] = array("idRol" => $row["idRol"], "nombreRol" => $nombreRol);
		}

		echo json_encode($json);
		die();

	}


	// Generar Reportes

	public function reporteConsulta($fechaRegistro, $fechaInicial, $fechaFinal, $cargoPersonal, $estadoPersonal){

		date_default_timezone_set("America/Caracas");

		$today = date('Y/m/d');

		if ($fechaRegistro) {
			if (strtotime($fechaInicial) >= strtotime($today)) {
				return $this->customAlert("error", "Error en la fecha inicial");
			}

			if (strtotime($fechaFinal) > strtotime($today)) {
				return $this->customAlert("error", "Error en la fecha Final");
			}

			if (strtotime($fechaInicial) > strtotime($fechaFinal)) {
				return $this->customAlert("error", "La fecha inicial no puede ser mayor a la fecha Final");
			}
		}

		if ($cargoPersonal != 0) {
			if (preg_match_all("/^[0-9]{1,11}$/", $cargoPersonal)) {
				$this->rol = $cargoPersonal;
			}else{
				return $this->customAlert("error", "Ingrese un rol valido");
			}
		}

		if ($estadoPersonal != 0) {
			if ($estadoPersonal == 1) {
				$this->estadoPersonal = $estadoPersonal;
			}elseif ($estadoPersonal == 2) {
				$this->estadoPersonal = 0;
			}else{
				return $this->customAlert("error", "Ingrese un estado valido");
			}
		}

		$this->fechaInicial = $fechaInicial;
		$this->fechaFinal = $fechaFinal;

		if ($fechaRegistro == 1 && $cargoPersonal != 0 && $estadoPersonal != 0) {
			$sentencia = "SELECT `cedula`, `nombre`, `apellido`, `fecha_reg` , tblroles.nombreRol FROM `tblusuarios` INNER JOIN `tblroles` ON tblroles.idRol = `rol_Id` WHERE `fecha_reg` BETWEEN :fechaInicial AND :fechaFinal AND `rol_Id`= :rol AND `status`= :estado";

			$execute = [':fechaInicial' => $this->fechaInicial, ':fechaFinal' => $this->fechaFinal, ':rol' => $this->rol, ':estado' => $this->estadoPersonal];

		}elseif ($fechaRegistro == 1 && $cargoPersonal != 0) {
			$sentencia = "SELECT `cedula`, `nombre`, `apellido`, `fecha_reg` , tblroles.nombreRol FROM `tblusuarios` INNER JOIN `tblroles` ON tblroles.idRol = `rol_Id` WHERE `fecha_reg` BETWEEN :fechaInicial AND :fechaFinal AND `rol_Id`= :rol";

			$execute = [':fechaInicial' => $this->fechaInicial, ':fechaFinal' => $this->fechaFinal, ':rol' => $this->rol];
		}
		elseif ($fechaRegistro == 1 && $estadoPersonal != 0) {
			$sentencia = "SELECT `cedula`, `nombre`, `apellido`, `fecha_reg` , tblroles.nombreRol FROM `tblusuarios` INNER JOIN `tblroles` ON tblroles.idRol = `rol_Id` WHERE `fecha_reg` BETWEEN :fechaInicial AND :fechaFinal AND `status`= :estado";

			$execute = [':fechaInicial' => $this->fechaInicial, ':fechaFinal' => $this->fechaFinal, ':estado' => $this->estadoPersonal];
		}
		elseif ($fechaRegistro == 1) {
			$sentencia = "SELECT `cedula`, `nombre`, `apellido`, `fecha_reg` , tblroles.nombreRol FROM `tblusuarios` INNER JOIN `tblroles` ON tblroles.idRol = `rol_Id` WHERE `fecha_reg` BETWEEN :fechaInicial AND :fechaFinal";

			$execute = [':fechaInicial' => $this->fechaInicial, ':fechaFinal' => $this->fechaFinal];
		}
		elseif ($estadoPersonal != 0 && $cargoPersonal != 0) {
			$sentencia = "SELECT `cedula`, `nombre`, `apellido`, `fecha_reg` , tblroles.nombreRol FROM `tblusuarios` INNER JOIN `tblroles` ON tblroles.idRol = `rol_Id` WHERE `rol_Id`= :rol AND `status`= :estado";

			$execute = [':rol' => $this->rol, ':estado' => $this->estadoPersonal];
		}
		elseif ($estadoPersonal != 0) {
			$sentencia = "SELECT `cedula`, `nombre`, `apellido`, `fecha_reg` , tblroles.nombreRol FROM `tblusuarios` INNER JOIN `tblroles` ON tblroles.idRol = `rol_Id` WHERE `status`= :estado";

			$execute = [':estado' => $this->estadoPersonal];
		}
		elseif ($cargoPersonal != 0) {
			$sentencia = "SELECT `cedula`, `nombre`, `apellido`, `fecha_reg` , tblroles.nombreRol FROM `tblusuarios` INNER JOIN `tblroles` ON tblroles.idRol = `rol_Id` WHERE `rol_Id`= :rol ";

			$execute = [':rol' => $this->rol];
		}
		elseif ($fechaRegistro == false && $estadoPersonal == 0 && $cargoPersonal == 0) {
			$sentencia = "SELECT `cedula`, `nombre`, `apellido`, `fecha_reg` , tblroles.nombreRol FROM `tblusuarios` INNER JOIN `tblroles` ON tblroles.idRol = `rol_Id`";

			$execute = [];
		}
		else{
			return $this->customAlert("error", "No se ha podido generar el reporte");
		}


		$query = $this->conex->prepare($sentencia);
		$query->execute($execute);

		$reporte = $query->fetchAll();

		if (isset($reporte[0])) {
			
			$pdf = new reporteModelo();
			$pdf->SetTitle("Reporte de Personal");
			return $pdf->crearReportePersonal($reporte);

		}else{
			return $this->customAlert("No se encontraron datos para crear el reporte");
		}

	}

	// GESTION DE PERMISOS Y MODULOS

	public function mostrarModulos(){

		$modulo = $this->conex->prepare("SELECT * FROM `tblmodulos`");
		$modulo->execute();
		$lista = $modulo->fetchAll(PDO::FETCH_ASSOC);

		return $lista;
	}

	public function gestionPermisos($rol, $modulo, $estado){

		if (preg_match_all("/^[0-9]{1,11}$/",$rol)) {
			$this->rol = $rol;
		}else{
			return $this->customAlert("El rol ingresado es invalido");
		}

		$validar = $this->conex->prepare("SELECT `idRol` FROM `tblroles` WHERE `idRol`= ? AND `idRol`
				!= 1 AND `idRol`!= 2");
		$validar->bindValue(1, $this->rol);
		$validar->execute();

		$exists = $validar->fetchAll();

		if (!isset($exists[0])) {
			return $this->customAlert("No se han podido modificar los permisos del rol");
		}
		
		$this->modulo = $modulo;
		$this->estadoModulo = $estado;

		$consulta = $this->conex->prepare("SELECT * FROM `tblaccesomodulo` WHERE `idRol` = ? and `idModulo` = ?");
		$consulta->bindValue(1,$this->rol);
		$consulta->bindValue(2, $this->modulo);
		$consulta->execute();

		$validar = $consulta->fetchAll();

		if (isset($validar[0])) {
			$this->actualizarPermisos();
		}else{
			$this->insertarPermisos();
		}
	
	}

	private function insertarPermisos(){

		try{
			
			$access = $this->conex->prepare("INSERT INTO `tblAccesoModulo` (`idModulo`, `idRol`, `estadoAcceso`) VALUES (?,?,?)");
			$access->bindValue(1, $this->modulo);
			$access->bindValue(2, $this->rol);
			$access->bindValue(3, $this->estadoModulo);	
			$access->execute();

		} catch(exception $error){
			return $error;
		}
	}

	private function actualizarPermisos(){

		try {
			
			$access = $this->conex->prepare("UPDATE `tblAccesoModulo` SET `estadoAcceso` = ? WHERE `idModulo` = ? AND `idRol` = ?");
			$access->bindValue(1, $this->estadoModulo);
			$access->bindValue(2, $this->modulo);
			$access->bindValue(3, $this->rol);
			$access->execute();

		} catch (Exception $error) {
			return $error;
		}
	}

	public function obtenerPermisos($idRol){
		try {

		$query = $this->conex->prepare("SELECT * FROM `tblaccesomodulo` WHERE `idRol` = ? AND `idRol` != 1 AND `idRol` != 2");
		$query->bindValue(1, $idRol);
		$query->execute();

		$resultado = $query->fetchAll(\PDO::FETCH_OBJ);
		echo json_encode($resultado);
		die();
			
		} catch (Exception $error) {
			return $error;
		}
	}

}




 ?>
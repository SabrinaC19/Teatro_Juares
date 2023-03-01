<?php 

namespace TeatroJuares\Content\helpers;

use TeatroJuares\Content\config\connect\connectDB as connectDB;

class authSession extends connectDB{

	private $conex;

	public function __construct(){
	
		parent::__construct();

		$this->conex = parent::activeDB();
	}

	public function setUserSession($datos){

		if (isset($datos[0])) {
			
			$_SESSION["idUser"] = $datos[0]["cedula"];
			$_SESSION["nombre"] = $datos[0]["nombre"];
			$_SESSION["email"] = $datos[0]["correo"];
			$_SESSION["rol"] = $datos[0]["rol_Id"];
			$_SESSION["login"] = true;
			header('Location:'._ROUTE_.'?url=usuario&type=perfil');
		}
	}

	public function log(){
		if (isset($_SESSION["login"])) {
			return true;
		}else{
			return false;
		}
	}

	public static function _isLog(){

		if (isset($_SESSION["login"])) {
			header('Location:'._ROUTE_.'?url=usuario&type=perfil');
		}
	}

	public static function notLog(){

		if (!isset($_SESSION["login"])) {
			header('Location:'._ROUTE_.'?url=usuario&type=login');
		}
	}

	public static function logout(){

			session_start();
		    session_destroy();
		    $_SESSION = [];
		    header('Location:' . _ROUTE_. '?url=usuario&type=login');
	}

	public static function _isAdmin(){

		if ($_SESSION["rol"] == 1) {
			
			return false;
		}else{

			return true;
		}
	}

	public function requestAccess($sessionRol, $idModulo){

		$consulta = $this->conex->prepare("SELECT * FROM `tblaccesomodulo` WHERE  `idRol` = ? and `idModulo` = ?");
		$consulta->bindValue(1, $sessionRol);
		$consulta->bindValue(2, $idModulo);
		$consulta->execute();

		$permisos = $consulta->fetchAll();

		if (isset($permisos[0])) {
			if ($permisos[0]["estadoAcceso"] == 1) {
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}

	}

	

	
	}

 ?>
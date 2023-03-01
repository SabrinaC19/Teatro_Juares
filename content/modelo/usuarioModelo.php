<?php

namespace TeatroJuares\Content\modelo;
use TeatroJuares\Content\config\connect\connectDB as connectDB;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

	class usuarioModelo extends connectDB{

	private $conex;
	private $nombre;
	private $apellido;
	private $cedula;
	private $email;
	private $contra;
	
	
	public function __construct(){
		parent:: __construct();
		$this->conex = parent::activeDB();
	}


	public function getRegistroUsuario($nombre, $apellido, $cedula, $email, $contra){


		if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1]{1,20}$/", $nombre)){
			$this->nombre = $nombre;
		}else{
			$respuesta = array('status' => 0, 'descripcion' => 'Error en el nombre');
				echo json_encode($respuesta);
		 		die();
		}

		if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1]{1,20}$/", $apellido)){
			$this->apellido = $apellido;
		}else{
			$respuesta = array('status' => 0, 'descripcion' => 'Error en el apellido');
				echo json_encode($respuesta);
		 		die();
		}

		if (preg_match_all("/^[0-9]{1,10}$/", $cedula)){
			$this->cedula = $cedula;
		}else{
			$respuesta = array('status' => 0, 'descripcion' => 'Error en la cedula ingresada');
				echo json_encode($respuesta);
		 		die();
		}
		
		if (preg_match_all("/^[a-zA-Z0-9_\.\-]+@[a-z0-9\-]+\.[a-zA-Z0-9\-]{2,4}$/", $email)){
			$this->email = $email;
		}else{
			$respuesta = array('status' => 0, 'descripcion' => 'Error en el correo');
				echo json_encode($respuesta);
		 		die();
		}

		if (preg_match_all("/^[a-zA-Z0-9_\.\-]{8}$/", $contra)){
			$this->contra = $contra;
		}else{
			$respuesta = array('status' => 0, 'descripcion' => 'Error en la contraseña');
				echo json_encode($respuesta);
		 		die();
		}
			$validate = $this->conex->prepare("SELECT `cedula`, `status` FROM `tblusuarios` WHERE `cedula` = ? AND `status` = 0 ");
			$validate->bindValue(1, $this->cedula);

			$validate->execute();
			$usuarios = $validate->fetchAll();

			if (isset($usuarios[0])) {
				$respuesta = array('status' => 2, 'descripcion' => '¿Desea activar su cuenta ?');
				echo json_encode($respuesta);
		 		die();
			}
			return  $this->validarUsuario();			
	}


	private function validarUsuario(){

		$validate = $this->conex->prepare("SELECT `cedula`, `correo`  FROM `tblusuarios` WHERE `cedula` = ? OR `correo` = ?");
		$validate->bindValue(1, $this->cedula);
		$validate->bindValue(2, $this->email);

		$validate->execute();
		$usuarios = $validate->fetchAll();
	
		if (isset($usuarios[0])) {

				$respuesta = array('status' => 0, 'descripcion' => 'Usuario ya registrado ingrese nuevos datos');
				echo json_encode($respuesta);
		 		die();	    	
		}else{
			return $this->RegistroUsuarioSistema();	
		}
	}

	
	private function RegistroUsuarioSistema(){

		try{

		$new = $this->conex->prepare("INSERT INTO `tblusuarios`(`cedula`, `nombre`, `apellido`, `correo`, `clave`, `fecha_reg`, `rol_Id`, `status`) VALUES (?,?,?,?,?,NOW(),1,default)");
		$new->bindValue(1, $this->cedula);
		$new->bindValue(2, utf8_decode($this->nombre));
		$new->bindValue(3, utf8_decode($this->apellido));
		$new->bindValue(4, $this->email);
		$new->bindValue(5, $this->contra);
		$new->execute();
			
		$respuesta = array('status' => 1, 'descripcion' => 'Usuario creado exitosamente');
		echo json_encode($respuesta);
		die();
				
		}catch(exeption $error){
			return $error;
		}
	}

	public function getHabilitarUser($cedula, $password){

		if (preg_match_all("/^[0-9]{1,10}$/", $cedula)){
			$this->cedula = $cedula;
		}else{
			$respuesta = array('status' => 0, 'descripcion' => 'Error en la cedula ingresada');
				echo json_encode($respuesta);
		 	die();
		}

		$validar =$this->conex->prepare("SELECT `cedula` FROM `tblusuarios` WHERE `cedula` = ? AND `status` = 0");
		$validar->bindValue(1, $this->cedula);
		$validar->execute();
		$verificarUser = $validar->fetchAll(\PDO::FETCH_ASSOC);

		if (!isset($verificarUser[0])){
			$respuesta = array('status' => 0, 'descripcion' => 'Error no se a podido habilitar el usuario');
				echo json_encode($respuesta);
		 	die();	
		}

		if (preg_match_all("/^[a-zA-Z0-9_\.\-]{8}$/", $password)){
			$this->contra = $password;
		}else{
			$respuesta = array('status' => 0, 'descripcion' => 'Error en la contraseña');
				echo json_encode($respuesta);
		 	die();
		}
		return $this->habilitarUser();
	}

	private function habilitarUser(){
		try {
			$habilitar=$this->conex->prepare("UPDATE `tblusuarios` SET `status` = 1,`rol_Id`= 1, `clave` = ? WHERE `cedula` = ?");
			$habilitar->bindValue(1,$this->contra);
			$habilitar->bindValue(2,$this->cedula);
			$habilitar->execute();

			$respuesta = array('status' => 1, 'descripcion' => 'El usuario se a habilidado');
				echo json_encode($respuesta);
		 	die();
		}catch (Exception $e){
			return $e;
		}
	}

	public function RegistroBusca(){

		return $this->verRegistro();
	}

	private function verRegistro(){
		
		$escoger = $this->conex->prepare("SELECT `cedula`, `nombre`, `apellido`, `correo`, `clave`, `rol_Id`, `status` FROM `tblusuarios` WHERE 1");
		$escoger->execute();
		$tabla = $escoger->fetchAll(PDO::FETCH_ASSOC);

		return $tabla;

	}

	//aqui empieza el login
	public function getLoginSistema($cedula, $password){

			if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $cedula)){
				return  "Error en Cedula o Contraseña";			
			}

			if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $password)){
				return  "Error en Cedula o Contraseña";			
			}

			$this->cedula = $cedula;
			$this->password = $password;

			return $this->loginSistema();
		}

		private function loginSistema(){
			try{
				$new = $this->conex->prepare("SELECT* FROM `tblusuarios` WHERE `status`  AND `cedula` = ?");
				$new->bindValue(1, $this->cedula);
				
				$new->execute();
				$data = $new->fetchAll();
				if(isset($data[0]["clave"])){
					if($data[0]["clave"]== $this->password){

							return $data;

						}else{
							return false;
						}

						}else{
							return false;
						}

			} catch(exeption $error){
				return $error;
			}
		} 

		// aqui empieza el perfil

		public function getUser($id){

		$vari = $this->conex->prepare("SELECT * `cedula`, `nombre`, `apellido`, `correo`, `correo`,  `status` FROM `tblusuarios` WHERE 1");
		$vari->execute();
		$tabla = $vari->fetchAll(PDO::FETCH_ASSOC);

		return $tabla;
		}

		public function existsUser($user){

			$query = $this->conex->prepare("SELECT * FROM `tblusuarios` WHERE `cedula` = ? AND `status` = 1");
			$query->bindValue(1, $user);
			$query->execute();

			$datos = $query->fetchAll();

			if (isset($datos[0])) {
				
				return true;
			}else{

				return false;
			}
		}

		//aqui empieza el cambio de contraseña

		public function recoverPass($correo){

			if (preg_match_all("/^[a-zA-Z0-9_\.\-]+@[a-z0-9\-]+\.[a-zA-Z0-9\-]{2,4}$/", $correo)){
			$this->email = $correo;
		}
			//Validar si el correo esta registrado
			$query = $this->conex->prepare("SELECT `cedula`, `correo` FROM `tblusuarios` WHERE `correo` = ?");
			$query->bindValue(1, $this->email);
			$query->execute();
			$listar = $query->fetchAll();

			if (isset($listar[0])) {
				
				$this->enviarCorreo($listar);
				//header('Location:'._ROUTE_.'?url=usuario&type=changePass&token='.$listar[0]["cedula"]);
			}else{
				return ("<script>
            
					    swal.fire({
						icon:'error',
						title:'El dato ingresado no esta Registrado.',
						confirmButtonText:'Ok',
						confirmButtonColor:'#198754',
						})
		       		</script>"
		       	);
			}
		}

		private function enviarCorreo($datos){
			

	 		$mail = new PHPMailer(true);
	 		try {
			    $mail->SMTPDebug = 0;                      
			    $mail->isSMTP();                                            
			    $mail->Host       = 'smtp.gmail.com';                     
			    $mail->SMTPAuth   = true;                                   
			    $mail->Username   = 'soportefundacionteatrojuares@gmail.com';                     
			    $mail->Password   = 'pldzbnydfcilkxco';               
			    $mail->SMTPSecure = 'tls';           
			    $mail->Port       = 587;                                    
			    //emisor y receptor
			    $mail->setFrom('soportefundacionteatrojuares@gmail.com', 'Fundacion Teatro Juares');
			    $mail->addAddress($datos[0]["correo"],'FTJ');     
			    //Contenido de correo(HTML)
			    $mail->isHTML(true);                                  
			    $mail->Subject = 'Cambio de contraseña Soporte Fundacion Teatro Juares';
			    $mail->Body = '<html >
					  <head>
					    <meta  charset="utf-8">
					    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
					  </head>
					  <body style="background-image: linear-gradient(to bottom, #C7243C, #40000A);">
					    <center class="wrapper" data-link-color="#1188E6" data-body-style="font-size: 14px; font-family: arial; color:  #831B36; ">
					      <div class="webkit">
					        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="wrapper" >
					          <tr>
					            <td valign="top"  width="100%">
					              <table width="100%" role="content-container" class="outer" align="center" cellpadding="0" cellspacing="0" border="0">
					                <tr>
					                  <td width="100%">
					                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
					                      <tr>
					                        <td>				                          
					                          <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width:600px;" align="center">
					                            <tr>
					                              <td role="modules-container" style="padding: 0px 0px 0px 0px; color:  #831B36; text-align: left;" bgcolor="#ffffff" width="100%" align="left">				                                
					    <table class="module preheader preheader-hide" role="module" data-type="preheader" border="0" cellpadding="0" cellspacing="0" width="100%"
					           style="display: none !important; mso-hide: all; visibility: hidden; opacity: 0; color: transparent; height: 0; width: 0;">
					      <tr>
					        <td role="module-content">
					          <p></p>
					        </td>
					      </tr>
					    </table>
					    <table class="wrapper" role="module" data-type="image" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
					      <tr>
					        <td>
					          <div data-role="module-unsubscribe" class="module unsubscribe-css__unsubscribe___2CDlR" role="module" data-type="unsubscribe" style="background-color:#ebebeb;color:#7a7a7a;font-size:11px;line-height:20px;padding:30px 0px 30px 0px;text-align:center; height: 90px; height: 70px;"><h1 style="margin-top: -10px; color: #000;" >Correo de recuperacion</h1> <img src="https://cdn-icons-png.flaticon.com/512/240/240026.png" width="90px" height="65px" style="margin-top: -10px;"></div>
					        </td>
					      </tr>
					    </table>				 
					    <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
					      <tr>
					        <td style="padding:25px 20px 25px 20px;line-height:20px;text-align:inherit;"
					            height="100%"
					            valign="top"
					            bgcolor="">
					            <h2 style="text-align: center; color:#831B36;">Cambio de contraseña</h2>
					            <center style="font-weight: bold;color:  #3383d3;">¿Haz solicitado cambiar tu contraseña?</center>
					           <p style="color: #000; font-weight:bold;" align="justify"> Hemos recibido un pedido de cambio de contraseña de tu cuenta. Si has sido tu, puedes ingresar la nueva contraseña.</p>
					           <h2 style="text-align: center;"><span style="color:#831B36;">Preciona el enlace</span></h2>
					             <center><b><a href="http://localhost/Teatro_Juares/?url=usuario&type=changePass&token='.$datos[0]["cedula"].'"><button style="color: white;background-color:#C7243C; border-radius: 5px;"><b>Ingresar nueva contraseña</b></button> </a></b></center>
					             <p style="color: #000;font-weight:bold;" align="justify">Si no quieres ingresar una nueva contraseña  o no has sido quien lo ha solicitado,simplemente ignora este mensaje.</p>
					        </td>
					      </tr>
					    </table>
					  <table class="module" role="module" data-type="code" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
					      <tr>
					        <td height="100%" valign="top">
					          <div>
					<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%;">				 
					    <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
					      <tr>
					        <td style="padding:0px 0px 30px 0px;line-height:22px;text-align:inherit;"
					            height="100%"
					            valign="top"
					            bgcolor="">
					            <div style="text-align: center;"><font color="#831B36"></font></div>
					        </td>
					      </tr>
					    </table>				  
					      <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
					        <tr>
					          <td style="padding:30px 20px 0px 20px;line-height:22px;text-align:inherit;background-color:#F5F5F5;"
					              height="100%"
					              valign="top"
					              bgcolor="#F5F5F5">
					              <div style="text-align: center;"><span style="color:#7a7a7a;"><span style="font-size:11px;"></span></span></div>
					          </td>
					        </tr>
					      </table>				   
					                              </td>
					                            </tr>
					                          </table>
					                          
					                        </td>
					                      </tr>
					                    </table>
					                  </td>
					                </tr>
					              </table>
					            </td>
					          </tr>
					        </table>
					      </div>
					    </center>
					    <script src="js/sb-admin-2.min.js"></script>
					    <script src="https://kit.fontawesome.com/1aff6beda6.js" crossorigin="anonymous"></script>
					  </body>
					</html>'; 
							   
			    $mail->CharSet ='UTF-8';
			    $mail->send();
			    echo'<h3 style="color:#bec0c3;font-family:Courier;margin-left:20px;"><b>Correo electronico enviado</b></h3>';
			}catch (Exception $e){
		    echo '<h3 style="color:#bec0c3;font-family:Courier;margin-left:20px;"><b>Error al enviar correo electronico</b></h3>', $mail->ErrorInfo;
			}
		}

		public function changePass($cedula, $password){

			if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $cedula)){
				return "Error en Cedula";			
			}

			if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $password)){
				return "Error en  Contraseña";			
			}

			$this->cedula = $cedula;
			$this->contra = $password;

			return $this->actualizarPass();	
		}

		private function actualizarPass(){

			try {
				$query = $this->conex->prepare("UPDATE `tblusuarios` SET `clave` = ? WHERE `cedula` = ? ");
				$query->bindValue(1, $this->contra);
				$query->bindValue(2, $this->cedula);
				$query->execute();
				return "<b>cambio de contraseña exitoso</b>";
			}catch (Exception $e){
				return $e;
			}
		}

		
		public function getUsuarito($cedula){

			$this->cedula = $cedula;

			$consulta = $this->conex->prepare("SELECT * FROM `tblusuarios` WHERE `cedula`= ?");
			$consulta->bindValue(1, $this->cedula);
		
			$consulta->execute();
			$user = $consulta->fetchAll();

			return $user;
		}

		//aqui empieza el eliminar usuario
	public function eliminarUser($cedula){

		if (preg_match_all("/^[0-9]{1,10}$/", $cedula)){
			$this->cedula = $cedula;
		}else{
			$respuesta = array('status' => 0, 'descripcion' => 'No se ha podido eliminar el usuario');
			echo json_encode($respuesta);
		 	die();
		}

		$existe = $this->existsUser($this->cedula);

		if ($existe) {
			return $this->inhabilitarUser();
		}else{
			$respuesta = array('status' => 0, 'descripcion' => 'No se ha podido eliminar el usuario');
			echo json_encode($respuesta);
		 	die();
		}

	}

	private function inhabilitarUser(){
		try{
		 		$elimino = $this->conex->prepare("UPDATE `tblusuarios` SET `status` = 0 WHERE `cedula`=?");
		 		$elimino->bindValue(1,$this->cedula);
		 		$elimino->execute();

				session_destroy();
				$_SESSION = [];

				$respuesta = array('status' => 1, 'descripcion' => 'Su usuario ha sido eliminado correctamente');
				echo json_encode($respuesta);
		 		die();
		 	}catch(Exception $error){
		 		return $error;
			}
	}

		//aqui empieza el editar usuario
		public function modificarUser($cedula,$nombre, $apellido, $correo, $telefono,  $password){

			if (preg_match_all("/^[a-zA-Z0-9_\.\-]{8}$/", $cedula)){
			$this->cedula = $cedula;
			}else{
			$resultado = array('status' =>0, 'descripcion'=>"Error en cedula");
			echo json_encode($resultado);
			die();				
		}

		if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1]{1,20}$/", $nombre)){
			$this->nombre = $nombre;
		}else{
			$resultado = array('status' =>0, 'descripcion'=>"Error en el nombre");
			echo json_encode($resultado);
			die();		
		}

		if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d1]{1,20}$/", $apellido)){
			$this->apellido = $apellido;
		}else{
			$resultado = array('status' =>0, 'descripcion'=>"Error en el apellido");
			echo json_encode($resultado);
			die();			
		}

		
		if (preg_match_all("/^[a-zA-Z0-9_\.\-]+@[a-z0-9\-]+\.[a-zA-Z0-9\-]{2,4}$/", $correo)){
			$this->email = $correo;
		}else{
			$resultado = array('status' =>0, 'descripcion'=>"Error en el correo");	
			echo json_encode($resultado);
			die();
		}

		if (preg_match_all("/^[a-zA-Z0-9_\.\-]{11}$/", $telefono)){
			$this->telefono = $telefono;
		}else{
			$resultado = array('status' =>0, 'descripcion'=>"Error en el telefono");	
			echo json_encode($resultado);
			die();
		}

		if (preg_match_all("/^[a-zA-Z0-9_\.\-]{8}$/", $password)){
			$this->contra = $password;
		}else{
			$resultado = array('status' => 0, 'descripcion'=>"Error en la contraseña"); 
			echo json_encode($resultado);
			die();
		}

		$modificar = $this->conex->prepare("SELECT `correo` FROM `tblusuarios` WHERE `correo` = ? AND `cedula` != ?");
		$modificar->bindValue(1, $this->email);
		$modificar->bindValue(2, $this->cedula);
		$modificar->execute();

		$usuarios = $modificar->fetchAll();
	
		if (isset($user[0])){
			$respuesta = array('status' => 0, 'descripcion'=> "El correo ya esta registrado a otro usuario");
			echo json_encode($respuesta);
			die();		
		}else{
			return $this->modificacionDatos();
		}
	}

	private function modificacionDatos(){

		try{

			$modifico = $this->conex->prepare("UPDATE `tblusuarios` SET `nombre` = ?, `apellido`= ?, `correo` = ?, `telefono` = ?, `clave` = ? WHERE `cedula` = ?");
			$modifico->bindValue(1, utf8_decode($this->nombre));
			$modifico->bindValue(2, utf8_decode($this->apellido));
			$modifico->bindValue(3, $this->email);
			$modifico->bindValue(4, $this->telefono);
			$modifico->bindValue(5, $this->contra);
			$modifico->bindValue(6, $this->cedula);

			$modifico->execute();

			$respuesta = array('status' => 1, 'descripcion' =>"El usuario ha sido modificado correctamente");
			echo json_encode($respuesta);
			die();
		}catch (exeption $error){
			return $error;
		}
	}

}
	
?>
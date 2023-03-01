<?php 

namespace TeatroJuares\Content\modelo;

use TeatroJuares\Content\config\connect\connectDB as connectDB;

use TeatroJuares\Content\modelo\reporteModelo as reporteModelo;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class citaModelo extends connectDB{
	
	private $conex;

	private $nroCita;
	private $nombreEvento;
	private $fechaCita;
	private $horaCita; 
	private $servicio;
	private $otroServicio;
	private $espacio;
	private $tipoCita;
	private $descripcion;
	private $razon;
	private $correoContacto;
	private $codigo;
	private $numeroContacto;

	public function __construct(){
		
		parent::__construct();

		$this->conex = parent::activeDB();
	}

	public function getRegistrarCita($nombreEvento, $fechaCita, $horaCita, $servicio, $otroServicio, $espacio, $descripcion, $tipoCita, $razonSocial, $correoContacto, $codigo, $numeroContacto, $pdf, $cedCliente) {
		
		if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d10-9_\ \.\-¡!¿?]{3,60}$/", $nombreEvento)) {

			$this->nombreEvento = $nombreEvento;

		} else {

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
		              title: 'Error en el Nombre del Evento'
		          })

		        </script>");
		}

		date_default_timezone_set("America/Caracas");

		$hoy = date("Y-m-d");
		$valFecha = strtotime("{$hoy}+1 year");
		$valSemana = strtotime("{$hoy}+1 week");
		
		if (isset($fechaCita)) {
			
		
			if (strtotime($fechaCita) > $valSemana) {
				
				if (strtotime($fechaCita) < $valFecha) {
					
					$this->fechaCita = $fechaCita;
				} else {

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
			              title: 'No Puede Solicitar Una Cita En Un Lapso Mayor a Un Año'
			          })

			        </script>");
				}					
			} else {

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
			              title: 'La Cita Se Debe Solicitar Con Una Semana de Anticipación'
			          })

			        </script>");
			}
		} else {

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
			              title: 'Fecha de la Cita Invalida'
			          })

			        </script>");

		}

		if ($horaCita != NULL) {
		
			$horaSec = ((substr($horaCita,0, 2) * 60)*60) + (substr($horaCita, 3, 5)* 60);

			if ($horaSec >= 32400 && $horaSec < 43200 || $horaSec >= 46800 && $horaSec < 57600) {
				
				$this->horaCita = $horaCita;
			
			} else {

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
		              title: 'Error en la Hora de la Cita'
		          })


       		 </script>");
			}
		} else {

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
		              title: 'Error en la Hora de la Cita'
		          })
       		</script>");
		}

		if (preg_match_all("/^[1-6\-]{1}$/", $servicio)) {

			switch ($servicio) {
				case 1:
					$this->servicio = "Obra Teatral";
					break;
				case 2:
					$this->servicio = "Concierto";
					break;
				case 3:
					$this->servicio = "Graduacion";
					break;
				case 4:
					$this->servicio = "Concurso";
					break;
				case 5:
					$this->servicio = "Conferencia";
					break;
				case 6:
					$this->servicio = $otroServicio;
					break;

				default:
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
	              		title: 'Seleccione Un Servicio'
	          			}) </script>");
					break;
			}
		} else {

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
	              	title: 'Valor del Servicio Invalido'
	          		}) 
	         </script>");
		}

		if (preg_match_all("/^[1-2\-]{1}$/", $espacio)) {
			
			if ($espacio == 1) {

				$this->espacio = "Escenario"; 
			
			} elseif ($espacio ==2) {
				
				$this->espacio = "Salon de los Espejos";
			
			} else {

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
		              title: 'Seleccione Un Espacio Válido'
		          })

		        </script>");
			}
		} else {

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
		              title: 'Valor del Espacio Invalido'
		         })

		    </script>");
		}

		if(10 < strlen($descripcion) && strlen($descripcion) <150){

        $this->descripcion = $descripcion;

      } else{
            
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
           		 	title: 'Error en la descripción del evento'
          		})
        	</script>");
      	}

      	if ($tipoCita == NULL) {
      		
      		$this->tipoCita = 1;
      	
      	} else {

      		$this->tipoCita = 2;
      	}

		if ($razonSocial != NULL) {

			if (preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d10-9_\ \.]{5,30}$/", $razonSocial)) {

			$this->razonSocial = $razonSocial;

		} else {

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
            		title: 'Error en la Razón Social'
          		})
       		</script>");
		}
			
		
		} else {

			$this->razonSocial = NULL;
		}

		if ($correoContacto != NULL) {

			if (preg_match_all("/^[a-zA-Z0-9_\.\-]+@[a-z0-9\-]+\.[a-zA-Z0-9\-]{2,6}$/", $correoContacto)) {

				$this->correoContacto = $correoContacto;
			
			} else {

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
            		title: 'Error en la Razón Social'
          		})

       		 </script>");

			}
		}

		// Datos del Cliente

		$validarCliente = $this->conex->prepare("SELECT `cedulaCliente`, `correo`, `nroTelefono` FROM `tblclientes` WHERE `cedulaCliente` = ?");

		$validarCliente->bindValue(1, $cedCliente);
		$validarCliente->execute();

		$cliente = $validarCliente->fetchAll();

		if (isset($cliente[0]['cedulaCliente'])) {
			
			if ($this->tipoCita === 1) {
				
				$this->correoContacto = $cliente[0]['correo'];
				$this->cedCliente = $cliente[0]['cedulaCliente'];
				$this->numerotlfno = $cliente[0]['nroTelefono'];

			}else{

				$this->cedCliente = $cliente[0]['cedulaCliente'];
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
            		title: 'Cliente No Registrado'
          		})

       		 </script>");
		}


		if ($this->tipoCita === 1) {

			switch ($codigo) {

				case 0:
					$codigo = "";
					break;
					
				default:

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
				              title: 'Seleccione un Codigo de Teléfono Valido'
				        })
				    </script>");
				break;
			}
		} else {

			switch ($codigo) {

				case 1:
					$codigo = "0412";
					break;
				case 2:
					$codigo = "0414";
					break;
				case 3:
					$codigo = "0424";
					break;
				case 4:
					$codigo = "0416";
					break;
				case 5:
					$codigo = "0426";
					break;
				case 6:
					$codigo = "0251";
					break;
					
				default:

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
				              title: 'Seleccione un Codigo de Teléfono Valido'
				        })
				    </script>");
				break;
			}
		}	


		if ($numeroContacto != NULL && $codigo != "") {

			if (preg_match_all("/^[0-9]{7}$/", $numeroContacto)) {

				$this->numerotlfno = $codigo."-".$numeroContacto;

			} else {

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
            		title: 'Error en el Teléfono'
          		})
       		</script>");
		}
			
		} 

		$this->pdf = $pdf;

		return $this->validarCita();
	}

	private function validarCita() {

		try {

			$validarFecha = $this->conex->prepare("SELECT `fechaCita`, `horaCita` FROM `tblcitasreservacion` WHERE (`estadoCita` = 1 OR `estadoCita` = 2) AND `fechaCita` = ? AND `horaCita` = ?");

			$validarFecha-> bindValue(1, $this->fechaCita);

			$validarFecha-> bindValue(2, $this->horaCita);

			$validarFecha->execute();

			$dateCita = $validarFecha->fetchAll();


			if (isset($dateCita[0])) {
					
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
			            		title: 'Ya Se Solicitó Una Cita a Esa Hora'
			          		})
			       		</script>");
				
			}


			$tiempoHora = $this->conex->prepare("SELECT `fechaCita`, `horaCita` FROM `tblcitasreservacion` WHERE (`estadoCita` = 1 OR `estadoCita` = 2) AND `fechaCita` = ?");

			$tiempoHora->bindValue(1, $this->fechaCita);
			$tiempoHora->execute();
			$lapsoTiempo = $tiempoHora->fetchAll();

			if (isset($lapsoTiempo[0]["fechaCita"])) {
				foreach ($lapsoTiempo as $time) {

					$horaCita = strtotime($time['horaCita']);
					$lapsoHora = strtotime("{$time['horaCita']}+ 30 minutes");
					
					if ($horaCita < strtotime($this->horaCita) && strtotime($this->horaCita) < $lapsoHora) {

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
			            		title: 'Ya Se Solicitó Una Cita En esa fecha y En Este Lapso De Tiempo, Con 30 mínutos de diferencia'
			          		})
			       		</script>");
					}
				}
			}


			return $this->registrarCita();
						
			
		} catch (Exception $error) {
			
			return $error;
		}
	}

	private function registrarCita() {

		try {


			$registroCita = $this->conex->prepare("INSERT INTO `tblcitasreservacion`(`nombreEvento`, `fechaCita`, `horaCita`, `servicio`, `espacio`, `descripcionEvento`, `razonSocial`, `correoContacto`, `tlfContacto`, `cartaSolicitud`, `tipoCita`, `estadoCita`, `cedCliente`) VALUES (?,?,?,?,?,?,?,?,?,?,?,1,?)");

			$registroCita->bindValue(1, $this->nombreEvento);
			$registroCita->bindValue(2, $this->fechaCita);
			$registroCita->bindValue(3, $this->horaCita);
			$registroCita->bindValue(4, $this->servicio);
			$registroCita->bindValue(5, $this->espacio);
			$registroCita->bindValue(6, $this->descripcion);
			$registroCita->bindValue(7, $this->razonSocial);
			$registroCita->bindValue(8, $this->correoContacto);
			$registroCita->bindValue(9, $this->numerotlfno);
			$registroCita->bindValue(10, $this->pdf);
			$registroCita->bindValue(11, $this->tipoCita);
			$registroCita->bindValue(12, $this->cedCliente);
			$registroCita->execute();
			
		} catch (Exception $error) {
			
			return $error;
		}
	}

	
	public function consultarCita() {

		$consultaCita = $this->conex->prepare("SELECT `nroCita`, `nombreEvento`, `servicio`, `fechaCita`, `horaCita`, `tipoCita`, `estadoCita`  FROM `tblcitasreservacion` WHERE (`estadoCita` = 1 OR `estadoCita` = 2) AND `fechaCita` >= CURDATE() ORDER BY `fechaCita`, `horaCita` ASC");

		$consultaCita->execute();

		$mostrarCita = $consultaCita->fetchAll(\PDO::FETCH_OBJ);

		echo json_encode($mostrarCita);
		die();

	}

	public function obtenerCita($nroCita) {

		if (preg_match_all("/^[0-9]{1,8}$/", $nroCita)) {
			
			$this->nroCita =  $nroCita; 

		} else {
			
			$respuesta = array("status" => 0, "descripcion" => "El número de cita Solicitado es invalido");
			echo json_encode($respuesta);
			die();
		}

		$horarioCita = $this->conex->prepare("SELECT `nroCita`, `fechaCita`, `horaCita`  FROM `tblcitasreservacion` WHERE (`estadoCita` = 1 OR `estadoCita` = 2) AND `nroCita` = ?");

		$horarioCita->bindValue(1, $this->nroCita);
		$horarioCita->execute();

		$mostrarHorario = $horarioCita->fetchAll(\PDO::FETCH_OBJ);

		if (isset($mostrarHorario[0])) {
		 	
		 	echo json_encode($mostrarHorario);
		 	die();
		
		} else {

			$respuesta = array("status" => 0, "descripcion" => "No se ha Encontrado la Cita Solicitada");
			echo json_encode($respuesta);
			die();
		}
	}


	public function getCita($numCita) {

		if (preg_match_all("/^[0-9]{1,8}$/", $numCita)) {
			
			$this->nroCita =  $numCita; 

		} else {
			die("<script>window.location='?url=dashboard'</script>");
		}

		$getCita = $this->conex->prepare("SELECT * FROM `tblcitasreservacion` INNER JOIN `tblclientes` ON tblcitasreservacion.cedCliente = tblclientes.cedulaCliente WHERE `nroCita` = ? AND (`estadoCita` = 1 OR `estadoCita` = 2)");
		$getCita-> bindValue(1, $this->nroCita);
		$getCita->execute();

		$detalles = $getCita->fetchAll();


		if (isset($detalles[0])) {
			
			return $detalles;
		} else {

			die("<script>window.location='?url=cita&type=consultar'</script>");
		}
	}

	public function verificarCita ($numeroCita, $estadoCita) {

		$this->numeroCita = $numeroCita;
		$this->estadoCita = $estadoCita;

		return $this->actualizarCita();
	}

	private function email($solicitud, $respuesta){

		$mail = new PHPMailer(true);
	 		try {
		    //Server settings
		    $mail->SMTPDebug = 0;                      
		    $mail->isSMTP();                                            
		    $mail->Host       = 'smtp.gmail.com';                     
		    $mail->SMTPAuth   = true;                                   
		    $mail->Username   = 'soportefundacionteatrojuares@gmail.com';                     
		    $mail->Password   = 'pldzbnydfcilkxco';     //bpkgtozbnvukggbs gisel                
		    $mail->SMTPSecure = 'tls';           
		    $mail->Port       = 587;                                    
		    //emisor y receptor
		    $mail->setFrom('soportefundacionteatrojuares@gmail.com', 'Fundacion Teatro Juares');
		    $mail->addAddress('sabrii.colmenarez@gmail.com', 'gm');     
		    
		    //Contenido de correo(HTML)
		    $mail->isHTML(true);                                  
		    $mail->Subject = 'Respuesta a la Solicitud de Cita Fundacion Teatro Juares';
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
			                                  <div data-role="module-unsubscribe" class="module unsubscribe-css__unsubscribe___2CDlR" role="module" data-type="unsubscribe" style="background-color:#ebebeb;color:#7a7a7a;font-size:11px;line-height:20px;padding:30px 0px 30px 0px;text-align:center; height: 90px; height: 70px;"><h1 style="margin-top: -10px; color: #000;" >Respuesta A Su Solicitud de Cita</h1> <img src="https://cdn-icons-png.flaticon.com/512/942/942748.png" width="90px" height="75px" style="margin-top: -10px;"></div>
			                                </td>
			                              </tr>
			                            </table>

			                         
			                            <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;">
			                              <tr>
			                                <td style="padding:25px 20px 25px 20px;line-height:20px;text-align:inherit;"
			                                    height="100%"
			                                    valign="top"
			                                    bgcolor="">
			                                    <h2 style="text-align: center; color:#831B36;">Estimado/a Solicitante</h2>
			                                   <p style="color: #000;" align="justify">El Equipo de La Fundación Teatro Juares ha recibido y leido su solicitud de cita para Reservar uno de nuestros espacios, de esta manera, le informamos qué:</p>
			                                   <h2 style="color: #000;font-weight:bold;" align="center">Su Solicitud ha sido '.$solicitud.'</h2>
			                                   <p style="color: #000;" align="justify">'.$respuesta.'</p>
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
			                                   <div style="text-align: center;"><span style="color:#7a7a7a;"><span style="font-size:11px; color: #000;">Si Tiene alguna Duda Por Favor Comunicarse al Correo:</span><br><span style="font-size:11px; color: #000;">soportefundacionteatrojuares@gmail.com</span></span></div>
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
		    header('Location:'._ROUTE_.'?url=cita&type=consultar');	
			}catch (Exception $e){
		    echo '<h3 style="color:#bec0c3;font-family:Courier;margin-left:20px;"><b>Error al enviar correo electronico</b></h3>', $mail->ErrorInfo;
			}
	}

	private function actualizarCita() {

		try {
		
			$actualizarCita = $this->conex->prepare("UPDATE `tblcitasreservacion` SET `estadoCita` = ? WHERE `nroCita` = ?");
			$actualizarCita->bindValue(1, $this->estadoCita);
			$actualizarCita->bindValue(2, $this->numeroCita);
			$actualizarCita->execute();

			if ($this->estadoCita == 2) {
				
				return $this->email("Aceptada", "Nos complace informarle que estamos interesados en su evento, es por eso que queremos invitarle a nuestras instalaciones en la fecha y hora pautada, recuerde ser puntual ya que se suele atender varias citas al día.");
			} else {

				return $this->email("Rechazada", "Lamentamos informarle que su solicitud ha sido denegada, no existe un espacio libre para la correcta atención de su persona en la fecha y hora solicitada, le invitamos que intente solicitar su cita nuevamente, muchas gracias por preferirnos.");
			}

		} catch (Exception $error) {
			
		}
	}

	public function getModificarCita($nroCita, $fechaNueva, $horaNueva) {

		if (preg_match_all("/^[0-9]{1,6}$/", $nroCita)) {
			
			$this->nroCita =  $nroCita; 

		} else {
			
			$respuesta = array("status" => 0, "descripcion" => "El número de cita Solicitado es invalido");
			echo json_encode($respuesta);
			die();
		}

		if (!isset($fechaNueva) && !isset($horaNueva)) {
			
			$respuesta = array("status" => 0, "descripcion" => "Todos los campos están vacíos");
				echo json_encode($respuesta);
				die();
		}

		date_default_timezone_set("America/Caracas");

		$hoy = date("Y-m-d");
		$horaHoy = date("H:i:s");
		$valFecha = strtotime("{$hoy}+1 year");

		if (isset($fechaNueva)) {

			if (strtotime($fechaNueva) >= strtotime($hoy)) {

				if (strtotime($fechaNueva) < $valFecha) {

					$this->fechaNueva = $fechaNueva;
				} else {

					$respuesta = array("status" => 0, "descripcion" => "No Se Puede Agendar Una Cita En Un Plazo Mayor a Un Año, Ingrese Otra Fecha");
					echo json_encode($respuesta);
					die();
				}		
			
			} else {

				$respuesta = array("status" => 0, "descripcion" => "La fecha ingresada es Invalida");
				echo json_encode($respuesta);
				die();

			}
		
		}

		if (isset($horaNueva)) {

			$horaRegistro = ((substr($horaNueva,0, 2) * 60)*60) + (substr($horaNueva, 3, 5)* 60);

	
			if (strtotime($fechaNueva) == strtotime($hoy)) {
				
				if (strtotime($horaNueva) > strtotime($horaHoy)) {
						
					$this->horaNueva = $horaNueva;
					
				} else {

				$respuesta = array("status" => 0, "descripcion" => "La hora ingresada es Invalida");
				echo json_encode($respuesta);
				die();
					
				}
			
			}

			else if (($horaRegistro < 28800) || ($horaRegistro > 64800)) {

				$respuesta = array("status" => 0, "descripcion" => "La hora ingresada es Invalida");
				echo json_encode($respuesta);
				die();

			} else {

				$this->horaNueva = $horaNueva;
			}
		}

		if (isset($this->horaNueva) && isset($this->fechaNueva)) {
				
				$sql = "UPDATE `tblcitasreservacion` SET `fechaCita` = :fechaCita, `horaCita` = :horaCita WHERE `nroCita` = :nroCita";

				$execute = array(':fechaCita' => $this->fechaNueva, ':horaCita' => $this->horaNueva, ':nroCita' => $this->nroCita);
		}

		elseif (isset($this->fechaNueva) && !isset($this->horaNueva)) {

			$sql = "UPDATE `tblcitasreservacion` SET `fechaCita` = :fechaCita WHERE `nroCita` = :nroCita";

			$execute = array(':fechaCita' => $this->fechaNueva, ':nroCita' => $this->nroCita);
		}

		elseif (!isset($this->fechaNueva) && isset($this->horaNueva)) {

			$sql = "UPDATE `tblcitasreservacion` SET `horaCita` = :horaCita WHERE `nroCita` = :nroCita";

			$execute = array(':horaCita' => $this->horaNueva, ':nroCita' => $this->nroCita);
		}

		if (isset($this->fechaNueva) && isset($this->horaNueva)) {

			$validacion = $this->conex->prepare("SELECT `fechaCita`, `horaCita`  FROM `tblcitasreservacion` WHERE `fechaCita` = ? AND `horaCita` = ? AND `nroCita` != ?");
			$validacion->bindValue(1, $this->fechaNueva);
			$validacion->bindValue(2, $this->horaNueva);
			$validacion->bindValue(3, $this->nroCita);
			$validacion->execute();
			$val = $validacion->fetchAll();

			if (isset($val[0]["fechaCita"])&&isset($val[0]["horaCita"])) {
					
				$respuesta = array("status" => 0, "descripcion" => "Error! Ya existe una Cita con la Fecha y Hora Ingresada");
				echo json_encode($respuesta);
				die();
			}
			
		}

		return $this->modificarCita($sql, $execute);
				
	}

	private function modificarCita($sql, $execute) {

		try {
			
			$modificarCita = $this->conex->prepare($sql);
			$modificarCita->execute($execute);

			$respuesta = array("status" => 1, "descripcion" => "La modificación se ha realizado exitosamente");
				echo json_encode($respuesta);
				die();


		} catch (Exception $error) {
			
			return $error;
		
		}

	}

	public function getAnularCita($botonAnular) {

		if (preg_match_all("/^[0-9]{1,6}$/", $botonAnular)) {
			
			$this->nroCita =  $botonAnular; 

		} else {
			
			$respuesta = array("status" => 0, "descripcion" => "El número de cita Solicitado es invalido");
			echo json_encode($respuesta);
			die();
		}

		$consultaCita = $this->conex->prepare("SELECT `nroCita` FROM `tblcitasreservacion` WHERE `nroCita` = ?");
		$consultaCita->bindValue(1, $this->nroCita);
		$consultaCita->execute();

		$validate = $consultaCita->fetchAll();

		if (isset($validate[0])) {
			return 	$this->anularCita();
		} else {
			$respuesta = array("status" => 0, "descripcion" => "No se ha podido anular la Cita");
			echo json_encode($respuesta);
			die();
		}

		
	}

	private function anularCita() {

		try {
			
			$anularCita = $this->conex->prepare("UPDATE `tblcitasreservacion` SET `estadoCita` = 3 WHERE `nroCita` = ?");

			$anularCita->bindValue(1, $this->nroCita);
			$anularCita->execute();

			$respuesta = array("status" => 1, "descripcion" => "Cita anulada Exitosamente");
			echo json_encode($respuesta);
			die();


		} catch (Exception $error) {
			
			return $error;
		}
	}

	public function reporteCita($fechaInicial, $fechaFinal, $estadoCita, $tipoCita) {

		date_default_timezone_set("America/Caracas");

		$hoy = date("Y-m-d");

		$valFecha = strtotime("{$hoy}+1 year");

		if (isset($fechaInicial) || strtotime($fechaInicial) < strtotime(date("Y-m-d")) || strtotime($fechaInicial) < strtotime($fechaFinal)) {
				
			$this->fechaInicial = $fechaInicial;

		} else {

			$respuesta = array("status" => 0, "descripcion" => "Fecha Inicial Invalida");
			echo json_encode($respuesta);
			die();
		}

		if (isset($fechaFinal) || strtotime($fechaFinal) > strtotime($fechaInicial)) {
			
			if ( strtotime($fechaFinal) < $valFecha) {

					$this->fechaFinal = $fechaFinal;
				}else {

					$respuesta = array("status" => 0, "descripcion" => "La Fecha Final Es Mayor a Un Año, Ingrese Una Menor");
					echo json_encode($respuesta);
					die();
				}	
		} else {

			$respuesta = array("status" => 0, "descripcion" => "Fecha Final Invalida");
			echo json_encode($respuesta);
			die();
		}

		if (preg_match_all("/^[0-4\-]{1}$/", $estadoCita)) {
			
			$this->estadoCita = $estadoCita;

		} else {

			$respuesta = array("status" => 0, "descripcion" => "Estado invalido");
			echo json_encode($respuesta);
			die();
		}
		
		if (preg_match_all("/^[0-2\-]{1}$/", $tipoCita)) {
			
			$this->tipoCita = $tipoCita;

		} else {

			$respuesta = array("status" => 0, "descripcion" => "Tipo de Cita invalida");
			echo json_encode($respuesta);
			die();
		}

		if (isset($this->fechaInicial) && isset($this->fechaFinal) && $this->estadoCita != 4 && $this->tipoCita != 0) {
			
			$sql = "SELECT  `nombreEvento`, `fechaCita`, `horaCita`, `servicio`, `espacio`, `razonSocial`, `tipoCita`, `estadoCita` FROM `tblcitasreservacion` WHERE `fechaCita` BETWEEN :fechaInicial AND :fechaFinal AND `estadoCita`= :estadoCita  AND `tipoCita` = :tipoCita ORDER BY `fechaCita` ASC";
			
			$execute = array(':fechaInicial' => $this->fechaInicial, ':fechaFinal' => $this->fechaFinal, ':estadoCita' => $this->estadoCita, ':tipoCita' => $this->tipoCita);
		}

		else if (isset($this->fechaInicial) && isset($this->fechaFinal) && $this->estadoCita == 4 && $this->tipoCita != 0) {

			$sql = "SELECT  `nombreEvento`, `fechaCita`, `horaCita`, `servicio`, `espacio`, `razonSocial`, `tipoCita`, `estadoCita` FROM `tblcitasreservacion` WHERE `fechaCita` BETWEEN :fechaInicial AND :fechaFinal AND `tipoCita` = :tipoCita ORDER BY `fechaCita` ASC";

			$execute = array(':fechaInicial' => $this->fechaInicial, ':fechaFinal' => $this->fechaFinal,':tipoCita' => $this->tipoCita);
		}

		else if (isset($this->fechaInicial) && isset($this->fechaFinal) && $this->estadoCita != 4 && $this->tipoCita == 0) {

			$sql = "SELECT  `nombreEvento`, `fechaCita`, `horaCita`, `servicio`, `espacio`, `razonSocial`, `tipoCita`, `estadoCita` FROM `tblcitasreservacion` WHERE `fechaCita` BETWEEN :fechaInicial AND :fechaFinal AND `estadoCita`= :estadoCita ORDER BY `fechaCita` ASC";
			
			$execute = array(':fechaInicial' => $this->fechaInicial, ':fechaFinal' => $this->fechaFinal, ':estadoCita' => $this->estadoCita);

		}

		else if (isset($this->fechaInicial) && isset($this->fechaFinal) && $this->estadoCita == 4 && $this->tipoCita == 0) {

			$sql = "SELECT  `nombreEvento`, `fechaCita`, `horaCita`, `servicio`, `espacio`, `razonSocial`, `tipoCita`, `estadoCita` FROM `tblcitasreservacion` WHERE `fechaCita` BETWEEN :fechaInicial AND :fechaFinal ORDER BY `fechaCita` ASC";
			
			$execute = array(':fechaInicial' => $this->fechaInicial, ':fechaFinal' => $this->fechaFinal);

		} else {

			$respuesta = array("status" => 0, "descripcion" => "Ingrese Parámetros Correcto Para Elaborar el Reporte");
			echo json_encode($respuesta);
			die();
		}


		try {
			
			$consultaReporte = $this->conex->prepare($sql);

			$consultaReporte->execute($execute);

			$mostrarReporte = $consultaReporte->fetchAll();

			if (isset($mostrarReporte[0])) {
				
				$pdf = new reporteModelo();

				$pdf->SetTitle("Reporte de Citas");

				return $pdf->crearReporteCita($mostrarReporte);

			} else {

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
	            				title: 'No Existen Citas con la Solicitud Ingresada'
	          				})
	       				</script>");
			}

		} catch (Exception $error) {
		
			return $error;	
		
		}
		
	}
}

 ?>
<html>
<head>
<title>Ayuda</title>
<link rel="stylesheet" type="text/css" href="assets/css/ayuda.css">
</head>
<body class="main">


	<?php $_comp->_varSocial(); 
	$_comp->navInicio();
	?>

		<!-- sesion de ayuda -->

		<main>
		<h2 class="titulo">Preguntas Frecuentes <i class="fa-solid fa-magnifying-glass"></i></h2>
		<hr class="hr1">
		<div class="categorias" id="categorias">
			<div class="categoria activa" data-categoria="registro-Inicio">
				<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path d="M12 2c2.757 0 5 2.243 5 5.001 0 2.756-2.243 5-5 5s-5-2.244-5-5c0-2.758 2.243-5.001 5-5.001zm0-2c-3.866 0-7 3.134-7 7.001 0 3.865 3.134 7 7 7s7-3.135 7-7c0-3.867-3.134-7.001-7-7.001zm6.369 13.353c-.497.498-1.057.931-1.658 1.302 2.872 1.874 4.378 5.083 4.972 7.346h-19.387c.572-2.29 2.058-5.503 4.973-7.358-.603-.374-1.162-.811-1.658-1.312-4.258 3.072-5.611 8.506-5.611 10.669h24c0-2.142-1.44-7.557-5.631-10.647z"/></svg>
				<p>Usuario</p>
			</div>
			<div class="categoria" data-categoria="cartelera">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.266 7l12.734-2.625-.008-.042-1.008-4.333-21.169 4.196c-1.054.209-1.815 1.134-1.815 2.207v14.597c0 1.657 1.343 3 3 3h18c1.657 0 3-1.343 3-3v-14h-12.734zm8.844-5.243l2.396 1.604-2.994.595-2.398-1.605 2.996-.594zm-5.898 1.169l2.4 1.606-2.994.595-2.401-1.607 2.995-.594zm-5.904 1.171l2.403 1.608-2.993.595-2.406-1.61 2.996-.593zm-2.555 5.903l2.039-2h3.054l-2.039 2h-3.054zm4.247 10v-7l6 3.414-6 3.586zm4.827-10h-3.054l2.039-2h3.054l-2.039 2zm6.012 0h-3.054l2.039-2h3.054l-2.039 2z"/></svg>
				<p>Cartelera</p>
			</div>
			<div class="categoria" data-categoria="citas">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15 12h-10v1h10v-1zm-4 2h-6v1h6v-1zm4-6h-10v1h10v-1zm0 2h-10v1h10v-1zm0-6h-10v1h10v-1zm0 2h-10v1h10v-1zm7.44 10.277c.183-2.314-.433-2.54-3.288-5.322.171 1.223.528 3.397.911 5.001.089.382-.416.621-.586.215-.204-.495-.535-2.602-.82-4.72-.154-1.134-1.661-.995-1.657.177.005 1.822.003 3.341 0 6.041-.003 2.303 1.046 2.348 1.819 4.931.132.444.246.927.339 1.399l3.842-1.339c-1.339-2.621-.693-4.689-.56-6.383zm-6.428 1.723h-13.012v-16h14v7.894c.646-.342 1.348-.274 1.877.101l.123-.018v-8.477c0-.828-.672-1.5-1.5-1.5h-15c-.828 0-1.5.671-1.5 1.5v17c0 .829.672 1.5 1.5 1.5h13.974c-.245-.515-.425-1.124-.462-2z"/></svg>
				<p>Citas</p>
			</div>
			<div class="categoria" data-categoria="cuenta">
				<svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M9.484 15.696l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm0-5l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm0-5l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm10.516 11.304h-8v1h8v-1zm0-5h-8v1h8v-1zm0-5h-8v1h8v-1zm4-5h-24v20h24v-20zm-1 19h-22v-18h22v18z"/></svg>
				<p>Compras</p>
			</div>
		</div>

		<div class="preguntas">

			<!-- Registro e Inicio de sesion -->
			<div class="contenedor-preguntas activo" data-categoria="registro-Inicio" style="background: #FFC588">
				<div class="contenedor-pregunta" >
					<p class="pregunta">¿Como puedo Registrarme? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta"> Realizar el  registro es muy facil solo debe de seguir los siguientes pasos<br><br>

						<b style="color:blue">1-</b> Al ingresar a nuestro Pagina Web <b style="color: #AE1B2B">Fundacion Teatro Juares</b> dispone de una opcion <i>Registro de usuario</i> preciona el boton titulado <b>Registrate Aqui</b>; Visualiza la imagen presentada a continuacion. <br>
						<img src="assets/img/sist/inicio.jpg" class="im"><br><br><br>

						<b style="color:blue">2-</b> Se mostrara un formulario de Registro de usuario; Visualiza la imagen presentada a continuacion. <br> 
						<img src="assets/img/sist/formularioRegistro.jpg" class="im"><br><br><br>

						<b style="color:blue">3-</b> Ingresa los datos solicitados en todos los campos una vez finalizado todo el formulario presiona el boton de <b>Enviar</b> el sistema mostrara un mensaje de registro exitoso y listo ya estas registrado en nuestra Pagina web <b style="color: #AE1B2B">Fundacion Teatro Juares</b>.
					</p>
				</div>
				<div class="contenedor-pregunta">
					<p class="pregunta">¿Como Iniciar Sesion? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Iniciar sesion es muy facil solo debe de seguir los siguientes pasos<br><br>

						<b style="color:blue">1-</b> Al ingresar a nuestro Pagina Web <b style="color: #AE1B2B">Fundacion Teatro Juares</b> dispone de una opcion <i>iniciar sesion</i> haz clic en el boton titulado <b>Iniciar sesion</b> el cual se muestra en la parte superior derecha de nuestro menu.<br>
						Ten en cuenta que para iniciar sesion debes de haber realizado en registro de usuario previamente; Sino conoces como hacerlo te invitamos a visializar la pregunta anterior mostrada en esta sesion de ayuda; Visualiza la imagen presentada a continuacion.<br>
						<img src="assets/img/sist/boton sesion.jpg" class="im"><br><br><br>

						<b style="color:blue">2-</b> Se mostrara un formulario de <b>Inicio de sesion</b>; Visualiza la imagen presentada a continuacion.<br>
						<img src="assets/img/sist/login.jpg" class="im"><br><br><br>

						<b style="color:blue">3-</b> Ingresa los datos solicitados en los dos campos presentados (<i>cedula de identidad y contraseña</i>) una vez finalizado presiona el boton <b>iniciar sesion</b> y listo ya has iniciado sesion correctamente y podras visualizar tu perfil de usuario.
					</p>
				</div>
				<div class="contenedor-pregunta">
					<p class="pregunta">¿Como puedo cambiar mi contraseña en caso de olvido? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Cambiar la contraseña es muy facil solo debe de seguir los siguientes pasos<br><br>

						<b style="color:blue">1-</b> Haz clic en el apartado Recuperar Contraseña en el cual se muestra en el formulario de inicio de sesion;Visualiza la imagen presentada a continuacion.<br>
						<img src="assets/img/sist/recuperar contra.jpg" class="im"><br><br><br>

						<b style="color:blue">2-</b> Se presentara un formulario en el cual debe se ingresar su correo electronico con el cual se registro, haz clic en siguiente; Visualiza la imagen presentada a continuacion.<br>
						<img src="assets/img/sist/recuperarContraseña.jpg" class="im"><br><br>

						<b style="color:blue">3-</b> Se enviara un correo electronico a la direccion electronica que haz ingresado anteriormente el correo se mostrara asi;Visualiza la imagen presentada a continuacion.<br>
						<img src="assets/img/sist/correo.jpg" class="im"><br><br><br>

						<b style="color:blue">4-</b>Lee atentamente el correo electronico, si estas de acuerdo presiona el boton de <b>Ingresar nueva contraseña</b> una vez presionado el boton se mostrara un formulario de  cambio de contraseña;Visualiza la imagen presentada a continuacion.<br>
						<img src="assets/img/sist/nuevaContraseña.jpg" class="im"><br><br><br>

						<b style="color:blue">5-</b>Ahora debes de ingresar la nueva contraseña que deseas, repite nuevamente la contraseña para confirmar que coincidan, presiona el boton de finalizar y listo ya puedes iniciar sesion con tu nueva contraseña.
					</p>
				</div>
			</div>

			<!-- Cartelera -->
			<div class="contenedor-preguntas" data-categoria="cartelera"  style="background: #FFC588">
				
				<div class="contenedor-pregunta">
					<p class="pregunta">¿Como consultar evento en cartelera? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Consultar un evento en cartelera es muy facil solo debes de seguir estos pasos para poder visualizar las funciones o eventos disponibles en nuestras instalaciones <b>Fundacion Teatro Juares</b> Sigue los siguientes pasos.<br><br>

						<b style="color:blue">1-</b>Ingresa es nuestra Pagina Web <b style="color: #AE1B2B">Fundacion Teatro Juares</b> y las clic en la barrita superior del lado izquierdo;Visualiza la imagen presentada a continuacion.<br>
						<img src="assets/img/sist/inicio.jpg" class="im"><br><br><br>
						Al hacer clic sobre ella encontraras un menu lateral mostrando las siguientes opciones; Visualiza la imagen presentada a continuacion.<br>
						<img src="assets/img/sist/menuLateral.jpg" class="im"><br><br><br>

						<b style="color:blue">2-</b>Preciona el apartado de <b>Cartelera</b> en la cual podras visualizar los eventos disponible y contraras informacion detallada sobre el evento .<br>
						<img src="assets/img/sist/cartelera.jpg" class="im"><br><br><br>
						Listo ya podras visualizar y consultar los eventos disponibles en cartelera.
					</p>
				</div>

			</div>

			<!-- Citas-->
			<div class="contenedor-preguntas" data-categoria="citas" style="background: #FFC588">
				<div class="contenedor-pregunta">
					<p class="pregunta">¿Como puedo realizar solicitud de cita? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta"> Solicitar una cita para un evento o funcion debes tener en cuenta los siguientes pasos<br><br>

						<b style="color:blue">1-</b>Ingresa es nuestra Pagina Web <b style="color: #AE1B2B">Fundacion Teatro Juares</b> y las clic en la barrita superior del lado izquierdo;Visualiza la imagen presentada a continuacion.<br>
						<img src="assets/img/sist/inicio.jpg" class="im"><br><br>
						Al hacer clic sobre ella encontraras un menu lateral mostrando las siguientes opciones; Visualiza la imagen presentada a continuacion.<br>
						<img src="assets/img/sist/menuLateral.jpg" class="im"><br><br><br>

						<b style="color:blue">2-</b>Preciona el apartado de <b>citas</b> luego se presentara un formulario de solicitud de cita, debes de leer el aviso y descargar el formato de carta,llenar los datos solicitados y luego procede a rellenar los campos solicitados en el formulario.<br>
						<img src="assets/img/sist/solicitud Cita.jpg" class="im"><br><br><br>

						Una vez llenado todos los campos preciona el boton de <b>Enviar</b> en la breveda posible seras contactado por el personal encargado para concretar tu cita.
					</p>
				</div>
				<div class="contenedor-pregunta">
					<p class="pregunta">¿Que pasa con mis datos personales agregados en en formulario de cita? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Los datos ingresados en el formulario de cita seran enviados al Gerente de Produccion de la <b style="color: #AE1B2B">Fundacion Teatro Juares</b> sera el encargado de revisar tu <b>Solicitud de cita</b> consultar si cumples con las normativas expuestas por la Fundacion y contactarte para mutuos acuerdo en planificacion del evento solicitado.</p>
				</div>
			</div>

			<!-- Preguntas Cuenta -->
			<div class="contenedor-preguntas" data-categoria="cuenta" style="background: #FFC588">
				<div class="contenedor-pregunta">
					<p class="pregunta">¿Como puedo comprar un boleto para un evento o funcion? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Sigue los siguientes pasos para la compra de boletos en la <b>Fundacion Teatro Juares</b><br><br>
						<b style="color:blue">1-</b>Debes de realizar la consulta de los eventos en cartelera; en la seccion de cartelera encontraras los pasos para consultar la cartelera de eventos.<br>
						Se debe de precionar el apartado de comprar boleto.<br><br>

						<b style="color:blue">2-</b>Se debe de consultar la cedula de identidad y en caso de no estar registrado se debe de registrar al cliente<br> Se abrira un formulario en donde debes de selccionar el metodo de pago, en este caso si es transferecia, pago movil, pago por punto de venta o efectivo.<br>ia y la fecha de realizacion de pago.
						En cualquier metodo de pago debes de introducir la referencia bancaria.<br><br>

						<b style="color:blue">3-</b> Se debe en enviar los datos para ser validados y con breve seras conctatado para el retiro de tu boleto.

					</p>
				</div>
			</div>
		</div>
	</main>

	<?php $_comp->footer(); ?>

	<script src="assets/js/categorias.js"></script>
	<script src="assets/js/preguntasFrecuentes.js"></script>
</body>
</html>		
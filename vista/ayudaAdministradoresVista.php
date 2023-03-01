<html>
<head>
<?php $_css->heading(); ?>
<title>Ayuda</title>
<link rel="stylesheet" type="text/css" href="assets/css/ayudaAdministradores.css">

</head>
<body class="main">


	<?php
	 $_comp->navInicioAdmin(); 
	?>

		<div class="card mb-4 mt-4">
            <div class="card-header card-header-principal">
				<i class="fa-solid fa-gears iconTitle"></i>
                <h1 class="m-0 d-inline">Ayuda Administradores</h1>
            </div>
			<nav style="--bs-breadcrumb-divider: '>';" class="p-2 nav-Breadcrumb" >
  				<ol	ol class="breadcrumb">
   					<li class="breadcrumb-item"><i class="fa-solid fa-house me-2"></i><a href="?url=dashboard">Panel de Control</a></li>
   					<li class="breadcrumb-item"><a href="?url=dashboard&type=ayuda">Ayuda</a></li>
  				</ol>
			</nav>
		</div>

		<!-- sesion de ayuda -->

		<main>
		<h2 class="titulo">Consulta <i class="fa-solid fa-magnifying-glass"></i></h2>
		<hr class="hr1">
		<div class="categorias" id="categorias">

			<div class="categoria uno activa " data-categoria="dashboard" >
				<svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m7.73 16.4c0-.53-.47-1-1-1h-3.73c-.53 0-1 .47-1 1v2.6c0 .53.47 1 1 1h3.73c.53 0 1-.47 1-1zm14.27 0c0-.53-.47-1-1-1h-3.73c-.53 0-1 .47-1 1v2.6c0 .53.47 1 1 1h3.73c.53 0 1-.47 1-1zm-7.135-.084c0-.53-.47-1-1-1h-3.73c-.53 0-1 .47-1 1v2.6c0 .531.47 1 1 1h3.73c.53 0 1-.469 1-1zm7.135-11.316c0-.53-.47-1-1-1h-18c-.53 0-1 .47-1 1v8c0 .53.47 1 1 1h18c.53 0 1-.47 1-1z" fill-rule="nonzero"/></svg>
				<p>Dashboard</p>
			</div>

			<div class="categoria dos" data-categoria="personal">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10.118 16.064c2.293-.529 4.428-.993 3.394-2.945-3.146-5.942-.834-9.119 2.488-9.119 3.388 0 5.644 3.299 2.488 9.119-1.065 1.964 1.149 2.427 3.394 2.945 1.986.459 2.118 1.43 2.118 3.111l-.003.825h-15.994c0-2.196-.176-3.407 2.115-3.936zm-10.116 3.936h6.001c-.028-6.542 2.995-3.697 2.995-8.901 0-2.009-1.311-3.099-2.998-3.099-2.492 0-4.226 2.383-1.866 6.839.775 1.464-.825 1.812-2.545 2.209-1.49.344-1.589 1.072-1.589 2.333l.002.619z"/></svg>
				<p>Personal</p>
			</div>
			<div class="categoria tres" data-categoria="clientes">
				<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path d="M12 2c2.757 0 5 2.243 5 5.001 0 2.756-2.243 5-5 5s-5-2.244-5-5c0-2.758 2.243-5.001 5-5.001zm0-2c-3.866 0-7 3.134-7 7.001 0 3.865 3.134 7 7 7s7-3.135 7-7c0-3.867-3.134-7.001-7-7.001zm6.369 13.353c-.497.498-1.057.931-1.658 1.302 2.872 1.874 4.378 5.083 4.972 7.346h-19.387c.572-2.29 2.058-5.503 4.973-7.358-.603-.374-1.162-.811-1.658-1.312-4.258 3.072-5.611 8.506-5.611 10.669h24c0-2.142-1.44-7.557-5.631-10.647z"/></svg>
				<p>Clientes</p>
			</div>
			<div class="categoria cuatro" data-categoria="eventos">
				<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24"><path d="M0 1v22h24v-22h-24zm4 20h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2v-2h2v2zm14 16h-12v-8h12v8zm0-10h-12v-8h12v8zm4 10h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2v-2h2v2z"/></svg>
				<p>Eventos</p>
			</div>
			<div class="categoria cinco" data-categoria="ventas">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm1 16.947v1.053h-1v-.998c-1.035-.018-2.106-.265-3-.727l.455-1.644c.956.371 2.229.765 3.225.54 1.149-.26 1.384-1.442.114-2.011-.931-.434-3.778-.805-3.778-3.243 0-1.363 1.039-2.583 2.984-2.85v-1.067h1v1.018c.724.019 1.536.145 2.442.42l-.362 1.647c-.768-.27-1.617-.515-2.443-.465-1.489.087-1.62 1.376-.581 1.916 1.712.805 3.944 1.402 3.944 3.547.002 1.718-1.343 2.632-3 2.864z"/></svg>
				<p>Ventas</p>
			</div>
			<div class="categoria seis" data-categoria="reportes">
				<svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M9.484 15.696l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm0-5l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm0-5l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm10.516 11.304h-8v1h8v-1zm0-5h-8v1h8v-1zm0-5h-8v1h8v-1zm4-5h-24v20h24v-20zm-1 19h-22v-18h22v18z"/></svg>
				<p>Reportes</p>
			</div>
		</div>

		<div class="preguntas">

			<!-- dashboard -->
			<div class="contenedor-preguntas activo" data-categoria="dashboard" style="background: #f2f5f5">
				<div class="contenedor-pregunta" >
					<p class="pregunta">¿Que es un Dashboard o Panel de Control? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Un dashboard es una herramienta de gestión de la información que monitoriza, analiza y muestra de manera visual los indicadores clave de desempeño y datos fundamentales para hacer un seguimiento del estado de una empresa, una campaña o un proceso específico.<br>

					Podemos pensar en el dashboard como una especie de "resumen" que recopila datos de diferentes fuentes en un solo sitio y los presenta de manera digerible para que lo más importante salte a la vista.<br>

					De esta menera a continuacion se presenta el Dashboard del <b  style="color: #AE1B2B">Sistema de Gestion de Ventas de la Fundacion Teatro Juares.</b><br><br>

					<img src="assets/img/sist2/panel1.jpg" class="im">
					<img src="assets/img/sist2/panel2.jpg" class="im">
					</p>
				</div>

				<div class="contenedor-pregunta" >
					<p class="pregunta">¿Que herramientas ofrece el Dashboard o Panel de Control? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">
						<b style="color:blue">1-</b> Menu desplegable<br>

						Para visualizar el menu de opciones debes de precionar el boton que se muestra en pantalla<br>
						<img src="assets/img/sist2/preciona.jpg" class="im">

						Luego de realizar este paso se abrira este menu lateral de opciones<br>
						<img src="assets/img/sist2/menu lateral.jpg" class="im"><br>

						Este menu mostrara las opciones principales del Dashboard o panel de control las cuales tambien se muestran a continuacion<br>
						<img src="assets/img/sist2/estadisticas.jpg" class="im"><br><br><br>

						<b style="color:blue">2-</b> Estadisticas<br>
						Aqui podras observar las ultimas ventas realizadas<br><br>
						<img src="assets/img/sist2/ultimas ventas.jpg" class="im"><br><br><br>

						<b style="color:blue">3-</b >Proximas citas<br>
						Aqui podras observas las proximas citas que tengas pendientes<br><br>
						<img src="assets/img/sist2/proximas citas.jpg" class="im"><br><br><br>

						<b style="color:blue">4-</b> Ventas de boletos<br>
						Aqui podras observar las estadisticas de las ventas de boletos<br><br>
						<img src="assets/img/sist2/venta de boletos.jpg" class="im"><br><br><br>

						<b style="color:blue">5-</b> Notificaciones<br>
						Aqui podras observar las notificaciones que recibes<br><br>
						<img src="assets/img/sist2/notificaciones.jpg" class="im"><br><br><br>


					</p>
				</div>
			</div>

			<!-- personal -->
			<div class="contenedor-preguntas" data-categoria="personal" style="background: #f2f5f5">
				<div class="contenedor-pregunta" >
					<p class="pregunta">¿Como realizar la  gestion de personal? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta"> Realizar la gestion de personal es muy facil solo debe de seguir los siguientes pasos<br><br>

					<b style="color:blue">1-</b> Al iniciar sesion en  nuestro Pagina Web <b style="color: #AE1B2B">Fundacion Teatro Juares</b> modo administrador dispone de una opcion titulada <b>Personal</b>  haz clic en el boton titulado; Visualiza la imagen presentada a continuacion. <br>
					<img src="assets/img/sist2/personal.jpg" class="im"><br><br><br>

					<b style="color:blue">2-</b> Se mostrara la siguiente opcion; Visualiza la imagen presentada a continuacion. <br> 
					En este apartado se podra registrar al personal que el administrador desea agregar y podra seleccionar el rol que ejecutara. Para agregar al personal debe de precionar el boton azul señalado en la imagen.<br>
					<img src="assets/img/sist2/agregar personal.jpg" class="im"><br><br><br>

					<b style="color:blue">3-</b> Se desplegara un formulario de registro de personal;Visualiza la imagen presentada a continuacion.<br>
					Es obligotio llenar todos los campos solicitados del formulario para que el proceso de registro de personal sea exitoso.<br>
					Al terminar de llenar los campos se debe de precionar el boton <b>Guardar</b>.<br>
					<img src="assets/img/sist2/formulario AgregarPersonal.jpg" class="im"><br><br><br>

					<b style="color:blue">4-</b> Se presentara una tabla en donde se visualizara el nuevo usuario agregado, se podra visualizar sus datos personales, rol asignado y estado del usuario; Visualiza la imagen presentada a continuacion.<br>
					<img src="assets/img/sist2/registro personal.jpg" class="im"><br><br><br>
					Sigue todos los pasos presentados para agregar al personal y listo ya puedes seguir agregando al personal de tu preferencia facil y sencillo.</p>
				</div>

				<div class="contenedor-pregunta">
					<p class="pregunta">¿Como modificar datos del personal que he registrado? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Modificar datos del personal agregado es muy facil solo debes de seguir los siguientes pasos.<br><br>

						<b style="color:blue">1-</b> Se presentara una tabla en donde se visualizara el usuario agregado, se podra visualizar sus datos personales, rol asignado y estado del usuario. Se debe de precionar el boton que aparece en la parte inferior derecha de la tabla; Visualiza la imagen presentada a continuacion.
						<img src="assets/img/sist2/modificar personal.jpg" class="im"><br><br><br>

						<b style="color:blue">2-</b> Debes de seleccionar al personal que deseas modificar, precionar el boton y modifica los datos; Visualiza la imagen presentada a continuacion.<br>
						<img src="assets/img/sist2/actulizar personal.jpg" class="im"><br><br><br>

						<b style="color:blue">3-</b> Elije la opcion que deseas y listo ya haz modificado los datos de el personal seleccionado, de manera correctamente y se presentara un aviso de confirmacion de modificacion de datos.<br>
						<img src="assets/img/sist2/usuario modificado.jpg" class="im"><br><br><br>
						Facil rapido y sencillo es modificar al personal que desees siguiendo los pasos presentados.
					</p>
				</div>
				<div class="contenedor-pregunta">
					<p class="pregunta">¿Como puedo eliminar un personal? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Eliminar a uno de los usuario asignados como Personal es muy facil solo debe de seguir los siguientes pasos.<br><br>

						<b style="color:blue">1-</b> Se presentara una tabla en donde se visualizara todo el personal, se podra visualizar sus datos personales, rol asignado y estado del usuario. Se debe de precionar el boton que aparece en la parte inferior derecha de la tabla; Visualiza la imagen presentada a continuacion.
						<img src="assets/img/sist2/eliminar personal.jpg" class="im"><br><br><br>

						<b style="color:blue">2-</b> Debes de seleccionar al personal que deseas eliminar, precionar el boton y lee atentamente el mensaje de aviso; Visualiza la imagen presentada a continuacion.<br>
						<img src="assets/img/sist2/aviso eliminarPersonal.jpg" class="im"><br><br><br>

						<b style="color:blue">3-</b> Elije la opcion que deseas y listo ya haz eliminado el personal seleccionado correctamente y se presentara un aviso de confirmacion de eliminacion.<br>
						<img src="assets/img/sist2/eliminado correctamente.jpg" class="im"><br><br><br>
						Facil rapido y sencillo eliminar al personal que desees siguiendo los pasos presentados.
					</p>
				</div>
			</div>

			<!-- Clientes -->
			<div class="contenedor-preguntas" data-categoria="clientes"  style="background: #f2f5f5">
				
				<div class="contenedor-pregunta">
					<p class="pregunta">¿Que permite la opcion cliente? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta"> Esta opcion permite consultar los clientes registrados en el sistema mostrando en una tabla los clientes registrandos tal como se visualiza en la imagen a continuacion.<br>
					<img src="assets/img/sist2/detalles.jpg" class="im"><br><br>	
					Ademas tiene la opciones de visualizar los detalles del usuario.<br><br>
					<img src="assets/img/sist2/detalles.jpg" class="im"><br><br>
					Al precionar el boton señalado se podra visualizar los detalles de el cliente seleccionado.<br>
					<img src="assets/img/sist2/detalles2.jpg" class="im"><br><br>
					Esta opcion permite asi visualizar los datos del cliente en caso de necesitar comunicarse con el.
					</p>
				</div>

			</div>

			<!-- Eventos-->
			<div class="contenedor-preguntas" data-categoria="eventos" style="background: #f2f5f5" >
				<div class="contenedor-pregunta">
					<p class="pregunta">¿Como agregar un evento a cartelera? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta"> Agregar un evento a cartelera es muy facil solo debes de seguir los siguientes pasos.<br>
					 <b style="color:blue">1-</b> Preciona la casilla titulada evento tal como se visualza a continuacion.<br><br>
						<img src="assets/img/sist2/eventos.jpg" class="im"><br><br>	

						<b style="color:blue">2-</b> Se presentara una tabla, para agregar el evento debes precionar el boton de <b>agregar</b> que se encuentra en la parte superior derecha de la tabla.<br><br>
						<img src="assets/img/sist2/boton agregarEvento.jpg" class="im"><br><br>

						<b style="color:blue">3-</b> Se abrira un formulario en el cual debe de llenar todos los datos solicitados.<br><br>			
						<img src="assets/img/sist2/formulario evento.jpg" class="im"><br><br>
						Posteriormente de haber llenado todos los campos para completar el proceso debes de precionar el boton de <b>Guardar</b> y se mostrara un aviso de planificacion agregada correctamente.<br>
						<img src="assets/img/sist2/aviso de planificacion.jpg" class="im"><br><br>

						Ademas de ello podras visualizar todas las obras que estan en planificacion y contendra toda la informacion acerca del evento.
						<img src="assets/img/sist2/tabla eventos.jpg" class="im"><br><br>
						Asi de facil y sencillo podras agregar un evento a cartelera.<br>

						Si nos dirigimos a hasta la pagina principal podras observar los eventos que agregaste se han publicado.<br>
						<img src="assets/img/sist2/evento cartelera.jpg" class="im"><br><br>
					</p>
				</div>
				<div class="contenedor-pregunta">
					<p class="pregunta">¿Como habilitar asientos,modificar datos del evento y eliminar evento? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">
						Al momento de haber agregado eventos disponemos de 3 acciones presentadas en cada evento agregado a la cartelera; visualizar imagen a continuacion.<br>

						<b><i style="color:blue">Leyenda de colores:</i></b> <br>
						-<a data-bs-toggle="modal"data-bs-target="#asiPal" type="button" class="btn btn-primary ms-2 mt-1 b-asientos"><i class="fa-solid fa-chair i-asientos"></i></a> Boton azul : Representa los asientos que se habilitaran para la funcion.<br>

						-<a data-bs-toggle="modal" data-bs-target="#asiPal" type="button" class="btn btn-primary ms-2 mt-1 b-modificar"  style="background-color: #21e6b4; border: 0px;"><i class="fa-solid fa-user-pen i-modificar"></i></a> Boton verde: Representa la opcion para realizar modificaciones.<br>

						-<a  type="button" class="btn  btn-primary ms-2 mt-1 b-borrar" style="background-color:#e22222; border: 0px;"><i class="fa-solid fa-user-minus i-borrar" ></i></a> Boton rojo: Representa la opcion para eliminar el evento.<br><br>
						<img src="assets/img/sist2/acciones evento.jpg" class="im"><br><br>

						<b style="color:blue">1-</b><b>Habilitar asientos</b><br>
						Para esta accion debemos de precionar el boton azul que se muestra en la imagen anterior.<br>
						se abrira la siguiente ventana.<br><br>

						<img src="assets/img/sist2/asientos.jpg" class="im"><br><br>
						Debes de hacer clic sobre cada asientos que deseas habilitar debependiendo del area, puedes seleccionar de acuerdo a tu preferencia.<br> y para finalizar debes de precionar el boton de "Guardar" y listo ya se han habilitado los asientos correspondientes para la funcion.<br><br>


						<b style="color:blue">2-</b><b>Modifificar datos del evento</b><br>
						Para esta accion debemos de precionar el boton verde que se muestra en la imagen anterior.<br>
						se abrira nuevamente el formulario y debes proceder a modificar los datos que desees sobre el evento.<br>
						<img src="assets/img/sist2/formulario editar evento.jpg" class="im"><br><br>

						<b style="color:blue">3-</b><b>Eliminar evento</b><br>
						Para esta accion debes de posicionarte en la fila del evento el cual desees eliminar y preciona el boton rojo, se mostrara un aviso y deberas de leer atentamente y confirmar la accion.<br>

						Asi de facil y sencillo es realizar estas acciones<br>

					</p>
				</div>

				<div class="contenedor-pregunta">
					<p class="pregunta">¿Como agregar, editar y eliminar categorias? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Las categorias permiten tener una jerarquia dentro de un orden.<br>
						En esta seccion de categoria estan representadas por Nroª y el nombre de la categoria; Visualizar la imagen presentada.<br>			
						<img src="assets/img/sist2/categoria.jpg" class="im"><br><br>

						<b style="color:blue">1-</b> Agregar categoria<br>
						Para agregar una nueva categoria debes de dirirte a la parte superior derecha de la tabla; visualiza la imagen presentada.<br>
						<img src="assets/img/sist2/agregar categoria.jpg" class="im"><br><br>
						
						Alli abrira un formulario en el cual debes de llenar todos los campos solicitados.<br>
						<img src="assets/img/sist2/agregar nueva categoria.jpg" class="im"><br><br>
						De esta manera ya se ha agregado una categoria.<br><br>

						<b style="color:blue">2-</b> Editar categoria<br>
						Para editar una categoria debes de precionar el boton presentado en las acciones (Boton color verde); el cual permitira editar una categoria, preciona el boton de "Guardar" y listo ya has editado la categoria seleccionada.<br>
						<img src="assets/img/sist2/editar categoria.jpg" class="im"><br><br>

						<b style="color:blue">3-</b> Eliminar categoria<br>
						Para eliminar una categoria debes de precionar en las acciones (Boton color rojo);  en el cual permitira eliminar una categoria, debes de confirmar la operacion y sera eliminada la categoria.<br>
						<img src="assets/img/sist2/borrar categoria.jpg" class="im"><br><br>


					</p>
				</div>
			</div>

			<!-- Ventas -->
			<div class="contenedor-preguntas" data-categoria="ventas" style="background: #f2f5f5">
				<div class="contenedor-pregunta">
					<p class="pregunta">Como visualizar las ventas de boletos <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Visualizar las ventas de boletos simple y sencillo solo debes de precionar la opccion de "Ventas" visualizar imagen presentada a continuacion.<br>
						<img src="assets/img/sist2/ventas.jpg" class="im"><br><br>
						
						Posteriormente se mostrara una tabla que presenta todas las ventas en el cual contiene los datos del cliente asi como los datos de la compra realizada  visualizar imagen presentada a continuacion.<br>.<br>

						<img src="assets/img/sist2/tabla ventas.jpg" class="im"><br><br>
						De esta forma estan presentadas todas las ventas.<br>
					</p>
				</div>
				<div class="contenedor-pregunta">
					<p class="pregunta">¿como aceptar o denegar una compra? <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Para realizar este proceso solo debes de precionar este boton "ojito" .<br>
					<img src="assets/img/sist2/ojito.jpg" class="im"><br><br>

					Al precionar se abrira el apartando de compra; Visualizar imagen a continuacion.<br>
					<img src="assets/img/sist2/comprobante de compra.jpg" class="im"><br><br>
					Se presentan dos opciones las cuales son boton de aceptar compra y boton de denegar compra; Segun las condiciones que debe de cumplir la compra se procede a elegir la opcion.
					</p>
				</div>
			</div>


			<!-- reportes -->
			<div class="contenedor-preguntas" data-categoria="reportes" style="background: #f2f5f5">
				<div class="contenedor-pregunta">
					<p class="pregunta">Como generar reportes de personal <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Esta opcion permite generar reportes por: Fecha de registro, cargo del personal y estado del personal.<br>

						<b style="color:blue">1-</b> Reporte de Personal<br>
						Dispone de una opcion titulada <b>Personal</b>  haz clic en el boton titulado; Visualiza la imagen presentada a continuacion. <br>
						<img src="assets/img/sist2/personal.jpg" class="im"><br><br><br>

						<b style="color:blue">2-</b> Se abrira el siguientes apartado; Visualiza imagen presentada a continuacion.<br>
						preciona el boton señalado en la imagen.<br>
						<img src="assets/img/sist2/report personal.jpg" class="im"><br><br>

						<b style="color:blue">3-</b> Selecciona el reporte el cual deseas generar; Luego preciona el boton 
						<b>Generar reporte</b>. <br>
						<img src="assets/img/sist2/report personal2.jpg" class="im"><br><br>

						Asi de facil y sencillo es generar reportes del personal.
					</p>
				</div>

				<div class="contenedor-pregunta">
					<p class="pregunta">Como generar reportes de Eventos <img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Esta opcion permite generar reportes por calendario.<br>

						<b style="color:blue">1-</b> Preciona la casilla titulada evento tal como se visualza a continuacion.<br><br>
						<img src="assets/img/sist2/eventos.jpg" class="im"><br><br>

						<b style="color:blue">2-</b> Se abrira el siguiente apartado; Visualiza imagen presentada a continuacion.<br>
						Preciona el boton señalado en la imagen.<br>
						<img src="assets/img/sist2/report ventas.jpg" class="im"><br><br>
						
						<b style="color:blue">3-</b> Selecciona la fecha en la cual deseas generar el reporte; Visualiza imagen presentada a continuacion.<br>
						Preciona el boton señalado en la imagen.<br>
						<img src="assets/img/sist2/genera reporteFecha.jpg" class="im"><br><br>

						Asi de facil y sencillo es generar reportes de eventos.
					</p>
				</div>

				<div class="contenedor-pregunta">
					<p class="pregunta">Como generar reportes de ventas<img src="assets/img/suma.svg" class="cruz" alt="Abrir Respuesta" /></p>
					<p class="respuesta">Esta opcion permite generar reportes de ventas por calendario.<br>

						<b style="color:blue">1-</b> Preciona la casilla titulada ventas tal como se visualza a continuacion.<br><br>
						<img src="assets/img/sist2/ventas.jpg" class="im"><br><br>

						<b style="color:blue">2-</b> Se abrira el siguiente apartado; Visualiza imagen presentada a continuacion.<br>
						Preciona el boton señalado en la imagen.<br>
						<img src="assets/img/sist2/reporte ventas.jpg" class="im"><br><br>

						<b style="color:blue">3-</b> Selecciona la fecha en la cual deseas generar el reporte; Visualiza imagen presentada a continuacion.<br>
						Preciona el boton de <b>Generar reporte</b>.<br>
						<img src="assets/img/sist2/report fecha2.jpg" class="im"><br><br>

						Asi de facil y sencillo es generar reportes de ventas.
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
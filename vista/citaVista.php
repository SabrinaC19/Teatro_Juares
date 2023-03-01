<html>

<head>
	<?php $_css->heading(); ?>
	<title>Cita</title>
	<link rel="stylesheet" type="text/css" href="assets/css/cita.css">
</head>
	<body>
		<!-- PANTALLA CARGA -->

		<div id="contenedor_carga">
			<div id="carga"></div>
		</div>

	<?php 
		$_comp->navInicioUser();
	 ?> 


			<div class="row container-md col-md-7 col-sm-12  mx-auto mb-3">
					<div class="avisoReservar rounded p-3 mt-5" data-aos="fade-up">
						<h2 class="titleReservar text-center pb-2"><i class="iconoBlanco fa-regular fa-bell"></i>¡Aviso Importante!<i class="iconoBlanco fa-regular fa-bell"></i></h2>
						<p class="card-text h5Reservar">Recuerda que antes de Solicitar tu cita con el personal del teatro debes realizar una carta, <a href="#">Descarga el modelo aquí</a> dirigida al Presidente Ramón Suárez y a la Gerente de Producción, allí especificarás el motivo por el cual deseas utilizar nuestro espacio, fecha del evento y la cantidad de asientos a reservar, luego convertirás ese documento en PDF y lo adjuntarás en el formulario que se encuentra abajo, posteriormente esperarás a que la Fundación del Teatro se comunique contigo para finiquitar los detalles de tu reunión con ellos. También es importante tener en cuenta que los horarios de atención en el Teatro son de 9:00 AM a 12:00 PM y de 1:00 PM a 4:00 PM. ¡Mucha Suerte en tu evento!</p>
					</div>
			</div>

		<div class="container-md row mx-auto">
		<div class="card col-sm-10 col-md-8 col-lg-6 mx-auto" id="formulario-reservacion">
			<div class="card-body">		

					<div class="col-md-12 text-center mb-4 tituloReservacion">

						<h5 class="card-title text-center">Solicitud de Cita<i class="icon-clipboard px-2"></i></h5>
							
					</div>	

					<!--FORMULARIO-->

					<form class="row g-3" method="POST" id="formReserva" enctype="multipart/form-data">
						<div class="col-md-12">

							<!--NOMBRE DEL EVENTO--> 
								<label for="nombreEvento-reservacion" class="escrito mb-2">Nombre del Evento</label>
								<input type="text" class="form-control" id="nombreEvento-reservacion" name="nombreEvento" placeholder="&#xe923; Nombre del Evento">
								<div id="errorNombre"></div> 
						</div>

						<!--FECHA Y HORA-->
						<div class="col-md-6 col-sm-6 mb-2">
							<label for="date" class="form-label">Fecha de Cita</label> 
							<input type="date" class="form-control" name="fecha" id="date">
							<div id="errorFecha"></div> 
						</div>

						<div class="col-md-6 col-sm-6 mb-2">
							<label for="hora" class="form-label">Hora de Cita</label> 
							<input type="time" class="form-control" name="hora" id="hora">
							<div id="errorHora"></div> 
						</div>

						<!--SELECT DE SERVICIO Y ESPACIO -->

							<div class="col-md-6 col-sm-6">
								<label for="servicio-reservacion" class="form-label">Servicios</label> 
								<select class="form-select" id="servicio-reservacion" name="servicio" aria-label="Servicio">
									<option selected value="0">Servicios...</option>
									<option value="1">Obra Teatral</option> 
									<option value="2">Concierto</option>
									<option value="3">Graduación</option>
									<option value="4">Concurso</option> 
									<option value="5">Conferencia</option>
									<option value="6">Otro...</option>  
								</select> 
								<div id="errorServicio"></div>
						</div>
						<div class="col-md-6 col-sm-6">
								<label for="espacio-reservacion" class="form-label">Espacios</label> 
								<select class="form-select" id="espacio-reservacion" name="espacio">
									<option selected value="0">Espacios...</option>
									<option value="1">Escenario</option>
									<option value="2">Salón de los Espejos</option> 
								</select> 
								<div id="errorEspacio"></div>
						</div>
						<div id="otros" class="input-group py-0">
								<span class="input-group-text">Ingrese tipo de servicio</span>
								<input type="text" class="form-control" id="otroServicio" name="otroServicio" placeholder="&#xea84; Ejemplo: Festival">		
						</div>
						<div id="errorOtro"></div>
						
						<!--DESCRIPCION-->

						<div class="col-md-12 col-sm-12">
							<label for="descripcion-reservacion" class="escrito mb-2">Breve Descripción del Evento</label>
							<textarea class="form-control" id="descripcion-reservacion" name="descripcion" style="height: 100px;" placeholder="Inserte una breve sinopsis de su evento"></textarea>
						</div>
						<div id="errorDescripcion"></div>

							<!--CheckBox-->

						<div class="form-check form-switch d-flex justify-content-center">
						  <input class="form-check-input me-2" type="checkbox" role="switch" id="empresaCheck" name="checkEmpresa">
                            <label class="form-check-label mb-2" for="empresaCheck">¿Es una empresa u Organización?</label>	
						</div>

						<div class="row mx-auto" id="empresa">
							
							<!--CORRREO RAZON SOCIAL Y NUMERO DE CONTACTO-->

						<div class="col-md-12 col-sm-12 mb-3 mt-2">
							<label for="razon" class="escrito mb-2">Razón Social</label>
							<input type="text" class="form-control" id="razon" name="razonSocial" placeholder="&#xea84; Fundación Teatro Juares">
							<div id="errorRazon"></div> 
						</div> 


						<div class="col-md-12 col-sm-12 mb-3">
							<label for="correo-reservacion" class="escrito mb-2">Correo Electrónico</label>
							<input type="email" class="form-control" id="correo-reservacion" name="correo" placeholder="&#xea84; Nombre@gmail.com"> 
							<div id="errorCorreo"></div>
						</div>

						<div class="col-lg-5 col-md-5 col-sm-5 mb-2">
							<label for="telefono-reservacion" class="escrito mb-2">Código de Contacto</label>
							<select class="form-select" id="telefono-reservacion" name="codigoC">
								<option selected value="0">#</option>
								<option value="1">0412</option>
								<option value="2">0414</option>
								<option value="3">0424</option>
								<option value="4">0416</option>
								<option value="5">0426</option>
								<option value="6">0251</option> 
							</select> 
							<div id="errorCod"></div>
						</div>
						<div class="col-lg-7 col-md-7 col-sm-7 mb-2">
							<label for="telefono-reservacion" class="escrito mb-2">Número de Contacto</label>
							<input type="text" class="form-control" id="contacto-reservacion" name="telefonoC" placeholder="3705413"> 
							<div id="errorTel"></div>
						</div>

						</div>

						<!--ARCHIVO PDF-->

						<div class="col-md-12 text-center">
							<label for="form-label" class="pdf"><i class="iconoRojo fa-solid fa-arrow-down"></i>Por favor inserte aquí su carta de solicitud en PDF<i class="iconoRojo fa-solid fa-arrow-down"></i></label>
							<input type="file" class="form-control mt-3" name="archivoPDF" id="archivo">
							<div id="errorArchivo"></div> 
						</div>
							<div style="color: red; text-align: center;" id="error"></div>
						<div class="text-center"> 
							<button type="button" class="btn btn-success" id="enviar">Enviar</button> 
							<button type="reset" class="btn btn-danger" id="limpiar">Limpiar</button>
						</div>
				</form>
			</div>
		</div>
		</div>
		<?php  $_comp->footer(); ?>
		<?php if (isset($registro)) {
			echo $registro;
		}?>
		<script type="text/javascript" src="assets/js/cita.js"></script>
	</body>
</html>
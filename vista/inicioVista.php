<html>
<head>
	<title>Inicio</title>
<link rel="stylesheet" type="text/css" href="assets\css\inicio.css">
</head>
<body>

<!-- PANTALLA CARGA -->

	<div id="contenedor_carga">
		<div id="carga"></div>
	</div>

	<?php 

	$_comp->_varSocial();

	if ($userSession->log()) {
		$_comp->navInicioUser();
	}else{
		$_comp->navInicio();
	}
	

	 ?>

<!-- BOTON IR ARRIBA -->
<span class="fas fa-arrow-up botonArriba"></span>
	

<!-- BIENVENIDA -->
	
	<div class="bienvenida">
		<img src="assets/img/bg.png">
		<div class="container-bienvenida">
			<div class="bienvenida-title">
		<img src="assets/img/Logo-white.png" data-aos="zoom-in">
			</div>
			<div class="body-bienvenida">
		<p>Bienvenido a la Fundación Teatro Juares</p>
		<?php if (!$userSession->log()) { ?>
		<a class="btn btn-danger" href="?url=usuario&type=registro">Regístrate Aquí</a>
		<?php } ?>
			</div>
		</div>
	</div>


	<!-- CONOCENOS -->

	<section class="main">

		<div id="separator-ribbon">
			<div class="content">
				<p class="titulo" id="Conocenos">CONÓCENOS</p>
			</div>
		</div>

		<div>
			<div class="container-md p-5 container-conocenos">
				<div class="row body-conocenos">
					<div class="container-qs rounded p-3 mb-5" data-aos="fade-up">
					<h2 class="title-conocenos h1">¿Quiénes somos? <i class="fas fa-masks-theater"></i></h2>
					<p class="card-text conocenos-text h5">Somos una institución que ofrece servicios y productos en el área de entretenimiento al público barquisimetano y larense, siendo reconocidos a nivel nacional e internacional por sus grandes obras de teatro y escenificaciones, por otro lado, tambien realizamos graduaciones de estudiantes en educación, básica, media y avanzada. Concursos de belleza, actos culturales y políticos. Salas de cine y obras de danzas y ballet. Actualmente contamos con cafetín público, llamado “Soy Drama Café” Ubicado en el balcón del teatro, inaugurado por el Gobernador del Estado Lara, Adolfo Pereira, el 25 de agosto del 2021. Con la finalidad de promover el turismo y las actividades culturales dentro de Barquisimeto.
					</p>
					</div>

					<img src="assets/img/Conocenos/mask.png" data-aos="fade-up" class="img-fluid pb-5">
				</div>

	<!-- MISIÓN Y VISIÓN -->			

				<div class="row">
					<div class="col-lg m-3">
						<div class="card card-border card-m" data-aos="fade-up">
							<div class="card-body">
								<div class="img-m">
									<h4 class="text-center"><i class="fas fa-location-crosshairs"></i> MISIÓN</h4>
								</div>
								<hr class="hr1">
								<p class="card-text h5">La Fundación tiene como misión, promover, difundir y proyectar las acciones artístico cultural de la Fundación Teatro Juares, mediante una política de características socialistas, con sostenibilidad en el tiempo, que logre dimensionar la máxima expresión de las obras escénicas que presente y así elevar el potencial artístico del pueblo en respeto a su entorno ambiental y su territorialidad, propiciando unas condiciones favorables para la integración de las políticas nacionales, regionales y municipales en esta materia e incorporando los actores del sistema cultural como protagonista del proceso.</p>
							</div>
						</div>
					</div>

					<div class="col-lg m-3">
						<div class="card card-border card-v" data-aos="fade-up">
							<div class="card-body">
								<div class="img-v">
									<h4 class="text-center"><i class="fas fa-eye"></i> VISIÓN</h4>
								</div>
								<hr class="hr1">
								<p class="card-text h5">La visión de la Fundación Teatro Juares cuenta con una política de sala abierta, de amplio alcance, que atiende eficazmente las necesidades de promoción, difusión y proyección de la obra escénica que exhiba. Basándose en los valores socialistas de la inclusión, la cooperación y la participación apuntalados en el principio rector de la soberanía, expresándose plenamente en los más altos postulados bolivarianos y en consonancia con la constitución de la república bolivariana de Venezuela, sus leyes y convertir la sala de regente en el principal edificio escénico de región centro occidental del país.</p>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>	

	<!-- SERVICIOS -->

		<div id="separator-ribbon">
			<div class="content">
				<p class="titulo" id="Servicios">SERVICIOS</p>
			</div>
		</div>

		<section>
          <div class="container mt-5" data-aos="fade-up">
            <ul class="nav panel-tabs row d-flex aling-items-center justify-content-center">
              <li class="nav-item col col-lg-2 col-md-5 col-sm-8 col-8 rounded">
                <a href="" class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab1">
                  <h4 class="text-center">Obras</h4>
                </a>
              </li>
              <li class="nav-item col col-lg-2 col-md-5 col-sm-8 col-8 rounded">
                <a href="" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab2">
                  <h4 class="text-center">Conciertos</h4>
                </a>
              </li>
              <li class="nav-item col col-lg-2 col-md-5 col-sm-8 col-8 rounded">
                <a href="" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab3">
                  <h4 class="text-center">Graduaciones</h4>
                </a>
              </li>
              <li class="nav-item col col-lg-2 col-md-5 col-sm-8 col-8 rounded">
                <a href="" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab4">
                  <h4 class="text-center">Concursos de Belleza</h4>
                </a>
              </li>
              <li class="nav-item col col-lg-2 col-md-5 col-sm-8 col-8 rounded">
                <a href="" class="nav-link" data-bs-toggle="tab" data-bs-target="#tab5">
                  <h4 class="text-center">Conferencias</h4>
                </a>
              </li>
            </ul>
          </div>

        <!-- Tab content -->
          <div class="tab-content">
            <div class="tab-pane active" id="tab1" data-aos="fade-up">
              <div class="row m-5">
                <div class="col-lg-7 col-md-6 order-2 order-md-1 order-lg-1">
                  <h3 class="text-center title-services mt-3">OBRAS TEATRALES <i class="fas fa-mask"></i></h3>
                  <hr class="hr4">
                  <p class="text-services">Desde obras de ballet, danza y urbano hasta circo, comedia y obras infantiles hemos tenido el honor de organizar, al tener un espacio amplio y una gran capacidad, nuestras instalaciones son perfectas para llevar a cabo tu producción, contamos con un excelente equipo de área técnica que no te va a fallar al montar la obra que tú sueñas.</p>
                </div>
                <div class="col-lg-5 col-md-6 order-1 order-md-2 order-lg-2 mb-2 d-flex aling-items-center">
                  <img src="assets/img/obras.jpg" class="img-fluid rounded mt-3">
                </div>
              </div>
            </div>
            <!-- End Tab content -->
             <div class="tab-pane" id="tab2">
              <div class="row m-5">
                <div class="col-lg-7 col-md-6 order-2 order-md-1 order-lg-1">
                  <h3 class="text-center title-services">Conciertos <i class="fas fa-microphone-lines"></i></h3>
                  <hr class="hr4">
                  <p class="text-services">Si buscas un espacio donde tu voz se escuche armoniosa y perfecta
                  nuestro escenario es perfecto para ti, el mismo cuenta con una estructura basada en los Teatros Italianos que tienen la característica de proyectar e intensificar el sonido, además nuestras instalaciones cuenta con un excelente equipo de sonido y los especialistas capacitados para su manejo.</p>
                </div>
                <div class="col-lg-5 col-md-6 order-1 order-md-2 order-lg-2 mb-2 d-flex aling-items-center">
                  <img src="assets/img/5.jpg" class="img-fluid rounded">
                </div>
              </div>
            </div>
            <!-- End Tab Content -->
            <div class="tab-pane" id="tab3">
              <div class="row m-5">
                <div class="col-lg-7 col-md-6 order-2 order-md-1 order-lg-1">
                  <h3 class="text-center title-services">Graduaciones <i class="fas fa-graduation-cap"></i></h3>
                  <hr class="hr4">
                  <p class="text-services">La Fundación Teatro Juares se caracteriza por ser el lugar ideal para realizar actos de grado en todos los niveles educativos, tanto inicial como media y Universitaria, nuestros clientes tienen a su disposición todo un personal capacitado referente a los protocolos para realizar una graduación, además nuestros asesores también pueden dar orientaciones en ambitos de decoración, vestimenta y mueblería.</p>
                </div>
                <div class="col-lg-5 col-md-6 order-1 order-md-2 order-lg-2 mb-2 d-flex aling-items-center">
                  <img src="assets/img/graduaciones.jpg" class="img-fluid rounded">
                </div>
              </div>
            </div>
            <!-- End Tab Content -->
            <div class="tab-pane" id="tab4">
              <div class="row m-5">
                <div class="col-lg-7 col-md-6 order-2 order-md-1 order-lg-1">
                  <h3 class="text-center title-services">Concursos de Belleza <i class="fas fa-spa"></i></h3>
                  <hr class="hr4">
                  <p class="text-services">Dentro del Teatro también hemos celebrado una gran cantidad de Concursos de Belleza y pasarelas de modelaje, tenemos distintos espacios donde las modelos se pueden tomar sus fotografías, ademas de una gran tarima con luces hermosas para relucir la belleza de todas nuestras misses del estado Lara y el territorio nacional.</p>
                </div>
                <div class="col-lg-5 col-md-6 order-1 order-md-2 order-lg-2 mb-2 d-flex aling-items-center">
                  <img src="assets/img/belleza.jpg" class="img-fluid rounded">
                </div>
              </div>
            </div>
            <!-- End Tab Content -->
            <div class="tab-pane" id="tab5">
              <div class="row m-5">
                <div class="col-lg-7 col-md-6 order-2 order-md-1 order-lg-1">
                  <h3 class="text-center title-services">Conferencias <i class="fas fa-users"></i></h3>
                  <hr class="hr4">
                  <p class="text-services">Si necesitas un espacio más pequeño donde hacer una pequeña reunión o una conferencia de Trabajo te recomendamos el Salón de los espejos, un espacio muy agradable que genera un buen ambiente para conversaciones entre socios, trabajadores o familiares; Es un sitio privado y encantador donde tendrán una experiencia muy tranquila y lejos de público, puedes llenar el formulario para reservar esta área.</p>
                </div>
                <div class="col-lg-5 col-md-6 order-1 order-md-2 order-lg-2 mb-2 d-flex aling-items-center">
                  <img src="assets/img/espejos.jpg" class="img-fluid rounded">
                </div>
              </div>
            </div>
            <!-- End Tab Content -->
          </div>
      </section>

      <div class="container-md"  data-aos="fade-up"> 
      	<div class="row">
      		<div class="card col-6 mx-auto mb-5 card-r">
      			<div class="reservar">
      				<h5 class="title-reservar text-center ">¿Desea agendar una cita para solicitar alguno de nuestros servicios?</h5>
      				<hr class="hr2">
      				<p class="text-reservar text-center"> Envie su solicitud de cita </p>
      				<a href="?url=cita" class="link-reservaciones mx-auto">Agendar Cita <i class="fas fa-arrow-right-to-bracket ms-1"></i></a>
      			</div>
      		</div>
      	</div>
      </div>


	<!-- UBICACIÓN -->

	<section class="main2">

		<div id="separator-ribbon">
			<div class="content">
				<p class="titulo" id="Ubicacion">UBICACIÓN</p>
			</div>
		</div>
	
	<div class="ubication-container my-5"  data-aos="fade-up">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.4046838495133!2d-69.3185434499001!3d10.065888892770696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e87670df578c6a5%3A0x5a808b2ecbd813de!2sTeatro%20Juares!5e0!3m2!1ses!2sve!4v1660241865960!5m2!1ses!2sve" width="1200" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>

	</section>
	
	<!-- EQUIPO -->

	<section class="main3">

		<div id="separator-ribbon">
			<div class="content">
				<p class="titulo" id="Equipo">EQUIPO</p>
			</div>
		</div>



		<div class="row m-5 d-flex aling-items-center justify-content-center">

			<div class="col-lg-5 mb-4">
				<div class="miembro d-flex align-items-start rounded" data-aos="zoom-in">
					<div class="miembro-img">
						<img src="assets/img/Desarrolladores/Sabrina Colmenarez.png" class="img-fluid rounded-circle">
					</div>
					<div class="miembro-info">
						<h4>Sabrina Colmenarez</h4>
						<span>Lider de proyecto <i class="fas fa-crown"></i></span>
						<div class="card-redes">
							<a href="#" class="github"><i class="fab fa-github"></i></a>
							<a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
							<a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
							<a href="#" class="google"><i class="fab fa-google"></i></a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-5 mb-4">
				<div class="miembro d-flex align-items-start rounded" data-aos="zoom-in">
					<div class="miembro-img">
						<img src="assets/img/Desarrolladores/Hendherson Patino.png" class="img-fluid rounded-circle">
					</div>
					<div class="miembro-info">
						<h4>Hendherson Patiño</h4>
						<span>Diseñador <i class="fas fa-paint-roller"></i></span>
						<div class="card-redes">
							<a href="#" class="github"><i class="fab fa-github"></i></a>
							<a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
							<a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
							<a href="#" class="google"><i class="fab fa-google"></i></a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-5 mb-4">
				<div class="miembro d-flex align-items-start rounded" data-aos="zoom-in">
					<div class="miembro-img">
						<img src="assets/img/Desarrolladores/Manuel Gonzalez.png" class="img-fluid rounded-circle">
					</div>
					<div class="miembro-info">
						<h4>Manuel Gonzalez</h4>
						<span>Programador <i class="fas fa-computer"></i></span>
						<div class="card-redes">
							<a href="#" class="github"><i class="fab fa-github"></i></a>
							<a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
							<a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
							<a href="#" class="google"><i class="fab fa-google"></i></a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-5 mb-4">
				<div class="miembro d-flex align-items-start rounded" data-aos="zoom-in">
					<div class="miembro-img">
						<img src="assets/img/Desarrolladores/Gisel Martinez.png" class="img-fluid rounded-circle">
					</div>
					<div class="miembro-info">
						<h4>Gisel Martinez</h4>
						<span>Técnica <i class="fas fa-network-wired"></i></span>
						<div class="card-redes">
							<a href="#" class="github"><i class="fab fa-github"></i></a>
							<a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
							<a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
							<a href="#" class="google"><i class="fab fa-google"></i></a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-5">
				<div class="miembro d-flex align-items-start rounded" data-aos="zoom-in">
					<div class="miembro-img">
						<img src="assets/img/Desarrolladores/Jose Escalona.png" class="img-fluid rounded-circle">
					</div>
					<div class="miembro-info">
						<h4>José Escalona</h4>
						<span>Administrador BD <i class="fas fa-database"></i></span>
						<div class="card-redes">
							<a href="#" class="github"><i class="fab fa-github"></i></a>
							<a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
							<a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
							<a href="#" class="google"><i class="fab fa-google"></i></a>
						</div>
					</div>
				</div>
			</div>

		</div>

	</section>

<!-- PARNERS Y FOOTER -->
	
				<footer class="footer">
				<!-- PARNERS -->
				<div class="container-md pt-3">
					<div class="row">
						<div class="col img-parners">
							<img src="assets/img/Parners/Gobierno de Lara.png" class="img-fluid">
						</div>
						<div class="col img-parners">
							<img src="assets/img/uptaeb.png" class="img-fluid">
						</div>
						<div class="col img-parners-g">
							<img src="assets/img/Parners/Secretaria.png" class="img-fluid mt-5">
						</div>
					</div>
				</div>


		<!-- FOOTER -->

		<div class="container-md pt-3">
			<div class="row">
				<div class="col-md">
					<h5 class="card-title title-footer text-center">MENÚ PRINCIPAL</h5>
					<hr class="hr-footer">
					<ul class="nav-footer">
						<li class="footer-item mb-3"><a class="footer-links" href="?url=inicio">Inicio</a></li>
						<li class="footer-item mb-3"><a class="footer-links" href="?url=cartelera&type=mostrar">Cartelera</a></li>
						<li class="footer-item mb-3"><a class="footer-links" href="?url=cita">Citas</a></li>
						<li class="footer-item mb-3"><a class="footer-links" href="?url=inicio&type=trastelon">Trastelón</a></li>
						<li class="footer-item mb-3"><a class="footer-links" href="?url=inicio&type=ayuda">Ayuda</a></li>
					</ul>
				</div>
				<div class="col-md">	
					<h5 class="card-title title-footer text-center">CONTACTO</h5>
					<hr class="hr-footer">
						<li class="text-footer mb-4"><i class="fas fa-location-dot"></i> Ubicación: <span>Carrera 19 esquina de la calle 25</span></li>
						<li class="text-footer mb-4"><i class="fas fa-phone-flip"></i> Teléfono: </lispan>0251-2329549</li></li>
						<li class="text-footer mb-4"><i class="fas fa-envelope"></i> Correo: <span> teatrojuaresmedios@gmail.com</span></li>
						<li class="text-footer mb-4"><i class="fas fa-clock"></i> Horario: <span>9AM-12PM / 13PM-16PM </span></li>

				</div>
				<div class="col-md">
					<h5 class="card-title title-footer text-center">SIGUENOS</h5>
					<hr class="hr-footer">
					<div class="redes-sociales">
						<ul>
							<li><a class="text-footer" target="_black" href="https://www.facebook.com/teatrojuaresVenezuela/"><i class="icons-footer facebook fab fa-facebook-f mb-2"></i></a><span class="text-redes ms-3"> @TeatroJuares</span></li>

							<li><a class="text-footer" target="_black" href="https://twitter.com/juares_teatro?lang=es"><i class="icons-footer twitter fab fa-twitter mb-2" ></i></a><span href="#" class="text-redes ms-3"> @juares_teatro</span></li>

							<li><a class="text-footer" target="_black" href="https://www.instagram.com/teatrojuares/?hl=es"><i class="icons-footer instagram fab fa-instagram mb-2"></i></a><span href="#" class="text-redes ms-3"> @teatrojuares</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="copyright mt-3 text-center">
			<small>Fundación Teatro Juares y la Universidad Politécnica Territorial "Andres Eloy Blanco" &copy; todos los derechos reservados 2022
		</div>

	</footer>
	<?php $_comp->linksFooter(); ?>
	<script src="assets/js/boton_ir_arriba.js"></script>
</body>
</html>
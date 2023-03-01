<?php 

namespace Teatrojuares\Content\component;
	
use TeatroJuares\Content\helpers\authSession as authSession;

 class initComponent extends authSession{

 	public function __construct(){
 		parent::__construct();
 	}

 	public function _varSocial(){

 		echo ('<!-- BAR SOCIAL -->

					<div class="social_bar">
						<a href="https://www.facebook.com/teatrojuaresVenezuela/" target="__blank" class="icons-social icon-facebook"></a>
						<a href="https://twitter.com/juares_teatro?lang=es" target="__blank" class="icons-social icon-twitter"></a>
						<a href="https://www.instagram.com/teatrojuares/?hl=es" target="__blank" class="icons-social icon-instagram"></a>
						<a href="#" target="__blank" class="icons-social icon-google"></a>
					</div>');
 	}

 	public function navInicio(){

 		$inicio = ($_GET['url'] === "inicio" && empty($_GET["type"]))? "activo" : "";
 		$cartelera = ($_GET['url'] === "cartelera")? "activo" : "";
 		$citas = ($_GET['url'] === "cita")? "activo" : "";
 		
 		if (isset($_GET["type"])) {
 			$trastelon = ($_GET['url'] === "inicio" && $_GET["type"] === "trastelon")? "activo" : "";
 			$ayuda = ($_GET['url'] === "inicio" && $_GET["type"] === "ayuda")? "activo" : "";
 		}else{
 			$trastelon = "";
 			$ayuda = "";
 		}
 		
 		$itemCita = (parent::log()) ? '<a href="?url=cita&type=solicitar" class="linkMenuDes '.$citas.'"><i class="icon fas fa-calendar-check"></i> Citas </a>' : '' ;

 		$desplegable = '<!-- MENU DESPEGABLE -->

			<input type="checkbox" id="btn-menu">
			<div class="container-menu">
				<div class="cont-menu">
					<nav>
						<img src="assets/img/Logo white.png" class="w-50 mx-auto d-flex justify-content-center align-items-center">
						<a href="?url=inicio" class="linkMenuDes '.$inicio.'"><i class="icon fas fa-house"></i> Inicio </a>
						<a href="?url=cartelera&type=mostrar" class="linkMenuDes '.$cartelera.'"><i class="icon fas fa-film"></i> Cartelera </a>'.$itemCita.'
						
						<a href="?url=inicio&type=trastelon" class="linkMenuDes '.$trastelon.'"><i class="icon fas fa-person-booth"></i> Trastelón </a>
						<a href="?url=inicio&type=ayuda" class="linkMenuDes '.$ayuda.'"><i class="icon fas fa-circle-info"></i> Ayuda </a>
					</nav>
					<label for="btn-menu" class="fas fa-xmark"></label>
				</div>
			</div>';

		$tagInicio = ($_GET["url"] === "inicio" && !isset($_GET["type"])) ? '<ul class="navbar-nav mx-auto">
						<li class="nav-item px-3"><a class="link nav-link" href="#Conocenos"> Conócenos </a></li>
						<li class="nav-item px-3"><a class="link nav-link" href="#Servicios"> Servicios </a></li>
						<li class="nav-item px-3"><a class="link nav-link" href="#Ubicacion"> Ubicación </a></li>
						<li class="nav-item px-3"><a class="link nav-link" href="#Equipo"> Equipo </a></li>
					</ul>' : '';

 		echo('<!-- NAVBAR -->

		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid">
				<div class="btn-menu">
					<label for="btn-menu" class="burger fas fa-bars"></label><span class="logo"> <span>Fundación Teatro Juares</span>
				</div>
				<div class="collapse navbar-collapse">'.$tagInicio.'
					
					<a class="nav-sesion ms-auto" href="?url=usuario&type=login">Iniciar Sesión <i class="fas fa-door-open"></i></a>
				</div>
			</div>
		</nav>'.$desplegable);
 	
 	}

 	public function navInicioUser(){

 		$navInicio = ($_GET["url"] === "inicio") ? '<div class="collapse navbar-collapse">
					<ul class="navbar-nav mx-auto">
						<li class="nav-item px-3"><a class="link nav-link" href="#Conocenos"> Conócenos </a></li>
						<li class="nav-item px-3"><a class="link nav-link" href="#Servicios"> Servicios </a></li>
						<li class="nav-item px-3"><a class="link nav-link" href="#Ubicacion"> Ubicación </a></li>
						<li class="nav-item px-3"><a class="link nav-link" href="#Equipo"> Equipo </a></li>
					</ul>
				</div>' : '';

		$dashboard = (parent::_isAdmin()) ? '<a href="?url=dashboard" class="linkMenuDes"><i class="icon fa-solid fa-gears"></i> Panel de Control </a>' : '' ;

 		echo ('<!-- NAVBAR SESIÓN INICIADA-->

		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid">
				<div class="btn-menu">
					<label for="btn-menu" class="burger fas fa-bars"></label><span class="logo"> <span>Fundación Teatro Juares</span>
				</div>'.$navInicio.' 
				<div class="dropdown d-none d-sm-none d-md-block">
					<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						<img class="img-fluid rounded-circle fotoUser" src="assets/img/user.jpg">
						'.$_SESSION['nombre'].'
					</button>

					<ul class="dropdown-menu container">
						<li><a class="dropdown-item" href="?url=usuario&type=perfil">Ver perfil <i class="iconMenuUser fa-solid fa-user"></i></a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="?url=usuario&type=logout">Cerrar sesión<i class="iconMenuUser fa-solid fa-door-open"></i> </a></li>
					</ul>
				</div>
			</div>
		</nav>

	<!-- MENU DESPEGABLE -->

	<input type="checkbox" id="btn-menu">
	<div class="container-menu">
		<div class="cont-menu">
			<nav>'.$dashboard.'
				<a href="?url=inicio" class="linkMenuDes"><i class="icon fas fa-house"></i> Inicio </a>
				

				<a href="?url=cartelera&type=mostrar" class="linkMenuDes"><i class="icon fas fa-film"></i> Cartelera </a>
				<a href="?url=cita&type=solicitar" class="linkMenuDes"><i class="icon fas fa-calendar-check"></i> Citas </a>
				<a href="?url=inicio&type=trastelon" class="linkMenuDes"><i class="icon fas fa-person-booth"></i> Trastelón </a>
				<a href="?url=inicio&type=ayuda" class="linkMenuDes"><i class="icon fas fa-circle-info"></i> Ayuda </a>
				<div class="btn-group dropend linkMenuDes">
					<button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
						<img class="img-fluid rounded-circle fotoUser" src="assets/img/user.jpg">'.$_SESSION['nombre'].'
						
					</button>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="?url=usuario&type=perfil">Ver Perfil <i class="iconMenuUser fa-solid fa-user"></i></a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="?url=usuario&type=logout">Cerrar Sesión<i class="iconMenuUser fa-solid fa-door-open"></i> </a></li>
					</ul>
				</div>
			</nav>
			<label for="btn-menu" class="fas fa-xmark"></label>
		</div>
	</div>');
 	
 	}



 	public function navInicioAdmin(){

 		$inicio = ($_GET['url'] === "inicio" && empty($_GET["type"]))? "activo" : "";

 		if (isset($_GET["type"])) {
 			
 			$personal = ($_GET["url"] === 'dashboard' && $_GET["type"] === 'personal')? "activo" : "";
 			$clientes = ($_GET["url"] === 'dashboard' && $_GET["type"] === 'clientes')? "activo" : "";
 			$eventos = ($_GET["url"] === 'dashboard' && $_GET["type"] === 'eventos')? "activo" : "";
 			$ventas = ($_GET["url"] === 'dashboard' && $_GET["type"] === 'ventas')? "activo" : "";
 			$cita = ($_GET["url"] === 'cita' && $_GET["type"] === 'consultar')? "activo" : "";
 		
 		} else {

 			$personal = "";
 			$clientes = "";
 			$eventos = "";
 			$ventas = "";
 			$cita = "";
 		}

 	$desplegableCita = (parent::requestAccess($_SESSION["rol"], CITAS)) ? '<a href="?url=cita&type=consultar" class="linkMenuDes '.$cita.'"><i class="icon fa-solid fa-calendar-check"></i> Gestionar Citas </a>' : '' ;

	$desplegableEvento = (parent::requestAccess($_SESSION["rol"], EVENTOS)) ? '<a href="?url=dashboard&type=eventos" class="linkMenuDes '.$eventos.'"><i class="icon fas fa-film"></i> Gestionar Eventos </a>' : '' ;
	$desplegableVentas = (parent::requestAccess($_SESSION["rol"], VENTAS)) ? '<a href="?url=dashboard&type=ventas" class="linkMenuDes '.$ventas.'"><i class="icon fa-solid fa-circle-dollar-to-slot"></i> Gestionar Ventas </a>' : '' ;
	$desplegablePersonal = (parent::requestAccess($_SESSION["rol"], PERSONAL)) ? '<a href="?url=dashboard&type=personal" class="linkMenuDes '.$personal.'"><i class="icon fa-solid fa-users-gear"></i> Gestionar Personal </a>' : '' ;
	$desplegableClientes = (parent::requestAccess($_SESSION["rol"], CLIENTES)) ? '<a href="?url=dashboard&type=clientes" class="linkMenuDes '.$clientes.'"><i class="icon fa-solid fa-user-tag"></i> Consultar Clientes </a>' : '' ;

 		$desplegable = '<!-- MENU DESPEGABLE -->

				<input type="checkbox" id="btn-menu">
				<div class="container-menu" id="adminMenu">
					<div class="cont-menu">
						<nav>
							<div class="linkMenuDes">
								<div class="d-flex justify-content-center align-items-center mx-auto mb-2">
									<img class="img-fluid rounded-circle imgUser" src="assets/img/usuario.jpg" >
								</div>
								<span class="bg-danger p-2 d-flex align-items-center justify-content-center mx-auto rounded">
									'.$_SESSION["nombre"].'
								</span>
							</div>
							<a href="?url=inicio" class="linkMenuDes'.$inicio.'"><i class="icon fa-solid fa-globe"></i> Página Principal </a>
							<a href="?url=dashboard" class="linkMenuDes'.$inicio.'"><i class="icon fa-solid fa-gears"></i> Panel de Control </a>'
							.$desplegableCita.$desplegableEvento.$desplegableVentas.$desplegablePersonal.$desplegableClientes.'
							<a href="?url=dashboard&type=ayuda" class="linkMenuDes"><i class="icon fas fa-circle-info"></i> Ayuda </a>
							<a href="?url=iusuario&type=logout" class="d-lg-none d-sm-block linkMenuDes'.$inicio.'"><i class="icon fa-solid fa-door-open"></i> Cerrar Sesión </a>
							
							
						</nav>
						<label for="btn-menu" class="fas fa-xmark"></label>
					</div>
				</div>';

 		echo ('<!-- NAVBAR SESIÓN INICIADA Administrador--> 

		<nav class="navbar navbar-expand-lg">
			<div class="container-fluid">
				<div class="btn-menu">
					<label for="btn-menu" class="burger fas fa-bars"></label><span class="logo"> <span>Fundación Teatro Juares</span>
				</div>
				<div class="collapse navbar-collapse justify-content-end">
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<img class="img-fluid rounded-circle fotoUser" src="assets/img/usuario.jpg">
								'.$_SESSION["nombre"].'
							</a>
							<ul class="dropdown-menu mt-0">
								<li><a class="dropdown-item" href="?url=usuario&type=perfil">Ver Perfil <i class="iconMenuUser fa-solid fa-user"></i></a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="?url=usuario&type=logout">Cerrar Sesión<i class="iconMenuUser fa-solid fa-door-open"></i> </a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>'.$desplegable);
 	
 	}

 	public function footer(){

 		echo ('	<!-- FOOTER -->
		
	<footer class="footer" id="footer">
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
						<li class="text-footer mb-4"><i class="fas fa-envelope"></i> Correo: <span>
						teatrojuaresmedios@gmail.com</span></li>
						<li class="text-footer mb-4"><i class="fas fa-clock"></i> Horario: <span>9AM-12PM / 1PM-4PM </span></li>

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

		<!-- Link JQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<!-- Owl Carousel -->
		<script src="assets/owlcarrusel/js/jquery.min.js"></script>
		<script src="assets/owlcarrusel/js/owl.carousel.min.js"></script>
		<!-- Js Bootstrap -->
		<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- Sweet Alert -->
		<script type="text/javascript" src="assets/swalPackage/dist/sweetalert2.js"></script>
		<script type="text/javascript" src="assets/swalPackage/dist/sweetalert2.all.min.js"></script>
		<script type="text/javascript" src="assets/swalPackage/dist/sweetalert2.min.js"></script>
		<!-- Animation on Scroll -->
		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
		<script>
		  AOS.init({
		  duration: 600 
		  });
		</script>
		<!-- Pantalla de Carga -->
		<script src="assets/js/pantalla_carga.js"></script>');

 	}


 	public function linksFooter(){

 		echo ('<!-- Link JQuery -->
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
						<!-- Owl Carousel -->
						<script src="assets/owlcarrusel/js/jquery.min.js"></script>
						<script src="assets/owlcarrusel/js/owl.carousel.min.js"></script>
						<!-- Js Bootstrap -->
						<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
						<script type="text/javascript" src="assets/bootstrap/js/bootstrap.bundle.js"></script>
						<!-- Sweet Alert -->
						<script type="text/javascript" src="assets/swalPackage/dist/sweetalert2.js"></script>
						<script type="text/javascript" src="assets/swalPackage/dist/sweetalert2.all.min.js"></script>
						<script type="text/javascript" src="assets/swalPackage/dist/sweetalert2.min.js"></script>
						<!-- Animation on Scroll -->
						<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
						<script>
						  AOS.init({
						  duration: 600 
						  });
						</script>
						<!-- Pantalla de Carga -->
						<script src="assets/js/pantalla_carga.js"></script>');
 	}


 }


 ?>
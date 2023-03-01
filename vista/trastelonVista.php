	<html>
	<head>
	<title>Trastelon</title>
	<link rel="stylesheet" type="text/css" href="assets/css/trastelon.css">
	</head>
	<body>

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

	<section class="main">

		<div class="container-md p-4 pt-5 container-historia">
				<div class="pb-5 body-historia">
					<h2 class="title-historia">LA HISTORIA DE NUESTRO TEATRO <i class="fas fa-building-columns"></i></h2>
					<hr class="hr1"> <br>
					<div class="row">
						<div class="col-md-8 my-3">
							<p class="card-text historia-text h5 mx-2">Llega el 19 de mayo de 1821 José de la Cruz Carrillo a El Tocuyo; su ejército se refuerza con los 500 hombres que trajo de Mérida el Coronel Miguel Vicente Cegarra y con el Batallón Maracaibo de la División Urdaneta que recibe en Barquisimeto. Dónde toma órdenes de marchar a San Felipe, Puerto Cabello y Valencia, movimiento que estratégicamente había delineado El Libertador Simón Bolívar Palacios para distraer al enemigo, quien envía sus tropas el 25 de junio contra el Ejército Libertador. La participación del General en Jefe José de La Cruz Carrillo Terán en esta lucha fue esencial, logró interceptar un cuantioso parque destinado a los realistas, por lo que su acción fue de igual valor, tomando parte de la Batalla en Carabobo, de ahí comienza un decreto desde 1890 de la asamblea legislativa del estado Lara, hasta 1891 cuando finalmente se decreta a través del ejecutivo del estado la construcción de un teatro para Barquisimeto, donde se realizarían todos los intercambios y actividades culturales dentro del estado Lara. </p>
						</div> 
							<div class="col-md-4 col-sm-8 col-10 card img-historia p-2 d-flex justify-content-center aling-items-center my-auto mx-auto">
							<img src="assets/img/Historia/1.jpg" class="w-100" height="314">
							<p class="card-text vistas-text-historia h6">
							Teatro Municipal 1905 </p>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-8 my-3">
							<p class="card-text historia-text h5 mx-2"> Cuando esto sucede se buscaron los servicios del ingeniero Luis Muñoz Tébar quién era el encargado de diseñar la estructura del teatro inspirado en arquitectura francesa, luego se buscó el presupuesto con un monto asignado de doscientos mil Bolívares y el presidente de la república en 1895 decide que el ejecutivo nacional encargaría de la obra. Fue luego de 1897 Aquilino Juárez logra gestionar el terreno para la construcción, en 1899 los revolucionarios invaden Barquisimeto y los ciudadanos se vieron obligados a encuartelarse dentro del Teatro Juares y también dentro del viejo mercado público de Barquisimeto en donde tomaron como fortín estos espacios causando gran daño a las estructuras. Para finales de 1899 ya había apariciones y actuaciones en el Teatro, sin embargo, el mismo no tuvo una inauguración adecuada por lo que se tomó una fecha del primer documento para el registro y en 1905 se le nombró como “Teatro Municipal” La ciudad de Barquisimeto vuelve a ser invadida, el Teatro queda en mal estado de nuevo, pero entonces el general y doctor Rafael Gonzales Pacheco hace el decreto para la restauración de éste.</p>
						</div>
						<div class="col-md-4 col-sm-8 col-10 card img-historia p-2 d-flex justify-content-center aling-items-center my-auto mx-auto">
							<img src="assets/img/Historia/2.jpg" class="w-100" height="314">
							<p class="card-text vistas-text-historia h6">
							Re-construcción 1949
							</p>
						</div>
					</div> 
					<br>
					<div class="row">
						<div class="col-md-8 my-3">
							<p class="card-text historia-text h5 mx-2">Luego en 1912 el “Teatro Municipal” cambia su nombre en homenaje al representante Aquilino Juárez a “Teatro Juares” cambiando la “Z” por la “S” en su apellido. En 1949 el gobernador manda hacer un estudio técnico donde se llegó a la conclusión de que debía ser demolido sin embargo los muros no fueron demolidos por lo que no pudo ser expandido. El teatro finalmente se inaugura el 14 de septiembre de 1950, se remodeló por dentro dándole modernismo con butacas, sistema de sonido e iluminación y desde el 20 de febrero del 2005 forma parte de la lista de patrimonios de la nación a través de la resolución N° 003-05 por lo cual el Instituto de Patrimonio Cultural le da carácter de bien de interés cultural que en la Legislación Venezolana significa patrimonio cultural según el artículo N°99 en la Constitución de la República Bolivariana de Venezuela por lo que tiene toda una legislación protegiéndolo y una providencia del Ministerio de Cultura conjuntamente con el Instituto del Patrimonio Cultural que es general para todos los bienes en cuanto a la conservación, cuidado y porque es importante cuidarlo.</p>
						</div>	

						<div class="col-md-4 col-sm-8 col-10 card img-historia p-2 m-2 d-flex justify-content-center aling-items-center my-auto mx-auto">
							<img src="assets/img/Historia/3.jpg" class="w-100" height="314">
							<p class="card-text vistas-text-historia h6">
							Teatro Juares 1950
							</p>
						</div>
					</div>
				</div>
			</div>
		<div id="separator-ribbon">
			<div class="content" style="background: #710014;">
				<p class="titulo" id="Aforo">AFORO</p>
			</div>
		</div>	

				<div class="container-md p-5 container-audiencia">
				<div class="row pb-5 body-audiencia">
					<h2 class="title-escenario">AFORO DEL TEATRO <i class="fas fa-users"></i></h2>
					<hr class="hr1"> 
					<p class="card-text escenario-text h5">
					Cuenta con una capacidad de 708 asientos los cuales se dividen en tres áreas: El área principal o patio (387) este se subdivide en cuatro bloques que van desde el bloque A hasta el bloque D, los balcones o palcos (47) se subdivide en el palco oeste, este y el palco presidencial, y la galería (274) que se subdivide en la galería de la zona oeste y la de la zona este, todas estas áreas cuentan con molderas de yeso que fueron restauradas tal cual el original, tanto en forma como en color.
					<br>
					<br>
					Tiene cuatro puertas de acceso: dos laterales y dos por el foyer. Las puertas son metálicas y están rellenas con pulioretano para aislar el sonido. Cuenta con seis (6) baños para el público y dos públicos para el personal administrativo. La boleteria se dispone en ambos laterales de la edificación. 
					</p>

					<div class="row my-3">
						<div class="col-md card img-aforo p-2 m-2">
							<img src="assets/img/Aforo/Palcos.jpg" class="w-100" height="314">
							<p class="card-text vistas-text h6">
							Palcos
							</p>
						</div>

						<div class="col-md card img-aforo p-2 m-2">
							<img src="assets/img/Aforo/General.jpg" class="w-100" height="314">
							<p class="card-text vistas-text h6">
							Vista general
							</p>
						</div>

						<div class="col-md card img-aforo p-2 m-2">
							<img src="assets/img/Aforo/Marco.jpg" class="w-100" height="314">
							<p class="card-text vistas-text h6">
							Vista hacia el escenario
							</p>
						</div>
					</div>

					<div class="info-aforo p-3 my-2">
						<h5 class="title-info"><i class="fas fa-circle-info"></i> Algunos datos acerca del aforo:</h5>
						<ul>
							<li><p class="info-text h6">El estilo del Teatro Juares esta inspirado en la Italia del siglo XIX.</p></li>
							<li><p class="info-text h6">El techo de la audiencia es de drywall. Cuenta con un sistema de pasarelas superiores para el mantenimiento.</p></li>
							<li><p class="info-text h6">Cuenta con un sistema contra incendios que incluye detectores iónicos.</p></li>
							<li><p class="info-text h6">Las butacas son de color rojo y miden ente 21 y 23 pulgadas de ancho. Fueron fabricadas en Brasil y traidas a nuestra ciudad por la compañia Gateca.</p></li>
							<li><p class="info-text h6">Un baño para damas y otro para caballeros tienen ascensor para discapacitados. Un aporte de la empresa Aproconstrucciones.</p></li>
						</ul>
					</div>
				</div>
			</div>			

		<div id="separator-ribbon">
			<div class="content" style="background: #F98F27;">
				<p class="titulo" id="Escenario">ESCENARIO</p>
			</div>
		</div>		

		<div class="container-md p-5 container-escenario">
				<div class="row pb-5 body-escenario">
					<h2 class="title-escenario">ESCENARIO DEL TEATRO <i class="fas fa-table"></i></h2>
					<hr class="hr1"> 
					<p class="card-text escenario-text h5">
					Tiene un área exacta de 185 metros cuadrados. La madera del piso fue completamente sustituida y se instal+o na diva acústica, novedad en la ciudad de Barquisimeto. Esta última cuenta con 8.5 metos de alto, 7 de ancho y lo mismo de pronfundidad. La diva crea una condición especial de acústica. También fue sustituido el enchapado de la pared y restaurado el suelo del foso para músicos.
					</p>


					<div class="row my-3">
						<div class="col-md card img-escenario p-2 m-2">
							<img src="assets/img/Escenario/Camaras.jpg" class="w-100" height="314">
							<p class="card-text vistas-text-escenario h6">
							Cámaras
							</p>
						</div>

						<div class="col-md card img-escenario p-2 m-2">
							<img src="assets/img/Escenario/Telones.jpg" class="w-100" height="314">
							<p class="card-text vistas-text-escenario h6">
							Telones
							</p>
						</div>

						<div class="col-md card img-escenario p-2 m-2">
							<img src="assets/img/Escenario/Trampilla.jpg" class="w-100" height="314">
							<p class="card-text vistas-text-escenario h6">
							Trampilla
							</p>
						</div>
					</div>
 
					<div class="info-escenario p-3 my-2">
						<h5 class="title-info"><i class="fas fa-circle-info"></i> Algunos datos acerca del escenario:</h5>
						<ul>
							<li><p class="info-text h6">Es un teatro a la "Italiana", es decir, que este teatro está inspirado en las obras arquitéctonicas italianas del siglo XIX. Dicho estilo puede ser observado en el marco del escenario.</p></li>
							<li><p class="info-text h6">La embocadura del escenario es de madera.</p></li>
							<li><p class="info-text h6">El plano del escenario se divide de la siguiente manera: </p></li>
							<ol>
							<li><p class="info-text h6">Telon de boca: Es usado para ocultar al público los posibles cambios en la escenografía.</p></li>
							<li><p class="info-text h6">Telon negro o Cuchilla: Es usado para absorver la luz y esconder objetos.</p></li>
							<li><p class="info-text h6">Americana: Se cierra en la parte media del escenario.</p></li>
							<li><p class="info-text h6">Ciclorama: Proyecta imágenes desde atras hacia adelante y viceversa.</p></li>
							</ol>
						</ul>
					</div>
				</div>
			</div>

		<div id="separator-ribbon">
			<div class="content" style="background: #34752B;">
				<p class="titulo" id="Área Técnica">ÁREA TÉCNICA</p>
			</div>
		</div>	


		<div class="container-md p-5 container-areas">
				<div class="row pb-5 body-areas">
					<h2 class="title-areas">ÁREA TÉCNICA DEL TEATRO <i class="fas fa-toolbox"></i></h2>
					<hr class="hr1"> 
					<p class="card-text areas-text h5">
					Detras del telón hay labores fundamentales, los cuales no se ven, pero son muy importantes para que el evento transcurra satisfactoriamente. A continuación podrás conocer un poco más de éstas y sus responsables:	
					</p>


					<div class="row my-3">
						<div class="col-lg-8 col-md-7 col-sm-12 col-12 my-auto">
							<div class="areas-info card">
							<h5 class="title-areas-info text-center pt-3 mx-auto">ÁREA DE TRAMOYA</h5>
							<p class="text-areas p-3">La tramoya es el conjunto de actividades que intervienen en la realización de un escenario, con el fin de representar en él, una acción "dramática". En la Fundacion Teatro Juares contamos con un sistema eléctrico de tramoya el cual consta de 10 motores, cada uno de 4 caballos de fuerza, estos ayudan a bajar y subir los telones más grandes, contando con contra peso en cada barra para que el telón no caiga con fuerza.
							</p>

							<p class="p-2 text-center"><i class="fas fa-user-gear"></i> Operador de Tramoya: José Ocanto</p>
							</div>
						</div>

						<div class="col-lg col-md col-sm-10 col-10 card img-areas p-2 m-2 mt-3 my-auto mx-auto">
							<img src="assets/img/Area Tecnica/Tramoya.jpg" class="w-100" height="314">
							<p class="card-text vistas-text-areas h6">
							Área eléctrica tramoya
							</p>
						</div>
					</div>

					<div class="row my-3">
						<div class="col-lg-8 col-md-7 col-sm-12 col-12 my-auto">
							<div class="areas-info card">
							<h5 class="title-areas-info text-center pt-3 mx-auto">ÁREA DE ILUMINACIÓN</h5>
							<p class="text-areas p-3">El objetivo del área de iluminación es iluminar al intérprete, revelar correctamente la forma de todo lo que está en escena, ofrecer la imagen del escenario con una composición de luz que pueda cambiar tanto la percepción del espacio como la del tiempo. En la cabina de iluminación contamos con una consola que gradúa la iluminación del escenario, asi como tambien un seguidor que es utilizado en obras, las cuales requieren iluminación hacia una sola persona, así como también se maneja la apertura y cierre del telón principal.
							</p>

							<p class="p-2 text-center"><i class="fas fa-user-gear"></i> Técnico de iluminación: Iván Carrasco</p>
							</div>
						</div>

						<div class="col-lg col-md col-sm-10 col-10 card img-areas p-2 m-2 mt-3 my-auto mx-auto">
							<img src="assets/img/Area Tecnica/Iluminacion.jpg" class="w-100" height="314">
							<p class="card-text vistas-text-areas h6">
							Consola para graduar la iluminación
							</p>
						</div>
					</div>

					<div class="row my-3">
						<div class="col-lg-8 col-md-7 col-sm-12 col-12 my-auto">
							<div class="areas-info card">
							<h5 class="title-areas-info text-center pt-3 mx-auto">ÁREA DE SONIDO</h5>
							<p class="text-areas p-3">Cuando hablamos de área de sonido, hablamos de sonido escénico, y se refiere al universo sonoro de una obra de teatro, es decir, el conjunto de eventos sonoros, prácticas y procedimientos musicales, los cuales son oídos por el público. En nuestras instalaciones contamos con una planta Yamaha de 44 canales de audio, digital y analogica, desde la cabina de sonido el técnico se encarga de que el audio sea acorde al evento así como tambien si es necesario reproducir himnos o canciones según se requiera.
							</p>

							<p class="p-2 text-center"><i class="fas fa-user-gear"></i> Técnico de sonido: José León</p>
							</div>
						</div>

						<div class="col-lg col-md col-sm-10 col-10 card img-areas p-2 m-2 mt-3 my-auto mx-auto">
							<img src="assets/img/Area Tecnica/Sonido.jpg" class="w-100" height="314">
							<p class="card-text vistas-text-areas h6">
							Cabina de sonido
							</p>
						</div>
					</div>
				</div>
			</div>		


	</section>	

	<?php $_comp->footer(); ?>
	<script src="assets/js/boton_ir_arriba.js"></script>

	</body>
</html>
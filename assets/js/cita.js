$(document).ready(function(){

	var nombreEvento = $("#nombreEvento-reservacion");
	var servicio = $("#servicio-reservacion");
	var otros = false;
	var otroServicio = $("#otroServicio");
	var espacio = $("#espacio-reservacion");
	var codigo = $("#telefono-reservacion");
	var fecha = $("#date");
	var hora = $("#hora");
	var correo = $("#correo-reservacion");
	var numeroTlfno = $("#contacto-reservacion");
	var descripcion = $("#descripcion-reservacion");
	var archivo = $("#archivo");

	var razon = $("#razon");

	var erNomE = /^[a-zA-ZÀ-ÿ\u00f1\u00d10-9_\ \.]{3,60}$/;
	var erSerE = /^[a-zA-Z\ \-]{3,30}$/;
	var erCorreo = /^[a-zA-Z0-9_\.\-]+@[a-z0-9\-]+\.[a-zA-Z0-9\-]{2,4}$/;
	var erNumero = /^[0-9\-]{7}$/;
	var extPermitida = /(.pdf)$/i;
	var erNumeroPer = /^[1-6\-]{1}$/;
  	var erNumerosPer = /^[1-2\-]{1}$/;
	
	$("#otros").hide();
	$("#empresa").hide();

	$("#nombreEvento-reservacion").focusout(function(){
		if (!erNomE.test(nombreEvento.val())) {

			$("#errorNombre").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el nombre</div>');
			$("#errorNombre").show();
			$("#nombreEvento-reservacion").css("border","2px solid #F90A0A");
		}
		else{

			$("#errorNombre").html(" ");
			$("#errorNombre").hide();
			$("#nombreEvento-reservacion").css("border","2px solid #ced4da");
		}
	})

	$("#servicio-reservacion").change(function(){
			
		if (erNumeroPer.test(servicio.val())) {

			$("#errorServicio").html(" ");
			$("#errorServicio").hide();
			$("#servicio-reservacion").css("border","2px solid #ced4da");	

			if (servicio.val() == 6) {

				$("#otros").show();
				otros = true;
			
				$("#otroServicio").focusout(function(){
					if (!erSerE.test(otroServicio.val())){

						$("#errorOtro").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el servicio ingresado</div>');
						$("#errorOtro").show();
						$("#otroServicio").css("border","2px solid #F90A0A");
					}
					else{

						$("#errorOtro").html(" ");
						$("#errorOtro").hide();
						$("#otroServicio").css("border","2px solid #ced4da");
					}
				})
			}
			else{
				$("#otros").hide();
				$("#errorOtro").hide();
				otros = false;
			}
		} else {

			$("#errorServicio").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Valor Inválido</div>');
			$("#errorServicio").show();
			$("#servicio-reservacion").css("border","2px solid #F90A0A");

		}
	})

	$("#espacio-reservacion").change(function(){
		
		if (erNumerosPer.test(espacio.val())) {

			$("#errorEspacio").html(" ");
			$("#errorEspacio").hide();
			$("#espacio-reservacion").css("border","2px solid #ced4da");
		} else {

			$("#errorEspacio").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Valor Invalido</div>');
			$("#errorEspacio").show();
			$("#espacio-reservacion").css("border","2px solid #F90A0A");
		}
	})

	$("#date").focusout(function(){
		var hoy = Date.now();
		if (Date.parse(fecha.val()) < hoy) {
			
			$("#errorFecha").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la Fecha</div>');
			$("#errorFecha").show();
			$("#date").css("border","2px solid #F90A0A");
		}
		else{

			$("#errorFecha").html(" ");
			$("#errorFecha").hide();
			$("#date").css("border","2px solid #ced4da");
		}
	})

	$("#hora").focusout(function(){
		var horaSeg = ((hora.val().substring(0, 2) * 60)*60) + (hora.val().substring(3, 5)* 60);
		if (((horaSeg < 32400) || (horaSeg > 43200)) && ((horaSeg < 46800) || (horaSeg > 57600))) {
			
			$("#errorHora").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la Hora</div>');
			$("#errorHora").show();
			$("#hora").css("border","2px solid #F90A0A");
		}
		else{
		
			$("#errorHora").html(" ");
			$("#errorHora").hide();
			$("#hora").css("border","2px solid #ced4da");
		}
	})

	$("#descripcion-reservacion").focusout(function(){
		if (descripcion.val().length<150 && descripcion.val().length>10) {

			$("#errorDescripcion").html(" ");
			$("#errorDescripcion").hide();
			$("#descripcion-reservacion").css("border","2px solid #ced4da");
		}
		else{

			$("#errorDescripcion").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la descripción</div>');
			$("#errorDescripcion").show();
			$("#descripcion-reservacion").css("border","2px solid #F90A0A");
		}
	})

	$("#empresaCheck").click(function(){

		
		if( $("#empresaCheck").prop('checked')){

			$("#empresa").show();

			$("#razon").focusout(function(){
				if (!erNomE.test(razon.val())) {

					$("#errorRazon").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el nombre de la organización/empresa</div>');
					$("#errorRazon").show();
					$("#razon").css("border","2px solid #F90A0A");
				}
				else{
					$("#errorRazon").html(" ");
					$("#errorRazon").hide();
					$("#razon").css("border","2px solid #ced4da");
				}
			});

			$("#correo-reservacion").focusout(function(){
				if (!erCorreo.test(correo.val())) {

					$("#errorCorreo").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el Correo</div>');
					$("#errorCorreo").show();
					$("#correo-reservacion").css("border","2px solid #F90A0A");
				}
				else{
					$("#errorCorreo").html(" ");
					$("#errorCorreo").hide();
					$("#correo-reservacion").css("border","2px solid #ced4da");
				}
			});

			$("#telefono-reservacion").change(function(){
				if (!erNumeroPer.test(codigo.val())) {
					
					$("#errorCod").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el Codigo</div>');
					$("#errorCod").show();
					$("#telefono-reservacion").css("border","2px solid #F90A0A");
				}
				else{

					$("#errorCod").html(" ");
					$("#errorCod").hide();
					$("#telefono-reservacion").css("border","2px solid #ced4da");
				}
			});

			$("#contacto-reservacion").focusout(function(){
				if (!erNumero.test(numeroTlfno.val())) {

					$("#errorTel").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el numero ingresado</div>');
					$("#errorTel").show();
					$("#contacto-reservacion").css("border","2px solid #F90A0A");
				}
				else{
					$("#errorTel").html(" ");
					$("#errorTel").hide();
					$("#contacto-reservacion").css("border","2px solid #ced4da");
				}
			});
		}
		else{

			$("#empresa").hide();
		}
	})


	$("#archivo").focusout(function(){
		if (!extPermitida.exec(archivo.val())) {
			
			$("#archivo").css("border","2px solid #F90A0A");
		}
		else{
			$("#archivo").css("border","2px solid #ced4da");
		}
	})

	$("#enviar").on("click", function(e){


		var horaSeg = ((hora.val().substring(0, 2) * 60)*60) + (hora.val().substring(3, 5)* 60);
		var hoy = Date.now();

		if (nombreEvento.val()==""&&fecha==""&&descripcion.val()==""&&archivo.val()==""&&hora.val()=="") {

			e.preventDefault();
			Swal.fire({ 
				icon: 'error',
	  			title: 'Error',
	  			text: 'Antes de enviar por favor rellene todos los campos'
	  		})
		}

		if (nombreEvento.val()==""||fecha.val()==""||descripcion==""||archivo.val()=="" || hora.val()=="") {

			e.preventDefault();
			$("#error").html('Por favor llene todos los campos');
		}

		else if (!erNomE.test(nombreEvento.val())) {

			e.preventDefault();
			$("#error").html('El nombre del evento no cumple con los parámetros del Teatro');
		}

		else if (!erNumeroPer.test(servicio.val())) {
			e.preventDefault();
			$("#error").html('Seleccione alguno de los servicios');
			
		}

		else if (!erNumerosPer.test(espacio.val())) {
			e.preventDefault();
			$("#error").html('Seleccione alguno de los espacios');
			
		}

	
		else if (Date.parse(fecha.val()) < hoy) {

			e.preventDefault();
			$("#error").html('Error! La fecha es incorrecta');
			
		}
		else if(((horaSeg < 28800) || (horaSeg > 43200)) && ((horaSeg < 46800) || (horaSeg > 57600))) { 

			e.preventDefault();
			$("#error").html('Error! La hora es incorrecta');
			
		}

		else if (descripcion.val().length>150 && descripcion.val().length<10) {

			e.preventDefault();
			$("#error").html('Error! La descripción debe ser de 10 a 150 caracteres');
			
		}

		else if (!extPermitida.exec(archivo.val())) {

			e.preventDefault();
			$("#error").html('Error! El archivo debe ser .pdf');
			
		}

		else if(otros == true){

			if (otroServicio.val() == "") {

				e.preventDefault();
				$("#error").html('Inserte un servicio');
			}
			else if(!erSerE.test(otroServicio.val())){
				e.preventDefault();
				$("#error").html('Ingrese un servicio valido');
			}
			else{
				swal.fire({

					icon: "success",
					title: "¡Su Solicitud a Sido Enviada Correctamente!",
					html:'<button type="submit" form="formReserva" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-check me-2"></i>Aceptar</button>',
					showConfirmButton: false,
					allowOutsideClick: false,
					allowEscapeKey: false,
				})
			}

		}

		else if($("#empresaCheck").prop('checked') == true) {

			if (correo.val()==""&&numeroTlfno.val()==""&&razon.val()=="") {


				e.preventDefault();
				Swal.fire({ 
				icon: 'error',
	  			title: 'Complete los Campos solicitados de la Empresa'
	  		})

			}

			else if (!erNomE.test(razon.val())) {

			e.preventDefault();
			$("#error").html('Error! La Razón Social no es Correcta');
			}

			else if (!erCorreo.test(correo.val())) {
			
			e.preventDefault();
			$("#error").html('Error! El correo es invalido');
		
			}

			else if (!erNumeroPer.test(codigo.val())) {
			e.preventDefault();
			$("#error").html('Seleccione algún código de contacto');
			
			}

			else if (!erNumero.test(numeroTlfno.val())) {

			e.preventDefault();
			$("#error").html('Error! Numero de teléfono incorrecto');
		
			}

			else {

				$("#error").html(' ');

				swal.fire({

					icon: "success",
					title: "¡Su Solicitud a Sido Enviada Correctamente!",
					html:'<button type="submit" form="formReserva" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-check me-2"></i>Aceptar</button>',
					showConfirmButton: false,
					allowOutsideClick: false,
					allowEscapeKey: false,
				})

			}

		}
	
		else {
			
				$("#error").html(' ');

				swal.fire({

					icon: "success",
					title: "¡Su Solicitud a Sido Enviada Correctamente!",
					html:'<button type="submit" form="formReserva" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-check me-2"></i>Aceptar</button>',
					showConfirmButton: false,
					allowOutsideClick: false,
					allowEscapeKey: false,
				})

		}
	})
})
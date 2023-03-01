$(document).ready(function(){

	//VARIABLES

	//VARIABLE DE OPCIONES
	var optEvento = " ";
	var optCategoria = " ";
	var asientoRegistrados = [false, false, false];

	//VARIABLES DE LAS TABLAS
	var tlbEventos    = $('#tblEventosdata').DataTable();
	var tblCategorias = $('#tblCategdata').DataTable();

	//VARIABLES DE FORMULARIO DE EVENTO
	var nro           = $("#funcionNro");
	var nombre        = $("#funcionNombre");
	var director      = $("#funcionDirec");
	var fecha         = $("#funcionFecha");
	var horaIni       = $("#funcionHoraIni");
	var horaFin       = $("#funcionHoraFin");
	var categoria     = $("#funcionCateg");
	var descripciones = $("#describirFuncion");
	var archivo       = $("#funcionFoto");
	var patioCheck;
	var palcosCheck;
	var galeriaCheck;
	var patioDis = false;
	var palcosDis = false;
	var galeriaDis = false;

	//VARIABLES DE PRECIO DE AREAS
	var precioPat = $("#precioPatio");
	var precioPal = $("#precioPalco");
	var precioGal = $("#precioGaleria");

	//VARIABLES DE LOS ASIENTOS
	var asientosPat = [];
	var asientosPal = [];
	var asientosGal = [];
	var asientosActuPat = [];
	var asientosActuPal = [];
	var asientosActuGal = [];

	//VARIABLES DE FORMULARIO DE CATEGORIA
	var nroCategoria    = $("#nroCateg");
	var nombreCategoria = $('#nombreCateg');

	//VARIABLES DE FORMULARIO DE REPORTE EVENTO
	var fechaIniReporte     = $("#fechaIniReporte");
	var fechaFinReporte     = $('#fechaFinReporte');
	var categoriaReporte    = $("#categReporte");
	var estadoReporte       = $('#estadoEventoReporte');

	//EXPRESIONES REGULARES DE EVENTOS
	var erNombre      = /^[a-zA-ZÀ-ÿ\u00f1\u00d10-9_\ \.\-¡!¿?]{1,20}$/;
	var erDirector    = /^[a-zA-ZÀ-ÿ\ \u00f1\u00d1]{1,20}$/;
	var extPermitida1 = /(.png)$/i;
	var extPermitida2 = /(.jpg)$/i;	

	//EXPRESIONES REGULARES DE CATEGORIAS
	var erNombreCateg = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\ ]{1,20}$/;

	//FUNCIONES 

	//SWEET ALERTS
	function FuncionNueva(tipo, mensaje, tipoAgregado){

		swal.fire({

			icon: tipo, 
			title: mensaje,
			showConfirmButton: true,
			confirmButtonColor: "#198754",
			allowOutsideClick: false,
			allowEscapeKey: false,
		}).then((result) => {
			if (result.isConfirmed){
				
				if(tipoAgregado == 1){

					$("#funcionNombre").css("border","2px solid #ced4da");
					$("#funcionDirec").css("border","2px solid #ced4da");
					$("#funcionFecha").css("border","2px solid #ced4da");
					$("#funcionHoraIni").css("border","2px solid #ced4da");
					$("#funcionHoraFin").css("border","2px solid #ced4da");
					$("#funcionCateg option").removeAttr("selected");
					$("#funcionCateg").css("border","2px solid #ced4da");
					$("#describirFuncion").css("border","2px solid #ced4da");
					$("#funcionFoto").css("border","2px solid #ced4da");
					$(".erroresEvento").hide();
					$("#funcionForm").trigger('reset');
					$.post("",{nroEvento: true}, function(r){

						var data = JSON.parse(r)
			
						$("#funcionNro").val(parseInt(data["nro"])+1);
					})
				}
				else if(tipoAgregado == 2){

					$("#nombreCateg").css("border","2px solid #ced4da");
					$("#errorNombreCateg").hide();
					$("#categoriaForm").trigger('reset');

					$.post("",{nroCateg: true}, function(r){

						var data = JSON.parse(r)

						$("#nroCateg").val(parseInt(data["nro"])+1);
					})
				}
			} 
		})
	};
	
	function FuncionFallida(tipo, mensaje){
		swal.fire({

			icon: tipo,
			title: mensaje,
			confirmButtonText: "Ok",
			confirmButtonColor: "#198754",
		})
	}

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

	//FUNCIONES PARA CONSULTAR Y ACTUALIZAR TABLAS
	function actualizarTblEventos(){

		tlbEventos.destroy();

		$.ajax({
			url: '',
			type: 'POST',
			data: {consultarEventos: 1},
			success: function(r) {

				var eventosRegistrados = JSON.parse(r);
				var tabla = '';
				eventosRegistrados.forEach(eventosRegistrados => {
					
					var fecha = new Date(eventosRegistrados.fechaEvento).toLocaleDateString()
					var horaIni
					var horaFin

					if(eventosRegistrados.horaInicio.substring(0, 2) > 12){
						
						var primerosDigitos = eventosRegistrados.horaInicio.substring(0, 2) - 12
						if(primerosDigitos <10){

							horaIni = "0"+primerosDigitos + eventosRegistrados.horaInicio.substring(2, 8) +" PM"
						}
						else{

							horaIni = primerosDigitos + eventosRegistrados.horaInicio.substring(2, 8) +" PM"
						}
					}else{
						
						horaIni =  eventosRegistrados.horaInicio +" AM"
					}

					if(eventosRegistrados.horaFinal.substring(0, 2) > 12){
						
						var primerosDigitos = eventosRegistrados.horaFinal.substring(0, 2) - 12
						if(primerosDigitos <10){

							horaFin = "0"+primerosDigitos + eventosRegistrados.horaFinal.substring(2, 8) +" PM"
						}
						else{

							horaFin = primerosDigitos + eventosRegistrados.horaFinal.substring(2, 8) +" PM"
						}
					}else{
						
						horaFin =  eventosRegistrados.horaFinal +" AM"
					}

					tabla += `
							<tr>
								<td class="tabla">${eventosRegistrados.nroEvento} </td>
								<td class="tabla">${eventosRegistrados.nombre}</td>
								<td class="tabla" style="max-width: 150px;">${eventosRegistrados.descripcion}</td>
								<td class="tabla">${fecha}</td>
								<td class="tabla" style="max-width: 100px;">${horaIni} - ${horaFin}</td>
								<td class="tabla">${eventosRegistrados.nombreCategoria}</td>
								<td class="tabla">${eventosRegistrados.director}</td>
								<td class="tabla" style="max-width: 150px;">${eventosRegistrados.imagenEvento}</td>
								<td class="acciones">
									<button type="button" value="${eventosRegistrados.nroEvento}" class="btn btn-primary ms-2 mt-1 b-asientos"  data-bs-toggle="modal"  data-bs-target="#modalAsientos"><i class="fa-solid fa-chair i-asientos"></i></button>
									<button type="button" value="${eventosRegistrados.nroEvento}" class="btn btn-primary ms-2 mt-1 b-modificar" data-bs-toggle="modal" data-bs-target="#modalEventos"><i class="fa-sharp fa-solid fa-pen-to-square i-modificar"></i></button>
									<button type="button" value="${eventosRegistrados.nroEvento}" class="btn btn-primary ms-2 mt-1 b-borrar"><i class="fa-sharp fa-solid fa-trash i-borrar"></i></button>
								</td>
							</tr>
						`
				});

				$('#tblEventos').html(tabla);

				tlbEventos = $('#tblEventosdata').DataTable({

					"columnDefs": [
						{ orderable: false, targets: [7,8] }
					],
					"language": { 
						url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
					}
				});
			}
		});
	}

	function actualizarTblCategoria(){

		tblCategorias.destroy();
		$('#filtroCateg').html(' ');
		$('#funcionCateg').html('<option id="selecionarDefault" value="0">Seleccionar</option>');
		$('#categReporte').html('<option selected value="0">Todas</option>');
		$('#filtroCateg').html('<option selected value="0">Todas</option>');

		$.ajax({
			url: '',
			type: 'POST',
			data: {consultarCategoria: 1},
			success: function(r) {

				var categoriasRegistradas = JSON.parse(r);
				var tabla = '';
				var seleccion = '';

				categoriasRegistradas.forEach(categoriasRegistradas => {
					tabla += `
							<tr>
								<td class="tabla">${categoriasRegistradas.idCategoria} </td>
								<td class="tabla">${categoriasRegistradas.nombreCategoria}</td>
								<td class="acciones">
									<button value="${categoriasRegistradas.idCategoria}" type="button" data-bs-toggle="modal" data-bs-target="#modalCateg" class="btn btn-primary ms-2 mt-1 b-modificar-categ"><i class="fa-sharp fa-solid fa-pen-to-square i-modificar"></i></button>
									<button value="${categoriasRegistradas.idCategoria}" type="button" class="btn btn-primary ms-2 mt-1 b-borrar-categ"><i class="fa-sharp fa-solid fa-trash i-borrar"></i></button>
								</td>
							</tr>
						`
					seleccion +=`
					<option value="${categoriasRegistradas.idCategoria}" id="categ${categoriasRegistradas.idCategoria}">${categoriasRegistradas.nombreCategoria} </option>
					`;	
				});
				$('#tblCategorias').html(tabla);
				$('.selectCateg').append(seleccion); 

				tblCategorias = $('#tblCategdata').DataTable({

					"columnDefs": [
						{ orderable: false, targets: [2] }
					],
					"language": { 
						url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
					}
				});
			}
		});
	}

	//FUNCIÓN PARA COMPROBAR ERRORES EN EL FORMULARIO DE EVENTOS
	function comprobacionErrores(){

		var presenciaError = false;

		var verNombre = erNombre.test(nombre.val());
		if (verNombre == true){

			$("#errorNom").html(" ");
			$("#errorNom").hide();
            $("#funcionNombre").css("border","2px solid #34F458");
        }
        else{

			$("#errorNom").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el nombre</div>');
			$("#errorNom").show();
			$("#funcionNombre").css("border","2px solid #F90A0A");
			presenciaError = true;
        }

		var verDirector = erDirector.test(director.val());
		if ( verDirector == true || director.val() == ""){

			$("#errorDirec").html(" ");
			$("#errorDirec").hide();
            $("#funcionDirec").css("border","2px solid #34F458");
        }
        else{

			$("#errorDirec").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el director</div>');
			$("#errorDirec").show();
			$("#funcionDirec").css("border","2px solid #F90A0A");
			presenciaError = true;
        }

		var hoy = Date.now()
		if (Date.parse(fecha.val()) > hoy){

			$("#errorFecha").html(" ");
			$("#errorFecha").hide();
            $("#funcionFecha").css("border","2px solid #34F458");
        }
        else{

			$("#errorFecha").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la fecha</div>');
			$("#errorFecha").show();
			$("#funcionFecha").css("border","2px solid #F90A0A");
			presenciaError = true;
        }
		
		var horaSeg =  ((horaIni.val().substring(0, 2) * 60)*60) + (horaIni.val().substring(3, 5)* 60);
		if (28800 <= horaSeg && horaSeg < 79200){

			$("#errorHoraIni").html(" ");
			$("#errorHoraIni").hide();
            $("#funcionHoraIni").css("border","2px solid #34F458");
        }
        else{

			$("#errorHoraIni").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la hora de inicio</div>');
			$("#errorHoraIni").show();
			$("#funcionHoraIni").css("border","2px solid #F90A0A");
			presenciaError = true;
        }

		var horaSeg =  ((horaFin.val().substring(0, 2) * 60)*60) + (horaFin.val().substring(3, 5)* 60);
		if (28800 <= horaSeg && horaSeg < 79200 && horaFin.val() >= horaIni.val()){

			$("#errorHoraFin").html(" ");
			$("#errorHoraFin").hide();
            $("#funcionHoraFin").css("border","2px solid #34F458");
        }
        else{

			$("#errorHoraFin").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la hora de finalización</div>');
			$("#errorHoraFin").show();
			$("#funcionHoraFin").css("border","2px solid #F90A0A");
			presenciaError = true;
        }

		if (categoria.val() != 0){

			$("#errorCateg").html(" ");
			$("#errorCateg").hide();
            $("#funcionCateg").css("border","2px solid #34F458");
        }
        else{

			$("#errorCateg").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione una Categoría</div>');
			$("#errorCateg").show();
			$("#funcionCateg").css("border","2px solid #F90A0A");
			presenciaError = true;
        }

        var verDescripcion = descripciones.val();
        if (verDescripcion.length > 10 && verDescripcion.length <= 150) {

			$("#errordescribir").html(" ");
			$("#errordescribir").hide();
            $("#describirFuncion").css("border","2px solid #34F458");
        }

        else {

			$("#errordescribir").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la descripción</div>');
			$("#errordescribir").show();
			$("#describirFuncion").css("border","2px solid #F90A0A");
			presenciaError = true;
        }

		if (extPermitida1.exec(archivo.val()) || extPermitida2.exec(archivo.val())) {

			$("#errorFoto").html(" ");
			$("#errorFoto").hide();
			$("#funcionFoto").css("border","2px solid #34F458");
		
		}
		else{
	
			$("#errorFoto").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifique que el archivo sea .png o .jpg</div>');
			$("#errorFoto").show();
			$("#funcionFoto").css("border","2px solid #F90A0A");
			presenciaError = true;
		}

		if($("#patioCheck").prop("checked")){

			patioDis = true
		} 
		
		if($("#palcosCheck").prop("checked")){

			palcosDis = true
		} 

		if($("#galeriaCheck").prop("checked")){

			galeriaDis = true
		} 

		if (palcosDis == true || galeriaDis == true || patioDis == true) {
	
			$("#errorArea").html(" ");
			$("#errorArea").hide();
		}
		else{

			$("#errorArea").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Debe haber al menos un area habilitada</div>');
			$("#errorArea").show();
			presenciaError = true;
		}

		return presenciaError;
	}

	//FUNCIÓN PARA COMPROBAR ERRORES EN EL FORMULARIO DE ASIENTOS
    function validarAsientos(){

		var presenciaError = false;

		if (Number(precioPat.val()) > 0 || (Number(precioPat.val()) == "" && $('#BtnPat').prop('disabled') == true)) {

			$("#errorPrecioPat").html(" ");
			$("#errorPrecioPat").hide();
			$("#precioPatio").css("border","2px solid #34F458");
		}
		else {

			$("#errorPrecioPat").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el precio</div>');
			$("#errorPrecioPat").show();
			$("#precioPatio").css("border","2px solid #F90A0A");
			presenciaError = true;
		}

		if (Number(precioPal.val()) > 0 || (Number(precioPal.val()) == ""  && $('#BtnPal').prop('disabled') == true)) {

			$("#errorPrecioPal").html(" ");
			$("#errorPrecioPal").hide();
			$("#precioPalco").css("border","2px solid #34F458");
		}
		else {

			$("#errorPrecioPal").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el precio</div>');
			$("#errorPrecioPal").show();
			$("#precioPalco").css("border","2px solid #F90A0A");
			presenciaError = true;
		}

		if (Number(precioGal.val()) > 0 || (Number(precioGal.val()) == "" && $('#BtnGal').prop('disabled') == true)){

			$("#errorPrecioGal").html(" ");
			$("#errorPrecioGal").hide();
			$("#errorArea").hide();
			$("#precioGaleria").css("border","2px solid #34F458");
		}
		else {
			$("#errorPrecioGal").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el precio</div>');
			$("#errorPrecioGal").show();
			$("#precioGaleria").css("border","2px solid #F90A0A");
			presenciaError = true;
		}

		if($('#BtnPat').prop('disabled') == false) {

			if(asientosPat.length <= 0 && asientoRegistrados[0] == false) {

				$("#ErroAsientos").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Debes seleccionar un asiento en cada area habilitada</div>');
				$("#ErroAsientos").show();
				presenciaError = true;
			}
		}

		if($('#BtnPal').prop('disabled') == false) {

			if(asientosPal.length <= 0 && asientoRegistrados[1] == false) {

				$("#ErroAsientos").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Debes seleccionar un asiento en cada area habilitada</div>');
				$("#ErroAsientos").show();
				presenciaError = true;
			}
		}

		if($('#BtnGal').prop('disabled') == false) {

			if(asientosGal.length <= 0 && asientoRegistrados[2] == false) {

				$("#ErroAsientos").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Debes seleccionar un asiento en cada area habilitada</div>');
				$("#ErroAsientos").show();
				presenciaError = true;
			}
		}

		return presenciaError;
    }

	//FUNCIÓN PARA COMPROBAR ERRORES EN EL FORMULARIO DE CATEGORIAS
    function validarNuevaCategoria(){

		var presenciaError = false;

		if (erNombre.test(nombreCategoria.val()) == true) {

			$('#errorNombreCateg').html(" ");
			$('#errorNombreCateg').hide();
			$("#nombreCateg").css("border","2px solid #34F458");
		}
		else{
			$("#errorNombreCateg").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>El nombre de la categoría es invalido</div>');
			$("#errorNombreCateg").show();
			$("#nombreCateg").css("border","2px solid #F90A0A");
			presenciaError = true;
		}

		return presenciaError;
    }

	//FUNCIÓN PARA COMPROBAR ERRORES EN EL FORMULARIO DE REPORTES
    function validarReporte(){

		var presenciaError = false;
		var hoy = Date.now()

		if (Date.parse(fechaIniReporte.val()) < hoy || fechaIniReporte.val() == ""){

			$("#errorFechaIniReporte").html(" ");
			$("#errorFechaIniReporte").hide();
            $("#fechaIniReporte").css("border","2px solid #34F458");
        }
        else{

			$("#errorFechaIniReporte").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la fecha</div>');
			$("#errorFechaIniReporte").show();
           	$("#fechaIniReporte").css("border","2px solid #F90A0A");
			presenciaError = true;
        }

		if ((Date.parse(fechaFinReporte.val()) <= hoy && Date.parse(fechaFinReporte.val()) > Date.parse(fechaIniReporte.val())) || fechaFinReporte.val() == ""){

			$("#errorfechaFinReporte").html(" ");
			$("#errorfechaFinReporte").hide();
            $("#fechaFinReporte").css("border","2px solid #34F458");
        }
        else{

			$("#errorfechaFinReporte").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la fecha</div>');
			$("#errorfechaFinReporte").show();
           	$("#fechaFinReporte").css("border","2px solid #F90A0A");
			presenciaError = true;
        }

		$("#categReporte").css("border","2px solid #34F458");
		$("#estadoEventoReporte").css("border","2px solid #34F458");

		return presenciaError;
    }

	//EVENTOS

	//VALIDAR CAMPOS CON FOCUSOUT FORMULARIO EVENTOS
	$("#funcionNombre").focusout(function(){

		var verNombre = erNombre.test(nombre.val());
		if (verNombre == true){
			
			$("#errorNom").html(" ");
			$("#errorNom").hide();
            $("#funcionNombre").css("border","2px solid #34F458");
        }
        else{
			
			$("#errorNom").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el nombre</div>');
			$("#errorNom").show();
           	$("#funcionNombre").css("border","2px solid #F90A0A");
        }
    });

	$("#funcionDirec").focusout(function(){
		
		var verDirector = erDirector.test(director.val());
		if ( verDirector == true || director.val() == ""){

			$("#errorDirec").html(" ");
			$("#errorDirec").hide();
            $("#funcionDirec").css("border","2px solid #34F458");
        }
        else{

			$("#errorDirec").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el director</div>');
			$("#errorDirec").show();
           	$("#funcionDirec").css("border","2px solid #F90A0A");
        }
    });

	$("#funcionFecha").focusout(function(){

		var hoy = Date.now()

		if (Date.parse(fecha.val()) > hoy){

			$("#errorFecha").html(" ");
			$("#errorFecha").hide();
            $("#funcionFecha").css("border","2px solid #34F458");
        }
        else{

			$("#errorFecha").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la fecha</div>');
			$("#errorFecha").show();
           	$("#funcionFecha").css("border","2px solid #F90A0A");
        }
    });
	
    $("#funcionHoraIni").focusout(function(){
		
		var horaSeg = ((horaIni.val().substring(0, 2) * 60)*60) + (horaIni.val().substring(3, 5)* 60);

		if (28800 <= horaSeg && horaSeg < 79200){
			
			$("#errorHoraIni").html(" ");
			$("#errorHoraIni").hide();
            $("#funcionHoraIni").css("border","2px solid #34F458");
        }
        else{

			$("#errorHoraIni").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la hora de inicio</div>');
			$("#errorHoraIni").show();
           	$("#funcionHoraIni").css("border","2px solid #F90A0A");
        }
    });

	$("#funcionHoraFin").focusout(function(){
		
		var horaSeg = ((horaFin.val().substring(0, 2) * 60)*60) + (horaFin.val().substring(3, 5)* 60);

		if (28800 <= horaSeg && horaSeg < 79200 && horaFin.val() >= horaIni.val()){
			
			$("#errorHoraFin").html(" ");
			$("#errorHoraFin").hide();
            $("#funcionHoraFin").css("border","2px solid #34F458");
        }
        else{

			$("#errorHoraFin").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la hora de finalización</div>');
			$("#errorHoraFin").show();
           	$("#funcionHoraFin").css("border","2px solid #F90A0A");
        }
    });

    $("#describirFuncion").focusout(function(){

 		var verDescripcion = descripciones.val();

        if (verDescripcion.length > 10 && verDescripcion.length <= 150) {

        	$("#errordescribir").html(" ");
			$("#errordescribir").hide();
            $("#describirFuncion").css("border","2px solid #34F458");
        }

        else {

        	$("#errordescribir").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la descripción</div>');
			$("#errordescribir").show();
           	$("#describirFuncion").css("border","2px solid #F90A0A");
        }

    });

	//VALIDAR CAMPOS CON CHANGE FORMULARIO DE EVENTOS
	$("#funcionCateg").change(function(){

		if (categoria.val() != 0){

			$("#errorCateg").html(" ");
			$("#errorCateg").hide();
            $("#funcionCateg").css("border","2px solid #34F458");
        }
        else{

			$("#errorCateg").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione una Categoría</div>');
			$("#errorCateg").show();
           	$("#funcionCateg").css("border","2px solid #F90A0A");
        }
    });

	$("#funcionFoto").change(function(){

		if (extPermitida1.exec(archivo.val()) || extPermitida2.exec(archivo.val())) {
		
			$("#errorFoto").html(" ");
			$("#errorFoto").hide();
			$("#funcionFoto").css("border","2px solid #34F458");
		
		}
		else {
	
			$("#errorFoto").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifique que el archivo sea .png o .jpg</div>');
			$("#errorFoto").show();
			$("#funcionFoto").css("border","2px solid #F90A0A");
			presenciaError = true;
		}
    });

	//VALIDAR CAMPOS CON CHANGE FORMULARIO DE ASIENTOS
	$("#precioPatio").change(function(){

		if (Number(precioPat.val()) > 0) {

			$("#errorPrecioPat").html(" ");
			$("#errorPrecioPat").hide();
			$("#precioPatio").css("border","2px solid #34F458");
		}
		else {

			$("#errorPrecioPat").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el precio</div>');
			$("#errorPrecioPat").show();
			$("#precioPatio").css("border","2px solid #F90A0A");
		}
	});

	$("#precioPalco").change(function() {

		if (Number(precioPal.val()) > 0) {

			$("#errorPrecioPal").html(" ");
			$("#errorPrecioPal").hide();
			$("#precioPalco").css("border","2px solid #34F458");
		}
		else {

			$("#errorPrecioPal").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el precio</div>');
			$("#errorPrecioPal").show();
			$("#precioPalco").css("border","2px solid #F90A0A");
		}
	});

	$("#precioGaleria").change(function() {

		if (Number(precioGal.val()) > 0){

			$("#errorPrecioGal").html(" ");
			$("#errorPrecioGal").hide();
			$("#errorArea").hide();
			$("#precioGaleria").css("border","2px solid #34F458");
		}
		else {

			$("#errorPrecioGal").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el precio</div>');
			$("#errorPrecioGal").show();
			$("#precioGaleria").css("border","2px solid #F90A0A");
		}
	});

	$("#tablePat").change(function(){

		$("#ErroAsientos").hide();
	})

	$("#tablePal").change(function(){

		$("#ErroAsientos").hide();
	})

	$("#tableGal").change(function(){

		$("#ErroAsientos").hide();
	})

	//VALIDAR CAMPOS CON FOCUSOUT FORMULARIO DE CATEGORIA
	$('#nombreCateg').focusout(function(){

		if (erNombreCateg.test(nombreCategoria.val()) == true) {

				$('#errorNombreCateg').html(" ");
				$('#errorNombreCateg').hide();
				$("#nombreCateg").css("border","2px solid #34F458");
			}
			else{
				$("#errorNombreCateg").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>El nombre de la categoría es invalido</div>');
				$("#errorNombreCateg").show();
				$("#nombreCateg").css("border","2px solid #F90A0A");
			}
	})

	//VALIDAR CAMPOS CON CHANGE FORMULARIO DE REPORTE
	$("#fechaIniReporte").change(function(){

		var hoy = Date.now()

		if (Date.parse(fechaIniReporte.val()) < hoy || fechaIniReporte.val() == ""){

			$("#errorFechaIniReporte").html(" ");
			$("#errorFechaIniReporte").hide();
            $("#fechaIniReporte").css("border","2px solid #34F458");
        }
        else{

			$("#errorFechaIniReporte").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la fecha</div>');
			$("#errorFechaIniReporte").show();
           	$("#fechaIniReporte").css("border","2px solid #F90A0A");
        }
    });

	$("#fechaFinReporte").change(function(){

		var hoy = Date.now()

		if ((Date.parse(fechaFinReporte.val()) <= hoy && Date.parse(fechaFinReporte.val()) > Date.parse(fechaIniReporte.val())) || fechaFinReporte.val() == ""){

			$("#errorfechaFinReporte").html(" ");
			$("#errorfechaFinReporte").hide();
            $("#fechaFinReporte").css("border","2px solid #34F458");
        }
        else{

			$("#errorfechaFinReporte").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la fecha</div>');
			$("#errorfechaFinReporte").show();
           	$("#fechaFinReporte").css("border","2px solid #F90A0A");
        }
    });

	//VALIDAR CAMPOS CON FOCUSOUT FORMULARIO DE REPORTE
	$("#categReporte").focusout(function(){

		$("#categReporte").css("border","2px solid #34F458");
    });

	$("#estadoEventoReporte").focusout(function(){

		$("#estadoEventoReporte").css("border","2px solid #34F458");
    });

	//BOTONES PARA CAMBIAR DE AREA FORMULARIO DE ASIENTOS
	$("#BtnPat").on("click", function() {

		$("#tablePat").show();
		$("#tablePal").hide();
		$("#tableGal").hide();
	});

	$("#BtnPal").on("click", function() {

		$("#tablePal").show();
		$("#tablePat").hide();
		$("#tableGal").hide();
	});

	$("#BtnGal").on("click", function() {

		$("#tableGal").show();
		$("#tablePal").hide();
		$("#tablePat").hide();
	});

	//BOTONES PARA CAMBIAR DE SECCION FORMULARIO DE ASIENTOS
	$("#irSeccionOeste").click(function(e){

		$("#irSeccionOeste").attr("disabled", true);

		$("#seccionEste").fadeOut("slow");

		setTimeout(() =>{

			$("#irSeccionOeste").attr("disabled", false);
			$("#seccionOeste").fadeIn("slow");
		}, 0);
	});

	$("#irSeccionEste").click(function(e){

		$("#irSeccionEste").attr("disabled", true);

		$("#seccionOeste").fadeOut("slow");

		setTimeout(() =>{

			$("#irSeccionEste").attr("disabled", false);
			$("#seccionEste").fadeIn("slow");
		}, 0);
	});

	$("#irGaleriaOeste").click(function(e){

		$("#irGaleriaOeste").attr("disabled", true);

		$("#galeriaEste").fadeOut("slow");

		setTimeout(() =>{

			$("#irGaleriaOeste").attr("disabled", false);
			$("#galeriaOeste").fadeIn("slow");
		}, 0);
	});

	$("#irGaleriaEste").click(function(e){

		$("#irGaleriaEste").attr("disabled", true);

		$("#galeriaOeste").fadeOut("slow");

		setTimeout(() =>{

			$("#irGaleriaEste").attr("disabled", false);
			$("#galeriaEste").fadeIn("slow");

		}, 0);
	});

	//BOTON PARA NUEVO EVENTO
	$("#btnNuevoEvento").on("click", function(){

		optEvento = "c";
		$("#modalTitleEventos").html('<i class="fa-solid fa-square-plus me-2"></i>Agregar Nuevo Evento');
		$("#funcionNombre").css("border","2px solid #ced4da");
		$("#funcionDirec").css("border","2px solid #ced4da");
		$("#funcionFecha").css("border","2px solid #ced4da");
		$("#funcionHoraIni").css("border","2px solid #ced4da");
		$("#funcionHoraFin").css("border","2px solid #ced4da");
		$("#funcionCateg option").removeAttr("selected");
		$("#funcionCateg").css("border","2px solid #ced4da");
		$("#describirFuncion").css("border","2px solid #ced4da");
		$("#funcionFoto").css("border","2px solid #ced4da");
		$(".erroresEvento").hide();
		$("#funcionForm").trigger('reset');

		$.post("",{nroEvento: true}, function(r){

			var data = JSON.parse(r)

			$("#funcionNro").val(parseInt(data["nro"])+1);
		})
	})

	//BOTON PARA NUEVA CATEGORIA
	$("#btnNuevaCategoria").on("click", function(){
		
		optCategoria = "c";
		$("#modalTitleCateg").html('<i class="fa-solid fa-plus me-2"></i>Agregar Nueva Categoría');
		$("#nombreCateg").css("border","2px solid #ced4da");
		$("#errorNombreCateg").hide();
		$("#categoriaForm").trigger('reset');

		$.post("",{nroCateg: true}, function(r){

			var data = JSON.parse(r)

			$("#nroCateg").val(parseInt(data["nro"])+1);
		})
	})

	//BOTON PARA REPORTE
	$("#btnReporte").on("click", function(){
		
		$("#fechaIniReporte").css("border","2px solid #ced4da");
		$("#fechaFinReporte").css("border","2px solid #ced4da");
		$("#categReporte").css("border","2px solid #ced4da");
		$("#estadoEventoReporte").css("border","2px solid #ced4da");
		$("#errorFechaIniReporte").hide();
		$("#errorfechaFinReporte").hide();
		$("#reporteEventos").trigger('reset');
	})

	//BOTON PARA ASIENTOS
	$("#tablePat .checkAsi").change(function(){

		if ($(this).prop('checked') == true) {

			if(asientosPat.includes(this.value) == false){

				asientosPat.push (this.value)
			}

			if(asientoRegistrados[0] == true){

				asientosActuPat =  asientosActuPat.filter((item) => item !== this.value)
			}
		}
		else{

			asientosPat =  asientosPat.filter((item) => item !== this.value)
			if(asientoRegistrados[0] == true){
				
				asientosActuPat.push(this.value)
			}
		}
	})

	$("#tablePal .checkAsi").change(function(){

		if ($(this).prop('checked') == true) {

			if(asientosPal.includes(this.value) == false){

				asientosPal.push (this.value)
			}

			if(asientoRegistrados[1] == true){

				asientosActuPal =  asientosActuPal.filter((item) => item !== this.value)
			}
		}
		else{

			asientosPal =  asientosPal.filter((item) => item !== this.value)
			if(asientoRegistrados[1] == true){
				
				asientosActuPal.push(this.value)
			}
		}
	})

	$("#tableGal .checkAsi").change(function(){

		if ($(this).prop('checked') == true) {

			if(asientosGal.includes(this.value) == false){

				asientosGal.push (this.value)
			}

			if(asientoRegistrados[2] == true){
				
				asientosActuGal =  asientosActuGal.filter((item) => item !== this.value)
			}
		}
		else{

			asientosGal =  asientosGal.filter((item) => item !== this.value)
			if(asientoRegistrados[2] == true){
				
				asientosActuGal.push(this.value)
			}
		}
	})

	//ENVIOS AJAX

	//EVENTOS
	$("#funcionForm").submit(function(e){

		e.preventDefault();

		if(optEvento === "c"){

			if (comprobacionErrores() === false) {

				if( $('#patioCheck').prop('checked')) {

					patioCheck = 1;
				}

				if($('#palcosCheck').prop('checked')) {

					palcosCheck = 1; 
				}

				if( $('#galeriaCheck').prop('checked')) {

					galeriaCheck = 1;
				}

				var nuevoEvento = {
					
					optEvento: optEvento,
					eventoNom: nombre.val(),
					eventoDirec: director.val(),
					eventoFech: fecha.val(),
					eventoHorIni: horaIni.val(),
					eventoHorFin: horaFin.val(),
					eventoCateg: categoria.val(),
					eventoDes: descripciones.val(), 
					eventoFot: archivo.val(),
					patioCheck:  patioCheck,
					palcosCheck: palcosCheck,
					galeriaCheck: galeriaCheck,
				};

				$.post("", nuevoEvento, function(r){

					var data = JSON.parse(r)

					switch(data.status){

						case 1:

							FuncionNueva("success", data.mensaje, 1);
							actualizarTblEventos();	

							break;

						case 2:

							Toast.fire({
								icon: data.tipo,
								title: data.mensaje
							})

							break;
	
						default:

							FuncionFallida("error", data.mensaje);

							break;
					}
				})	
			}
			else {

				FuncionFallida("error", "Rellene el formulario correctamente.")
			}
		}
		else{

			if (comprobacionErrores() === false) {

				if( $('#patioCheck').prop('checked')) {

					patioCheck = 1;
				}

				if($('#palcosCheck').prop('checked')) {

					palcosCheck = 1; 
				}

				if( $('#galeriaCheck').prop('checked')) {

					galeriaCheck = 1;
				}

				var actualizarEvento = {

					optEvento: optEvento,
					eventoNro: nro.val(),
					eventoNom: nombre.val(),
					eventoDirec: director.val(),
					eventoFech: fecha.val(),
					eventoHorIni: horaIni.val(),
					eventoHorFin: horaFin.val(),
					eventoCateg: categoria.val(),
					eventoDes: descripciones.val(), 
					eventoFot: archivo.val(),
					patioCheck:  patioCheck,
					palcosCheck: palcosCheck,
					galeriaCheck: galeriaCheck,
				};

				$.post(" ", actualizarEvento, function(r){

					var data = JSON.parse(r)

					switch(data.status){

						case 1:

							
							actualizarTblEventos();	
							Toast.fire({
								icon: data.tipo,
								title: data.mensaje
							})
							

							break;
						
						case 2:

							Toast.fire({
								icon: data.tipo,
								title: data.mensaje
							})

							break;

						default:

							FuncionFallida("error", data.mensaje);

							break;
					}
				})
			}
			else {

				FuncionFallida("error", "Rellene el formulario correctamente.")
			}
		}
	});

	$(document).on("click", ".b-modificar", function(){

		optEvento = "u";
		$("#modalTitleEventos").html('<i class="fa-sharp fa-solid fa-pen-to-square me-2"></i>Modificar Evento');
		$("#funcionNombre").css("border","2px solid #ced4da");
		$("#funcionDirec").css("border","2px solid #ced4da");
		$("#funcionFecha").css("border","2px solid #ced4da");
		$("#funcionHoraIni").css("border","2px solid #ced4da");
		$("#funcionHoraFin").css("border","2px solid #ced4da");
		$("#funcionCateg").css("border","2px solid #ced4da");
		$("#describirFuncion").css("border","2px solid #ced4da");
		$("#funcionFoto").css("border","2px solid #ced4da");
		$(".erroresEvento").hide();
		$("#funcionForm").trigger('reset');
		var busEventoModificar = this.value

		$.ajax({
			url: "",
			type: 'POST',
			data: {busEventoModificar},
			success: function(r) {
			
				var data = JSON.parse(r)

				$("#funcionNro").val(data[0]["nroEvento"]);
				$("#funcionNombre").val(data[0]["nombre"]);
				$("#funcionDirec").val(data[0]["director"]);
				$("#funcionFecha").val(data[0]["fechaEvento"]);
				$("#funcionHoraIni").val(data[0]["horaInicio"]);
				$("#funcionHoraFin").val(data[0]["horaFinal"]);
				$("#selecionarDefault").removeAttr("selected");
				$("#funcionCateg #categ"+data[0]["categoriaEvento"]).attr("selected", "selected"),
				$("#describirFuncion").val(data[0]["descripcion"]);

				//$("#funcionFoto").val(data[0]["imagenEvento"]);

				if(data[0]["patioStatus"] == 1){

					$("#patioCheck").prop("checked", true) 
				}else{

					$("#patioCheck").prop("checked", false) 
				}
				if(data[0]["palcoStatus"] == 1){

					$("#palcosCheck").prop("checked", true)
				}else{

					$("#palcosCheck").prop("checked", false)
				}
				if(data[0]["galeriaStatus"] == 1){

					$("#galeriaCheck").prop("checked", true)
				}else{

					$("#galeriaCheck").prop("checked", false)
				}
			}
		});
	});

	$(document).on("click", ".b-borrar", function(){
		
		var eventoNro = this.value

		Swal.fire({
			title: '¿Seguro que quieres eliminar el evento?</strong>',
			icon: 'info',
			html: "Una vez eliminado la función <strong>perdera</strong> todos los datos registrados.\n Si quiere volver a visualizarla tiene que agregarlo nuevamente.",
			showCancelButton: true,
			focusConfirm: false,
			confirmButtonText: "SI",
			confirmButtonColor: "#198754",
			cancelButtonText: "No",
			cancelButtonColor: "#dc3545",

		}).then((result) => {
			if (result.isConfirmed){

				$.ajax({
					url: "",
					method: 'POST',
					data: {optEvento: "d", eventoNro},
					success: function(r){

						var data = JSON.parse(r)

						switch(data.status){

							case 1:

								FuncionNueva("success", data.mensaje, 0);
								actualizarTblEventos()	

								Toast.fire({
									icon: data.tipo,
									title: data.mensaje
								})

								break;

							default:

								FuncionFallida("error", data.mensaje);

								break;
						}
					}
				})
			} 
		})
	});

	//ASIENTOS
	$(document).on("click", ".b-asientos", function(){
		
		var busEventoAsientos = this.value

		$("#precioPatio").css("border","2px solid #ced4da");
		$("#precioPalco").css("border","2px solid #ced4da");
		$("#precioGaleria").css("border","2px solid #ced4da");
		$("#errorPrecioPat").hide();
		$("#errorPrecioPal").hide();
		$("#errorPrecioGal").hide();
		$("#selectAsientos").trigger('reset');

		$("#tablePat").hide();
		$("#tablePal").hide();
		$("#tableGal").hide();

		asientosPat = [];
		asientosPal = [];
		asientosGal = [];

		asientosActuPat = [];
		asientosActuPal = [];
		asientosActuGal = [];

		$("#BtnPat").attr("checked", false);
		$("#BtnPal").attr("checked", false);
		$("#BtnGal").attr("checked", false);	

		$("#BtnPat").attr("disabled", false);		
		$("#BtnPal").attr("disabled", false);		
		$("#BtnGal").attr("disabled", false);

		$.ajax({
			url: "",
			type: 'POST',
			data: {busEventoAsientos},
			success: function(r) {
			
				data = JSON.parse(r)

				if(data.length == 2){
					asientoRegistrados = [false, false, false];
					$("#asientosNro").val(data[0][0]["nroEvento"]);

					if(data[0][0]["patioStatus"] == 1){

						$("#BtnPat").attr("checked", true);	
						$("#tablePat").show();
					}
					else if(data[0][0]["palcoStatus"] == 1){

						$("#BtnPal").attr("checked", true);	
						$("#tablePal").show();
					}
					else{

						$("#BtnGal").attr("checked", true);	
						$("#tableGal").show();
					}

					if(data[0][0]["patioStatus"] != 1){

						$("#BtnPat").attr("disabled", true);		
					}
					if(data[0][0]["palcoStatus"] != 1){

						$("#BtnPal").attr("disabled", true);		
					}
					if(data[0][0]["galeriaStatus"] != 1){

						$("#BtnGal").attr("disabled", true);		
					}

					data[1].forEach(data => {

						if(data["codAsiento"].slice(0,1) == "P"){

							$("#precioPatio").val(data["precioArea"])
							asientosPat.push (data["codAsiento"])
							asientoRegistrados[0] = true;
						}
						if(data["codAsiento"].slice(0,1) == "B"){

							$("#precioPalco").val(data["precioArea"])
							asientosPal.push (data["codAsiento"])
							asientoRegistrados[1] = true;
						}
						if(data["codAsiento"].slice(0,1) == "G"){

							$("#precioGaleria").val(data["precioArea"])
							asientosGal.push (data["codAsiento"])
							asientoRegistrados[2] = true;
						}

						$("#"+data["codAsiento"]).prop('checked', true)
					})
				}
				else{

					asientoRegistrados = [false, false, false];

					$("#asientosNro").val(data[0]["nroEvento"]);

					if(data[0]["patioStatus"] == 1){

						$("#BtnPat").attr("checked", true);	
						$("#tablePat").show();
					}
					else if(data[0]["palcoStatus"] == 1){

						$("#BtnPal").attr("checked", true);	
						$("#tablePal").show();
					}
					else{

						$("#BtnGal").attr("checked", true);	
						$("#tableGal").show();
					}

					if(data[0]["patioStatus"] != 1){

						$("#BtnPat").attr("disabled", true);		
					}
					if(data[0]["palcoStatus"] != 1){

						$("#BtnPal").attr("disabled", true);		
					}
					if(data[0]["galeriaStatus"] != 1){

						$("#BtnGal").attr("disabled", true);		
					}
				}
			}
		});
	});

	$("#selectAsientos").submit(function(e){

		e.preventDefault();

		if (validarAsientos() === false) {

			if($('#BtnPat').prop('disabled')== true) {

				asientosPat = [];
			}

			if($('#BtnPal').prop('disabled')== true) {

				asientosPal = [];
			}

			if($('#BtnGal').prop('disabled') == true) {

				asientosGal= [];
			}

			var asientosEvento = {

				actualizarAsientos: true, 
				asientoNro:  $("#asientosNro").val(),
				precioPat:   $("#precioPatio").val(),
				precioPal:   $("#precioPalco").val(),
				precioGal:   $("#precioGaleria").val(),
				asientosPat: asientosPat,
				asientosPal: asientosPal,
				asientosGal: asientosGal,
				asientosActuPat: asientosActuPat,
				asientosActuPal: asientosActuPal,
				asientosActuGal: asientosActuGal
			};

			$.post("", asientosEvento, function(r){

				var data = JSON.parse(r)

				switch(data.status){

					case 1:

						FuncionNueva("success", data.mensaje, 1);
						actualizarTblEventos();	

						break;

					case 2:

						Toast.fire({
							icon: data.tipo,
							title: data.mensaje
						})

						break;

					default:

						FuncionFallida("error", data.mensaje);

						break;
				}
			})	
		}
		else {

			FuncionFallida("error", "Rellene el formulario correctamente.")
		}
	});

	//CATEGORIAS
	$("#categoriaForm").submit(function(e){

		e.preventDefault();

		if(optCategoria === "c"){

			if (validarNuevaCategoria() === false) {

				var nuevaCategoria = {

					optCateg: optCategoria,
					categNom: nombreCategoria.val()
				};

				$.post(" ", nuevaCategoria, function(r){

					var data = JSON.parse(r)

					switch(data.status){

						case 1:

							FuncionNueva("success", data.mensaje, 2);
							actualizarTblCategoria()

							break;

						case 2:

							Toast.fire({
								icon: data.tipo,
								title: data.mensaje
							})

							break;

						default:

							FuncionFallida("error", data.mensaje);

							break;
					}
				})
			}
			else{

				FuncionFallida("error", "Rellene el formulario correctamente.")
			}
		}
		else{

			if (validarNuevaCategoria() === false) {

				var actualizarCateg = {

					optCateg: optCategoria,
					categNro: nroCategoria.val(),
					categNom: nombreCategoria.val()
				};

				$.post(" ", actualizarCateg, function(r){
					
					var data = JSON.parse(r)

					switch(data.status){

						case 1:

							actualizarTblCategoria();	
							Toast.fire({
								icon: data.tipo,
								title: data.mensaje
							})

							Toast.fire({
								icon: data.tipo,
								title: data.mensaje
							})

							break;
						
						case 2:

							Toast.fire({
								icon: data.tipo,
								title: data.mensaje
							})

							break;

						default:

							FuncionFallida("error", data.mensaje);

							break;
					}
				})
			}
			else {

				FuncionFallida("error", "Rellene el formulario correctamente.")
			}
		}
	});

	$(document).on("click", ".b-modificar-categ", function(){

		optCategoria = "u"
		$("#modalTitleCateg").html('<i class="fa-sharp fa-solid fa-pen-to-square me-2"></i>Modificar Categoría');
		$("#nombreCateg").css("border","2px solid #ced4da");
		$("#errorNombreCateg").hide();
		$("#categoriaForm").trigger('reset');
		var busCategModificar = this.value;

		$.ajax({
			url: "",
			type: 'POST',
			data: {busCategModificar},
			success: function(response) {

				var categBus = JSON.parse(response)

				$("#nroCateg").val(categBus[0]["idCategoria"]);
				$("#nombreCateg").val(categBus[0]["nombreCategoria"]);
			}
		});
	});

	$(document).on("click", ".b-borrar-categ", function(){

		var categNro = this.value

		Swal.fire({
			title: '¿Seguro que quieres eliminar la Categoria?</strong>',
			icon: 'info',
			html: "Una vez eliminado la función <strong>perdera</strong> todos los datos registrados.\n Si quiere volver a visualizarla tiene que agregarlo nuevamente.",
			showCancelButton: true,
			focusConfirm: false,
			confirmButtonText: "SI",
			confirmButtonColor: "#198754",
			cancelButtonText: "No",
			cancelButtonColor: "#dc3545",

		}).then((result) => {
			if (result.isConfirmed){
				
				$.ajax({
					url: "",
					method: 'POST',
					data: {optCateg: "d", categNro},
					success: function(r){

						var data = JSON.parse(r)

						switch(data.status){

							case 1:
		
								FuncionNueva("success", data.mensaje, 0);
								actualizarTblCategoria();	
		
								Toast.fire({
									icon: data.tipo,
									title: data.mensaje
								})
		
								break;

							default:
		
								FuncionFallida("error", data.mensaje);
		
								break;
						}
					}
				})
			} 
		})
	});

	//REPORTES
	/*$("#reporteEventos").submit(function(e){

		//e.preventDefault();

			if (validarReporte() === false) {


				var generarReporte = {

					reporte: 1,
					fechaIniReporte: fechaIniReporte.val(),
					fechaFinReporte: fechaFinReporte.val(),
					categoriaReporte: categoriaReporte.val(),
					estadoReporte: estadoReporte.val()
				};

				$.post(" ", generarReporte, function(r){

					var data = JSON.parse(r)
					switch(data.status){

						case 1:

						
							break;

						case 2:

							Toast.fire({
								icon: data.tipo,
								title: data.mensaje
							})

							break;

						default:

							FuncionFallida("error", data.mensaje);

							break;
					}
				})
			}
			else{

				FuncionFallida("error", "Rellene el formulario correctamente.")
			}
		
	});*/

	//LLAMADO DE FUNCIONES

	//ACTUALIZAR TABLAS
	actualizarTblEventos()
	actualizarTblCategoria()

	//OCULTAR AREAS 
	$("#tablePat").hide();
	$("#tablePal").hide();
	$("#tableGal").hide();
});
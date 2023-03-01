$(document).ready(function(){

  $(document).on('click', 'body', function(){

      if ($('body').hasClass('modal-open')) {
        $('body').css('overflow', 'hidden')
      }else{
        $('body').css('overflow', '')
      }
      
    
    
  })
  // Declaracion de variables

  //Personal
  var cedula = $("#adminCedula");
  var nombre = $("#adminNombre");
  var apellido = $("#adminApellido");
  var correo = $("#adminCorreo");
  var contraseña = $("#adminClave");
  var contraseñaR = $("#adminClaveR");
  var rol = $("#adminRol");
  var status = $("#editStatus");

  //Roles
  var nroRol = $("#nroRol");
  var nombreRol = $('#nombreRol');
  var descripcionRol = $('#descripcionRol');
  var estadoRol = $('#statusRol');

  //Reportes
  var tipoReporte = $('#opcionReporte');
  var fechasRegistro = $('#checkFechas');
  var fechaInicio = $('#fechaInicial');
  var fechaFinal = $('#fechaFinal');
  var cargoPersonal = $('#cargoPersonal');
  var estadoPersonal = $('#estadoPersonal');

  //Expresiones regulares
  var parametrosCedula = /^[0-9]{7,8}$/;
  var parametrosNombre = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]{3,20}$/;
  var parametrosCorreo = /^[a-zA-Z0-9_\.\-]+@[a-z0-9\-]+\.[a-zA-Z0-9\-]{2,4}$/;
  var parametrosContra = /^[a-zA-Z0-9_\.\-]{8}$/;
  var erRol = /^[0-9]{1,11}$/;

  var erNombreRol = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\ \-]{4,60}$/;
  var erDescripcionRol = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\ \-]{10,120}$/;

  //Variable opcion (Crear, Modificar)
  var option;

  var tblPersonal = $('#tablePersonal').DataTable();
  var tblRoles = $('#tblRoles').DataTable();

	/*Sweet alerts*/ 

  function alertaExitoso(titulo, modal){
    swal.fire({
      icon: "success",
      title: titulo,
      showConfirmButton: true,
      confirmButtonText: "Aceptar",
      confirmButtonColor: "#198754",
      allowOutsideClick: false,
      allowEscapeKey: false,
    }).then((result)=>{
      if (result.isConfirmed) {

       $(`#${modal}`).modal('hide');
        if ($('.modal-backdrop').is(':visible')) {
          $('body').removeClass('modal-open'); 
          $('.modal-backdrop').remove();
        };
          loadTblPersonal();
          loadTblRoles();
          loadSeleccionRol();
      }
    })
  }

	function alertaFallida(titulo){
		swal.fire({

			icon: "error",
			title: titulo,
			confirmButtonText: "Ok",
			confirmButtonColor: "#198754",
		})
	}

  //Declarar datatables

  function loadTblPersonal(){

    tblPersonal.destroy();

    $.ajax({
      url: "",
      method: "POST",
      data:{
        consultarPersonal: 1
      },
      success: function(response){
        var personal = JSON.parse(response);

        var table = "";

        personal.forEach(personal=>{

          if (personal.status == 1) {
            var estado = "Activo";
          }else{
            var estado = "Inactivo";
          }

          if (personal.status == 1) {
            var eliminar = `<button type="button" value="${personal.cedula}" class="btn eliminarUser btn-primary ms-2 mt-1 b-borrar"><i class="fa-solid fa-user-minus i-borrar"></i></button>`
          }else{
            var eliminar = '';
          }

          table += ` <tr>
                                <td class="tabla">V-${personal.cedula}</td>
                                <td class="tabla">${personal.nombre}</td>
                                <td class="tabla">${personal.apellido}</td>
                                <td class="tabla">${personal.nombreRol}</td>
                                <td class="tabla">${estado}</td>
                                <td class="acciones">
                                    <button type="button" value="${personal.cedula}" class="btn btn-primary ms-2 mt-1 b-modificar btnModificar" data-bs-toggle="modal" data-bs-target="#modalPersonal"><i class="fa-solid fa-user-pen i-modificar"></i></button>
                                    ${eliminar}
        
                                </td>
                              </tr>`
        });

        $('#bodyPersonal').html(table);

        tblPersonal = $('#tablePersonal').DataTable({

        ordering:  false,

        "columnDefs": [
          { orderable: false, targets: [5] }
        ],
        "language":{
          url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
        }
  
  })
      }


    })
  }

  function loadTblRoles(){

    tblRoles.destroy();

    $.ajax({
      url: "",
      method: "POST",
      data:{
        consultarRoles: 1
      },
      success: function(response){
        var roles = JSON.parse(response);
        console.log(roles)

        var tabla = "";

        roles.forEach(roles=>{

          if (roles.estado == 1) {
            var estado = "Activo";
          }else{
            var estado = "Inactivo";
          }

          if (roles.estado == 1) {
            var eliminarRol = `<button type="button" value="${roles.idRol}" class="btn btn-primary ms-2 mt-1 b-borrar eliminarRol"><i class="fa-solid fa-user-minus i-borrar"></i></button>`
          }else{
            var eliminarRol = '';
          }

          tabla += ` <tr> 
                        <td class="tabla">${roles.nombreRol}</td>
                        <td class="tabla">${roles.descripcionRol}</td>
                        <td class="tabla">${estado}</td>
                        <td class="acciones">
                           <button type="button" value="${roles.idRol}" class="btn btn-secondary btnPermisos ms-2 mt-1" data-bs-toggle="modal" data-bs-target="#modalPermisos"><i class="fa-solid fa-key i-permisos"></i></button>
                           <button type="button" value="${roles.idRol}" class="btn btn-primary ms-2 mt-1 b-modificar editRol" data-bs-toggle="modal" data-bs-target="#modalRol"><i class="fa-solid fa-user-pen i-modificar"></i></button>
                           ${eliminarRol}                 
                          
                        </td>
                    </tr>`
        });

        $('#bodyRoles').html(tabla);

        tblRoles = $('#tblRoles').DataTable({

        ordering:  false,

        "columnDefs": [
          { orderable: false, targets: [3] }
        ],
        "language":{
          url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
        }
  
  })
      }


    })
  }

  function loadSeleccionRol(){

    $.ajax({
      url: "",
      method: "POST",
      data:{
        seleccionarRol: 1
      },
      success: function(response){
        var seleccion = JSON.parse(response);

        var optionsPersonal = '<option selected value="0">Seleccionar</option>';
        var optionsReporte = '<option selected="" value="0">Todos</option>';

        seleccion.forEach(seleccion=>{

          optionsPersonal += `<option value="${seleccion.idRol}">${seleccion.nombreRol}</option>`;

          optionsReporte += `<option value="${seleccion.idRol}">${seleccion.nombreRol}</option>`;


        });

        $('#adminRol').html(optionsPersonal);
        $('#cargoPersonal').html(optionsReporte);
      }


    })
  }

  loadTblPersonal();
  loadTblRoles();
  loadSeleccionRol()

  //Eventos de los modals 

  // Obtener datos del personal y adaptar el modal para modificar

  $(document).on("click", ".btnModificar", function(){
    $('body').css('overflow', 'hidden')
    option = 2;

    var cedula = $(this).val();

    $.post('', {usuarioP: 'usuario', cedPersonal: cedula}, function(data){
      console.log(data)
      var info = JSON.parse(data);

      $("#tituloModal").html('<i class="fa-solid fa-user-pen me-2"></i>Editar Personal');

      $('input[type="text"]').val('')
      $("#adminCedula").val(info[0]["cedula"])
      $("#adminCedula").attr("disabled", true)
      $("#adminNombre").val(info[0]["nombre"])
      $("#adminApellido").val(info[0]["apellido"])
      $("#adminCorreo").val(info[0]["correo"])
      $("#adminRol").val(info[0]["rol_Id"])
      $("#selectEditStatus").show()
      $("#editStatus").val(info[0]["status"])

      $('.errors').hide();
      $('input[type="text"], select').css("border", "");


    })

  })

  // Adaptar formulario de Agregar personal

  $("#crear").click(function(){

    option = 1;

    $("#tituloModal").html('<i class="fa-solid fa-user-plus me-2"></i>Agregar Personal');

    $('input[type="text"]').val('')
    $("#adminCedula").removeAttr("disabled")
    $("#adminRol").val(0)
    $("#selectEditStatus").hide()
    $("#editStatus").val('')

    $('.errors').hide();
    $('input[type="text"], select').css("border", "")


  })

  //Obtener datos del rol y adaptar modal de editar
  $(document).on("click", ".editRol", function(){

    option = 2;

    var nroRol = $(this).val();

    $.post('', {obtenerRol: 'rol', nroRol}, function(data){

      var info = JSON.parse(data);

      $("#rolTitulo").html('<i class="fa-solid fa-user-pen me-2"></i>Editar Rol');

      $('input[type="text"]').val('')
      $("#nroRol").val(info[0]["idRol"]);
      $("#nombreRol").val(info[0]["nombreRol"]);
      $("#descripcionRol").val(info[0]["descripcionRol"]);
      $("#selectStatusRol").show();
      $("#statusRol").val(info[0]["estado"]);

      $('.errors').hide();
       $('input[type="text"], select').css("border", "")
       $("#descripcionRol").css("border", "");

    })

  })

  //Adaptar modal a crear rol

   $(document).on("click", "#crearRol", function(){

    option = 1;

    $("#rolTitulo").html('<i class="fa-solid fa-user-plus me-2"></i>Agregar Rol');

    $('input[type="text"]').val('')
    $("#nroRol").val('');
    $("#descripcionRol").val('');
    $("#selectStatusRol").hide();
    $("#statusRol").val('');

    $('.errors').hide();
     $('input[type="text"], select').css("border", "")
     $("#descripcionRol").css("border", "");

  })

  // Obtener permisos del rol seleccionado

  $(document).on("click", ".btnPermisos", function(){

    rol_id = $(this).val();

    $('#rolPermiso').attr('value', rol_id);

    $.post('', {obtenerPermisos: "permisos", rol_id}, function(data){

      var detalles = JSON.parse(data);

      console.log(detalles)

      if (Object.keys(detalles).length != 0) {

        detalles.forEach(row=>{

          if (row.estadoAcceso == 1) {

            $('input[name="permisos'+row.idModulo+'"]').prop("checked", true)
          }else{
            $('input[name="permisos'+row.idModulo+'"]').prop("checked", false)
          }
  
        });

      }else{
        $('input[type="checkbox"]').prop("checked", false)
      }

    });

  });

  // Validacion formulario generar reporte

  //Validar tipo de reporte

  $('#checkFechas').click(function(){
    if ($("#checkFechas").prop("checked")) {
      $("#fechasRegistro").show();
    }else{
      $("#fechasRegistro").hide();
    }
  });

  // Validacion formulario generar reporte evento focusout

  $('#fechaInicial').focusout(function(){
    var today = Date.now();
   	if (fechaInicio.val() == "" || Date.parse(fechaInicio.val()) > today || Date.parse(fechaInicio.val()) > Date.parse(fechaFinal.val())) {
   	  $("#errorFechaInicio").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verique la fecha de Inicio</div>');
		  $("#errorFechaInicio").show();
   	}else{
   		$("#errorFechaInicio").html('');
		  $("#errorFechaInicio").hide();
   	}
  });

  $('#fechaFinal').focusout(function(){
    var today = Date.now();
   	if (fechaFinal.val() == "" || Date.parse(fechaFinal.val()) > today || Date.parse(fechaInicio.val()) > Date.parse(fechaFinal.val())) {
   		$("#errorFechaFinal").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verique la fecha de Final</div>');
		  $("#errorFechaFinal").show();
   	}else{
   		$("#errorFechaFinal").html('');
		  $("#errorFechaFinal").hide();
   	}
  });

  $('#cargoPersonal').focusout(function(){
   	if (!erRol.test(cargoPersonal.val())) {
   		$("#errorCargo").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione un cargo de personal</div>');
		  $("#errorCargo").show();
   	}else{
   		$("#errorCargo").html('');
		  $("#errorCargo").hide();
   	}
  });

  $('#estadoPersonal').focusout(function(){
   	if (estadoPersonal.val() != 0 && estadoPersonal.val() != 1 && estadoPersonal.val() != 2) {
   		$("#errorEstadoPersonal").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione un cargo de personal</div>');
		  $("#errorEstadoPersonal").show();
   	}else{
   		$("#errorEstadoPersonal").html('');
		  $("#errorEstadoPersonal").hide();
   	}
  });

  //Funcion para validar errores en el formulario de reporte

  function validarReporte(){

   	var error = false;

    if (fechasRegistro.val() == null && cargoPersonal.val() == "" && estadoPersonal.val() == "") {
      $("#errorReporte").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione un tipo de reporte</div>');
      $("#errorReporte").show();
      error = true;
    }

   	if (fechasRegistro.prop("checked")) {
   		var today = Date.now();
	   	// Validar fecha inicio
	   	if (fechaInicio.val() == "" || Date.parse(fechaInicio.val()) > today || Date.parse(fechaInicio.val()) > Date.parse(fechaFinal.val())) {
  	   	$("#errorFechaInicio").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verique la fecha de Inicio</div>');
  			$("#errorFechaInicio").show();
		    error = true;
	   	}else{
	   		$("#errorFechaInicio").html('');
  			$("#errorFechaInicio").hide();
	   	}

	   	//Validar fecha final
	   	if (fechaFinal.val() == "" || Date.parse(fechaFinal.val()) > today || Date.parse(fechaInicio.val()) > Date.parse(fechaFinal.val())) {
	   		$("#errorFechaFinal").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verique la fecha de Final</div>');
  			$("#errorFechaFinal").show();
  			error = true;
	   	}else{
	   		$("#errorFechaFinal").html('');
  			$("#errorFechaFinal").hide();
	   	}
    }
    //Tipo de reporte 2 
		  if (!erRol.test(cargoPersonal.val())) {
	   		$("#errorCargo").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione un cargo de personal</div>');
  			$("#errorCargo").show();
  			error = true;
   		}else{
	   		$("#errorCargo").html('');
  			$("#errorCargo").hide();
   		}
    //Tipo de reporte 3
		  if (estadoPersonal.val() != 0 && estadoPersonal.val() != 1 && estadoPersonal.val() != 2) {
	   		$("#errorEstadoPersonal").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione un cargo de personal</div>');
  			$("#errorEstadoPersonal").show();
  			error = true;
   		}else{
	   		$("#errorEstadoPersonal").html('');
  			$("#errorEstadoPersonal").hide();
   		} 

    return error;	
   }
   //Fin funcion validar reporte

   $("#generarReporte").click(function(e){

   	if (validarReporte() === true) {
      e.preventDefault();
      alertaFallida("Rellene de forma correcta el formulario")
   	}

   });

  // Validacion formulario roles evento focusout

  $('#nombreRol').focusout(function(){

    if (erNombreRol.test(nombreRol.val()) == true) {
      $('#errorNombreRol').html(" ");
      $('#errorNombreRol').hide();
      $("#nombreRol").css("border","2px solid #34F458");
    }else{
      $("#errorNombreRol").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Nombre del Rol invalido</div>');
      $("#errorNombreRol").show();
      $("#nombreRol").css("border","2px solid #F90A0A");
    }

  });

  $('#descripcionRol').focusout(function(){

    if (erDescripcionRol.test(descripcionRol.val()) == true) {
      $('#errorDescRol').html(" ");
      $('#errorDescRol').hide();
      $('#descripcionRol').css("border","2px solid #34F458");
    }else{
      $("#errorDescRol").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Descripción del Rol invalido</div>');
      $("#errorDescRol").show();
      $("#descripcionRol").css("border","2px solid #F90A0A");
    }

  });

  estadoRol.focusout(function(){
    
    if (estadoRol.val() == 1 || estadoRol.val() == 0) {
      $('#errorStatusRol').html(" ");
      $('#errorStatusRol').hide();
        estadoRol.css("border","2px solid #34F458");
    }else{
      $("#errorStatusRol").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Estado de rol invalido</div>');
      $("#errorStatusRol").show();
      estadoRol.css("border","2px solid #F90A0A");
    }

  });

  // Funcion para validar errores en formulario de rol

  function validarNuevoRol(){

    var error = false;

    // Validar nombre del rol
    if (erNombreRol.test(nombreRol.val()) == true) {

    	$('#errorNombreRol').html(" ");
    	$('#errorNombreRol').hide();
    	$("#nombreRol").css("border","2px solid #34F458");
    }else{
    	$("#errorNombreRol").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Nombre del Rol invalido</div>');
			$("#errorNombreRol").show();
      $("#nombreRol").css("border","2px solid #F90A0A");
			error = true;
    }

    // Validar descripcion del rol
    if (erDescripcionRol.test(descripcionRol.val()) == true) {
    	$('#errorDescRol').html(" ");
    	$('#errorDescRol').hide();
    	$('#descripcionRol').css("border","2px solid #34F458");
    }else{
    	$("#errorDescRol").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Descripción del Rol invalido</div>');
			$("#errorDescRol").show();
      $("#nombreRol").css("border","2px solid #F90A0A");
			error = true;
    }
    	return error;
  }
  //Fin de funcion de validar rol

	/*Validacion del formulario de nuevo administrador Eventos Focusout*/ 

  $("#adminCedula").focusout(function(){

    var verCedula = parametrosCedula.test(cedula.val());

    if (verCedula == true){
      $("#errorCed").html(" ");
      $("#errorCed").hide();
      $("#adminCedula").css("border","2px solid #34F458");
    }
    else{
      $("#errorCed").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la cedula</div>');
      $("#errorCed").show();
      $("#adminCedula").css("border","2px solid #F90A0A");
    }
  });

  $("#adminNombre").focusout(function(){

    var verNombre = parametrosNombre.test(nombre.val());

    if (verNombre == true){
      $("#errorNom").html(" ");
      $("#errorNom").hide();
      $("#adminNombre").css("border","2px solid #34F458");
    }
    else{
      $("#errorNom").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el nombre</div>');
      $("#errorNom").show();
      $("#adminNombre").css("border","2px solid #F90A0A");
    }
  });

  $("#adminApellido").focusout(function(){

    var verApellido = parametrosNombre.test(apellido.val());

    if (verApellido == true){
      $("#errorApe").html(" ");
      $("#errorApe").hide();
      $("#adminApellido").css("border","2px solid #34F458");
    }
    else{
      $("#errorApe").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el apellido</div>');
      $("#errorApe").show();
      $("#adminApellido").css("border","2px solid #F90A0A");
    }
  });

  $("#adminCorreo").focusout(function(){

    var verCorreo = parametrosCorreo.test(correo.val());

    if (verCorreo == true){
      $("#errorEmail").html(" ");
      $("#errorEmail").hide();
      $("#adminCorreo").css("border","2px solid #34F458");
    }
    else{
      $("#errorEmail").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el correo</div>');
      $("#errorEmail").show();
      $("#adminCorreo").css("border","2px solid #F90A0A");
    }
  });

  $("#adminClave").focusout(function(){

    var verClave = parametrosContra.test(contraseña.val());

    if (verClave == true){
      $("#errorPass").html(" ");
      $("#errorPass").hide();
      $("#adminClave").css("border","2px solid #34F458");
    }
    else{
      $("#errorPass").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la contraseña</div>');
      $("#errorPass").show();
      $("#adminClave").css("border","2px solid #F90A0A");
    }
  });

  $("#adminClaveR").focusout(function(){

    if (contraseña.val() == contraseñaR.val() && contraseñaR.val() != ""){
      $("#errorPassR").html(" ");
      $("#errorPassR").hide();
      $("#adminClaveR").css("border","2px solid #34F458");
    }
    else{
      $("#errorPassR").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Las contraseñas no coinciden</div>');
      $("#errorPassR").show();
      $("#adminClaveR").css("border","2px solid #F90A0A");
    }
  });

  $("#adminRol").focusout(function(){

    if (rol.val() != 0){
      $("#errorRol").html(" ");
      $("#errorRol").hide();
      $("#adminRol").css("border","2px solid #34F458");
    }
    else{
      $("#errorRol").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Selecciona un rol</div>');
      $("#errorRol").show();
      $("#adminRol").css("border","2px solid #F90A0A");
    }
  });

  //Funcion para validar errores en el formulario de personal
	function comprobacionErrores(){

		var presenciaError = false;

		var verCedula = parametrosCedula.test(cedula.val());
    if (verCedula == true){
			$("#errorCed").html(" ");
			$("#errorCed").hide();
      $("#adminCedula").css("border","2px solid #34F458");
    }
    else{
			$("#errorCed").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la cedula</div>');
			$("#errorCed").show();
      $("#adminCedula").css("border","2px solid #F90A0A");
			presenciaError = true;
    }

		var verNombre = parametrosNombre.test(nombre.val());
		if (verNombre == true){
			$("#errorNom").html(" ");
			$("#errorNom").hide();
      $("#adminNombre").css("border","2px solid #34F458");
    }
    else{
			$("#errorNom").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el nombre</div>');
			$("#errorNom").show();
      $("#adminNombre").css("border","2px solid #F90A0A");
			presenciaError = true;
    }

		var verApellido = parametrosNombre.test(apellido.val());
		if (verApellido == true){
			$("#errorApe").html(" ");
			$("#errorApe").hide();
			$("#adminApellido").css("border","2px solid #34F458");
		}
		else{
			$("#errorApe").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el apellido</div>');
			$("#errorApe").show();
			$("#adminApellido").css("border","2px solid #F90A0A");
			presenciaError = true;
		}

		var verCorreo = parametrosCorreo.test(correo.val());
		if (verCorreo == true){
			$("#errorEmail").html(" ");
			$("#errorEmail").hide();
      $("#adminCorreo").css("border","2px solid #34F458");
    }
    else{
			$("#errorEmail").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el correo</div>');
			$("#errorEmail").show();
      $("#adminCorreo").css("border","2px solid #F90A0A");
      presenciaError = true;
    }

    var verClave = parametrosContra.test(contraseña.val());
		if (verClave == true){
			$("#errorPass").html(" ");
			$("#errorPass").hide();
      $("#adminClave").css("border","2px solid #34F458");
    }
    else{
			$("#errorPass").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la contraseña</div>');
			$("#errorPass").show();
      $("#adminClave").css("border","2px solid #F90A0A");
      presenciaError = true;
    }

    if (contraseña.val() == contraseñaR.val() && contraseñaR.val() != ""){
			$("#errorPassR").html(" ");
			$("#errorPassR").hide();
      $("#adminClaveR").css("border","2px solid #34F458");
    }
    else{
			$("#errorPassR").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Las contraseñas no coinciden</div>');
			$("#errorPassR").show();
      $("#adminClaveR").css("border","2px solid #F90A0A");
      presenciaError = true;
    }
	
		if (rol.val() != 0){
			$("#errorRol").html(" ");
			$("#errorRol").hide();
			$("#adminRol").css("border","2px solid #34F458");
		}
		else{
			$("#errorRol").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Selecciona un rol</div>');
			$("#errorRol").show();
			$("#adminRol").css("border","2px solid #F90A0A");
			presenciaError = true;
		}

		return presenciaError;
	}
  //Fin funcion validar personal

  //Realizar validacion al presional el boton de enviar y realizar peticion ajax
	$("#envioUser").on("click", function(){
    if (option == 2) {
      if (status.val() == 0 || status.val() == 1){
          $("#errorEditStatus").html(" ");
          $("#errorEditStatus").hide();
          status.css("border","2px solid #34F458");
          statusError = false;
      }
      else{
        $("#errorEditStatus").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Selecciona un estado valido</div>');
        $("#errorEditStatus").show();
        status.css("border","2px solid #F90A0A");
        statusError = true;
      }
    }else{
      statusError = false;
    }
      
    if (comprobacionErrores() === false && statusError === false){
        
      $.ajax({
        url: "",
        method: "POST",
        data: {
          envioPersonal: "yes",
          option,
          adminCedula: cedula.val(),
          adminNombre: nombre.val(),
          adminApellido: apellido.val(),
          adminCorreo: correo.val(),
          adminClave: contraseña.val(),
          adminRol: rol.val(),
          adminStatus: status.val()
        },
        success: function(data){

          var response = JSON.parse(data);

          if (response.status == 1) {
              alertaExitoso(response.descripcion, 'modalPersonal')
          }else{
              alertaFallida(response.descripcion)
          }

        }
      });

    } 
    else{
      alertaFallida("Rellene el formulario correctamente")
    }
	});

  // Eliminar usuario
$(document).on("click", ".eliminarUser", function(){

    var cedula = $(this).val();

    Swal.fire({
      title: '¿Seguro que quieres eliminar usuario?</strong>',
      icon: 'info',
      html: "Una vez eliminado el usuario perdera los beneficios de <strong>administrador</strong>.\n Si quiere volver a tener los beneficios tiene que agregarlo nuevamente.",
      showCancelButton: true,
      focusConfirm: false,
      confirmButtonText: "SI",
      confirmButtonColor: "#198754",
      cancelButtonText: "No",
      cancelButtonColor: "#dc3545",
    }).then((result) => {
      if (result.isConfirmed){

        fila = $(this).closest("tr");
        user_id = fila.find('td:eq(0)').text();
        var cedula = user_id.slice(2)

        $.post('', {deleteUser: "yes", id_user: cedula}, function(data){

          var response = JSON.parse(data)
          
          if (response.status == 1) {
            
            alertaExitoso(response.descripcion)
          }else{
            alertaFallida(response.descripcion)
          }       
        });
   
      } 
    });
  })

  //Realizar validacion al presionar el boton enviar y realizar peticion ajax
  $("#envioRol").on("click", function(){

    //Validar estado rol en caso de que la opcion sea 2(Editar)
    if (option === 2) {
      if (estadoRol.val() == 1 || estadoRol.val() == 0) {
        $('#errorStatusRol').html(" ");
        $('#errorStatusRol').hide();
        estadoRol.css("border","2px solid #34F458");
        errorStatus = false;
      }else{
        $("#errorStatusRol").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Estado de rol invalido</div>');
        $("#errorStatusRol").show();
        estadoRol.css("border","2px solid #F90A0A");
        errorStatus = true;
      }
    }else{
      errorStatus = false;
    }

    if (validarNuevoRol() === false &&  errorStatus === false){
        
      $.ajax({
        url: "",
        method: "POST",
        data: {
          envioRol: "yes",
          option,
          nroRol: nroRol.val(),
          nombreRol: nombreRol.val(),
          descripcionRol: descripcionRol.val(),
          estadoRol: estadoRol.val()
        },
        success: function(data){

          var response = JSON.parse(data);

          if (response.status == 1) {

            alertaExitoso(response.descripcion, 'modalRol')

          }else{
            alertaFallida(response.descripcion)
          }

        }
      });

    } 
    else{
      alertaFallida("Rellene el formulario correctamente")
    }

  });

  //Eliminar rol

  $(document).on("click", ".eliminarRol", function(){

    Swal.fire({
      title: '¿Seguro que quieres eliminar este rol?</strong>',
      icon: 'info',
      html: "Una vez eliminado este rol no podra ser asignado a ningun personal.\n <b>El personal que posea este rol perdera todos los permisos</b>.",
      showCancelButton: true,
      focusConfirm: false,
      confirmButtonText: "SI",
      confirmButtonColor: "#198754",
      cancelButtonText: "No",
      cancelButtonColor: "#dc3545",

    }).then((result) => {
        if (result.isConfirmed){

          rol_id = $(this).val();

          $.post('', {deleteRol: "yes", rol_id}, function(data){

            var response = JSON.parse(data)
            
            if (response.status == 1) {
              alertaExitoso(response.descripcion)
            }else{
              alertaFallida(response.descripcion)
            }            
          });
        } 
      });
  });

});
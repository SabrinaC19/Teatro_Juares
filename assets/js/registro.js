$(document).ready(function(){

	/*Sweet alerts*/ 

	function UsuarioRegistrado(titulo){

		swal.fire({
	      icon: "success",
	      title: titulo,
	      confirmButtonText: "Aceptar",
	      confirmButtonColor: "#198754",
	    }).then((result) => {
	      if (result.isConfirmed) {
	        location.reload();
	      }
	    })
	}
	

	function UsuarioRegistradoFallido(titulo){
		swal.fire({
			icon: "error",
			title:titulo,
			confirmButtonText: "Ok",
			confirmButtonColor: "#198754",
		})
	}
	
		/*variables*/
			var nombre = $("#nombre");
			var apellido = $("#apellido");
			var cedula = $("#cedula");
			var email = $("#email");
			var contra = $("#contra");
			var contra2 = $("#contra2");
			var exito;
		/*Expresiones regulares*/
			var erNom = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\-]{3,12}$/;
			var erAp = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\-]{4,15}$/;
			var erCi = /^[0-9\-]{6,8}$/;
			var erCorreo = /^[a-zA-Z0-9_\.\-]+@[a-z0-9\-]+\.[a-zA-Z0-9\-]{2,4}$/;
			var erPass = /^[a-zA-Z0-9_\.\-]{8}$/;

			function comprobacionErrores(){

		var presenciaError = false;

		var verNombre =erNom.test(nombre.val());
		if (verNombre == true){

			$("#errorNombre").html(" ");
			$("#errorNombre").hide();
            $("#nombre").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorNombre").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el nombre</div>');
			$("#errorNombre").show();
           	$("#nombre").css("border-bottom","2px solid #F90A0A");
			presenciaError = true;
        }

		var verApellido = erAp.test(apellido.val());
		if (verApellido == true){
			
			$("#errorApellido").html(" ");
			$("#errorApellido").hide();
			$("#apellido").css("border-bottom","2px solid #34F458");
		}
		else{

			$("#errorApellido").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el apellido</div>');
			$("#errorApellido").show();
			$("#apellido").css("border-bottom","2px solid #F90A0A");
			presenciaError = true;
		}

		var verCedula = erCi.test(cedula.val());

        if (verCedula == true){

			$("#errorCedula").html(" ");
			$("#errorCedula").hide();
            $("#cedula").css("border-bottom","2px solid #34F458");
        }
        else{

			$("#errorCedula").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la cedula</div>');
			$("#errorCedula").show();
           	$("#cedula").css("border-bottom","2px solid #F90A0A");
			presenciaError = true;
        }

		var verCorreo = erCorreo.test(email.val());
		if (verCorreo == true){

			$("#errorEmail").html(" ");
			$("#errorEmail").hide();
            $("#email").css("border-bottom","2px solid #34F458");
        }
        else{

			$("#errorEmail").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el correo</div>');
			$("#errorEmail").show();
           	$("#email").css("border-bottom","2px solid #F90A0A");
        	presenciaError = true;
        }

        var verClave = erPass.test(contra.val());
		if (verClave == true){

			$("#errorContra").html(" ");
			$("#errorContra").hide();
            $("#contra").css("border-bottom","2px solid #34F458");
        }
        else{

			$("#errorContra").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la contraseña</div>');
			$("#errorContra").show();
           	$("#contra").css("border-bottom","2px solid #F90A0A");
        	presenciaError = true;
        }

        if ( contra.val() == contra2.val() && contra2.val() != ""){

			$("#errorContra2").html(" ");
			$("#errorContra2").hide();
            $("#contra2").css("border-bottom","2px solid #34F458");
        }
        else{

			$("#errorContra2").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Las contraseñas no coinciden</div>');
			$("#errorContra2").show();
           	$("#contra2").css("border-bottom","2px solid #F90A0A");
        	presenciaError = true;
        }

		return presenciaError;
	}
	// aqui enmpiza los focus

	$("#nombre").change(function(){
		
		if (erNom.test(nombre.val())){
			
			$("#errorNombre").html(" ");
			$("#errorNombre").hide();
            $("#nombre").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorNombre").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el nombre</div>');
			$("#errorNombre").show();
           	$("#nombre").css("border-bottom","2px solid #F90A0A");
        }
    });

	$("#apellido").change(function(){
		
		if (erAp.test(apellido.val())){
			
			$("#errorApellido").html(" ");
			$("#errorApellido").hide();
            $("#apellido").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorApellido").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el apellido</div>');
			$("#errorApellido").show();
           	$("#apellido").css("border-bottom","2px solid #F90A0A");
        }
    });

	$("#cedula").change(function(){
		
		if (erCi.test(cedula.val())){
			
			$("#errorCedula").html(" ");
			$("#errorCedula").hide();
            $("#cedula").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorCedula").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la cedula</div>');
			$("#errorCedula").show();
           	$("#cedula").css("border-bottom","2px solid #F90A0A");
        }
    });

	$("#email").change(function(){
		
		if (erCorreo.test(email.val())){
			
			$("#errorEmail").html(" ");
			$("#errorEmail").hide();
            $("#email").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorEmail").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el email</div>');
			$("#errorEmail").show();
           	$("#email").css("border-bottom","2px solid #F90A0A");
        }
    });

	$("#contra").change(function(){
		
		if (erPass.test(contra.val())){
			
			$("#errorContra").html(" ");
			$("#errorContra").hide();
            $("#contra").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorContra").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Debe de contener 8 caracteres</div>');
			$("#errorContra").show();
           	$("#contra").css("border-bottom","2px solid #F90A0A");
        }
    });

	$("#contra2").change(function(){
		
		if (erPass.test(contra2.val()) && contra.val() == contra2.val()){
			
			$("#errorContra2").html(" ");
			$("#errorContra2").hide();
            $("#contra2").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorContra2").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la contraseña</div>');
			$("#errorContra2").show();
           	$("#contra2").css("border-bottom","2px solid #F90A0A");
        }
    });

	$("#envio").click(function(e){

		   if (comprobacionErrores() === false){

			$.ajax({
				url:'', 
				method: 'POST',
				data:{
					registroUsuario:1,
					cedula: $('#cedula').val(),
					nombre:$('#nombre').val(),
					apellido:$('#apellido').val(),
					correo:$('#email').val(),
					password:$('#contra').val(),
				},
				success:function(data){
					console.log(data);
					var registro = JSON.parse(data)

					if(registro.status == 1){
						UsuarioRegistrado(registro.descripcion);
					}else if(registro.status == 0){
						UsuarioRegistradoFallido(registro.descripcion);
					}else if(registro.status == 2){
						Swal.fire({
					            title: 'Su cuenta se encuentra inhabilitada</strong>',
					            icon: 'info',
					            html: registro.descripcion,
					            showCancelButton: true,
					            focusConfirm: false,
					            confirmButtonText: "SI",
					            confirmButtonColor: "#198754",
					            cancelButtonText: "No",
					            cancelButtonColor: "#dc3545",

					        }).then((result) => {
					            if (result.isConfirmed){


					                $.post('',{activarUser: "yes", cedula: $('#cedula').val() ,password:$('#contra').val()}, function(respuesta){
					                	console.log(respuesta);

					                	var activar = JSON.parse(respuesta)
					                	console.log(activar);
					                	if(activar.status == 1){
					                		swal.fire({
							                    icon: "success",
							                    title: activar.descripcion,
							                    confirmButtonColor: "#198754",

					                		}).then((result)=>{
					                			if(result.isConfirmed){
					                				location.reload();
					                			}
					                		})
					                	}else{
					                		swal.fire({
							                icon: "error",
							                title: activar.descripcion,
							                confirmButtonColor: "#198754",
							              });
					                	}
					                });
					            } 
					        });
					        
						
					}
				}
			});
        } 
        else{

			UsuarioRegistradoFallido("Rellena el formulario correctamente")
        }

	});
});

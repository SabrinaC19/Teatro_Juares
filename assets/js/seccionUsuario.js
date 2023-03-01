$(document).ready(function(){

	/*Sweet alerts*/ 

	function UsuarioModificado(){

		swal.fire({

			icon: "success",
			title: "Modificado exitosa.",
			html:'<button type="button" ><i class="fa-solid fa-check me-2"></i>Aceptar</button>',
			showConfirmButton: false,
			allowOutsideClick: false,
			allowEscapeKey: false,
		})
	};

	function UsuarioRegistradoFallido(){
		swal.fire({

			icon: "error",
			title: "Rellene el formulario correctamente.",
			confirmButtonText: "Ok",
			confirmButtonColor: "#198754",
		})
	}

	/*variables*/
			var nombre = $("#userNombre");
			var apellido = $("#userApellido");
			var cedula = $("#cedula");
			var email = $("#userCorreo");
			var telefono = $("#userTelefono");
			var contra = $("#userClave");
			var contra2 = $("#userClaveR");
			var exito;
		/*Expresiones regulares*/
			var erNom = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\-]{3,12}$/;
			var erAp = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\-]{4,15}$/;
			var erCi = /^[0-9\-]{6,8}$/;
			var erCorreo = /^[a-zA-Z0-9_\.\-]+@[a-z0-9\-]+\.[a-zA-Z0-9\-]{2,4}$/;
			var erTelf = /^[0-9\-]{11,12}$/;
			var erPass = /^[a-zA-Z0-9_\.\-]{8}$/;


		//eliminar usuario funciona bien
	$("#eliminar").click(function(e){
		 Swal.fire({
            title: '¿Seguro que quieres eliminar tu cuenta?</strong>',
            icon: 'info',
            html: "Una vez eliminada la cuenta perdera los beneficios de <strong>usuario</strong>.\n Si quiere volver a tener los beneficios tiene que registrarse nuevamente.",
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: "SI",
            confirmButtonColor: "#198754",
            cancelButtonText: "No",
            cancelButtonColor: "#dc3545",

        }).then((result) => {
            if (result.isConfirmed){

                var cedula = $(this).val();

                $.post('',{deleteUser: "yes",cedula}, function(respuesta){
                	console.log(respuesta);

                	var eliminar = JSON.parse(respuesta)
                	console.log(eliminar);
                	if(eliminar.estatus == 1){
                		swal.fire({
		                    icon: "success",
		                    title: eliminar.descripcion,
		                    confirmButtonColor: "#198754",

                		}).then((result)=>{
                			if(result.isConfirmed){
                				location.reload();
                			}
                		})
                	}else{
                		swal.fire({
		                icon: "error",
		                title: response.descripcion,
		                confirmButtonColor: "#198754",
		              });
                	}
                });
            } 
        });
        
	});

	
	//funciona bien 
	function comprobacionErrores(){

		var presenciaError = false;

		var verNombre =erNom.test(nombre.val());
		if (verNombre == true){

			$("#errorNombre").html(" ");
			$("#errorNombre").hide();
            $("#userNombre").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorNombre").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el nombre</div>');
			$("#errorNombre").show();
           	$("#userNombre").css("border-bottom","2px solid #F90A0A");
			presenciaError = true;
        }

		var verApellido = erAp.test(apellido.val());
		if (verApellido == true){
			
			$("#errorApellido").html(" ");
			$("#errorApellido").hide();
			$("#UserApellido").css("border-bottom","2px solid #34F458");
		}
		else{

			$("#errorApellido").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el apellido</div>');
			$("#errorApellido").show();
			$("#userApellido").css("border-bottom","2px solid #F90A0A");
			presenciaError = true;
		}


		var verCorreo = erCorreo.test(email.val());
		if (verCorreo == true){

			$("#errorEmail").html(" ");
			$("#errorEmail").hide();
            $("#userCorreo").css("border-bottom","2px solid #34F458");
        }
        else{

			$("#errorEmail").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el correo</div>');
			$("#errorEmail").show();
           	$("#userCorreo").css("border-bottom","2px solid #F90A0A");
        	presenciaError = true;
        }


		var verTelf = erTelf.test(telefono.val());
		if (verTelf == true){

			$("#errorTelefono").html(" ");
			$("#errorTelefono").hide();
            $("#userTelefono").css("border-bottom","2px solid #34F458");
        }
        else{

			$("#errorTelefono").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el telefono</div>');
			$("#errorTelefono").show();
           	$("#userTelefono").css("border-bottom","2px solid #F90A0A");
        	presenciaError = true;
        }

        var verClave = erPass.test(contra.val());
		if (verClave == true){

			$("#errorContra").html(" ");
			$("#errorContra").hide();
            $("#userClave").css("border-bottom","2px solid #34F458");
        }
        else{

			$("#errorContra").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la contraseña</div>');
			$("#errorContra").show();
           	$("#userClave").css("border-bottom","2px solid #F90A0A");
        	presenciaError = true;
        }

        if ( contra.val() == contra2.val() || contra.val() == " "){

			$("#errorContra2").html(" ");
			$("#errorContra2").hide();
            $("#userClaveR").css("border-bottom","2px solid #34F458");
        }
        else{

			$("#errorContra2").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Las contraseñas no coinciden</div>');
			$("#errorContra2").show();
           	$("#userClaveR").css("border-bottom","2px solid #F90A0A");
        	presenciaError = true;
        }

		return presenciaError;
	}
	// aqui enmpiza los focus

	$("#userNombre").focusout(function(){
		
		if (erNom.test(nombre.val())){
			
			$("#errorNombre").html(" ");
			$("#errorNombre").hide();
            $("#userNombre").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorNombre").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el nombre</div>');
			$("#errorNombre").show();
           	$("#userNombre").css("border-bottom","2px solid #F90A0A");
        }
    });

	$("#userApellido").focusout(function(){
		
		if (erAp.test(apellido.val())){
			
			$("#errorApellido").html(" ");
			$("#errorApellido").hide();
            $("#userApellido").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorApellido").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el apellido</div>');
			$("#errorApellido").show();
           	$("#userApellido").css("border-bottom","2px solid #F90A0A");
        }
    });

	$("#userCorreo").focusout(function(){
		
		if (erCorreo.test(email.val())){
			
			$("#errorEmail").html(" ");
			$("#errorEmail").hide();
            $("#userCorreo").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorEmail").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el email</div>');
			$("#errorEmail").show();
           	$("#userCorreo").css("border-bottom","2px solid #F90A0A");
        }
    });

    $("#userTelefono").focusout(function(){
		
		if (erTelf.test(telefono.val())){
			
			$("#errorTelefono").html(" ");
			$("#errorTelefono").hide();
            $("#userTelefono").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorTelefono").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica el telefono</div>');
			$("#errorTelefono").show();
           	$("#userTelefono").css("border-bottom","2px solid #F90A0A");
        }
    });

	$("#userClave").focusout(function(){
		
		if (erPass.test(contra.val())){
			
			$("#errorContra").html(" ");
			$("#errorContra").hide();
            $("#userClave").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorContra").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la contraseña</div>');
			$("#errorContra").show();
           	$("#userClave").css("border-bottom","2px solid #F90A0A");
        }
    });

	$("#userClaveR").focusout(function(){
		
		if (erPass.test(contra2.val())){
			
			$("#errorContra2").html(" ");
			$("#errorContra2").hide();
            $("#userClaveR").css("border-bottom","2px solid #34F458");
        }
        else{
			
			$("#errorContra2").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la contraseña</div>');
			$("#errorContra2").show();
           	$("#userClaveR").css("border-bottom","2px solid #F90A0A");
        }
    });


	$("#enviarEditar").click(function(e){
		
		var idUser = $("#editarUsuario").val()

		nombreUser = $('#userNombre').val()
		apellidoUser = $('#userApellido').val()
		correoUser = $('#userCorreo').val()
		telefonoUser  = $('#userTelefono').val()
		password = $('#userClave').val()

		if (comprobacionErrores() === false){


			var nombreUser = $('#userNombre').val()
			var apellidoUser = $('#userApellido').val()
			var correoUser = $('#userCorreo').val()
			var telefonoUser  = $('#userTelefono').val()
			var password = $('#userClave').val()


			$.ajax({
				url:"",
				method:"post",
				data:{
					modificarUsuario:"yes",
					idUser, 
					nombreUser,
					apellidoUser,
					correoUser,
					telefonoUser,
					password
				},
				success: function(data){
					var update = JSON.parse(data)
					console.log(update)

					if (update.status == 1) {
						swal.fire({
			                    icon: "success",
			                    title: update.descripcion,
			                    confirmButtonColor: "#198754",

	                		}).then((result)=>{
	                			if(result.isConfirmed){
	                				location.reload();
	                			}
	                	})
					}else{
						swal.fire({
			                    icon: "error",
			                    title: update.descripcion,
			                    confirmButtonColor: "#198754",
	                	})
					}
				}
			})
        } 
        else{

			UsuarioRegistradoFallido()
        }

	});
	//funciona esto bien
	$("#irMisDatos").click(function(e){

		$("#irMisDatos").attr("disabled", true);

		$("#misCompras").fadeOut("slow");

		setTimeout(() =>{

			$("#irMisDatos").attr("disabled", false);
			$("#misDatos").fadeIn("fast");

		}, 0)

	})

	$("#irMisCompras").click(function(e){

		$("#irMisCompras").attr("disabled", true);

		$("#misDatos").fadeOut("fast");

		setTimeout(() =>{

			$("#irMisCompras").attr("disabled", false);
			$("#misCompras").fadeIn("slow");

		}, 0)

	})


})

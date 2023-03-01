$(document).ready(function(){

	/*/ Al presionar el boton de seguir /*/

	$("#irPaso2").click(function(e){

		var correo = $("#emailRecover").val();

		var erCorreo = /^[a-zA-Z0-9_\.\-]+@[a-z0-9\-]+\.[a-zA-Z0-9\-]{2,4}$/;

		if (correo== "") { 

			e.preventDefault();
			Swal.fire({ 
				icon: 'error',
	  			title: 'Error',
	  			text: 'Antes de seguir ingrese su correo'
	  		})
		}

		else if (!erCorreo.test(correo)) {

			e.preventDefault();
			$("#error").html("Error! Correo inválido.");
		}

	})


		/*/ Al presionar el boton de enviar /*/

	$("#envioRecover").click(function(e){

		var cambioClave= $("#passRecover").val();
		var confirmarClave= $("#confirmar").val();

		var erPass = /^[a-zA-Z0-9_\.\-]{8}$/;

		if (cambioClave== "" || confirmarClave== "") {

			e.preventDefault();
			$("#error3").html("Por favor rellene todos los campos.");

		}

		else if (!erPass.test(cambioClave)) {

			e.preventDefault();
			$("#error3").html("Error! la contraseña debe contener 8 carácteres.");

		}

		else if (cambioClave!= confirmarClave) {

			e.preventDefault();
			$("#error3").html("Error! las contraseñas no coinciden");

		} 

		/*/ Si cumnple con todas las validaciones /*/

		else {

			swal.fire({

				icon: "success",
				title: "¡Cambio realizado exitosamente!",
				html:'<button type="submit" form="cambioPass" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-check me-2"></i>Aceptar</button>',
				showConfirmButton: false,
				allowOutsideClick: false,
				allowEscapeKey: false,
			})
		}
	})

})
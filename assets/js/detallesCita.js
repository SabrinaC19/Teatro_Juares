$(document).ready(function(){


	function alertDetalles(solicitud, name, valor) {

        swal.fire({

            icon: "success",
            title: "Presione Aceptar para Enviar el Correo de "+solicitud+" al Usuario",
            html:'<button type="submit" form="verificacionCita" class="btn btn-success" name="'+name+'" value="'+valor+'" data-bs-dismiss="modal"><i class="fa-solid fa-check me-2"></i>Aceptar</button>',
            showConfirmButton: false,
            allowOutsideClick: true,
            allowEscapeKey: true,
        })
    }

	$("#enviarCorreo").on("click", function(){

    alertDetalles("Aceptación", "aceptar", "2");

	})

	$("#denegarCorreo").on("click", function(){

  	alertDetalles("Rechazo", "rechazar", "0");

	})

})
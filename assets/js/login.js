$(document).ready(function(){

	$("#send").click(function(e){


		var cedulaLogin= $("#cedula").val();
		var claveLogin= $("#clave").val();

		var erCi = /^[0-9\-]{6,8}$/;
		var erPass = /^[a-zA-Z0-9_\.\-]{8}$/;

		if (cedulaLogin==""&&claveLogin=="") {

			e.preventDefault();
				e.preventDefault();
				Swal.fire({ 
				icon: 'error',
	  			title: 'Error',
	  			text: 'Necesita ingresar su cedula y contraseña para iniciar sesion'
	  		})
		}

		else if (cedulaLogin=="") {

			e.preventDefault();
			const Toast = Swal.mixin({
		            toast: true,
		            position: 'top-end',
		            showConfirmButton: false,
		            timer: 5000,
		            timerProgressBar: true,
		            didOpen: (toast) => {
		              toast.addEventListener('mouseenter', Swal.stopTimer)
		              toast.addEventListener('mouseleave', Swal.resumeTimer)
		            }
		          })

		          Toast.fire({
		              icon: 'error',
		              title: 'Por favor ingrese su cedula'
		          })
		}

		else if (!erCi.test(cedulaLogin)) {

			e.preventDefault();
			const Toast = Swal.mixin({
		            toast: true,
		            position: 'top-end',
		            showConfirmButton: false,
		            timer: 5000,
		            timerProgressBar: true,
		            didOpen: (toast) => {
		              toast.addEventListener('mouseenter', Swal.stopTimer)
		              toast.addEventListener('mouseleave', Swal.resumeTimer)
		            }
		          })

		          Toast.fire({
		              icon: 'error',
		              title: 'Usuario o contraseña Inválida'
		          })

		}

		else if (claveLogin=="") {

			e.preventDefault();
			const Toast = Swal.mixin({
		            toast: true,
		            position: 'top-end',
		            showConfirmButton: false,
		            timer: 5000,
		            timerProgressBar: true,
		            didOpen: (toast) => {
		              toast.addEventListener('mouseenter', Swal.stopTimer)
		              toast.addEventListener('mouseleave', Swal.resumeTimer)
		            }
		          })

		          Toast.fire({
		              icon: 'error',
		              title: 'Por favor ingrese su contraseña'
		          })
			
		}

		else if (!erPass.test(claveLogin)) {

			e.preventDefault();
		}

		else {

			console.log("exitoso");
		}


	});
});


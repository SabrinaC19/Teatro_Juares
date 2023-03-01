$(document).ready(function(){

	var option;

  var tblVentas = $("#tblVentas").DataTable();
  var tblBancos = $("#tblBancos").DataTable();

  function loadTblVentas(){

    tblVentas.destroy();

    $.ajax({
      url: "",
      method: "POST",
      data: {
        consultarVentas: 1
      },
      success: function(data){
        var ventas = JSON.parse(data);

        var tabla = "";
        ventas.forEach(ventas=>{

          if (ventas.status == 0) {
            var status = "Por verificar";
          }
          else if (ventas.status == 1){
            var status = "Aceptada";
          }

          var fecha = Date.parse(ventas.fechaCompra);

          var objFecha = new Date(fecha);

          var day = objFecha.getDate();

          var month = objFecha.getMonth()+1;

          var year = objFecha.getFullYear();

          day = ('0' + day).slice(-2);

          month = ('0' + month).slice(-2);

          var fechaCompra = `${day}/${month}/${year}`;

          tabla += `<tr>
                      <td class="tabla">${ventas.nombreCliente}</td>
                      <td class="tabla">${ventas.nombre}</td>
                      <td class="tabla">${fechaCompra}</td>
                      <td class="tabla">${ventas.horaCompra}</td>
                      <td class="tabla">${ventas.montoTotal}</td>
                      <td class="tabla">${status}</td>
                      <td class="acciones">
                      <a href="?url=dashboard&type=comprobante&nro=${ventas.numeroBoleto}"><button type="button" class="btn btn-primary"><i class="fa-solid fa-eye"></i></button></a>
                      </td>
                    </tr>`
        })

        $("#ventasBody").html(tabla);

        tblVentas = $('#tblVentas').DataTable({

        "columnDefs": [
          { orderable: false, targets: [6] }
        ],
        "language":{
          url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
        }
  
  })
      }
    }) 
  }

  function loadTblBancos(){

    tblBancos.destroy();

    $.ajax({
      url: "",
      method: "POST",
      data:{
        consultarBancos: 1
      },
      success: function(data){
        var bancos = JSON.parse(data);
        console.log(data)

        var table = "";
        bancos.forEach(bancos=>{

          if (bancos.status == 0) {
            var status = "Inactivo";
          }
          else{
            var status = "Activo";
          }

          table += `<tr>
                      <td class="tabla">${bancos.idBanco}</td>
                      <td class="tabla">${bancos.nombreBanco}</td>
                      <td class="tabla">${status}</td>
                      <td class="acciones">
                      <button type="button" value="${bancos.idBanco}" data-bs-toggle="modal" data-bs-target="#modalBancos" class="btn btn-primary ms-2 mt-1 b-modificar btn-modificar"><i class="fa-solid fa-pen i-modificar"></i></button>
                      <button type="button" value="${bancos.idBanco}" class="btn eliminarUser btn-primary ms-2 mt-1 b-borrar btn-eliminar"><i class="fa-solid fa-trash i-borrar"></i></button>
                      </td>
                    </tr>`
        });

        $("#bancosBody").html(table);

        tblBancos = $('#tblBancos').DataTable({

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

  loadTblVentas();
  loadTblBancos();

	$(document).on("click", ".btn-modificar", function (){
		option = 2; // Modificar

		var codBanco = $(this).val();
    console.log(codBanco)
		
		$.post('',{updateBanco:'Yes',codBanco},function(data){

		var banco = JSON.parse(data);

		$('#titulo-modal').html("Modificar Banco");
		$('#codBanco').val(banco[0]["idBanco"]);
		$('#codBanco').attr('disabled', true);
		$('#nombreBanco').val(banco[0]["nombreBanco"]);
		$('#selectEstado').show();
		$('#estadoBanco').val(banco[0]["estadoBanco"]);
		})
	})

	$(document).on("click", "#crearBanco", function (){
		option = 1; // Crear

		$('#titulo-modal').html("Agregar Nuevo Banco");
		$('input[type="text"]').val('');
		$('#codBanco').attr('disabled', false);
		$('#selectEstado').hide();
	})

	// Validacion Modal Banco

	var idBanco = $('#codBanco');
	var nombreBanco = $('#nombreBanco');
	var estadoBanco = $('#estadoBanco');

	var erIdBanco = /^[0-9]{4}$/;
	var erNombreBanco = /^[a-zA-ZÀ-ÿ\u00f1\u00d1\ \-]{3,20}$/;

	idBanco.focusout(function(){
		if (!erIdBanco.test(idBanco.val())) {
			$('#errorCodigoBanco').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Codigo invalido</div>');
   			$('#errorCodigoBanco').show();
   			idBanco.css("border","2px solid #F90A0A");
		}
		else {
   		$('#errorCodigoBanco').html('');
   		$('#errorCodigoBanco').hide();
   		idBanco.css("border","2px solid #34F458");
   }
	})

   nombreBanco.focusout(function(){
		if (!erNombreBanco.test(nombreBanco.val())) {
			$('#errorNombreBanco').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Nombre invalido</div>');
   			$('#errorNombreBanco').show();
   			nombreBanco.css("border","2px solid #F90A0A");
		}
		else {
   		$('#errorNombreBanco').html('');
   		$('#errorNombreBanco').hide();
   		nombreBanco.css("border","2px solid #34F458");
   }
   	})

      estadoBanco.focusout(function(){
		if (estadoBanco.val() != 1 && estadoBanco.val() != 0) {
			$('#errorEstadoBanco').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Estado invalido</div>');
   			$('#errorEstadoBanco').show();
   			estadoBanco.css("border","2px solid #F90A0A");
		}
		else {
   		$('#errorEstadoBanco').html('');
   		$('#errorEstadoBanco').hide();
   		estadoBanco.css("border","2px solid #34F458");
   }
   	})

   // Comprobacion de errores

   function validarBanco(){

   	var error = false;

   	if (!erIdBanco.test(idBanco.val())) {
			$('#errorCodigoBanco').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Codigo invalido</div>');
   			$('#errorCodigoBanco').show();
   			idBanco.css("border","2px solid #F90A0A");
   			error = true;
		}
		else {
   		$('#errorCodigoBanco').html('');
   		$('#errorCodigoBanco').hide();
   		idBanco.css("border","2px solid #34F458");


   }

   	if (!erNombreBanco.test(nombreBanco.val())) {
			$('#errorNombreBanco').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Nombre invalido</div>');
   			$('#errorNombreBanco').show();
   			nombreBanco.css("border","2px solid #F90A0A");
   			error = true;
		}
		else {
   		$('#errorNombreBanco').html('');
   		$('#errorNombreBanco').hide();
   		nombreBanco.css("border","2px solid #34F458");
   }

   return error;

	}

	$(document).on("click", "#enviarBanco", function (){

		errorEstadoBanco = false;

		if (option == 2) {

			if (estadoBanco.val() != 1 && estadoBanco.val() != 0) {
				$('#errorEstadoBanco').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Estado invalido</div>');
				$('#errorEstadoBanco').show();
				estadoBanco.css("border","2px solid #F90A0A");
				errorEstadoBanco = true;
			}
			else {
				$('#errorEstadoBanco').html('');
				$('#errorEstadoBanco').hide();
				estadoBanco.css("border","2px solid #34F458");
				errorEstadoBanco = false;
			}

		}

		if (!validarBanco() && !errorEstadoBanco) {

			$.ajax({
				url: "",
				method: "POST",
				data: {
					envioBanco: "yes",
					option,
					idBanco: idBanco.val(),
					nombreBanco: nombreBanco.val(),
					estadoBanco: estadoBanco.val()

				},
			success: function(data){

				var response = JSON.parse(data)

				if (response.status == 1) {
					swal.fire({

					icon: "success",
					title: response.descripcion,
					showConfirmButton: true,
          confirmButtonText: "Aceptar",
          confirmButtonColor: "#198754",
					allowOutsideClick: false,
					allowEscapeKey: false,
				}).then((result)=>{
          if (result.isConfirmed) {

            loadTblVentas();
            loadTblBancos();
          }
        })

				}else{
					swal.fire({

						icon: "error",
						title: response.descripcion,
						confirmButtonText: "Ok",
						confirmButtonColor: "#198754",
					})
				}

			} 

		})

		}
		else {
			swal.fire({

			icon: "error",
			title: "Rellene el formulario correctamente.",
			confirmButtonText: "Ok",
			confirmButtonColor: "#198754",
		})
		}
	})

	$(document).on("click", ".btn-eliminar", function (){

    var codBanco = $(this).val();

        Swal.fire({
            title: '¿Seguro que quieres eliminar este banco?</strong>',
            icon: 'info',
            html: "Una vez eliminado este banco sus datos no podran ser usados al momento de realizar una compra.",
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: "SI",
            confirmButtonColor: "#198754",
            cancelButtonText: "No",
            cancelButtonColor: "#dc3545",

        }).then((result) => {
            if (result.isConfirmed){
				

				$.post('',{deleteBanco:'Yes',codBanco},function(data){
          var response = JSON.parse(data)

					if (response.status == 1) {
						swal.fire({
              icon: "success",
              title: response.descripcion,
              confirmButtonColor: "#198754",
            }).then((result) => {
            		if (result.isConfirmed){
            		  loadTblVentas();
                  loadTblBancos();
            		}

        				})
					}
					else {
						swal.fire({
                    		icon: "error",
                    		title: response.descripcion,
                    		confirmButtonColor: "#198754",
                		})
					}
				})
                
            } 
        })
    })

    
    

})


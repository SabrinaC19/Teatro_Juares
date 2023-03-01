$(document).ready(function(){
    // Swal.fire({        
    //     icon: 'warning',
    //     title: 'Información Importante',
    //     html: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',        
    // 	confirmButtonText: 'Continuar',
    // });

    // Declarar variables
    var metodoPago;

    var transferencia = $('#transferencia');
    var pagoMovil = $('#pagoMovil');
    var puntoVenta = $('#puntoVenta');
    var efectivo = $('#efectivo');

    var banco = $('#banco');
    var ref = $('#ref');
    var monto = $('#monto');
    var numTarj = $('#numTarj');
    var fechaCompra = $('#fechaCompra');
    var horaCompra = $('#horaCompra');

    // Expresiones Regulares

    var erCI = /^[0-9]{8,9}$/;
    var erNA = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]{3,20}$/;
    var erCorreo = /^[a-zA-Z0-9_\.\-]+@[a-z0-9\-]+\.[a-zA-Z0-9\-]{2,4}$/;
    var erTlf = /^[0-9]{10,11}$/;
    var erRef = /^[0-9]{4,12}$/;
    var erMonto = /^\d{0,6}(\.\d{1})?\d{0,2}$/;
    var erTarj = /^[0-9\ ]{4,19}$/;

    // Validar fecha y hora

    var hoy = new Date();

    // Formato Fecha

    var day = hoy.getDate();

    var month = hoy.getMonth()+1;

    var year = hoy.getFullYear();

    day = ('0' + day).slice(-2);

    month = ('0' + month).slice(-2);

    var fechaActual = `${year}-${month}-${day}`;

    // Formato Hora

    var hora = hoy.getHours();

    var min = hoy.getMinutes();

    hora = ('0' + hora).slice(-2); 

    min = ('0' + min).slice(-2);

    var horaFormato = `${hora}:${min}`;

    var horaActual = ((horaFormato.substring(0,2) * 60) *60) + (horaFormato.substring(3,5) * 60);

    console.log(horaActual);

    console.log(fechaActual);

    // Checkbox



    if ($('input[type="radio"').prop('checked') == false) {
    	$('#formulario-pg').hide();
    }

    $('#labelTransfer').click(function(){
    	if ($('#transferencia').prop('checked')) {
        metodoPago = $('#transferencia').val();
    	$('#formulario-pg').show();
    		// Le damos el color
    	$('#labelTransfer').css('color', '#5CB164');
    	$('#labelPagoMovil').css('color', '#757575');
    	$('#labelPuntoVenta').css('color', '#757575');
    	$('#labelEfectivo').css('color', '#757575');
    		// Ocultamos y Mostramos
    	$('#floatingTarj').hide();
    	$('#floatingBanco').show();
    	$('#floatingRef').show();
    	}
    	else {
    		$('#labelTransfer').css('color', '#757575');
    	}
    });
   
   
   $('#labelPagoMovil').click(function(){
    	if ($('#pagoMovil').prop('checked')) {
        metodoPago = $('#pagoMovil').val();
    	$('#formulario-pg').show();
    		// Le damos el color
    	$('#labelPagoMovil').css('color', '#5CB164');
    	$('#labelTransfer').css('color', '#757575');
    	$('#labelPuntoVenta').css('color', '#757575');
    	$('#labelEfectivo').css('color', '#757575');
    		// Ocultamos y Mostramos
    	$('#floatingTarj').hide();
    	$('#floatingBanco').show();
    	$('#floatingRef').show();
    	}
    	else {
    		$('#labelPagoMovil').css('color', '#757575');
    	}
    });

   $('#labelPuntoVenta').click(function(){
    	if ($('#puntoVenta').prop('checked')) {
        metodoPago = $('#puntoVenta').val();
    	$('#formulario-pg').show();
    		// Le damos el color
    	$('#labelPuntoVenta').css('color', '#5CB164');
    	$('#labelTransfer').css('color', '#757575');
    	$('#labelPagoMovil').css('color', '#757575');
    	$('#labelEfectivo').css('color', '#757575');
    		// Ocultamos y Mostramos
    	$('#floatingTarj').show();
    	$('#floatingBanco').show();
    	$('#floatingRef').hide();
    	}
    	else {
    		$('#labelPuntoVenta').css('color', '#757575');
    	}
    });

   $('#labelEfectivo').click(function(){
    	if ($('#efectivo').prop('checked')) {
        metodoPago = $('#efectivo').val();
    	$('#formulario-pg').show();
    		// Le damos el color
    	$('#labelEfectivo').css('color', '#5CB164');
    	$('#labelTransfer').css('color', '#757575');
    	$('#labelPagoMovil').css('color', '#757575');
    	$('#labelPuntoVenta').css('color', '#757575');
    		// Ocultamos y Mostramos
    	$('#floatingTarj').hide();
    	$("#floatingBanco").hide();
    	$("#floatingRef").hide();
    	}
    	else {
    		$('#labelEfectivo').css('color', '#757575');
    	}
    });

   banco.click(function(){
   	if (banco.val() == 0) {
   		$('#errorBanco').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione un banco</div>');
   		$('#errorBanco').show();
   		banco.css("border","2px solid #F90A0A");
   	}
   	else {
   		$('#errorBanco').html('');
   		$('#errorBanco').hide();
   		banco.css("border","2px solid #34F458");
   }

	});

   ref.focusout(function(){
   	if (!erRef.test(ref.val())) {
   		$('#errorRef').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Número de referencia invalido</div>');
   		$('#errorRef').show();
   		ref.css("border","2px solid #F90A0A");
   	}
   	else {
   		$('#errorRef').html('');
   		$('#errorRef').hide();
   		ref.css("border","2px solid #34F458");
   	}

   });

    monto.focusout(function(){
   	if (!erMonto.test(monto.val()) || monto.val() == "") {
   		$('#errorMonto').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Ingrese el monto correcto</div>');
   		$('#errorMonto').show();
   		monto.css("border","2px solid #F90A0A");
   	}
   	else {
   		$('#errorMonto').html('');
   		$('#errorMonto').hide();
   		monto.css("border","2px solid #34F458");
   	}
   	
   });

    numTarj.focusout(function(){
   	if (!erTarj.test(numTarj.val())) {
   		$('#errorTarj').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Número de tarjeta invalido</div>');
   		$('#errorTarj').show();

   		numTarj.css("border","2px solid #F90A0A");
   	}
   	else {
   		$('#errorTarj').html('');
   		$('#errorTarj').hide();

   		numTarj.css("border","2px solid #34F458");
   	}
   	
   });

    fechaCompra.focusout(function(){
      if (Date.parse(fechaCompra.val()) > Date.parse(fechaActual) || fechaCompra.val() == "") {
        $('#errorFecha').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Fecha invalida</div>');
        $('#errorFecha').show();

        fechaCompra.css("border","2px solid #F90A0A");
      }
      else {
        $('#errorFecha').html('');
        $('#errorFecha').hide();

        fechaCompra.css("border","2px solid #34F458");
      }
    })

    horaCompra.focusout(function(){

      var horaRegistro = ((horaCompra.val().substring(0,2) * 60) * 60) + (horaCompra.val().substring(3,5) * 60);

      if (fechaCompra.val() == fechaActual || fechaCompra.val() == "") {
          if (horaRegistro > horaActual || horaCompra.val() == "") {
          $('#errorHora').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Hora invalida</div>');
          $('#errorHora').show();

          horaCompra.css("border","2px solid #F90A0A");
        }
        else {
          $('#errorHora').html('');
          $('#errorHora').hide();

          horaCompra.css("border","2px solid #34F458");
        }
      }else{
        if (Date.parse(fechaCompra.val()) > Date.parse(fechaActual)) {
          $('#errorHora').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Hora invalida</div>');
          $('#errorHora').show();

          horaCompra.css("border","2px solid #F90A0A");
        }else{
          $('#errorHora').html('');
          $('#errorHora').hide();

          horaCompra.css("border","2px solid #34F458");
        }
        
      }
    })

    function validarCompra(){
      var error = false;

      if (metodoPago == 1 || metodoPago == 2) {
        if (banco.val() == 0) {
          $('#errorBanco').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione un banco</div>');
          $('#errorBanco').show();
          banco.css("border","2px solid #F90A0A");
          error = true;
        }
        else {
          $('#errorBanco').html('');
          $('#errorBanco').hide();
          banco.css("border","2px solid #34F458");
       }

        if (!erRef.test(ref.val())) {
          $('#errorRef').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Número de referencia invalido</div>');
          $('#errorRef').show();
          ref.css("border","2px solid #F90A0A");
          error = true;
        }
        else {
          $('#errorRef').html('');
          $('#errorRef').hide();
          ref.css("border","2px solid #34F458");
        }
      }

      if (metodoPago == 3) {
        if (banco.val() == 0) {
          $('#errorBanco').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione un banco</div>');
          $('#errorBanco').show();
          banco.css("border","2px solid #F90A0A");
          error = true;
        }
        else {
          $('#errorBanco').html('');
          $('#errorBanco').hide();
          banco.css("border","2px solid #34F458");
       }
       
        if (!erTarj.test(numTarj.val())) {
        $('#errorTarj').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Número de tarjeta invalido</div>');
        $('#errorTarj').show();
        numTarj.css("border","2px solid #F90A0A");
        error = true;
        }
        else {
          $('#errorTarj').html('');
          $('#errorTarj').hide();

          numTarj.css("border","2px solid #34F458");
        }
      }

       

      if (!erMonto.test(monto.val()) || monto.val() == "") {
        $('#errorMonto').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Ingrese el monto correcto</div>');
        $('#errorMonto').show();
        monto.css("border","2px solid #F90A0A");
        error = true;
      }
      else {
        $('#errorMonto').html('');
        $('#errorMonto').hide();
        monto.css("border","2px solid #34F458");
      }

      if (Date.parse(fechaCompra.val()) > Date.parse(fechaActual) || fechaCompra.val() == "") {
        $('#errorFecha').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Fecha invalida</div>');
        $('#errorFecha').show();
        fechaCompra.css("border","2px solid #F90A0A");
        error = true;
      }
      else {
        $('#errorFecha').html('');
        $('#errorFecha').hide();

        fechaCompra.css("border","2px solid #34F458");
      }

      var horaRegistro = ((horaCompra.val().substring(0,2) * 60) * 60) + (horaCompra.val().substring(3,5) * 60);

      if (fechaCompra.val() == fechaActual || fechaCompra.val() == "" ) {
          if (horaRegistro > horaActual || horaCompra.val() == "") {
          $('#errorHora').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Hora invalida</div>');
          $('#errorHora').show();

          horaCompra.css("border","2px solid #F90A0A");
        }
        else {
          $('#errorHora').html('');
          $('#errorHora').hide();

          horaCompra.css("border","2px solid #34F458");
        }
      }else{
        if (Date.parse(fechaCompra.val()) > Date.parse(fechaActual) ) {
          $('#errorHora').html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Hora invalida</div>');
          $('#errorHora').show();

          horaCompra.css("border","2px solid #F90A0A");
        }else{
          $('#errorHora').html('');
          $('#errorHora').hide();

          horaCompra.css("border","2px solid #34F458");
        }
        
      }

      return error;

    }

    $("#registrarCliente").click(function(){

      var cedCliente = $("#cedulaCliente").val();
      var nombreCliente = $("#nombreCliente").val();
      var apellidoCliente = $("#apellidoCliente").val();
      var correoCliente = $("#correoCliente").val();
      var telefonoCliente = $("#telefonoCliente").val();

      $.ajax({
        url: "",
        method: "POST",
        data: {
          registrarCliente: "yes",
          cedCliente,
          nombreCliente,
          apellidoCliente,
          correoCliente,
          telefonoCliente
        },
        success: function(data){
          var response = JSON.parse(data)

          if (response.status == 1) {
            swal.fire({

              icon: "success",
              title: response.descripcion,
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#198754",
            })

            $(".cliente").attr("disabled", true);
            $("#cedulaCliente").attr("disabled", true);
            $("#registrarCliente").hide();
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

    })

    $('#buscarCliente').click(function(){

      var cedCliente = $("#cedulaCliente").val();

      $.ajax({
          url: "",
          method: "POST",
          data: {
            buscarCliente: "yes",
            cedCliente
          },
          success: function(data){
            var json = JSON.parse(data);
            console.log(json);

            if (json.status == 0) {
              $("#datosClientes").css("display", "none");
              swal.fire({

                icon: "error",
                title: json.descripcion,
                confirmButtonText: "Ok",
                confirmButtonColor: "#198754",
              })
            }
            else if(json.status == 2){
              $("#datosClientes").css("display", "flex");
              $(".cliente").val("");
              $(".cliente").attr("disabled", false);
              $("#registrarCliente").show();

            }
            else {
              $(".cliente").attr("disabled", true)
              $("#datosClientes").css("display", "flex");
              $("#nombreCliente").val(json[0]["nombreCliente"]);
              $("#apellidoCliente").val(json[0]["apellidoCliente"]);
              $("#correoCliente").val(json[0]["correo"]);
              $("#telefonoCliente").val(json[0]["nroTelefono"]);
              $("#registrarCliente").hide();
            }

          }

        })

    })

    $('#enviarCompra').click(function(){
      if (validarCompra() == false) {
        $.ajax({
          url: "",
          method: "POST",
          data: {
            registroCompra: "yes",
            metodoPago,
            fechaCompra: fechaCompra.val(),
            horaCompra: horaCompra.val(),
            monto: monto.val(),
            banco: banco.val(),
            referencia: ref.val(),
            numTarj: numTarj.val(),
            cedCliente: $("#cedulaCliente").val()
          },
          success: function(data){
            console.log(data)
            var response = JSON.parse(data)

            if (response.status == 1) {
              swal.fire({

                icon: "success",
                title: response.descripcion,
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#198754",
              }).then((result) => {
                if (result.isConfirmed) {
                  location.href = '?url=boleteria&type=finCompra';
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
          title: "Rellene el formulario correctamente",
          confirmButtonText: "Ok",
          confirmButtonColor: "#198754",
        })
      }
    })

});

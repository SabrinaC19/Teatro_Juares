$(document).ready(function(){

/* ------------------------------------Eventos Ajax---------------------------------------------*/

    var citaTabla = $("#citaTabla").DataTable();

	function cargarTablaCita(){

        citaTabla.destroy();

        $.ajax({

            url: '',
            method: 'post',
            dataType: 'Json',
            data: {

                consultarCita: 'yes'
            },
            success: function(cita){

                var tabla = "";


                cita.forEach(cita=>{

                //--------------------Parseo Fecha-------------------------
                    
                    var fecha = Date.parse(cita.fechaCita);

                    var formatFecha = new Date(fecha);

                    var dia = formatFecha.getDate()+1;
                    var mes = formatFecha.getMonth()+1;
                    var agnio = formatFecha.getFullYear();

                    dia = ('0'+ dia).slice(-2);
                    mes = ('0'+ mes).slice(-2);

                    var dateFormat = `${dia}/${mes}/${agnio}`;

                //--------------------Parseo Hora-------------------------

                    var dateTime = cita.fechaCita+" "+cita.horaCita;

                    var horaHoy = Date.parse(dateTime);

                    var formatHora = new Date(horaHoy);

                    var hora = formatHora.toLocaleTimeString("en-US", {hour:'2-digit', minute:'2-digit'});

                    console.log(hora);

                //--------------------ForEach Ajax-------------------------

                    if (cita.estadoCita == 1) {

                        var estado = "Por Aceptar";
                    }

                    else if(cita.estadoCita == 2) {

                        var estado = "Aceptada";
                    }


                    tabla += `<tr>
                                <td class="tabla">${cita.nombreEvento}</td>
                                <td class="tabla">${cita.servicio}</td>
                                <td class="tabla">${dateFormat}</td>
                                <td class="tabla">${hora}</td>
                                <td class="tabla">${estado}</td>
                                <td class="acciones d-flex"><a href="?url=cita&type=detalles&id=${cita.nroCita}">
                                    <button type="button" class="btn btn-primary ms-2 mt-1"><i class="fa-solid fa-eye"></i></button></a>
                                    <button type="button" class="btn btn-primary ms-2 mt-1 b-modificar modificarCita" value="${cita.nroCita}" data-bs-toggle="modal" data-bs-target="#modalModificar"><i class="fa-solid fa-pen-to-square i-modificar"></i></button>
                                    <button type="buttom" id="anular" name="anularCita" class="btn anularCita btn-primary ms-2 mt-1 b-borrar" value="${cita.nroCita}"><i class="fa-solid fa-trash i-borrar"></i></button></td>
                                        
                                </tr>`

                })

                $("#citaCuerpo").html(tabla);

                citaTabla = $("#citaTabla").DataTable({

                    "columnDefs": [

                        { orderable:false, targets:[5] }
                    ],
                    "language": {

                        url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                    }
                })
            }
        })
    }

    cargarTablaCita();

    $(document).on("click", ".anularCita", function(){

        
        var nroCita = $(this).val();

        Swal.fire({
            title: '¿Seguro que quieres Anular la Cita?</strong>',
            icon: 'info',
            html: "Una vez Anulada la cita el día quedará libre para que otro cliente lo ocupe.\n Los datos del Evento <strong>Estarán Ocultos</strong>.",
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: "SI",
            confirmButtonColor: "#198754",
            cancelButtonText: "No",
            cancelButtonColor: "#dc3545", 

        }).then((result) => {
            if (result.isConfirmed){

                $.ajax({

                    url: '',
                    method: 'post',
                    dataType: 'Json',
                    data: {

                        eliminarCita: 'delete',
                        nroCita
                    },
                    success: function(response){

                        
                        if (response.status == 0) {

                            Swal.fire({ 
                                icon: 'error',
                                title: response.descripcion
                            })
                        
                        }else{

                              swal.fire({
                                icon: "success",
                                title: "Cita Anulada exitosamente",
                                confirmButtonColor: "#198754",
                            }).then((result) => {
                                if (result.isConfirmed){

                                    cargarTablaCita();
                    
                                }

                            })
                        }

                    }
                })

                
            } 
        })
     })


    $(document).on("click", ".modificarCita", function(){

        $("#fechaModificar").val("");
        $("#fechaModificar").css("border","2px solid #ced4da");
        $("#errorFechaModificar").hide();

        $("#horaModificar").val("");
        $("#horaModificar").css("border","2px solid #ced4da");
        $("#errorHoraModificar").hide();

        
        var nroCita = $(this).val();

        $.ajax({

            url: '',
            method: 'post',
            dataType: 'Json',
            data: {

                obtenerCita: 'dateTime',
                nroCita
            },
            success: function(response){

                console.log(response);
                
                if (response.status == 0) {

                    $("#errorPeticion").show();
                    $("#errorPeticion").html(`<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>${response.descripcion}</div>`) 
                
                }else{

                    $("#errorPeticion").hide();
                    $("#citaNumero").val(response[0]["nroCita"]);
                    $("#fechaActual").val(response[0]["fechaCita"]);
                    $("#horaActual").val(response[0]["horaCita"]);
                }

                
            }
        })
    })

    $(".reporte").click(function(){

        console.log("hola");
        $("#fechaInicio").val("");
        $("#fechaInicio").css("border","2px solid #ced4da");
        $("#errorFechaInicio").hide();

        $("#fechaFin").val("");
        $("#fechaFin").css("border","2px solid #ced4da");
        $("#errorFechaFinal").hide();

        $("#estadoCita").val(4);
        $("#estadoCita").css("border","2px solid #ced4da");
        $("#errorEstadoCita").hide();

        $("#tipoCita").val(0);
        $("#tipoCita").css("border","2px solid #ced4da");
        $("#errorTipoCita").hide();


    })


/* ------------------------------------Alerts---------------------------------------------*/

  function alertFallido() {

    Swal.fire({ 
        icon: 'error',
        title: 'Complete todos los Campos solicitados'
    })

    }

    function alertExitoso() {

    swal.fire({

        icon: "success",
        title: "¡Su Reporte se ha Generado Correctamente!",
        html:'<button form="funcionForm" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-check me-2"></i>Aceptar</button>',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
    })

  }


  function alertCambios() {

        Swal.fire({
            title: '¿Seguro que quieres Guardar los Cambios Realizados?</strong>',
            icon: 'info',
            html: "Al aceptar los cambios realizados.\n La fecha y/o hora anteriores <strong>Se Modificarán</strong>.",
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: "SI",
            confirmButtonColor: "#198754",
            cancelButtonText: "No",
            cancelButtonColor: "#dc3545",

        }).then((result) => {
            if (result.isConfirmed){

                $.ajax({

                    url: '',
                    method: 'POST',
                    dateType: 'json',
                    data: {

                        updateCita: 'modificar',
                        nroCita: $("#citaNumero").val(),
                        fechaNueva: $("#fechaModificar").val(),
                        horaNueva: $("#horaModificar").val()
                    },

                    success: function(response){

                            error = JSON.parse(response);
                            
                            console.log(error);

                        if (error.status == 0) {

                            Swal.fire({ 
                            icon: 'error',
                            title: `${error.descripcion}`,
                            })


                        } else {

                           swal.fire({
                            icon: "success",
                            title: "Cita Modificada exitosamente",
                            showConfirmButton: true,
                            confirmButtonText: "Aceptar",
                            confirmButtonColor: "#198754",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            }).then((result)=>{

                                if (result.isConfirmed) {

                                    cargarTablaCita();
                                }
                            })
                        }
                    }

                })
            } 
        })

    }


/* ----------------------------------Validacion Modificar Cita------------------------------------*/

 var fechaModificar =  $("#fechaModificar");
 var horaModificar = $("#horaModificar");

    var hoy = new Date();
/* ------------------------------------Formato Fecha---------------------------------------------*/
    var dia = hoy.getDate();
    var mes = hoy.getMonth()+1;
    var agnio = hoy.getFullYear();

    dia = ('0'+ dia).slice(-2);
    mes = ('0'+ mes).slice(-2);

    var formatoHoy = `${agnio}-${mes}-${dia}`;

/* ------------------------------------Formato Hora---------------------------------------------*/
    var horas = hoy.getHours();
    var min = hoy.getMinutes();

    horas = ('0'+ horas).slice(-2);
    min = ('0'+ min).slice(-2);

    var formatoHora = `${horas}:${min}`;

    var horaActual = ((formatoHora.substring(0, 2) * 60)*60) + (formatoHora.substring(3, 5)* 60);

/* ------------------------------------Validaciones---------------------------------------------*/

 //Validar Fecha

 $("#fechaModificar").focusout(function(){


    if (fechaModificar.val() < formatoHoy && fechaModificar.val() != "") {

        $("#errorFechaModificar").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la fecha</div>');
        $("#errorFechaModificar").show();
        $("#fechaModificar").css("border","2px solid #F90A0A");
    
    } else {

        $("#errorFechaModificar").html(" ");
        $("#errorFechaModificar").hide();
        $("#fechaModificar").css("border","2px solid #34F458");
    }


 })

 //Validar Hora

  $("#horaModificar").focusout(function(){
    
    var horaRegistro = ((horaModificar.val().substring(0, 2) * 60)*60) + (horaModificar.val().substring(3, 5)* 60);

    if (fechaModificar.val() == formatoHoy) {

        if (horaRegistro < horaActual) {

        $("#errorHoraModificar").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la hora</div>');
        $("#errorHoraModificar").show();
        $("#horaModificar").css("border","2px solid #F90A0A");
    
        }  else {

        $("#errorHoraModificar").html(" ");
        $("#errorHoraModificar").hide();
        $("#horaModificar").css("border","2px solid #34F458");
        }
    
    }

    else if ((horaRegistro < 28800 || horaRegistro > 64800) && horaModificar.val() != "") {

        $("#errorHoraModificar").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Permitido de 8Am a 6Pm</div>');
        $("#errorHoraModificar").show();
        $("#horaModificar").css("border","2px solid #F90A0A");

    }

    else {

        $("#errorHoraModificar").html(" ");
        $("#errorHoraModificar").hide();
        $("#horaModificar").css("border","2px solid #34F458");
    }



 })

// Validar botón Enviar

  $("#modificarCita").click(function(){

    var horaRegistro = ((horaModificar.val().substring(0, 2) * 60)*60) + (horaModificar.val().substring(3, 5)* 60);

    if (fechaModificar.val() == "" && horaModificar.val() == "") {

        $("#fechaModificar").css("border","2px solid #F90A0A");
        $("#horaModificar").css("border","2px solid #F90A0A");
        alertFallido();

    }

    else if (fechaModificar.val() < formatoHoy && fechaModificar.val() != "") {

        $("#errorFechaModificar").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la fecha</div>');
        $("#errorFechaModificar").show();
        $("#fechaModificar").css("border","2px solid #F90A0A");

        alertFallido();
    }


    else if (fechaModificar.val() == formatoHoy) {

        if ((horaRegistro < horaActual)) {

        $("#errorHoraModificar").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verifica la hora</div>');
        $("#errorHoraModificar").show();
        $("#horaModificar").css("border","2px solid #F90A0A");

        alertFallido();
    
    }  else {

        alertCambios();
        
        }
    
    }

    else if ((horaRegistro < 28800 || horaRegistro > 64800) && horaModificar.val() != "") {

        $("#errorHoraModificar").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Permitido de 8Am a 6Pm</div>');
        $("#errorHoraModificar").show();
        $("#horaModificar").css("border","2px solid #F90A0A");

        alertFallido();

    }

     else {

        alertCambios();
    }

  })

/* ------------------------------------Validar Reportes---------------------------------------------*/

  var fechaInicio = $("#fechaInicio");
  var fechaFin = $("#fechaFin");
  var estadoCita = $("#estadoCita");
  var tipoCita = $("#tipoCita");
  var erNumero = /^[0-4\-]{1}$/;
  var erNumeros = /^[0-2\-]{1}$/;
  var hoy = Date.now();

 

  //Validar Fecha de Inicio

    $("#fechaInicio").focusout(function(){

        if (fechaInicio.val() == "" || Date.parse(fechaInicio.val()) > hoy || Date.parse(fechaInicio.val()) >= Date.parse(fechaFin.val())) {
       
            $("#errorFechaInicio").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verique la fecha de Inicio</div>');
            $("#errorFechaInicio").show();
            $("#fechaInicio").css("border","2px solid #F90A0A");

        } else{

            $("#errorFechaInicio").html('');
            $("#errorFechaInicio").hide();
            $("#fechaInicio").css("border","2px solid #34F458");
        }
    })  

    //Validar Fecha Final

    $("#fechaFin").focusout(function(){


        if (fechaFin.val() == "" || Date.parse(fechaInicio.val()) >= Date.parse(fechaFin.val())) {
            
            $("#errorFechaFinal").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verique la fecha de Final</div>');
            $("#errorFechaFinal").show();
            $("#fechaFin").css("border","2px solid #F90A0A");

        }else{

            $("#errorFechaFinal").html('');
            $("#errorFechaFinal").hide();
            $("#fechaFin").css("border","2px solid #34F458");
        }
    })

    //Validar Estado de Cita

    $("#estadoCita").click(function(){

        if (!erNumero.test(estadoCita.val())) {

            $("#errorEstadoCita").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione un tipo de cita</div>');
            $("#errorEstadoCita").show();
            $("#estadoCita").css("border","2px solid #F90A0A");
        
        } else {

            $("#errorEstadoCita").html('');
            $("#errorEstadoCita").hide();
            $("#estadoCita").css("border","2px solid #34F458");
        }

    })

    //Validar Tipo de Cita

    $("#tipoCita").click(function(){

        if (!erNumeros.test(tipoCita.val())) {

            $("#errorTipoCita").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione un tipo de cita</div>');
            $("#errorTipoCita").show();
            $("#tipoCita").css("border","2px solid #F90A0A");
        
        } else {

            $("#errorTipoCita").html('');
            $("#errorTipoCita").hide();
            $("#tipoCita").css("border","2px solid #34F458");
        }
    })

    //Validar botón enviar

    $("#generarReporteCita").click(function(){


        //Validar Fecha de Inicio

        if (fechaInicio.val() == "" || Date.parse(fechaInicio.val()) > hoy || Date.parse(fechaInicio.val()) >= Date.parse(fechaFin.val())) {
       
            $("#errorFechaInicio").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verique la fecha de Inicio</div>');
            $("#errorFechaInicio").show();
            $("#fechaInicio").css("border","2px solid #F90A0A");

            alertFallido();
        } 

        //Validar Fecha Final

        else if (fechaFin.val() == "" || Date.parse(fechaInicio.val()) >= Date.parse(fechaFin.val())) {
            
            $("#errorFechaFinal").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Verique la fecha de Final</div>');
            $("#errorFechaFinal").show();
            $("#fechaFin").css("border","2px solid #F90A0A");

            alertFallido();
        } 

        //Validar Estado de Cita

        else if (!erNumero.test(estadoCita.val())) {

            $("#errorEstadoCita").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione un tipo de cita</div>');
            $("#errorEstadoCita").show();
            $("#estadoCita").css("border","2px solid #F90A0A");

            alertFallido();      
        } 

        //Validar Tipo de Cita

        else if (!erNumeros.test(tipoCita.val())) {

            $("#errorTipoCita").html('<div class="alert alert-danger p-1 mt-1" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i>Seleccione un tipo de cita</div>');
            $("#errorTipoCita").show();
            $("#tipoCita").css("border","2px solid #F90A0A");

            alertFallido();
        
        } else {

            alertExitoso();
        }
    })
})
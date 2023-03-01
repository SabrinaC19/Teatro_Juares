$(document).ready(function(){

	// Aceptar o Rechazar compra

    $("#aceptarCompra").click(function(){
    	var nroBoleto = $("#aceptarCompra").val();
    	var option = 1;

    	Swal.fire({
            title: '¿Seguro que quieres aceptar esta compra?</strong>',
            icon: 'info',
            html: "Una vez aceptada la compra el cliente recibira un correo con el comprobante del boleto.",
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: "Si",
            confirmButtonColor: "#198754",
            cancelButtonText: "No",
            cancelButtonColor: "#dc3545",

        }).then((result) => {
            if (result.isConfirmed){
            
            	$.ajax({
            		url: "",
            		method: "POST",
            		dataType: "JSON",
            		data: {
            			envioCompra: "yes",
            			nroBoleto,
            			option
            		},
            		success: function(respuesta){
            			console.log(respuesta);
            			if (respuesta.status == 1) {
            				swal.fire({
            					icon: "success",
            					title: respuesta.descripcion,
            					confirmButtonColor: "#198754",
            				}).then((result) => {
            					if (result.isConfirmed){
            						location.reload();
            					}

            				})
            			}else{
            				swal.fire({
	                    		icon: "error",
	                    		title: respuesta.descripcion,
	                    		confirmButtonColor: "#198754",
	                		})
            			}
            		}
            	})
                
            } 
        })

    	
    })

    $("#rechazarCompra").click(function(){
    	var nroBoleto = $("#rechazarCompra").val();
    	var option = 2;

    	Swal.fire({
            title: '¿Seguro que quieres rechazar esta compra?</strong>',
            icon: 'info',
            html: "Una vez rechazada la compra el boleto perdera su validez y se le notificara al cliente.",
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: "Si",
            confirmButtonColor: "#198754",
            cancelButtonText: "No",
            cancelButtonColor: "#dc3545",

        }).then((result) => {
            if (result.isConfirmed){
            
            	$.ajax({
            		url: "",
            		method: "POST",
            		dataType: "JSON",
            		data: {
            			envioCompra: "yes",
            			nroBoleto,
            			option
            		},
            		success: function(respuesta){
            			console.log(respuesta);
            			if (respuesta.status == 1) {
            				swal.fire({
            					icon: "success",
            					title: respuesta.descripcion,
            					confirmButtonColor: "#198754",
            				}).then((result) => {
            					if (result.isConfirmed){
            						location.reload();
            					}

            				})
            			}else{
            				swal.fire({
	                    		icon: "error",
	                    		title: respuesta.descripcion,
	                    		confirmButtonColor: "#198754",
	                		})
            			}
            		}
            	})
                
            } 
        })

    	
    })
})
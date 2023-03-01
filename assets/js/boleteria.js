// $(document).ready(function(){
//     Swal.fire({        
//         icon: 'info',
//         title: 'Información Importante',
//         html: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',        
//     	confirmButtonText: 'Continuar',
//     });
// });

$(document).ready(function(){

	$("#irSeccionOeste").click(function(e){

		$("#irSeccionOeste").attr("disabled", true);

		$("#seccionEste").fadeOut("slow");

		setTimeout(() =>{

			$("#irSeccionOeste").attr("disabled", false);
			$("#seccionOeste").fadeIn("slow");

		}, 0)

	})

	$("#irSeccionEste").click(function(e){

		$("#irSeccionEste").attr("disabled", true);

		$("#seccionOeste").fadeOut("slow");

		setTimeout(() =>{

			$("#irSeccionEste").attr("disabled", false);
			$("#seccionEste").fadeIn("slow");

		}, 0)

	})

})


$(document).ready(function(){

	$("#irGaleriaOeste").click(function(e){

		$("#irGaleriaOeste").attr("disabled", true);

		$("#galeriaEste").fadeOut("slow");

		setTimeout(() =>{

			$("#irGaleriaOeste").attr("disabled", false);
			$("#galeriaOeste").fadeIn("slow");

		}, 0)

	})

	$("#irGaleriaEste").click(function(e){

		$("#irGaleriaEste").attr("disabled", true);

		$("#galeriaOeste").fadeOut("slow");

		setTimeout(() =>{

			$("#irGaleriaEste").attr("disabled", false);
			$("#galeriaEste").fadeIn("slow");

		}, 0)

	})

})
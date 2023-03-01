$(document).ready(function(){

	$(".botonArriba").click(function(){
		$("body, html").animate({
			scrollTop: '0px'});
	})

	$(window).scroll(function(){
		if ($(this).scrollTop() > 0) {
			$(".botonArriba").css("transform", "scale(1)");
		}else{
			$(".botonArriba").css("transform", "scale(0)");
		}
	})

})
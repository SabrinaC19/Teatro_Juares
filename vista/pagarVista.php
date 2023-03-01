<!DOCTYPE html>
<html>
<head>
	<?php $_css->heading(); ?>
	<title>Pagar Boletos</title>
	<link rel="stylesheet" type="text/css" href="assets\css\pagarBoletos.css">
	<style>
		.custom-popover {
  			--bs-popover-max-width: 200px;
  			--bs-popover-border-color: var(--bs-success);
  			--bs-popover-header-bg: var(--bs-success);
  			--bs-popover-header-color: var(--bs-white);
 			--bs-popover-body-padding-x: 1rem;
  			--bs-popover-body-padding-y: .5rem;
			}
	</style>
</head>
<body>

	<div id="contenedor_carga">
		<div id="carga"></div>
	</div>

	<?php 

		$_comp->navInicioUser();

	 ?>

	 <div class="container-fluid">
	 	<div class="container">
	 			
	 		<div class="rounded bg-light p-3 col-lg-8 col-md-10 col-sm-12 col-12 my-3 mx-auto" data-aos="fade-up">

	 			<h5 class="text-center titleCB h2 my-3">Comprar Boletos <i class="fas fa-ticket"></i></h5>

				<div class="row mb-3 text-center d-flex justify-content-center aling-items-center">
					<div class="mb-3 mx-auto col-10 col-sm-10 col-md-4 col-lg-4">
						<h6 for="" class="fw-bold mb-2">Cliente <i class="fas fa-id-card"></i></h6>
						<div class="input-group">
                    	<input type="text" class="form-control text-center" id="cedulaCliente" placeholder="C.I Cliente" name="" onkeypress="return !(event.charCode < 48 || event.charCode > 57)">
                    	<span id="buscarCliente" class="btn btn-success input-group-text d-flex justify-content-center aling-items-center"><i class="fas fa-search"></i></span>
						</div>
                	</div>

                	<div class="mb-3 mx-auto col-10 col-sm-10 col-md-4 col-lg-4">
                		<h6 for="" class="fw-bold mb-2">Teatro Juares <i class="fas fa-building-columns"></i></h6>
		              	<button type="button" class="btn btn-success"
					        data-bs-toggle="popover" data-bs-placement="bottom"
					        data-bs-custom-class="custom-popover"
					        data-bs-title="Datos de la Fundación"
					        data-bs-content="Aqui van los datos">
						  Ver datos <i class="fas fa-file-lines"></i> 
						</button>
                	</div>

                	<div class="row mx-auto" id="datosClientes">
                		<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-2 mx-auto form-floating">
                			<input type="text" name="nombreCliente" class="form-control cliente text-center" id="nombreCliente"  placeholder="">
                			<label for="floatingInput" class="">Nombre Cliente <i class="fas fa-user"></i></label>
                			<div id="errorNombreCliente"></div>
                		</div>

                		<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-2 mx-auto form-floating">
                			<input type="text" name="apellidoCliente" class="form-control cliente text-center" id="apellidoCliente"  placeholder="">
                			<label for="floatingInput" class="">Apellido Cliente <i class="fas fa-user"></i></label>
                			<div id="errorApellidoCliente"></div>
                		</div>

                		<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-2 mx-auto form-floating">
                			<input type="text" name="correoCliente" class="form-control cliente text-center" id="correoCliente"  placeholder="">
                			<label for="floatingInput" class="">Correo Cliente <i class="fas fa-envelope"></i></label>
                			<div id="errorCorreoCliente"></div>
                		</div>

                		<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-2 mx-auto form-floating">
                			<input type="text" name="telefonoCliente" class="form-control cliente text-center" id="telefonoCliente"  placeholder="">
                			<label for="floatingInput" class="">Teléfono Cliente <i class="fas fa-phone"></i></label>
                			<div id="errorTelefonoCliente"></div>
                		</div>

                		<div class="d-flex mx-auto justify-content-center aling-items-center my-3">
                			<button class="btn btn-success" id="registrarCliente">Registrar Cliente <i class="fas fa-check-circle"></i></button>
                		</div>
                		
                	</div>
				</div>

	 			<h5 class="text-center h4 my-4 text-success">Metodo de Pago</h5>

	 			<div class="row d-flex mx-auto">
	 				<div>
	 					<form method="POST" id="formCompra">
	 					<ul class="nav row d-flex text-center mx-auto">
			 				<li class="col-lg-3 col-md-3 col-sm-3 col-6">
		                			<div class="d-flex mx-auto metodo justify-content-center" id="labelTransfer">
		                				<label for="transferencia"><i class="fas fa-money-bill-transfer mx-auto h2"></i><h5>Transferencia</h5></label>
                                    <input type="radio" id="transferencia" value="1" name="metodoPago" class="d-none">
                                	</div>
			 				</li>
			 				<li class="col-lg-3 col-md-3 col-sm-3 col-6">

			 					<div class="d-flex mx-auto metodo justify-content-center" id="labelPagoMovil">
		                			<label for="pagoMovil"><i class="fas fa-magnifying-glass-dollar mx-auto h2"></i><h5>Pago Móvil</h5></label>
                                    <input type="radio" id="pagoMovil" value="2" name="metodoPago" class="d-none">
                                	</div>
			 				</li>
			 				<li class="col-lg-3 col-md-3 col-sm-3 col-6">
			 					<div class="d-flex mx-auto metodo justify-content-center" id="labelPuntoVenta">
		                			<label for="puntoVenta"><i class="fas fa-money-check-dollar mx-auto h2"></i><h5>Punto de Venta</h5></label>
                                    <input type="radio" id="puntoVenta" value="3" name="metodoPago" class="d-none">
                                	</div>
			 				</li>
			 				<li class="col-lg-3 col-md-3 col-sm-3 col-6">
			 					<div class="d-flex mx-auto metodo justify-content-center" id="labelEfectivo">
		                			<label for="efectivo"><i class="fas fa-hand-holding-dollar mx-auto h2"></i><h5>Efectivo</h5></label>
                                    <input type="radio" id="efectivo" value="4" name="metodoPago" class="d-none">
                                	</div>

			 				</li>
			 			</ul>
	 				</div>
	 			</div>
	 			
	 			<div class="tab-content mb-3 d-flex">
	 				
	 				<!-- Transferencias -->

		            	<div class="card" id="formulario-pg">
							<div class="p-3">	
								<div class="text-center d-flex my-4">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-2 mx-auto form-floating" id="floatingBanco">
											<select id="banco" name="banco" class="form-select text-center">
												<option value="0">Seleccionar banco...</option>
												<?php foreach ($bancos as $row) {
												?>
												<option value="<?php echo $row['idBanco']; ?>"><?php echo utf8_encode($row["nombreBanco"]); ?></option>
												<?php } ?>
											</select>
											<label for="floatingInput" class="text-center">Banco de origen <i class="fas fa-building-columns"></i></label>
											<p id="errorBanco"></p>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-2 mx-auto form-floating" id="floatingRef">
											<input type="text" name="ref" title="Min. 4 Max. 12 Caracteres" class="form-control" id="ref"  placeholder="" onkeypress="return !(event.charCode < 48 || event.charCode > 57)" >
											<label for="floatingInput" class="">Referencia <i class="fas fa-file-lines"></i></label>
											<p id="errorRef"></p>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-2 mx-auto form-floating">
											<input type="text" name="monto" title="Min. 4 Max. 16 Caracteres" class="form-control" id="monto"  placeholder="" onkeypress="return !(event.charCode < 46 || event.charCode > 57 || event.charCode == 47)">
											<label for="floatingInput" class="">Monto <i class="fas fa-circle-dollar-to-slot "></i></label>
											<div id="errorMonto"></div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-2 mx-auto form-floating" id="floatingTarj">
													<input type="text" name="numTarj" class="form-control" id="numTarj"  placeholder="" maxlength="19" onkeyup="Card(event, this)">
													<label for="floatingInput" class="">Número de Tarjeta <i class="fa-solid fa-credit-card"></i></label>
												<div id="errorTarj"></div>
											</div>

										<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-2 mx-auto form-floating">
											<input type="date" id="fechaCompra" name="fechaCompra" class="form-control" placeholder="">
											<label for="floatingInput" class="">Fecha <i class="fas fa-calendar"></i></label>
											<div id="errorFecha"></div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-12 col-12 my-2 mx-auto form-floating">
											<input type="time" name="horaCompra" class="form-control" id="horaCompra" placeholder="">
											<label for="floatingInput" class="">Hora <i class="fas fa-clock "></i></label>
											<div id="errorHora"></div>
										</div>
									</div>
									</div>
								</form>
							</div>
						</div>
		           	</div>
		        <div class="text-danger h4 text-center mb-3">
					<?php if (isset($respuesta)) {
						echo $respuesta;
					} ?>
				</div>	
		        <div class="text-center text-success rounded h5 p-2 my-3">
		        	Total a pagar: 100 Bs.S
		        </div>

		        <div class="d-flex justify-content-center aling-items-center my-3">
		        	<button type="button" id="enviarCompra" class="btn btn-success text-center mx-auto">Confirmar Compra <i class="fas fa-check-circle"></i></button>
		        </div>
		        
	 		</div>

	 	</div>
	</div>

	<?php $_comp->footer(); ?>

	<script>
	function Card(event, el){
    var val = el.value;
    var pos = val.slice(0, el.selectionStart).length;
  
    var out = '';
    var filtro = '1234567890';
    var v = 0;
  
    for (var i=0; i<val.length; i++){
       if (filtro.indexOf(val.charAt(i)) != -1){
       v++;
       out += val.charAt(i);       
       if((v==4) || (v==8) || (v==12))
           out+=' ';
     }
    }
 
    el.value = out;
  
   
    if(event.keyCode==8){
        el.selectionStart = pos;
        el.selectionEnd = pos;
    }
}</script>
	<script src="assets/js/pagarBoletos.js"></script>
	<script>
	 	const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
		const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
	</script>

</body>
</html>
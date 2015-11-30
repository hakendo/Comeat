$(document).ready(function () {  
	//Inicio evento agregar local

$('#btnEditarLocal').click(function(){

	
	
	
		//Verificacion de campo imagen.
	//obtenemos un array con los datos del archivo
	var file = $("#imagen")[0].files[0];
    

	//********************************************	
		//Verificacion de campos.

		var nombreLocalLargo = $('.form-control#nombreLocal').val().length;
		var direccionLocalLargo = $('.form-control#direccionLocal').val().length;
		var telefonoLocalLargo = $('.form-control#telefonoLocal').val().length;
		
		var comunaLocal = $('#comunaLocal').val();
		var latitudLocalLargo = $('.form-control#latitudLocal').val().length;
		var longitudLocalLargo = $('.form-control#longitudLocal').val().length;
		var emailLocalLargo = $('.form-control#emailLocal').val().length;
		var webLocalLargo = $('.form-control#webLocal').val().length;
		var idLocalLargo = $('.form-control#idLocal').val().length;
		var idClienteLargo = $('.form-control#idCliente').val().length;
		var descripcionLargo = $('textarea[id*=descripcion]').val().length;

		var categoria =  $("#cmbLocales").val();
		if(nombreLocalLargo <= 1){
			alert('Por favor complete el formulario nombre local.');
			$('.form-control#nombreLocal').focus();
			return false;
		}else if(nombreLocalLargo >= 30){
			alert('El campo nombre local excede el valor permitido.');
			$('.form-control#nombreLocal').focus();
		}else if(direccionLocalLargo <=1){
			alert('Por favor complete el campo direccion del local.');
			$('.form-control#direccionLocal').focus();
		}else if(direccionLocalLargo > 100){
			alert('El campo excede el valor permitido.');
			$('.form-control#direccionLocal').focus();
		}else if(telefonoLocalLargo >= 12){
			alert('El campo telefono excede el valor permitido.');
			$('.form-control#telefonoLocal').focus();
		}else if(comuna == "seleccione"){
		//COMUNA DEBERIA SER CMBBOX
		alert('Por favor seleccione una comuna');
		$('.form-control#comuna').focus();
	}else if(categoria == 0){
		alert('Por favor seleccione la categoria del local.');
		$('#cmbLocales').focus();
	}else if(descripcionLargo <= 3){
		alert('Por favor complete el campo descripcion (al menos con 4 carácteres).');
			$('.form-control#descripcion').focus();
	}else if(descripcionLargo > 150){
		alert('El campo descripción excede los límites');
			$('.form-control#descripcion').focus();
	}else{
		//Rescato todos los datos de las variables ingresadas parar procesarlas y agregar un nuevo local.

		var nombreLocal = $('.form-control#nombreLocal').val();
		var direccionLocal = $('.form-control#direccionLocal').val();
		var telefonoLocal = $('.form-control#telefonoLocal').val();
		var comuna = $('.form-control#comunaEdit').val();
		var latitudLocal = $('.form-control#latitudLocal').val();
		var longitudLocal= $('.form-control#longitudLocal').val();
		var emailLocal = $('.form-control#emailLocal').val();
		var webLocal = $('.form-control#webLocal').val();
		var idLocal = $('.form-control#idLocal').val();
		var idCliente = $('.form-control#idCliente').val();
		var categoria =  $("#cmbLocales").val();

		
		 var form = new FormData($('#formulario')[0]);
		
                             
		$.ajax({
                 url: '../php/editarLocal.php',
                 type: 'POST',
                 cache: false,
                 contentType: false,
                 processData: false,
                 data: form,                        
                 success: function(result){
                 	console.log(result);
                 	//Verificacion de imagen.
                 	if (result == 1)
                 	{
                 		window.location = '../plantillas/localEditado.html';
                 	}
                 	if(result == 2){
                 		window.location = '../plantillas/localEditado.html';
                 	}
                 	if(result == 3){
                 		window.location = '../plantillas/errorPrivilegios.htmll';
                 	}
                 	                	

                 }
	            });

	}

});


	
	//Cargar Comunas.
	$('#regionEdit').change(function(){

		var VariableID_REGION = $('#regionEdit').val();

		if(VariableID_REGION == ""){
			alert('Por favor seleccione una REGION');
		}else{

			var dataString = 'VariableID_REGION='+ VariableID_REGION;
			$.ajax({
				type:"POST",
				url: "../php/cargarCMB.php",
				data: dataString,
				cache: false,
				success: function(result){
					$("#comunaEdit").html(result);
				}
				

			});


		}
		//FIN IF
		
	});


	//Cargar Comunas on load.
	$('#regionEdit').ready(function(){

		var VariableID_REGION = $('#regionEdit').val();

		if(VariableID_REGION == ""){
			alert('Por favor seleccione una REGION');
		}else{

			var dataString = 'VariableID_REGION='+ VariableID_REGION;
			$.ajax({
				type:"POST",
				url: "../php/cargarCMBLocal.php",
				data: dataString,
				cache: false,
				success: function(result){
					$("#comunaEdit").html(result);
				}
				

			});


		}
		//FIN IF
		
	});
});
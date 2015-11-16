$(document).ready(function () {  
	//Inicio evento agregar local

	$('#btnAgregar').click(function() {

		window.location = '../admin/agregarLocal.php';
	});	

	$('#btnEditar').click(function() {

			// Así accedemos al Valor de la opción seleccionada
		    var valor = $("#cmbLocales").val();
		    if (valor == 0){

		    alert('Por favor seleccione un local');
		    // Si seleccionamos la opción "Texto 1"
		    // nos mostrará por pantalla "1"
		    }else{
		    	//Ejecucion AJAX.
		    	var dataString = 'idLocal='+ valor;
		    	$.ajax({
				type:"POST",
				url: "../php/seleccionarLocal.php",
				data: dataString,
				cache: false,
				success: function(result){
					
						window.location = 'editarLocal.php';
				}
			});
		    }
	});
	/*$('#btnEditar').click(function() {

		window.location = '../admin/editarLocal.php';
	});	*/

	 function validarCampos(){
	
	//Verificacion de campo imagen.
	//obtenemos un array con los datos del archivo
		var file = $("#imagen")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo


	//********************************************	



	//Verificacion de campos.

	var nombreLocalLargo = $('.form-control#nombreLocal').val().length;
	var direccionLocalLargo = $('.form-control#direccionLocal').val().length;
	var telefonoLocalLargo = $('.form-control#telefonoLocal').val().length;
	var razonLocalLargo = $('.form-control#razonLocal').val().length;
	var comunaLocalLargo = $('.form-control#comunaLocal').val().length;
	var latitudLocalLargo = $('.form-control#latitudLocal').val().length;
	var longitudLocalLargo = $('.form-control#longitudLocal').val().length;
	var emailLocalLargo = $('.form-control#emailLocal').val().length;
	var webLocalLargo = $('.form-control#webLocal').val().length;
	var idLocalLargo = $('.form-control#idLocal').val().length;
	var idClienteLargo = $('.form-control#idCliente').val().length;
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
	}else if(direccionLocalLargo >=30){
		alert('El campo excede el valor permitido.');
		$('.form-control#direccionLocal').focus();
	}else if(telefonoLocalLargo >= 12){
		alert('El campo telefono excede el valor permitido.');
		$('.form-control#telefonoLocal').focus();
	}else if(razonLocal >=30){
		alert('El campo razon social excede el valor permitido.');
		$('.form-control#razonLocal').focus();
	}else if(comunaLocalLargo >=30){
		//COMUNA DEBERIA SER CMBBOX
		alert('El campo comuna excede el valor permitido.');
		$('.form-control#comunaLocal').focus();
	}else if(categoria == 0){
		alert('Por favor seleccione la categoria del local.');
		$('#cmbLocales').focus();
	}else{

		//Rescato todos los datos de las variables ingresadas parar procesarlas y agregar un nuevo local.

		var nombreLocal = $('.form-control#nombreLocal').val();
		var direccionLocal = $('.form-control#direccionLocal').val();
		var telefonoLocal = $('.form-control#telefonoLocal').val();
		var razonLocal = $('.form-control#razonLocal').val();
		var comunaLocal = $('.form-control#comunaLocal').val();
		var latitudLocal = $('.form-control#latitudLocal').val();
		var longitudLocal= $('.form-control#longitudLocal').val();
		var emailLocal = $('.form-control#emailLocal').val();
		var webLocal = $('.form-control#webLocal').val();
		var idLocal = $('.form-control#idLocal').val();
		var idCliente = $('.form-control#idCliente').val();
		var categoria =  $("#cmbLocales").val();



//****************
		//obtenemos un array con los datos del archivo
       /* var file = $("#imagen")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        
        */
        alert('enviado');
       // $('#formulario').submit();
		/*

		//Ejecucion AJAX.
		var dataString = 'nombreLocal='+ nombreLocal + '&direccionLocal='+ direccionLocal + '&telefonoLocal='+ telefonoLocal + '&razonLocal='+ razonLocal + '&comunaLocal='+ comunaLocal + '&latitudLocal='+ latitudLocal + '&longitudLocal='+ longitudLocal +'&emailLocal='+ emailLocal + '&webLocal='+ webLocal + '&idLocal='+ idLocal + '&idCliente='+ idCliente + '&categoria=' + categoria + '&esComeat=' + 0 + '&imagen=' + file;
		*/
		/*$.ajax({
			type:"POST",
			url: "../php/registrarLocal.php",
			enctype: "multipart/form-data",
			data: dataString,
			cache: false,
			success: function(result){
		
				console.log(result);
				if (result == 1){
					window.location = '../plantillas/yaExisteLocal.html';
				}else if(result == 2){
					window.location = '../plantillas/registroLocalCompleto.html';
				}else if(result == 3){
					window.location = '../plantillas/errorRegistro2.html';
				}
				
			}
		}); */

	}	
	}





	//Cargar Comunas.
	$('#region').change(function(){

		var VariableID_REGION = $('#region').val();

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
                         $("#comuna").html(result);
                       }
				
			
		});


		}
		//FIN IF
		
	});
});
$(document).ready(function (){

	$('#btnSeleccionar').click(function(){

		//envío los datos a un php para así editar los variables de session.
		var valor = $("#cmbLocales").val();
		var texto = $("#cmbLocales option:selected").html()
		if (valor == 0){

			alert('Por favor seleccione un local');
		    // Si seleccionamos la opción "Texto 1"
		    // nos mostrará por pantalla "1"
		}else{
		    	//Ejecucion AJAX.
		    	var dataString = 'idLocal='+ valor + '&nombreLocal='+ texto ;
		    	$.ajax({
		    		type:"POST",
		    		url: "../php/seleccionarLocal.php",
		    		data: dataString,
		    		cache: false,
		    		success: function(result){

		    			window.location = 'menuGarzon.php';
		    		}
		    	});
		    }

		});

	$('#btnAgregarGarzon').click(function(event) {
		window.location.href = '../admin/agregarGarzon.php';
	});

	$('#btnAgregarGarzonEjecucion').click(function(event) {
		//Se reinician los errores.
		$('#errorNombre1').addClass('hidden');
		$('#errorNombre2').addClass('hidden');
		$('#errorApellido1').addClass('hidden');
		$('#errorApellido2').addClass('hidden');
		$('#errorEmail').addClass('hidden');
		$('#errorPassword').addClass('hidden');
		$('#errorRut').addClass('hidden');
		//Se rescata el largo de todas las variables ´para ser validadas:
		var esChef = $('#esChef:checked').val();
		if(esChef == 1)
		{
			esChef=1;
		}else{
			esChef=0;
		}
		

		var nombre1Largo = $('#nombreGarzon1').val().length;
		var nombre2Largo = $('#nombreGarzon2').val().length;
		var rutLargo = $('#rutGarzon').val().length;
		var apellido1Largo = $('#apellidoGarzon1').val().length;
		var apellido2Largo = $('#apellidoGarzon2').val().length;
		var emailLargo = $('#emailGarzon').val().length;
		var passLargo = $('#passwordGarzon').val().length;

		if(nombre1Largo == 0 || nombre1Largo > 50 || nombre1Largo < 2){
			$('#errorNombre1').removeClass('hidden');
			$('#nombreGarzon1').focus();
		}else 
		if(nombre2Largo > 50){
			$('#errorNombre2').removeClass('hidden');
			$('#nombreGarzon2').focus();
		}else
		if(rutLargo == 0){
			$('#errorRut').removeClass('hidden');
			$('#rutGarzon').focus();
		}else 
		if(apellido1Largo == 0 || apellido1Largo > 50 || apellido1Largo < 2){
			$('#errorApellido1').removeClass('hidden');
			$('#apellidoGarzon1').focus()
		}else 
		if(apellido2Largo > 50){
			$('#errorApellido2').removeClass('hidden');
			$('#apellidoGarzon2').focus()
		}else
		if($("#emailGarzon").val().indexOf('@', 0) == -1 || $("#emailGarzon").val().indexOf('.', 0) == -1) {
            $('#errorEmail').removeClass('hidden');
            $('#emailGarzon').focus();
        }else
        if(passLargo == 0 || passLargo > 15 || passLargo < 4){
        	$('#errorPassword').removeClass('hidden');
        	$('#errorPassword').focus();
        }else{
        	//En caso de estar todas las variables correctas, se ejecuta el ajax.
        	var nombre1 = $('#nombreGarzon1').val();
			var nombre2 = $('#nombreGarzon2').val();
			var rut = $('#rutGarzon').val();
			var apellido1 = $('#apellidoGarzon1').val();
			var apellido2 = $('#apellidoGarzon2').val();
			var email = $('#emailGarzon').val();
			var pass = $('#passwordGarzon').val();
        	//Ejecucion AJAX.
			var dataString = 'nombre1='+ nombre1 + '&nombre2='+ nombre2 +'&apellido1='+ apellido1 + '&apellido2='+ apellido2 + '&email='+ email + '&password='+ pass + '&rut=' + rut + '&esChef=' + esChef;

			$.ajax({
				type:"POST",
				url: "../php/registrarGarzon.php",
				data: dataString,
				cache: false,
				success: function(result){
					console.log(result);
					if (result == 1){
						window.location = '../plantillas/errorRegistro2.html';
					}else 
					if(result == 2){
						window.location = '../plantillas/registroGarzon.html';
					}else 
					if(result == 3){
						
						window.location = '../plantillas/errorRegistro.html';
					}
				}
			});
        }




		//

	});

		//Seleccionar garzón a editar:
	$('#btnModificarGarzon').click(function(event) {
		$('#errorSelect').addClass('hidden');
		var valor = $('#cmbLocales').val();
		
		if(valor == 0)
		{
			$('#errorSelect').removeClass('hidden');
		}else{
			//Ejecucion AJAX.
		    	var dataString = 'idGarzon='+ valor ;
		    	$.ajax({
		    		type:"POST",
		    		url: "../php/seleccionarGarzon.php",
		    		data: dataString,
		    		cache: false,
		    		success: function(result){

		    			window.location = 'editarGarzon.php';
		    		}
		    	});
		    }
		
	});

		//Editar al garzon
	$('#btnModificarGarzonEjecucion').click(function(event) {
		//Se reinician los errores.
		$('#errorNombre1').addClass('hidden');
		$('#errorNombre2').addClass('hidden');
		$('#errorApellido1').addClass('hidden');
		$('#errorApellido2').addClass('hidden');
		$('#errorEmail').addClass('hidden');
		$('#errorPassword').addClass('hidden');
		$('#errorRut').addClass('hidden');
		//Se rescata el largo de todas las variables ´para ser validadas:
		var esChef = $('#esChef:checked').val();
		if(esChef == 1)
		{
			esChef=1;
		}else{
			esChef=0;
		}
		

		var nombre1Largo = $('#nombreGarzon1').val().length;
		var nombre2Largo = $('#nombreGarzon2').val().length;
		var rutLargo = $('#rutGarzon').val().length;
		var apellido1Largo = $('#apellidoGarzon1').val().length;
		var apellido2Largo = $('#apellidoGarzon2').val().length;
		var emailLargo = $('#emailGarzon').val().length;
		var passLargo = $('#passwordGarzon').val().length;

		if(nombre1Largo == 0 || nombre1Largo > 50 || nombre1Largo < 2){
			$('#errorNombre1').removeClass('hidden');
			$('#nombreGarzon1').focus();
		}else 
		if(nombre2Largo > 50){
			$('#errorNombre2').removeClass('hidden');
			$('#nombreGarzon2').focus();
		}else
		if(rutLargo == 0){
			$('#errorRut').removeClass('hidden');
			$('#rutGarzon').focus();
		}else 
		if(apellido1Largo == 0 || apellido1Largo > 50 || apellido1Largo < 2){
			$('#errorApellido1').removeClass('hidden');
			$('#apellidoGarzon1').focus()
		}else 
		if(apellido2Largo > 50){
			$('#errorApellido2').removeClass('hidden');
			$('#apellidoGarzon2').focus()
		}else
		if($("#emailGarzon").val().indexOf('@', 0) == -1 || $("#emailGarzon").val().indexOf('.', 0) == -1) {
            $('#errorEmail').removeClass('hidden');
            $('#emailGarzon').focus();
        }else
        if(passLargo == 0 || passLargo > 15 || passLargo < 4){
        	$('#errorPassword').removeClass('hidden');
        	$('#errorPassword').focus();
        }else{
        	//En caso de estar todas las variables correctas, se ejecuta el ajax.
        	var nombre1 = $('#nombreGarzon1').val();
			var nombre2 = $('#nombreGarzon2').val();
			var rut = $('#rutGarzon').val();
			var apellido1 = $('#apellidoGarzon1').val();
			var apellido2 = $('#apellidoGarzon2').val();
			var email = $('#emailGarzon').val();
			var pass = $('#passwordGarzon').val();
        	//Ejecucion AJAX.
			var dataString = 'nombre1='+ nombre1 + '&nombre2='+ nombre2 +'&apellido1='+ apellido1 + '&apellido2='+ apellido2 + '&email='+ email + '&password='+ pass + '&rut=' + rut + '&esChef=' + esChef;

			$.ajax({
				type:"POST",
				url: "../php/editarGarzon.php",
				data: dataString,
				cache: false,
				success: function(result){
					console.log(result);
					
					if (result == 1){
						window.location = '../plantillas/errorRegistro2.html';
					}else 
					if(result == 2){
						window.location = '../plantillas/edicionGarzon.html';
					}else 
					if(result == 3){
						
						window.location = '../plantillas/errorRegistro.html';
					}
				}
			});
        }
	});

//Fin funcion ready
});
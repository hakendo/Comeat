$(document).ready(function () {  

	$('#btnRegistro').click(function() {

	var nombre1RegistroLargo = $('.form-control#nombre1Registro').val().length;
	var nombre2RegistroLargo = $('.form-control#nombre2Registro').val().length;
	var primerApellidoRegistroLargo = $('.form-control#primerApellidoRegistro').val().length;
	var segundoApellidoRegistroLargo = $('.form-control#segundoApellidoRegistro').val().length;
	var emailRegistroLargo = $('.form-control#emailRegistro').val().length;
	var passRegistroUnoLargo = $('.form-control#passRegistroUno').val().length;
	var passRegistroDosLargo = $('.form-control#passRegistroDos').val().length;

	if( nombre1RegistroLargo <= 2 ){
	alert('Por favor complete el formulario primer nombre.');
	$('.form-control#nombre1Registro').focus();
		return false;
	}else if( nombre1RegistroLargo >= 30 ){
	alert('El campo primer nombre excede el valor permitido.');
	$('.form-control#nombre1Registro').focus();
		return false;
	}else if( nombre2RegistroLargo >= 30 ){
	alert('El campo segundo nombre excede el valor permitido.');
	$('.form-control#nombre2Registro').focus();
		return false;
	}else if( primerApellidoRegistroLargo <= 2 ){
	alert('Por favor complete el formulario primer apellido');
	$('.form-control#primerApellidoRegistro').focus();
		return false;
	}else if( primerApellidoRegistroLargo >= 30 ){
	alert('El campo primer apellido excede el valor permitido.');
	$('.form-control#primerApellidoRegistro').focus();
		return false;
	}else if( segundoApellidoRegistroLargo >= 30 ){
	alert('El campo segundo apellido excede el valor permitido.');
	$('.form-control#segundoApellidoRegistro').focus();
		return false;
	}else if( emailRegistroLargo <= 6 ){
	alert('Por favor complete el formulario Email correctamente');
	$('.form-control#emailRegistro').focus();
		return false;
	}else if( emailRegistroLargo >= 50 ){
	alert('El campo correo electrónico excede el valor permitido.');
	$('.form-control#emailRegistro').focus();
		return false;
	}else if( passRegistroUnoLargo <= 3 ){
	alert('La contraseña debe tener al menos 4 caracteres.');
	$('.form-control#passRegistroUno').focus();
		return false;
	}else if( passRegistroUnoLargo > 10){
	alert('La contraseña no debe exceder los 10 caracteres.');
	$('.form-control#passRegistroUno').focus();
		return false;
	}else if( passRegistroDosLargo <= 3 ){
	alert('La contraseña debe tener al menos 4 caracteres.');
	$('.form-control#passRegistroDos').focus();
		return false;
	}else if( passRegistroDosLargo > 10){
	alert('La contraseña no debe exceder los 10 caracteres.');
	$('.form-control#passRegistroDos').focus();
		return false;
	}else if($('.form-control#passRegistroDos').val() != $('.form-control#passRegistroUno').val()){
	alert('Las contraseñas deben coincidir.');
	$('.form-control#passRegistroUno').focus();
		return false;
	}else{
		//Obtencion de datos del formulario:
		var nombre1 = $('.form-control#nombre1Registro').val();
		var nombre2 = $('.form-control#nombre2Registro').val();
		var primerApellido = $('.form-control#primerApellidoRegistro').val();
		var segundoApellido = $('.form-control#segundoApellidoRegistro').val();
		var email = $('.form-control#emailRegistro').val();
		var password = $('.form-control#passRegistroUno').val();
		

		//Ejecucion AJAX.
		var dataString = 'nombre1='+ nombre1 + '&nombre2='+ nombre2 + '&primerApellido='+ primerApellido + '&segundoApellido='+ segundoApellido + '&email='+ email + '&password='+ password ;

		$.ajax({
			type:"POST",
			url: "php/registrar.php",
			data: dataString,
			cache: false,
			success: function(result){
				
				if (result == 1){
					window.location = 'plantillas/errorRegistro.html';
				}else if(result == 2){
					window.location = 'plantillas/registroCompleto.html';
				}else if(result == 3){
					window.location = 'plantillas/errorRegistro2.html';
				}
				
			}
		});
	}

	return false;

	});

});
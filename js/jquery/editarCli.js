$(document).ready(function () {  
	//Inicio Evento llenado Combo Box
	$('#btnEditarCliente').click(function() {

			// Así accedemos al Valor de la opción seleccionada
		    var valor = $("#cmbClientes").val();
		    if (valor == 0){

		    alert('Por favor seleccione a un cliente');
		    // Si seleccionamos la opción "Texto 1"
		    // nos mostrará por pantalla "1"
		    }else{
		    	//Ejecucion AJAX.
		    	var dataString = 'idcliente='+ valor;
		    	$.ajax({
				type:"POST",
				url: "../php/seleccionarClienteEdit.php",
				data: dataString,
				cache: false,
				success: function(result){
					
						window.location = 'editarClienteSelected.php';
				}
			});
		    }
	});	
	//Fin llenado Combo box

	//Rescatar datos para editar al cliente seleccionado.
	$('#btnModificar').click(function(event) {
		
		var nombre1RegistroLargo = $('.form-control#nombre1Registro').val().length;
		var nombre2RegistroLargo = $('.form-control#nombre2Registro').val().length;
		var primerApellidoRegistroLargo = $('.form-control#primerApellidoRegistro').val().length;
		var segundoApellidoRegistroLargo = $('.form-control#segundoApellidoRegistro').val().length;
		var emailRegistroLargo = $('.form-control#emailRegistro').val().length;
		var passRegistroUnoLargo = $(':password').val().length;
		var rutRegistroLargo = $('.form-control#rutRegistro').val().length;
		var telefonoRegistroLargo = $('.form-control#telefonoRegistro').val().length;

		

		//Verificacion de campos
		if( nombre1RegistroLargo <= 1 )
		{
		alert('Por favor complete el formulario primer nombre.');
		$('.form-control#nombre1Registro').focus();
			return false;
		}else 
		if( nombre1RegistroLargo >= 30 )
		{
		alert('El campo primer nombre excede el valor permitido.');
		$('.form-control#nombre1Registro').focus();
			return false;
		}else if( nombre2RegistroLargo >= 30 )
		{
		alert('El campo segundo nombre excede el valor permitido.');
		$('.form-control#nombre2Registro').focus();
			return false;
		}else 
		if( primerApellidoRegistroLargo <= 1 )
		{
		alert('Por favor complete el formulario primer apellido');
		$('.form-control#primerApellidoRegistro').focus();
			return false;
		}else 
		if( primerApellidoRegistroLargo >= 30 )
		{
		alert('El campo primer apellido excede el valor permitido.');
		$('.form-control#primerApellidoRegistro').focus();
			return false;
		}else 
		if( segundoApellidoRegistroLargo >= 30 )
		{
		alert('El campo segundo apellido excede el valor permitido.');
		$('.form-control#segundoApellidoRegistro').focus();
			return false;
		}else 
		if( emailRegistroLargo <= 5 )
		{
		alert('Por favor complete el formulario Email correctamente');
		$('.form-control#emailRegistro').focus();
			return false;
		}else 
		if( emailRegistroLargo >= 50 )
		{
		alert('El campo correo electrónico excede el valor permitido.');
		$('.form-control#emailRegistro').focus();
			return false;
		}else 
		if( passRegistroUnoLargo <= 3 )
		{
		alert('La contraseña debe tener al menos 4 caracteres.');
		$('.form-control#passRegistroUno').focus();
			return false;
		}else 
		if( passRegistroUnoLargo > 10)
		{
		alert('La contraseña no debe exceder los 10 caracteres.');
		$('.form-control#passRegistroUno').focus();
			return false;
		}else 
		if(telefonoRegistro > 12 )
		{
		alert('Por favor el telefono.');
		$('.form-control#telefonoRegistro').focus();
			return false;
		}
		else{
			//Obtencion de datos del formulario:
			var nombre1 = $('.form-control#nombre1Registro').val();
			var nombre2 = $('.form-control#nombre2Registro').val();
			var primerApellido = $('.form-control#primerApellidoRegistro').val();
			var segundoApellido = $('.form-control#segundoApellidoRegistro').val();
			var email = $('.form-control#emailRegistro').val();
			var pass = $(':password').val();
			var rut = $('.form-control#rutRegistro').val();
			var telefono = $('.form-control#telefonoRegistro').val();
			var tipoPlan = $('input:radio[name=tipoAdmin]:checked').val();	
			var idRegistro = $('.form-control#valorHidden').val();
			
				var esACTIVADO = $('#esActivado:checked').val();
				if(!esACTIVADO == 1){
					esACTIVADO= 0;
				}else{
					esACTIVADO = 1;
				}


			//Ejecucion AJAX.
			var dataString = 'nombre1='+ nombre1 + '&nombre2='+ nombre2 +'&primerApellido='+ primerApellido + '&segundoApellido='+ segundoApellido + '&email='+ email + '&password='+ pass + '&rut=' + rut + '&telefono='+ telefono + '&tipoPlan=' + tipoPlan + '&idRegistro=' + idRegistro + '&esACTIVADO='+ esACTIVADO;

			$.ajax({
				type:"POST",
				url: "../php/modificarCliente.php",
				data: dataString,
				cache: false,
				success: function(result){

					if (result == 1){
						window.location = '../plantillas/clienteEditado.html';
					}
				}
			});
		}
	});
});
$(document).ready(function () {  

	$('#btnRegistro').click(function()
	{
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
		if( nombre1RegistroLargo >= 50)
		{
		alert('El campo primer nombre excede el valor permitido.');
		$('.form-control#nombre1Registro').focus();
			return false;
		}else if( nombre2RegistroLargo >= 50)
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
		if( primerApellidoRegistroLargo >= 50)
		{
		alert('El campo primer apellido excede el valor permitido.');
		$('.form-control#primerApellidoRegistro').focus();
			return false;
		}else 
		if( segundoApellidoRegistroLargo >= 50)
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
		if( emailRegistroLargo >= 100)
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
		if( passRegistroUnoLargo > 15)
		{
		alert('La contraseña no debe exceder los 15 caracteres.');
		$('.form-control#passRegistroUno').focus();
			return false;
		}else 
		if(rutRegistroLargo > 12)
		{
		alert('Por favor verifique el RUT.');
		$('.form-control#rutRegistro').focus();
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
			
	

			//Ejecucion AJAX.
			var dataString = 'nombre1='+ nombre1 + '&nombre2='+ nombre2 +'&primerApellido='+ primerApellido + '&segundoApellido='+ segundoApellido + '&email='+ email + '&password='+ pass + '&rut=' + rut + '&telefono='+ telefono + '&tipoPlan=' + tipoPlan + '&idRegistro=' + idRegistro;

			$.ajax({
				type:"POST",
				url: "../php/registrarAdmin.php",
				data: dataString,
				cache: false,
				success: function(result){
					alert(result);
					if (result == 1){
						window.location = '../plantillas/errorRegistro.html';
					}else if(result == 2){
						window.location = '../plantillas/registroAdminCompleto.html';
					}else if(result == 3){
						window.location = '../plantillas/errorRegistro2.html';
					}
				}
			});
		}
	 //Validador de RUT
	 function VerificaRut(rut) {
    if (rut.toString().trim() != '' && rut.toString().indexOf('-') > 0) {
        var caracteres = new Array();
        var serie = new Array(2, 3, 4, 5, 6, 7);
        var dig = rut.toString().substr(rut.toString().length - 1, 1);
        rut = rut.toString().substr(0, rut.toString().length - 2);

        for (var i = 0; i < rut.length; i++) {
            caracteres[i] = parseInt(rut.charAt((rut.length - (i + 1))));
        }

        var sumatoria = 0;
        var k = 0;
        var resto = 0;

        for (var j = 0; j < caracteres.length; j++) {
            if (k == 6) {
                k = 0;
            }
            sumatoria += parseInt(caracteres[j]) * parseInt(serie[k]);
            k++;
        }

        resto = sumatoria % 11;
        dv = 11 - resto;

        if (dv == 10) {
            dv = "K";
        }
        else if (dv == 11) {
            dv = 0;
        }

        if (dv.toString().trim().toUpperCase() == dig.toString().trim().toUpperCase())
            return true;
        else
            return false;
    }
    else {
        return false;
    }
	}

















	});


});



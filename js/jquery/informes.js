$(document).ready(function (){
	//Seleccionamos el local
	$('#btnSeleccionar').click(function(event) {
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

		    			window.location = 'menuInformes.php';
		    		}
		    	});
		    }
		});
	


	//Funciones de llamado a informes---------
	//Mostrar informe de GARZONES
	$('#btnGetGarzones').click(function(event) {
		$('#errorCMB').addClass('hidden');
		var valor = $('#cmbLocales').val();
		if (valor == 0)
		{
			$('#errorCMB').removeClass('hidden');
		}else
		if(valor == 'pdf'){
			window.location = '../php/informes/informeGarzonesPDF.php';
		}else
		if(valor == 'excel')
		{
			alert('excel');
		}
	});

	//MOSTRAR INFORME DE MENUS REGISTRADOS
	$('#btnGetMenu').click(function(event) {
		$('#errorCMB').addClass('hidden');
		var valor = $('#cmbLocales').val();
		if (valor == 0)
		{
			$('#errorCMB').removeClass('hidden');
		}else
		if(valor == 'pdf'){
			window.location = '../php/informes/informeMenuPDF.php';
		}else
		if(valor == 'excel')
		{
			alert('excel');
		}
	});
});
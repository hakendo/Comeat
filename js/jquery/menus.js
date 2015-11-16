$(document).ready(function () {  

	$('#btnSeleccionar').click(function(){

		//envío los datos a un php para así editar los variables de session.
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
					
						window.location = 'menuLocal.php';
				}
			});
		    }

	});
	//agregar menu
	$('#btnAgregarMenu').click(function(){					
						window.location = 'agregarMenu.php';
				});

	
	

});
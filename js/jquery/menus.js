$(document).ready(function () {  

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

		    			window.location = 'menuLocal.php';
		    		}
		    	});
		    }

		});
	//agregar menu
	$('#btnAgregarMenu').click(function(){					
		window.location = 'agregarMenu.php';
	});

	$('#btnModificarOrdenCategoria').click(function(){					
		window.location = 'ordenCategorias.php';
	});
	
	//Cargar Categoria de menus.
	$('#cmbCategoria').ready(function(){

		var VariableID_idMENU = $('#cmbCategoria').val(); 

		var dataString = 'idMenu='+ VariableID_idMENU;
		$.ajax({
			type:"POST",
			url: "../php/cargarCmbCategoria.php",
			data: dataString,
			cache: false,
			success: function(result){
				$("#cmbCategoria").html(result);
			}


		});
	});
	//Cargar menú dependiendo de la categoria seleccionada.
	//Cargar Comunas.
	$('#cmbCategoria').change(function(){

		var categoriaSeleccionada = $('#cmbCategoria').val();

		if(categoriaSeleccionada == "seleccione"){
			alert('Por favor seleccione una categoria para cargar sus menú');
			$("#cmbMenu").val('');
		}else{

			var dataString = 'categoriaSeleccionada='+ categoriaSeleccionada;
			$.ajax({
				type:"POST",
				url: "../php/cargarCMBMenu.php",
				data: dataString,
				cache: false,
				success: function(result){
					$("#cmbMenu").html(result);
				}
				

			});
		}
		
	});

	//************ Inicio menuLocal.php  *******************
	//Editar menú de un local determinado.
	$('#btnEditarCategoria').click(function() {
		var valor = $('#cmbCategoria').val();
		

		if (valor == 'seleccione'){
			alert('Por favor seleccione una categoria para editar');
			$('#cmbCategoria').focus();
		}else{
			var dataString = 'idCategoria='+ valor ;
			$.ajax({
				type:"POST",
				url: "../php/seleccionarCategoriaMenu.php",
				data: dataString,
				cache: false,
				success: function(result){
					
					window.location = '../admin/editarCategoriaMenu.php';
				}
			});
		}
	});

	//Agregar una nueva categoria de menu
	$('#btnAgregarCategoria').click(function() {
					window.location = '../admin/agregarCategoriaMenu.php';
	});

	//**************** Fin menuLocal.php ************************

	//***************** Inicio de variables de edicion **********
	//INICIO EDICION DE  CATEGORIAS DE MENU.
		
	
	$('#btnEditarCategoriaMenu').click(function() {
		var nombreCategoria = $('#categoriaMenu').val()
		var idCliente = $("#idCliente").val();
		var idLocal = $("#idLocal").val();
		var idCatMenu = $("#idCatMenu").val();
		
		var dataString = 'nombreCategoria='+ nombreCategoria + '&idCliente='+ idCliente + '&idLocal='+ idLocal + '&idCatMenu=' + idCatMenu;

		 $.ajax({
			type:"POST",
			url: "../php/editarCategoriaMenu.php",
			data: dataString,
			cache: false,
			success: function(result){
				console.log(result);
				if(result == 1)
					{
						window.location = '../plantillas/categoriaEditada.html';
					}else if(result == 2)
					{
						window.location = '../plantillas/errorprivilegios.html';
					}		
			}
		});	
	});

	$('#btnAgregarCategoriaMenu').click(function(event) {
		var nombreCategoria = $('#categoriaMenu').val()
		var idCliente = $("#idCliente").val();
		var idLocal = $("#idLocal").val();
		var idCatMenu = $("#idCatMenu").val();

		var dataString = 'nombreCategoria='+ nombreCategoria + '&idCliente='+ idCliente + '&idLocal='+ idLocal + '&idCatMenu=' + idCatMenu;

		$.ajax({
			type:"POST",
			url: "../php/agregarCategoriaMenu.php",
			data: dataString,
			cache: false,
			success: function(result){
				console.log(result);
				if(result == 1)
					{
						window.location = '../plantillas/categoriaLista.html';
					}else if(result == 2)
					{
						window.location = '../plantillas/errorprivilegios.html';
					}		
			}
		});
	});

	//***************** Fin de variables de edicion *************

	//Validador de agregar categoria
	$('#orden_categoria').ready(function(){
		var valor = $('#orden_categoria').val()

		if (valor == 0)
		{
			$('#errorDiv').removeClass('hidden');
			$('#btnAgregarCategoriaMenu').addClass('disabled');
			
		}
		
	});

	$('#noExisteCategoria').ready(function(){
		
		var valor = $('#noExisteCategoria').val();
		for (var i = 0; i < valor; i++) {
			$('#okDiv'+i).addClass('hidden');
			$('#errorDiv'+i).addClass('hidden');
		}
		
		if(valor == 0)
		{
			$('#noIngresoCategoria').removeClass('hidden');

			
		}else{
			
			$('#noIngresoCategoria').addClass('hidden');

		}
	});

	$('#btnModificarOrdenCategoriaSave').click(function(event) {
		
		//Primero que todo limpiamos los campos de errores.
		var valor = $('#noExisteCategoria').val();
		for (var i = 0; i < valor; i++) {
			$('#okDiv'+i).addClass('hidden');
			$('#errorDiv'+i).addClass('hidden');
		}
		

		//Variable valor, rescata la cantidad total de categorias ingresadas, para luego realizar las funciones correspondientes
		var valor = $('#noExisteCategoria').val();
		for (var i = 0; i < valor; i++) {
			//Rescate de variables
			var id_categoria_menu = $('#idCatMenu'+i).val();
			var id_cliente = $('#idCliente'+i).val();
			var id_local = $('#idLocal'+i).val();
			var id_nombre_categoria_menu = $('#categoriaMenu'+i).val();  
			var id_orden_categoria_menu = $('#orden_categoria'+i).val();
			//Ubicacion de variable para mostrar u ocultar errores.
			var ubicacionVariable = i;
			//Rescatamos las variables y ejecutamos un ajax para cada uno.
			var dataString =  'idCategoriaMenu='+ id_categoria_menu + '&idCliente='+ id_cliente + '&idLocal='+ id_local + '&idNombreCategoria=' + id_nombre_categoria_menu + '&ordenCategoria=' + id_orden_categoria_menu + '&ubicacionVariable=' + ubicacionVariable;
			$.ajax({
			type:"POST",
			url: "../php/editarOrdenCategoriaMenu.php",
			data: dataString,
			cache: false,
			success: function(result){
				console.log(result);
				$('#'+result).removeClass('hidden');
			}
		});				
		}
		
	});

	});
<?php
	session_start();
	if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3)
	{
	    require'../PDO/conexion.php';
	   //Capturar datos.
	   
		//Capturar datos.

		$idCategoriaMenu = $_POST['idCategoriaMenu'];
		$idCliente =  $_POST['idCliente'];
		$idLocal =  $_POST['idLocal'];
		$idNombreCategoria = $_POST['idNombreCategoria'];
		$ordenCategoria = $_POST['ordenCategoria'];

		//Valor a retornar en caso de éxito u error
		$ubicacionVariable = $_POST['ubicacionVariable'];

		$objConnect = new Conexion();
	    //Inicio de rescate de variables por medio de PHP.
	    $objConnect->connect();
	    $SQLEditar = "UPDATE categoria_menu SET ORDEN_CATEGORIA_MENU=".$ordenCategoria." WHERE ID_CATEGORIA_MENU=".$idCategoriaMenu." AND ID_CLIENTE=".$idCliente." AND ID_LOCAL=".$idLocal.";";
	    
	    $agregar = mysql_query($SQLEditar) or die ("errorDiv".$ubicacionVariable); 
	    
	    //Exito al editar
	    if($agregar) {
	    	echo "okDiv".$ubicacionVariable;
	    	
	    }else{
	    	echo "errorDiv".$ubicacionVariable;
	    	
	    }
	    $objConnect->closeConect();

		
	}else{

		//El usuario no tiene permiso de acceder a este lugar!
		header('Location: ../plantillas/errorPrivilegios.html');
		echo 3;
		return;
	}
?>
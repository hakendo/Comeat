<?php
	session_start();
	if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3)
	{
	    require'../PDO/conexion.php';
	   //Capturar datos.
	   
		        //Capturar datos de form.

		$idCliente = $_POST['idCliente'];
		$idLocal =$_POST['idLocal'];
		$idCatMenu= $_POST['idCatMenu'];
		$nombreCatMenu = $_POST['nombreCategoria'];

		$objConnect = new Conexion();
	    //Inicio de rescate de variables por medio de PHP.
	    $objConnect->connect();
	    $SQLEditar = "UPDATE categoria_menu SET NOMBRE_CATEGORIA_MENU='".$nombreCatMenu."' WHERE ID_CATEGORIA_MENU=".$idCatMenu." AND ID_CLIENTE=".$idCliente." AND ID_LOCAL=".$idLocal.";";
	    
	    $agregar = mysql_query($SQLEditar) or die ("No se ha podido editar el local :("); 
	    $objConnect->closeConect();
	    //Exito al editar
	    echo 1;
	    return;

		
	}else{

		//El usuario no tiene permiso de acceder a este lugar!
		echo 2;
		return;
	}
?>
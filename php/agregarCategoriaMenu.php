<?php
	session_start();
	if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3)
	{
	    require'../PDO/conexion.php';
	   //Capturar datos.
	   
		        //Capturar datos de form.

		$idCliente = $_POST['idCliente'];
		$idLocal =$_POST['idLocal'];
		
		$nombreCatMenu = $_POST['nombreCategoria'];

		$objConnect = new Conexion();
	    //Inicio de rescate de variables por medio de PHP.
	    $objConnect->connect();
	    $SQLAgregar = "INSERT INTO categoria_menu VALUES (0, ".$idCliente.", ".$idLocal.", '".$nombreCatMenu."');";
	   
	   	
	    $agregar = mysql_query($SQLAgregar) or die ("No se ha podido registrar el local :("); 
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
<?php
	session_start();
	if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3){
   	$_SESSION["ID_LOCAL"] = $_POST["idLocal"]; 

   	require'../PDO/conexion.php';
     $objConnect = new Conexion();
     //Inicio de rescate de variables por medio de PHP.
     $objConnect->connect();
     //Verificamos el estado de la cuenta (sí o sí)
     $consultaEstado = "SELECT NOMBRE_LOCAL from local WHERE ID_LOCAL = ".$_SESSION["ID_LOCAL"].";";
     $query_Estado = mysql_query($consultaEstado) or die ("No se ha podido realizar la consulta en la BD".$consulta);
     $col = mysql_fetch_array($query_Estado); 

   	$_SESSION["NOMBRE_LOCAL"] = $col['NOMBRE_LOCAL'];
  }else{
  	header("Location: ../plantillas/errorPrivilegios.html");
   
  }

?>
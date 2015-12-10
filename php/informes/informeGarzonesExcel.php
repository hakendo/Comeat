<?php
	session_start();
  if($_SESSION["PRIVILEGIO"] !== 9 ){
    header("Location: ../plantillas/errorPrivilegios.html");
}else{
	require'../PDO/conexion.php';
	include("php/conexion.php");
	/*$objConnect = new Conexion();
	
	$objConnect->connect();
	$consulta = "select * from CLIENTE";

	$ejecutar_consulta = mysql_query($consulta) or die ("No se ha podido realizar la consulta en la BD");

	    $objConnect->closeConect();
	 */
	  //Inicio de funciones...
    
}
    




?>
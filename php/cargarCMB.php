<?php
	require'../PDO/conexion.php';
	$objConnect = new Conexion();
	$objConnect->connect();

	$VariableID_REGION = $_POST["VariableID_REGION"];
	$queryComuna = "SELECT * from comuna where ID_REGION= ".$VariableID_REGION.";";
	$datos_Comuna = mysql_query($queryComuna) or die ("No se ha podido realizar la consulta en la BD".$consulta);
	while ($row = mysql_fetch_array($datos_Comuna)){
		echo "<option value='".$row['ID_COMUNA']."'>".$row['NOMBRE_COMUNA']."</option>";
	} 
	$objConnect->closeConect();



?>
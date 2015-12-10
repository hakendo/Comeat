<?php

session_start();
  if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3){
$idLocal = $_SESSION["ID_LOCAL"];
require'../PDO/conexion.php';
$objConnect = new Conexion();
$objConnect->connect();

$consulta = "SELECT ID_COMUNA FROM local WHERE ID_LOCAL =".$idLocal.";";     
$ejecutar_consulta = mysql_query($consulta) or die ("No se ha podido realizar la consulta en la BD".$consulta);
$columna = mysql_fetch_array($ejecutar_consulta);               

$objConnect->closeConect();


$objConnect->connect();

$VariableID_REGION = $_POST["VariableID_REGION"];
$queryComuna = "SELECT * from comuna where ID_REGION= ".$VariableID_REGION.";";

	//Query para obtener valores mas detallados





$datos_Comuna = mysql_query($queryComuna) or die ("No se ha podido realizar la consulta en la BD".$consulta);
echo "<option value='seleccione' selected='true'>Seleccione...</option>";
while ($row = mysql_fetch_array($datos_Comuna)){
	if ($columna['ID_COMUNA'] == $row['ID_COMUNA']) {
		echo "<option selected='true' value='".$row['ID_COMUNA']."'>".$row['NOMBRE_COMUNA']."</option>";
	}else{
		echo "<option value='".$row['ID_COMUNA']."'>".$row['NOMBRE_COMUNA']."</option>";
	}
}	 
$objConnect->closeConect();
}else{
	    header("Location: ../plantillas/errorPrivilegios.html");
}

?>
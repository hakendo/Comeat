c<?php
	//Validamos si el usuario tiene permitido acceder a esta área.

	
	session_start();
  if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3){
	$idLocal =$_SESSION['ID_LOCAL'];
	$idCliente =$_SESSION['ID_CLIENTE'];
	$idCategoria = $_POST["categoriaSeleccionada"];
	require'../PDO/conexion.php';
	$objConnect = new Conexion();
	$objConnect->connect();
	
	$queryMenu = "SELECT ID_MENU, NOMBRE_MENU FROM menu  where ID_CLIENTE =".$idCliente." AND ID_LOCAL =".$idLocal." AND ID_CATEGORIA_MENU=".$idCategoria.";";

	
	$datos_Menu = mysql_query($queryMenu) or die ("No se ha podido realizar la consulta en la BD".$consulta);
	echo "<option value='seleccione' selected='true'>Seleccione...</option>";

		while ($row = mysql_fetch_array($datos_Menu)){
		echo "<option value='".$row['ID_MENU']."'>".$row['NOMBRE_MENU']."</option>";
	
		}	 
	$objConnect->closeConect();
}else{
	    header("Location: ../plantillas/errorPrivilegios.html");
}

?>
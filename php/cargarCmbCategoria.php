<?php
	//Validamos si el usuario tiene permitido acceder a esta área.

	
	session_start();
	$idLocal =$_SESSION['ID_LOCAL'];
	$idCliente =$_SESSION['ID_CLIENTE'];

	require'../PDO/conexion.php';
	$objConnect = new Conexion();
	$objConnect->connect();
	$idMenu = $_POST["idMenu"];
	$queryMenu = "SELECT * from categoria_menu where ID_CLIENTE =".$idCliente." AND ID_LOCAL =".$idLocal."  ORDER BY ORDEN_CATEGORIA_MENU ASC;";

	
	$datos_Categoria_Menu = mysql_query($queryMenu) or die ("No se ha podido realizar la consulta en la BD".$consulta);
	echo "<option value='seleccione' selected='true'>Seleccione...</option>";

		while ($row = mysql_fetch_array($datos_Categoria_Menu)){
		echo "<option value='".$row['ID_CATEGORIA_MENU']."'>".$row['NOMBRE_CATEGORIA_MENU']."</option>";
	
		}	 
	$objConnect->closeConect();

?>
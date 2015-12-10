<?php
	session_start();
	if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3){
	$_SESSION["ID_GARZON"] = $_POST["idGarzon"]; 
  }else{
  	header("Location: ../plantillas/errorPrivilegios.html");
   
  }

?>
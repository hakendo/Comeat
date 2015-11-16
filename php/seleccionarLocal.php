<?php
	session_start();
	if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3){
   	$_SESSION["ID_LOCAL"] = $_POST["idLocal"]; 
  }else{
  	header("Location: ../plantillas/errorPrivilegios.html");
   
  }

?>
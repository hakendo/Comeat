<?php
	session_start();
	if($_SESSION["PRIVILEGIO"] !== 9){
    header("Location: ../plantillas/errorPrivilegios.html");
  }else{

   $_SESSION["idCliente"]= $_POST["idcliente"];

     
     // echo $_SESSION["idCliente"];
  }

?>
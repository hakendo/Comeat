<?php
	session_start();
	$id_categoria_menu = $_POST['idCategoria'];
	$_SESSION["ID_CATEGORIA_MENU"] = $id_categoria_menu;
?>
<?php
	session_start();
	$id_categoria_menu = $_POST['idCategoria'];
	$id_menu = $_POST['idMenu'];
	$_SESSION["ID_CATEGORIA_MENU"] = $id_categoria_menu;
	$_SESSION['ID_MENU'] = $id_menu;
?>
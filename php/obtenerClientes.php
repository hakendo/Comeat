<?php

	require'../PDO/conexion.php';
	$objConnect = new Conexion();
	
	$objConnect->connect();
	$consulta = "select * from CLIENTE";

	$ejecutar_consulta = mysql_query($consulta) or die ("No se ha podido realizar la consulta en la BD");

	    $objConnect->closeConect();
	    return $clientes;
	
    public $datoCli = array();
    public llenarCMB(){
    	
 		 while ($row = mysql_fetch_array($ejecutar_consulta)) 
	    {
         $dato = '<option value="'.$row['ID_CLIENTE'].'">'.$row['CORREO_CLIENTE'].'</option>';   
         array_push($datoCli, $dato);
	    }
	    $objConnect->closeConect();
	    return $datoCli;
    }
    

    




?>
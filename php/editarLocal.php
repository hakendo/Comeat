<?php
	session_start();
	if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3)
	{
		$ruta = $_SESSION["CORREO"];
	    $idCliente = $_SESSION["ID_CLIENTE"];
	    $idLocal = $_SESSION["ID_LOCAL"];
	    require'../PDO/conexion.php';
	   //Capturar datos.
	   
		        //Capturar datos de form.

		$nombreLocal = $_POST['nombreLocal'];
		$direccionLocal =$_POST['direccionLocal'];
		$telefonoLocal= $_POST['telefonoLocal'];
		$regionLocal = $_POST['regionEdit'];
		$comunaLocal = $_POST['comunaEdit'];
		$latitudLocal = $_POST['latitudLocal'];
		$longitudLocal = $_POST['longitudLocal'];
		$emailLocal = $_POST['emailLocal'];
		$webLocal =$_POST['webLocal'];
		$idCliente = $_POST['idCliente'];
		$categoria =  $_POST['categoria'];
		$esComeat = 0;
		$descripcionLocal = $_POST['descripcion'];
		$IMAGEN_LOCAL = [$_POST['URLIMAGEN']];
		
		//************************************
		//************ CAPTURAR DATOS DE IMAGEN ***************
		include("Thumbnail.class.php");
		$nombre_archivo = $_FILES["imagen"]["name"];
		     //Obtener extension:
		$extension = "";
		if ($_FILES["imagen"]["type"] == "image/jpeg")
		{
		    $extension = ".jpeg";
		}else if ($_FILES["imagen"]["type"] == "image/png" ) 
		{
		    $extension = ".png";
		}else if ($_FILES["imagen"]["type"] == "image/gif") 
		{
		    $extension = ".gif";
		}


		$URL_long = "../cliente/".$ruta."/".$nombreLocal.'_'.$idCliente.'/';
		$URL_short = "cliente/".$ruta."/".$nombreLocal.'_'.$idCliente.'/'; 
		$URL_full = "http://www.comeat.cl/".$URL_short.$nombre_archivo.$extension;
		$carpeta = "../cliente/".$ruta."/".$nombreLocal.'_'.$idCliente.'/';
		

		//*****************************************************
		if($nombre_archivo == "" )
		{
			//Se cambian los datos, exceptuando la imagen
		$objConnect = new Conexion();
	    //Inicio de rescate de variables por medio de PHP.
	    $objConnect->connect();
	    $SQLEditar = "UPDATE local SET ID_REGION=".$regionLocal.", ID_COMUNA=".$comunaLocal.", NOMBRE_LOCAL='".$nombreLocal."', DIRECCION_LOCAL='".$direccionLocal."', LATITUD_LOCAL=".$latitudLocal.", LONGITUD_LOCAL=".$longitudLocal.", ID_CATEGORIA_LOCAL='".$categoria."', CORREO_LOCAL='".$emailLocal."', WEB_LOCAL='".$webLocal."', TELEFONO_LOCAL='".$telefonoLocal."', DESCRIPCION_LOCAL='".$descripcionLocal."' WHERE ID_CLIENTE=".$idCliente." AND ID_LOCAL=".$idLocal.";";
	   
	    $agregar = mysql_query($SQLEditar) or die ("No se ha podido editar el local :("); 
	    $objConnect->closeConect();
	    echo 1;
	    return;
		}else{
			//Se cambian todos los datos!!!!!!!!!!!!.
			$carpeta = "../cliente/".$ruta."/".$nombreLocal."_".$idCliente;
                    //Crear directorio de usuario para guardar imagenes
      			
                         //si se agrega correctamente damos un mensaje de que se registro con exito 

               //*******Creamos la carpeta y agregamos la imagen seleccionada**************

			
               if(!file_exists($URL_long)) {
                   mkdir($carpeta, 0755);
                   if(isset($_FILES["imagen"])) 
                   {
	                    $temp = $_FILES["imagen"]["tmp_name"];
	                    $thumb = new Thumbnail($temp);
	                    if($thumb->error) {
	                        echo $thumb->error;
	                    } else {
	                        $thumb->resize(500);
	                        $thumb->save_jpg($URL_long, $nombre_archivo);
	                    }
                    }
                }else{
                    if(isset($_FILES["imagen"])) {
                        $temp = $_FILES["imagen"]["tmp_name"];

                        $thumb = new Thumbnail($temp);
                        if($thumb->error) {
                            echo $thumb->error;
                        } else {
                            $thumb->resize(500);
                            $thumb->save_jpg($URL_long, $nombre_archivo);
                        }
                    }
                }
		  

		$objConnect = new Conexion();
	    
		//Creación de imagen
	    //Inicio de rescate de variables por medio de PHP.
	    $objConnect->connect();
	    $SQLEditar = "UPDATE local SET ID_REGION=".$regionLocal.", ID_COMUNA=".$comunaLocal.", NOMBRE_LOCAL='".$nombreLocal."', DIRECCION_LOCAL='".$direccionLocal."', LATITUD_LOCAL=".$latitudLocal.", LONGITUD_LOCAL=".$longitudLocal.", ID_CATEGORIA_LOCAL='".$categoria."', URL_IMAGEN_LOCAL='".$URL_full."', CORREO_LOCAL='".$emailLocal."', WEB_LOCAL='".$webLocal."', TELEFONO_LOCAL='".$telefonoLocal."', DESCRIPCION_LOCAL='".$descripcionLocal."' WHERE ID_CLIENTE=".$idCliente." AND ID_LOCAL=".$idLocal.";";
	    
	    $agregar = mysql_query($SQLEditar) or die ("No se ha podido editar el local :("); 
	    $objConnect->closeConect();
	    echo 2;
	    return;
	
	  }
	}else{
	echo 3;
	return;
	
  }

?>
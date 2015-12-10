<?php
session_start();
if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3)
{
	$ruta = $_SESSION["CORREO"];
	$idCliente = $_SESSION["ID_CLIENTE"];
	$idLocal = $_SESSION["ID_LOCAL"];
	$id_menu = $_SESSION['ID_MENU'];
	$nombreLocal = $_SESSION['NOMBRE_LOCAL'];
	require'../PDO/conexion.php';
	   //Capturar datos.

		        //Capturar datos de form.
	$nombreMenuAntiguo = $_POST['nombreMenuAntiguo'];
	$nombreMenuNuevo = $_POST['nombreMenu'];
	$precioMenu =$_POST['precioMenu'];
	$descuentoMenu= $_POST['descuentoMenu'];
	$descripcion = $_POST['descripcionMenu'];
	

	$IMAGEN_LOCAL = $_POST['URLIMAGEN'];

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


	$URL_long = "../cliente/".$ruta."/".$nombreLocal.'_'.$idCliente.'/'.$nombreMenuNuevo."/";
	$URL_short = "cliente/".$ruta."/".$nombreLocal.'_'.$idCliente.'/'.$nombreMenuNuevo; 
	$URL_full = "http://www.comeat.cl/".$URL_short."/".$nombre_archivo.$extension;
	$carpeta = "../".$URL_short;

	//Primero ejecutamos una validación de nombres, para que no se repitan.
		$objConnect = new Conexion();
		$objConnect->connect();

		
		$queryNombreMenu = "SELECT NOMBRE_MENU FROM menu where ID_LOCAL= ".$idLocal." AND ID_CLIENTE=".$idCliente.";";

		
		$datosNombre = mysql_query($queryNombreMenu) or die ("No se ha podido realizar la consulta en la BD: ".$queryNombreMenu);
		
			while ($data = mysql_fetch_array($datosNombre)){
			if ($data['NOMBRE_MENU'] == $nombreMenuNuevo) {
						echo 'duplicado';
						return;
					}		
			}	 
		$objConnect->closeConect();

		//*****************************************************
	
		//Se verifica si el nombre del menú cambió
	if($nombreMenuNuevo == $nombreMenuAntiguo){
		//El nombre del menú no ha cambiado y no se ha cambiado la imagen.

		if($nombre_archivo == "" )
		{
		//Se cambian los datos, exceptuando la imagen y el nombre del menú
			
	    //Inicio de rescate de variables por medio de PHP.
			$objConnect->connect();
			$SQLEditar = "UPDATE menu SET PRECIO_MENU=".$precioMenu.".0, OFERTA_MENU=".$descuentoMenu.", DESCRIPCION_MENU='".$descripcion."' WHERE ID_MENU=".$id_menu." AND ID_LOCAL=".$idLocal.";";

			$agregar = mysql_query($SQLEditar) or die ("No se ha podido editar el MENÚ 1 :("); 
				$objConnect->closeConect();
				echo 1;
				return;	
			}else{
			//El nombre no cambia, pero sí la imagen.
				$objConnect = new Conexion();
		    //Inicio de rescate de variables por medio de PHP.
				$objConnect->connect();
				$SQLEditar = "UPDATE menu SET NOMBRE_MENU='".$nombreMenuNuevo."', URL_IMAGEN_MENU='".$URL_full."', PRECIO_MENU=".$precioMenu.".0, OFERTA_MENU=".$descuentoMenu.", DESCRIPCION_MENU='".$descripcion."' WHERE ID_MENU=".$id_menu." AND ID_LOCAL=".$idLocal.";";
				$agregar = mysql_query($SQLEditar) or die ("No se ha podido editar el MENÚ 2 :("); 
					$objConnect->closeConect();
				//Se ejecuta el cambio de imagen.
				//*********************************
					if(!file_exists($URL_long)){
						mkdir($carpeta, 0755);
						if(isset($_FILES["imagen"])) 
						{
							$temp = $_FILES["imagen"]["tmp_name"];
							$thumb = new Thumbnail($temp);
							if($thumb->error) {
								echo $thumb->error;
							} else {
								$thumb->resize(200, 150);
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
								$thumb->resize(200, 150);
								$thumb->save_jpg($URL_long, $nombre_archivo);
							}
						}
					}
				//FIN cambio de imagen ************
					echo 1;
					return;
				}


			}else{
				//Se cambia el nombre del menú.
				if($nombre_archivo == "" )
				{
					//Se cambia el nombre del menú, pero no la imagen.
					//Cuando realizamos esto, exigimos que se ingrese una nueva imagen.
					echo "imgError";
					return;
				}else{
					/*Se cambia el nombre del menú
					* y se incluye una nueva imagen
					*/
				$objConnect = new Conexion();
				$objConnect->connect();
				$SQLEditar = "UPDATE menu SET NOMBRE_MENU='".$nombreMenuNuevo."', URL_IMAGEN_MENU='".$URL_full."', PRECIO_MENU=".$precioMenu.".0, OFERTA_MENU=".$descuentoMenu.", DESCRIPCION_MENU='".$descripcion."' WHERE ID_MENU=".$id_menu." AND ID_LOCAL=".$idLocal.";";
				$agregar = mysql_query($SQLEditar) or die ("No se ha podido editar el MENÚ 3 :("); 
					
					$objConnect->closeConect();

				//*****Se ejecuta el cambio de nombre a la carpeta:****
				//url antigua:
				$URL_antigua = "../cliente/".$ruta."/".$nombreLocal.'_'.$idCliente.'/'.$nombreMenuAntiguo;
				rename ($URL_antigua, $carpeta);
				//****Finaliza el cambio de nombre a la carpeta****
				
				//Se ejecuta el cambio de imagen.
				//*********************************
					if(!file_exists($URL_long)){
						mkdir($carpeta, 0755);
						if(isset($_FILES["imagen"])) 
						{
							$temp = $_FILES["imagen"]["tmp_name"];
							$thumb = new Thumbnail($temp);
							if($thumb->error) {
								echo $thumb->error;
							} else {
								$thumb->resize(200, 150);
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
								$thumb->resize(200, 150);
								$thumb->save_jpg($URL_long, $nombre_archivo);
							}
						}
					}
				//FIN cambio de imagen ************
				
				
					echo 1;
					return;

				}
				}

		
}else{
	header("Location: ../plantillas/errorPrivilegios.html");
	}
?>
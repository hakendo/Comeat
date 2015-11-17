<?php

    //Controlar acceso a la aplicación!
        //Consultar a la BD por el nombre de usuario y password:
session_start();
require'../PDO/conexion.php';
$ruta = $_SESSION["CORREO"];
$objConnect = new Conexion();

$objConnect->connect();


        //Capturar datos de form.

$nombreLocal = $_POST['nombreLocal'];
$direccionLocal =$_POST['direccionLocal'];
$telefonoLocal= $_POST['telefonoLocal'];
$razonLocal = $_POST['razonLocal'];
$comunaLocal = $_POST['comuna'];
$latitudLocal = $_POST['latitudLocal'];
$longitudLocal = $_POST['longitudLocal'];
$emailLocal = $_POST['emailLocal'];
$webLocal =$_POST['webLocal'];
$idLocal = $_POST['idLocal'];
$idCliente = $_POST['idCliente'];
$categoria =  $_POST['categoria'];
$esComeat = 0;
$descripcionLocal = $_POST['descripcion'];
        //************************************
        //************ CAPTURAR DATOS DE IMAGEN ***************
include("Thumbnail.class.php");
$nombre_archivo = $_FILES["imagen"]["name"];
if ($nombre_archivo == "") {

    echo "imgError";
    return;
}

         //Obtener extension:
$extension = " ";
if ($_FILES["imagen"]["type"] == "image/jpeg"){
    $extension = ".jpeg";
}else if ($_FILES["imagen"]["type"] == "image/png" ) {
    $extension = ".png";
}else if ($_FILES["imagen"]["type"] == "image/gif") {
    $extension = ".gif";
}
$URL_long = "../cliente/".$ruta."/".$nombreLocal.'_'.$idCliente.'/';
$URL_short = "cliente/".$ruta."/".$nombreLocal.'_'.$idCliente.'/'; 
$URL_full = "http://www.comeat.cl/".$URL_short.$nombre_archivo.$extension;
$carpeta = "../cliente/".$ruta."/".$nombreLocal.'_'.$idCliente.'/';

        //*****************************************************

        //Query SQL
        //Verificamos si las coordenadas del local ya estan registradas.


$SQLcomprobarNombre = "SELECT NOMBRE_LOCAL FROM local where ID_CLIENTE = ".$idCliente." AND NOMBRE_LOCAL = '".$nombreLocal."');";


$esRegistrado = mysql_query($SQLcomprobarNombre);

$SQLagregar = "INSERT INTO local VALUES(0,".$idCliente.",".$comunaLocal.",'".$nombreLocal."','".$direccionLocal."',".$latitudLocal.",".$longitudLocal.",'".$categoria."','".$URL_full."',0,'".$telefonoLocal."','".$descripcionLocal."');";

$resultado =  mysql_query($esRegistrado);
    $estado = 0;
    if ($resultado == true )
        {   //El correo ya está registrado
            $objConnect->closeConect();
            $estado = 1;
        }else{

            $agregar=mysql_query($SQLagregar); 
            if($agregar){ 
                $carpeta = "../cliente/".$ruta."/".$nombreLocal."_".$idCliente;
                        //Crear directorio de usuario para guardar imagenes
                if(!file_exists($carpeta)) 
                {
                   mkdir($carpeta, 0755);
                             //si se agrega correctamente damos un mensaje de que se registro con exito 
                   $objConnect->closeConect();
                   $estado = 2;

                   //*******Creamos la carpeta y agregamos la imagen seleccionada**************
                   if(!file_exists($URL_long)) {
                       mkdir($carpeta, 0755);
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
                   //**************************************************************************
                $estado = 2;
            }else if(file_exists($carpeta))
            {
                $objConnect->closeConect();
                $estado = 2;

            }
        }else{ 
                    //en caso de no poder insertar el nuevo usuario dejamos un codigo de error. 
            $objConnect->closeConect();
            $estado = 3;
        } 
    }
    echo $estado;
    ?>
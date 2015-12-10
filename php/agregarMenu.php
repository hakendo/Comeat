<?php

    //Controlar acceso a la aplicación!
        //Consultar a la BD por el nombre de usuario y password:
session_start();
    if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3)
    {
    require'../PDO/conexion.php';
    $ruta = $_SESSION["CORREO"];
    $idCategoriaMenu = $_SESSION['ID_CATEGORIA_MENU'];
    $idCliente = $_SESSION['ID_CLIENTE'];
    $id_Local = $_SESSION['ID_LOCAL'];

    $objConnect = new Conexion();

    $objConnect->connect();


        //Capturar datos de form.
        $nombreMenu = $_POST['nombreMenu'];
        $precioMenu = $_POST['precioMenu'];
        $descuentoMenu = $_POST['descuentoMenu'];
        $descripcionMenu = $_POST['descripcionMenu'];
        //************************************
        //Se obtiene nombre de local para guardar la img en el folder especificado:
        $queryNombre = "SELECT NOMBRE_LOCAL FROM local where ID_CLIENTE = ".$idCliente." AND ID_LOCAL=".$_SESSION['ID_LOCAL'].";";
        $result = mysql_query($queryNombre) or die ('ERROR!');
        $exe = mysql_fetch_array($result);
        
        $nombreLocal = $exe['NOMBRE_LOCAL'];
         $objConnect->closeConect();

        $objConnect->connect();

        //echo($result['NOMBRE_LOCAL']."OJOOOOOOO");

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
    $URL_long = "../cliente/".$ruta."/".$nombreLocal.'_'.$idCliente.'/'.$nombreMenu.'/';
    $URL_short = "cliente/".$ruta."/".$nombreLocal.'_'.$idCliente.'/'.$nombreMenu.'/'; 
    $URL_full = "http://www.comeat.cl/".$URL_short.$nombre_archivo.$extension;
    $carpeta = "../cliente/".$ruta."/".$nombreLocal.'_'.$idCliente.'/';

        //*****************************************************

        //Query SQL
        //Verificamos si las coordenadas del local ya estan registradas.


$SQLcomprobarNombre = "SELECT NOMBRE_MENU FROM menu where ID_CLIENTE = ".$idCliente." AND ID_LOCAL =".$id_Local." AND NOMBRE_MENU= '".$nombreMenu."';";


$SQLagregar = "INSERT INTO menu VALUES(0, ".$idCliente.", ".$id_Local.", '".$nombreMenu."', ".$idCategoriaMenu.", ".$precioMenu.".0, '".$descripcionMenu."', ".$descuentoMenu.", '".$URL_full."');";


$resultado =  mysql_query($SQLcomprobarNombre);
    $estado = 0;
    if ($resultado == false )
        {   //El correo ya está registrado
            $objConnect->closeConect();
            $estado = 1;
        }else{

            $agregar=mysql_query($SQLagregar) or die('Error!'); 
            if($agregar){ 
                $carpeta = "../cliente/".$ruta."/".$nombreLocal."_".$idCliente."/".$nombreMenu;
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
                            $thumb->resize(200,150);
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
                            $thumb->resize(200,150);
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
}else{
     header("Location: ../plantillas/errorPrivilegios.html");
}
    ?>

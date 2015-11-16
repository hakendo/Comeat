<?php

//Controlar acceso a la aplicación!
    //Consultar a la BD por el nombre de usuario y password:
    
    require'../PDO/conexion.php';
    $objConnect = new Conexion();

    $objConnect->connect();
   
   
    //Capturar datos de form.
    $nombre1 = $_POST["nombre1"];
    $nombre2 = $_POST["nombre2"];
    $primerApellido = $_POST["primerApellido"];
    $segundoApellido = $_POST["segundoApellido"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    //************************************
    
    


    //Query SQL
    //Verificamos si el correo electronico ya está registrado
    $SQLcomprobar = "SELECT CORREO_USUARIO FROM USUARIO where CORREO_USUARIO= '".$email."'";
    $esRegistrado = mysql_query($SQLcomprobar);

    $SQLagregar = "INSERT INTO USUARIO VALUES (0,'".$nombre1."','".$nombre2."','".$primerApellido."','".$segundoApellido."','".$email."','".$password."');";

    $estado = 0;
    if (mysql_num_rows($esRegistrado) > 0)
    {   //El correo ya está registrado
            $objConnect->closeConect();
            $estado = 1;
        }else{
            
            $agregar=mysql_query($SQLagregar); 
                if($agregar){ 
                    //Crear directorio de usuario para guardar imagenes
                    /*if(!is_dir('usuario/'.$email)) {
                     mkdir('usuario/'.$email, 0755);
                    }*/

                    $objConnect->closeConect();
                    $estado = 2;
                }else{ 
                //en caso de no poder insertar el nuevo usuario dejamos un codigo de error. 
                    $objConnect->closeConect();
                    $estado = 3;
               } 

             }
             echo $estado;
?>
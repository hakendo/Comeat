<?php

//Controlar acceso a la aplicación!
    //Consultar a la BD por el nombre de usuario y password:
       session_start();
  if($_SESSION["PRIVILEGIO"] !== 9 ){
    header("Location: ../plantillas/errorPrivilegios.html");
}else{
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
    $rut = $_POST['rut'];
    $telefono = $_POST['telefono'];
    $tipoPlan = $_POST['tipoPlan'];
    $idRegistro = $_POST['idRegistro'];
    $tipoPlan = $_POST['tipoPlan'];
    //************************************
    
    


    //Query SQL
    //Verificamos si el correo electronico ya está registrado
    $SQLcomprobar = "SELECT CORREO_CLIENTE FROM cliente where CORREO_CLIENTE= '".$email."'";
    $esRegistrado = mysql_query($SQLcomprobar);

    $SQLagregar = "INSERT INTO cliente VALUES (0,".$idRegistro.",'".$rut."','".$nombre1."','".$nombre2."','".$primerApellido."','".$segundoApellido."','".$email."','".$password."','".$telefono."',".$tipoPlan.",1);";


    $estado = 0;
    if (mysql_num_rows($esRegistrado) > 0)
    {   //El correo ya está registrado
            $objConnect->closeConect();
            $estado = 1;
        }else{
            
            $agregar=mysql_query($SQLagregar); 
                if($agregar){ 
                    $carpeta = "../cliente/".$email;
                    //Crear directorio de usuario para guardar imagenes
                    if(!file_exists($carpeta)) {
                     mkdir($carpeta, 0755);
                     //si se agrega correctamente damos un mensaje de que se registro con exito 
                    $objConnect->closeConect();
                    $estado = 2;
                    }else{
                        $estado = 0;
                    }
                }else{ 
                //en caso de no poder insertar el nuevo usuario dejamos un codigo de error. 
                    $objConnect->closeConect();
                    $estado = 3;
               } 
             }
    echo $estado;
}
?>
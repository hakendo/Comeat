<?php

//Controlar acceso a la aplicación!
    //Consultar a la BD por el nombre de usuario y password:
    
    require'../PDO/conexion.php';
    $objConnect = new Conexion();

    $objConnect->connect();
   session_start();
    $ID_CLIENTE = $_SESSION["idCliente"];
    $idRegistro = $_SESSION["ID"];
   
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
    $esACTIVADO = $_POST['esACTIVADO'];
   
    //************************************
    
    


    //Query SQL
    //Verificamos si el correo electronico ya está registrado
    $SQLEditar = "UPDATE cliente SET ID_ADMINISTRADOR = '".$idRegistro."', RUT_CLIENTE='".$rut."', NOMBRE1_CLIENTE='".$nombre1."', NOMBRE2_CLIENTE ='".$nombre2."', APELLIDO1_CLIENTE='".$primerApellido."', APELLIDO2_CLIENTE ='".$segundoApellido."', CORREO_CLIENTE ='".$email."', CLAVE_CLIENTE='".$password."', TELEFONO_CLIENTE='".$telefono."', ID_PLAN=".$tipoPlan.", esACTIVADO =".$esACTIVADO." WHERE ID_CLIENTE=".$ID_CLIENTE.";";

            $estado = 0;

            $agregar = mysql_query($SQLEditar); 
                    $objConnect->closeConect();
                    $estado = 1;
           
    echo $estado;
?>
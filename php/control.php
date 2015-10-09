<?php
    //Controlar acceso a la aplicación!
    //Consultar a la BD por el nombre de usuario y password:
    
    include("conexion.php");

    //Selecciono a que server me conectaré- LOCAL O REMOTO.
        //LOCAL
    //$conexion = abrirConexionLocal();
        //REMOTO
    $conexion = abrirConexionRemoto();
    mysql_select_db("dodoxsg1_comeatapp") or die("No se puso seleccionar la base de datos 'comeat_db'");
    $usuario = $_POST["email_txt"];
    $password = $_POST["password_txt"];

    //  CONSULTA QUE SE DEBE REALIZAR EN HOSTING WEB
    $consulta = "SELECT USUARIO_CORREO, USUARIO_CLAVE, TIPO_USUARIO FROM USUARIOS where USUARIO_CORREO ='".$usuario."';";
    
    //$consulta = "SELECT usuario_correo, usuario_clave, tipo_usuario FROM usuarios where usuario_correo ='".$usuario."';";
    //Obtener datos personal de la persona quie ingresa:

    $ejecutar_consulta = mysql_query($consulta, $conexion) or die ("No se ha podido realizar la consulta en la BD");
    $error = "si";

    //VERIFICO SI EL USUARIO ESTA REGISTRADO:

    //Query SQL
    $SQLcomprobar = "SELECT USUARIO_CORREO FROM USUARIOS where USUARIO_CORREO= '".$usuario."'";
    $comprobar = mysql_query($SQLcomprobar);

    if (mysql_num_rows($comprobar) == 0)
    {   //El correo no está registrado
            header("Location: ../error5.html");
            break;
    }else{  

    while ($registro = mysql_fetch_array($ejecutar_consulta)) {
        //echo $registro["id_pais"]." - ".$registro["pais"]."</br>";
    
        if ($usuario == $registro["USUARIO_CORREO"] && $password == $registro["USUARIO_CLAVE"] && $registro["TIPO_USUARIO"] == 1) {
            //Inicio administrador
            $error = "no";
            //INICIO LA SESION.
            session_start();
            //Declaro mis variables de sesion.
            $_SESSION["autentificado"]=true;
            $_SESSION["privilegio"]=1;
            $_SESSION["usuario"]= $usuario;
            $error="no";
            mysql_close();
            header("Location: ../principal-admin.php");

        }
        if($usuario == $registro["USUARIO_CORREO"] && $password == $registro["USUARIO_CLAVE"] && $registro["TIPO_USUARIO"] == 2)
        {   
            //Inicio cliente.
            $error = "no";
            //INICIO LA SESION.
            session_start();
            //Declaro mis variables de sesion.
            $_SESSION["autentificado"]=true;
            $_SESSION["usuario"]= $usuario;
            $_SESSION["privilegio"]=2;
            $error="no";
            mysql_close();
            header("Location: ../principal.php");


        }
        if($usuario == $registro["USUARIO_CORREO"] && $password == $registro["USUARIO_CLAVE"] && $registro["TIPO_USUARIO"] == 3)
        {
            //Inicio usuario.
            $error = "no";
            //INICIO LA SESION.
            session_start();
            //Declaro mis variables de sesion.
            $_SESSION["autentificado"]=true;
            $_SESSION["usuario"]=$usuario;
            $_SESSION["privilegio"]=3;
            $error="no";
            mysql_close();
            header("Location: ../inicio.php");
            
        }
                    
        }
        }
        
        if ($error=="si") {
                header("Location: ../error4.html");
        }
            

?>
<?php
    session_start();
    //Primero analizamos si es un usuario logeado, o no.

    if($_SESSION["AUTENTIFICADO"] == true )
    {
       //Ahora verificamos si es un administrador logeado o no, dependiendo del privilegio redireccionaremos.
        if ($_SESSION["PRIVILEGIO"] == 1 && $_SESSION["esACTIVADO"] == 1)
        {
            header("Location: ../admin/loginCliente.php");
        }else if($_SESSION["PRIVILEGIO"] == 2 && $_SESSION["esACTIVADO"] == 1)
        {
            header("Location: ../admin/loginCliente.php");
        }else if($_SESSION["PRIVILEGIO"] == 3 && $_SESSION["esACTIVADO"] == 1)
        {
            header("Location: ../admin/loginCliente.php");

        }else if($_SESSION["PRIVILEGIO"] == 9){
            header("Location: ../admin/loginAdmin.php");
        }else if($_SESSION["esACTIVADO"] == 0)
        {
            session_destroy();
            header("Location: ../plantillas/tiempoFuera.html");
        }
    }else 
        {
            header("Location: ../login.html");
        }

?>
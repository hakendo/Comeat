    <?php

        //Controlar acceso a la aplicación!
            //Consultar a la BD por el nombre de usuario y password:
    session_start();
    if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3)
    {
        require'../PDO/conexion.php';
        $ruta = $_SESSION["CORREO"];
        $objConnect = new Conexion();

        $objConnect->connect();

        //Capturar datos de form.
        $nombre1 = $_POST['nombre1'];
        $nombre2 = $_POST['nombre2'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $correo = $_POST['email'];
        $pass = $_POST['password'];
        $rut = $_POST['rut'];
        $esCHEF = $_POST['esChef'];
        //Capturar datos de session
        $id_local = $_SESSION['ID_LOCAL'];
        $id_cliente = $_SESSION['ID_CLIENTE'];
        $yaExiste = 'existe';
        $id_garzon = $_SESSION['ID_GARZON'];

        $email = strtolower($correo);
        //*****************************************************
            //Query SQL
            //Verificamos si el correo ya está registrado.
        $SQLRescateCorreo = "SELECT CORREO_GARZON as EMAIL FROM garzon WHERE ID_CLIENTE=".$id_cliente." AND ID_LOCAL=".$id_local." AND ID_GARZON=".$id_garzon.";";  
        $queryMenu = mysql_query($SQLRescateCorreo) or die ("No se ha podido realizar la consulta en la BD");
        $row = mysql_fetch_array($queryMenu);
        $correoActual = strtolower($row['EMAIL']);
        /*Verificamos si el correo ha cambiado
        * en caso de no existir cambio, no se verifica si ya existe y sólo se cambian sus datos
        */
        if($correoActual == $email){
        $SQLEditarGarzon = "UPDATE garzon SET RUT_GARZON='".$rut."', NOMBRE1_GARZON='".$nombre1."', NOMBRE2_GARZON='".$nombre2."', APELLIDO1_GARZON='".$apellido1."', APELLIDO2_GARZON='".$apellido2."', esCHEF=".$esCHEF." WHERE ID_CLIENTE=".$id_cliente." AND ID_LOCAL=".$id_local." AND ID_GARZON=".$id_garzon.";";
        $editarGarzon = mysql_query($SQLEditarGarzon) or die ("error".$SQLEditarGarzon);
        if($editarGarzon){
            echo 2;
            return;       
        }
        }else{ 
        $SQLComprobarEmail = "SELECT CORREO_GARZON FROM garzon;";        
        $datosCorreos = mysql_query($SQLComprobarEmail) or die ("1");
        while ($data = mysql_fetch_array($datosCorreos))
        {   
            $str = strtolower($data['CORREO_GARZON']);
            if ( $str == $email) 
            {
                echo 3;
                return;
            }
        }
            //El correo no existe, y modifican todos los datos, incluyendoe el correo
        $SQLEditarGarzon = "UPDATE garzon SET RUT_GARZON='".$rut."', NOMBRE1_GARZON='".$nombre1."', NOMBRE2_GARZON='".$nombre2."', APELLIDO1_GARZON='".$apellido1."', APELLIDO2_GARZON='".$apellido2."', CORREO_GARZON='".$email."', esCHEF=".$esCHEF." WHERE ID_CLIENTE=".$id_cliente." AND ID_LOCAL=".$id_local." AND ID_GARZON=".$id_garzon.";";
        $editarGarzon = mysql_query($SQLEditarGarzon) or die ("error".$SQLEditarGarzon);
        if($editarGarzon){
            echo 2;
            return;       
        }
       
       }
       
       
        //*****************************************************
    }else{
           header("Location: ../plantillas/errorPrivilegios.html");
       }
       ?>

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
        $esChef = $_POST['esChef'];
        //Capturar datos de session
        $id_local = $_SESSION['ID_LOCAL'];
        $id_cliente = $_SESSION['ID_CLIENTE'];
        $yaExiste = 'existe';

        $email = strtolower($correo);
        //*****************************************************
            //Query SQL
            //Verificamos si el correo ya está registrado.
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
                   //El correo no existe, y se crea el ingreso del usuario Garzon.
        $SQLIngresarGarzon = "INSERT INTO garzon VALUES (0, ".$id_cliente.", ".$id_local.", '".$rut."', '".$nombre1."', '".$nombre2."', '".$apellido1."', '".$apellido2."', '".$email."', '".$pass."', ".$esChef.");";
        $ingresarGarzon = mysql_query($SQLIngresarGarzon) or die ("error".$SQLIngresarGarzon);
        if($ingresarGarzon){
            echo 2;
            return;       
        }
        //*****************************************************
    }else{
           header("Location: ../plantillas/errorPrivilegios.html");
       }
       ?>

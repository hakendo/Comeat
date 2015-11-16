<?php
	//Controlar acceso a la aplicación!
	//Consultar a la BD por el nombre de usuario y password:
	
    require'../PDO/conexion.php';
    $objConnect = new Conexion();

    $objConnect->connect();
   
    //Capturar datos de form.
    $correo_recibido = $_POST["correo"];
    $correo =	strtolower($correo_recibido);
    $password = $_POST["password"];
    //************************************

	//	CONSULTA PARA VERIFICAR CUENTA Y TIPO DE CUENTA (ADMIN).
	$consulta = "SELECT * FROM cliente WHERE CORREO_CLIENTE ='".$correo."';";
	

	//Obtener datos personal de la persona quiere ingresar:

	$ejecutar_consulta = mysql_query($consulta) or die ("No se ha podido realizar la consulta en la BD");


	//VERIFICO SI EL USUARIO ESTA REGISTRADO:
	$valor = 0;

	if (mysql_num_rows($ejecutar_consulta) == 0)
	{ 	//El correo no está registrado
			$valor = 0;
			$objConnect->closeConect();
    }else{	

	while ($registro = mysql_fetch_array($ejecutar_consulta)) {

		$correo_desdeBD = $registro["CORREO_CLIENTE"];
		$correo_min = strtolower($correo_desdeBD);
			
		if ($correo == $correo_min && $password == $registro["CLAVE_CLIENTE"] && $registro["ID_PLAN"] == 1) {
			//Inicio administrador ORO
			//INICIO LA SESION.
			session_start();
			//Declaro mis variables de sesion.
			$_SESSION["AUTENTIFICADO"]=true;
			$_SESSION["PRIVILEGIO"]=1;
			$_SESSION["NOMBRE"]= $registro["NOMBRE1_CLIENTE"];
			$_SESSION["APELLIDO1"]= $registro["APELLIDO1_CLIENTE"];
			$_SESSION["APELLIDO2"]= $registro["APELLIDO2_CLIENTE"];
			$_SESSION["ID_CLIENTE"]= $registro["ID_CLIENTE"];
			$_SESSION["esACTIVADO"]= $registro["esACTIVADO"];
			$_SESSION["CORREO"]= $correo;
			

			$valor = 1;
			$objConnect->closeConect();
			

		}

		if($correo == $correo_min && $password == $registro["CLAVE_CLIENTE"] && $registro["ID_PLAN"] == 2)
		{	
			//Inicio administrador PLATA
			//INICIO LA SESION.
			session_start();
			//Declaro mis variables de sesion.
			$_SESSION["AUTENTIFICADO"]=true;
			$_SESSION["PRIVILEGIO"]=2;
			$_SESSION["NOMBRE"]= $registro["NOMBRE1_CLIENTE"];
			$_SESSION["APELLIDO1"]= $registro["APELLIDO1_CLIENTE"];
			$_SESSION["APELLIDO2"]= $registro["APELLIDO2_CLIENTE"];
			$_SESSION["ID_CLIENTE"]= $registro["ID_CLIENTE"];
			$_SESSION["esACTIVADO"]= $registro["esACTIVADO"];
			$_SESSION["CORREO"]= $correo;
			

			$valor = 2;
			$objConnect->closeConect();
			

		}

		if($correo == $correo_min && $password == $registro["CLAVE_CLIENTE"] && $registro["ID_PLAN"] == 3)
		{
			//Inicio administrador BRONCE
			//INICIO LA SESION.
			session_start();
			//Declaro mis variables de sesion.
			$_SESSION["AUTENTIFICADO"]=true;
			$_SESSION["PRIVILEGIO"]=3;
			$_SESSION["NOMBRE"]= $registro["NOMBRE1_CLIENTE"];
			$_SESSION["APELLIDO1"]= $registro["APELLIDO1_CLIENTE"];
			$_SESSION["APELLIDO2"]= $registro["APELLIDO2_CLIENTE"];
			$_SESSION["ID_CLIENTE"]= $registro["ID_CLIENTE"];
			$_SESSION["esACTIVADO"]= $registro["esACTIVADO"];
			$_SESSION["CORREO"]= $correo;
			
			$valor = 3;
			$objConnect->closeConect();
		
		}
		
		if( $correo == $correo_min && $password !== $registro["CLAVE_CLIENTE"] ){
			$valor = 4;
			$objConnect->closeConect();
		}
					
		}
		}
	
		echo $valor;
			

?>
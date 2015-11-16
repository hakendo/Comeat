<?php
 	session_start();
 	if($_SESSION["PRIVILEGIO"] !== 9){
    header("Location: ../plantillas/errorPrivilegios.html");
  	}else{
     $idcliente = $_SESSION["idCliente"];
      $ID = $_SESSION["ID"];
      $ID_CLIENTE = $_SESSION["idCliente"];
     require'../PDO/conexion.php';
     $objConnect = new Conexion();
     //Inicio de rescate de variables por medio de PHP.
     $objConnect->connect();
     $consulta = "SELECT * FROM cliente WHERE ID_CLIENTE =".$ID_CLIENTE.";";
     $ejecutar_consulta = mysql_query($consulta) or die ("No se ha podido realizar la consulta en la BD".$consulta);               
     $row = mysql_fetch_array($ejecutar_consulta);               
     $objConnect->closeConect();
	}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="../css/normalize.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/comeat.css">
         <link rel="stylesheet" href="../css/iconmoon.css">        
        
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- INICIO HEADER MENU -->
        <header class="app-header">
            <div class="navbar app-navbar">
            <div class="container">
            <div class="navbar-brand imagenLogo"><a href="../index.html"><img  src="../img/Logotipo1.png" alt="Proyecto Comeat"></a></div>

              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#js-navbar-collapse">
                <span class="icon-bar app-icon"></span>
                <span class="icon-bar app-icon"></span>
                <span class="icon-bar app-icon"></span>
                </button>
              </div>
              <!-- app-active = pestaña actual -->
              <div class="collapse navbar-collapse" id="js-navbar-collapse">
                <ul class="nav navbar-nav  app-nav">
                  <li><a href="../index.html" class=" app-centrar">Inicio</a></li>

                  <li><a href="../nosotros.html" class="app-centrar">Nosotros</a></li>

                  <li><a href="../planes.html" class="app-centrar" >Planes</a></li>

                  <li class="app-navbar"><a href="../contacto.html" class="app-centrar" >Cont&aacute;ctenos</a></li>

                  <li><a href="../mapaComeat.html" class="app-centrar">Mapa</a></li>

                  <li><a href="../php/sesion-cuenta.php"class="app-centrar app-active">Social-Comeat</a></li>
                </ul>
              </div>
            </div>
            </div>
            </header>
            
        <!--  FIN HEADER MENU -->
        <!-- INICIO CONTENEDEOR EDITABLE -->

        

        <!-- FIN CONTAINER SALUDO -->
  <!-- INICIO CONTAINER SCREENSHOTS -->
  <div class="container-slide fondo">
    <div class="container app-contenedor-dos">
      <!-- INICIO NAVEGADOR PLAN  -->
      <div class="navbar menu app-header">
        <div class="container">
          <div class="navbar-brand imagenLogo">
            <img src="../img/logoAdmin.png" alt="Proyecto Comeat">
          </div>
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu">
            <span class="icon-bar app-icon"></span>
            <span class="icon-bar app-icon"></span>
            <span class="icon-bar app-icon"></span>
            </button>
          </div>
          <!-- app-active = pestaña actual -->
          <div class="collapse navbar-collapse" id="menu">
            <ul class="nav navbar-nav app-nav">
              <li><a href="loginAdmin.php" class=" app-centrar">Notificar</a></li>
              <li><a href="registrarAdmin.php" class="app-centrar">registrar</a></li>
              <li><a href="editarCliente.php" class="app-centrar app-active">Editar cliente</a></li>
              <li><a href="../mapaComeat.html" class="app-centrar">informes</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="../php/salir.php" class="app-centrar">Cerrar sesi&oacute;n</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- FIN NAVEGADOR PLAN  -->
      <!-- Titulo -->
      <div class="panel-header header">
	  <p>
	    <h3 class="app-font-style-titulo"> Editar a un cliente.</h3>
	  </p>
	</div>
	<div class="panel-body fondo-dos">
	  <div class="col-xs-12 col-md-6 fondo-dos">
	    <!-- INICIO REGISTRAR A UN NUEVO ADMIN -->
	    <form id="formularioRegistro" name="formularioRegistro">
	      <!-- Nombre1 -->
	      <div class="form-group">
	        <label for="asunto_form">Primer nombre:</label>
	        <input type="text" minlength="2" maxlength="30" class="form-control" id="nombre1Registro" name="nombre1Registro" placeholder="Ingrese su o sus nombres"  <?php echo "value='".$row['NOMBRE1_CLIENTE']."'" ?>required/>
	      </div>
	       <!-- Nombre1 -->
	      <div class="form-group">
	        <label for="asunto_form">Segundo nombre:</label>
	        <input type="text" minlength="2" maxlength="30" class="form-control" id="nombre2Registro" name="nombre2Registro" placeholder="Ingrese su o sus nombres" <?php echo "value='".$row['NOMBRE2_CLIENTE']."'" ?> required/>
	      </div>
	      <!-- Primer apellido -->
	      <div class="form-group">
	        <label for="asunto_form">Primer apellido:</label>
	        <input type="text" minlength="2" maxlength="30" class="form-control" id="primerApellidoRegistro" name="primerApellidoRegistro" placeholder="Ingrese su primer apellido (requerido)" <?php echo "value='".$row['APELLIDO1_CLIENTE']."'" ?>required/>
	      </div>
	      <!-- Segundo apellido -->
	      <div class="form-group">
	        <label for="asunto_form">Segundo apellido:</label>
	        <input type="text" minlength="2" maxlength="30" class="form-control" id="segundoApellidoRegistro" name="segundoApellidoRegistro" placeholder="Ingrese su segundo apellido" <?php echo "value='".$row['APELLIDO2_CLIENTE']."'" ?>/>
	      </div>
	      <!-- Correo electronico -->
	      <div class="form-group">
	        <label for="asunto_form">Correo electr&oacute;nico:</label>
	        <input type="email" minlength="6" maxlength="50" class="form-control" id="emailRegistro" name="emailRegistro" placeholder="ejemplo@dominio.cl" <?php echo "value='".$row['CORREO_CLIENTE']."'" ?> required/>
	      </div>    
	    </div>

	    <div class="col-xs-12 col-md-6 fondo-dos">
	      
	      <!-- Contraseña -->
	      <div class="form-group">
	        <label for="asunto_form">Contrase&ntilde;a:</label>
	        <input type="password" minlength="4" maxlength="50" class="form-control" id="pass" name="password" placeholder="contrase&ntilde;a" <?php echo "value='".$row['CLAVE_CLIENTE']."'" ?> required/>
	      </div>

	      <!-- Rut -->
	      <div class="form-group">
	        <label for="asunto_form">Rut:</label>
	        <input type="text" minlength="10" maxlength="12" class="form-control" id="rutRegistro" name="rutRegistro" placeholder="12345678-9" <?php echo "value='".$row['RUT_CLIENTE']."'" ?>/>
	      </div>
	      <!-- Telefono  -->
	      <div class="form-group">
	        <label for="asunto_form">Tel&eacute;fono:</label>
	        <input type="text" minlength="10" maxlength="12" class="form-control" id="telefonoRegistro" name="telefonoRegistro" placeholder="Tel&eacute;fono" <?php echo "value='".$row['TELEFONO_CLIENTE']."'" ?>/>
	      </div>


	      <!-- ID DE SESION -->
	      <div class="form-group">
	        <?php
	        echo "<input type=\"hidden\" class=\"form-control\" id=\"valorHidden\" name=\"valorHidden\" value=\" $ID\"/> "; 
	        ?>
	      </div>
	      <!-- FIN ID SESION -->

	      <!-- Privilegio del administrador (plan) -->
	      <div class="form-group">
	      <label for="asunto_form">Tipo de plan:</label>
	   
	        <div class="radio">
	          <label for="radios-0">
	            <input type="radio" name="tipoAdmin" id="radios-0" value="3" <?php 



              if($row['ID_PLAN']==3)
	            {
	            	echo "checked='checked'";
	            }else{

	            		}
	             ?>>
	            Plan Bronce
	          </label>
	        </div>
	        <div class="radio">
	          <label for="radios-1">
	            <input type="radio" name="tipoAdmin" id="radios-1" value="2" <?php if($row['ID_PLAN']==2)
	            {
	            	echo "checked='checked'";
	            }else{

	            		}
	             ?>>
	            Plan Plata
	          </label>
	        </div>
	        <div class="radio">
	          <label for="radios-2">
	            <input type="radio" name="tipoAdmin" id="radios-2" value="1" <?php if($row['ID_PLAN']==1)
	            {
	            	echo "checked='checked'";
	            }else{

	            		}
	             ?>>
	            Plan Oro
	          </label>
	        </div>
	      </div>

          <div class="checkbox">
            <label><input type="checkbox" id="esActivado" name="esActivado" value="1" <?php
            if($row['esACTIVADO'] == 1){
              echo "checked>Activado?</label>";
            }else{
              echo ">Activado?</label>";
            }
            ?> 
          </div>

     

	        <div class="col-xs-12 col-md-6 col-xs-push-5 col-md-push-4">
	      <input type="button" id="btnModificar" name="btnModificar" class="btn btn-warning" value="MODIFICAR"/>
	      </form>
	    </div>
	 </div> 

			<!-- fin -->

          
      </div>
      <div class="panel-footer">
          <p align="center">    
          </p>
      </div>
    </div>

        
    

        <!-- FIN CONTENEDOR EDITABLE -->
       <!-- Inicio footer fijo -->
        <div class="navbar app-navbar navbar">
          <div class="app-footer">
            <p>
               Copyright © 2015 Comeat | Diseñado por <span><a class="app-href app-link" href="#">Hakendo</a></span> | Equipo <span><a class="app-href app-link" href="../index.html">Comeat</a></span>
            </p>
          </div>
        </div>
       <!-- Fin footer fijo -->

        <!-- INICIO FOOTER FLOTANTE -->
        <div class="navbar app-navbar navbar-fixed-bottom app-lista-redsocial">
          <div class="app-footer-bot ">
            <ul class="app-lista-redsocial">
              <li>Siguenos en:
              <a href="https://www.facebook.com/ComeatCL" target="_blank" class="app-link-facebook">
              <span class="icon-facebook"></span></a></li>

              <li><a href="https://www.twitter.com/ComeatCL" target="_blank" class="app-link-twitter">
              <span class="icon-twitter"></span></a></li>

              <li><a href="https://www.youtube.com/channel/UCP8OAdelvoAKYs5ju3WJg_w" target="_blank" class="app-link-youtube">
              <span class="icon-youtube"></span></a></li>
            </ul>
          </div>
        </div>
       <!-- FIN FOOTER FLOTANTE -->


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
            <script src="../js/jquery/jquery.Rut.min.js"></script>
        <script>
                    var rut = $("#rutRegistro").val();
                   
                   $("#rutRegistro").Rut({
                     on_error: function(){ alert('El rut ingresado es incorrecto'); 
                     $("#btnModificar").addClass('disabled');
                 }

                    })
                    $("#rutRegistro").Rut({
                     on_success: function(){ 
                      $("#btnModificar").removeClass('disabled');
                   }
                    });
        </script>
           
        <script src="../js/jquery/editarCli.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
        <script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script></script>
       <script src="../js/bootstrap.min.js"></script>
        
    </body>
</html>
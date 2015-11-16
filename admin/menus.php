<?php
 session_start();
  if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3 ){
    
    $nombre = $_SESSION["NOMBRE"];
      $apellidoPaterno = $_SESSION["APELLIDO1"];
      $apellidoMaterno = $_SESSION["APELLIDO2"];
      $correo = $_SESSION["CORREO"];
      $id_cliente = $_SESSION["ID_CLIENTE"];
      //Datos de QUERY
      require'../PDO/conexion.php';
     $objConnect = new Conexion();
     //Inicio de rescate de variables por medio de PHP.
     $objConnect->connect();
     $consulta = "SELECT * FROM local WHERE ID_CLIENTE =".$id_cliente.";";
     $ejecutar_consulta = mysql_query($consulta) or die ("No se ha podido realizar la consulta en la BD".$consulta);
  }else{
    header("Location: ../plantillas/errorPrivilegios.html");
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
         <div class="navbar menu app-header" >
            <div class="container">
            <div class="navbar-brand imagenLogo"><a href="../index.html"><img 
            <?php
            if($_SESSION["PRIVILEGIO"] == 1){
              echo "src='../img/logoOro.png'";
            }else if($_SESSION["PRIVILEGIO"] == 2){
              echo "src='../img/logoPlata.png'";
            }else if($_SESSION["PRIVILEGIO"] == 3){
              echo "src='../img/logoBronce.png'";
            }
            ?>  alt="Proyecto Comeat"></a></div>

              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu">
                <span class="icon-bar app-icon"></span>
                <span class="icon-bar app-icon"></span>
                <span class="icon-bar app-icon"></span>
                </button>
              </div>
              <!-- app-active = pestaña actual -->
              <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav  app-nav">
                  <li><a href="../php/sesion-cuenta.php" class=" app-centrar ">Locales</a></li>

                  <li><a href="menus.php" class="app-centrar app-active">men&uacute;s</a></li>

                  <li><a href="../planes.html" class="app-centrar" >Garzones</a></li>
                  <?php
                    if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2){
                      echo "<li><a href='../mapaComeat.html' class='app-centrar'>informes</a></li>";
                    }

                    if($_SESSION["PRIVILEGIO"] == 1){
                      echo "<li><a href='../mapaComeat.html' class='app-centrar'>Informar</a></li>";
                    }

                  ?>
                  
                  <li><a href="../php/salir.php"class="app-centrar">[Cerrar sesi&oacute;n]</a></li>
                </ul>
              </div>
            </div>
            </div>
        <!-- FIN NAVEGADOR PLAN  -->
            <!-- Titulo -->
            <div class="panel-header header">
              <p>
                <h3 class="app-font-style-titulo"> Seleccione el local al cual desea editar su men&uacute;.</h3>
              </p>
            </div>
            <div class="panel-body fondo-dos">
              <div class="col-xs-12 fondo-dos">
              <h2>Locales:</h2>
              <select id="cmbLocales" name="cmbLocales" class="form-control">
              <option value="0">Seleccione...</option>
              <?php
               while ($row = mysql_fetch_array($ejecutar_consulta)) 
                  {
                      
                         echo '<option value="'.$row['ID_LOCAL'].'">'.$row['NOMBRE_LOCAL'].'</option>';        
                                 
                  }
                       $objConnect->closeConect();
                      
                  ?>
                </select>
                <br>
              <input type="button" id="btnSeleccionar" name="btnSeleccionar" class="btn btn-success" value="Seleccionar">
              
              </div>
            </div>
            <div class="panel-footer">
              
            </div>
          </div>
        </div>
        <!-- FIN CONTAINER SCREENSHOTS -->
        
    

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

           


        <script src="../js/jquery/menus.js"></script>


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
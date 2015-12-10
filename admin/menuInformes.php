  <?php
   session_start();
    if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3){
      if($_SESSION["esACTIVADO"] == 1)
      {
        $nombre = $_SESSION["NOMBRE"];
        $apellidoPaterno = $_SESSION["APELLIDO1"];
        $apellidoMaterno = $_SESSION["APELLIDO2"];
        $correo = $_SESSION["CORREO"];
        $id_cliente = $_SESSION["ID_CLIENTE"];
        $id_local = $_SESSION['ID_LOCAL'];
        $nombreLocal = $_SESSION["NOMBRE_LOCAL"];
        //Datos de QUERY
        require'../PDO/conexion.php';
       $objConnect = new Conexion();
       //Inicio de rescate de variables por medio de PHP.
       $objConnect->connect();
       //Verificamos el estado de la cuenta (sí o sí)
       $consultaEstado = "SELECT esACTIVADO from cliente WHERE ID_CLIENTE = ".$id_cliente.";";
       $query_Estado = mysql_query($consultaEstado) or die ("No se ha podido realizar la consulta en la BD".$consulta);
       $col = mysql_fetch_array($query_Estado);               
       if(!$col["esACTIVADO"] == 1){
            
            $_SESSION["esACTIVADO"] = 0;
             $objConnect->closeConect();
            session_destroy();
            header("Location: ../plantillas/errorPrivilegios.html");
           }
      //Fin verificación de estado.

       $consulta = "SELECT * FROM garzon WHERE ID_CLIENTE =".$id_cliente." AND ID_LOCAL=".$id_local.";";
       $ejecutar_consulta = mysql_query($consulta) or die ("No se ha podido realizar la consulta en la BD".$consulta);


     }else
     {
      header("Location: ../plantillas/tiempoFuera.html");
     }
    }else{
       session_destroy();
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
                    <li><a href="../php/sesion-cuenta.php" class=" app-centrar">Locales</a></li>

                    <li><a href="menus.php" class="app-centrar">men&uacute;s</a></li>

                    <li><a href="garzones.php" class="app-centrar" >Garzones</a></li>
                    <?php
                      if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2){
                        echo "<li><a href='informes.php' class='app-centrar  app-active'>informes</a></li>";
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
                  <h3 class="app-font-style-titulo"> Opciones de obtenci&oacute;n de informes:</p>
              </div>
              <div class="panel-body fondo-dos">
                <div class="col-xs-12 fondo-dos">
                <h2>Formato:</h2>
                <select id="cmbLocales" name="cmbLocales" class="form-control">
                  <option value="0">Formato...</option>
                  <option value="pdf">PDF</option>
                  <option value="excel">EXCEL</option>
                </select>
                  <div id="errorCMB" name="errorCMB" align="center" class="hidden col-xs-12">
                           <span class="label label-danger">Por favor seleccione el formato de obtenci&oacute;n de informe.</span>
                          </div>
                </div>
                
                <div class="clearfix"></div>
                <!--  Inicio de opciones para obtener informes -->
                <div class="panel panel-default">
                  <div class="header-menu"><h4><p class="app-font-style-titulo">Seleccione el tipo de informe que desea obtener del local: <?php echo $nombreLocal; ?></p></h4></div>
                  <div class="panel-body">
                    <!-- INICIO DE LAS OPCIONES LISTA -->
                    <!-- Primera fila -->
                    <!-- INICIO CONTENIDO1 -->
                    <div class="col-xs-12 col-md-4">
                      <div class="panel panel-warning">
                        <div class="panel-heading ">
                          <h3 class="panel-title"><p class="font-titulo-informe">Todos los garzones</p></h3>
                        </div>
                        <div class="panel-body">
                          <div align="center">
                            <button type="button" id="btnGetGarzones" name="btnGetGarzones" class="btn btn-warning">Obtener</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- FIN CONTENIDO1 -->
                     <!-- INICIO CONTENIDO2 -->
                    <div class="col-xs-12 col-md-4">
                      <div class="panel panel-warning">
                        <div class="panel-heading">
                          <h3 class="panel-title "><p class="font-titulo-informe">Men&uacute;s registrados<p></h3>
                        </div>
                        <div class="panel-body">
                          <div align="center">
                            <button type="button" id="btnGetMenu" name="btnGetMenu" class="btn btn-warning">Obtener</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- FIN CONTENIDO2 -->
                     <!-- INICIO CONTENIDO3 -->
                    <div class="col-xs-12 col-md-4">
                      <div class="panel panel-warning">
                        <div class="panel-heading">
                          <h3 class="panel-title"><p class="font-titulo-informe">INFORME 3<p></h3>
                        </div>
                        <div class="panel-body">
                          <div align="center">
                            <button type="button" class="btn btn-warning">Warning</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- FIN CONTENIDO3 -->
                    <div class="clearfix"></div>
                <!-- Fin primera fila -->

                <!-- Segunda Fila -->
                 <!-- INICIO CONTENIDO1 -->
                    <div class="col-xs-12 col-md-4">
                      <div class="panel panel-warning">
                        <div class="panel-heading">
                          <h3 class="panel-title"><p class="font-titulo-informe">INFORME 4<p></h3>
                        </div>
                        <div class="panel-body">
                          <div align="center">
                            <button type="button" class="btn btn-warning">Warning</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- FIN CONTENIDO1 -->
                     <!-- INICIO CONTENIDO2 -->
                    <div class="col-xs-12 col-md-4">
                      <div class="panel panel-warning">
                        <div class="panel-heading">
                          <h3 class="panel-title"><p class="font-titulo-informe">INFORME 5<p></h3>
                        </div>
                        <div class="panel-body">
                          <div align="center">
                            <button type="button" class="btn btn-warning">Warning</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- FIN CONTENIDO2 -->
                     <!-- INICIO CONTENIDO3 -->
                    <div class="col-xs-12 col-md-4">
                      <div class="panel panel-warning">
                        <div class="panel-heading">
                          <h3 class="panel-title"><p class="font-titulo-informe">INFORME 6<p></h3>
                        </div>
                        <div class="panel-body">
                          <div align="center">
                            <button type="button" class="btn btn-warning">Warning</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- FIN CONTENIDO3 -->
                <!-- Fin segunda fila -->

              </div>
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

                <li><a href="https://www.facebook.com/ComeatCL" target="_blank" class="app-link-twitter">
                <span class="icon-twitter"></span></a></li>

                <li><a href="https://www.facebook.com/ComeatCL" target="_blank" class="app-link-youtube">
                <span class="icon-youtube"></span></a></li>
              </ul>
            </div>
          </div>
         <!-- FIN FOOTER FLOTANTE -->


          <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
          <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

             


          <script src="../js/jquery/informes.js"></script>


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
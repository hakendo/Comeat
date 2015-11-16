<?php
session_start();
if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3)
{
  if($_SESSION["esACTIVADO"] == 1)
  {
      //Recopilación de información del usuario logeado.
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


  }else
  {
    header("Location: ../plantillas/tiempoFuera.html");
  }
}else
{
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
                    <div class="navbar-brand imagenLogo"><a href="../index.html"><img <?php
                      if($_SESSION["PRIVILEGIO"] == 1){
                       echo "src='../img/logoOro.png'";
                     }else if($_SESSION["PRIVILEGIO"] == 2){
                       echo "src='../img/logoPlata.png'";
                     }else if($_SESSION["PRIVILEGIO"] == 3){
                       echo "src='../img/logoBronce.png'";
                     }
                     ?>   alt="Proyecto Comeat"></a></div>

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
                        <li><a href="../php/sesion-cuenta.php" class=" app-centrar app-active">Locales</a></li>

                        <li><a href="menus.php" class="app-centrar">men&uacute;s</a></li>

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
                    <h3 class="app-font-style-titulo"> Usted est&aacute; agregando un nuevo Local.</h3>
                  </p>
                </div>
                <div class="panel-body fondo-dos">
                  <div class="col-xs-12 fondo-dos">
                    <!-- Columna 1 -->
                    <div class="col-xs-4">

                     <form id="formulario" name="formulario" method="post" action="../php/registrarLocal.php" enctype="multipart/form-data">

                      <!-- Nombre Local  -->
                      <div class="form-group">
                        <label for="asunto_form">Nombre de local:</label>
                        <input type="text" minlength="2" maxlength="30" class="form-control" id="nombreLocal" name="nombreLocal" placeholder="Ingrese el nombre de su local" required/>
                      </div>
                      <!-- Direccion Local  -->
                      <div class="form-group">
                        <label for="asunto_form">Direcci&oacute;n de local:</label>
                        <input type="text" minlength="2" maxlength="30" class="form-control" id="direccionLocal" name="direccionLocal" placeholder="Ingrese la direcci&oacute;n de su local" required/>
                      </div>
                      <!-- Razon social  -->
                      <div class="form-group">
                        <label for="asunto_form">Raz&oacute;n social:</label>
                        <input type="text" minlength="2" maxlength="30" class="form-control" id="razonLocal" name="razonLocal" placeholder="Raz&oacute;n social" required/>
                      </div>

                      <!-- REGION  -->
                      <div class="form-group">
                       <label for="asunto_form">Regi&oacute;n:</label>
                       <select id="region" name="region" class="form-control">
                         <option value="">Seleccione una regi&oacute;n</option>
                         <?php
                         
                           //Inicio de rescate de variables por medio de PHP.
                         $objConnect->connect();
                           //Verificamos el estado de la cuenta (sí o sí)
                         $queryRegion = "SELECT * from region;";
                         $datos_Region = mysql_query($queryRegion) or die ("No se ha podido realizar la consulta en la BD".$consulta);
                         while ($row = mysql_fetch_array($datos_Region)){
                          echo "<option value='".$row['ID_REGION']."'>".$row['NOMBRE_REGION']."</option>";
                        } 
                        $objConnect->closeConect();

                        ?>
                      </select>
                    </div>
                  </div>
                  <!-- Columna 2 -->
                  <div class="col-xs-4">
                    <!-- COMUNA  -->
                    <div class="form-group">
                     <label for="asunto_form">Comuna:</label>
                     <select id="comuna" name="comuna" class="form-control">
                       <option value="">Selecciona una comuna</option>
                       
                     </select>
                   </div>
                   <!-- Telefono Local  -->
                   <div class="form-group">
                    <label for="asunto_form">Tel&eacute;fono de local:</label>
                    <input type="text"  maxlength="13" class="form-control" id="telefonoLocal" name="telefonoLocal" placeholder="N&uacute;mero telef&oacute;nico" />
                  </div>
                  <!-- Latitud  -->
                  <div class="form-group">
                    <label for="asunto_form">Latitud:</label>
                    <input type="text" min="5" minlength="2" maxlength="60" class="form-control" id="latitudLocal" name="latitudLocal" placeholder="Latitud" required/>
                  </div>
                  <!-- Longitud  -->
                  <div class="form-group">
                    <label for="asunto_form">Longitud:</label>
                    <input type="text"  min="5" maxlength="60" class="form-control" id="longitudLocal" name="longitudLocal" placeholder="Longitud" required/>
                  </div>
                  <!-- Imagen --> 

                  <div class="form-group">
                   <label for="asunto_form">Imagen:</label>                                       
                   <input id="imagen" name="imagen" class="input-file" type="file">
                 </div>

               </div>
               <!-- Columna 3 -->
               <div class="col-xs-4">

                 <!-- Categoria  -->
                 <div class="form-group">
                   <label for="asunto_form">Categor&iacute;a:</label>
                   <select id="categoria" name="categoria" class="form-control">
                     <option value="restaurante">Restaurante</option>
                     <option value="bar">Bar</option>
                     <option value="cafeteria">Cafetería</option>
                   </select>
                 </div>
                 <!-- Email local  -->
                 <div class="form-group">
                  <label for="asunto_form">Email:</label>
                  <input type="email" minlength="6" maxlength="60" class="form-control" id="emailLocal" name="emailLocal" placeholder="ejemplo@dominio.cl" />
                </div>
                <!-- WebwebLocal local  -->
                <div class="form-group">
                  <label for="asunto_form">Web:</label>
                  <input type="text" minlength="6" maxlength="60" class="form-control" id="webLocal" name="webLocal" placeholder="www.ejemplo.cl" />
                </div>


                <!-- ID LOCAL -->
                <div class="form-group">
                 <input type="hidden" class="form-control" id="idLocal" name="idLocal" value="0" required/>
               </div>
               <!-- ID CLIENTE -->
               <div class="form-group">
                 <input type="hidden" class="form-control" id="idCliente" name="idCliente" <?php
                 echo "value='".$id_cliente."'";
                 ?> required/>
               </div>

               <div class="form-group">
                <input type="submit" id="btnAgregarLocal" name="btnAgregarLocal" class="btn btn-success" value="Agregar nuevo local"> 
              </div>  

            </form> 


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

        <script src="../js/jquery/locales.js"></script>


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
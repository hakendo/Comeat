<?php
session_start();
if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3)
{
  if($_SESSION["esACTIVADO"] == 1)
  {
      //Recopilación de información del usuario logeado.

    $correo = $_SESSION["CORREO"];
    $id_cliente = $_SESSION["ID_CLIENTE"];
    $id_categoria_menu = $_SESSION["ID_CATEGORIA_MENU"];
    $id_local = $_SESSION["ID_LOCAL"];
    $id_menu = $_SESSION["ID_MENU"];
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

    //Se obtienen los datos del menu seleccionado, para lueog ser mostrados en el form.
    $objConnect->connect();
    $consultaMenu = "SELECT * FROM menu WHERE ID_MENU=".$id_menu.";";
    $queryMenu = mysql_query($consultaMenu) or die ("No se ha podido realizar la consulta en la BD".$consulta);
    $row = mysql_fetch_array($queryMenu); 
    $objConnect->closeConect();
    //Fin obtencion de datos.


    foreach($_SESSION as $key =>$valor)
    {
      echo "variable : $key Valor: $valor <br>";
    }

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
                        <li><a href="../php/sesion-cuenta.php" class=" app-centrar ">Locales</a></li>

                        <li><a href="menus.php" class="app-centrar app-active">men&uacute;s</a></li>

                        <li><a href="garzones.php" class="app-centrar" >Garzones</a></li>
                        <?php
                        if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2){
                          echo "<li><a href='informes.php' class='app-centrar'>informes</a></li>";
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
                    <h3 class="app-font-style-titulo"> Usted est&aacute; editando un Men&uacute;.</h3>
                  </p>
                </div>
                <div class="panel-body fondo-dos">
                  <div class="col-xs-12 fondo-dos">
                  <div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> Si usted NO desea realizar descuentos, por favor ingrese el valor 0 en la casilla "Descuento del men&uacute;"</div>
                    <!-- Columna 1 -->
                    <div class="col-xs-12 col-md-4">

                     <form id="formulario" name="formulario" enctype="multipart/form-data">

                      <!-- Nombre Menu  -->
                      <div class="form-group">
                        <label for="asunto_form">Nombre del men&uacute;:</label>
                        <input type="text" minlength="2" maxlength="50" class="form-control" id="nombreMenu" name="nombreMenu" placeholder="Ingrese el nombre del men&uacute;" required  <?php
                        echo "value='".$row['NOMBRE_MENU']."'";
                        ?> />
                        <input type="hidden" id="nombreMenuAntiguo" name="nombreMenuAntiguo" <?php
                        echo "value='".$row['NOMBRE_MENU']."'";
                        ?> >
                        <div id="errorNombre" name="errorNombre" class="hidden">
                         <span class="label label-danger">Por favor ingrese el nombre del menú correctamente</span>
                       </div>
                       <div id="errorDuplicado" name="errorDuplicado" class="hidden">
                         <span class="label label-danger">El nombre del men&uacute; no puede ser duplicado</span>
                       </div>
                     </div>
                     <!-- Precio menu  -->
                     <div class="form-group">
                      <label for="asunto_form">Precio del men&uacute;:</label>
                      <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="number" class="form-control"  placeholder="Ingrese el precio del men&uacute;" required id="precioMenu" name="precioMenu" <?php
                        echo "value='".$row['PRECIO_MENU']."'";
                        ?> >
                        <span class="input-group-addon">.00</span>
                      </div>
                      <div id="errorPrecio" name="errorPrecio" class="hidden">
                       <span class="label label-danger">Por favor ingrese el precio correctamente</span>
                     </div>
                   </div>


                 </div>
                 <!-- Columna 2 -->
                 <div class="col-xs-12 col-md-4">

                   <!-- Descuento  -->
                   <div class="form-group">
                    <label for="asunto_form">Descuento del men&uacute;</label>
                    
                    <div class="input-group">
                      <span class="input-group-addon">%</span>
                      <input type="number" max="100" class="form-control"  placeholder="Ingrese el porcentaje de descuento" required id="descuentoMenu" name="descuentoMenu"  <?php
                      echo "value='".$row['OFERTA_MENU']."'";
                      ?> >
                    </div>
                    <div id="errorDescuento" name="errorDescuento" class="hidden">
                     <span class="label label-danger">Por favor ingrese el descuento correctamente</span>
                   </div>
                 </div>

                 <!-- Imagen --> 

                 <div class="form-group">
                   <label for="asunto_form">Imagen:</label>                                       
                   <input id="imagen" name="imagen" class="input-file" required accept="image/*" type="file">
                   <div id="errorImagen" name="errorImagen" class="hidden">
                   <br>
                     <span class="label label-danger">Por favor seleccione una nueva imagen</span>
                   </div>                   
                 </div>
                 <div class="imagenEditar">
                  <img class="imagenEditar" id="imagen_bd" name="imagen_bd" <?php echo "src='".$row['URL_IMAGEN_MENU']."'" ?> alt="Imagen de menú"/>
                </div>
              </div>
              <!-- Columna 3 -->
              <div class="col-xs-12 col-md-4">

                <!-- Descripcion -->
                <div class=" form-group">
                  <label for="descripcion_form">Descripci&oacute;n</label>
                  <textarea  class="formulario-area" cols="1" rows="1" id="descripcionMenu"  maxlength="150" name="descripcionMenu" placeholder="Descripci&oacute;n del men&uacute;..."><?php
                    echo($row['DESCRIPCION_MENU']);
                    ?></textarea>
                    <div id="errorDescripcion" name="errorDescripcion" class="hidden">
                     <span class="label label-danger">Por favor ingrese la descripci&oacute;n correctamente</span>
                   </div>
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
                  
                  <input type="hidden" name="URLIMAGEN" id="URLIMAGEN" <?php
                   echo "value='".$row['URL_IMAGEN_MENU']."'";
                   ?> >
                 <div class="form-group">
                  <input type="button" id="btnEditarMenuEjecucion" name="btnEditarMenuEjecucion" class="btn btn-warning" value="Editar men&uacute;"> 
                </div>  

              </form> 
            </div>
          </div>
        </div>

        <div class="panel-footer">
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
          </div>
          <!-- FIN FOOTER FLOTANTE -->


          <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
          <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

          <script src="../js/jquery/gestionMenu.js"></script>
          <script src="../js/jquery.numeric.js"></script>

          <script type="text/javascript">

            $("#latitudLocal").numeric({ decimalPlaces: 20 });
            $("#longitudLocal").numeric({ decimalPlaces: 20 });
            $("#remove").click(
              function(e)
              {
                e.preventDefault();
                $(".numeric,.integer,.positive,.positive-integer,.decimal-2-places").removeNumeric();
              }
              );
          </script>

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
<?php
session_start();
if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3)
{
  if($_SESSION["esACTIVADO"] == 1)
  {
      //Recopilación de información del usuario logeado.

    $id_cliente = $_SESSION["ID_CLIENTE"];
    $id_local = $_SESSION['ID_LOCAL'];
    
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
    //Query para validar estado de categorias, en caso de no existir, se muestra un mensaje
    $consultaCantidad = "SELECT COUNT(NOMBRE_CATEGORIA_MENU) AS POSICION FROM categoria_menu WHERE ID_LOCAL=".$id_local." AND ID_CLIENTE=".$id_cliente.";";
    $query_Cantidad= mysql_query($consultaCantidad) or die ("No se ha podido realizar la consulta en la BD".$consulta);
    $row = mysql_fetch_array($query_Cantidad); 
    $cantidad = $row['POSICION'];
    if($cantidad == 0){
      echo"<input type='hidden' value='0' name='noExisteCategoria' id='noExisteCategoria'></input> ";
    }else{
       echo"<input type='hidden' value='".$cantidad."' name='noExisteCategoria' id='noExisteCategoria'></input> ";
    }


    //Query para ver el numero de menus ingresados.
    $consulta = "SELECT * FROM categoria_menu WHERE ID_LOCAL=".$id_local." AND ID_CLIENTE=".$id_cliente." ORDER BY ORDEN_CATEGORIA_MENU ASC;";
    $query_consulta= mysql_query($consulta) or die ("No se ha podido realizar la consulta en la BD".$consulta);
        

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
                    <h3 class="app-font-style-titulo"> Usted est&aacute; editando el orden de categor&iacute;as</h3>
                  </p>
                </div>
                <div class="panel-body fondo-dos">
                  <div class="col-xs-12 fondo-dos">

                  
                    <div class='col-xs-12 hidden' id="noIngresoCategoria" name="noIngresoCategoria">
                      <p><h3 class="app-font-style-titulo-dos">Usted no ha ingresado categor&iacute;as</h3></p>
                    </div>

                    <div id="alertaMensajeModificarCategoria" name="alertaMensajeModificarCategoria">
                      <div class="alert alert-warning" role="alert">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        Si duplica el valor de un orden, no se visualizará como usted lo desea (Procure mantener la estructura de valores desde el 1 al 8)
                      </div>
                    </div>

                      <form id='formulario' name='formulario'>
                      <!-- Se comienza a mostrar todos los datos de las categorias -->
                      <?php 
                      $ciclo = 0;
                      while($cat = mysql_fetch_array($query_consulta))
                      {
                        //Nombre de categoria
                        echo " <!-- Columna 1 -->
                    <div class='col-xs-12 col-md-4'>
                        
                      <div class='form-group'>
                        <label for='asunto_form'>Nombre de categoria:</label>
                        <input type='text' minlength='3' maxlength='30' disabled='true' class='form-control' id='categoriaMenu".$ciclo."' name='categoriaMenu' placeholder='Ingrese la categor&iacute;a de men&uacute;'  required value='".$cat['NOMBRE_CATEGORIA_MENU']."' >
                      ";
                      echo "<input type='hidden' id='idCliente".$ciclo."' name='idCliente' value='".$cat['ID_CLIENTE']."'>";
                      echo "<input type='hidden' id='idLocal".$ciclo."' name='idLocal' value='".$cat['ID_LOCAL']."'>";
                      echo "<input type='hidden' id='idCatMenu".$ciclo."' name='idCatMenu' value='".$cat['ID_CATEGORIA_MENU']."' >";
                      echo "</div>
                      </div>";

                        //Columna 2
                    echo "<div class='col-xs-12 col-md-4'>
                      <!-- Nombre Local  -->
                      <div class='form-group'>
                        <label for='sunto_form'>Orden de visualizaci&oacute;n:</label>
                        <input type='number' min='1' max='8' class='form-control'  id='orden_categoria".$ciclo."' name='orden_categoria' placeholder='Ingrese el n&uacute;mero de posici&oacute;n' required value='".$cat['ORDEN_CATEGORIA_MENU']."' >  <br>
                    
                      <div  id='okDiv".$ciclo."' name='okDiv".$ciclo."'>
                        <span class='label label-success'>Cambio realizado sin errores</span>
                      </div>
                      <div  id='errorDiv".$ciclo."' name='errorDiv".$ciclo."'>
                        <span class='label label-danger'>No se ha podido realizar el cambio</span>
                      </div>
                    
                      </div>
                    </div>";

                      echo " <!-- Columna 3 -->";
                      echo "<div class='col-xs-12 col-md-4'>
                      <form id='formulario' name='formulario' enctype='multipart/form-data'>
                        <br> 
                      </div>
                      <div class='clearfix'></div>
                    
                    ";
                    $ciclo++;
                      }
                      $objConnect->closeConect();
                      ?>

                                      <div class='form-group'>
                        <input type='button' id='btnModificarOrdenCategoriaSave' name='btnModificarOrdenCategoriaSave' class='btn btn-warning' value='Editar orden'> 

                        <br>
                        <br>
                        <a href="ordenCategorias.php" class='btn btn-success' >Actualizar vista de orden</a> 
                      </div>  
                      </form>
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
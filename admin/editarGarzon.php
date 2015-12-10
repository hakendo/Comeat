<?php
session_start();
if($_SESSION["PRIVILEGIO"] == 1 || $_SESSION["PRIVILEGIO"] == 2 || $_SESSION["PRIVILEGIO"] == 3)
{
  if($_SESSION["esACTIVADO"] == 1)
  {
      //Recopilación de información del usuario logeado.

    $correo = $_SESSION["CORREO"];
    $id_cliente = $_SESSION["ID_CLIENTE"];
    $id_garzon = $_SESSION["ID_GARZON"];
    $id_local = $_SESSION["ID_LOCAL"];

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
    $consultaMenu = "SELECT * FROM garzon WHERE ID_GARZON=".$id_garzon.";";
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

                        <li><a href="menus.php" class="app-centrar">men&uacute;s</a></li>

                        <li><a href="garzones.php" class="app-centrar app-active" >Garzones</a></li>
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
                  <div class="alert alert-info" role="alert"><span class="glyphicon glyphicon-info-sign"></span> La opci&oacute;n 'Es chef', determina el acceso a la visualizaci&oacute;n de los men&uacute;s para preparar (previamente confirmados por los garzones).</div>
                   <!-- Columna 1 -->
                    <div class="col-xs-12 col-md-4">

                     <form id="formulario" name="formulario" enctype="multipart/form-data">

                      <!-- Nombre1 Garzon -->
                      <div class="form-group">
                        <label for="asunto_form">Primer nombre:</label>
                        <input type="text" minlength="2" maxlength="50" class="form-control" id="nombreGarzon1" name="nombreGarzon1" placeholder="Ingrese el primer nombre del garz&oacute;n" required <?php
                        echo "value='".$row['NOMBRE1_GARZON']."'";
                        ?>/>
                        <div id="errorNombre1" name="errorNombre" class="hidden">
                         <span class="label label-danger">Por favor ingrese el primer nombre correctamente</span>
                        </div>
                      </div>

                       <!-- Nombre2 Garzon -->
                      <div class="form-group">
                        <label for="asunto_form">Segundo nombre:</label>
                        <input type="text" minlength="2" maxlength="50" class="form-control" id="nombreGarzon2" name="nombreGarzon2" placeholder="Ingrese el segundo nombre del garz&oacute;n" required <?php
                        echo "value='".$row['NOMBRE2_GARZON']."'";
                        ?>/>
                        <div id="errorNombre2" name="errorNombre2" class="hidden">
                         <span class="label label-danger">Por favor ingrese el segundo nombre correctamente</span>
                        </div>
                      </div>

                       <!-- Rut Garzon -->
                      <div class="form-group">
                        <label for="asunto_form">Rut:</label>
                        <input type="text" minlength="3" maxlength="12" class="form-control" id="rutGarzon" name="rutGarzon" placeholder="Ingrese el RUT del garz&oacute;n" required <?php
                        echo "value='".$row['RUT_GARZON']."'";
                        ?>/>
                        <div id="errorRut" name="errorRut" class="hidden">
                         <span class="label label-danger">El rut ingresado es incorrecto</span>
                        </div>
                      </div>
                 
                 </div>
                 <!-- Columna 2 -->
                 <div class="col-xs-12 col-md-4">

                  <!-- Apellido1 Garzon -->
                      <div class="form-group">
                        <label for="asunto_form">Primer apellido:</label>
                        <input type="text" minlength="2" maxlength="50" class="form-control" id="apellidoGarzon1" name="apellidoGarzon1" placeholder="Ingrese el primer apellido del garz&oacute;n" required <?php
                        echo "value='".$row['APELLIDO1_GARZON']."'";
                        ?>/>
                        <div id="errorApellido1" name="errorApellido1" class="hidden">
                         <span class="label label-danger">Por favor ingrese el primer apellido correctamente</span>
                        </div>
                      </div>

                   <!-- Apellido2 Garzon -->
                      <div class="form-group">
                        <label for="asunto_form">Segundo apellido:</label>
                        <input type="text" minlength="2" maxlength="50" class="form-control" id="apellidoGarzon2" name="apellidoGarzon2" placeholder="Ingrese el segundo apellido del garz&oacute;n" required <?php
                        echo "value='".$row['APELLIDO2_GARZON']."'";
                        ?>/>
                        <div id="errorApellido2" name="errorApellido2" class="hidden">
                         <span class="label label-danger">Por favor ingrese el segundo apellido correctamente</span>
                        </div>
                      </div>
                  
               </div>

               <!-- Columna 3 -->
               <div class="col-xs-12 col-md-4">
                
                 <!-- Correo Garzon -->
                      <div class="form-group">
                        <label for="asunto_form">Correo login:</label>
                        <input type="mail" minlength="6" maxlength="100" class="form-control" id="emailGarzon" name="emailGarzon" placeholder="Ingrese email de acceso" required <?php
                        echo "value='".$row['CORREO_GARZON']."'";
                        ?>/>
                        <div id="errorEmail" name="errorEmail" class="hidden">
                         <span class="label label-danger">Por favor ingrese el correo correctamente</span>
                        </div>
                      </div>
                   <!-- Password Garzon -->
                      <div class="form-group">
                        <label for="asunto_form">Contraseña:</label>
                        <input type="password" minlength="2" maxlength="50" class="form-control" id="passwordGarzon" name="passwordGarzon" placeholder="Ingrese el primer apellido del garz&oacute;n" required <?php
                        echo "value='".$row['CLAVE_GARZON']."'";
                        ?>/>
                        <div id="errorPassword" name="errorPassword" class="hidden">
                         <span class="label label-danger">Por favor ingrese la contraseña correctamente</span>
                        </div>
                      </div>
                      
                      <div class="checkbox">
                        <label><input type="checkbox" id="esChef" name="esChef" value="1" <?php
                        if($row['esCHEF'] == 1){
                          echo "checked>Es Chef</label>";
                        }else{
                          echo ">Es Chef</label>";
                        }
                        ?> 
                      </div>


                <div class="form-group">
                <input type="button" id="btnModificarGarzonEjecucion" name="btnModificarGarzonEjecucion" class="btn btn-warning" value="Editar garz&oacute;n"> 
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

          <script src="../js/jquery/garzones.js"></script>
          <script src="../js/jquery/jquery.Rut.min.js"></script>
        <script>
                    var rut = $("#rutRegistro").val();
                   
                   $("#rutGarzon").Rut({
                     on_error: function(){

                     $("#btnAgregarGarzonEjecucion").addClass('disabled');
                     $('#errorRut').removeClass('hidden');
                     $('#rutGarzon').focus();
                 }

                    })
                    $("#rutGarzon").Rut({
                     on_success: function(){ 
                      $("#btnAgregarGarzonEjecucion").removeClass('disabled');
                      $('#errorRut').addClass('hidden');
                   }
                    });
        </script>
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
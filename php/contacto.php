<?php
  
//Recepción de los datos

    $Nombre = $_POST['nombres']; // requerido

    $Apellidos = $_POST['apellidos']; // requerido

    $RazonSocial = $_POST['razon']; // requerido

    $Correo = $_POST['email']; // requerido

    $Telefono = $_POST['telefono']; // no requerido

    $Celular = $_POST['celular']; // no requerido

    $Asunto = $_POST['asunto'];

    $Texto = $_POST['mensaje']; // requerido
 
//Recepcion de datos por medio de AngularJS
   //para bd mysql $data = json_decode(file_get_contents("php://input"), true);


     //Fin de recepcion de datos
     $para = "contacto@comeat.cl";

      //Formulario

     $mensaje = '<html><body><p>FORMULARIO DE CONTACTO</p>';

     $mensaje .= '<table><tr><td align="right">Nombre:</td> <td>'. $Nombre .'</td></tr>';
     $mensaje .= '<tr><td align="right">Apellidos:</td> <td align="left">'.$Apellidos.'</td></tr>';
     $mensaje .= '<tr><td align="right">Raz&oacute;n social:</td> <td align="left">'.$RazonSocial.'</td></tr>';
     $mensaje .= '<tr><td align="right">Correo:</td> <td align="left">'.$Correo.'</td></tr>';
     $mensaje .= '<tr><td align="right">Telefono:</td> <td align="left">'.$Telefono.'</td></tr>';
     $mensaje .= '<tr><td align="right">Celular:</td> <td align="left">'.$Celular.'</td></tr>';
     $mensaje .= '<tr><td align="right">Asunto:</td> <td align="left">'.$Asunto.'</td></tr>';
     $mensaje .= '<tr><td align="right">MENSAJE:</td> <td align="left">'.$Texto.'</td></tr>';
     $mensaje .= '</table></body></html>';

    // Para enviar un correo HTML, debe establecerse la cabecera Content-type
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Cabeceras adicionales
    $cabeceras .= 'To: Moises <moises.cadima@comeat.cl>, Rodrigo <rodrguzman@gmail.com>, Contacto <contacto@comeat.cl>' . "\r\n";
    $cabeceras .= 'From: formularioContacto <formularioContacto@comeat.cl>' . "\r\n";
    $cabeceras .= 'Cc:' . "\r\n";
    $cabeceras .= 'Bcc: moises.cadima@gmail.com' . "\r\n";

    // Mail
    mail($para, $Asunto, $mensaje, $cabeceras);

    //Crees que harás algo bueno viendo el correo de contacto?
    //Idiota 
    
?>


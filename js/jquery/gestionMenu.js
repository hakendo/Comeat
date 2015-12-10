$(document).ready(function () { 
//Inicio
 
//Funciones para la gestion de menú, sus contenidos.
 //Editar Menú
 $('#btnEditarMenu').click(function(event) {
  	/*Se obtiene el dato de el combo box seleccionado
  	* pero antes se valida si se tiene seleccionado algo.
  	*/
  	var valorCMBCategoria = $('#cmbCategoria').val();
    var valorCMBMenu = $('#cmbMenu').val();
    if (valorCMBCategoria == 'seleccione')
    {
      alert('Por favor seleccione una categoría');
    }else{


      if(valorCMBMenu == 'seleccione'){
       alert('Por favor seleccione un menú existente \nSi no existe, por favor creelo con el botón "Agregar" ')
     }else{
        /*Se toma el valor de la variable cmb seleccionada, y se agrega a una 
        *variable sesion, para ser utilizada mas adelante
        */
        data = "idCategoria="

        var dataString = 'idCategoria='+ valorCMBCategoria + '&idMenu=' + valorCMBMenu;
        $.ajax({
          type:"POST",
          url: "../php/seleccionarCategoriaAndMenu.php",
          data: dataString,
          cache: false,
          success: function(result){
            window.location = '../admin/editarMenu.php';
          }

        });

      }
    }
  });

  //Agregar menú, redireccion a página
  $('#btnAgregarMenu').click(function(event) {
   /*Se obtiene la variable "Categoría de menú seleccionada"
    * para luego ser enviada a una variable sesion.
    */
    var valorCMBCategoria = $('#cmbCategoria').val();
    if (valorCMBCategoria == 'seleccione')
    {
      //No se ha seleccionado una categoria
      alert('Por favor seleccione una categoría, para agregar un nuevo menú');
    }else{
      //Se seleccionó una categoría.
      //Se ejecuta  ajax, enviando el valor de la variable categoria. $_SESSION["ID_CATEGORIA_MENU"]
      var dataString = 'idCategoria='+ valorCMBCategoria ;
      $.ajax({
        type:"POST",
        url: "../php/seleccionarCategoriaMenu.php",
        data: dataString,
        cache: false,
        success: function(result){
          window.location = '../admin/agregarMenu.php';
        }
      });
      
    }
  });
  //Agregar menú, ejecución de comando:
  $('#btnAgregarMenuEjecucion').click(function(event) {
    //Se ejecutan las validaciones del formulario anterior:
    //Se obtienen los largos de todas las variables, para luego validar
    var nombreMenuLargo = $('#nombreMenu').val().length;
    var precioMenuLargo = $('#precioMenu').val().length;
    var descuentoMenuLargo = $('#descuentoMenu').val().length;
    var descripcionMenuLargo = $('#descripcionMenu').val().length;

    $('#errorNombre').addClass('hidden');
    $('#errorPrecio').addClass('hidden');
    $('#errorDescuento').addClass('hidden');
    $('#errorDescripcion').addClass('hidden');

    var x = parseInt($('#precioMenu').val());
    var y = parseInt($('#descuentoMenu').val());
    if(nombreMenuLargo < 2 || nombreMenuLargo > 50){
      $('#errorNombre').removeClass('hidden');
      $('#nombreMenu').focus();
    }else
    if (precioMenuLargo == 0 ||  x < 0)
    {
      $('#errorPrecio').removeClass('hidden');
      $('#precioMenu').focus();

    }else
    if(y > 100 || y < 0 || descuentoMenuLargo == 0){
      $('#errorDescuento').removeClass('hidden');
      $('#descuentoMenu').focus();
    }else
    if(descripcionMenuLargo == 0 || descripcionMenuLargo > 150 || descripcionMenuLargo < 2){
      $('#errorDescripcion').removeClass('hidden');
      $('#descripcionMenu').focus();
    }else{
      //Si todos los datos estan correctos, ejecutamos ajax.

      var form = new FormData($('#formulario')[0]);
      $.ajax({
       url: '../php/agregarMenu.php',
       type: 'POST',
       cache: false,
       contentType: false,
       processData: false,
       data: form,                        
       success: function(result){
        console.log(result);
                  //Verificacion de imagen.
                  $("#errorImagen").addClass('hidden');
                  if (result == "imgError") {
                    $("#errorImagen").removeClass('hidden');
                  }else if (result == 1){
                    window.location = '../plantillas/yaExisteLocal.html'
                  }else if (result == 2){
                    window.location = '../plantillas/registroLocalCompleto.html';
                  }else if(result == 3){
                    //window.location = '../plantillas/errorRegistro2.html';
                  }


                }
              });
      //FIN DE AJAX
    }  
  });

  //Editar menú ejecución de comando:
  $('#btnEditarMenuEjecucion').click(function(event) {
    //Se ejecutan las validaciones del formulario anterior:
    //Se obtienen los largos de todas las variables, para luego validar
    var nombreMenuLargo = $('#nombreMenu').val().length;
    var precioMenuLargo = $('#precioMenu').val().length;
    var descuentoMenuLargo = $('#descuentoMenu').val().length;
    var descripcionMenuLargo = $('#descripcionMenu').val().length;


    $('#errorNombre').addClass('hidden');
    $('#errorPrecio').addClass('hidden');
    $('#errorDescuento').addClass('hidden');
    $('#errorDescripcion').addClass('hidden');
    $('#errorDuplicado').addClass('hidden');

    var x = parseInt($('#precioMenu').val());
    var y = parseInt($('#descuentoMenu').val());
    if(nombreMenuLargo < 2 || nombreMenuLargo > 50){
      $('#errorNombre').removeClass('hidden');
      $('#nombreMenu').focus();
    }else
    if (precioMenuLargo == 0 ||  x < 0)
    {
      $('#errorPrecio').removeClass('hidden');
      $('#precioMenu').focus();

    }else
    if(y > 100 || y < 0 || descuentoMenuLargo == 0){
      $('#errorDescuento').removeClass('hidden');
      $('#descuentoMenu').focus();
    }else
    if(descripcionMenuLargo == 0 || descripcionMenuLargo > 150 || descripcionMenuLargo < 2){
      $('#errorDescripcion').removeClass('hidden');
      $('#descripcionMenu').focus();
    }else{
      //Si todos los datos estan correctos, ejecutamos ajax.

      var form = new FormData($('#formulario')[0]);
      $.ajax({
       url: '../php/editarMenu.php',
       type: 'POST',
       cache: false,
       contentType: false,
       processData: false,
       data: form,                        
       success: function(result){
        console.log(result);
                  //Verificacion de imagen.
                  $('#errorDuplicado').addClass('hidden');
                  $("#errorImagen").addClass('hidden');
                  if (result == "imgError") {
                  $("#errorImagen").removeClass('hidden');
                  }else if(result == 'duplicado'){
                    $('#errorDuplicado').removeClass('hidden');
                  }else if (result == 1){
                    window.location = '../plantillas/yaExisteLocal.html'
                  }else if (result == 2){
                    window.location = '../plantillas/registroLocalCompleto.html';
                  }else if(result == 3){
                    //window.location = '../plantillas/errorRegistro2.html';
                  }


                }
              });
    }
      //FIN DE AJAX
    });



//Fin 
});
'use strict';

/**
 * @ngdoc function
 * @name comeatApp.controller:ContactoCtrl
 * @description
 * # ContactoCtrl
 * Controller of the comeatApp
 */
angular.module('comeatApp')
  .controller('ContactoCtrl', function($scope, $http) {


      $scope.enviarDatosFormulario = function(formularioContacto){
       var nombres = formularioContacto.nombres;
       var apellidos = formularioContacto.apellidos;
       var asunto = formularioContacto.asunto;
       var celular = formularioContacto.celular;
       var email = formularioContacto.email;
       var mensaje = formularioContacto.mensaje;
       var razon = formularioContacto.razon;
       var telefono = formularioContacto.telefono;
/*
       $http({method: 'POST',
    url: 'php/contacto.php',
    data: {"nombres": nombres, "apellidos": apellidos, "asunto": asunto, "celular": celular, "email": email,
    "mensaje": mensaje, "razon": razon, "telefono": telefono},
    headers: {'Content-Type': 'application/x-www-form-urlencoded'}});
       */

        $http.post("php/contacto.php",
        {"nombres": nombres,
         "apellidos": apellidos,
          "asunto": asunto,
           "celular": celular,
            "email": email,
             "mensaje": mensaje,
              "razon": razon,
               "telefono": telefono
        }).then(function(respuesta){
         console.log(respuesta);
       });

    };
  });

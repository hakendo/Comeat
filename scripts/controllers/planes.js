'use strict';

/**
 * @ngdoc function
 * @name comeatApp.controller:PlanesCtrl
 * @description
 * # PlanesCtrl
 * Controller of the comeatApp
 */
angular.module('comeatApp')
  .controller('PlanesCtrl', function ($scope) {


   //Texto de descripcion del equipo Comeat.
    $scope.introduccion = ('Comeat cuenta con distintos tipos de planes, dependiendo de las necesidades para cada cliente.');

    var opcion = $scope.opcion=[];
    var URLImagen = "images/";
    var titulos = ["Plan bronce", "Plan plata", "Plan Oro"];
    var imagenes = ["bronce.png", "plata.png", "oro.png"];
    var textos = ["$ xx1","$ xx2", "$ xx3"];

    $scope.addPics = function(i){
      opcion.push({
        url:URLImagen+imagenes[i],
        titulo: titulos[i],
        texto: textos[i]
      });
    };
    for (var i = 0; i < 3; i++) {
      $scope.addPics(i);
    }

  });


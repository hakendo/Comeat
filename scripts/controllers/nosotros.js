'use strict';

/**
 * @ngdoc function
 * @name comeatApp.controller:NosotrosCtrl
 * @description
 * # NosotrosCtrl
 * Controller of the comeatApp
 */
angular.module('comeatApp')
  .controller('NosotrosCtrl', function ($scope) {
    //Texto de descripcion del equipo Comeat.
    $scope.quienessomos = ('Somos un equipo de estudiantes que está cursando la carrera de Ingeniería en informática en la Universidad Tecnológica de Chile (Inacap)');

    var pictures = $scope.pictures=[];
    var URLImagen = "images/nosotros/";
    var titulos = ["Moises","Rodrigo","Yessica"];
    var imagenes = ["moises.jpg", "rodrigo.jpg", "yessica.jpg"];
    var textos = ["hola1", "hola2", "hola3"];

    $scope.addPics = function(i){
      pictures.push({
        url:URLImagen+imagenes[i],
        titulo: titulos[i],
        texto: textos[i]
      });
    };
    for (var i = 0; i < titulos.length; i++) {
      $scope.addPics(i);
    }

  });

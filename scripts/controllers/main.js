'use strict';

angular.module('comeatApp')
  .controller('MainCtrl', function ($scope) {
    //Slider principal
    var URLImagen = 'images/';
    $scope.setInterval=4000;

    $scope.slides = [
    {
    title: 'Menús dinámicos.',
    image: URLImagen+"fondo4.png",
    text:"Realice pedidos a través de su Smarthphone."
    },
     {
    title: 'Toma de pedidos más seguras.',
    image: URLImagen+"img2.jpg",
    text:"Usted Sabrá con seguridad lo que va a comprar, además del total a pagar."
    },
     {
    title: 'Solicite su pedido más rápido',
    image: URLImagen+"img3.jpg",
    text:" Sólo debe esperar la confirmación de un garzón."
    }
    ];

    //Slider información de comeat.
    var URLPantallazo = "images/pantallazo/";
    $scope.setIntervalScreen=3000;


    $scope.pantallazos =[
    {
      titulo: "Sé inteligente, sé COMEAT.1",
      image: URLPantallazo+"telefono.png",
      //Descripción para cada pantallazo.
      descripcion: "hola mundo"

    },
    {
      titulo: "Sé inteligente, sé COMEAT.2",
      image: URLPantallazo+"pantallazo2.png",
      descripcion: "hola mundo"



    },
    {
      titulo: "Sé inteligente, sé COMEAT.3",
      image: URLPantallazo+"telefono.png"


    }
    ];

  });

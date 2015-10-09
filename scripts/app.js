'use strict';

/**
 * @ngdoc overview
 * @name comeatApp
 * @description
 * # comeatApp
 *
 * Main module of the application.
 */
angular
  .module('comeatApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch',
    'ui.bootstrap'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl',
        controllerAs: 'main'
      })
      .when('/about', {
        templateUrl: 'views/about.html',
        controller: 'AboutCtrl',
        controllerAs: 'about'
      })
      .when('/nosotros', {
        templateUrl: 'views/nosotros.html',
        controller: 'NosotrosCtrl',
        controllerAs: 'nosotros'
      })
      .when('/planes', {
        templateUrl: 'views/planes.html',
        controller: 'PlanesCtrl',
        controllerAs: 'planes'
      })
      .when('/contacto', {
        templateUrl: 'views/contacto.html',
        controller: 'ContactoCtrl',
        controllerAs: 'contacto'
      })
      .when('/socialComeat', {
        templateUrl: 'views/socialcomeat.php',
        controller: 'SocialcomeatCtrl',
        controllerAs: 'socialComeat'
      })
      .when('/mapaComeat', {
        templateUrl: 'views/mapacomeat.html',
        controller: 'MapacomeatCtrl',
        controllerAs: 'mapaComeat'
      })
      .when('/error', {
        templateUrl: 'views/error.html',
        controller: 'ErrorCtrl',
        controllerAs: 'error'
      })
      .when('/login', {
        templateUrl: 'views/login.php',
        controller: 'LoginCtrl',
        controllerAs: 'login'
      })
      .otherwise({
        redirectTo: '/error'
      });
  });

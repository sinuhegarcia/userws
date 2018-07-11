var app = angular.module('crud',['ngRoute']);

  // Configuracion de las rutas y sus respectivas plantillas
  app.config(function($routeProvider) {
    $routeProvider
              .when('/', {
                  templateUrl : 'templates/home.html',
                  controller  : 'mainCtrl'
              })
              .when('/usuario', {
                  templateUrl : 'templates/usuario.html',
                  controller  : 'usuario'
              })
              .when('/info',{
                  templateUrl : 'templates/info.html',
                  controller  : 'info'
              })

            
      });

  // Controlador principal de nuestra pagina
  app.controller('mainCtrl', function($scope) {
         $scope.message = 'API REST Client Example';
         $scope.subtitle = "Ejemplo de consumo de un API Rest con AngularJS";
     });

  // Controlador de la entidad Usuario donde se incluiran cada una de sus funciones
  app.controller('usuario', function($scope,$http) {

   $scope.message = 'API REST Client Example';
   $scope.subtitle = "Gestion de Usuario";

   $scope.urlws = "http://localhost/userws/api/usuario";

   // Al cargar la pagina, ejecutamos la funcion get() para rellenar la tabla
      angular.element(document).ready(function () {
       $scope.get("");
       
      });

      // La funcion get() que hace la solicitud para obtener los datos
      $scope.get = function(id){
       // Si la Id esta en blanco, entonces la solicitud es general
       if(id=="") {
        $http.get($scope.urlws).then(function (response) {
            console.log(response);
            $scope.lista = response.data.data;
            Materialize.toast(response.data.statusMessage, 4000);
            
        }, function(response) {
         // Aqui va el codigo en caso de error
         console.log(response);
        });
    // Si la Id no esta en blanco, la solicitud se hace a un elemento especifico
       } else {
          $http.get($scope.urlws+"/" + id).then(function (response) {
            $scope.nuevo = response.data.data[0];
            Materialize.toast(response.data.statusMessage, 4000);
        }, function(response) {
         // Aqui va el codigo en caso de error
         console.log(response);
        });
       }
      }

      // La funcion post() que hace la solicitud para publicar un nuevo elemento
      $scope.post = function() {
       $http.post$scope.urlws, $scope.nuevo)
        .then(function (response){
               Materialize.toast(response.data.statusMessage, 4000);
               $scope.nuevo = null;
               $scope.get("");
           }, 
           function(response) {
            // Aqui va el codigo en caso de error
           });
      }

      // La funcion put() que hace la solicitud para modificar un elemento especifico
      $scope.put = function(id) {
   
       $http.put($scope.urlws + "/" + id, $scope.nuevo)
        .then(
         function (response){
               Materialize.toast(response.data.statusMessage, 4000);
               $scope.nuevo = null;
               $scope.get("");
           }, 
           function(response) {
            // Aqui va el codigo en caso de error
           });

      }

      // La funcion delete() que hace la solicitud para eliminar un elemeto especifico
      $scope.delete = function(id) {
       $http.delete($scope.urlws + "/" + id)
       .then(
           function (response){
             Materialize.toast(response.data.statusMessage, 4000);
             $scope.nuevo = null;
             $scope.get("");
           }, 
           function (response){
             // Aqui va el codigo en caso de error
           }
        );
      }

  });

  app.controller('info',function($scope){
    $scope.message = 'Info sobre Ejemplo API REST';
    $scope.subtitle = 'Ejemplo de consumo de un API REST con Angular JS';

  });
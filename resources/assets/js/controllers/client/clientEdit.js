angular.module('app.controllers')
    .controller('ClientEditController', ['$scope', '$location', '$routeParams', 'Client',
    function($scope, $location, $routeParams, Client) {
        // Primeiro id = Id do resource em client.js (client/:id)
        // Segundo id = Id da rota em app.js (:id/edit)
        $scope.client = Client.get({id: $routeParams.id});

        $scope.save = function() {
            if($scope.form.$valid) {
                Client.update({id: $routeParams.id}, $scope.client, function() {
                    $location.path('/clients');
                });
            }
        }
    }]);
angular.module('app.controllers')
    .controller('ClientRemoveController', ['$scope', '$location', '$routeParams', 'Client',
    function($scope, $location, $routeParams, Client) {
        // Primeiro id = Id do resource em client.js (client/:id)
        // Segundo id = Id da rota em app.js (:id/edit)
        $scope.client = Client.get({id: $routeParams.id});

        $scope.remove = function() {
            $scope.client.$delete().then(function() {
                $location.path('/clients');
            });
        }
    }]);
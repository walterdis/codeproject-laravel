angular.module('app.controllers')
    .controller('ClientShowController', ['$scope', 'Client', '$routeParams', function($scope, Client, $routeParams) {
        $scope.client = Client.get({id: $routeParams.id});
    }]);
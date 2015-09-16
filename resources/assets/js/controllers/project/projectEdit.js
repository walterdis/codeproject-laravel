angular.module('app.controllers')
    .controller('ProjectEditController', ['$scope', '$location', '$routeParams', 'Project', 'Client',
    function($scope, $location, $routeParams, Project, Client) {
        // Primeiro id = Id do resource em project.js (project/:id)
        // Segundo id = Id da rota em app.js (:id/edit)
        $scope.project = Project.get({id: $routeParams.id}, function(data) {
            $scope.project = data;
            $scope.project.client_id = $scope.project.client;
        });

        $scope.clients = Client.query();

        $scope.progress = [
            {value: 10},
            {value: 20},
            {value: 30},
            {value: 40},
            {value: 50},
            {value: 60},
            {value: 70},
            {value: 80},
            {value: 90},
            {value: 100}
        ];

        $scope.save = function() {
            if($scope.form.$valid) {
                Project.update({id: $routeParams.id}, $scope.project, function() {
                    $location.path('/projects');
                });
            }
        }
    }]);
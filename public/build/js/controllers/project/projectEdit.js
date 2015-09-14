angular.module('app.controllers')
    .controller('ProjectEditController', ['$scope', '$location', '$routeParams', 'Project', 'Client',
    function($scope, $location, $routeParams, Project, Client) {
        // Primeiro id = Id do resource em project.js (project/:id)
        // Segundo id = Id da rota em app.js (:id/edit)
        $scope.project = Project.get({id: $routeParams.id});
        $scope.clients = Client.query();

        $scope.project.client_id = {id: 2, name: 'fdfsd'};

        $scope.save = function() {
            if($scope.form.$valid) {
                Project.update({id: $scope.project.id}, $scope.project, function() {
                    $location.path('/projects');
                });
            }
        }
    }]);
angular.module('app.controllers')
    .controller('ProjectRemoveController', ['$scope', '$location', '$routeParams', 'Project',
    function($scope, $location, $routeParams, Project) {
        // Primeiro id = Id do resource em project.js (project/:id)
        // Segundo id = Id da rota em app.js (:id/edit)
        $scope.project = Project.get({id: $routeParams.id});

        $scope.remove = function() {
            $scope.project.$delete({id: $routeParams.id}).then(function() {
                $location.path('/projects');
            });
        }
    }]);
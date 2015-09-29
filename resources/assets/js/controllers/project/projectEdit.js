angular.module('app.controllers')
    .controller('ProjectEditController', ['$scope', '$location', '$cookies', '$routeParams', 'Project', 'Client',
    function($scope, $location, $cookies, $routeParams, Project, Client) {
        // Primeiro id = Id do resource em project.js (project/:id)
        // Segundo id = Id da rota em app.js (:id/edit)
        $scope.project = Project.get({id: $routeParams.id}, function(data) {
            console.log(data);
            $scope.project = data;
            Client.get({id: data.client}, function(data) {
                $scope.clientSelected = data;
            });
        });

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

        $scope.formatName = function(model) {
            if(model) {
                return model.name;
            }
            return '';
        };

        $scope.getClients = function(name) {
            return Client.query({
                search: name,
                searchFields: 'name:like'
            }).$promise;
        };

        $scope.selectClient = function(item) {
            $scope.project.client_id = item.client_id;
        };

        $scope.save = function() {
            if($scope.form.$valid) {
                $scope.project.owner_id = $cookies.getObject('user').id;
                Project.update({id: $routeParams.id}, $scope.project, function() {
                    $location.path('/projects');
                });
            }
        };

    }]);
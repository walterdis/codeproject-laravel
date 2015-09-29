angular.module('app.controllers')
    .controller('ProjectNewController', ['$scope', '$location', '$cookies', 'Project', 'Client', 'User', function($scope, $location, $cookies, Project, Client, User) {
        $scope.project = new Project();
        $scope.clients = Client.query();

        $scope.save = function() {
            if($scope.form.$valid) {
                $scope.project.owner_id = $cookies.getObject('user').id;

                $scope.project.$save().then(function() {
                    $location.path('/projects');
                });
            }
        };

        $scope.formatName = function(id) {
            if(id) {
                for(var i in $scope.clients) {
                    if($scope.clients[i].client_id == id) {
                        return $scope.clients[i].name;
                    }
                }
            }
            return '';
        };

        $scope.getClients = function(name) {
            return Client.query({
                search: name,
                searchFields: 'name:like'
            }).$promise;
        };

    }]);
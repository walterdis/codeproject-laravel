angular.module('app.controllers')
    .controller('NoteEditController', ['$scope', '$location', '$routeParams', 'Note',
    function($scope, $location, $routeParams, Note) {
        // Primeiro id = Id do resource em note.js (note/:id)
        // Segundo id = Id da rota em app.js (:id/edit)
        $scope.note = Note.get({id: $routeParams.id});

        $scope.save = function() {
            if($scope.form.$valid) {
                Note.update({id: $scope.note.id}, $scope.note, function() {
                    $location.path('/notes');
                });
            }
        }
    }]);
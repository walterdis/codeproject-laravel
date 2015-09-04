angular.module('app.controllers')
    .controller('NoteRemoveController', ['$scope', '$location', '$routeParams', 'Note',
    function($scope, $location, $routeParams, Note) {
        // Primeiro id = Id do resource em note.js (note/:id)
        // Segundo id = Id da rota em app.js (:id/edit)
        $scope.note = Note.get({id: $routeParams.id, idNote: $routeParams.idNote});

        $scope.remove = function() {
            $scope.note.$delete({id: $routeParams.id, idNote: $routeParams.idNote}).then(function() {
                $location.path('/project/'+$routeParams.id+'/notes');
            });
        }
    }]);
angular.module('app.controllers')
    .controller('NoteListController', ['$scope', 'Note', '$routeParams', function($scope, Note, $routeParams) {
        $scope.notes = Note.query({id: $routeParams.id});
        $scope.project_id = $routeParams.id;

        //Note.query({id: $routeParams.id}, function(e){console.log('s', e.data);})
    }]);
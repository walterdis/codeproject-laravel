angular.module('app.controllers')
    .controller('NoteNewController', ['$scope', '$location', 'Note', function($scope, $location, Note) {
        $scope.note = new Note();

        $scope.save = function() {
            if($scope.form.$valid) {
                $scope.note.$save().then(function() {
                    $location.path('/notes');
                });
            }
        }
    }]);
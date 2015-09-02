angular.module('app.services').service('Note', ['$resource', 'appConfig', function($resource, appConfig) {
    return $resource(appConfig.baseUrl + '/project/:id/note/:idNote', {id: '@id', idNote: '@idNote'}, {
        update: {
            method: 'PUT'
        }
    });
}]);
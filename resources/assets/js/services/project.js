angular.module('app.services')
    .service('Project', ['$resource', '$filter', '$httpParamSerializer', 'appConfig',
        function($resource, $filter, $httpParamSerializer, appConfig) {

            function transformData(data) {
                if(angular.isObject(data) && data.hasOwnProperty('due_date')) {
                    var o = angular.copy(data);
                    o.due_date = $filter('date')(data.due_date, 'yyyy-MM-dd');
                    return appConfig.utils.transformRequest(o);
                }
                return data;
            };

            return $resource(appConfig.baseUrl + '/project/:id', {id: '@id'}, {
                save: {
                    method: 'POST',
                    transformRequest: transformData
                },
                get: {
                    method: 'GET',
                    transformResponse: function(data, headers) {
                        var o = appConfig.utils.transformResponse(data, headers);
                        if(angular.isObject(o) && o.hasOwnProperty('due_date')) {
                            //new Date(o.due_date);
                            //var arrayDate = o.due_date.split('-'),
                             //   month = parseInt(arrayDate[1]) -1;
                            o.due_date = new Date(o.due_date);
                        }
                        return o;
                    }
                },

                update: {
                    method: 'PUT',
                    transformRequest: transformData
                }
            });
}]);
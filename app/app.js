"use strict";

var app = angular.module("tablaturi-bg", ['ngRoute', 'ngSanitize']);

app.config(['$routeProvider',
    function ($routeProvider) {
		
        $routeProvider
                .when('/home', {
                    templateUrl: 'app/views/partials/home.php'
                }).otherwise({
					templateUrl: 'app/views/partials/home.php'
				});
}]);

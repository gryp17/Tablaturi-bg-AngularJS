"use strict";

var layoutController = function($rootScope, $scope, $routeParams, $http) {
	console.log("layout controller");
};

layoutController.$inject = [
	"$rootScope",
	"$scope",
	"$routeParams",
	"$http"
];

app.controller("layoutController", layoutController);
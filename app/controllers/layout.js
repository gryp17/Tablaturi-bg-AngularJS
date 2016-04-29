"use strict";

var layoutController = function($rootScope, $scope, $routeParams, $http) {
	console.log("layout controller");
	
	$scope.currentYear = (new Date()).getFullYear();
	console.log($scope.currentYear);
	
};

layoutController.$inject = [
	"$rootScope",
	"$scope",
	"$routeParams",
	"$http"
];

app.controller("layoutController", layoutController);
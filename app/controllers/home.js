"use strict";

var homeController = function ($rootScope, $scope, $routeParams){
	console.log("home controller");
};

homeController.$inject = [
	"$rootScope",
    "$scope",
    "$routeParams",
];

app.controller("homeController", homeController);
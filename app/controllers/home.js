"use strict";

var homeController = function($rootScope, $scope, $routeParams, $http) {
	console.log("home controller");

	//get articles by date
	$http({
		method: 'POST',
		url: 'API/getArticlesByDate',
		data: {
			date: "2014-08-30",
			limit: 5,
			offset: 0
		}
	}).then(function(response) {
		console.log(response);
	});

	//get articles
	$http({
		method: 'POST',
		url: 'API/getArticles',
		data: {
			limit: 10,
			offset: 0
		}
	}).then(function(response) {
		console.log(response);
	});

};

homeController.$inject = [
	"$rootScope",
	"$scope",
	"$routeParams",
	"$http"
];

app.controller("homeController", homeController);
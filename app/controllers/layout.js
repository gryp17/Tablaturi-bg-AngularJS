"use strict";

app.controller("layoutController", function($rootScope, $scope, $routeParams, $timeout) {
	
	$scope.currentYear = (new Date()).getFullYear();
	
	//chrome ng-view hack
	$timeout(function (){
		$("#content-wrapper, .left-ads, .right-ads").css("visibility", "visible");
	}, 500);
	
});
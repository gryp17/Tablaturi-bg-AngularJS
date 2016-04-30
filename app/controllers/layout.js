"use strict";

app.controller("layoutController", function($scope, $timeout, TabService) {
	
	$scope.currentYear = (new Date()).getFullYear();
	
	//chrome ng-view hack
	$timeout(function (){
		$("#content-wrapper, .left-ads, .right-ads").css("visibility", "visible");
	}, 500);
	
	
	TabService.getTabsCount().success(function (result){
		if(result.error) {
			console.log(result.error);
		} else {
			$scope.stats = result.data;
		}	
	});
	
});
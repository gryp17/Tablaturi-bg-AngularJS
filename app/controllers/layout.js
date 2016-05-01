app.controller("layoutController", function($scope, $timeout, TabService) {
	
	$scope.currentYear = (new Date()).getFullYear();
	
	TabService.getTabsCount().success(function (result){
		if(result.error) {
			console.log(result.error);
		} else {
			$scope.stats = result.data;
		}	
	});
	
});
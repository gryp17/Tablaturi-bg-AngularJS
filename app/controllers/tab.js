app.controller('tabController', function ($scope, $routeParams, $location, $q, TabService, LoadingService) {
	$scope.limit = 6;
	$scope.offset = 0;
	
	if(angular.isUndefined($routeParams.id)){
		$location.path('/');
	} else {
		$scope.tabId = $routeParams.id;
	}
	
	$q.all([
		TabService.getTab($scope.tabId),
		//TODO: tab comments
		//TabService.getTabComments($scope.tabId, $scope.limit, $scope.offset),
		//TabService.getTotalTabComments($scope.tabId)
	]).then(function (results){
		$scope.tab = results[0].data.data;
		
		if($scope.tab === false){
			$location.path('/not-found');
		}
		
		LoadingService.doneLoading();
	});
	
});
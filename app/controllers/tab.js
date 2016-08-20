app.controller('tabController', function ($scope, $routeParams, $location, $q, TabService, TabCommentService, LoadingService) {
	$scope.limit = 6;
	$scope.offset = 0;
		
	$scope.tabId = $routeParams.id;
	
	$q.all([
		TabService.getTab($scope.tabId),
		TabCommentService.getTabComments($scope.tabId, $scope.limit, $scope.offset),
		TabCommentService.getTotalTabComments($scope.tabId)
	]).then(function (results){
		
		if(angular.isUndefined(results[0].data.data)){
			$location.path('/not-found');
		}else{
			$scope.tab = results[0].data.data;
		
			//tab comments
			$scope.tabComments = results[1].data.data;

			//total number of tab comments
			$scope.totalTabComments = results[2].data.data;

			LoadingService.doneLoading();
		}
		
	});
	
	/**
	 * Fetches the tab comments and renders them in the page
	 * @param {int} limit
	 * @param {int} offset
	 */
	$scope.getTabComments = function(limit, offset) {
		$q.all([
			TabCommentService.getTabComments($scope.tabId, $scope.limit, $scope.offset),
		TabCommentService.getTotalTabComments($scope.tabId)
		]).then(function (results){
			$scope.tabComments = results[0].data.data;
			$scope.totalTabComments = results[1].data.data;
		});
	};
	
});
app.controller('userTabsController', function ($rootScope, $scope, $routeParams, $q, TabService) {

	$scope.profileId = parseInt($routeParams.id);
	$scope.loggedInUser = $rootScope.loggedInUser;

	$scope.limit = 20;
	$scope.offset = 0;

	/**
	 * Returns the specified user tabs
	 * @param {int} limit
	 * @param {int} offset
	 */
	$scope.getUserTabs = function (limit, offset){
		$q.all([
			TabService.getTabsByUploader($routeParams.id, limit, offset),
			TabService.getTotalTabsByUploader($routeParams.id)
		]).then(function (result){
			$scope.userTabs = result[0].data.data;
			$scope.totalUserTabs = result[1].data.data;
		});
	};
	
	//get the first batch of tabs
	$scope.getUserTabs($scope.limit, $scope.offset);

});
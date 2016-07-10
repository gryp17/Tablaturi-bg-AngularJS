app.controller('userTabsController', function ($rootScope, $scope, $routeParams, $q, TabService, LoadingService) {

	$scope.getUserTabs = function (limit, offset){
		$q.all([
			TabService.getTabsByUploader($routeParams.id, limit, offset),
			TabService.getTotalTabsByUploader($routeParams.id)
		]).then(function (result){
			$scope.userTabs = result[0].data.data;
			$scope.totalUserTabs = result[1].data.data;
		});
	};

});
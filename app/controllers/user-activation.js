app.controller('userActivationController', function ($scope, $routeParams, $location, $q, UserActivationService, LoadingService) {
		
	UserActivationService.activateUser($routeParams.userId, $routeParams.hash).then(function (result){
		$scope.success = result.data.data
		LoadingService.doneLoading();
	});
		
});
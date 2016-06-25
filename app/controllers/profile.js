app.controller('profileController', function ($rootScope, $scope, $routeParams, $location, $q, UserService, LoadingService) {

	$scope.loggedInUser = $rootScope.loggedInUser;

	$q.all([
		UserService.getUser($routeParams.id),
	]).then(function (responses){

		if(angular.isDefined(responses[0].data.data)){
			$scope.userData = responses[0].data.data;
			console.log($scope.userData);
		}else{
			$location.path('/');
		}
		
		LoadingService.doneLoading();
	});

});
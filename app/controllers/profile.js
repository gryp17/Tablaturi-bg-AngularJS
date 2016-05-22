app.controller('profileController', function ($scope, $routeParams, $location, $q, UserService, LoadingService) {

	console.log("profile controller");

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
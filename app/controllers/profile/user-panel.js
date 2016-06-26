app.controller('userPanelController', function ($rootScope, $scope, $routeParams, $location, $q, UserService, UserCommentService, LoadingService) {

	$scope.limit = 6;
	$scope.offset = 0;
	$scope.loggedInUser = $rootScope.loggedInUser;

	$q.all([
		UserService.getUser($routeParams.id),
		UserCommentService.getUserComments($routeParams.id, $scope.limit, $scope.offset),
		UserCommentService.getTotalUserComments($routeParams.id),
		//TODO: load user tabs
		//TODO: load user favourites
	]).then(function (responses){

		if(angular.isDefined(responses[0].data.data)){
			$scope.userData = responses[0].data.data;
		}else{
			$location.path('/');
		}
		
		$scope.userComments = responses[1].data.data;
		$scope.totalUserComments = responses[2].data.data;
		
		LoadingService.doneLoading();
	});
	
	

});
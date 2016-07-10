app.controller('userPanelController', function ($rootScope, $scope, $routeParams, $location, $q, UserService, UserCommentService, TabService, LoadingService) {

	$scope.loggedInUser = $rootScope.loggedInUser;

	//user comments
	$scope.limit = 6;
	$scope.offset = 0;
	
	//user tabs
	$scope.userTabsLimit = 20;
	$scope.userTabsOffset = 0;

	$q.all([
		UserService.getUser($routeParams.id),
		UserCommentService.getUserComments($routeParams.id, $scope.limit, $scope.offset),
		UserCommentService.getTotalUserComments($routeParams.id),
		TabService.getTabsByUploader($routeParams.id, $scope.userTabsLimit, $scope.userTabsOffset),
		TabService.getTotalTabsByUploader($routeParams.id)
		//TODO: load user favourites
	]).then(function (responses){

		if(angular.isDefined(responses[0].data.data)){
			$scope.userData = responses[0].data.data;
		}else{
			$location.path('/');
		}
		
		$scope.userComments = responses[1].data.data;
		$scope.totalUserComments = responses[2].data.data;
		
		$scope.userTabs = responses[3].data.data;
		$scope.totalUserTabs = responses[4].data.data;
		
		LoadingService.doneLoading();
	});
	
});
app.controller('searchController', function ($scope, $routeParams, $location, LoadingService) {

	$scope.search = $routeParams;
	
	LoadingService.doneLoading();

});
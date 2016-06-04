app.controller('searchController', function ($scope, $routeParams, $q, TabService, LoadingService) {
	$scope.limit = 10;
	$scope.offset = 0;

	var searchType = $routeParams.type;
	var band = $routeParams.band || '';
	var song = $routeParams.song || '';
	
	//on full page reload - fill the searchParams inputs
	$scope.$parent.searchParams = angular.copy($routeParams);
	
	$q.all([
		TabService.search(searchType, band, song, $scope.limit, $scope.offset),
		TabService.getSearchTotal(searchType, band, song),
	]).then(function (responses){
		$scope.tabs = responses[0].data.data;
		$scope.totalResults = responses[1].data.data;
		LoadingService.doneLoading();
	});
	
	
	/**
	 * Callback function that is called when the page in the pagination changes
	 * @param {int} limit
	 * @param {int} offset
	 */
	$scope.search = function(limit, offset) {
		$q.all([
			TabService.search(searchType, band, song, limit, offset),
			TabService.getSearchTotal(searchType, band, song)
		]).then(function (responses){
			$scope.tabs = responses[0].data.data;
			$scope.totalResults = responses[1].data.data;
		});
	};	

});
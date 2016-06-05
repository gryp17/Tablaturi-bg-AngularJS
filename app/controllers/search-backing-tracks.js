app.controller('searchBackingTracksController', function ($scope, $routeParams, $q, BackingTrackService, LoadingService) {
	
	var band = $routeParams.band || '';
	var song = $routeParams.song || '';
	
	//on full page reload - fill the searchParams inputs
	$scope.$parent.searchParams = angular.copy($routeParams);
	
	BackingTrackService.search(band, song).then(function (response){
		console.log(response);
		LoadingService.doneLoading();
	});
	

});
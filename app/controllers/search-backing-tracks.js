app.controller('searchBackingTracksController', function ($scope, $routeParams, $window, BackingTrackService, LoadingService) {
	$scope.limit = 20;
	$scope.offset = 0;
	
	$scope.band = $routeParams.band || '';
	$scope.song = $routeParams.song || '';
	
	//on full page reload - fill the searchParams inputs
	$scope.$parent.searchParams = angular.copy($routeParams);
	
	BackingTrackService.search($scope.band, $scope.song).then(function (response){
		if(response.data.status === 1){
			$scope.allBackingTracks = response.data.data;
			$scope.totalResults = $scope.allBackingTracks.length;
			
			$scope.changePage($scope.limit, $scope.offset);
			
			LoadingService.doneLoading();
		}else{
			console.log(response.data);
		}
	});
	
	/**
	 * Callback function that is called when the pagination page changes
	 * @param {int} limit
	 * @param {int} offset
	 */
	$scope.changePage = function(limit, offset){
		var allTracks = angular.copy($scope.allBackingTracks);
		$scope.backingTracks = allTracks.splice(offset, limit);
	};
	
	/**
	 * Callback function that is called when the backing track title is clicked
	 * It gets the MP3 link for the backing track and opens it
	 * @param {string} link
	 */
	$scope.getMP3 = function (link){
		BackingTrackService.getMP3(link).then(function (response){
			//if the mp3 has been found download it
			if(response.data.status === 1){
				$window.open(response.data.data, "_self");
			}
			//otherwise redirect to the backing track page
			else{
				$window.open(link, "_blank");
			}
		});
	};
	

});
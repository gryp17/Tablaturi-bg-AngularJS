app.controller('userFavouritesController', function ($rootScope, $scope, $routeParams, $q, UserFavouriteService) {
	
	$scope.profileId = parseInt($routeParams.id);
	$scope.loggedInUser = $rootScope.loggedInUser;

	$scope.limit = 20;
	$scope.offset = 0;

	/**
	 * Returns the specified user favourite tabs
	 * @param {int} limit
	 * @param {int} offset
	 */
	$scope.getUserFavourites = function (limit, offset){
		$q.all([
			UserFavouriteService.getUserFavourites($routeParams.id, limit, offset),
			UserFavouriteService.getTotalUserFavourites($routeParams.id)
		]).then(function (result){
			$scope.userFavourites = result[0].data.data;
			$scope.totalUserFavourites = result[1].data.data;
		});
	};
	
	/**
	 * Deletes the specified user tab from the user favourites list
	 * @param {int} tabId
	 */
	$scope.deleteFavouriteTab = function (tabId){
		UserFavouriteService.deleteFavouriteTab(tabId).then(function (){
			//manually reduce the number of favourites
			$scope.totalUserFavourites--;
			
			//if the user has deleted the last tab on the page - reduce the offset by one page
			if($scope.offset >= $scope.totalUserFavourites){
				$scope.offset = $scope.offset - $scope.limit;
			}
			
			//reload the page
			$scope.getUserFavourites($scope.limit, $scope.offset);
		});
	};
	
	//get the first batch of tabs
	$scope.getUserFavourites($scope.limit, $scope.offset);

});
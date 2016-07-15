app.controller('layoutController', function($scope, $rootScope, $location, $route, $routeParams, TabService, UserService) {
	$scope.searchParams = {
		type: 'all'
	};
	
	$scope.currentYear = (new Date()).getFullYear();
	
	TabService.getTabsCount().success(function (result){
		if(result.error) {
			console.log(result.error);
		} else {
			$scope.stats = result.data;
		}	
	});
	
	/**
	 * Callback function that is called when the logout button is pressed.
	 * Unsets the loggedInUser and redirects to the home page
	 */
	$scope.logout = function (){
		UserService.logout().success(function (result){
			if(result.data){
				$rootScope.loggedInUser = undefined;
				$location.path('/');
			}
		});
	};
	
	/**
	 * Callback function that is called when the search button is pressed
	 * It redirects to the search page
	 */
	$scope.search = function (){
		var url = '/search/'; 
		var regexp = '\/search\/';
		var type = $scope.searchParams.type;
		var band = $scope.searchParams.band || '';
		var song = $scope.searchParams.song || '';
		
		if(band !== '' || song !== ''){
			//if the search type is bt (backing tracks) redirect to the backing tracks search page
			if(type === 'bt'){
				url = '/search-backing-tracks/';
				regexp = '\/search-backing-tracks\/';
			}

			regexp = new RegExp(regexp, "i");

			//if the current page is not the /search/ or /search-backing-tracks/ redirect to the correct page
			if(regexp.test($location.path()) === false){
				$location.path(url+type+'/'+band+'/'+song);
			}
			//otherwise just change the routeParams
			else{
				$route.updateParams({
					type: type,
					band: band,
					song: song
				});
			}
		}
	};
		
});
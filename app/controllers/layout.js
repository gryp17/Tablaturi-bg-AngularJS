app.controller("layoutController", function($scope, $rootScope, $location, TabService, UserService) {
	
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
				$location.path("/");
			}
		});
	};
	
	
});
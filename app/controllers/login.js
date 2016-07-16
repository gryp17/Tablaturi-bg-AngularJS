app.controller('loginController', function($scope, $rootScope, $window, $route, UserService, ValidationService) {
	$scope.loginData = {};
	
	/**
	 * Callback function that is called when the login button is pressed
	 */
	$scope.login = function (){
		UserService.login($scope.loginData).success(function (result){
			if(result.status === 0){
				if(result.error){
					//show the error
					ValidationService.showError(result.error.field, result.error.error_code);
				}
			}else{
				//$window.location.reload();
				$rootScope.loggedInUser = result.data;
				$('#login-modal').modal('hide');
				
				//if the user has logged in successfully and is on the "/forbidden" route redirect to the last route
				if($route.current && $route.current.$$route){
					if($route.current.$$route.originalPath === "/forbidden"){
						$window.history.back();
					}
				}
			}
		});
	};
	
});
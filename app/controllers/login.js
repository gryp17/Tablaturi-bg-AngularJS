app.controller('loginController', function($scope, $rootScope, $window, $route, $location, UserService, PasswordResetService, ValidationService) {
	$scope.loginData = {};
	$scope.view = 'login';
	
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
				
				if($route.current && $route.current.$$route){
					//if the user has logged in successfully and is on the "/forbidden" route redirect to the last route
					if($route.current.$$route.originalPath === '/forbidden'){
						$window.history.back();
					}
					//if the user is on the "/change-password" page redirect to the home page
					else{
						if($route.current.$$route.originalPath === '/change-password/:userId/:hash'){
							$location.path('/home');
						}
					}
				}
			}
		});
	};
	
	/**
	 * Changes the current visible view
	 * @param {string} view
	 */
	$scope.changeView = function(view) {
		$scope.view = view;
	};
	
	/**
	 * Resets the user password
	 */
	$scope.sendPasswordResetRequest = function() {		
		PasswordResetService.sendPasswordResetRequest($scope.forgottenPasswordEmail).then(function(result) {
			if(result.data.status === 0){
				if(result.data.error){
					//show the error
					ValidationService.showError(result.data.error.field, result.data.error.error_code);
				}
			}else{
				$scope.changeView('request-sent-success');
			}
		});
	};
	
	/**
	 * Before opening the modal reset the visible view and the forgotten password input
	 */
	$('#login-modal').on('show.bs.modal', function() {
		$scope.view = 'login';
		$scope.forgottenPasswordEmail = '';
		$scope.$apply();
	});
	
});
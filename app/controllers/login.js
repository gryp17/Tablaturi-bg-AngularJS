app.controller('loginController', function($scope, $rootScope, $window, $route, UserService, ValidationService) {
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
				
				//if the user has logged in successfully and is on the "/forbidden" route redirect to the last route
				if($route.current && $route.current.$$route){
					if($route.current.$$route.originalPath === "/forbidden"){
						$window.history.back();
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
	$scope.resetPassword = function() {		
		UserService.resetPassword($scope.forgottenPasswordEmail).then(function(result) {
			if(result.data.status === 0){
				if(result.data.error){
					//show the error
					ValidationService.showError(result.data.error.field, result.data.error.error_code);
				}
			}else{
				$scope.changeView('reset-password-success');
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
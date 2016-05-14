app.controller('loginController', function($scope, $rootScope, $window, UserService, ValidationService) {
	$scope.loginData = {};
	
	$scope.handleKeyPress = function ($event){
		if ($event.which === 13){
			$scope.login();
		}
	};
	
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
			}
		});
	};
	
});
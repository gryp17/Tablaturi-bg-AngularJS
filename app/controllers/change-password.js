app.controller('changePasswordController', function ($scope, $routeParams, PasswordResetService, UserService, ValidationService, LoadingService) {
	$scope.success = false;
	$scope.formData = {
		user_id: $routeParams.userId,
		hash: $routeParams.hash
	};
	
	/**
	 * Check if the userId/token combination is valid and hasn't expired
	 */
	PasswordResetService.checkPasswordResetHash($routeParams.userId, $routeParams.hash).then(function (result){
		if(result.data.status === 1){
			$scope.validToken = true;
		}
		//invalid or expired token
		else{
			$scope.validToken = false;
		}
		
		LoadingService.doneLoading();
	});
	
	/**
	 * Changes the user password
	 */
	$scope.changePassword = function () {
		UserService.updatePassword($scope.formData).then(function (result){
			if (result.data.status === 0) {
				if (result.data.error) {
					//intercept hash errors and directly show the invalid token screen
					if(result.data.error.field === 'hash'){
						$scope.validToken = false;
					}else{
						//show the error
						ValidationService.showError(result.data.error.field, result.data.error.error_code);
					}
				}
			} else {
				//show the change password success message
				$scope.success = true;
			}
		});
	};	
	
});
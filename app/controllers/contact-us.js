app.controller('contactusController', function($scope, MiscService, UserService, ValidationService) {
	
	$scope.formData = {};
	
	$scope.sendEmailSuccess = false;

	/**
	 * Generates new captcha image
	 */
	$scope.generateCaptcha = function() {
		MiscService.generateCaptcha().success(function(result) {
			$scope.captchaImage = result.data;
		});
	};
	
	/**
	 * Generate new captcha when signup modal closes
	 */
	$('#signup-modal').on('hide.bs.modal', function() {
		$scope.generateCaptcha();
	});
	
	$scope.generateCaptcha();
	
	/**
	 * Sends the message to the backend
	 */
	$scope.sendEmail = function(){
		MiscService.contactUs($scope.formData).success(function (result){
			if (result.status === 0) {
				if (result.error) {
					//show the error
					ValidationService.showError(result.error.field, result.error.error_code);
				}
			} else {
				$scope.sendEmailSuccess = true;
			}
		});
	};
	

});
app.controller('signupController', function($scope, UserService, MiscService, ValidationService) {
	$scope.userData = {
		signup_gender: 'M'
	};

	$scope.signupSuccess = false;

	/**
	 * Generates new captcha image
	 */
	$scope.generateCaptcha = function() {
		MiscService.generateCaptcha().success(function(result) {
			$scope.captchaImage = result.data;
		});
	};

	/**
	 * Sends all the userData to the backend
	 */
	$scope.signup = function() {
		UserService.signup($scope.userData).success(function(result) {
			if (result.status === 0) {
				if (result.error) {
					//show the error
					ValidationService.showError(result.error.field, result.error.error_code);
				}
			} else {
				$scope.signupSuccess = true;
			}
		});
	};

	/**
	 * Resets the form
	 * @returns {undefined}
	 */
	$scope.resetForm = function() {
		$scope.userData = {
			signup_gender: 'M'
		};
		
		$scope.signupSuccess = false;
		
		$('#signup-modal .field-box').removeClass('error');
		$('#signup-modal .error-msg').html('');
	};
	
	/**
	 * On modal close reset the form
	 */
	$('#signup-modal').on('hidden.bs.modal', function (){
		$scope.resetForm();
		$scope.$apply();
	});
	
	/**
	 * Generate new captcha when signup modal shows
	 */	
	$('#signup-modal').on('shown.bs.modal', function() {
		$scope.generateCaptcha();
	});

	$('#signup-datepicker').datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1940:' + new Date().getFullYear(),
		maxDate: '-1D',
		monthNamesShort: ['Януари', 'Февруари', 'Март', 'Април', 'Май', 'Юни', 'Юли', 'Август', 'Септември', 'Октомври', 'Ноември', 'Декември'],
		dayNamesMin: ['Нед', 'Пон', 'Вт', 'Ср ', 'Чет', 'Пет', 'Съб'],
		firstDay: 1,
		dateFormat: 'yy-mm-dd'
	});

	//jquery-ui/bootstrap datepicker hack
	var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;
	$.fn.modal.Constructor.prototype.enforceFocus = function() {
	};
	$('#signup-modal').on('hidden', function() {
		$.fn.modal.Constructor.prototype.enforceFocus = enforceModalFocusFn;
	});
	//$('#signup-modal').modal({ backdrop : false });

});
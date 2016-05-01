app.filter("errors", function () {
	return function (errorCode) {

		var errors = {
			invalid_login: "Грешно име или парола",
			empty_field: "Празно поле",
			invalid_int: "Невалидно число",
			invalid_date: "Невалидна дата",
			invalid_email: "Невалиден имейл",
			weak_password: "Паролата не е над 6 символа или не съдържа поне едно число"
		};
		
		if(angular.isUndefined(errors[errorCode])){
			//max-\d+ rule
			if(/exceeds_characters_(\d+)/.exec(errorCode)){
				var results = /exceeds_characters_(\d+)/.exec(errorCode);
				return "Полето надвишава "+results[1]+" символа";
			}
			
			//min-\d+ rule
			if(/below_characters_(\d+)/.exec(errorCode)){
				var results = /below_characters_(\d+)/.exec(errorCode);
				return "Полето е под "+results[1]+" символа";
			}
		}

		return errors[errorCode];
	};
});
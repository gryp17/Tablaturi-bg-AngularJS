app.filter('errors', function () {
	return function (errorCode) {

		var errors = {
			invalid_login: 'Грешно име или парола',
			empty_field: 'Празно поле',
			invalid_int: 'Невалидно число',
			invalid_date: 'Невалидна дата',
			invalid_email: 'Невалиден имейл',
			weak_password: 'Паролата не съдържа поне едно число и буква',
			no_match: 'Полетата не съвпадат',
			username_in_use: 'Потребителското име е заето',
			invalid_characters: 'Полето съдържа непозволени символи',
			email_in_use: 'Имейлът е зает',
			email_not_found: 'Несъществуващ имейл',
			not_in_list: 'Невалидно поле',
			invalid_captcha: 'Captcha-та не съвпада',
			invalid_file_extension: 'Невалиден формат',
			exceeds_max_file_size: 'Файлът надвишава максималния размер'
		};
		
		if(angular.isUndefined(errors[errorCode])){
			//max-\d+ rule
			if(/exceeds_characters_(\d+)/.exec(errorCode)){
				var results = /exceeds_characters_(\d+)/.exec(errorCode);
				return 'Полето надвишава '+results[1]+' символа';
			}
			
			//min-\d+ rule
			if(/below_characters_(\d+)/.exec(errorCode)){
				var results = /below_characters_(\d+)/.exec(errorCode);
				return 'Полето е под '+results[1]+' символа';
			}
		}

		return errors[errorCode];
	};
});
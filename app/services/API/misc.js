app.factory('MiscService', function($http) {
	return {
		generateCaptcha: function (){
			return $http({
				method: 'POST',
				url: 'Misc/generateCaptcha'
			});
		},
		contactUs: function(contactUsData) {
			return $http({
				method: 'POST',
				url: 'Misc/contactUs',
				data: contactUsData
			});
		}
	};
});
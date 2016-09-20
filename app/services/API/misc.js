app.factory('MiscService', function($http) {
	return {
		generateCaptcha: function (){
			return $http({
				method: 'POST',
				url: 'API/Misc/generateCaptcha'
			});
		},
		contactUs: function(contactUsData) {
			return $http({
				method: 'POST',
				url: 'API/Misc/contactUs',
				data: contactUsData
			});
		}
	};
});
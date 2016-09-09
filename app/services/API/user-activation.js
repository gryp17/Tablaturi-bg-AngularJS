app.factory('UserActivationService', function($http) {
	return {
		activateUser: function(userId, hash) {
			return $http({
				method: 'POST',
				url: 'UserActivation/activateUser',
				data: {
					user_id: userId,
					hash: hash
				}
			});
		}
	};
});
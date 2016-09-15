app.factory('PasswordResetService', function($http) {
	return {
		sendPasswordResetRequest: function (email){
			return $http({
				method: 'POST',
				url: 'PasswordReset/sendPasswordResetRequest',
				data: {
					forgotten_password_email: email
				}
			});
		},
		checkPasswordResetHash: function (userId, hash){
			return $http({
				method: 'POST',
				url: 'PasswordReset/checkPasswordResetHash',
				data: {
					user_id: userId,
					hash: hash
				}
			});
		}
	};
});
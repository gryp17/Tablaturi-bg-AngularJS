app.factory('UserService', function($http) {
	return {
		login: function(username, password) {
			return $http({
				method: 'POST',
				url: 'User/login',
				data: {
					username: username,
					password: password
				}
			});
		},
		isLoggedIn: function (){
			return $http({
				method: 'POST',
				url: 'User/isLoggedIn'
			});
		}
	};
});
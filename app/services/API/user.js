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
		logout: function (){
			return $http({
				method: 'POST',
				url: 'User/logout'
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
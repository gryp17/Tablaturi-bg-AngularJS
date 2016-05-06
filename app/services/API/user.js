app.factory('UserService', function($http) {
	return {
		login: function(loginData) {
			return $http({
				method: 'POST',
				url: 'User/login',
				data: loginData
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
		},
		generateCaptcha: function (){
			return $http({
				method: 'POST',
				url: 'User/generateCaptcha'
			});
		},
		signup: function (userData){
			return $http({
				method: 'POST',
				url: 'User/signup',
				data: userData
			});
		}
	};
});
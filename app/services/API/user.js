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
		signup: function (userData){
			return $http({
				method: 'POST',
				url: 'User/signup',
				data: userData
			});
		},
		getUser: function (id){
			return $http({
				method: 'POST',
				url: 'User/getUser',
				data: {
					id: id
				}
			});
		},
		updateUser: function (formData){
			return $http({
				method: 'POST',
				url: 'User/updateUser',
				headers: {
					'Content-Type': undefined 
				},
				data: formData
			});
		},
	};
});
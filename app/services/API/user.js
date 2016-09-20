app.factory('UserService', function($http) {
	return {
		login: function(loginData) {
			return $http({
				method: 'POST',
				url: 'API/User/login',
				data: loginData
			});
		},
		updatePassword: function(formData) {
			return $http({
				method: 'POST',
				url: 'API/User/updatePassword',
				data: formData
			});
		},
		logout: function (){
			return $http({
				method: 'POST',
				url: 'API/User/logout'
			});
		},
		isLoggedIn: function (){
			return $http({
				method: 'POST',
				url: 'API/User/isLoggedIn'
			});
		},
		signup: function (userData){
			return $http({
				method: 'POST',
				url: 'API/User/signup',
				data: userData
			});
		},
		getUser: function (id){
			return $http({
				method: 'POST',
				url: 'API/User/getUser',
				data: {
					id: id
				}
			});
		},
		updateUser: function (formData){
			return $http({
				method: 'POST',
				url: 'API/User/updateUser',
				headers: {
					'Content-Type': undefined 
				},
				data: formData
			});
		},
		search: function(keyword, limit, offset){
			return $http({
				method: 'POST',
				url: 'API/User/search',
				data: {
					keyword: keyword,
					limit: limit,
					offset: offset
				}
			});
		},
		getTotalSearchResults: function(keyword){
			return $http({
				method: 'POST',
				url: 'API/User/getTotalSearchResults',
				data: {
					keyword: keyword
				}
			});
		}
	};
});
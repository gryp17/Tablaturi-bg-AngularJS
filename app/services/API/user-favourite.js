app.factory('UserFavouriteService', function($http) {
	return {
		getUserFavourites: function(userId, limit, offset) {
			return $http({
				method: 'POST',
				url: 'UserFavourite/getUserFavourites',
				data: {
					user_id: userId,
					limit: limit,
					offset: offset
				}
			});
		},
		getTotalUserFavourites: function(userId) {
			return $http({
				method: 'POST',
				url: 'UserFavourite/getTotalUserFavourites',
				data: {
					user_id: userId
				}
			});
		},
		deleteFavouriteTab: function(tabId) {
			return $http({
				method: 'POST',
				url: 'UserFavourite/deleteFavouriteTab',
				data: {
					tab_id: tabId
				}
			});
		},
		addFavouriteTab: function(tabId) {
			return $http({
				method: 'POST',
				url: 'UserFavourite/addFavouriteTab',
				data: {
					tab_id: tabId
				}
			});
		}
	};
});
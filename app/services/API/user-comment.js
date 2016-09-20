app.factory('UserCommentService', function($http) {
	return {
		getUserComments: function(userId, limit, offset) {
			return $http({
				method: 'POST',
				url: 'API/UserComment/getUserComments',
				data: {
					user_id: userId,
					limit: limit,
					offset: offset
				}
			});
		},
		getTotalUserComments: function(userId) {
			return $http({
				method: 'POST',
				url: 'API/UserComment/getTotalUserComments',
				data: {
					user_id: userId
				}
			});
		},
		addUserComment: function(userId, content) {
			return $http({
				method: 'POST',
				url: 'API/UserComment/addUserComment',
				data: {
					user_id: userId,
					content: content
				}
			});
		}
	};
});
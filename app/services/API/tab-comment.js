app.factory('TabCommentService', function($http) {
	return {
		getTabComments: function(tabId, limit, offset) {
			return $http({
				method: 'POST',
				url: 'TabComment/getTabComments',
				data: {
					tab_id: tabId,
					limit: limit,
					offset: offset
				}
			});
		},
		getTotalTabComments: function(tabId) {
			return $http({
				method: 'POST',
				url: 'TabComment/getTotalTabComments',
				data: {
					tab_id: tabId
				}
			});
		},
		addTabComment: function(tabId, content) {
			return $http({
				method: 'POST',
				url: 'TabComment/addTabComment',
				data: {
					tab_id: tabId,
					content: content
				}
			});
		}
	};
});
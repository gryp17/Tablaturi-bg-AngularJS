app.factory('ArticleService', function($http) {
	return {
		getArticles: function(limit, offset) {
			return $http({
				method: 'POST',
				url: 'API/getArticles',
				data: {
					limit: limit,
					offset: offset
				}
			});
		}
	};
});
app.factory('ArticleService', function($http) {
	return {
		getArticles: function(limit, offset) {
			return $http({
				method: 'POST',
				url: 'Article/getArticles',
				data: {
					limit: limit,
					offset: offset
				}
			});
		}
	};
});
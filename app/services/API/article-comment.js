app.factory('ArticleCommentService', function($http) {
	return {
		getArticleComments: function(articleId, limit, offset) {
			return $http({
				method: 'POST',
				url: 'ArticleComment/getArticleComments',
				data: {
					article_id: articleId,
					limit: limit,
					offset: offset
				}
			});
		}
	};
});
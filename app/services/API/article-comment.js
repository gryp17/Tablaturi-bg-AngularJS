app.factory('ArticleCommentService', function($http) {
	return {
		getArticleComments: function(articleId, limit, offset) {
			return $http({
				method: 'POST',
				url: 'API/ArticleComment/getArticleComments',
				data: {
					article_id: articleId,
					limit: limit,
					offset: offset
				}
			});
		},
		getTotalArticleComments: function(articleId) {
			return $http({
				method: 'POST',
				url: 'API/ArticleComment/getTotalArticleComments',
				data: {
					article_id: articleId
				}
			});
		},
		addArticleComment: function(articleId, content) {
			return $http({
				method: 'POST',
				url: 'API/ArticleComment/addArticleComment',
				data: {
					article_id: articleId,
					content: content
				}
			});
		}
	};
});
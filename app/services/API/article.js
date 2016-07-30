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
		},
		getArticle: function(id) {
			return $http({
				method: 'POST',
				url: 'Article/getArticle',
				data: {
					id: id
				}
			});
		},
		addArticle: function (formData){
			return $http({
				method: 'POST',
				url: 'Article/addArticle',
				headers: {
					'Content-Type': undefined 
				},
				data: formData
			});
		},
		updateArticle: function (formData){
			return $http({
				method: 'POST',
				url: 'Article/updateArticle',
				headers: {
					'Content-Type': undefined 
				},
				data: formData
			});
		}
	};
});
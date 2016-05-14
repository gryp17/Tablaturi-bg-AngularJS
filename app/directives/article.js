app.directive('article', function($filter, $location) {
	return {
		restrict: 'A',
		templateUrl: 'app/views/directives/article.php',
		replace: true,
		scope: {
		    articleData: '='
		},
		link: function(scope, element, attrs) {
			var sanitizedContent = scope.articleData.content.replace(/<[^>]+>/gm, '');
			var limit = 210 - scope.articleData.title.length;			
			scope.articleData.content = $filter('limitTo')(sanitizedContent, limit) + '...';
			
			/**
			 * Redirects to the article page
			 * @param {int} articleId
			 */
			scope.open = function (articleId){
				$location.path('article/'+articleId);
			};
			
		}
	};
});
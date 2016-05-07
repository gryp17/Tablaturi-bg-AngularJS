app.directive('article', function($filter) {
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
		}
	};
});
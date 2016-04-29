app.directive("article", function($filter) {
	return {
		restrict: "A",
		templateUrl: "app/views/directives/article.php",
		replace: true,
		scope: {
		    articleData: "="
		},
		link: function(scope, element, attrs) {
			var date = scope.articleData.date.split(/[- :]/);
			scope.articleData.date = new Date(date[0], date[1]-1, date[2], date[3], date[4], date[5]);
			
			var sanitizedContent = scope.articleData.content.replace(/<[^>]+>/gm, '');
			var limit = 210 - scope.articleData.title.length;			
			scope.articleData.content = $filter("limitTo")(sanitizedContent, limit) + '...';
		}
	};
});
app.controller("articlesController", function ($scope, ArticleService, LoadingService) {

	$scope.limit = 6;
	$scope.offset = 0;
	$scope.articles = [];

	$scope.loadArticles = function (limit, offset) {
		ArticleService.getArticles(limit, offset).success(function (result) {
			if (result.error) {
				console.log(result.error);
			} else {
				LoadingService.doneLoading();
				$scope.articles.push(result.data);
			}
		});
	};
	
	$scope.loadArticles($scope.limit, $scope.offset);

});
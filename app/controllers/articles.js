app.controller('articlesController', function ($scope, ArticleService, LoadingService) {

	$scope.limit = 6;
	$scope.offset = 0;
	$scope.articles = [];

	/**
	 * Loads the articles from the database
	 * @param {int} limit
	 * @param {int} offset
	 */
	$scope.loadArticles = function (limit, offset) {
		ArticleService.getArticles(limit, offset).success(function (result) {
			console.log(result.data);
			if (result.error) {
				console.log(result.error);
			} else {
				LoadingService.doneLoading();
				$scope.articles = $scope.articles.concat(result.data);
				
				//hide the load more button if there are no more articles
				if(result.data.length < $scope.limit){
					$scope.noMoreArticles = true;
				}
			}
		});
	};
	
	$scope.loadArticles($scope.limit, $scope.offset);

});
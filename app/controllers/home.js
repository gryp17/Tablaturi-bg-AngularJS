app.controller('homeController', function($scope, ArticleService, LoadingService) {

	ArticleService.getArticles(6, 0).success(function(result) {
		if (result.error) {
			console.log(result.error);
		} else {
			LoadingService.doneLoading();

			$scope.articles = result.data;
		}
	});

});
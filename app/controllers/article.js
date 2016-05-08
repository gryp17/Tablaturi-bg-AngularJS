app.controller('articleController', function($scope, $routeParams, $location, $sce, $q, $filter, ArticleService, ArticleCommentService, LoadingService) {
	$scope.limit = 6;
	$scope.offset = 0;

	if(angular.isUndefined($routeParams.id)){
		$location.path('/');
	}

	$q.all([
		ArticleService.getArticle($routeParams.id),
		ArticleCommentService.getArticleComments($routeParams.id, $scope.limit, $scope.offset)
	]).then(function (result){
		
		if(angular.isUndefined(result[0].data.data)){
			$location.path('/');
		}else{
			//article content
			$scope.article = result[0].data.data;
			$scope.article.content = $scope.article.content.replace(/(\r\n|\r|\n)/g, '<br/>');
			$scope.article.content = $filter('emoticons')($scope.article.content);
			$scope.article.content = $sce.trustAsHtml($scope.article.content);
			
			//article share id
			$scope.$parent.shareId = $scope.article.ID;
			
			//article comments
			$scope.articleComments = result[1].data.data;

			console.log($scope.articleComments);

			LoadingService.doneLoading();
		}
		

	});

});
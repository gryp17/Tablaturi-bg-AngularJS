app.controller('articleController', function($scope, $rootScope, $routeParams, $location, $sce, $q, $filter, ArticleService, ArticleCommentService, LoadingService, ValidationService) {
	$scope.limit = 6;
	$scope.offset = 0;

	if(angular.isUndefined($routeParams.id)){
		$location.path('/');
	} else {
		$scope.articleId = $routeParams.id;
	}
	
	$scope.addComment = function(){
		ArticleCommentService.addArticleComment($scope.articleId, $scope.commentContent).success(function(result) {
			if(result.status === 0){
				if(result.error){
					//show the error
					ValidationService.showError(result.error.field, result.error.error_code);
				}
			}else{
				$scope.commentContent = '';
				$scope.getArticleComments(6, 0);
			}
		});
	};
	
	$scope.getArticleComments = function(limit, offset) {
		ArticleCommentService.getArticleComments($scope.articleId, limit, offset).success(function(result) {
			$scope.articleComments = result.data;
		});
	};

	$q.all([
		ArticleService.getArticle($scope.articleId),
		ArticleCommentService.getArticleComments($scope.articleId, $scope.limit, $scope.offset)
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

			LoadingService.doneLoading();
		}
	});
	
	
	
});
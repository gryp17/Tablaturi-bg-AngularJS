app.controller('articleController', function($scope, $rootScope, $routeParams, $location, $sce, $q, $filter, ArticleService, ArticleCommentService, LoadingService, ValidationService) {
	$scope.limit = 6;
	$scope.offset = 0;

	if(angular.isUndefined($routeParams.id)){
		$location.path('/');
	} else {
		$scope.articleId = $routeParams.id;
	}
	
	/**
	 * Add new comment
	 */
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
				
				//scroll to the latest comment
				var offset = $(".comments-wrapper").offset().top;
				$("html, body").animate({scrollTop: offset}, 500);
			}
		});
	};
	
	/**
	 * Fetches the article comments and renders them in the page
	 * @param {int} limit
	 * @param {int} offset
	 */
	$scope.getArticleComments = function(limit, offset) {
		$q.all([
			ArticleCommentService.getArticleComments($scope.articleId, limit, offset),
			ArticleCommentService.getTotalArticleComments($scope.articleId)
		]).then(function (result){
			$scope.articleComments = result[0].data.data;
			$scope.totalArticleComments = result[1].data.data;
		});
	};

	$q.all([
		ArticleService.getArticle($scope.articleId),
		ArticleCommentService.getArticleComments($scope.articleId, $scope.limit, $scope.offset),
		ArticleCommentService.getTotalArticleComments($scope.articleId)
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
			
			//total number of article comments
			$scope.totalArticleComments = result[2].data.data;

			LoadingService.doneLoading();
		}
	});
	
	
	
});
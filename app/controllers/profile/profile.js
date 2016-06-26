app.controller('profileController', function ($scope, $routeParams, $q, UserCommentService, ValidationService) {

	/**
	 * Add new comment
	 */
	$scope.addComment = function(){
		UserCommentService.addUserComment($routeParams.id, $scope.commentContent).success(function(result) {
			if(result.status === 0){
				if(result.error){
					//show the error
					ValidationService.showError(result.error.field, result.error.error_code);
				}
			}else{
				$scope.commentContent = '';
				$scope.getUserComments(6, 0);
				
				//scroll to the latest comment
				var offset = $(".comments-wrapper").offset().top;
				$("html, body").animate({scrollTop: offset}, 500);
			}
		});
	};
	
	/**
	 * Fetches the user comments and renders them in the page
	 * @param {int} limit
	 * @param {int} offset
	 */
	$scope.getUserComments = function(limit, offset) {
		$q.all([
			UserCommentService.getUserComments($routeParams.id, limit, offset),
			UserCommentService.getTotalUserComments($routeParams.id)
		]).then(function (result){
			$scope.userComments = result[0].data.data;
			$scope.totalUserComments = result[1].data.data;
		});
	};

});
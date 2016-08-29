app.controller('articleController', function($scope, $rootScope, $routeParams, $location, $sce, $q, $filter, ArticleService, ArticleCommentService, LoadingService, ValidationService) {
	$scope.limit = 6;
	$scope.offset = 0;

	$scope.articleId = $routeParams.id;
	
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
				var offset = $('.comments-wrapper').offset().top;
				$('html, body').animate({scrollTop: offset}, 500);
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
			$location.path('/not-found');
		}else{
			//article content
			$scope.rawArticle = angular.copy(result[0].data.data);
			$scope.article = result[0].data.data;
			$scope.article.content = $scope.sanitizeArticleContent($scope.article.content);
			
			//article share link
			$scope.$parent.shareLink = '#/article/'+$scope.article.ID;
			
			//article comments
			$scope.articleComments = result[1].data.data;
			
			//total number of article comments
			$scope.totalArticleComments = result[2].data.data;

			LoadingService.doneLoading();
		}
	});
	
	/**
	 * Sanitizes the article content replacing the new lines with <br> tags and applying emoticons
	 * @param {String} content
	 * @returns {String}
	 */
	$scope.sanitizeArticleContent = function (content) {
		content = content.replace(/(\r\n|\r|\n)/g, '<br/>');
		content = $filter('emoticons')(content);
		content = $sce.trustAsHtml(content);	
		return content;
	};
	
	/**
	 * Opens article edit modal
	 */
	$scope.openEditModal = function() {
		$scope.editData = angular.copy($scope.rawArticle);
		$scope.editData.date = $scope.editData.date.replace('T', ' ');
		
		//clear all errors (if any)
		$('#edit-article-modal .field-box').removeClass('error');
		
		$('#edit-article-modal').modal('show');
	};
	
	/**
	 * Closes the edit modal on success
	 * It fetches the updated article data
	 */
	$scope.closeEditModal = function () {
		ArticleService.getArticle($scope.articleId).then(function (result){
			$scope.rawArticle = angular.copy(result.data.data);
			$scope.article = result.data.data;
			$scope.article.content = $scope.sanitizeArticleContent($scope.article.content);
			
			$('#edit-article-modal').modal('hide');
		});
	};
	
	$('#edit-article-datepicker').datetimepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1940:' + new Date().getFullYear(),
		monthNamesShort: ['Януари', 'Февруари', 'Март', 'Април', 'Май', 'Юни', 'Юли', 'Август', 'Септември', 'Октомври', 'Ноември', 'Декември'],
		dayNamesMin: ['Нед', 'Пон', 'Вт', 'Ср ', 'Чет', 'Пет', 'Съб'],
		firstDay: 1,
		dateFormat: 'yy-mm-dd',
		timeFormat: 'HH:mm:ss',
		hour: new Date().getHours(),
		minute: new Date().getMinutes(),
		second: new Date().getSeconds()
	});
	
	/**
	 * Opens the hidden file input
	 */
	$scope.browse = function() {
		$('.image').click();
	};
	
	/*
	 * On image file change generate article image preview
	 */
	$('.image').change(function(event) {		
		var file = event.target.files[0];
		
		// Check image extensions
		if(/image\/(jpe?g|png)/i.test(file.type) === false){
			ValidationService.showError('image', 'invalid_file_extension');
		} else {
			// Check image size
			if((file.size / 1024) > 1000) {
				ValidationService.showError('image', 'exceeds_max_file_size');
			} else {
				$('#edit-article-form .article-image').attr('src', URL.createObjectURL(event.target.files[0]));
			}
		}
	});
	
	/**
	 * Callback function that is called when the save changes button is pressed
	 */
	$scope.submitEditArticleForm = function() {
		var formData = new FormData(document.getElementById('edit-article-form'));
		
		ArticleService.updateArticle(formData).success(function (result){
			if (result.status === 0) {
				if (result.error) {
					//show the error
					ValidationService.showError(result.error.field, result.error.error_code);
				}
			} else {
				$scope.closeEditModal();
			}
		});
	};
	
});
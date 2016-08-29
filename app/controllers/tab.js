app.controller('tabController', function ($scope, $routeParams, $location, $q, TabService, TabCommentService, ValidationService, LoadingService) {
	$scope.limit = 6;
	$scope.offset = 0;
		
	$scope.tabId = $routeParams.id;
	
	$q.all([
		TabService.getTab($scope.tabId),
		TabCommentService.getTabComments($scope.tabId, $scope.limit, $scope.offset),
		TabCommentService.getTotalTabComments($scope.tabId)
	]).then(function (results){
		
		if(angular.isUndefined(results[0].data.data)){
			$location.path('/not-found');
		}else{
			$scope.tab = results[0].data.data;
		
			//tab share link
			$scope.$parent.shareLink = '#/tab/'+$scope.tab.ID;
		
			//tab comments
			$scope.tabComments = results[1].data.data;

			//total number of tab comments
			$scope.totalTabComments = results[2].data.data;

			LoadingService.doneLoading();
		}
		
	});
	
	/**
	 * Fetches the tab comments and renders them in the page
	 * @param {int} limit
	 * @param {int} offset
	 */
	$scope.getTabComments = function(limit, offset) {
		$q.all([
			TabCommentService.getTabComments($scope.tabId, limit, offset),
			TabCommentService.getTotalTabComments($scope.tabId)
		]).then(function (results){
			$scope.tabComments = results[0].data.data;
			$scope.totalTabComments = results[1].data.data;
		});
	};
	
	/**
	 * Add new comment
	 * @returns {undefined}
	 */
	$scope.addComment = function(){
		TabCommentService.addTabComment($scope.tabId, $scope.commentContent).success(function(result) {
			if(result.status === 0){
				if(result.error){
					//show the error
					ValidationService.showError(result.error.field, result.error.error_code);
				}
			}else{
				$scope.commentContent = '';
				$scope.getTabComments(6, 0);
				
				//scroll to the latest comment
				var offset = $('.comments-wrapper').offset().top;
				$('html, body').animate({scrollTop: offset}, 500);
			}
		});
	};
	
	/**
	 * Rates the tab
	 * @param {int} rating
	 */
	$scope.rateTab = function (rating){
		TabService.rateTab($scope.tabId, rating).then(function (result){
			
			if(result.data.error === 'access_denied'){
				alert('login or signup');
			}else{
				if(result.data.data === true){
					alert('thank you. you have been awarded +1 reputation');
				}else{
					alert('you have already rated this tab');
				}
			}

		});
	};
	
	/**
	 * Zooms in or out the "pre" container
	 * @param {int} amount
	 */
	$scope.zoom = function (amount){
		var fontSize = $('pre').css('font-size');
		fontSize = parseInt(fontSize.replace('px', ''));
		$('pre').css('font-size', fontSize + amount);
	};
	
	/**
	 * Requests the guitar pro file for the provided tab id
	 * @param {int} tabId
	 */
	$scope.downloadGpTab = function (tabId){
		
	};
	
	/**
	 * Requests the text file version of the provided tab id
	 * @param {int} tabId
	 */
	$scope.downloadTextTab = function (tabId){
		
	};
	
});
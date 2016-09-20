app.controller('tabController', function ($scope, $rootScope, $routeParams, $location, $q, TabService, TabCommentService, UserFavouriteService, TabReportService, ValidationService, LoadingService) {
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
				
			//tab comments
			$scope.tabComments = results[1].data.data;

			//total number of tab comments
			$scope.totalTabComments = results[2].data.data;
			
			//render the share buttons manually
			stButtons.makeButtons();
			
			LoadingService.doneLoading();
		}
		
	});
	
	/**
	 * Watch for user login/logout and update the user favourites list accordingly
	 */
	$rootScope.$watch('loggedInUser', function (){
		$scope.loggedInUser = $rootScope.loggedInUser;
		
		//if the user is logged in - fetch all favourites
		if(angular.isDefined($scope.loggedInUser)){
			UserFavouriteService.getUserFavourites($scope.loggedInUser.ID, 999999, 0).then(function (result){
				$scope.favouriteTabs = result.data.data.map(function (tab){
					return tab.ID;
				});
			});
		}else{
			$scope.favouriteTabs = [];
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
	
	$scope.showPopover = function (selector, message){
		$(selector).on('blur', function (){
			$(selector).popover('hide');
		});
		
		$(selector).popover({
			container: '.tab',
			trigger: 'manual',
			placement: 'top',
			html: true,
			content: message
		});
		
		//hack for dynamically changing the content 
		var popover = $(selector).data('bs.popover');
		popover.options.content = message;
		
		$(selector).popover('show');
	};
	
	/**
	 * Adds the tab to the favourites list
	 * @param {int} tabId
	 */
	$scope.addToFavourites = function (tabId){
		UserFavouriteService.addFavouriteTab(tabId).then(function (result){
			if(result.data.error === 'access_denied'){
				$scope.showPopover('#add-to-favourites-button', $('#add-to-favourites-login-message').html());
			}else{
				$scope.favouriteTabs.push(tabId);
			}			
		});
	};
	
	/**
	 * Deletes the tab from the favourites list
	 * @param {int} tabId
	 */
	$scope.removeFromFavourites = function (tabId){
		UserFavouriteService.deleteFavouriteTab(tabId).then(function (){
			$scope.favouriteTabs = $scope.favouriteTabs.filter(function (id){
				return id !== tabId;
			});
		});
	};
	
	
	/**
	 * Opens the report tab modal
	 */
	$scope.openReportTabModal = function (){
		//open the modal only if the user is logged in
		if(angular.isDefined($rootScope.loggedInUser)){
			$scope.reportSuccess = false;
		
			$scope.reportedTab = {
				id: $scope.tabId,
				reason: 'invalid tab/format',
				other: ''
			};

			$scope.$watch('reportedTab', function() {
				if($scope.reportedTab.reason !== 'other') {
					$scope.reportedTab.other = '';
				}
			}, true);

			$('#report-tab-modal').modal('show');
		}else{
			$scope.showPopover('#report-tab-button', $('#report-tab-login-message').html());
		}
	};
	
	/**
	 * Reports the tab
	 */
	$scope.reportTab = function (reportedTab){
		var reason;
		
		if(reportedTab.reason === 'other'){
			reason = reportedTab.other;
		}else{
			reason = reportedTab.reason;
		}
		
		TabReportService.reportTab(reportedTab.id, reason).then(function (result){
			if (result.data.status === 0) {
				if (result.data.error) {
					//show the error
					ValidationService.showError(result.data.error.field, result.data.error.error_code);
				}
			} else {
				$scope.reportSuccess = true;
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
				$scope.showPopover('.stars-rating', $('#rate-tab-login-message').html());
			}else{
				if(result.data.data === true){
					$scope.showPopover('.stars-rating', $('#rate-tab-success-message').html());
				}else{
					$scope.showPopover('.stars-rating', $('#rate-tab-already-rated-message').html());
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
			
});
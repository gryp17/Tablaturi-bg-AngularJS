app.controller('profileController', function ($rootScope, $scope, $routeParams, $q, $location, UserService, UserCommentService, UserReportService, LoadingService, ValidationService) {

	$scope.loggedInUser = $rootScope.loggedInUser;

	$scope.limit = 6;
	$scope.offset = 0;

	$q.all([
		UserService.getUser($routeParams.id),
		UserCommentService.getUserComments($routeParams.id, $scope.limit, $scope.offset),
		UserCommentService.getTotalUserComments($routeParams.id),
	]).then(function (responses){

		if(angular.isDefined(responses[0].data.data)){
			$scope.userData = responses[0].data.data;
			
			$scope.userComments = responses[1].data.data;
			$scope.totalUserComments = responses[2].data.data;
		
			LoadingService.doneLoading();
		}else{
			$location.path('/not-found');
		}
	});
	
	$('.glyphicon-info-sign').popover({
		container: 'body',
		trigger: 'hover',
		placement: 'right',
		html: true,
		content: $('#reputation-popover-message').html()
	});

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
	
	/**
	 * Opens the report user modal
	 */
	$scope.openReportModal = function() {
		$scope.reportSuccess = false;
		
		$scope.reportedUser = {
			id: $scope.userData.ID,
			username: $scope.userData.username,
			reason: 'rude language',
			other: ''
		};
		
		$scope.$watch('reportedUser', function() {
			if($scope.reportedUser.reason !== 'other') {
				$scope.reportedUser.other = '';
			}
		}, true);
		
		$('#report-profile-modal').modal('show');
	};
	
	/**
	 * Reports the provided user
	 * @param {Object} reportedUser
	 */
	$scope.reportUser = function(reportedUser) {
		var reason;
		
		if(reportedUser.reason === 'other'){
			reason = reportedUser.other;
		}else{
			reason = reportedUser.reason;
		}
		
		UserReportService.reportUser(reportedUser.id, reason).then(function (result){
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
	 * Opens the hidden file input
	 */
	$scope.browse = function() {
		$('.avatar').click();
	};
	
	/**
	 * Opens the edit profile modal
	 */
	$scope.openEditModal = function() {
		$scope.editData = {
			password: '',
			repeat_password: '',
			photo: $scope.userData.photo,
			location: $scope.userData.location,
			occupation: $scope.userData.occupation,
			web: $scope.userData.web,
			about_me: $scope.userData.about_me,
			instrument: $scope.userData.instrument,
			favourite_bands: $scope.userData.favourite_bands
		};
		
		$('#edit-profile-modal').modal('show');
	};
	
	/**
	 * Callback function that is called when the save button is pressed
	 */
	$scope.submitEditProfileForm = function () {
		
		var formData = new FormData(document.getElementById("edit-profile-form"));
		
		UserService.updateUser(formData).success(function (result){
			if (result.status === 0) {
				if (result.error) {
					//show the error
					ValidationService.showError(result.error.field, result.error.error_code);
				}
			} else {
				//close the modal
				$('#edit-profile-modal').modal('hide');
				
				//reload the user data and user comments
				UserService.getUser($routeParams.id).then(function (result){
					$scope.userData = result.data.data;
					$rootScope.loggedInUser = result.data.data;
					$scope.getUserComments($scope.limit, $scope.offset);
				});
			}
		});

	};
	
	/*
	 * On avatar file change generate avatar preview
	 */
	$('.avatar').change(function(event) {		
		var file = event.target.files[0];
		
		// Check image extensions
		if(/image\/(jpe?g|png)/i.test(file.type) === false){
			ValidationService.showError('avatar', 'invalid_file_extension');
		} else {
			// Check image size
			if((file.size / 1024) > 1000) {
				ValidationService.showError('avatar', 'exceeds_max_file_size');
			} else {
				$('#edit-profile-form .user-avatar').attr('src', URL.createObjectURL(event.target.files[0]));
			}
		}
	});

});
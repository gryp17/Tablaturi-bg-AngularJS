app.controller('editTabController', function ($scope, $rootScope, $routeParams, $location, TabService, LoadingService, ValidationService) {
	$scope.tabId = $routeParams.id;
	
	TabService.getTab($scope.tabId).then(function(result) {
		if(angular.isUndefined(result.data.data)) {
			$location.path('/not-found');
		} else {
			$scope.tab = result.data.data;
			
			//if the tab is not uploaded by the logged in user
			if ($scope.tab.uploader_ID !== $rootScope.loggedInUser.ID) {
				$location.path('/home');
			}
			
			$scope.defaultTunnings = ['Стандартен (EBGDAE)', 'Drop D', 'Drop C'];
			if($scope.defaultTunnings.indexOf($scope.tab.tunning) === -1) {
				$scope.otherTunning = $scope.tab.tunning;
				$scope.tab.tunning = 'other';
			}
			
			LoadingService.doneLoading();
		}
	});
	
	/**
	 * Opens the hidden file input
	 */
	$scope.browse = function() {
		$('.file').click();
	};
	
	/*
	 * On file change
	 */
	$(document).on('change', '.file', function (event){
		var file = event.target.files[0];
		var extension = file.name.replace(/.+\./, '');
		var validExtensions = ['gp','gp3','gp4','gp5','gp6','gpx'];
		
		// Check file extension
		if(validExtensions.indexOf(extension) === -1) {
			ValidationService.showError('gp_file', 'invalid_file_extension');
		} else {
			// Check file size
			if((file.size / 1024) > 1000) {
				ValidationService.showError('gp_file', 'exceeds_max_file_size');
			}
		}
	});
	
	/**
	 * Updated the tab data
	 */
	$scope.updateTab = function() {
		var formData = new FormData(document.getElementById('edit-tab-form'));
		
		if(formData.get('tunning') === 'other'){
			formData.set('tunning', formData.get('other_tunning'));
		}
		
		formData.delete('other_tunning');
		
		TabService.updateTab(formData).success(function (result){
			if (result.status === 0) {
				if (result.error) {
					
					//redirect the tunning error to the other_tunning input
					if(result.error.field === 'tunning'){
						result.error.field = 'other_tunning';
					}
					
					//show the error
					ValidationService.showError(result.error.field, result.error.error_code);
				}
			} else {
				//redirect to the updated tab
				$location.path('/tab/'+$scope.tabId);
			}
		});
	};
});
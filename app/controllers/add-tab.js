app.controller('addTabController', function ($scope, $location, TabService, ValidationService) {

	//default tab data
	$scope.formData = {
		type: 'tab',
		tunning: {
			type: 'Стандартен (EBGDAE)'
		},
		tab_type: 'full song',
		difficulty: 'Средна'
	};
	
	/**
	 * Function that is called when the tunnings custom select is opened. 
	 * It clears the errors that are visible in the 'other_tunning' input
	 */
	$scope.clearTunningErrors = function (){
		$('input[name=other_tunning]').closest('.field-box').removeClass('error');
	};

	/**
	 * Adds the new tab
	 * It opens the newly created tab on success
	 */
	$scope.addTab = function (){
		var formData = new FormData(document.getElementById('add-tab-form'));
		
		if(formData.get('tunning') === 'other'){
			formData.set('tunning', formData.get('other_tunning'));
		}
		
		formData.delete('other_tunning');
		
		TabService.addTab(formData).success(function (result){
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
				//redirect to the newly added tab
				$location.path('/tab/'+result.data.tab_id);
			}
		});
	};
	
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
	
});
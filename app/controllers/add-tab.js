app.controller('addTabController', function ($scope, $location, TabService, ValidationService) {

	$scope.formData = {
		type: 'tab',
		tunning: {
			type: 'Стандартен (EBGDAE)'
		},
		tab_type: 'full song',
		difficulty: 'Средна'
	};

	$scope.addTab = function (){

		var formData = new FormData(document.getElementById('add-tab-form'));
		
		if(formData.get('tunning') === 'other'){
			formData.set('tunning', formData.get('other_tunning'));
		}
		
		formData.delete('other_tunning');
		
		TabService.addTab(formData).success(function (result){
			
			if (result.status === 0) {
				if (result.error) {
					//show the error
					ValidationService.showError(result.error.field, result.error.error_code);
				}
			} else {
				//redirect to the newly added tab
				$location.path('/tab/'+result.data.tab_id);
			}
			
		});
		
	};
	
});
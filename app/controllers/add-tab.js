app.controller('addTabController', function ($scope, TabService, LoadingService) {

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
		
		TabService.addTab(formData).then(function (result){
			
			console.log(result.data);
			
		});
		
	};
	
});
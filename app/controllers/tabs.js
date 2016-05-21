app.controller('tabsController', function ($scope, $q, TabService, LoadingService) {
	var limit = 5;
	
	$q.all([
		TabService.getMost('popular', limit),
		TabService.getMost('liked', limit),
		TabService.getMost('latest', limit),
		TabService.getMost('commented', limit)
	]).then(function (responses){
		console.log(responses);
		
		LoadingService.doneLoading();
	});
	

});
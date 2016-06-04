app.controller('tabsController', function ($scope, $q, TabService, LoadingService) {
	var limit = 5;
	
	$q.all([
		TabService.getMost('popular', limit),
		TabService.getMost('liked', limit),
		TabService.getMost('latest', limit),
		TabService.getMost('commented', limit)
	]).then(function (responses){
		
		$scope.mostPopular = responses[0].data.data;
		$scope.mostLiked = responses[1].data.data;
		$scope.mostRecent = responses[2].data.data;
		$scope.mostCommented = responses[3].data.data;
		
		LoadingService.doneLoading();
	});
	
});
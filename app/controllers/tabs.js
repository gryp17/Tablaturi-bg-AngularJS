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
	
	
	
	/**
	 * Generates an array of integers based on the tab rating
	 * @param {int} rating
	 * @returns {Array}
	 */
	$scope.calculateStars = function (rating){
		var result = [];
		var stars = Math.floor(rating);
		
		for(var i = 1; i <= 5; i++){
			if(i <= stars){
				result.push(1);
			}else{
				result.push(0);
			}
		}
		
		return result;
	};

});
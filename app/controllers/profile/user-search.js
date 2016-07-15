app.controller('userSearchController', function($scope, $routeParams, $q, UserService, ValidationService) {

	$scope.keyword = '';
	$scope.limit = 20;
	$scope.offset = 0;

	/**
	 * Callback function that is called when the search button is pressed
	 * It resets the pagination offset and launches new search
	 */
	$scope.newSearch = function (){
		$scope.offset = 0;
		$scope.search($scope.limit, $scope.offset, $scope.keyword);
	};

	/**
	 * Used to search for users
	 * @param {int} limit
	 * @param {int} offset
	 * @param {String} keyword
	 */
	$scope.search = function(limit, offset, keyword) {
		$q.all([
			UserService.search(keyword, limit, offset),
			UserService.getTotalSearchResults(keyword)
		]).then(function (results){
			if(results[0].data.status === 0){
				if (results[0].data.error) {
					//show the error
					ValidationService.showError(results[0].data.error.field, results[0].data.error.error_code);
				}
			}else{
				$scope.users = results[0].data.data;
				$scope.totalUsers = results[1].data.data;
			}
		});

	};


});
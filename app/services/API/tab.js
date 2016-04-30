app.factory('TabService', function($http) {
	return {
		getTabsCount: function() {
			return $http({
				method: 'GET',
				url: 'Tab/getTabsCount'
			});
		}
	};
});
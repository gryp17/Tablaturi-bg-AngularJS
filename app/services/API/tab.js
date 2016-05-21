app.factory('TabService', function($http) {
	return {
		getTabsCount: function() {
			return $http({
				method: 'GET',
				url: 'Tab/getTabsCount'
			});
		},
		getMost: function(type, limit) {
			return $http({
				method: 'POST',
				url: 'Tab/getMost',
				data: {
					type: type,
					limit: limit
				}
			});
		}
	};
});
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
		},
		autocomplete: function(type, term) {
			return $http({
				method: 'POST',
				url: 'Tab/autocomplete',
				data: {
					type: type,
					term: term
				}
			});
		},
		search: function(type, band, song, limit, offset) {
			return $http({
				method: 'POST',
				url: 'Tab/search',
				data: {
					type: type,
					band: band,
					song: song,
					limit: limit,
					offset: offset
				}
			});
		},
		getSearchTotal: function (type, band, song){
			return $http({
				method: 'POST',
				url: 'Tab/getSearchTotal',
				data: {
					type: type,
					band: band,
					song: song
				}
			});
		}
	};
});
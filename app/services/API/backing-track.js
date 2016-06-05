app.factory('BackingTrackService', function($http) {
	return {
		search: function(band, song) {
			return $http({
				method: 'POST',
				url: 'BackingTrack/search',
				data: {
					band: band,
					song: song
				}
			});
		}
	};
});
app.factory('BackingTrackService', function($http) {
	return {
		search: function(band, song) {
			return $http({
				method: 'POST',
				url: 'API/BackingTrack/search',
				data: {
					band: band,
					song: song
				}
			});
		},
		getMP3: function (link){
			return $http({
				method: 'POST',
				url: 'API/BackingTrack/getMP3',
				data: {
					link: link
				}
			});
		}
	};
});
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
		autocomplete: function(type, term, band) {
			return $http({
				method: 'POST',
				url: 'Tab/autocomplete',
				data: {
					type: type,
					term: term,
					band: band
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
		},
		getTabsByUploader: function (uploaderId, limit, offset){
			return $http({
				method: 'POST',
				url: 'Tab/getTabsByUploader',
				data: {
					uploader_id: uploaderId,
					limit: limit,
					offset: offset
				}
			});
		},
		getTotalTabsByUploader: function (uploaderId){
			return $http({
				method: 'POST',
				url: 'Tab/getTotalTabsByUploader',
				data: {
					uploader_id: uploaderId
				}
			});
		},
		getTab: function (id){
			return $http({
				method: 'POST',
				url: 'Tab/getTab',
				data: {
					id: id
				}
			});
		},
		rateTab: function (tabId, rating){
			return $http({
				method: 'POST',
				url: 'Tab/rateTab',
				data: {
					tab_id: tabId,
					rating: rating
				}
			});
		},
		addTab: function (formData){
			var url = '';
			
			if(formData.get('type') === 'gp'){
				url = 'Tab/addGpTab';
			}else{
				url = 'Tab/addTextTab';
			}
			
			return $http({
				method: 'POST',
				url: url,
				headers: {
					'Content-Type': undefined 
				},
				data: formData
			});
		}
	};
});
app.filter('tabContentType', function () {
	return function (tabType) {

		var tabContentTypes = {
			'full song': 'Цяла песен',
			intro: 'интро',
			solo: 'соло'
		};
		
		if(angular.isUndefined(tabContentTypes[tabType])){
			return tabType;
		}else{
			return tabContentTypes[tabType];
		}

	};
});
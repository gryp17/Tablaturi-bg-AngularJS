app.filter('tabType', function () {
	return function (tabType) {

		var tabTypes = {
			tab: "Tab",
			gp: "Guitar Pro",
			chord: "Акорди",
			bt: "Backing Track",
			bass: "Bass"
		};
		
		if(angular.isUndefined(tabTypes[tabType])){
			return tabType;
		}else{
			return tabTypes[tabType];
		}

	};
});
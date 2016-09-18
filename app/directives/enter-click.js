app.directive('enterClick', function() {
	return {
		restrict: 'A',
		scope: {
			enterClick: '&'
		},
		link: function(scope, element) {
			element.on('keyup', function(e) {				
				if (e.which === 13){
					scope.enterClick();
					scope.$apply();
				}
			});
		}
	};
}); 
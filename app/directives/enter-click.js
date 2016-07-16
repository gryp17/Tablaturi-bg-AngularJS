app.directive('enterClick', function() {
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
			element.on('keypress', function(e) {
				if (e.which === 13){
					$(attrs.enterClick).click();					
				}
			});
		}
	};
}); 
app.directive('validation', function() {
	return {
		restrict: 'C',
		link: function(scope, element, attrs) {
			element.on('focus click keypress', function (){
				element.closest('.field-box').removeClass('error');
			});
		}
	};
});
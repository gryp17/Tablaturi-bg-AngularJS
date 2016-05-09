app.directive('clickableEmoticon', function() {
	return {
		restrict: 'C',
		scope: {
			model: '='
		},
		link: function(scope, element, attrs) {
			element.on('click', function (){
				if(angular.isUndefined(scope.model)){
					scope.model = attrs.title;
				} else {
					scope.model =  scope.model + ' ' + attrs.title;
				}
				scope.$apply();
			});
		}
	};
});
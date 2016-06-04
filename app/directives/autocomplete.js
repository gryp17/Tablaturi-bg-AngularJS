app.directive('autocomplete', function(TabService) {
	return {
		restrict: 'A',
		scope: {
		    autocomplete: '@'
		},
		link: function(scope, element, attrs) {
			element.autocomplete({
				minLength: 1,
				delay: 300,
				source: function(request, responseCallback) {
					TabService.autocomplete(scope.autocomplete, request.term).then(function (result){
						//pass the data to the jqueryUI responseCallback function
						responseCallback(result.data.data);
					});
				}
			});
		}
	};
});
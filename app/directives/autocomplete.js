app.directive('autocomplete', function(TabService) {
	return {
		restrict: 'A',
		scope: {
		    autocomplete: '@', //band | song
			band: '=' //optional parameter that is used when autocompleting the 'song' field 
		},
		link: function(scope, element, attrs) {
			element.autocomplete({
				minLength: 1,
				delay: 300,
				source: function(request, responseCallback) {
					TabService.autocomplete(scope.autocomplete, request.term, scope.band).then(function (result){
						//pass the data to the jqueryUI responseCallback function
						responseCallback(result.data.data);
					});
				}
			});
		}
	};
});
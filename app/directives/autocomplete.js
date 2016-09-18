app.directive('autocomplete', function($parse, TabService) {
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function(scope, element, attrs) {
			//attrs.autocomplete: band|song
			//atrtrs.band: optional parameter that is used when autocompleting the 'song' field 
			
			//model accesor used to modify the ng-model manually
			var modelAccessor = $parse(attrs.ngModel);
			
			element.autocomplete({
				minLength: 1,
				delay: 300,
				source: function(request, responseCallback) {
					TabService.autocomplete(attrs.autocomplete, request.term, attrs.band).then(function (result){
						//pass the data to the jqueryUI responseCallback function
						responseCallback(result.data.data);
					});
				},
				//on autocomplete item focus - change the ng-model value manually via magic 
				focus: function (event, ui){
					scope.$apply(function (scope) {
                        modelAccessor.assign(scope, ui.item.value);
                    });
				}
			});
		}
	};
});
   
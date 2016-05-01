app.directive("validation", function() {
	return {
		restrict: "C",
		link: function(scope, element, attrs) {
			element.on("focus", function (){
				element.parent(".field-box").removeClass("error");
			});
		}
	};
});
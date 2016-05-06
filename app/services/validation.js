app.factory('ValidationService', function($filter) {
	return {
		showError: function(field, errorCode) {
			var errorMessage = $filter("errors")(errorCode);
			var fieldBox = $("input[name='" + field + "'], textarea[name='" + field + "'], select[name='" + field + "']").closest(".field-box");
			fieldBox.find(".error-msg").html(errorMessage);
			fieldBox.addClass("error");
		}
	};
});
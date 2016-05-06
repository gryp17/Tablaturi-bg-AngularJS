app.controller("signupController", function($scope) {

	$("#signup-datepicker").datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: "1940:" + new Date().getFullYear(),
		maxDate: "-1D",
		monthNamesShort: ["Януари", "Февруари", "Март", "Април", "Май", "Юни", "Юли", "Август", "Септември", "Октомври", "Ноември", "Декември"],
		dayNamesMin: ["Нед", "Пон", "Вт", "Ср ", "Чет", "Пет", "Съб"],
		firstDay: 1,
		dateFormat: "dd-mm-yy"
	});
	
	
	//jquery-ui/bootstrap datepicker hack
	var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;
	$.fn.modal.Constructor.prototype.enforceFocus = function() {};
	$("#signup-modal").on('hidden', function() {
		$.fn.modal.Constructor.prototype.enforceFocus = enforceModalFocusFn;
	});
	//$("#signup-modal").modal({ backdrop : false });
	
});
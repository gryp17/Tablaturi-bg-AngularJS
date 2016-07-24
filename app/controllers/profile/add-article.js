app.controller('addArticleController', function ($scope, $location, ArticleService, ValidationService) {
	
	/**
	 * Opens the hidden file input
	 */
	$scope.browse = function() {
		$('.image').click();
	};
	
	/*
	 * On image file change generate article image preview
	 */
	$('.image').change(function(event) {		
		var file = event.target.files[0];
		
		// Check image extensions
		if(/image\/(jpe?g|png)/i.test(file.type) === false){
			ValidationService.showError('image', 'invalid_file_extension');
		} else {
			// Check image size
			if((file.size / 1024) > 1000) {
				ValidationService.showError('image', 'exceeds_max_file_size');
			} else {
				$('#add-article-form .article-image').attr('src', URL.createObjectURL(event.target.files[0]));
			}
		}
	});
	
	$('#add-article-datepicker').datetimepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1940:' + new Date().getFullYear(),
		monthNamesShort: ['Януари', 'Февруари', 'Март', 'Април', 'Май', 'Юни', 'Юли', 'Август', 'Септември', 'Октомври', 'Ноември', 'Декември'],
		dayNamesMin: ['Нед', 'Пон', 'Вт', 'Ср ', 'Чет', 'Пет', 'Съб'],
		firstDay: 1,
		dateFormat: 'yy-mm-dd',
		timeFormat: 'HH:mm:ss',
		hour: new Date().getHours(),
		minute: new Date().getMinutes(),
		second: new Date().getSeconds()
	});
	
	/**
	 * Callback function that is called when the publish button is pressed
	 */
	$scope.addArticle = function() {
		var formData = new FormData(document.getElementById('add-article-form'));
		
		ArticleService.addArticle(formData).success(function (result){
			if (result.status === 0) {
				if (result.error) {
					//show the error
					ValidationService.showError(result.error.field, result.error.error_code);
				}
			} else {
				//redirect to the newly created article
				$location.path('/article/'+result.data.article_id);
			}
		});
	};
	
	
});
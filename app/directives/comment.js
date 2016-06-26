app.directive('comment', function() {
	return {
		restrict: 'A',
		templateUrl: 'app/views/directives/comment.php',
		scope: {
		    commentData: '='
		}
	};
});
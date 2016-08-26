app.directive('starsRating', function() {
	return {
		restrict: 'A',
		templateUrl: 'app/views/directives/stars-rating.php',
		replace: true,
		scope: {
			callback: '&'
		},
		link: function(scope, element, attrs) {
			
			scope.stars = [
				{
					text: 'Зле',
					filled: false
				},
				{
					text: 'Слабо',
					filled: false
				},
				{
					text: 'Бива',
					filled: false
				},
				{
					text: 'Доста добре',
					filled: false
				},
				{
					text: 'Супер!',
					filled: false
				}
			];
			
			/**
			 * Fills all stars up to the provided index and shows the selected star text
			 * @param {int} index
			 */
			scope.highlightStar = function (index){
				
				//set the correct star text
				scope.selectedStarText = scope.stars[index].text;
				
				//fill/unfill the stars
				scope.stars = scope.stars.map(function (star, currentIndex){
					if(currentIndex <= index){
						star.filled = true;
					}else{
						star.filled = false;
					}
					return star;
				});
			};
			
			/**
			 * Selects the provided index and calls the callback
			 * @param {int} index
			 */
			scope.selectStar = function (index){
				scope.callback({rating: index + 1});
			};

		}
	};
});
app.directive('starsRating', function() {
	return {
		restrict: 'A',
		templateUrl: 'app/views/directives/stars-rating.php',
		replace: true,
		scope: {
			currentRating: '@',
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
			
			scope.$watch('currentRating', function (){
				//if the currentRating is set - fill the stars
				if(angular.isDefined(scope.currentRating)){	
					var starIndex = Math.round(scope.currentRating) - 1;
					scope.highlightStar(starIndex, false);
				}
			});
			
			/**
			 * Fills all stars up to the provided index and shows the selected star text
			 * @param {int} index
			 */
			scope.highlightStar = function (index, showStarText){
				
				if(showStarText){
					//set the correct star text
					scope.selectedStarText = scope.stars[index].text;
				}
				
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
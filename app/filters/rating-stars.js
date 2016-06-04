app.filter('ratingStars', function() {
	return function(rating) {
		var result = [];
		var stars = Math.floor(rating);

		//generates an array of integers based on the tab rating
		//1 - star
		//0 - empty star
		for (var i = 1; i <= 5; i++) {
			if (i <= stars) {
				result.push(1);
			} else {
				result.push(0);
			}
		}

		return result;
	};
});
"use strict";

app.controller("homeController", function($scope, ArticleService) {
	
	ArticleService.getArticles(6, 0).success(function(result) {
		if(result.error) {
			console.log(result.error);
		} else {
			$scope.articles = result.data;
		}
	});

	//get articles by date
//	$http({
//		method: 'POST',
//		url: 'API/getArticlesByDate',
//		data: {
//			date: "2014-08-30",
//			limit: 5,
//			offset: 0
//		}
//	}).then(function(response) {
//		console.log(response);
//	});

});
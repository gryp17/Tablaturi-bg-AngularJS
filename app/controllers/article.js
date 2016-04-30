"use strict";

app.controller("articleController", function($scope, ArticleService, LoadingService) {

	console.log("article controller");
	
	LoadingService.doneLoading();

});
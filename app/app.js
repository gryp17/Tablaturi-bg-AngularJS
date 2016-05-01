"use strict";

var app = angular.module("tablaturi-bg", ['ngRoute', 'ngSanitize']);

app.config(['$routeProvider', function($routeProvider) {

		$routeProvider.when("/home", {
			templateUrl: "app/views/partials/home.php",
			controller: "homeController"
		}).when('/article/:id', {
			templateUrl: 'app/views/partials/article.php',
			controller: "articleController"
		}).when('/contact-us', {
			templateUrl: 'app/views/partials/contact-us.php',
			controller: "contactusController"
		}).otherwise({
			templateUrl: 'app/views/partials/home.php',
			controller: "homeController"
		});
	}]);


app.run(function($rootScope, $location, $http, LoadingService) {

	$rootScope.$on("$routeChangeStart", function(event, next, current) {

		//static pages that don't need loading indicator
		var staticPages = [
			"/contact-us"
		];
		
		if (next.$$route) {
			//if the page that is about to be loaded is not in the static pages list...
			if(staticPages.indexOf(next.$$route.originalPath) < 0){
				LoadingService.startLoading();
			}
		}else{
			LoadingService.showLoadingPlaceholder();
		}

		//TODO: authentication
		$rootScope.authenticated = false;

		//call the backend to check if the session is set...
		if (false) {
			$rootScope.authenticated = true;
			//get the logged user data and save it in the $rootScope...
			//$rootScope.user = "plamen";
			console.log("authenticated")
		} else {
			if (next.$$route) {
				var nextUrl = next.$$route.originalPath;
				console.log(nextUrl);
				//$location.path("/home");
			}
		}

	});

});

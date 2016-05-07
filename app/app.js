'use strict';

var app = angular.module('tablaturi-bg', ['ngRoute', 'ngSanitize']);

app.config(['$routeProvider', function($routeProvider) {

		$routeProvider.when('/home', {
			templateUrl: 'app/views/partials/home.php',
			controller: 'homeController'
		}).when('/articles', {
			templateUrl: 'app/views/partials/articles.php',
			controller: 'articlesController'
		}).when('/article/:id', {
			templateUrl: 'app/views/partials/article.php',
			controller: 'articleController'
		}).when('/guitar-pro', {
			templateUrl: 'app/views/partials/guitar-pro.php'
		}).when('/contact-us', {
			templateUrl: 'app/views/partials/contact-us.php',
			controller: 'contactusController'
		}).when('/copyright', {
			templateUrl: 'app/views/partials/copyright.php'
		}).otherwise({
			templateUrl: 'app/views/partials/home.php',
			controller: 'homeController'
		});
	}]);


app.run(function($rootScope, $location, $http, LoadingService, UserService) {

	$rootScope.$on('$routeChangeStart', function(event, next, current) {

		//pages that require login
		var securePages = [
			'/profile/:id'
		];

		//static pages that don't need loading indicator
		var staticPages = [
			'/contact-us',
			'/guitar-pro',
			'/copyright'
		];
		
		if (next.$$route) {
			//if the page that is about to be loaded is not in the static pages list...
			if(staticPages.indexOf(next.$$route.originalPath) < 0){
				LoadingService.startLoading();
			} else {
				LoadingService.doneLoading();
			}
		}else{
			LoadingService.showLoadingPlaceholder();
		}
		
		$rootScope.checkingLoginStatus = true;

		//authentication check
		UserService.isLoggedIn().success(function (result){
			$rootScope.checkingLoginStatus = false;
			
			if(result.data.logged_in === true){
				$rootScope.loggedInUser = result.data.user;
			}else{
				$rootScope.loggedInUser = undefined;
				
				if (next.$$route) {
					var nextUrl = next.$$route.originalPath;
					//if the user is trying to open a secure page and is not logged in - redirect to the home page
					if(securePages.indexOf(nextUrl) > -1){
						$location.path('/');
					}
				}	
			}
		});
		
		/*
		$rootScope.authenticated = false;
		//call the backend to check if the session is set...
		if (false) {
			$rootScope.authenticated = true;
			//get the logged user data and save it in the $rootScope...
			//$rootScope.user = 'plamen';
			console.log('authenticated')
		} else {
			if (next.$$route) {
				var nextUrl = next.$$route.originalPath;
				console.log(nextUrl);
				//$location.path('/home');
			}
		}*/

	});

});

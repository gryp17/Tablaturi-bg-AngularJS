'use strict';

var app = angular.module('tablaturi-bg', ['ngRoute', 'ngSanitize']);

/**
 * Checks if the user is logged in
 */
function checkAuth ($rootScope, $q, $location, UserService) {
	var deferred = $q.defer();

	UserService.isLoggedIn().then(function(result) {
		if (result.data.data.logged_in === true) {
			$rootScope.loggedInUser = result.data.data.user;
			deferred.resolve(true);
		} else {
			$rootScope.loggedInUser = undefined;
			$location.path('/forbidden');
			deferred.reject();
		}
	});

	return deferred.promise;
}

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
		}).when('/profile/:id', {
			templateUrl: 'app/views/partials/profile.php',
			controller: 'profileController',
			resolve: {
				factory: checkAuth
            }
		}).when('/tabs', {
			templateUrl: 'app/views/partials/tabs.php',
			controller: 'tabsController'
		}).when('/guitar-pro', {
			templateUrl: 'app/views/partials/guitar-pro.php'
		}).when('/usefull', {
			templateUrl: 'app/views/partials/usefull.php'
		}).when('/contact-us', {
			templateUrl: 'app/views/partials/contact-us.php',
			controller: 'contactusController'
		}).when('/copyright', {
			templateUrl: 'app/views/partials/copyright.php'
		}).when('/forbidden', {
			templateUrl: 'app/views/partials/forbidden.php'
		}).otherwise({
			templateUrl: 'app/views/partials/home.php',
			controller: 'homeController'
		});
	}]);


app.run(function($rootScope, LoadingService) {

	$rootScope.$on('$routeChangeStart', function(event, next, current) {

		//static pages that don't need loading indicator
		var staticPages = [
			'/contact-us',
			'/guitar-pro',
			'/usefull',
			'/copyright',
			'/forbidden'
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
		
	});

});

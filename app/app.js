'use strict';

var app = angular.module('tablaturi-bg', ['ngRoute', 'ngSanitize']);

/**
 * Checks if the user is logged in.
 * Redirects to the /forbidden page if the user is not logged in
 */
function checkAuth ($rootScope, $q, $location, UserService) {
	var deferred = $q.defer();
	$rootScope.authInProgress = true;

	UserService.isLoggedIn().then(function(result) {
		if (result.data.data.logged_in === true) {
			$rootScope.loggedInUser = result.data.data.user;
			deferred.resolve(true);
		} else {
			$rootScope.loggedInUser = undefined;
			$location.path('/forbidden');
			deferred.reject();
		}
		
		$rootScope.authInProgress = false;
	});

	return deferred.promise;
}

/**
 * Updates the user login status
 */
function updateAuth ($rootScope, $q, $location, UserService){
	var deferred = $q.defer();
	$rootScope.authInProgress = true;

	UserService.isLoggedIn().then(function(result) {
		if (result.data.data.logged_in === true) {
			$rootScope.loggedInUser = result.data.data.user;
		} else {
			$rootScope.loggedInUser = undefined;
		}
		
		$rootScope.authInProgress = false;
		deferred.resolve(true);
	});

	return deferred.promise;
}

app.config(['$routeProvider', function($routeProvider) {

		$routeProvider.when('/home', {
			templateUrl: 'app/views/partials/home.php',
			controller: 'homeController',
			resolve: {
				factory: updateAuth
            }
		}).when('/articles', {
			templateUrl: 'app/views/partials/articles.php',
			controller: 'articlesController',
			resolve: {
				factory: updateAuth
            }
		}).when('/article/:id', {
			templateUrl: 'app/views/partials/article.php',
			controller: 'articleController',
			resolve: {
				factory: updateAuth
            }
		}).when('/profile/:id', {
			templateUrl: 'app/views/partials/profile.php',
			controller: 'profileController',
			resolve: {
				factory: checkAuth
            }
		}).when('/tabs', {
			templateUrl: 'app/views/partials/tabs.php',
			controller: 'tabsController',
			resolve: {
				factory: updateAuth
            }
		}).when('/guitar-pro', {
			templateUrl: 'app/views/partials/guitar-pro.php',
			resolve: {
				factory: updateAuth
            }
		}).when('/usefull', {
			templateUrl: 'app/views/partials/usefull.php',
			resolve: {
				factory: updateAuth
            }
		}).when('/contact-us', {
			templateUrl: 'app/views/partials/contact-us.php',
			controller: 'contactusController',
			resolve: {
				factory: updateAuth
            }
		}).when('/copyright', {
			templateUrl: 'app/views/partials/copyright.php',
			resolve: {
				factory: updateAuth
            }
		}).when('/forbidden', {
			templateUrl: 'app/views/partials/forbidden.php',
			resolve: {
				factory: updateAuth
            }
		}).otherwise({
			templateUrl: 'app/views/partials/home.php',
			controller: 'homeController',
			resolve: {
				factory: updateAuth
            }
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

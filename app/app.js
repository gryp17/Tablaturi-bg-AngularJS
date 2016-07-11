'use strict';

var app = angular.module('tablaturi-bg', ['ngRoute', 'ngSanitize']);

/**
 * Checks if the user is logged in.
 * Redirects to the /forbidden page if the user is not logged in
 */
function authRequired ($rootScope, $q, $location, UserService) {
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
function updateAuthStatus ($rootScope, $q, UserService){
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
				factory: updateAuthStatus
            }
		}).when('/articles', {
			templateUrl: 'app/views/partials/articles.php',
			controller: 'articlesController',
			resolve: {
				factory: updateAuthStatus
            }
		}).when('/article/:id', {
			templateUrl: 'app/views/partials/article.php',
			controller: 'articleController',
			resolve: {
				factory: updateAuthStatus
            }
		}).when('/profile/:id', {
			templateUrl: 'app/views/partials/profile/user-panel.php',
			resolve: {
				factory: authRequired
            }
		}).when('/tabs', {
			templateUrl: 'app/views/partials/tabs.php',
			controller: 'tabsController',
			resolve: {
				factory: updateAuthStatus
            }
		}).when('/search/:type/:band?/:song?', {
			templateUrl: 'app/views/partials/search.php',
			controller: 'searchController',
			resolve: {
				factory: updateAuthStatus
            }
		}).when('/search-backing-tracks/:type/:band?/:song?', {
			templateUrl: 'app/views/partials/search-backing-tracks.php',
			controller: 'searchBackingTracksController',
			resolve: {
				factory: updateAuthStatus
            }
		}).when('/guitar-pro', {
			templateUrl: 'app/views/partials/guitar-pro.php',
			resolve: {
				factory: updateAuthStatus
            }
		}).when('/usefull', {
			templateUrl: 'app/views/partials/usefull.php',
			resolve: {
				factory: updateAuthStatus
            }
		}).when('/contact-us', {
			templateUrl: 'app/views/partials/contact-us.php',
			controller: 'contactusController',
			resolve: {
				factory: updateAuthStatus
            }
		}).when('/copyright', {
			templateUrl: 'app/views/partials/copyright.php',
			resolve: {
				factory: updateAuthStatus
            }
		}).when('/forbidden', {
			templateUrl: 'app/views/partials/forbidden.php',
			resolve: {
				factory: updateAuthStatus
            }
		}).otherwise({
			templateUrl: 'app/views/partials/home.php',
			controller: 'homeController',
			resolve: {
				factory: updateAuthStatus
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

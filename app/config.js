app.config(['$routeProvider', function($routeProvider) {

	$routeProvider.when('/', {
		templateUrl: 'app/views/partials/home.php',
		controller: 'homeController',
		resolve: {
			factory: updateAuthStatus
		}
	}).when('/home', {
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
		templateUrl: 'app/views/partials/article/article.php',
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
	}).when('/tab/:id', {
		templateUrl: 'app/views/partials/tab/tab.php',
		controller: 'tabController',
		resolve: {
			factory: updateAuthStatus
		}
	}).when('/add-tab', {
		templateUrl: 'app/views/partials/add-tab.php',
		controller: 'addTabController',
		resolve: {
			factory: authRequired
		}
	}).when('/edit-tab/:id', {
		templateUrl: 'app/views/partials/edit-tab.php',
		controller: 'editTabController',
		resolve: {
			factory: authRequired
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
	}).when('/not-found', {
		templateUrl: 'app/views/partials/not-found.php',
		resolve: {
			factory: updateAuthStatus
		}
	}).otherwise({
		resolve: {
			factory: redirectTab
		}
	});
}]);


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

/**
 * Checks if the url matches the old tab's url and redirects to the new url
 * Otherwise it redirects to the "home" or "not-found" pages
 */
function redirectTab ($window, $q, $location) {
	var deferred = $q.defer();
	
	var url = $window.location.href;
	var match;
	
	if(match = /tab\.php\?id=(\d+)/i.exec(url)){
		var id = match[1];
		var path = $window.location.pathname;
		path = path.replace(/tab\.php.*/i, '#/tab/'+id);
		$window.location.pathname = path;
		deferred.reject();
	}else{
		
		if($location.path() === ''){
			$location.path('/home');
		}else{
			$location.path('/not-found');
		}
		
		deferred.reject();
	}
	
	return deferred.promise;
}
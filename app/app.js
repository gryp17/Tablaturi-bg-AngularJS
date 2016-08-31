'use strict';

var app = angular.module('tablaturi-bg', ['ngRoute', 'ngSanitize']);

app.run(function($rootScope, LoadingService) {
	
	$rootScope.$on('$routeChangeStart', function(event, next, current) {

		//static pages that don't need loading indicator
		var staticPages = [
			'/contact-us',
			'/guitar-pro',
			'/usefull',
			'/add-tab',
			'/copyright',
			'/forbidden',
			'/not-found'
		];
		
		if (next.$$route) {			
			//if the page that is about to be loaded is not in the static pages list...
			if(staticPages.indexOf(next.$$route.originalPath) < 0){
				LoadingService.startLoading();
			} else {
				LoadingService.doneLoading();
			}
		}else{
			//LoadingService.showLoadingPlaceholder();
		}
		
	});

});

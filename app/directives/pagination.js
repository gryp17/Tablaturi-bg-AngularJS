app.directive('pagination', function() {
	return {
		restrict: 'C',
		templateUrl: 'app/views/directives/pagination.php',
		replace: true,
		scope: {
			limit: '=',
			offset: '=',
			totalItems: '=',
			range: '=',
			callback: '&'
		},
		link: function(scope, element, attrs) {
			
			//initialize the pagination when scope.totalItems is set
			scope.$watch('totalItems', function (){
				if(angular.isDefined(scope.totalItems)){
					
					//initialize the currentPage if it's not set yet
					if(angular.isUndefined(scope.currentPage)){
						scope.currentPage = 1;
					}

					scope.totalPages = Math.ceil(scope.totalItems / scope.limit);
					scope.generatePages();
				}
			});
			
			/**
			 * Calculates the number of visible pages (it's a magic)
			 */
			scope.generatePages = function (){
				scope.pages = [];
				for (var i = (scope.currentPage - scope.range); i < (scope.currentPage + scope.range) + 1; i++) {
					if ((i > 0) && (i <= scope.totalPages)) {
						scope.pages.push(i);
					}
				}
			};
			
			/**
			 * Changes the current page
			 * @param {int} page
			 */
			scope.goTo = function(page){
				scope.currentPage = page;
				scope.generatePages();
				scope.getPageData();
			};
			
			/**
			 * Sets the first page as current page
			 */
			scope.goToFirst = function (){
				scope.currentPage = 1;
				scope.generatePages();
				scope.getPageData();
				
			};
			
			/**
			 * Sets the last page as current page
			 */
			scope.goToLast = function (){
				scope.currentPage = scope.totalPages;
				scope.generatePages();
				scope.getPageData();
			};
			
			/**
			 * Sets the previous page as current page
			 */
			scope.goToPrevious = function (){
				if(scope.currentPage > 1){
					scope.currentPage = scope.currentPage - 1;
					scope.generatePages();
					scope.getPageData();
				}
			};
			
			/**
			 * Sets the next page as current page
			 */
			scope.goToNext = function (){
				if(scope.currentPage < scope.totalPages){
					scope.currentPage = scope.currentPage + 1;
					scope.generatePages();
					scope.getPageData();
				}
			};
			
			/**
			 * Calls the specified callback with the new offset
			 */
			scope.getPageData = function (){
				scope.offset = (scope.currentPage - 1) * scope.limit;
				scope.callback({limit: scope.limit, offset: scope.offset});
			};
			
		}
	};
});
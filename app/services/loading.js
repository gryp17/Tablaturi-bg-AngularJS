app.factory('LoadingService', function() {
	
	var contentElement = "#view-wrapper";
	var loadingElement = "#content-wrapper > .loading-placeholder";
	
	return {
		/**
		 * Shows the loading placeholder
		 */
		showLoadingPlaceholder: function (){
			$(loadingElement).fadeIn(0);
		},
		/**
		 * Hides the loading placeholder
		 */
		hideLoadingPlaceholder: function (){
			$(loadingElement).fadeOut(0);
		},
		/**
		 * Shows the ng-view content
		 */
		showContent: function (){
			$(contentElement).css("visibility", "visible");
		},
		/**
		 * Hides the ng-view content
		 */
		hideContent: function (){
			$(contentElement).css("visibility", "hidden");
		},
		/**
		 * Hides the ng-view content and shows the loading placeholder
		 */
		startLoading: function() {
			this.hideContent();
			this.showLoadingPlaceholder();
		},
		/**
		 * Hides the loading placeholder and shows the ng-view content
		 */
		doneLoading: function() {
			this.hideLoadingPlaceholder();
			this.showContent();
		}
	};
});
<div>
	<div class="page first" ng-click="goToFirst()" ng-class="{disabled: currentPage === 1}">
		<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
		<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
	</div>
	<div class="page" ng-click="goToPrevious()" ng-class="{disabled: currentPage === 1}">
		<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
	</div>
	
	<div ng-repeat="page in pages" class="page" ng-click="goTo(page)" ng-class="{active: currentPage === page}">
		{{page}}
	</div>
	
	<div class="page" ng-click="goToNext()" ng-class="{disabled: currentPage === totalPages}">
		<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
	</div>
	<div class="page last" ng-click="goToLast()" ng-class="{disabled: currentPage === totalPages}">
		<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
		<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
	</div>
</div>
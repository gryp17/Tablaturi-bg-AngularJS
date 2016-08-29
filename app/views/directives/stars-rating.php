<div class="stars-rating">
	<div ng-repeat="star in stars track by $index" 
		 ng-mouseover="highlightStar($index, true)" ng-click="selectStar($index)" 
		 class="star-icon" ng-class="{'star': star.filled, 'empty-star': !star.filled}">
	</div>
	<div class="rating-text" ng-bind="selectedStarText"></div>
</div>
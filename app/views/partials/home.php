<div class="home" ng-controller="homeController">
	<h2 class="title">Новини:</h2>
	<div class="row">
		<div class="col-xs-6" ng-repeat="article in articles">
			<div article article-data="article"></div>
		</div>
	</div>
	<div class="view-all">
		<a href="#news">Виж всички новини</a>
	</div>
</div>
<div class="articles">
	<h2 class="title">Новини:</h2>
	<div class="row">
		<div class="col-xs-6" ng-repeat="article in articles track by article.ID">
			<div article article-data="article"></div>
		</div>
	</div>
	<div ng-show="!noMoreArticles" class="view-more">
		<button ng-click="offset = offset + 6; loadArticles(limit, offset)" class="btn btn-red">Покажи още новини</button>
	</div>
</div>
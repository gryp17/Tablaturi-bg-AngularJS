<article class="news-article">
	<div class="date" ng-bind="articleData.date | date: 'yyyy-MM-dd HH:mm'"></div>
	<div class="image" ng-style="{'background-image': 'url(content/articles/'+ articleData.picture + ')'}" ng-click="open(articleData.ID)">
		
	</div>
	<div class="content">
		<h3>
			<a href="#article/{{articleData.ID}}" ng-attr-title="{{articleData.title}}">{{articleData.title}}</a>
		</h3>
		<div class="short" ng-bind-html="articleData.content">
		</div>
		<a href="#article/{{articleData.ID}}" class="btn btn-red" type="button">Прочети още</a>
	</div>
</article>
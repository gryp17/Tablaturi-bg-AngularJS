<article class="news-article">
	<div class="image" ng-style="{'background-image': 'url(content/articles/'+ articleData.picture + ')'}">
		<div class="date">
			{{articleData.date | date: 'yyyy-MM-dd HH:mm'}}
		</div>
	</div>
	<div class="content">
		<h3>{{articleData.title}}</h3>
		<div class="short" ng-bind-html="articleData.content">
		</div>
		<a href="#article/{{articleData.ID}}" class="btn btn-red" type="button">Прочети още</a>
	</div>
</article>
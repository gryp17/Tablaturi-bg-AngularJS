<div class="comment">
	<img class="user-image img-circle" ng-src="content/avatars/{{commentData.photo}}"/>
	<div class="box">
		<div class="author">
			<a class="red-link" title="Виж профила на {{commentData.username}}" href="#profile/{{commentData.author_ID}}" ng-bind="commentData.username"></a> каза:
		</div>
		<div class="date" ng-bind="commentData.date | date : 'yyyy-MM-dd HH:mm:ss'"></div>
		<div class="content" ng-bind-html="commentData.content | emoticons"></div>
	</div>
	<div class="clearfix"></div>
</div>
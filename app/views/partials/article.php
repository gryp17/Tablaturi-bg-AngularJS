<div class="article">
	<div class="article-wrapper">
		<div class="date" ng-bind="article.date | date : 'yyyy-MM-dd HH:mm:ss'"></div>
		<div class="views" ng-bind="'Преглеждания: ' +article.views"></div>
		<div class="author">
			от 
			<a class="red-link" title="Виж профила на {{article.username}}" href="#profile/{{article.author_ID}}" ng-bind="article.username"></a>
		</div>
		<div class="clearfix"></div>
		<img class="article-image" ng-src="content/articles/{{article.picture}}"/>
		<h2 class="title" ng-bind="article.title"></h2>
		<div class="content" ng-bind-html="article.content"></div>
		<div class="share">
			Сподели в: 
			<hr/>
			<span class='st_fblike_hcount' displayText='Facebook Like'></span>
			<span class='st_facebook_hcount' displayText='Facebook'></span>
			<span class='st_twitter_hcount' displayText='Tweet'></span>
			<span class='st_googleplus_hcount' displayText='Google +'></span>
		</div>
	</div>

	<div class="comments-wrapper">
		<h4 ng-show="articleComments.length > 0">Коментари:</h4>
		<h4 ng-show="articleComments.length === 0" class="no-comments">Няма коментари</h4>
		<div class="comment" ng-repeat="comment in articleComments">
			<img class="user-image img-circle" ng-src="content/avatars/{{comment.photo}}"/>
			<div class="box">
				<div class="author">
					<a class="red-link" title="Виж профила на {{comment.username}}" href="#profile/{{comment.author_ID}}" ng-bind="comment.username"></a> каза:
				</div>
				<div class="date" ng-bind="comment.date | date : 'yyyy-MM-dd HH:mm:ss'"></div>
				
				<div class="content" ng-bind="comment.content | emoticons"></div>
			</div>
			
			<div class="clearfix"></div>
		</div>
	</div>


</div>
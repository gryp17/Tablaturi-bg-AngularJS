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
				
				<div class="content" ng-bind-html="comment.content | emoticons"></div>
			</div>
			
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="add-comment-wrapper">
		<div ng-show="!loggedInUser" class="comment-login">
			<a href class="red-link">Регистрирай се</a> или <a href class="red-link">Влез</a> , за да коментираш
		</div>
		<div ng-show="loggedInUser" class="add-comment">
			<p>Напиши коментар:</p>			
			<div class="field-box">
				<textarea class="text-control validation emoticon-textarea" ng-model="commentContent" name="content" placeholder=""></textarea>
				<span class="error-msg"></span>
			</div>
			<div class="emoticons">
				<img class="emoticon clickable-emoticon" title=":)" model="commentContent" src="static/img/emoticons/smile.png">
				<img class="emoticon clickable-emoticon" title=":(" model="commentContent" src="static/img/emoticons/undecided.png">
				<img class="emoticon clickable-emoticon" title=":D" model="commentContent" src="static/img/emoticons/laugh.png">
				<img class="emoticon clickable-emoticon" title=":P" model="commentContent" src="static/img/emoticons/stickingout.png">
				<img class="emoticon clickable-emoticon" title="8-)" model="commentContent" src="static/img/emoticons/hot.png">
				<img class="emoticon clickable-emoticon" title="|-(" model="commentContent" src="static/img/emoticons/ambivalent.png">
				<img class="emoticon clickable-emoticon" title=":O" model="commentContent" src="static/img/emoticons/largegasp.png">
				<img class="emoticon clickable-emoticon" title="(up)" model="commentContent" src="static/img/emoticons/thumbsup.png">
				<img class="emoticon clickable-emoticon" title="(down)" model="commentContent" src="static/img/emoticons/thumbsdown.png">
				<img class="emoticon clickable-emoticon" title=":@" model="commentContent" src="static/img/emoticons/veryangry.png">
			</div>
			<button ng-click="addComment()" class="btn btn-red">Коментирай</button>
		</div>
	</div>


</div>
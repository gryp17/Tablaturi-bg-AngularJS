<div class="tab">

	<div class="tab-info">
		<!-- left -->
		<div class="left">
			<div class="title">
				<a class="red-link" href="#search/all/{{tab.band}}//">{{tab.band}}</a> - {{tab.song}}
			</div>
			<div class="author">

				<span ng-if="tab.upload_date === tab.modified_date">
					качена от 
				</span>
				<span ng-if="tab.upload_date !== tab.modified_date">
					обновена от 
				</span>

				<a class="red-link" href="#profile/{{tab.uploader_ID}}">{{tab.username}}</a>
				на 
				{{tab.modified_date | date: "yyyy-MM-dd 'в' HH:mm"}}

			</div>

			<table class="table table-striped">
				<tr>
					<td>
						<span class="info-label">Тип:</span>
						{{tab.tab_type | tabContentType}}
					</td>
				</tr>
				<tr>
					<td>
						<span class="info-label">Тунинг:</span>
						{{tab.tunning || 'Няма информация'}}
					</td>
				</tr>
				<tr>
					<td>
						<span class="info-label">Трудност:</span>
						{{tab.difficulty || 'Няма информация'}}
					</td>
				</tr>
			</table>

		</div>
		<!-- right -->
		<div class="right">
			
			<!-- add to favourites button -->
			<button ng-if="favouriteTabs.indexOf(tab.ID) === -1" class="btn btn-red outline" ng-click="addToFavourites(tab.ID)">
				<span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Добави в любими
			</button>
			
			<!-- remove from favourites button -->
			<button ng-if="favouriteTabs.indexOf(tab.ID) !== -1" class="btn btn-red" ng-click="removeFromFavourites(tab.ID)">
				<span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Премахни от любими
			</button>
			
			<!-- report tab button -->
			<button class="btn btn-red outline" ng-click="openReportTabModal()">
				<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span> Докладвай
			</button>
			
			<div class="clearfix"></div>
			
			<div class="views">
				{{tab.downloads}} 
				<span ng-if="tab.downloads === 1">преглеждане</span>
				<span ng-if="tab.downloads !== 1">преглеждания</span>
			</div>
			
			<div class="rating">
				Оцени:
				<div stars-rating current-rating="{{tab.rating}}" callback="rateTab(rating)"></div>
			</div>
		
			
		</div>
	</div>
	<div class="tab-content">
		<hr/>
		
		<!-- guitar pro tab -->
		<div ng-if="tab.type === 'gp'" class="gp">
			<button class="btn btn-red download-button" ng-click="downloadGpTab(tab.ID)">
				<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
				Свали Guitar Pro таблатурата
			</button>
			
			<div class="hint">
				Таблатурата е тип Guitar Pro. За повече информация за програмата кликнете <a class="red-link" href="#guitar-pro">тук</a>.
			</div>
		</div>
		
		<!-- text tab -->
		<div ng-if="tab.type !== 'gp'" class="text">
			
			<div class="tools">
				<button class="btn btn-red" ng-click="zoom(1)">
					<span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
				</button>
				<button class="btn btn-red" ng-click="zoom(-1)">
					<span class="glyphicon glyphicon-zoom-out" aria-hidden="true"></span>
				</button>
			</div>
			
			<pre>
				{{tab.content}}
			</pre>
			
			<div class="download-text-wrapper">
				<button class="btn btn-red download-button" ng-click="downloadTextTab(tab.ID)">
					<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
					Свали като .txt
				</button>

				<div class="hint">
					Ако имате проблем с четенето на таблатурата, кликнете <a class="red-link" href="#usefull">тук</a> за да разгледате уроците за начинаещи.
				</div>
			</div>
			
		</div>
	</div>
	
	<div class="share">
		Сподели в: 
		<hr/>
		<span class='st_fblike_hcount' displayText='Facebook Like'></span>
		<span class='st_facebook_hcount' displayText='Facebook'></span>
		<span class='st_twitter_hcount' displayText='Tweet'></span>
		<span class='st_googleplus_hcount' displayText='Google +'></span>
	</div>

	<!-- comments wrapper -->
	<div class="comments-wrapper">
		<h4 ng-show="totalTabComments > 0">Коментари:</h4>
		<h4 ng-show="totalTabComments === 0" class="no-comments">Няма коментари</h4>
		<div ng-repeat="comment in tabComments" comment comment-data="comment"></div>

		<div class="pagination" total-items="totalTabComments" limit="limit" offset="offset" range="2" callback="getTabComments(limit, offset)"></div>
	</div>

	<!-- add comment wrapper -->
	<div class="add-comment-box">
		
		<div ng-show="!loggedInUser" class="comment-login">
			<a class="red-link" data-toggle="modal" href="#signup-modal" target="_self">Регистрирай се</a>
			или <a class="red-link" data-toggle="modal" href="#login-modal" target="_self">Влез</a>, за да коментираш
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
	
	<?php include "_report-tab.php" ?>
	
</div>
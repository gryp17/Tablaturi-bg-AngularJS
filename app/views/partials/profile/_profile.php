<div ng-controller="profileController" role="tabpanel" id="profile" class="tab-pane active">
	<div class="username">{{userData.username}} 
		<span ng-show="userData.type === 'admin'">(Админ)</span>
	</div>
	
	<button class="btn btn-red" ng-if="loggedInUser.ID === userData.ID" ng-click="">
		<img src="static/img/icons/pencil.png" /> Редактирай
	</button>
	
	<div class="clearfix"></div>
	
	<br/>
	
	<div>
		<img class="user-avatar img-circle" ng-src="content/avatars/{{userData.photo}}" />
		<div class="table-container">
			<table class="table table-striped">
				<tr>
					<td>
						<span class="info-label" ng-show="userData.gender === 'M'">Регистриран на:</span>
						<span class="info-label" ng-show="userData.gender === 'F'">Регистрирана на:</span>
						{{userData.register_date | date: "yyyy-MM-dd 'в' HH:mm"}}
					</td>
				</tr>
				<tr>
					<td>
						<span class="info-label" ng-show="userData.gender === 'M'">Последно активен на:</span>
						<span class="info-label" ng-show="userData.gender === 'F'">Последно активна на:</span>
						{{userData.last_active_date | date: "yyyy-MM-dd 'в' HH:mm"}}
					</td>
				</tr>
				<tr>
					<td>
						<span class="info-label">Възраст:</span>
						{{userData.birthday | age}} години
					</td>
				</tr>
				<tr>
					<td>
						<span class="info-label">Местоживеене:</span>
						{{userData.location || 'Няма информация'}}
					</td>
				</tr>
				<tr>
					<td>
						<span class="info-label">Професия:</span>
						{{userData.occupation || 'Няма информация'}}
					</td>
				</tr>
				<tr>
					<td>
						<span class="info-label">Web:</span>
						{{userData.web || 'Няма информация'}}
					</td>
				</tr>
			</table>
		</div>
	</div>
	
	<div class="reputation">
		<span class="info-label">Репутация:</span>
		{{userData.reputation}}
	</div>
	
	<div class="info-box">
		<div class="border"></div>
		<div class="info">
			<span class="info-label">За мен:</span>
			{{userData.about_me || 'Няма информация'}}
		</div>
	</div>
	
	<div class="info-box">
		<div class="border"></div>
		<div class="info">
			<span class="info-label">Инструменти/Екипировка:</span>
			{{userData.instrument || 'Няма информация'}}
		</div>
	</div>
	
	<div class="info-box">
		<div class="border"></div>
		<div class="info">
			<span class="info-label">Любими групи/музиканти:</span>
			{{userData.favourite_bands || 'Няма информация'}}
		</div>
	</div>
	
	<!-- comments wrapper -->
	<div class="comments-wrapper">
		<h4 ng-show="userComments.length > 0">Коментари:</h4>
		<h4 ng-show="userComments.length === 0" class="no-comments">Няма коментари</h4>
		<div ng-repeat="comment in userComments" comment comment-data="comment"></div>
		
		<div class="pagination" total-items="totalUserComments" limit="limit" offset="offset" range="2" callback="getUserComments(limit, offset)"></div>
	</div>
	
	<!-- add comment wrapper -->
	<div class="add-comment-box">
		<div class="add-comment">
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
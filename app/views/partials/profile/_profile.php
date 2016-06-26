<div ng-controller="profileController" role="tabpanel" id="profile" class="tab-pane active">
	<div class="username">{{userData.username}} 
		<span ng-show="userData.type === 'admin'">(Админ)</span>
	</div>
	<button class="btn btn-red" ng-if="loggedInUser.ID === userData.ID" ng-click="">
		<img src="static/img/icons/pencil.png" /> Редактирай
	</button>
	<div>
		<img class="user-image img-circle" ng-src="content/avatars/{{userData.photo}}" />
	</div>
	<br/><br/>
	{{userData | json}}
</div>
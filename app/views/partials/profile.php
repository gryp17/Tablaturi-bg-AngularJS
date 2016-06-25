<div class="profile">
	
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" target="_self">Профил</a>
		</li>
		<li role="presentation">
			<a href="#tabs" aria-controls="tabs" role="tab" data-toggle="tab" target="_self">Качени таблатури</a>
		</li>
		<li role="presentation">
			<a href="#favourites" aria-controls="favourites" role="tab" data-toggle="tab" target="_self">Любими таблатури</a>
		</li>
		<li role="presentation">
			<a href="#search" aria-controls="search" role="tab" data-toggle="tab" target="_self">Търси потребители</a>
		</li>
		<li role="presentation">
			<a href="#add-article" aria-controls="add-article" role="tab" data-toggle="tab" target="_self">Качи новина</a>
		</li>
	</ul>
	
	<div class="tab-content">
		<!-- software -->
		<div role="tabpanel" class="tab-pane active" id="profile">
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
	</div>

</div>
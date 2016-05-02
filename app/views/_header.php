<header>
	<div class="main-navigation">
		<div class="item">
			<a href="#home">Начало</a>
		</div>
		<div class="item">
			<a href="#home">Новини</a>
		</div>
		<div class="item">
			<a href="#home">Таблатури</a>
		</div>
		<div class="item">
			<a href="#home">Guitar Pro</a>
		</div>
		<div class="item">
			<a href="#home">Качи таблатура</a>
		</div>
		<div class="item">
			<a href="#home">Линкове</a>
		</div>
		<div class="item">
			<a href="#contact-us">Контакти</a>
		</div>
	</div>

	<div class="inner-header">
		<div class="social-icons">
			<a href="http://www.facebook.com/tablaturiBG" target="_blank">
				<img src="static/img/social/fb-icon.jpg" title="Последвайте ни във Facebook"/>
			</a>
			<a href="https://plus.google.com/116630108688799411998" target="_blank" rel="publisher">
				<img src="static/img/social/google-icon.jpg" title="Последвайте ни в Google+"/>
			</a>
		</div>

		<div ng-if="!loggedInUser && checkingLoginStatus === false" class="authentication">
			<a data-toggle="modal" href="#signup-modal" target="_self">Регистрация</a>
			<input class="btn btn-red" type="button" value="Вход" data-toggle="modal" data-target="#login-modal"/>
		</div>
		
		<div ng-if="loggedInUser" class="welcome-panel">
			Добре
			<span ng-if="loggedInUser.gender === 'M'">дошъл</span>
			<span ng-if="loggedInUser.gender === 'F'">дошла</span>
			<a class="red-link" title="Моят профил" href="#profile/{{loggedInUser.ID}}" ng-bind="loggedInUser.username"></a>
			<input class="btn btn-red" type="button" value="Изход" ng-click="logout()"/>
		</div>

		<div ng-show="stats" class="stats">
			<div>
				<span ng-bind="stats.gp"></span> GuitarPro таблатури
			</div>
			<div>
				<span ng-bind="stats.text"></span> Текстови таблатури
			</div>
		</div>

		<img src="static/img/logo-tablaturi-bg.png" title="Tablaturi-BG"/>
	</div>
</header>


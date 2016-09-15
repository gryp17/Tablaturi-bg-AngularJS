<div class="change-password">
	<!-- valid token -->
	<div ng-if="validToken && !success">
		<h4 class="title">Смяна на паролата:</h4>

		<div class="field-box">
			<input class="text-control validation" type="password" placeholder="Нова парола" name="password" ng-model="formData.password"/>
			<span class="error-msg"></span>
		</div>
		<div class="field-box">
			<input class="text-control validation" type="password" placeholder="Повтори паролата" name="repeat_password" ng-model="formData.repeat_password"/>
			<span class="error-msg"></span>
		</div>

		<input class="btn btn-red" type="button" value="Смени паролата" ng-click="changePassword()"/>

	</div>
	<!-- invalid token -->
	<div ng-if="!validToken" class="invalid-token">
		<img src="static/img/icons/sad.png">
		<p>
			Линкът е невалиден или е изтекъл.
			<br/>
			При проблем със смяната на паролата се <a class="red-link" href="#contact-us">свържете с нас</a>.
		</p>
	</div>
	<!-- change password success -->
	<div ng-if="success" class="change-password-success">
		<img src="static/img/icons/success-icon.png"/>
		<div class="message">
			<h4>Паролата беше сменена успешно.</h4>
			Вече можете да <a href="#login-modal" data-toggle="modal" target="_self" class="red-link">влезете</a> в профила си.
		</div>
	</div>
</div>
<div id="signup-modal" class="modal fade custom-modal" tabindex="-1" role="dialog" ng-controller="signupController">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Регистрация:</h4>
			</div>
			<div class="modal-body">
				<div class="field-box error">
					<input class="text-control" type="text" placeholder="Потребителско име"/>
					<span class="error-msg">Аз съм error!</span>
				</div>
				<div class="field-box">
					<input class="text-control" type="text" placeholder="Email"/>
					<span class="error-msg">Error message</span>
				</div>
				<div class="field-box">
					<input class="text-control" type="password" placeholder="Парола"/>
				</div>
				<div class="field-box">
					<input class="text-control" type="password" placeholder="Повтори парола"/>
				</div>
				<div class="field-box">
					<input class="text-control" type="password" placeholder="Рождена дата"/>
				</div>
				<div class="field-box">
					<div class="gender">
						Пол:
						<input type="radio" id="m" name="gender" value="m" checked="checked"> 
						<label for="m">Мъж</label>
						<input type="radio" id="f" name="gender" value="f">
						<label for="f">Жена</label>
					</div>
				</div>
				<div class="field-box error">
					<div class="captcha">
						<img class="captcha-img" src="static/img/captcha.png"/>
						<img class="reload-captcha" src="static/img/reload-icon.png"/>
					</div>
					<div class="captcha-input">
						<input class="text-control" type="text" placeholder="Captcha"/>
						<span class="error-msg">Error message</span>
					</div>
				</div>

				<input class="btn btn-red" type="button" value="Регистрирай се"/>
				
			</div>
		</div>
	</div>
</div>
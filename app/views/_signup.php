<div id="signup-modal" class="modal fade custom-modal" tabindex="-1" role="dialog" ng-controller="signupController">
	<div class="modal-dialog">
		<div ng-show="!signupSuccess" class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Регистрация:</h4>
			</div>
			<div class="modal-body">
				<div class="field-box">
					<input class="text-control validation" type="text" placeholder="Потребителско име" name="signup_username" ng-model="userData.signup_username"/>
					<span class="error-msg"></span>
				</div>
				<div class="field-box">
					<input class="text-control validation" type="text" name="signup_email" ng-model="userData.signup_email" placeholder="Email"/>
					<span class="error-msg"></span>
				</div>
				<div class="field-box">
					<input class="text-control validation" type="password" placeholder="Парола" name="signup_password" ng-model="userData.signup_password"/>
					<span class="error-msg"></span>
				</div>
				<div class="field-box">
					<input class="text-control validation" type="password" placeholder="Повтори парола" name="signup_repeat_password" ng-model="userData.signup_repeat_password"/>
					<span class="error-msg"></span>
				</div>
				<div class="field-box">
					<input id="signup-datepicker" readonly class="text-control validation" type="text" placeholder="Рождена дата" name="signup_birthday" ng-model="userData.signup_birthday"/>
					<span class="error-msg"></span>
				</div>
				<div class="field-box">
					<div class="gender">
						Пол:
						<input type="radio" id="m" class="validation" name="signup_gender" value="M" ng-model="userData.signup_gender"> 
						<label for="m">Мъж</label>
						<input type="radio" id="f" class="validation" name="signup_gender" value="F" ng-model="userData.signup_gender">
						<label for="f">Жена</label>
					</div>
					<span class="error-msg"></span>
				</div>
				<div class="field-box">
					<div class="captcha">
						<img class="captcha-img" ng-src="{{captchaImage || 'static/img/captcha-placeholder.jpg'}}" />
						<img class="reload-captcha" src="static/img/reload-icon.png" ng-click="generateCaptcha()"/>
					</div>
					<div class="captcha-input">
						<input class="text-control validation" type="text" placeholder="Captcha" name="signup_captcha" ng-model="userData.signup_captcha"/>
						<span class="error-msg"></span>
					</div>
				</div>

				<input class="btn btn-red" type="button" value="Регистрирай се" ng-click="signup()"/>

			</div>
		</div>
		<div ng-show="signupSuccess" class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Регистрирахте се успешно!</h4>
			</div>
			<div class="modal-body">
				<img class="success" src="static/img/success-icon.png"/>
				<div class="success-msg">
					<h4>Благодарим Ви, че се регистрирахте.</h4>
					До няколко минути ще получите имейл с линк за активация на своя акаунт.
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div id="login-modal" class="modal fade custom-modal" tabindex="-1" role="dialog" ng-controller="loginController">
	<div class="modal-dialog">
		<!-- login view -->
		<div class="modal-content" ng-show="view === 'login'">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Вход:</h4>
			</div>
			<div class="modal-body">
				<div class="field-box">
					<input class="text-control validation" enter-click="#login-modal .btn" type="text" ng-model="loginData.login_username" name="login_username" placeholder="Потребителско име"/>
					<span class="error-msg"></span>
				</div>
				<div class="field-box">
					<input class="text-control validation" enter-click="#login-modal .btn" type="password" ng-model="loginData.login_password" name="login_password" placeholder="Парола"/>
					<span class="error-msg"></span>
				</div>
				
				<div class="row">
					<div class="col-xs-6">
						<input type="checkbox" id="remember-me" name="remember-me" ng-model="loginData.login_remember_me"/>
						<label for="remember-me">
							Запомни ме
						</label>
					</div>
					<div class="col-xs-6 text-right">
						<a href="" ng-click="changeView('forgotten-password')">Забравена парола?</a>
					</div>
				</div>

				<input class="btn btn-red" type="button" value="Влез" ng-click="login()"/>
				
			</div>
		</div>
		
		<!-- forgotten password view -->
		<div class="modal-content" ng-show="view === 'forgotten-password'">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Забравена парола:</h4>
			</div>
			<div class="modal-body">
				<div class="field-box">
					<input class="text-control validation" enter-click="#login-modal .btn" type="text" ng-model="forgottenPasswordEmail" name="forgotten_password_email" placeholder="Email"/>
					<span class="error-msg"></span>
				</div>

				<input class="btn btn-red" type="button" value="Изпрати" ng-click="resetPassword()"/>
				
			</div>
		</div>
		
		<!-- reset password success view -->
		<div class="modal-content" ng-show="view === 'reset-password-success'">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Забравена парола:</h4>
			</div>
			<div class="modal-body reset-password-success">
				<img src="static/img/icons/success-icon.png"/>
				<div class="message">
					<h4>Паролата беше сменена успешно.</h4>
					До няколко минути ще получите имейл с новата си парола.
				</div>
			</div>
		</div>
		
	</div>
</div>
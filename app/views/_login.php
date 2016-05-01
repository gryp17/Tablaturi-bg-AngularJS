<div id="login-modal" class="modal fade custom-modal" tabindex="-1" role="dialog" ng-controller="loginController">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Вход:</h4>
			</div>
			<div class="modal-body">
				<div class="field-box">
					<input class="text-control validation" type="text" ng-model="username" name="username" placeholder="Потребителско име"/>
					<span class="error-msg"></span>
				</div>
				<div class="field-box">
					<input class="text-control validation" type="password" ng-model="password" name="password" placeholder="Парола"/>
					<span class="error-msg"></span>
				</div>
				
				<div class="row">
					<div class="col-xs-6">
						<input type="checkbox" id="remember-me" name="remember-me"/>
						<label for="remember-me">
							Запомни ме
						</label>
					</div>
					<div class="col-xs-6 text-right">
						<a href="#forgotten-password">Забравена парола?</a>
					</div>
				</div>

				<input class="btn btn-red" type="button" value="Влез" ng-click="login(username, password)"/>
				
			</div>
		</div>
	</div>
</div>
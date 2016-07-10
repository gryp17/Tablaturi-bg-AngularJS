<div id="edit-profile-modal" class="modal fade custom-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Редакция на профил:</h4>
			</div>
			<div class="modal-body">
				<form id="edit-profile-form" name="edit-profile-form" enctype="multipart/form-data">
					<div class="avatar-wrapper">
						<div class="avatar-circle">
							<img class="user-avatar img-circle" ng-src="content/avatars/{{editData.photo}}" ng-click="browse()" />
							
							<div class="overlay" ng-click="browse()">
								<span class="glyphicon glyphicon-camera"></span>
							</div>
						</div>
						
						<div class="avatar-hint">
							Позволени формати: JPG и PNG под 1MB
						</div>
						
						<div class="field-box">
							<input type="file" name="avatar" class="avatar validation" />
							<span class="error-msg"></span>
						</div>
					</div>
					
					<div class="edit-right">
						<div class="field-box">
							<input class="text-control validation" type="password" placeholder="Нова парола" name="password" ng-model="editData.password"/>
							<span class="error-msg"></span>
						</div>
						<div class="field-box">
							<input class="text-control validation" type="password" placeholder="Повтори паролата" name="repeat_password" ng-model="editData.repeat_password"/>
							<span class="error-msg"></span>
						</div>
						<div class="field-box">
							<input class="text-control validation" type="text" placeholder="Местоживеене" name="location" ng-model="editData.location" />
							<span class="error-msg"></span>
						</div>
						<div class="field-box">
							<input class="text-control validation" type="text" placeholder="Професия" name="occupation" ng-model="editData.occupation" />
							<span class="error-msg"></span>
						</div>
						<div class="field-box">
							<input class="text-control validation" type="text" placeholder="Web" name="web" ng-model="editData.web" />
							<span class="error-msg"></span>
						</div>
					</div>
					
					<br/>
					
					<div class="field-box">
						<textarea class="text-control validation" placeholder="За мен" name="about_me" ng-model="editData.about_me"></textarea>
						<span class="error-msg"></span>
					</div>
					
					<div class="field-box">
						<textarea class="text-control validation" placeholder="Инструменти/Екипировка" name="instrument" ng-model="editData.instrument"></textarea>
						<span class="error-msg"></span>
					</div>
					
					<div class="field-box">
						<textarea class="text-control validation" placeholder="Любими групи/музиканти" name="favourite_bands" ng-model="editData.favourite_bands"></textarea>
						<span class="error-msg"></span>
					</div>

					<input class="btn btn-red" type="button" value="Запази промените" ng-click="submitEditProfileForm()"/>
				</form>
			</div>
		</div>
	</div>
</div>
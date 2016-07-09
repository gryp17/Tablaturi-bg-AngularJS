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
				<form>
					<div class="avatar-wrapper">
						<img class="user-avatar img-circle" ng-src="content/avatars/{{editData.photo}}" ng-click="browse()" />
						<input type="file" name="avatar" class="avatar" />
						<div class="overlay" ng-click="browse()">
							<span class="glyphicon glyphicon-camera"></span>
						</div>
					</div>
					<div class="edit-right">
						<div class="field-box">
							<input class="text-control validation" type="text" placeholder="Местоживеене" name="location" ng-model="editData.location" />
							<span class="error-msg"></span>
						</div>
						<div class="field-box">
							<input class="text-control validation" type="text" placeholder="Професия" name="occupation" ng-model="editData.occupation" />
							<span class="error-msg"></span>
						</div>
						<div class="field-box">
							<input class="text-control validation" type="text" placeholder="Web" name="occupation" ng-model="editData.web" />
							<span class="error-msg"></span>
						</div>
					</div>
					<input class="btn btn-red" type="button" value="Запази промените" />
				</form>
			</div>
		</div>
	</div>
</div>
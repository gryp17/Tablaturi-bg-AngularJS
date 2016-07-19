<div id="report-profile-modal" class="modal fade custom-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div ng-if="!reportSuccess" class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Докладване на потребител {{reportedUser.username}}:</h4>
			</div>
			<div class="modal-body">
				<div class="report-profile-wrapper">
					<div class="report-title">Причина:</div>
					<div>
						<input type="radio" id="rude" value="rude language" ng-model="reportedUser.reason"> 
						<label for="rude">Грубо отношение или език</label>
					</div>
					<div>
						<input type="radio" id="spam" value="spam" ng-model="reportedUser.reason">
						<label for="spam">Спам</label>
					</div>
					<div>
						<input type="radio" id="avatar" value="inappropriate avatar" ng-model="reportedUser.reason">
						<label for="avatar">Неподходящ аватар</label>
					</div>
					<div>
						<input type="radio" id="other" value="other" ng-model="reportedUser.reason">
						<label for="other">Друго</label>
					</div>
					<div class="field-box">
						<textarea class="text-control validation" ng-class="{'disabled' : reportedUser.reason !== 'other'}" ng-disabled="reportedUser.reason !== 'other'" name="report" ng-model="reportedUser.other"></textarea>
						<div>
							<span class="error-msg"></span>
						</div>
					</div>
					<input class="btn btn-red" type="button" value="Докладвай" ng-click="reportUser(reportedUser)"/>
				</div>				
			</div>
		</div>
		
		<div ng-if="reportSuccess" class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Успешно докладвахте {{reportedUser.username}}!</h4>
			</div>
			<div class="modal-body">
				<div ng-if="reportSuccess" class="success">
					<img class="success" src="static/img/icons/success-icon.png"/>
					<div class="success-msg">
						<h4>Благодарим Ви!</h4>
						Екипът ни ще разгледа докладвания профил в най-скоро време.
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
</div>
<div id="report-tab-modal" class="modal fade custom-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div ng-if="!reportSuccess" class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Докладване на таблатура:</h4>
			</div>
			<div class="modal-body">
				<div class="report-tab-wrapper">
					<div class="report-title">Причина:</div>
					<div>
						<input type="radio" id="invalid" value="invalid tab/format" ng-model="reportedTab.reason"> 
						<label for="invalid">Невалидна таблатура/проблем с формата</label>
					</div>
					<div>
						<input type="radio" id="wrong" value="wrong song/band" ng-model="reportedTab.reason">
						<label for="wrong">Грешно заглавие/песен</label>
					</div>
					<div>
						<input type="radio" id="fake" value="fake tab" ng-model="reportedTab.reason">
						<label for="fake">Фалшива таблатура</label>
					</div>
					<div>
						<input type="radio" id="other" value="other" ng-model="reportedTab.reason">
						<label for="other">Друго</label>
					</div>
					<div class="field-box">
						<textarea class="text-control validation" ng-class="{'disabled' : reportedTab.reason !== 'other'}" ng-disabled="reportedTab.reason !== 'other'" name="report" ng-model="reportedTab.other"></textarea>
						<div>
							<span class="error-msg"></span>
						</div>
					</div>
					<input class="btn btn-red" type="button" value="Докладвай" ng-click="reportTab(reportedTab)"/>
				</div>				
			</div>
		</div>
		
		<div ng-if="reportSuccess" class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Успешно докладвахте таблатурата!</h4>
			</div>
			<div class="modal-body">
				<div ng-if="reportSuccess" class="success">
					<img class="success" src="static/img/icons/success-icon.png"/>
					<div class="success-msg">
						<h4>Благодарим Ви!</h4>
						Екипът ни ще разгледа докладваната таблатура в най-скоро време.
					</div>
				</div>
			</div>
		</div>
		
		
	</div>
</div>
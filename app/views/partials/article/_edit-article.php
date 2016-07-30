<div id="edit-article-modal" class="modal fade custom-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Редакция на новина:</h4>
			</div>
			<div class="modal-body">
				<form id="edit-article-form" name="edit-article-form" enctype="multipart/form-data">
					<div class="image-wrapper">
						<div class="image-circle">
							<img class="article-image img-circle" ng-src="content/articles/{{editData.picture}}" ng-click="browse()" />

							<div class="overlay" ng-click="browse()">
								<span class="glyphicon glyphicon-camera"></span>
							</div>
						</div>

						<div class="image-hint">
							Позволени формати: JPG и PNG под 1MB
						</div>

						<div class="field-box">
							<input type="file" name="image" class="image validation" />
							<span class="error-msg"></span>
						</div>
					</div>
					
					<div class="field-box">
						<input type="text" name="title" class="validation text-control" placeholder="Заглавие" ng-model="editData.title" />
						<span class="error-msg"></span>
					</div>
					<div class="field-box">
						<input id="edit-article-datepicker" readonly class="text-control validation" type="text" placeholder="Дата на публикуване" name="date" ng-model="editData.date" />
						<span class="error-msg"></span>
					</div>
					<div class="field-box">
						<textarea class="text-control validation" placeholder="Съдържание" name="content" ng-model="editData.content"></textarea>
						<span class="error-msg"></span>
					</div>
					
					<input type="hidden" name="id" value="{{editData.ID}}"/>

					<input class="btn btn-red" type="button" value="Запази промените" ng-click="submitEditArticleForm()"/>
				</form>
			</div>
		</div>
	</div>
</div>
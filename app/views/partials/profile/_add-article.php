<div ng-controller="addArticleController" role="tabpanel" id="add-article" class="tab-pane">

	<h2 class="title">Добави новина</h2>
	
	<form id="add-article-form" name="add-article-form" enctype="multipart/form-data">		
		<div class="image-wrapper">
			<div class="image-circle">
				<img class="article-image img-circle" ng-src="static/img/no-image.jpg" ng-click="browse()" />

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
			<input type="text" name="title" class="validation text-control" placeholder="Заглавие" />
			<span class="error-msg"></span>
		</div>
		<div class="field-box">
			<input id="add-article-datepicker" readonly class="text-control validation" type="text" placeholder="Дата на публикуване" name="date" />
			<span class="error-msg"></span>
		</div>
		<div class="field-box">
			<textarea class="text-control validation" placeholder="Съдържание" name="content"></textarea>
			<span class="error-msg"></span>
		</div>
		
		<input class="btn btn-red" type="button" value="Публикувай новината" ng-click="addArticle()"/>
	</form>
</div>
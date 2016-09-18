<div class="edit-tab">
	<h2 class="title">Редактирай таблатура:</h2>
	<form id="edit-tab-form" name="edit-tab-form" enctype="multipart/form-data">

		<div class="row">
			<!-- left column -->
			<div class="col-xs-6">
				
				<input type="hidden" name="tab_id" value="{{tab.ID}}"/>

				<div class="field-label">Вид таблатура:</div>
				<div class="field-box">
					<label class="custom-dropdown">
						<select ng-model="tab.type" name="type">
							<option value="tab">Текстова таблатура</option>
							<option value="chord">Акорди</option>
							<option value="bass">Бас</option>
							<option value="gp">Guitar Pro</option>
						</select>
					</label>
				</div>

				<div class="field-box">
					<input class="text-control validation" type="text" name="band" placeholder="Група" autocomplete="band" band="{{tab.band}}" ng-model="tab.band"/>
					<span class="error-msg"></span>
				</div>
				
				<div class="field-box">
					<input class="text-control validation" type="text" name="song" placeholder="Песен" autocomplete="song" band="{{tab.band}}" ng-model="tab.song"/>
					<span class="error-msg"></span>
				</div>

				<div class="field-label">Тунинг:</div>
				<div class="field-box">
					<label class="custom-dropdown">
						<select ng-model="tab.tunning" name="tunning" ng-click="clearTunningErrors()">
							<option value="Стандартен (EBGDAE)">Стандартен (EBGDAE)</option>
							<option value="Drop D">Drop D</option>
							<option value="Drop C">Drop C</option>
							<option value="other">Друг</option>
						</select>
					</label>
				</div>

				<div ng-if="tab.tunning === 'other'" class="field-box">
					<input class="text-control validation" type="text" name="other_tunning" placeholder="Друг тунинг" ng-model="otherTunning"/>
					<span class="error-msg"></span>
				</div>


			</div>

			<!-- right column -->
			<div class="col-xs-6">

				<div class="field-label">Тип таблатура:</div>
				<div class="radio-box">
					<input type="radio" id="full" value="full song" name="tab_type" ng-model="tab.tab_type"> 
					<label for="full">Цяла песен</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="intro" value="intro" name="tab_type" ng-model="tab.tab_type">
					<label for="intro">Интро</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="solo" value="solo" name="tab_type" ng-model="tab.tab_type">
					<label for="solo">Соло</label>
				</div>

				<div class="field-label">Трудност:</div>
				<div class="field-box">
					<label class="custom-dropdown">
						<select ng-model="tab.difficulty" name="difficulty">
							<option value="Ниска">Ниска</option>
							<option value="Средна">Средна</option>
							<option value="Висока">Висока</option>
						</select>
					</label>
				</div>

			</div>
		</div>

		<div ng-if="tab.type !== 'gp'">
			<div class="field-box">
				<textarea class="text-control validation" name="content" placeholder="Текстова таблатура" ng-model="tab.content"></textarea>
				<span class="error-msg"></span>
			</div>
		</div>

		<div ng-if="tab.type === 'gp'" >
			
			
			<div class="field-label">Guitar Pro файл:</div>
			<div class="field-box">
				<button class="btn btn-red browse-btn" ng-click="browse()">
					<span class="glyphicon glyphicon-open" aria-hidden="true"></span> Избери файл...
				</button>
				<div class="file-hint">
					Позволени формати: gp, gp3, gp4, gp5, gp6 и gpx под 1MB
				</div>
				<input type="file" name="gp_file" class="validation file"/>
				<span class="error-msg"></span>
			</div>
		</div>

		<button class="btn btn-red update-btn" ng-click="updateTab()">Запази промените</button>

	</form>
</div>
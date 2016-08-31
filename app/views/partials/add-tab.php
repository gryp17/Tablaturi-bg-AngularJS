<div class="add-tab">

	<form id="add-tab-form" name="add-tab-form" enctype="multipart/form-data">

		<div class="row">
			<!-- left column -->
			<div class="col-xs-6">

				type:
				<label class="custom-dropdown">
					<select ng-model="formData.type" name="type">
						<option value="tab">Текстова таблатура</option>
						<option value="chord">Акорди</option>
						<option value="bass">Бас</option>
						<option value="gp">Guitar Pro</option>
					</select>
				</label>

				<br><br>

				<input class="text-control" type="text" name="band" placeholder="Група" autocomplete="band"/>
				<br><br>
				<input class="text-control" type="text" name="song" placeholder="Песен" autocomplete="song"/>
				<br><br>

				tunning:
				<label class="custom-dropdown">
					<select ng-model="formData.tunning.type" name="tunning">
						<option value="Стандартен (EBGDAE)">Стандартен (EBGDAE)</option>
						<option value="Drop D">Drop D</option>
						<option value="Drop C">Drop C</option>
						<option value="other">Друг</option>
					</select>
				</label>

				<br><br>
				<input ng-if="formData.tunning.type === 'other'" class="text-control" type="text" name="other_tunning" placeholder="Друг тунинг"/>


			</div>

			<!-- right column -->
			<div class="col-xs-6">

				tab type:
				<br>
				<input type="radio" id="full" value="full song" name="tab_type" ng-model="formData.tab_type"> 
				<label for="full">Цяла песен</label>
				<br>
				<input type="radio" id="intro" value="intro" name="tab_type" ng-model="formData.tab_type">
				<label for="intro">Интро</label>
				<br>
				<input type="radio" id="solo" value="solo" name="tab_type" ng-model="formData.tab_type">
				<label for="solo">Соло</label>

				<br><br>

				difficulty:
				<label class="custom-dropdown">
					<select ng-model="formData.difficulty" name="difficulty">
						<option value="Ниска">Ниска</option>
						<option value="Средна">Средна</option>
						<option value="Висока">Висока</option>
					</select>
				</label>

			</div>
		</div>

		<hr/>

		<div ng-if="formData.type !== 'gp'">
			<textarea class="text-control" name="content" placeholder="Текстова таблатура"></textarea>
		</div>

		<div ng-if="formData.type === 'gp'">
			Guitar Pro файл
			<input type="file" name="gp_file"/>
		</div>

		<hr/>

		<button class="btn btn-red" ng-click="addTab()">Качи таблатурата</button>

	</form>

</div>
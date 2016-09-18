<div class="search-bar">
	<input class="text-control" enter-click="redirectSearch()" autocomplete="band" band="{{searchParams.band}}" type="text" placeholder="Група" ng-model="searchParams.band"/>
	<input class="text-control" enter-click="redirectSearch()" autocomplete="song" band="{{searchParams.band}}" type="text" placeholder="Песен" ng-model="searchParams.song"/>
	
	<label class="custom-dropdown">
		<select ng-model="searchParams.type">
			<option value="all">Тип</option>
			<option value="tab">Таблатури</option>
			<option value="chord">Акорди</option>
			<option value="bass">Бас</option>
			<option value="gp">Guitar Pro</option>
			<option value="bt">Backing Tracks</option>
		</select>
	</label>
	
	<input class="btn btn-red" type="button" value="Търси" ng-click="redirectSearch()"/>	
	
</div>
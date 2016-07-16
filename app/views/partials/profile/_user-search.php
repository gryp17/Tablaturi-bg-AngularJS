<div ng-controller="userSearchController" role="tabpanel" id="user-search" class="tab-pane">

	<div class="search-wrapper">
		<div class="field-box">
			<input class="text-control validation" enter-click=".search-wrapper .btn" type="text" name="keyword" placeholder="Ключова дума" ng-model="keyword"/>
			<div class="error-wrapper">
				<span class="error-msg"></span>
			</div>
		</div>
		<input class="btn btn-red" type="button" value="Търси" ng-click="newSearch()"/>
	</div>
	
	<div class="search-ad" ng-show="!users">
		ad
	</div>

	<div class="no-results" ng-show="totalUsers === 0">
		<img src="static/img/icons/sad.png"/>
		<br/>
		Няма намерени резултати
	</div>

	<div ng-show="totalUsers > 0">

		<table class="results-table">
			<thead>
				<tr>
					<td>Потребител</td>
					<td>Пол</td>
					<td>Възраст</td>
					<td>Местоположение</td>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="user in users">
					<td>
						<a class="red-link" href="#profile/{{user.ID}}">
							{{user.username}}
						</a>
					</td>
					<td>
						<img ng-if="user.gender === 'M'" class="gender-icon male" src="static/img/icons/male-sign.png"/>
						<img ng-if="user.gender === 'F'" class="gender-icon female" src="static/img/icons/female-sign.png"/>
					</td>
					<td>
						{{user.birthday | age}} години
					</td>
					<td>
						{{user.location}}
					</td>
				</tr>
			</tbody>
		</table>

		<div class="pagination" total-items="totalUsers" limit="limit" offset="offset" range="2" callback="search(limit, offset, keyword)"></div>
	</div>

</div>
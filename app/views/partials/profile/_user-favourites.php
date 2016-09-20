<div ng-controller="userFavouritesController" role="tabpanel" id="user-favourites" class="tab-pane">
	
	<div class="no-user-favourites" ng-show="totalUserFavourites === 0">
		<img src="static/img/icons/sad.png"/>
		<br/>
		Потребителят няма любими таблатури
	</div>

	<div ng-show="totalUserFavourites > 0">

		<table class="results-table">
			<thead>
				<tr>
					<td>Група</td>
					<td>Песен</td>
					<td class="tab-type">Тип</td>
					<td ng-if="loggedInUser.ID === profileId" class="remove-favourite">Изтрий</td>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="tab in userFavourites">
					<td>
						<a class="red-link" href="search/all/{{tab.band}}//" ng-attr-title="Всичко от {{tab.band}}">
							{{tab.band}}
						</a>
					</td>
					<td>
						<a class="red-link" href="tab/{{tab.ID}}" ng-attr-title="{{tab.band}} - {{tab.song}}">
							{{tab.song}}
							<span ng-show="tab.tab_type !== 'full song'">({{tab.tab_type | tabContentType}})</span>
						</a>
					</td>
					<td ng-bind="tab.type | tabType"></td>
					<td ng-if="loggedInUser.ID === profileId" class="remove-favourite">
						<span ng-click="deleteFavouriteTab(tab.ID)" class="glyphicon glyphicon-remove" title="Изтрий от любими"></span>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="pagination" total-items="totalUserFavourites" limit="limit" offset="offset" range="2" callback="getUserFavourites(limit, offset)"></div>
	</div>

</div>
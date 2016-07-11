<div ng-controller="userTabsController" role="tabpanel" id="user-tabs" class="tab-pane">

	<div class="no-user-tabs" ng-show="totalUserTabs === 0">
		<img src="static/img/icons/sad.png"/>
		<br/>
		Потребителят няма качени таблатури
	</div>

	<div ng-show="totalUserTabs > 0">

		<table class="results-table">
			<thead>
				<tr>
					<td>Група</td>
					<td>Песен</td>
					<td>Тип</td>
					<td>Рейтинг</td>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="tab in userTabs">
					<td>
						<a class="red-link" href="#search/all/{{tab.band}}//">
							{{tab.band}}
						</a>
					</td>
					<td>
						<a class="red-link" href="#tab/{{tab.ID}}">
							{{tab.song}}
							<span ng-show="tab.tab_type !== 'full song'">({{tab.tab_type}})</span>
						</a>
					</td>
					<td ng-bind="tab.type | tabType"></td>
					<td>
						<span ng-repeat="star in tab.rating| ratingStars track by $index" 
							  ng-class="{'star': star === 1, 'empty-star': star === 0}"></span>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="pagination" total-items="totalUserTabs" limit="limit" offset="offset" range="2" callback="getUserTabs(limit, offset)"></div>
	</div>


</div>
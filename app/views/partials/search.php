<div class="search">
	
	<h4 class="title">
		<span ng-show="totalResults > 0">Намерени резултати за</span>
		<span ng-show="totalResults === 0">
			<img src="static/img/icons/sad.png"/>
			<br/>
			Няма намерени резултати за
		</span>
		
		<span class="search-params">
			<span ng-show="band" ng-bind="band"></span>
			<span ng-show="band && song"> - </span>
			<span ng-show="song" ng-bind="song"></span>
		</span>
	</h4>
	
	<div ng-show="totalResults > 0">
		<hr/>

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
				<tr ng-repeat="tab in tabs">
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
					<td>
						<span ng-repeat="star in tab.rating | ratingStars track by $index" 
								  ng-class="{'star': star === 1, 'empty-star': star === 0}"></span>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="pagination" total-items="totalResults" limit="limit" offset="offset" range="2" callback="search(limit, offset)"></div>
	</div>
</div>
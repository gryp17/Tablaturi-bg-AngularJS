<div class="search-backing-tracks">
	<h4 class="title">
		<span ng-show="totalResults > 0">Намерени резултати за</span>
		<span ng-show="totalResults === 0">Няма намерени резултати за</span>
		
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
					<td>Вокали</td>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="track in backingTracks">
					<td>
						<a class="red-link" href="search-backing-tracks/bt/{{track.band}}//" ng-attr-title="Всичко от {{track.band}}">
							{{track.band}}
						</a>
					</td>
					<td>
						<a class="red-link" href="javascript:void(0)" ng-click="getMP3(track.link)" ng-attr-title="{{track.band}} - {{track.song}}">
							{{track.song}}
						</a>
					</td>
					<td>
						<img ng-show="track.vocals" src="static/img/icons/checkmark.png" />
						<img ng-show="!track.vocals" src="static/img/icons/cross.png" />
					</td>
				</tr>
			</tbody>
		</table>

		<div class="pagination" total-items="totalResults" limit="limit" offset="offset" range="2" callback="changePage(limit, offset)"></div>
	</div>
	
</div>
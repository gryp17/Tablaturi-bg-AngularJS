<div class="top-tabs">
	<!-- Most popular -->
	<div class="top-table">
		<div class="header">
			<img src="static/img/top-icons/zoom.png"/>
			Най-търсени
		</div>
		<hr/>
		<table class="table table-striped">
			<thead>
				<tr>
					<td>
						Песен
					</td>
					<td class="visits">
						Посещения
					</td>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="tab in mostPopular">
					<td><a class="red-link" href="#tab/{{tab.ID}}">{{tab.band}} - {{tab.song}}</a></td>
					<td class="visits">{{tab.downloads}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<!-- Most liked -->
	<div class="top-table">
		<div class="header">
			<img src="static/img/top-icons/thumbs-up.png"/>
			Най-харесвани
		</div>
		<hr/>
		<table class="table table-striped">
			<thead>
				<tr>
					<td>
						Песен
					</td>
					<td class="rating">
						Рейтинг
					</td>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="tab in mostLiked">
					<td><a class="red-link" href="#tab/{{tab.ID}}">{{tab.band}} - {{tab.song}}</a></td>
					<td class="rating">
						<span ng-repeat="star in calculateStars(tab.rating) track by $index" 
							  ng-class="{'star': star === 1, 'empty-star': star === 0}"></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<!-- Most recent -->
	<div class="top-table">
		<div class="header">
			<img src="static/img/top-icons/calendar.png"/>
			Най-нови
		</div>
		<hr/>
		<table class="table table-striped">
			<thead>
				<tr>
					<td>
						Песен
					</td>
					<td class="date">
						Дата
					</td>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="tab in mostRecent">
					<td><a class="red-link" href="#tab/{{tab.ID}}">{{tab.band}} - {{tab.song}}</a></td>
					<td class="date">{{tab.upload_date | date : 'yyyy-MM-dd'}}</td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<!-- Most commented -->
	<div class="top-table">
		<div class="header">
			<img src="static/img/top-icons/comment.png"/>
			Най-коментирани
		</div>
		<hr/>
		<table class="table table-striped">
			<thead>
				<tr>
					<td>
						Песен
					</td>
					<td class="comments">
						Коментари
					</td>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="tab in mostCommented">
					<td><a class="red-link" href="#tab/{{tab.ID}}">{{tab.band}} - {{tab.song}}</a></td>
					<td class="comments">{{tab.comments}}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

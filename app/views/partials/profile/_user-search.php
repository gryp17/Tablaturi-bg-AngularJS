<div ng-controller="userSearchController" role="tabpanel" id="user-search" class="tab-pane">

	<div class="search-wrapper">
		<div class="field-box">
			<input class="text-control validation" enter-click="newSearch()" type="text" name="keyword" placeholder="Ключова дума" ng-model="keyword"/>
			<div class="error-wrapper">
				<span class="error-msg"></span>
			</div>
		</div>
		<input class="btn btn-red" type="button" value="Търси" ng-click="newSearch()"/>
	</div>
	
	<div class="search-ad" ng-show="!users">
		<script type="text/javascript" id="etargetScript0517271c057a7f57cfce4649fc4849ef">function etargetPostloadFunction0517271c057a7f57cfce4649fc4849ef(){var e="etargetPostload0517271c057a7f57cfce4649fc4849ef",t="etargetScript0517271c057a7f57cfce4649fc4849ef",o=document.getElementById(e);if(o){for(var n=o.offsetTop,d=o.offsetLeft,r=o.offsetWidth,a=o.offsetHeight;o.offsetParent;)o=o.offsetParent,n+=o.offsetTop,d+=o.offsetLeft;var i=n<window.pageYOffset+window.innerHeight&&d<window.pageXOffset+window.innerWidth&&n+a>window.pageYOffset&&d+r>window.pageXOffset;if(i&&etargetAllowOtherCheck){allowed=!1;var c=document.createElement("script");return c.src="//bg.search.etargetnet.com/generic/uni.php?g=ref:79528,area:300x250",void(document.getElementById(t)&&document.getElementById(e)&&(document.getElementById(t).parentNode.appendChild(c),document.getElementById(t).parentNode.removeChild(document.getElementById(t)),document.getElementById(e).parentNode.removeChild(document.getElementById(e)),document.removeEventListener("scroll",etargetPostloadFunction0517271c057a7f57cfce4649fc4849ef),document.removeEventListener("resize",etargetPostloadFunction0517271c057a7f57cfce4649fc4849ef),document.removeEventListener("DOMContentLoaded",etargetPostloadFunction0517271c057a7f57cfce4649fc4849ef)))}}}var etargetDivID="etargetPostload0517271c057a7f57cfce4649fc4849ef",etargetScriptID="etargetScript0517271c057a7f57cfce4649fc4849ef",etargetPostloadPoint=document.createElement("div");etargetPostloadPoint.id=etargetDivID;var etargetCurScript=document.getElementById(etargetScriptID);etargetCurScript.parentNode.appendChild(etargetPostloadPoint),document.addEventListener("scroll",etargetPostloadFunction0517271c057a7f57cfce4649fc4849ef),document.addEventListener("resize",etargetPostloadFunction0517271c057a7f57cfce4649fc4849ef),document.addEventListener("DOMContentLoaded",etargetPostloadFunction0517271c057a7f57cfce4649fc4849ef);var etargetAllowOtherCheck=!0;if(typeof("forceRunPostload")=="string"){etargetPostloadFunction0517271c057a7f57cfce4649fc4849ef()}</script>
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
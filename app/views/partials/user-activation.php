<div class="user-activation">
	<h4 ng-if="success">
		<img src="static/img/icons/success-icon.png">
		<p>
			Успешно активирахте своя профил. 
			<br/>
			Вече можете да <a href="#login-modal" data-toggle="modal" target="_self" class="red-link">влезете</a>.
		</p>
	</h4>
	<h4 ng-if="!success">
		<img src="static/img/icons/sad.png">
		<p>
			Линкът за активация е невалиден или е изтекъл.
			<br/>
			При проблем с активацията се <a class="red-link" href="contact-us">свържете с нас</a>.
		</p>
	</h4>
</div>
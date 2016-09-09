<div class="user-activation">
	<div ng-if="success">
		Успешно активирахте потребителят си. 
		Вече можете да <a href="#login-modal" data-toggle="modal" target="_self" class="red-link">влезете</a>.
	</div>
	<div ng-if="!success">
		Линкъв Ви за активация е невалиден или е изтекъл.
		<br/>
		При проблем с активацията се <a class="red-link" href="#contact-us">свържете с нас</a>.
	</div>
</div>
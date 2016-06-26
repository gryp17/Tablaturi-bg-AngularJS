<div class="contact-us">
	<h2 class="title">Свържете се с нас:</h2>
	<div ng-show="!sendEmailSuccess">
		<div class="content">За всякакви препоръки, похвали, оплаквания или въпроси можете да се свържете с нас чрез формуляра.</div>
		<div class="contact-form">
			<div class="field-box">
				<input class="text-control validation" type="text" placeholder="Име" name="username" ng-model="formData.username"/>
				<span class="error-msg"></span>
			</div>
			<div class="field-box">
				<input class="text-control validation" type="text" placeholder="Email" name="email" ng-model="formData.email"/>
				<span class="error-msg"></span>
			</div>
			<div class="field-box">
				<textarea class="text-control validation" ng-model="formData.message" name="message" placeholder="Съобщение"></textarea>
				<span class="error-msg"></span>
			</div>
			<div class="field-box captcha-field-box">
				<div class="captcha">
					<img class="captcha-img" ng-src="{{captchaImage || 'static/img/captcha-placeholder.jpg'}}"/>
					<img class="reload-captcha" src="static/img/icons/reload-icon.png" ng-click="generateCaptcha()"/>
				</div>
				<div class="captcha-input">
					<input class="text-control validation" type="text" placeholder="Captcha" name="captcha" ng-model="formData.captcha"/>
					<span class="error-msg"></span>
				</div>
			</div>
			<input class="btn btn-red" type="button" value="Изпрати" ng-click="sendEmail()"/>
		</div>
	</div>
	
	<div ng-show="sendEmailSuccess" class="success-wrapper">
		<img class="success" src="static/img/icons/success-icon.png"/>
		<div class="success-msg">
			<h4>Съобщението беше изпратено успешно.</h4>
			Ще се свържем с Вас на посочения email възможно най-скоро.
		</div>
	</div>
	
	
</div>
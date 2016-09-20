<html>
    <body>
		<?php include 'common/header.php' ?>
		<div style="color: #465A65; margin-top: 20px;">
			<h4>Успешна регистрация на потребител {{name}}!</h4>
			<br>
			За да активирате своя потребител, моля, кликнете на <a href='{{link}}' style="color: #F84241;">този линк</a> или копирайте следното: <br><br>
			{{link}}
			<br><br>
			Линкът ще бъде активен само в следващите 24 часа.
			<br>
			В случай на проблем при активацията се <a href="http://<?php echo Config::DOMAIN ?>/contact-us" style="color: #F84241;">свържете с нас</a>.
		</div>
		<?php include 'common/footer.php' ?>
    </body>
</html>
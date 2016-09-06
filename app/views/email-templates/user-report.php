<html>
    <body>
		<?php include 'common/header.php' ?>
		<h4>Докладване на потребител {{reported_username}}!</h4>
		Потребилят <a href="http://www.tablaturi-bg.com/#/profile/{{reported_id}}">{{reported_username}}</a> 
		бе докладван за "{{report}}" от <a href="http://www.tablaturi-bg.com/#/profile/{{reporter_id}}">{{reporter_username}}</a>
		<?php include 'common/footer.php' ?>
    </body>
</html>
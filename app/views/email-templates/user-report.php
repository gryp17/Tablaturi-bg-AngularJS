<html>
    <body>
		<?php include 'common/header.php' ?>
		<div style="color: #465A65; margin-top: 20px;">
			<h4>Докладване на потребител {{reported_username}}!</h4>
			Потребилят <a href="http://<?php echo Config::DOMAIN ?>/profile/{{reported_id}}" style="color: #F84241;">{{reported_username}}</a> 
			бе докладван за "{{report}}" от <a href="http://<?php echo Config::DOMAIN ?>/profile/{{reporter_id}}" style="color: #F84241;">{{reporter_username}}</a>
		</div>
		<?php include 'common/footer.php' ?>
    </body>
</html>
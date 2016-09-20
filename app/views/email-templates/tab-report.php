<html>
    <body>
		<?php include 'common/header.php' ?>
		<div style="color: #465A65; margin-top: 20px;">
			<h4>Докладване на таблатура {{reported_tab_band}} - {{reported_tab_song}}!</h4>
			Таблатурата <a href="http://<?php echo Config::DOMAIN ?>/tab/{{reported_tab_id}}" style="color: #F84241;">{{reported_tab_band}} - {{reported_tab_song}}</a> 
			беше докладвана за "{{report}}" от <a href="http://<?php echo Config::DOMAIN ?>/profile/{{reporter_id}}" style="color: #F84241;">{{reporter_username}}</a>
		</div>
		<?php include 'common/footer.php' ?>
    </body>
</html>
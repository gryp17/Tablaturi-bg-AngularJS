<html>
    <body>
		<?php include 'common/header.php' ?>
		<h4>Докладване на таблатура {{reported_tab_band}} - {{reported_tab_song}} (ID: {{reported_tab_id}})!</h4>
		Таблатурата <a href="http://www.tablaturi-bg.com/#/tab/{{reported_tab_id}}">{{reported_tab_band}} - {{reported_tab_song}}</a> 
		беше докладвана за "{{report}}" от <a href="http://www.tablaturi-bg.com/#/profile/{{reporter_id}}">{{reporter_username}}</a>
		<?php include 'common/footer.php' ?>
    </body>
</html>
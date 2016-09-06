<html>
    <body>
		<?php include 'common/header.php' ?>
		<h4>Получихте коментар на ваша таблатура!</h4>
		Потребилят <a href="http://www.tablaturi-bg.com/#/profile/{{author_id}}">{{author_username}}</a> 
		коментира <a href="http://www.tablaturi-bg.com/#/tab/{{tab_id}}">таблатурата</a> Ви:
		<div style="border: solid 1px gray;">
			{{content}}
		</div>
		<?php include 'common/footer.php' ?>
    </body>
</html>
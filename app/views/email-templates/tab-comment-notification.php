<html>
    <body>
		<?php include 'common/header.php' ?>
		<div style="color: #465A65; margin-top: 20px;">
			<h4>Получихте коментар на Ваша таблатура от {{author_username}}!</h4>
			Потребилят <a href="http://<?php echo Config::DOMAIN ?>/profile/{{author_id}}" style="color: #F84241;">{{author_username}}</a>  написа:
			<div style="padding: 9.5px; margin: 20px 0 10px; line-height: 1.4286; word-break: break-all; word-wrap: break-word;
					color: #333; background-color: #f5f5f5; border: 1px solid #ccc; border-radius: 4px;">
				{{content}}
			</div>
			<br>
			За да отговорите, отворете <a href="http://<?php echo Config::DOMAIN ?>/tab/{{tab_id}}" style="color: #F84241;">таблатурата</a>.
		</div>
		<?php include 'common/footer.php' ?>
    </body>
</html>
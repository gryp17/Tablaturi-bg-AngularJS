<!DOCTYPE html>
<html>
    <head>
        <title>
			<?= $data['title'] ?>
		</title>
        <meta charset="UTF-8">
		<meta property="og:url" content="<?= $data['url'] ?>"/>
		<meta property="og:title" content="<?= $data['title'] ?>"/>
		<meta property="og:description" content="<?= $data['description'] ?>"/>
		<meta property="og:image" content="<?= $data['image'] ?>"/>
		<meta property="og:image:height" content="200"/>
		<meta property="og:image:width" content="200"/>
		<meta property="og:site_name" content="Tablaturi-bg.com" />
				
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="@tablaturibg" />
		<meta name="twitter:url" content="<?= $data['url'] ?>" />
		<meta name="twitter:title" content="<?= $data['title'] ?>" />
		<meta name="twitter:description" content="<?= $data['description'] ?>" />
		<meta name="twitter:image" content="<?= $data['image'] ?>" />
		<meta name="twitter:image:src" content="<?= $data['image'] ?>" />
    </head>
    <body>
		<?= $data['description'] ?>
	</body>
</html>
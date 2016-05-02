<!DOCTYPE html>
<html ng-app="tablaturi-bg" ng-controller="layoutController">
    <head>
        <title>Tablaturi-BG</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>
        <link href="static/stylesheets/style.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="ng-cloak" ng-cloak>
        <div id="main-wrapper">

			<?php include "_header.php" ?>
			<?php include "_search.php" ?>

			<div class="left-ads">left</div>

			<div id="content-wrapper">

				<div class="loading-placeholder">
					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
					<rect fill="#fff" width="3" height="100" transform="translate(0) rotate(180 3 50)">
					<animate
						attributeName="height"
						attributeType="XML"
						dur="1s"
						values="30; 100; 30"
						repeatCount="indefinite"/>
					</rect>
					<rect x="17" fill="#fff" width="3" height="100" transform="translate(0) rotate(180 20 50)">
					<animate
						attributeName="height"
						attributeType="XML"
						dur="1s"
						values="30; 100; 30"
						repeatCount="indefinite"
						begin="0.1s"/>
					</rect>
					<rect x="40" fill="#fff" width="3" height="100" transform="translate(0) rotate(180 40 50)">
					<animate
						attributeName="height"
						attributeType="XML"
						dur="1s"
						values="30; 100; 30"
						repeatCount="indefinite"
						begin="0.3s"/>
					</rect>
					<rect x="60" fill="#fff" width="3" height="100" transform="translate(0) rotate(180 58 50)">
					<animate
						attributeName="height"
						attributeType="XML"
						dur="1s"
						values="30; 100; 30"
						repeatCount="indefinite"
						begin="0.5s"/>
					</rect>
					<rect x="80" fill="#fff" width="3" height="100" transform="translate(0) rotate(180 76 50)">
					<animate
						attributeName="height"
						attributeType="XML"
						dur="1s"
						values="30; 100; 30"
						repeatCount="indefinite"
						begin="0.1s"/>
					</rect>
					</svg>
				</div>
				<div id="view-wrapper">
					<section ng-view="">
					</section>
				</div>
			</div>

			<div class="right-ads">right</div>

			<div class="bottom-ad"></div>

			<?php include "_footer.php" ?>
        </div>

		<?php include "_login.php" ?>
		<?php include "_signup.php" ?>
		
		<script type="text/javascript" src="static/scripts/app.js"></script>
    </body>
</html>

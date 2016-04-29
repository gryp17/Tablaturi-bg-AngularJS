<!DOCTYPE html>
<html ng-app="tablaturi-bg" ng-controller="layoutController">
    <head>
        <title>Tablaturi-BG</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>
        <link href="static/stylesheets/style.min.css" rel="stylesheet" type="text/css"/>	
        <script type="text/javascript" src="static/scripts/app.js"></script>	
    </head>
    <body>
        <div id="main-wrapper">

			<?php include "header.php" ?>
			<?php include "search.php" ?>

			<div class="left-ads">left</div>

			<section id="content-wrapper" ng-view="">
			</section>

			<div class="right-ads">right</div>

			<div class="bottom-ad"></div>

			<?php include "footer.php" ?>
        </div>
    </body>
</html>

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

			<div class="left-ads">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- left-ad -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:120px;height:600px"
                     data-ad-client="ca-pub-0878746760349023"
                     data-ad-slot="9165853768"></ins>
                <script>
			(adsbygoogle = window.adsbygoogle || []).push({});
                </script>
			</div>

			<section id="content-wrapper" ng-view="">
			</section>

			<div class="right-ads">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- right-ad -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:120px;height:600px"
                     data-ad-client="ca-pub-0878746760349023"
                     data-ad-slot="4596053365"></ins>
                <script>
			(adsbygoogle = window.adsbygoogle || []).push({});
                </script>
			</div>

			<div class="bottom-ad">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- angular-bottom-ad -->
				<ins class="adsbygoogle"
					 style="display:block"
					 data-ad-client="ca-pub-0878746760349023"
					 data-ad-slot="4493479761"
					 data-ad-format="auto"></ins>
				<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
			<?php include "footer.php" ?>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html ng-app="tablaturi-bg" ng-controller="layoutController">
    <head>
        <title>Tablaturi-bg - Най-големият български сайт за таблатури</title>
		
	<base href="/Tablaturi-bg-angular/" />
		
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="таблатури,новини,уроци,китара,партитури,пиано,бас китара,tabs,news,lessons,piano" >
				
		<meta name="description" content="Най-големият български сайт за таблатури, новини, уроци и полезни програми за начинаещи и напреднали китаристи." /> 
        <meta name="dc.language" CONTENT="BG">
        <meta name="dc.source" CONTENT="http://www.tablaturi-bg.com">
        <meta name="dc.title" CONTENT="Най-големият български сайт за таблатури">
        <meta name="dc.keywords" CONTENT="таблатури,новини,уроци,китара,партитури,пиано,бас китара,tabs,news,lessons,piano">
        <meta name="dc.description" CONTENT="Най-големият български сайт за таблатури, новини, уроци и полезни програми за начинаещи и напреднали китаристи.">
        <meta name="geo.placename" content="Bulgaria" />
		
		<link href="static/img/favicon.ico" rel="icon"/>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600" rel="stylesheet" type="text/css"/>
        <link href="static/stylesheets/css/style.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="ng-cloak" ng-cloak>
        <div id="main-wrapper">

			<?php include "_header.php" ?>
			<?php include "_search.php" ?>

			<div class="left-wrapper">
				<!-- default ad -->
				<div>
					left ad
				</div>
				<!-- additional ad -->
				<div ng-show="contentWrapperHeight > 1250" class="additional">
					additional left ad
				</div>
			</div>

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
					<section ng-view="" autoscroll="true">
					</section>
				</div>
			</div>

			<div class="right-wrapper">
				<div>
					right ad
				</div>
				<!-- additional ad -->
				<div ng-show="contentWrapperHeight > 1250" class="additional">
					additional right ad
				</div>
			</div>

			<div class="bottom-wrapper">
				bottom ad
			</div>

			<?php include "_footer.php" ?>
        </div>

		<?php include "_login.php" ?>
		<?php include "_signup.php" ?>
		
		<script type="text/javascript" src="static/scripts/app.js"></script>
		<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">stLight.options({publisher: "d810d696-98a7-44a2-abcf-4604f3730c9f", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>
    
		<!-- Begin Cookie Consent plugin -->
		<script type="text/javascript">
			window.cookieconsent_options = new Object();
			window.cookieconsent_options.message = "Този сайт използва бисквитки (cookies).";
			window.cookieconsent_options.dismiss = "Разбрах";
			window.cookieconsent_options.learnMore = "";
			window.cookieconsent_options.link = null;
			window.cookieconsent_options.theme = "light-bottom";
		</script>

		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
		<!-- End Cookie Consent plugin -->
			
	</body>
</html>

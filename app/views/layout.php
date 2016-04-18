<!DOCTYPE html>
<html ng-app="tablaturi-bg">
    <head>
        <title>Tablaturi-BG</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link href="static/stylesheets/style.min.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="static/scripts/app.js"></script>
		
    </head>
    <body>
        <div id="main-wrapper" class="container-fluid">
            <div class="row">
                <section id="content-wrapper">
                    <img src="static/img/logo-tablaturi-bg.png"/>
                    <div ng-view=""></div>
                </section>
            </div>
        </div>
    </body>
</html>

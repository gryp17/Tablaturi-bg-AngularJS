<?php

require_once 'config/Config.php';
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/DB.php';

#angularJS ajax POST hack...
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)) {
	$_POST = json_decode(file_get_contents('php://input'), true);
}

$app = new App();



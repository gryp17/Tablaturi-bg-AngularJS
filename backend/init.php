<?php

#mbstring encoding
mb_internal_encoding('UTF-8');

require_once 'config/Config.php';
require_once 'core/ErrorCodes.php';
require_once 'core/App.php';
require_once 'core/Validator.php';
require_once 'core/Controller.php';
require_once 'core/DB.php';
require_once 'core/Utils.php';
require_once 'libs/captcha/captcha.php';

session_start();

#angularJS ajax POST hack...
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)) {
	$_POST = json_decode(file_get_contents('php://input'), true);
}

$app = new App();



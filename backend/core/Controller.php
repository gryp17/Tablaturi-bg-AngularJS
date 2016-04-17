<?php

class Controller {
	#permissions

	const PUBLIC_ACCESS = 1;
	const LOGGED_IN_USER = 2;
	const ADMIN_USER = 3;
	const ACCESS_DENIED = 'Access denied!';

	public $valid_categories = array(
		'politics',
		'economy',
		'world',
		'technology',
		'sport'
	);

	/**
	 * Checks if the user has the required permissions
	 * @param int $required_role
	 * @return boolean
	 */
	function checkPermission($required_role) {
		$result = false;
		session_start();

		switch ($required_role) {
			case self::PUBLIC_ACCESS:
				$result = true;
				break;
			case self::LOGGED_IN_USER:
				#TODO: check if the user is logged in
				break;
			case self::ADMIN_USER:
				#TODO: check if the user is logged in and is admin
				break;
		}

		return $result;
	}

	public function load_model($model) {
		#echo $model;
		require_once "backend/models/$model.php";

		return new $model();
	}

	public function load_view($view, $data = array()) {
		require_once "app/views/$view.php";
	}

}

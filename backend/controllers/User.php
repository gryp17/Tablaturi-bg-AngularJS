<?php

class User extends Controller {

	public function index() {
		
	}

	/**
	 * List of required parameters for each API function
	 * also indicates the parameter type
	 */
	public $required_params = array(
		"login" => array(
			"username" => "required",
			"password" => "required"
		),
			/*
			  'getArticles' => array(
			  'limit' => 'int',
			  'offset' => 'int'
			  ),
			  'getArticlesByDate' => array(
			  'date' => 'date',
			  'limit' => 'int',
			  'offset' => 'int'
			  ), */
			/*
			  'getArticlesBySearch' => array(
			  'search_val' => '+'
			  ),
			  'getLatestArticleDate' => array(),
			  'getArticle' => array(
			  'id' => 'int'
			  ),
			  'addArticleView' => array(
			  'id' => 'int'
			  ) */
	);

	/**
	 * Checks if the username and password credentials match and starts the session
	 */
	public function login() {
		$required_role = Controller::PUBLIC_ACCESS;
		if ($this->checkPermission($required_role) == true) {

			$params = $this->getRequestParams();

			$user_model = $this->load_model("User_model");
			$data = $user_model->checkLogin($params["username"], $params["password"]);

			if ($data === false) {
				$this->sendResponse(0, array("field" => "password", "error_code" => "invalid_login"));
			} else {
				$_SESSION["user"] = $data;
				$this->sendResponse(1, $data);
			}
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}
	
	/**
	 * Logs out the user
	 */
	public function logout() {
		$required_role = Controller::PUBLIC_ACCESS;
		if ($this->checkPermission($required_role) == true) {

			$params = $this->getRequestParams();
			session_destroy();
			unset($_SESSION["user"]);
			$this->sendResponse(1, true);
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}

	/**
	 * Checks if the user session is set
	 */
	public function isLoggedIn() {
		$required_role = Controller::PUBLIC_ACCESS;
		if ($this->checkPermission($required_role) == true) {

			$params = $this->getRequestParams();

			if (isset($_SESSION["user"])) {
				$this->sendResponse(1, array("logged_in" => true, "user" => $_SESSION["user"]));
			} else {
				$this->sendResponse(1, array("logged_in" => false));
			}
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}

}

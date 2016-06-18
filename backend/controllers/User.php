<?php

class User extends Controller {

	public function __construct() {

		/**
		 * List of required parameters and permissions for each API endpoint
		 * also indicates the parameter type
		 */
		$this->endpoints = array(
			'login' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'login_username' => 'required',
					'login_password' => 'required',
					'login_remember_me' => 'in[1;0;]' //(1 or 0 or empty space) boolean?
				)
			),
			'logout' => array(
				'required_role' => self::PUBLIC_ACCESS
			),
			'isLoggedIn' => array(
				'required_role' => self::PUBLIC_ACCESS
			),
			'signup' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'signup_username' => 'min-6, max-20, valid-characters, unique[username]',
					'signup_email' => 'valid-email, unique[email]',
					'signup_password' => 'min-6, max-20, strong-password',
					'signup_repeat_password' => 'matches[signup_password]',
					'signup_birthday' => 'date',
					'signup_gender' => 'in[M;F]',
					'signup_captcha' => 'matches-captcha'
				)
			),
			'getUser' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => array(
					'id' => 'required, int'
				)
			)
		);
		
		#request params
		$this->params = $this->checkRequest();
	}

	public function index() {
		
	}

	/**
	 * Checks if the username and password credentials match and starts the session
	 */
	public function login() {
		$user_model = $this->load_model('User_model');
		$data = $user_model->checkLogin($this->params['login_username'], $this->params['login_password']);

		if ($data === false) {
			$this->sendResponse(0, array('field' => 'login_password', 'error_code' => 'invalid_login'));
		} else {

			//if the remember me option is set to true - keep the user session for 90 days	
			if (isset($this->params['login_remember_me']) && $this->params['login_remember_me']) {
				setcookie(session_name(), session_id(), strtotime('+90 days'), '/');
			}
			//otherwise keep until the browser is closed (default)
			else {
				setcookie(session_name(), session_id(), 0, '/');
			}

			$_SESSION['user'] = $data;
			$this->sendResponse(1, $data);
		}
	}

	/**
	 * Logs out the user
	 */
	public function logout() {
		session_destroy();
		unset($_SESSION['user']);
		$this->sendResponse(1, true);
	}

	/**
	 * Checks if the user session is set
	 */
	public function isLoggedIn() {
		if (isset($_SESSION['user'])) {
			$this->sendResponse(1, array('logged_in' => true, 'user' => $_SESSION['user']));
		} else {
			$this->sendResponse(1, array('logged_in' => false));
		}
	}

	/**
	 * New user signup
	 */
	public function signup() {
		$user_model = $this->load_model('User_model');
		$user_model->insertUser($this->params['signup_username'], $this->params['signup_password'], $this->params['signup_email'], $this->params['signup_birthday'], $this->params['signup_gender'], null, 'user');

		if (Utils::sendConfirmationEmail($this->params['signup_username'], $this->params['signup_email'])) {
			$this->sendResponse(1, true);
		} else {
			$this->sendResponse(0, Controller::EMAIL_ERROR);
		}
	}

	/**
	 * Returns the specified user data
	 */
	public function getUser() {
		$user_model = $this->load_model('User_model');
		$data = $user_model->getUser($this->params['id']);

		$this->sendResponse(1, $data);
	}

}

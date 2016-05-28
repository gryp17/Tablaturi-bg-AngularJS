<?php

class User extends Controller {

	public function index() {
		
	}

	/**
	 * List of required parameters for each API function
	 * also indicates the parameter type
	 */
	public $required_params = array(
		'login' => array(
			'login_username' => 'required',
			'login_password' => 'required',
			'login_remember_me' => 'in[1;0;]' //(1 or 0 or empty space) boolean?
		),
		'signup' => array(
			'signup_username' => 'min-6, max-20, valid-characters, unique[username]',
			'signup_email' => 'valid-email, unique[email]',
			'signup_password' => 'min-6, max-20, strong-password',
			'signup_repeat_password' => 'matches[signup_password]',
			'signup_birthday' => 'date',
			'signup_gender' => 'in[M;F]',
			'signup_captcha' => 'matches-captcha'
		),
		'getUser' => array(
			'id' => 'required, int'
		)
	);

	/**
	 * Checks if the username and password credentials match and starts the session
	 */
	public function login() {
		$required_role = Controller::PUBLIC_ACCESS;
		if ($this->checkPermission($required_role) == true) {

			$params = $this->getRequestParams();

			$user_model = $this->load_model('User_model');
			$data = $user_model->checkLogin($params['login_username'], $params['login_password']);
			
			if ($data === false) {
				$this->sendResponse(0, array('field' => 'login_password', 'error_code' => 'invalid_login'));
			} else {
				
				//if the remember me option is set to true - keep the user session for 90 days	
				if(isset($params['login_remember_me']) && $params['login_remember_me']){
					setcookie(session_name(), session_id(), strtotime( '+90 days' ), '/');
				}
				//otherwise keep until the browser is closed (default)
				else{
					setcookie(session_name(), session_id(), 0, '/');
				}
				
				$_SESSION['user'] = $data;
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
			session_destroy();
			unset($_SESSION['user']);
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
			if (isset($_SESSION['user'])) {
				$this->sendResponse(1, array('logged_in' => true, 'user' => $_SESSION['user']));
			} else {
				$this->sendResponse(1, array('logged_in' => false));
			}
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}
	
	/**
	 * New user signup
	 */
	public function signup() {
		$required_role = Controller::PUBLIC_ACCESS;
		if ($this->checkPermission($required_role) == true) {
			
			$params = $this->getRequestParams();
			
			$user_model = $this->load_model('User_model');
			$user_model->insertUser($params['signup_username'], $params['signup_password'], $params['signup_email'], $params['signup_birthday'], $params['signup_gender'], null, 'user');
			
			if(Utils::sendConfirmationEmail($params['signup_username'], $params['signup_email'])){
				$this->sendResponse(1, true);
			}else{
				$this->sendResponse(0, Controller::EMAIL_ERROR);
			}
			
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}
	
	/**
	 * Returns the specified user data
	 */
	public function getUser() {
		$required_role = Controller::LOGGED_IN_USER;
		if ($this->checkPermission($required_role) == true) {
			
			$params = $this->getRequestParams();
			
			$user_model = $this->load_model('User_model');
			$data = $user_model->getUser($params['id']);
			
			$this->sendResponse(1, $data);
			
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}

}

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
					'login_remember_me' => 'in[1,0,]' //(1 or 0 or empty space) boolean?
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
					'signup_username' => array('min-6', 'max-20', 'valid-characters', 'unique[username]'),
					'signup_email' => array('valid-email', 'unique[email]'),
					'signup_password' => array('min-6', 'max-20', 'strong-password'),
					'signup_repeat_password' => 'matches[signup_password]',
					'signup_birthday' => 'date',
					'signup_gender' => 'in[M,F]',
					'signup_captcha' => 'matches-captcha'
				)
			),
			'getUser' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => array(
					'id' => array('required', 'int')
				)
			),
			'updateUser' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => array(
					'avatar' => array('optional', 'valid-file-extensions[png,jpg,jpeg]', 'max-file-size-1000'),
					'password' => array('optional', 'min-6', 'max-20', 'strong-password'),
					'repeat_password' => 'matches[password]',
					'location' => array('optional', 'max-100'),
					'occupation' => array('optional', 'max-200'),
					'web' => array('optional', 'max-200'),
					'about_me' => array('optional', 'max-500'),
					'instrument' => array('optional', 'max-500'),
					'favourite_bands' => array('optional', 'max-500')
				)
			),
			'search' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => array(
					'keyword' => array('required', 'min-3', 'max-50'),
					'limit' => 'int',
					'offset' => 'int'
				)
			),
			'getTotalSearchResults' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => array(
					'keyword' => array('required', 'min-3', 'max-50'),
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
		$user_model = $this->load_model('UserModel');
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
	 * Also updates the last_active date/time of the user
	 */
	public function isLoggedIn() {
		if (isset($_SESSION['user'])) {
			$user_model = $this->load_model('UserModel');
			$user_model->updateActivity($_SESSION['user']['ID']);
			$this->sendResponse(1, array('logged_in' => true, 'user' => $_SESSION['user']));
		} else {
			$this->sendResponse(1, array('logged_in' => false));
		}
	}

	/**
	 * New user signup
	 */
	public function signup() {
		$user_model = $this->load_model('UserModel');
		$user_id = $user_model->insertUser($this->params['signup_username'], $this->params['signup_password'], $this->params['signup_email'], $this->params['signup_birthday'], $this->params['signup_gender'], null, 'user');

		if($user_id !== null){
			$activation = $this->generateActivationLink($user_id, $this->params['signup_email']);

			//insert the activation data into the database
			$user_activation_model = $this->load_model('UserActivationModel');
			$user_activation_model->insertHash($user_id, $activation['hash']);
			
			//send the confirmation email
			if (Utils::sendConfirmationEmail($this->params['signup_username'], $this->params['signup_email'], $activation['link'])) {
				$this->sendResponse(1, true);
			} else {
				$this->sendResponse(0, Controller::EMAIL_ERROR);
			}
		}else{
			$this->sendResponse(0, Controller::DB_ERROR);
		}
	}
	
	/**
	 * Generates an activation link
	 * @param int $user_id
	 * @param string $email
	 * @return array
	 */
	private function generateActivationLink($user_id, $email){
		$domain = Config::DOMAIN;
		
		$hash = md5($email) . md5(mt_rand(0, 999999));
		$link = "http://$domain/activate/$user_id/$hash";

		return array(
			'link' => $link,
			'hash' => $hash
		);
	}

	/**
	 * Returns the specified user data
	 */
	public function getUser() {
		$user_model = $this->load_model('UserModel');
		$data = $user_model->getUser($this->params['id']);

		$this->sendResponse(1, $data);
	}

	/**
	 * Updates the user's data
	 */
	public function updateUser() {
		$user_model = $this->load_model('UserModel');
		$new_avatar = '';

		#if there is a submited avatar
		if ($_FILES['avatar']['error'] !== 4) {
			$new_avatar = $this->uploadUserAvatar('avatar', $_SESSION['user']['ID'], $_SESSION['user']['photo']);
		}

		#update the user data and reload the $_SESSION user
		if ($user_model->updateUser($_SESSION['user']['ID'], $this->params['password'], $this->params['location'], $this->params['occupation'], $this->params['web'], $this->params['about_me'], $this->params['instrument'], $this->params['favourite_bands'], $new_avatar)) {
			$_SESSION['user'] = $user_model->getUser($_SESSION['user']['ID']);
			$this->sendResponse(1, true);
		}
	}

	/**
	 * Helper function that uploads the new avatar
	 * returns the new avatar file name
	 * @param string $field_name
	 * @param int $user_id
	 * @param string $current_avatar
	 * @return string
	 */
	private function uploadUserAvatar($field_name, $user_id, $current_avatar) {
		$avatars_dir = Config::AVATARS_DIR;

		preg_match('/\.([^\.]+?)$/', $_FILES[$field_name]['name'], $matches);
		$extension = strtolower($matches[1]);
		$extension = '.' . $extension;

		#delete the old avatar
		if (file_exists($avatars_dir . $current_avatar) && !preg_match('/default/is', $current_avatar)) {
			unlink($avatars_dir . $current_avatar);
		}

		#upload the file to the server
		move_uploaded_file($_FILES[$field_name]['tmp_name'], $avatars_dir . '/avatar-' . $user_id . $extension);
		$avatar = 'avatar-' . $user_id . $extension;

		return $avatar;
	}

	/**
	 * Searches for users using the provided keyword
	 */
	public function search() {
		$user_model = $this->load_model('UserModel');
		$data = $user_model->search($this->params['keyword'], $this->params['limit'], $this->params['offset']);

		$this->sendResponse(1, $data);
	}

	/**
	 * Returns the total number of users that match the search
	 */
	public function getTotalSearchResults() {
		$user_model = $this->load_model('UserModel');
		$data = $user_model->getTotalSearchResults($this->params['keyword']);

		$this->sendResponse(1, $data);
	}

}

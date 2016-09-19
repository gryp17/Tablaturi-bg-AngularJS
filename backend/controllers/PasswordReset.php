<?php

class PasswordReset extends Controller {

	public function __construct() {

		/**
		 * List of required parameters and permissions for each API endpoint
		 * also indicates the parameter type
		 */
		$this->endpoints = array(
			'sendPasswordResetRequest' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'forgotten_password_email' => array('required', 'valid-email')
				)
			),
			'checkPasswordResetHash' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'user_id' => 'required',
					'hash' => 'required'
				)
			)
		);

		#request params
		$this->params = $this->checkRequest();
	}

	public function index() {
		
	}

	/**
	 * Resets the user password and sends it via email
	 */
	public function sendPasswordResetRequest() {
		$user_model = $this->load_model('UserModel');	
		$user_data = $user_model->getUserByEmail($this->params['forgotten_password_email']);
		
		if($user_data !== null){
			$password_reset = $this->generatePasswordResetLink($user_data['ID'], $this->params['forgotten_password_email']);
			
			$password_reset_model = $this->load_model('PasswordResetModel');
			$password_reset_model->insertHash($user_data['ID'], $password_reset['hash']);
			
			if(Utils::sendPasswordResetEmail($this->params['forgotten_password_email'], $password_reset['link'])){
				$this->sendResponse(1, true);
			} else {
				$this->sendResponse(0, ErrorCodes::EMAIL_ERROR);
			}
			
		}else{
			$this->sendResponse(0, array('field' => 'forgotten_password_email', 'error_code' => ErrorCodes::EMAIL_NOT_FOUND));
		}
	}
	
	/**
	 * Generates a password reset request link
	 * @param int $user_id
	 * @param string $email
	 * @return array
	 */
	private function generatePasswordResetLink($user_id, $email){
		$domain = Config::DOMAIN;

		$hash = Utils::generateRandomToken($email);
		$link = "http://$domain/#/change-password/$user_id/$hash";

		return array(
			'link' => $link,
			'hash' => $hash
		);
	}
	
	/**
	 * Checks if the user_id/hash combination exists in the database and it hasn't expired yet
	 */
	public function checkPasswordResetHash() {
		$password_reset_model = $this->load_model('PasswordResetModel');
		
		if($password_reset_model->checkHash($this->params['user_id'], $this->params['hash'])){
			$this->sendResponse(1, true);
		}else{
			$this->sendResponse(0, false);
		}
	}

}

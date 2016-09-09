<?php

class UserActivation extends Controller {

	public function __construct() {

		/**
		 * List of required parameters and permissions for each API endpoint
		 * also indicates the parameter type
		 */
		$this->endpoints = array(
			'activateUser' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'user_id' => 'required',
					'hash' => 'required'
				)
			),
		);

		#request params
		$this->params = $this->checkRequest();
	}

	public function index() {
		
	}

	/**
	 * Checks if the provided hash is correct and activates the user account
	 */
	public function activateUser() {
		$user_activation_model = $this->load_model('UserActivationModel');
		
		//if the hash is valid and 24 hours haven't passed yet
		if($user_activation_model->checkHash($this->params['user_id'], $this->params['hash'])){
			if($user_activation_model->activateUser($this->params['user_id'])){
				$this->sendResponse(1, true);
			}else{
				$this->sendResponse(0, false);
			}
		}else{
			$this->sendResponse(0, false);
		}
		
	}

}

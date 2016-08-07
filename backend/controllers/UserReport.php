<?php

class UserReport extends Controller {

	public function __construct() {

		/**
		 * List of required parameters and permissions for each API endpoint
		 * also indicates the parameter type
		 */
		$this->endpoints = array(
			'reportUser' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => array(
					'user_id' => 'int',
					'report' => array('min-3', 'max-1000')
				)
			)
		);
		
		#request params
		$this->params = $this->checkRequest();
	}

	public function index() {
		
	}
	
	/**
	 * Reports the provided user ID
	 */
	public function reportUser() {
		$user_report_model = $this->load_model('UserReportModel');
		$user_model = $this->load_model('UserModel');
		
		$reported_user = $user_model->getUser($this->params['user_id']);
		
		if(isset($reported_user) && $reported_user !== null){
			$user_report_model->reportUser($this->params['user_id'], $_SESSION['user']['ID'], $this->params['report']);
			Utils::sendUserReportEmail($reported_user, $_SESSION['user'], $this->params['report']);
		}
		
		$this->sendResponse(1, true);
	}
	

}

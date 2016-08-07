<?php

class Misc extends Controller {

	public function __construct() {

		/**
		 * List of required parameters and permissions for each API endpoint
		 * also indicates the parameter type
		 */
		$this->endpoints = array(
			'generateCaptcha' => array(
				'required_role' => self::PUBLIC_ACCESS,
			),
			'contactUs' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'username' => array('min-3', 'max-20', 'valid-characters'),
					'email' => 'valid-email',
					'message' => 'required',
					'captcha' => 'matches-captcha'
				)
			)
		);

		#request params
		$this->params = $this->checkRequest();
	}

	public function index() {
		
	}

	/**
	 * Generates new captcha image
	 */
	public function generateCaptcha() {
		#captcha code
		$_SESSION['captcha'] = simple_php_captcha();
		#img source fix
		$captchaImage = preg_replace('/.*?\/backend/', 'backend', $_SESSION['captcha']['image_src']);

		$this->sendResponse(1, $captchaImage);
	}

	/**
	 * Sends contact us email 
	 */
	public function contactUs() {
		if (Utils::sendContactUsEmail($this->params['username'], $this->params['email'], $this->params['message'])) {
			$this->sendResponse(1, true);
		} else {
			$this->sendResponse(0, Controller::EMAIL_ERROR);
		}
	}

}

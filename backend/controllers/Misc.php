<?php

class Misc extends Controller {

	public function index() {
		
	}

	/**
	 * List of required parameters for each API function
	 * also indicates the parameter type
	 */
	public $required_params = array(
		'contactUs' => array(
			'username' => 'min-3, max-20, valid-characters',
			'email' => 'valid-email',
			'message' => 'required',
			'captcha' => 'matches-captcha'
		)
	);
	
	/**
	 * Generates new captcha image
	 */
	public function generateCaptcha() {
		$required_role = Controller::PUBLIC_ACCESS;
		if ($this->checkPermission($required_role) == true) {
			
			#captcha code
			$_SESSION['captcha'] = simple_php_captcha();
			#img source fix
			$captchaImage = preg_replace('/.*?\/backend/', 'backend', $_SESSION['captcha']['image_src']);
			
			$this->sendResponse(1, $captchaImage);
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}


	/**
	 * Sends contact us email 
	 */
	public function contactUs() {
		$required_role = Controller::PUBLIC_ACCESS;
		if ($this->checkPermission($required_role) == true) {

			$params = $this->getRequestParams();

			if(Utils::sendContactUsEmail($params['username'], $params['email'], $params['message'])){
				$this->sendResponse(1, true);
			}else{
				$this->sendResponse(0, Controller::EMAIL_ERROR);
			}
			
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}
	
	

}

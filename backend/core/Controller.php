<?php

class Controller {
	#permissions

	const PUBLIC_ACCESS = 1;
	const LOGGED_IN_USER = 2;
	const ADMIN_USER = 3;
	const ACCESS_DENIED = 'Access denied!';
	const DB_ERROR = 'Query failed!';
	const EMAIL_ERROR = 'Send email failed!';

	public $required_params;

	/**
	 * Returns all REQUEST and POST parameters
	 * also checks if the required parameters are present
	 * @return array
	 */
	public function getRequestParams() {
		$params = array();

		$_POST = is_array($_POST) ? $_POST : array();

		#merge the request and post params
		$request_data = array_merge($_REQUEST, $_POST);

		#extract all request params
		foreach ($request_data as $key => $value) {
			$key = trim($key);
			$value = trim($value);
			$params[$key] = $value;
		}

		if (!isset($params['url'])) {
			$this->sendResponse(0, 'Invalid request.');
		}

		#validate all required params
		$this->validateParams($params);

		return $params;
	}

	/**
	 * Validates all required parameters for the called function
	 * @param array $params
	 */
	private function validateParams($params) {
		$function = array_pop(explode('/', $params['url']));

		if (isset($this->required_params[$function])) {
			foreach ($this->required_params[$function] as $param_name => $rules) {
				$value = isset($params[$param_name]) ? $params[$param_name] : '';
				$rules = split(',', $rules);

				foreach ($rules as $rule) {
					$rule = trim($rule);

					#check the value with each rule and send the error message if necessary
					$result = Validator::checkParam($param_name, $value, $rule, $params);
					if ($result !== true) {
						$this->sendResponse(0, $result);
					}
				}
			}
		}
	}

	/**
	 * Checks if the user has the required permissions
	 * @param int $required_role
	 * @return boolean
	 */
	public function checkPermission($required_role) {
		$result = false;

		switch ($required_role) {
			case self::PUBLIC_ACCESS:
				$result = true;
				break;
			case self::LOGGED_IN_USER:
				if (isset($_SESSION['user'])) {
					$result = true;
				}
				break;
			case self::ADMIN_USER:
				#TODO: check if the user is logged in and is admin
				break;
		}

		return $result;
	}

	/**
	 * Outputs the AJAX response
	 * @param int $status
	 * @param array $data
	 */
	public function sendResponse($status, $data) {
		$response = array('status' => $status);

		if ($status == 1) {
			if (!is_null($data)) {
				$response['data'] = $data;
			}
		} else {
			$response['error'] = $data;
		}

		header('Content-Type: application/json');
		die(json_encode($response));
	}

	/**
	 * Returns new instance of the specified model
	 * @param String $model
	 * @return Object
	 */
	public function load_model($model) {
		#echo $model;
		require_once "backend/models/$model.php";

		return new $model();
	}

	/**
	 * Loads the required view
	 * @param String $view
	 * @param Array $data
	 */
	public function load_view($view, $data = array()) {
		require_once "app/views/$view.php";
	}
	
	/**
	 * Sanitizes the provided data
	 * @param string $data
	 * @return string
	 */
	public function sanitize($data, $strip_tags = false){
		if($strip_tags){
			$data = strip_tags($data);
		}
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

}

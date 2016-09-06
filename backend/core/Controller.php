<?php

class Controller {
	#permissions

	const PUBLIC_ACCESS = 1;
	const LOGGED_IN_USER = 2;
	const ADMIN_USER = 3;
	const INVALID_REQUEST = 'invalid_request';
	const ACCESS_DENIED = 'access_denied';
	const NOT_FOUND = 'not_found';
	const DB_ERROR = 'query_failed';
	const EMAIL_ERROR = 'send_email_failed';

	public $endpoints;
	public $params;

	/**
	 * Checks the required params and permissions for the requested endpoint
	 * if all checks are successfull - returns all request params
	 * @return array
	 */
	public function checkRequest() {
		$params = $this->getRequestParams();

		#validate all required params
		$this->validateParams($params);

		#check the permissions
		$this->checkPermissions($params);

		return $params;
	}

	/**
	 * Returns all REQUEST and POST parameters
	 * also checks if the required parameters are present
	 * @return array
	 */
	private function getRequestParams() {
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
			$this->sendResponse(0, self::INVALID_REQUEST);
		}

		return $params;
	}

	/**
	 * Validates all required parameters for the called function
	 * @param array $params
	 */
	private function validateParams($params) {
		$url_segments = explode('/', $params['url']);
		$function = array_pop($url_segments);

		#check all params
		if (isset($this->endpoints[$function])) {
			if (isset($this->endpoints[$function]['params'])) {
				$required_params = $this->endpoints[$function]['params'];
				foreach ($required_params as $param_name => $rules) {
					$value = isset($params[$param_name]) ? $params[$param_name] : '';
					
					if(!is_array($rules)){
						$rules = array($rules);
					}

					#check the value with each rule and send the error message if necessary
					$result = Validator::checkParam($param_name, $value, $rules, $params);
					if ($result !== true) {
						$this->sendResponse(0, $result);
					}
				}
			}
		} else {
			$this->sendResponse(0, self::NOT_FOUND);
		}
	}

	/**
	 * Checks if the user has the required permissions
	 * @param array $params
	 */
	private function checkPermissions($params) {
		$result = false;

		$url_segments = explode('/', $params['url']);
		$function = array_pop($url_segments);

		#check if the required permissions for that api endpoint are met
		if (isset($this->endpoints[$function])) {
			$required_role = $this->endpoints[$function]['required_role'];

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
					if (isset($_SESSION['user']) && $_SESSION['user']['type'] === 'admin') {
						$result = true;
					}
					break;
			}
		}

		if (!$result) {
			$this->sendResponse(0, self::ACCESS_DENIED);
		}
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
	 * Outputs the file download response
	 * @param string $content_type
	 * @param string $filename
	 * @param string $content
	 */
	public function sendFileResponse($content_type, $filename, $content) {
		header('Content-type: '.$content_type);
		header("Content-Disposition: attachment; filename=\"$filename\"");
		die($content);
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
	public function sanitize($data, $strip_tags = false) {
		if ($strip_tags) {
			$data = strip_tags($data);
		}
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

}

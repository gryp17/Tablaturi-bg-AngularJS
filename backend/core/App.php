<?php

class App {

	protected $controller = 'Layout';
	protected $method = 'index';
	protected $params = array();

	public function __construct() {
		$url = $this->parseUrl();
		
		#check if the controller exists
		if (file_exists("backend/controllers/$url[0].php")) {
			$this->controller = $url[0];
			#remove the controller from the array
			unset($url[0]);
		}
		
		#include the controller file and create new object from that type
		require_once "backend/controllers/$this->controller.php";
		$this->controller = new $this->controller;

		#check if the function exists
		if (isset($url[1])) {
			if (method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				#remove the function from the array
				unset($url[1]);
			}
		}

		#check if there are parameters
		if (isset($url)) {
			$this->params = array_values($url);
		} else {
			$this->params = array();
		}
		
		#call the function
		call_user_func_array(array($this->controller, $this->method), $this->params);
	}

	public function parseUrl() {
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			return explode('/', $url);
		}
	}

}

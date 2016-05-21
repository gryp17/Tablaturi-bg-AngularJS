<?php

class Tab extends Controller {

	public function index() {
	
	}

	/**
	 * List of required parameters for each API function
	 * also indicates the parameter type
	 */
	public $required_params = array(
		'getMost' => array(
			'type' => 'in[popular;liked;latest;commented]',
			'limit' => 'int'
		)
		/*
		'getArticlesByDate' => array(
			'date' => 'date',
			'limit' => 'int',
			'offset' => 'int'
		)*/
	);


	/**
	 * Returns the total number of tabs in the database
	 */
	public function getTabsCount() {
		$required_role = Controller::PUBLIC_ACCESS;
		
		if ($this->checkPermission($required_role) == true) {
			$tab_model = $this->load_model('Tab_model');
			$data = $tab_model->getTabsCount();
			$this->sendResponse(1, $data);
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}
	
	public function getMost() {
		$required_role = Controller::PUBLIC_ACCESS;
		
		if ($this->checkPermission($required_role) == true) {
			$params = $this->getRequestParams();
			
			$tab_model = $this->load_model('Tab_model');
			$data = $tab_model->getMost($params['type'], $params['limit']);
			$this->sendResponse(1, $data);
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}
	
	
}

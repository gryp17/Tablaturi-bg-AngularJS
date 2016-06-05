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
		),
		'autocomplete' => array(
			'type' => 'in[band;song]',
			'term' => 'required'
		),
		'search' => array(
			'type' => 'in[all;tab;chord;gp;bt]',
			'band' => 'required[band;song]',
			'song' => 'required[band;song]',
			'limit' => 'int',
			'offset' => 'int'
		),
		'getSearchTotal' => array(
			'type' => 'in[all;tab;chord;gp;bt]',
			'band' => 'required[band;song]',
			'song' => 'required[band;song]'
		)
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
	
	/**
	 * Returns the most downloaded, liked, latest and commented tabs
	 */
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
	
	/**
	 * Returns all band/song names that contain the provided search term
	 */
	public function autocomplete() {
		$required_role = Controller::PUBLIC_ACCESS;
		
		if ($this->checkPermission($required_role) == true) {
			$params = $this->getRequestParams();
			
			$tab_model = $this->load_model('Tab_model');
			$data = $tab_model->getAutocompleteResults($params['type'], $params['term']);
			$this->sendResponse(1, $data);
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}
	
	/**
	 * Returns all tabs that match the specified search criterias
	 */
	public function search() {
		$required_role = Controller::PUBLIC_ACCESS;
		
		if ($this->checkPermission($required_role) == true) {
			$params = $this->getRequestParams();

			$tab_model = $this->load_model('Tab_model');
			$data = $tab_model->search($params['type'], $params['band'], $params['song'], $params['limit'], $params['offset']);
			$this->sendResponse(1, $data);
			
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}
	
	/**
	 * Returns the total number of tabs that match the specified search criterias
	 */
	public function getSearchTotal() {
		$required_role = Controller::PUBLIC_ACCESS;
		
		if ($this->checkPermission($required_role) == true) {
			$params = $this->getRequestParams();

			$tab_model = $this->load_model('Tab_model');
			$data = $tab_model->getSearchTotal($params['type'], $params['band'], $params['song']);
			$this->sendResponse(1, $data);
			
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}
	
	
}

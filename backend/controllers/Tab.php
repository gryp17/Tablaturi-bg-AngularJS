<?php

class Tab extends Controller {

	public function __construct() {

		/**
		 * List of required parameters and permissions for each API endpoint
		 * also indicates the parameter type
		 */
		$this->endpoints = array(
			'getTabsCount' => array(
				'required_role' => self::PUBLIC_ACCESS
			),
			'getMost' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'type' => 'in[popular,liked,latest,commented]',
					'limit' => 'int'
				)
			),
			'autocomplete' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'type' => 'in[band,song]',
					'term' => 'required',
					'band' => 'optional'
				)
			),
			'search' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'type' => 'in[all,tab,chord,gp,bt]',
					'band' => 'required[band,song]',
					'song' => 'required[band,song]',
					'limit' => 'int',
					'offset' => 'int'
				)
			),
			'getSearchTotal' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'type' => 'in[all,tab,chord,gp,bt]',
					'band' => 'required[band,song]',
					'song' => 'required[band,song]'
				)
			),
			'getTabsByUploader' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => array(
					'uploader_id' => 'int',
					'limit' => 'int',
					'offset' => 'int'
				)
			),
			'getTotalTabsByUploader' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => array(
					'uploader_id' => 'int'
				)
			),
			'getTab' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'id' => 'int'
				)
			)
		);

		#request params
		$this->params = $this->checkRequest();
	}

	public function index() {
		
	}

	/**
	 * Returns the total number of tabs in the database
	 */
	public function getTabsCount() {
		$tab_model = $this->load_model('TabModel');
		$data = $tab_model->getTabsCount();
		$this->sendResponse(1, $data);
	}

	/**
	 * Returns the most downloaded, liked, latest and commented tabs
	 */
	public function getMost() {
		$tab_model = $this->load_model('TabModel');
		$data = $tab_model->getMost($this->params['type'], $this->params['limit']);
		$this->sendResponse(1, $data);
	}

	/**
	 * Returns all band/song names that contain the provided search term
	 */
	public function autocomplete() {
		$tab_model = $this->load_model('TabModel');
		$data = $tab_model->getAutocompleteResults($this->params['type'], $this->params['term'], $this->params['band']);
		$this->sendResponse(1, $data);
	}

	/**
	 * Returns all tabs that match the specified search criterias
	 */
	public function search() {
		$tab_model = $this->load_model('TabModel');
		$data = $tab_model->search($this->params['type'], $this->params['band'], $this->params['song'], $this->params['limit'], $this->params['offset']);
		$this->sendResponse(1, $data);
	}

	/**
	 * Returns the total number of tabs that match the specified search criterias
	 */
	public function getSearchTotal() {
		$tab_model = $this->load_model('TabModel');
		$data = $tab_model->getSearchTotal($this->params['type'], $this->params['band'], $this->params['song']);
		$this->sendResponse(1, $data);
	}
	
	/**
	 * Returns all tabs that were uploaded by the specified user id
	 */
	public function getTabsByUploader() {
		$tab_model = $this->load_model('TabModel');
		$data = $tab_model->getTabsByUploader($this->params['uploader_id'], $this->params['limit'], $this->params['offset']);
		$this->sendResponse(1, $data);
	}
	
	/**
	 * Returns the total number of user tabs
	 */
	public function getTotalTabsByUploader() {
		$tab_model = $this->load_model('TabModel');
		$data = $tab_model->getTotalTabsByUploader($this->params['uploader_id']);
		$this->sendResponse(1, $data);
	}
	
	/**
	 * Returns the tab data
	 */
	public function getTab() {
		$tab_model = $this->load_model('TabModel');
		$data = $tab_model->getTab($this->params['id']);
		$this->sendResponse(1, $data);
	}

}

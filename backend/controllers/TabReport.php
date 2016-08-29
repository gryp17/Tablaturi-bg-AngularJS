<?php

class TabReport extends Controller {

	public function __construct() {

		/**
		 * List of required parameters and permissions for each API endpoint
		 * also indicates the parameter type
		 */
		$this->endpoints = array(
			'reportTab' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => array(
					'tab_id' => 'int',
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
	 * Reports the provided tab ID
	 */
	public function reportTab() {
		$tab_report_model = $this->load_model('TabReportModel');
		$tab_model = $this->load_model('TabModel');
		
		$reported_tab = $tab_model->getTab($this->params['tab_id']);
		
		if(isset($reported_tab) && $reported_tab !== null){
			$tab_report_model->reportTab($this->params['tab_id'], $_SESSION['user']['ID'], $this->params['report']);
			Utils::sendTabReportEmail($reported_tab, $_SESSION['user'], $this->params['report']);
		}
		
		$this->sendResponse(1, true);
	}
	

}

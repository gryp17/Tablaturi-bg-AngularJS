<?php

class BackingTrack extends Controller {

	public function index() {
	
	}

	/**
	 * List of required parameters for each API function
	 * also indicates the parameter type
	 */
	public $required_params = array(
		'search' => array(
			'band' => 'required[band;song]',
			'song' => 'required[band;song]'
		)
	);
	
	/**
	 * Returns all backing tracks that match the specified search criterias
	 */
	public function search() {
		$required_role = Controller::PUBLIC_ACCESS;

		if ($this->checkPermission($required_role) == true) {
			$params = $this->getRequestParams();

			$bt_model = $this->load_model('Backing_track_model');

			#if the band is set
			if (strlen($params['band']) > 0) {
				$data = $bt_model->getBandTracks($params['band']);
				
				#if the song is set as well
				if(strlen($params['song']) > 0){
					#TODO
				}
				
			}
			
			#if only the song is set
			if(strlen($params['song']) > 0){
				#TODO
			}

			$this->sendResponse(1, $data);
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}

}

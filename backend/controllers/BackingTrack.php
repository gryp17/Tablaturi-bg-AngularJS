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
		),
		'getMP3' => array(
			'link' => 'valid-url'
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
				if (strlen($params['song']) > 0) {
					#filter out the songs that don't match the song param
					$data = array_filter($data, function ($item) use ($params) {
						return (strpos(strtolower($item['song']), strtolower($params['song'])) !== false);
					});

					#change the array to indexed (instead of associative)
					$data = array_values($data);
				}
			}
			#if only the song is set
			else if (strlen($params['song']) > 0) {
				$data = $bt_model->getSongTracks($params['song']);
			}

			$this->sendResponse(1, $data);
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}

	/**
	 * Extracts the MP3 link from the provided backing track link
	 */
	public function getMP3() {
		$required_role = Controller::PUBLIC_ACCESS;

		if ($this->checkPermission($required_role) == true) {
			$params = $this->getRequestParams();
			
			$html = Utils::getPageHtml($params['link']);
			if(preg_match('/href="([^"]+?)"\s+rel="nofollow">Download/is', $html, $results)){
				$data = $results[1];
				$this->sendResponse(1, $data);
			}else{
				$this->sendResponse(0, Controller::NOT_FOUND);
			}
			
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}

}

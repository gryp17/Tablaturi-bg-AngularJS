<?php

class Tab extends Controller {

	public function __construct() {

		$tab_params = array(
			'type' => 'in[tab,chord,bass,gp]',
			'band' => array('required', 'max-200'),
			'song' => array('required', 'max-200'),
			'tunning' => array('required', 'max-40'),
			'tab_type' => 'in[full song,intro,solo]',
			'difficulty' => 'in[Ниска,Средна,Висока]',
		);
		
		$update_tab_params = array_merge($tab_params, array('tab_id' => 'int'));

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
					'type' => 'in[all,tab,chord,gp,bass,bt]',
					'band' => 'required[band,song]',
					'song' => 'required[band,song]',
					'limit' => 'int',
					'offset' => 'int'
				)
			),
			'getSearchTotal' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'type' => 'in[all,tab,chord,gp,bass,bt]',
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
			),
			'rateTab' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => array(
					'tab_id' => 'int',
					'rating' => array('int', 'in[1,2,3,4,5]')
				)
			),
			'getTextTabFile' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'tab_id' => 'int'
				)
			),
			'getGpTabFile' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'tab_id' => 'int'
				)
			),
			'addTab' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => $tab_params
			),
			'updateTab' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => $update_tab_params
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
		$band = isset($this->params['band']) ? $this->params['band'] : '';
		$data = $tab_model->getAutocompleteResults($this->params['type'], $this->params['term'], $band);
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
		
		#if the tab exists increment the views
		if ($data !== null) {
			$tab_model->addTabView($this->params['id']);
		}

		$this->sendResponse(1, $data);
	}
	
	/**
	 * Rate the tab
	 */
	public function rateTab() {
		$tab_model = $this->load_model('TabModel');
		$result = $tab_model->rateTab($_SESSION['user']['ID'], $this->params['tab_id'], $this->params['rating']);
		
		if($result){
			//give 1 reputation
			$user_model = $this->load_model('UserModel');
			$user_model->giveReputation($_SESSION['user']['ID'], 1);
		}
		
		$this->sendResponse(1, $result);
	}
	
	/**
	 * Downloads a txt file version of the tab 
	 */
	public function getTextTabFile() {
		$tab_model = $this->load_model('TabModel');
		$tab = $tab_model->getTab($this->params['tab_id']);
		
		//if there is such tab and it's type is not guitar pro
		if($tab !== null && $tab['type'] !== 'gp'){
			
			//build and sanitize the filename
			$filename = $tab['band'].' - '.$tab['song'].'.txt';
			$filename = preg_replace('/(,|\\\|\/|\||\*|\?|\:|\'|\"|>|<)/', '', $filename);

			$tunning = isset($tab['tunning']) ? $tab['tunning'] : 'Няма информация';
			$difficulty = isset($tab['difficulty']) ? $tab['difficulty'] : 'Няма информация';
			
			//build the tab header
			$br = "\r\n";
			$header = $tab['band'].' - '.$tab['song'];
			$header .= $br.$br;
			$header .= 'Автор: '.$tab['username'];
			$header .= $br;
			$header .= 'Тунинг: '.$tunning;
			$header .= $br;
			$header .= 'Трудност: '.$difficulty;
			$header .= $br.'----------------------------------------------------------------------'.$br.$br;

			$this->sendFileResponse('text/plain', $filename, $header.$tab['content']);
		}else{
			$this->sendResponse(0, Controller::NOT_FOUND);
		}
	}
	
	/**
	 * Downloads a guitar pro file version of the tab 
	 */
	public function getGpTabFile() {
		$tab_model = $this->load_model('TabModel');
		$tab = $tab_model->getTab($this->params['tab_id']);
		
		//if there is such tab and it's type is guitar pro
		if($tab !== null && $tab['type'] === 'gp'){
			
			//build and sanitize the filename
			preg_match('/\.([^\.]+?)$/', $tab['path'], $matches);
			$extension = strtolower($matches[1]);
			
			$filename = $tab['band'].' - '.$tab['song'].'.'.$extension;
			$filename = preg_replace('/(,|\\\|\/|\||\*|\?|\:|\'|\"|>|<)/', '', $filename);

			$content = file_get_contents(CONFIG::TABS_DIR.$tab['path']);

			$this->sendFileResponse('application/octet-stream', $filename, $content);
		}else{
			$this->sendResponse(0, Controller::NOT_FOUND);
		}
	}
	
	/**
	 * Adds new tab
	 */
	public function addTab(){
		$tab_model = $this->load_model('TabModel');
		$user_model = $this->load_model('UserModel');
		$filename = null;
		$content = isset($this->params['content']) ? $this->params['content'] : '';
				
		//guitar pro tab
		if($this->params['type'] === 'gp'){
			$content_check = Validator::checkParam('gp_file', null, array('required', 'valid-file-extensions[gp,gp3,gp4,gp5,gp6,gpx]', 'max-file-size-1000'), null);
			if($content_check !== true){
				$this->sendResponse(0, $content_check);
			}
			
			$filename = $this->uploadGpFile('gp_file', $this->params['band'], $this->params['song']);			
		}
		//text tab
		else{
			$content_check = Validator::checkParam('content', $content, array('min-50', 'max-25000'), null);
			if($content_check !== true){
				$this->sendResponse(0, $content_check);
			}
		}
		
		//insert the tab into the database
		$tab_id = $tab_model->addTab($this->params['type'], $this->params['band'], $this->params['song'], $this->params['tab_type'], $content, $filename, $_SESSION['user']['ID'], $this->params['tunning'], $this->params['difficulty']);
		
		//on success give the user 10 reputation and return the inserted id
		if($tab_id !== null){
			$user_model->giveReputation($_SESSION['user']['ID'], 10);
			$this->sendResponse(1, array('tab_id' => $tab_id));
		}else{
			$this->sendResponse(0, Controller::DB_ERROR);
		}
	}
	
	/**
	 * Updates the tab data
	 */
	public function updateTab(){
		$tab_model = $this->load_model('TabModel');
		$filename = null;
		$content = isset($this->params['content']) ? $this->params['content'] : '';
		
		//get the current tab datas
		$old_tab_data = $tab_model->getTab($this->params['tab_id']);
		
		//check if there is such tab
		if($old_tab_data === null){
			$this->sendResponse(0, Controller::NOT_FOUND);
		}else{
			$filename = $old_tab_data['path'];
		}
		
		//check if the tab is uploaded  by the user trying to update it
		if($old_tab_data['uploader_ID'] !== $_SESSION['user']['ID']){
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
		
		//guitar pro tab
		if($this->params['type'] === 'gp'){
			//if there is a submited file or there is no set gp file path
			if($_FILES['gp_file']['error'] !== 4 || $old_tab_data['path'] === null){
				
				$content_check = Validator::checkParam('gp_file', null, array('required', 'valid-file-extensions[gp,gp3,gp4,gp5,gp6,gpx]', 'max-file-size-1000'), null);
				if($content_check !== true){
					$this->sendResponse(0, $content_check);
				}
				
				//if there is already set path - delete the file
				if(isset($old_tab_data['path']) && $old_tab_data['path'] !== null){
					$this->deleteGpFile($old_tab_data['path']);
				}
				
				//upload the new file
				$filename = $this->uploadGpFile('gp_file', $this->params['band'], $this->params['song']);
			}	
		}
		//text tab
		else{
			$content_check = Validator::checkParam('content', $content, array('min-50', 'max-25000'), null);
			if($content_check !== true){
				$this->sendResponse(0, $content_check);
			}
			
			//if there is already set path - delete the file
			if (isset($old_tab_data['path']) && $old_tab_data['path'] !== null) {
				$this->deleteGpFile($old_tab_data['path']);
			}
			
			$filename = null;
		}
		
		//update the tab info
		if($tab_model->updateTab($this->params['tab_id'], $this->params['type'], $this->params['band'], $this->params['song'], $this->params['tab_type'], $content, $filename, $this->params['tunning'], $this->params['difficulty'])){
			$this->sendResponse(1, true);
		}else{
			$this->sendResponse(1, Controller::DB_ERROR);
		}
	}
	
	/**
	 * Uploads the guitar pro file to the file system
	 * It returns the tab filename
	 * @param string $field_name
	 * @return string
	 */
	private function uploadGpFile($field_name, $band, $song){
		$tabs_dir = Config::TABS_DIR;
		
		preg_match('/\.([^\.]+?)$/', $_FILES[$field_name]['name'], $matches);
		$extension = strtolower($matches[1]);
		$extension = '.' . $extension;
		
		$filename = md5("$band - $song - " . date('YmdHis'));
        $filename = $filename . $extension;
		
		#upload the file to the server
		move_uploaded_file($_FILES[$field_name]['tmp_name'], $tabs_dir . $filename);
		
		return $filename;
	}
	
	/**
	 * Deletes the guitar pro file
	 * @param string $filename
	 */
	private function deleteGpFile($filename){
		$tabs_dir = Config::TABS_DIR;
		
		#delete the old tab file
		if (file_exists($tabs_dir . $filename)) {
			unlink($tabs_dir . $filename);
		}
	}

}

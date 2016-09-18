<?php

class TabComment extends Controller {

	public function __construct() {

		/**
		 * List of required parameters and permissions for each API endpoint
		 * also indicates the parameter type
		 */
		$this->endpoints = array(
			'getTabComments' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'tab_id' => 'int',
					'limit' => 'int',
					'offset' => 'int'
				)
			),
			'getTotalTabComments' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'tab_id' => 'int'
				)
			),
			'addTabComment' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => array(
					'tab_id' => 'int',
					'content' => array('required', 'max-500')
				)
			)
		);
		
		#request params
		$this->params = $this->checkRequest();
	}

	public function index() {
		
	}

	/**
	 * Returns all tab comments for the specified tab id
	 */
	public function getTabComments() {
		$tab_comment_model = $this->load_model('TabCommentModel');
		$data = $tab_comment_model->getTabComments($this->params['tab_id'], $this->params['limit'], $this->params['offset']);

		$this->sendResponse(1, $data);
	}

	/**
	 * Returns the total number of comments for the specified tab id
	 */
	public function getTotalTabComments() {
		$tab_comment_model = $this->load_model('TabCommentModel');
		$data = $tab_comment_model->getTotalTabComments($this->params['tab_id']);

		$this->sendResponse(1, $data);
	}
	
	/**
	 * Adds new tab comment
	 */
	public function addTabComment() {
		$tab_comment_model = $this->load_model('TabCommentModel');
		$result = $tab_comment_model->addTabComment($this->params['tab_id'], $_SESSION['user']['ID'], $this->sanitize($this->params['content']));

		if ($result === true) {
			
			//give 1 reputation
			$user_model = $this->load_model('UserModel');
			$user_model->giveReputation($_SESSION['user']['ID'], 1);
			
			//send notification email
			$tab_model = $this->load_model('TabModel');
			$tab = $tab_model->getTab($this->params['tab_id']);
			
			if($tab !== null){
				if($tab['uploader_ID'] !== $_SESSION['user']['ID']){
					$recipient = $user_model->getUser($tab['uploader_ID']);
					Utils::sendTabCommentEmail($tab, $recipient, $_SESSION['user'], $this->params['content']);
				}
			}
			
			$this->sendResponse(1, $result);
		} else {
			$this->sendResponse(0, ErrorCodes::DB_ERROR);
		}
	}

}

<?php

class ArticleComment extends Controller {

	public function index() {
		
	}

	/**
	 * List of required parameters for each API function
	 * also indicates the parameter type
	 */
	public $required_params = array(
		'getArticleComments' => array(
			'article_id' => 'int',
			'limit' => 'int',
			'offset' => 'int'
		),
		'getTotalArticleComments' => array(
			'article_id' => 'int'
		),
		'addArticleComment' => array(
			'article_id' => 'int',
			'content' => 'required, max-500'
		)
	);

	/**
	 * Returns all article comments for the specified article id
	 */
	public function getArticleComments() {
		$required_role = Controller::PUBLIC_ACCESS;
		
		if ($this->checkPermission($required_role) == true) {

			$params = $this->getRequestParams();

			$article_comment_model = $this->load_model('Article_comment_model');
			$data = $article_comment_model->getArticleComments($params['article_id'], $params['limit'], $params['offset']);
			
			$this->sendResponse(1, $data);
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}
	
	/**
	 * Returns the total number of comments for the specified article id
	 */
	public function getTotalArticleComments() {
		$required_role = Controller::PUBLIC_ACCESS;
		
		if ($this->checkPermission($required_role) == true) {

			$params = $this->getRequestParams();

			$article_comment_model = $this->load_model('Article_comment_model');
			$data = $article_comment_model->getTotalArticleComments($params['article_id']);
			
			$this->sendResponse(1, $data);
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}
	
	/**
	 * Adds new article comment
	 */
	public function addArticleComment() {
		$required_role = Controller::LOGGED_IN_USER;
		
		if ($this->checkPermission($required_role) == true) {

			$params = $this->getRequestParams();

			$article_comment_model = $this->load_model('Article_comment_model');
			$result = $article_comment_model->addArticleComment($params['article_id'], $_SESSION['user']['ID'], $this->sanitize($params['content']));
			
			if($result === true){
				$this->sendResponse(1, $result);
			}else{
				$this->sendResponse(0, Controller::DB_ERROR);
			}

		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}
	
	

}

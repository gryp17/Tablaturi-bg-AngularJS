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

}

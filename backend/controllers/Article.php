<?php

class Article extends Controller {

	public function index() {
		
	}

	/**
	 * List of required parameters for each API function
	 * also indicates the parameter type
	 */
	public $required_params = array(
		'getArticles' => array(
			'limit' => 'int',
			'offset' => 'int'
		),
		'getArticlesByDate' => array(
			'date' => 'date',
			'limit' => 'int',
			'offset' => 'int'
		),
		'getArticle' => array(
			'id' => 'int'
		)
	);

	/**
	 * Returns all articles
	 */
	public function getArticles() {
		$required_role = Controller::PUBLIC_ACCESS;

		if ($this->checkPermission($required_role) == true) {

			$params = $this->getRequestParams();

			$article_model = $this->load_model('Article_model');
			$data = $article_model->getArticles($params['limit'], $params['offset']);
			$this->sendResponse(1, $data);
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}

	/**
	 * Returns all articles that match the specified date
	 */
	public function getArticlesByDate() {
		$required_role = Controller::PUBLIC_ACCESS;

		if ($this->checkPermission($required_role) == true) {

			$params = $this->getRequestParams();

			$article_model = $this->load_model('Article_model');
			$data = $article_model->getArticlesByDate($params['date'], $params['limit'], $params['offset']);
			$this->sendResponse(1, $data);
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}
	
	/**
	 * Returns single article data matching the provided ID
	 */
	public function getArticle() {
		$required_role = Controller::PUBLIC_ACCESS;
		
		if ($this->checkPermission($required_role) == true) {

			$params = $this->getRequestParams();

			$article_model = $this->load_model('Article_model');
			$data = $article_model->getArticle($params['id']);
			
			#if the article exists increment the views
			if($data !== null){
				$article_model->addArticleView($params['id']);
			}
			
			$this->sendResponse(1, $data);
		} else {
			$this->sendResponse(0, Controller::ACCESS_DENIED);
		}
	}

}

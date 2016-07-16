<?php

class Article extends Controller {

	public function __construct() {

		/**
		 * List of required parameters and permissions for each API endpoint
		 * also indicates the parameter type
		 */
		$this->endpoints = array(
			'getArticles' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'limit' => 'int',
					'offset' => 'int'
				)
			),
			'getArticlesByDate' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'date' => 'date',
					'limit' => 'int',
					'offset' => 'int'
				)
			),
			'getArticle' => array(
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
	 * Returns all articles
	 */
	public function getArticles() {
		$article_model = $this->load_model('ArticleModel');
		$data = $article_model->getArticles($this->params['limit'], $this->params['offset']);
		$this->sendResponse(1, $data);
	}

	/**
	 * Returns all articles that match the specified date
	 */
	public function getArticlesByDate() {
		$article_model = $this->load_model('ArticleModel');
		$data = $article_model->getArticlesByDate($this->params['date'], $this->params['limit'], $this->params['offset']);
		$this->sendResponse(1, $data);
	}

	/**
	 * Returns single article data matching the provided ID
	 */
	public function getArticle() {
		$article_model = $this->load_model('ArticleModel');
		$data = $article_model->getArticle($this->params['id']);

		#if the article exists increment the views
		if ($data !== null) {
			$article_model->addArticleView($this->params['id']);
		}

		$this->sendResponse(1, $data);
	}

}

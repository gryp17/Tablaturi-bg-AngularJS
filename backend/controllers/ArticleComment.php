<?php

class ArticleComment extends Controller {

	public function __construct() {

		/**
		 * List of required parameters and permissions for each API endpoint
		 * also indicates the parameter type
		 */
		$this->endpoints = array(
			'getArticleComments' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'article_id' => 'int',
					'limit' => 'int',
					'offset' => 'int'
				)
			),
			'getTotalArticleComments' => array(
				'required_role' => self::PUBLIC_ACCESS,
				'params' => array(
					'article_id' => 'int'
				)
			),
			'addArticleComment' => array(
				'required_role' => self::LOGGED_IN_USER,
				'params' => array(
					'article_id' => 'int',
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
	 * Returns all article comments for the specified article id
	 */
	public function getArticleComments() {
		$article_comment_model = $this->load_model('ArticleCommentModel');
		$data = $article_comment_model->getArticleComments($this->params['article_id'], $this->params['limit'], $this->params['offset']);

		$this->sendResponse(1, $data);
	}

	/**
	 * Returns the total number of comments for the specified article id
	 */
	public function getTotalArticleComments() {
		$article_comment_model = $this->load_model('ArticleCommentModel');
		$data = $article_comment_model->getTotalArticleComments($this->params['article_id']);

		$this->sendResponse(1, $data);
	}

	/**
	 * Adds new article comment
	 */
	public function addArticleComment() {
		$article_comment_model = $this->load_model('ArticleCommentModel');
		$result = $article_comment_model->addArticleComment($this->params['article_id'], $_SESSION['user']['ID'], $this->sanitize($this->params['content']));

		if ($result === true) {
			
			//give 1 reputation
			$user_model = $this->load_model('UserModel');
			$user_model->giveReputation($_SESSION['user']['ID'], 1);
			
			//get the article data
			$article_model = $this->load_model('ArticleModel');
			$article_data = $article_model->getArticle($this->params['article_id']);
			
			//send notification email to the article author
			if($article_data['author_ID'] !== $_SESSION['user']['ID']){
				$recipient = $user_model->getUser($article_data['author_ID']);			
				if($recipient !== null){
					Utils::sendArticleCommentEmail($recipient, $_SESSION['user'], $this->params['article_id'], $this->params['content']);
				}
			}
			
			$this->sendResponse(1, $result);
		} else {
			$this->sendResponse(0, ErrorCodes::DB_ERROR);
		}
	}

}

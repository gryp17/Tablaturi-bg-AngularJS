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
			),
			'addArticle' => array(
				'required_role' => self::ADMIN_USER,
				'params' => array(
					'image' => 'required, valid-file-extensions[png;jpg;jpeg], max-file-size-1000',
					'title' => 'min-3, max-250',
					'date' => 'datetime',
					'content' => 'min-3, max-5000'
				)
			),
			'updateArticle' => array(
				'required_role' => self::ADMIN_USER,
				'params' => array(
					'id' => 'int',
					'image' => 'optional, valid-file-extensions[png;jpg;jpeg], max-file-size-1000',
					'title' => 'min-3, max-250',
					'date' => 'datetime',
					'content' => 'min-3, max-5000'
				)
			),
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

	/**
	 * Adds new article
	 */
	public function addArticle() {
		$article_model = $this->load_model('ArticleModel');
		
		$article_image = $this->uploadArticleImage('image', $_SESSION['user']['ID']);
		$id =  $article_model->addArticle($_SESSION['user']['ID'], $this->params['title'], $this->params['content'], $this->params['date'], $article_image, 0);
		
		$this->sendResponse(1, array('article_id' => $id));
	}
	
	/**
	 * Updates an existing article
	 */
	public function updateArticle() {
		$article_model = $this->load_model('ArticleModel');
		$new_image = null;
		
		#if there is a submited image
		if($_FILES['image']['error'] !== 4){
			#delete the old article image
			$article_data = $article_model->getArticle($this->params['id']);
			$old_image = $article_data['picture'];
			$this->deleteArticleImage($old_image);
			
			$new_image = $this->uploadArticleImage('image');
		}
		
		$article_model->updateArticle($this->params['id'], $this->params['title'], $this->params['content'], $this->params['date'], $new_image);
		
		$this->sendResponse(1, true);
	}
	
	/**
	 * Uploads new article image
	 * @param string $field_name
	 * @return string
	 */
	private function uploadArticleImage($field_name){
		$articles_dir = Config::ARTICLES_DIR;
		
		preg_match('/\.([^\.]+?)$/', $_FILES[$field_name]['name'], $matches);
		$extension = strtolower($matches[1]);
		$extension = '.' . $extension;

		$datetime = date('YmdHis');
		
		#upload the file to the server
		move_uploaded_file($_FILES[$field_name]['tmp_name'], $articles_dir . $datetime . $extension);
		$image = $datetime . $extension;
		
		return $image;
	}
	
	/**
	 * Deletes the article image from the file system
	 * @param string $filename
	 */
	private function deleteArticleImage($filename){
		$articles_dir = Config::ARTICLES_DIR;
		
		#delete the old image
		if (file_exists($articles_dir . $filename)) {
			unlink($articles_dir . $filename);
		}
	}
	
}

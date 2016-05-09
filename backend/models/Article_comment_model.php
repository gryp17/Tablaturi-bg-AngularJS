<?php

class Article_comment_model {

	private $connection;

	public function __construct() {
		$this->connection = DB::getInstance()->connection;
	}

	
	/**
	 * Returns all comments for the specified article_id
	 * @param int $article_id
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	public function getArticleComments($article_id, $limit, $offset) {
		$data = array();
		
		$query = $this->connection->prepare('SELECT article_comment.ID, article_comment.article_ID, article_comment.author_ID, user.username, user.photo, article_comment.content, article_comment.date '
				. 'FROM user, article_comment '
				. 'WHERE user.ID = article_comment.author_ID AND article_comment.article_ID = :article_id '
				. 'ORDER BY article_comment.date DESC '
				. 'LIMIT :limit OFFSET :offset');
		
		$params = array('article_id' => $article_id, 'limit' => $limit, 'offset' => $offset);
		$query->execute($params);
		
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			//convert the date to miliseconds timestamp
			$row['date'] = strtotime($row['date']) * 1000;
			$data[] = $row;
		}
		
		return $data;
	}
	
	/**
	 * Adds new article comment
	 * @param int $article_id
	 * @param int $author_id
	 * @param string $content
	 * @return boolean
	 */
	public function addArticleComment($article_id, $author_id, $content){
		$query = $this->connection->prepare('INSERT INTO article_comment (article_ID, author_ID, content, date) VALUES (:article_id, :author_id, :content, now())');
		$params = array('article_id' => $article_id, 'author_id' => $author_id, 'content' => $content);
		if($query->execute($params)){
			return true;
		}else{
			return false;
		}
	}


}

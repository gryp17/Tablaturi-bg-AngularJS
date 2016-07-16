<?php

class ArticleModel {

	private $connection;

	public function __construct() {
		$this->connection = DB::getInstance()->connection;
	}

	/**
	 * Returns all articles
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	public function getArticles($limit, $offset) {
		$data = array();

		$query = $this->connection->prepare('SELECT * FROM article ORDER BY date DESC LIMIT :limit OFFSET :offset');
		$params = array('limit' => $limit, 'offset' => $offset);

		$query->execute($params);

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			//convert the date to javascript friendly format
			$row['date'] = Utils::formatDate($row['date']);
			$data[] = $row;
		}

		return $data;
	}

	/**
	 * Returns all articles from the specified date
	 * @param string $date
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	public function getArticlesByDate($date, $limit, $offset) {
		$data = array();
		
		$query = $this->connection->prepare('SELECT * FROM article WHERE date LIKE :date ORDER BY date DESC LIMIT :limit OFFSET :offset');
		$params = array('date' => $date . '%', 'limit' => $limit, 'offset' => $offset);

		$query->execute($params);

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			//convert the date to javascript friendly format
			$row['date'] = Utils::formatDate($row['date']);
			$data[] = $row;
		}

		return $data;
	}
	
	/**
	 * Returns a single article matching the provided ID
	 * @param int $id
	 * @return array
	 */
	public function getArticle($id){
		$query = $this->connection->prepare('SELECT article.ID, article.author_ID, user.username, article.title, article.summary, article.content, article.date, article.picture, article.views '
				. 'FROM article, user '
				. 'WHERE article.author_ID = user.ID AND article.ID = :id');
		$query->execute(array('id' => $id));
		
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row) {
			//convert the date to javascript friendly format
			$row['date'] = Utils::formatDate($row['date']);
            return $row;
        } else {
            return null;
        }
	}
	
	/**
	 * Increments the article views
	 * @param int $id
	 */
	public function addArticleView($id){
		$query = $this->connection->prepare('UPDATE article SET views = views + 1 WHERE ID = :id');
		$query->execute(array('id' => $id));
	}

}

<?php

class Articles_model {

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

		$query = $this->connection->prepare("SELECT * FROM article ORDER BY date DESC LIMIT :limit OFFSET :offset");
		$params = array("limit" => $limit, "offset" => $offset);

		$query->execute($params);

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			//convert the date to miliseconds timestamp
			$row["date"] = strtotime($row["date"]) * 1000;
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
		
		$query = $this->connection->prepare("SELECT * FROM article WHERE date LIKE :date ORDER BY date DESC LIMIT :limit OFFSET :offset");
		$params = array("date" => $date . "%", "limit" => $limit, "offset" => $offset);

		$query->execute($params);

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			//convert the date to miliseconds timestamp
			$row["date"] = strtotime($row["date"]) * 1000;
			$data[] = $row;
		}

		return $data;
	}

}

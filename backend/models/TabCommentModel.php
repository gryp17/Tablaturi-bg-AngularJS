<?php

class TabCommentModel {

	private $connection;

	public function __construct() {
		$this->connection = DB::getInstance()->connection;
	}

	
	/**
	 * Returns all comments for the specified tab_id
	 * @param int $tab_id
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	public function getTabComments($tab_id, $limit, $offset) {
		$data = array();
		
		$query = $this->connection->prepare('SELECT tab_comment.ID, tab_comment.author_ID, user.username, user.photo, tab_comment.content, tab_comment.date '
				. 'FROM user, tab_comment '
				. 'WHERE user.ID = tab_comment.author_ID AND tab_comment.tab_ID = :tab_id '
				. 'ORDER BY tab_comment.date DESC '
				. 'LIMIT :limit OFFSET :offset');
		
		$params = array('tab_id' => $tab_id, 'limit' => $limit, 'offset' => $offset);
		$query->execute($params);
		
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			//convert the date to javascript friendly format
			$row['date'] = Utils::formatDate($row['date']);
			$data[] = $row;
		}
		
		return $data;
	}
	
	/**
	 * Returns the total number of comments for the specified tab_id
	 * @param int $tab_id
	 * @return int
	 */
	public function getTotalTabComments($tab_id){
		$query = $this->connection->prepare('SELECT count(ID) AS total FROM tab_comment WHERE tab_comment.tab_ID = :tab_id');
		$params = array('tab_id' => $tab_id);
		$query->execute($params);
		
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		return (int) $result['total'];
	}
	
	/**
	 * Adds new tab comment
	 * @param int $tab_id
	 * @param int $author_id
	 * @param string $content
	 * @return boolean
	 */
	public function addTabComment($tab_id, $author_id, $content){
		$query = $this->connection->prepare('INSERT INTO tab_comment (tab_ID, author_ID, content, date) VALUES (:tab_id, :author_id, :content, now())');
		$params = array('tab_id' => $tab_id, 'author_id' => $author_id, 'content' => $content);
		if($query->execute($params)){
			return true;
		}else{
			return false;
		}
	}


}

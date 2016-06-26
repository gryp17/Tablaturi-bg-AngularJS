<?php

class User_comment_model {

	private $connection;

	public function __construct() {
		$this->connection = DB::getInstance()->connection;
	}

	
	/**
	 * Returns all comments for the specified user_id
	 * @param int $user_id
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	public function getUserComments($user_id, $limit, $offset) {
		$data = array();
		
		$query = $this->connection->prepare('SELECT user_comment.ID, user_comment.author_ID, user.username, user.photo, user_comment.content, user_comment.date '
				. 'FROM user, user_comment '
				. 'WHERE user.ID = user_comment.author_ID AND user_comment.user_ID = :user_id '
				. 'ORDER BY user_comment.date DESC '
				. 'LIMIT :limit OFFSET :offset');
		
		$params = array('user_id' => $user_id, 'limit' => $limit, 'offset' => $offset);
		$query->execute($params);
		
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			//convert the date to javascript friendly format
			$row['date'] = Utils::formatDate($row['date']);
			$data[] = $row;
		}
		
		return $data;
	}
	
	/**
	 * Returns the total number of comments for the specified user_id
	 * @param int $user_id
	 * @return int
	 */
	public function getTotalUserComments($user_id){
		$query = $this->connection->prepare('SELECT count(ID) AS total FROM user_comment WHERE user_ID = :user_id');
		$params = array('user_id' => $user_id);
		$query->execute($params);
		
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		return $result['total'];
	}
	
	/**
	 * Adds new user comment
	 * @param int $user_id
	 * @param int $author_id
	 * @param string $content
	 * @return boolean
	 */
	public function addUserComment($user_id, $author_id, $content){
		$query = $this->connection->prepare('INSERT INTO user_comment (user_ID, author_ID, content, date) VALUES (:user_id, :author_id, :content, now())');
		$params = array('user_id' => $user_id, 'author_id' => $author_id, 'content' => $content);
		if($query->execute($params)){
			return true;
		}else{
			return false;
		}
	}


}

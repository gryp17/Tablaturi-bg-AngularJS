<?php

class UserFavouriteModel {

	private $connection;

	public function __construct() {
		$this->connection = DB::getInstance()->connection;
	}

	
	/**
	 * Returns all favourite tabs for the specified user_id
	 * @param int $user_id
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	public function getUserFavourites($user_id, $limit, $offset) {
		$data = array();
		
		$query = $this->connection->prepare('SELECT tab.ID, tab.tab_type, tab.type, tab.band, tab.song, user_favourite.date '
				. 'FROM user_favourite, tab '
				. 'WHERE user_favourite.tab_ID = tab.ID AND user_ID = :user_id '
				. 'ORDER BY user_favourite.date DESC, user_favourite.ID ASC '
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
	 * Returns the total number of favourite tabs for the specified user_id
	 * @param int $user_id
	 * @return int
	 */
	public function getTotalUserFavourites($user_id){
		$query = $this->connection->prepare('SELECT count(ID) AS total FROM user_favourite WHERE user_ID = :user_id');
		$params = array('user_id' => $user_id);
		$query->execute($params);
		
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		return $result['total'];
	}
	
	/**
	 * Deletes the specified tab from the user's favourite tabs
	 * @param int $user_id
	 * @param int $tab_id
	 */
	public function deleteFavouriteTab($user_id, $tab_id){		
		$query = $this->connection->prepare('DELETE FROM user_favourite WHERE user_ID = :user_id AND tab_ID = :tab_id');
		$params = array('user_id' => $user_id, 'tab_id' => $tab_id);
		$query->execute($params);
	}
	
	/**
	 * Adds the specified tab to the user's favourite tabs
	 * returns true if the record was added and false if the tab already is in favourites
	 * @param int $user_id
	 * @param int $tab_id
	 * @return boolean
	 */
	public function addFavouriteTab($user_id, $tab_id){
		$result = true;
		
		$params = array('user_id' => $user_id, 'tab_id' => $tab_id);
		
		$select = $this->connection->prepare('SELECT ID FROM user_favourite WHERE user_ID = :user_id AND tab_ID = :tab_id');
		$select->execute($params);
		$row = $select->fetch(PDO::FETCH_ASSOC);
		
		#if the tab is already in the favourites list return false
		if(isset($row['ID'])){
			$result = false;
		}
		#otherwise add the tab to the favourites list
		else{
			$query = $this->connection->prepare('INSERT INTO user_favourite (user_ID, tab_ID, date) VALUES (:user_id, :tab_id, now())');
			$query->execute($params);
		}
		
		return $result;
	}

}

<?php

class UserActivationModel {

	private $connection;

	public function __construct() {
		$this->connection = DB::getInstance()->connection;
	}

	/**
	 * Inserts new user activation record
	 * @param int $user_id
	 * @param string $hash
	 * @return boolean
	 */
	public function insertHash($user_id, $hash) {
		$query = $this->connection->prepare('INSERT INTO user_activation (user_ID, hash, date) VALUES (:user_id, :hash, now())');
		return $query->execute(array('user_id' => $user_id, 'hash' => $hash));
	}

	/**
	 * Activates the user and deleted all activation records
	 * @param int $user_id
	 * @return boolean
	 */
	public function activateUser($user_id) {
		$query = $this->connection->prepare('UPDATE user SET activated = 1 WHERE ID = :user_id');
		if($query->execute(array('user_id' => $user_id))){
			return $this->deleteHash($user_id);
		}
	}
	
	/**
	 * Deletes all activation records related to the provided user_id
	 * @param int $user_id
	 * @return boolean
	 */
	private function deleteHash($user_id){
		$query = $this->connection->prepare('DELETE FROM user_activation WHERE user_ID = :user_id');
		return $query->execute(array('user_id' => $user_id));
	}
		
	/**
	 * Checks if the provided user_id/hash combination is valid
	 * Also checks if 24 hours have passed since the activation link was sent
	 * @param int $user_id
	 * @param string $hash
	 * @return boolean
	 */
	public function checkHash($user_id, $hash) {
		$query = $this->connection->prepare('SELECT date FROM user_activation WHERE user_ID = :user_id AND hash like :hash');
		$query->execute(array('user_id' => $user_id, 'hash' => $hash));
		
		$row = $query->fetch(PDO::FETCH_ASSOC);
		
		if ($row) {
			$activation_date = strtotime($row['date']);

			//if 24 hours haven't passed
			if((time()-(60*60*24)) < $activation_date){
				return true;
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}
	
}

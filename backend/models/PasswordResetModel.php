<?php

class PasswordResetModel {

	private $connection;

	public function __construct() {
		$this->connection = DB::getInstance()->connection;
	}

	/**
	 * Inserts new password reset record
	 * @param int $user_id
	 * @param string $hash
	 * @return boolean
	 */
	public function insertHash($user_id, $hash) {
		$query = $this->connection->prepare('INSERT INTO password_reset (user_ID, hash, date) VALUES (:user_id, :hash, now())');
		return $query->execute(array('user_id' => $user_id, 'hash' => $hash));
	}
	
	/**
	 * Deletes all password reset records related to the provided user_id
	 * @param int $user_id
	 * @return boolean
	 */
	public function deleteHash($user_id){
		$query = $this->connection->prepare('DELETE FROM password_reset WHERE user_ID = :user_id');
		return $query->execute(array('user_id' => $user_id));
	}
		
	/**
	 * Checks if the provided user_id/hash combination is valid
	 * Also checks if 1 hour has passed since the activation link was sent
	 * @param int $user_id
	 * @param string $hash
	 * @return boolean
	 */
	public function checkHash($user_id, $hash) {
		$query = $this->connection->prepare('SELECT date FROM password_reset WHERE user_ID = :user_id AND hash like :hash');
		$query->execute(array('user_id' => $user_id, 'hash' => $hash));
		
		$row = $query->fetch(PDO::FETCH_ASSOC);
		
		if ($row) {
			$date = strtotime($row['date']);

			//if 1 hour hasn't passed
			if((time()-(60*60)) < $date){
				return true;
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}
	
}

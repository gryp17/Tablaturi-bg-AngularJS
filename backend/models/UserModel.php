<?php

class UserModel {

	private $connection;

	public function __construct() {
		$this->connection = DB::getInstance()->connection;
	}


	/**
	 * Checks if there is an user with the provided credentials
	 * @param string $username
	 * @param string $password
	 * @param string $password_type
	 * @return boolean
	 */
	public function checkLogin($username, $password, $password_type = null) {
		
		if ($password_type != 'hashed') {
            $password = md5($password);
        }
		
		$query = $this->connection->prepare('SELECT * FROM user WHERE username = :username AND password = :password AND activated = 1');
		$params = array('username' => $username, 'password' => $password);
		$query->execute($params);

        $result = $query->fetch(PDO::FETCH_ASSOC);
		
        if ($result) {
			unset($result['password']);
            return $result;
		}else{
			return false;
		}
	}
	
	/**
	 * Updates the last_active_date of the user
	 * @param int $user_id
	 * @return boolean
	 */
	public function updateActivity($user_id){
		$query = $this->connection->prepare('UPDATE user SET last_active_date = now() WHERE ID = :user_id');
		$params = array('user_id' => $user_id);
		return $query->execute($params);
	}
	
	/**
	 * Checks if the specified field is unique in the user table
	 * @param string $field
	 * @param string $value
	 * @return boolean
	 */
	public function isUnique($field, $value){
		
		if($field !== 'username' && $field !== 'email'){
			return true;
		}else{
			if($field === 'username'){
				$query = $this->connection->prepare('select * from user where username = :username');
				$query->execute(array('username' => $value));
			}else{
				$query = $this->connection->prepare('select * from user where email = :email');
				$query->execute(array('email' => $value));
			}
			
			$result = $query->fetch(PDO::FETCH_ASSOC);
		
			if ($result) {
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Signup new user
	 * @param string $username
	 * @param string $password
	 * @param string $email
	 * @param date $birthday
	 * @param string $gender
	 * @param string $photo
	 * @param string $type
	 * @return int
	 */
	public function insertUser($username, $password, $email, $birthday, $gender, $photo, $type){
		$password = md5($password);
		$query = $this->connection->prepare('INSERT INTO user '
				. '(username, password, email, birthday, register_date, gender, photo, type, last_active_date, reputation, activated) '
				. 'VALUES '
				. '(:username, :password, :email, :birthday, now(), :gender, :photo, :type, now(), 0, 0)');
		
		$params = array(
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'birthday' => $birthday,
			'gender' => $gender,
			'photo' => $photo,
			'type' => $type
		);
		
		if($query->execute($params)){
			return $this->connection->lastInsertId();
		}else{
			return null;
		}
	}
	
	
	/**
	 * Returns the user data
	 * @param int $id
	 * @return array
	 */
	public function getUser($id){
		$query = $this->connection->prepare('SELECT * FROM user WHERE ID = :id AND activated = 1');
		$params = array('id' => $id);
		$query->execute($params);

        $result = $query->fetch(PDO::FETCH_ASSOC);
		
        if ($result) {
			unset($result['password']);
			
			//convert the dates to javascript friendly format
			$result['birthday'] = Utils::formatDate($result['birthday']);
			$result['last_active_date'] = Utils::formatDate($result['last_active_date']);
			$result['register_date'] = Utils::formatDate($result['register_date']);
            return $result;
		}else{
			return null;
		}
	}
	
	/**
	 * Updates the user data
	 * @param int $id
	 * @param string $password
	 * @param string $location
	 * @param string $occupation
	 * @param string $web
	 * @param string $about_me
	 * @param string $instrument
	 * @param string $favourite_bands
	 * @return boolean
	 */
	public function updateUser($id, $password, $location, $occupation, $web, $about_me, $instrument, $favourite_bands, $avatar){
		
		$params = array(
			'id' => $id,
			'location' => $location,
			'occupation' => $occupation,
			'web' => $web,
			'about_me' => $about_me,
			'instrument' => $instrument,
			'favourite_bands' => $favourite_bands
		);
		
		#add the avatar part of the query if an avatar has been provided
		if(isset($avatar) && strlen($avatar) > 0){
			#add the updated get param in order to prevent caching
			$params['photo'] = $avatar.'?updated='.time();
			$avatar_query = 'photo = :photo, ';
		}else{
			$avatar_query = '';
		}
		
		#add the password part of the query if a password has been provided
		if(isset($password) && strlen($password) > 0){
			$password = md5($password);
			$params['password'] = $password;
			$password_query = 'password = :password, ';
		}else{
			$password_query = '';
		}
				
		$query = 'UPDATE user SET '
					. $avatar_query
					. $password_query
					. 'location = :location, '
					. 'occupation = :occupation, '
					. 'web = :web, '
					. 'about_me = :about_me, '
					. 'instrument = :instrument, '
					. 'favourite_bands = :favourite_bands '
					. 'WHERE ID = :id';
		
		$query = $this->connection->prepare($query);
		if($query->execute($params)){
			return true;
		}else{
			return false;
		}
	}
	
	
	/**
	 * Generates the correct search/count query when searching for users
	 * @param string $type (search|count)
	 * @param string $keyword
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	private function generateSearchQuery($type, $keyword, $limit, $offset){
		$result = array(
			'query' => 'WHERE '
					. '(username LIKE :username '
					. 'OR about_me LIKE :about_me '
					. 'OR location LIKE :location '
					. 'OR instrument LIKE :instrument '
					. 'OR occupation LIKE :occupation '
					. 'OR favourite_bands LIKE :favourite_bands) '
					. 'AND activated = 1 ORDER BY username ',
			'params' => array(
				'username' => '%' . $keyword . '%',
				'about_me' => '%' . $keyword . '%',
				'location' => '%' . $keyword . '%',
				'instrument' => '%' . $keyword . '%',
				'occupation' => '%' . $keyword . '%',
				'favourite_bands' => '%' . $keyword . '%'
			)
		);
		
		#if the query type is search add the limit and offset params
		if($type === 'search'){
			$result['query'] = 'SELECT * FROM user '.$result['query'];
			$result['query'] .= 'LIMIT :limit OFFSET :offset';
			
			$result['params']['limit'] = $limit;
			$result['params']['offset'] = $offset;
			
		}else{
			$result['query'] = 'SELECT COUNT(*) AS total FROM user '.$result['query'];
		}
		
		return $result;
	}
	
	/**
	 * Searches for users using the provided keyword
	 * @param string $keyword
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	public function search($keyword, $limit, $offset){
		$data = array();
		
		$generated_query = $this->generateSearchQuery('search', $keyword, $limit, $offset);
		
		$query = $this->connection->prepare($generated_query['query']);		
		$query->execute($generated_query['params']);

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {			
			//convert the dates to javascript friendly format
			$row['birthday'] = Utils::formatDate($row['birthday']);
			$row['last_active_date'] = Utils::formatDate($row['last_active_date']);
			$row['register_date'] = Utils::formatDate($row['register_date']);
			$data[] = $row;
		}

		return $data;
	}
	
	/**
	 * Returns the total number of users that match the search
	 * @param string $keyword
	 * @return int
	 */
	public function getTotalSearchResults($keyword){
		$generated_query = $this->generateSearchQuery('count', $keyword, null, null);
		
		$query = $this->connection->prepare($generated_query['query']);
		$query->execute($generated_query['params']);
		
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		return (int) $result['total'];
	}
	
	/**
	 * Gives the user the provided amount of reputation
	 * @param int $user_id
	 * @param int $amount
	 */
	public function giveReputation($user_id, $amount){
		$query = $this->connection->prepare('UPDATE user SET reputation = reputation + :amount WHERE ID = :user_id');
		return $query->execute(array('amount' => $amount, 'user_id' => $user_id));
	}
	
	


}

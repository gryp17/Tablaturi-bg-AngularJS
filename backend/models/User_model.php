<?php

class User_model {

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
		
		$query = $this->connection->prepare('select * from user where username = :username and password = :password and activated = 1');
		$query->execute(array('username' => $username, 'password' => $password));

        $result = $query->fetch(PDO::FETCH_ASSOC);
		
        if ($result) {
			unset($result['password']);
            return $result;
		}else{
			return false;
		}
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
	 * @return boolean
	 */
	public function insertUser($username, $password, $email, $birthday, $gender, $photo, $type){
		$password = md5($password);
		$result = $this->connection->prepare('insert into user (username, password, email, birthday, register_date, gender, photo, type, last_active_date, reputation, activated) values (:username, :password, :email, :birthday, now(), :gender, :photo, :type, now(), 0, 0)');
		if($result->execute(array('username' => $username, 'password' => $password, 'email' => $email, 'birthday' => $birthday, 'gender' => $gender, 'photo' => $photo, 'type' => $type))){
			return true;
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


}

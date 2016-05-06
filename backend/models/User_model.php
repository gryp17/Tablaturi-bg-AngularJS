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
		
		if ($password_type != "hashed") {
            $password = md5($password);
        }
		
		$query = $this->connection->prepare("select * from user where username = :username and password = :password and activated = 1");
		$query->execute(array("username" => $username, "password" => $password));

        $result = $query->fetch(PDO::FETCH_ASSOC);
		
        if ($result) {
			unset($result["password"]);
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
		
		if($field !== "username" && $field !== "email"){
			return true;
		}else{
			if($field === "username"){
				$query = $this->connection->prepare("select * from user where username = :username");
				$query->execute(array("username" => $value));
			}else{
				$query = $this->connection->prepare("select * from user where email = :email");
				$query->execute(array("email" => $value));
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
		$result = $this->connection->prepare("insert into user (username, password, email, birthday, register_date, gender, photo, type, last_active_date, reputation, activated) values (:username, :password, :email, :birthday, now(), :gender, :photo, :type, now(), 0, 0)");
		if($result->execute(array('username' => $username, 'password' => $password, 'email' => $email, 'birthday' => $birthday, 'gender' => $gender, 'photo' => $photo, 'type' => $type))){
			return true;
		}
	}


}

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


}

<?php

class DB {

	private static $instance = null;
	public $connection;

	private function __construct() {
		try {
			$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
			$dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME;
			$user = Config::DB_USER;
			$password = Config::DB_PASS;
			$this->connection = new PDO($dsn, $user, $password, $opc);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public static function getInstance() {
		if (self::$instance == null) {
			self::$instance = new DB();
		}

		return self::$instance;
	}

}

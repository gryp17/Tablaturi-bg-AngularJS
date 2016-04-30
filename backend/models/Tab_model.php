<?php

class Tab_model {

	private $connection;

	public function __construct() {
		$this->connection = DB::getInstance()->connection;
	}


	public function getTabsCount() {
		$data = array();
		
		#get the total number of tabs
		$query = $this->connection->prepare("SELECT COUNT(ID) FROM tab");
		$query->execute();
		$total = $query->fetch()[0];
		
		#get only the guitar pro tabs
		$query = $this->connection->prepare("SELECT COUNT(ID) FROM tab WHERE type = 'gp'");
		$query->execute();
		$gp = $query->fetch()[0];
		
		$data = array(
			"gp" => $gp,
			"text" => $total - $gp
		);

		return $data;
	}


}

<?php

class Tab_model {

	private $connection;

	public function __construct() {
		$this->connection = DB::getInstance()->connection;
	}

	/**
	 * Returns the total number of guitar pro and text tabs
	 * @return array
	 */
	public function getTabsCount() {
		$data = array();
		
		#get the total number of tabs
		$query = $this->connection->prepare('SELECT COUNT(ID) FROM tab');
		$query->execute();
		$total = $query->fetch()[0];
		
		#get only the guitar pro tabs
		$query = $this->connection->prepare('SELECT COUNT(ID) FROM tab WHERE type = "gp"');
		$query->execute();
		$gp = $query->fetch()[0];
		
		$data = array(
			'gp' => $gp,
			'text' => $total - $gp
		);

		return $data;
	}
	
	/**
	 * Returns the most popular, liked, latest or commented tabs
	 * @param string $type
	 * @param int $limit
	 */
	public function getMost($type, $limit) {
		$data = array();
		
		switch ($type) {
            case 'popular' :
				$query = $this->connection->prepare('SELECT ID, band, song, downloads FROM tab ORDER BY downloads DESC LIMIT :limit');
                break;
            case 'liked' :
				$query = $this->connection->prepare('SELECT ID, band, song, rating FROM tab ORDER BY rating DESC, band ASC LIMIT :limit');
                break;
            case 'latest' :
				$query = $this->connection->prepare('SELECT ID, band, song, upload_date FROM tab ORDER BY upload_date DESC LIMIT :limit');
                break;
            case 'commented' :
                $query = $this->connection->prepare('SELECT tab.ID, tab.band, tab.song , count( tab_comment.ID ) AS comments FROM tab, tab_comment WHERE tab.ID = tab_comment.tab_ID GROUP BY tab.ID ORDER BY comments DESC LIMIT :limit');
				break;
        }
		
		$params = array('limit' => $limit);
		$query->execute($params);
		
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			//convert the date to javascript friendly format
			if(isset($row['upload_date'])){
				$row['upload_date'] = Utils::formatDate($row['upload_date']);
			}
			$data[] = $row;
		}
		
		return $data;
	}
	
	
	/**
	 * Returns all band/song names that contain the provided search term
	 * @param string $type
	 * @param string $term
	 * @return array
	 */
	public function getAutocompleteResults($type, $term){
		$data = array();
				
		if ($type == 'band') {
			$query = $this->connection->prepare('SELECT DISTINCT(band) AS term FROM tab WHERE band LIKE :term LIMIT 10');
        } else {
			$query = $this->connection->prepare('SELECT DISTINCT(song) AS term FROM tab WHERE song LIKE :term LIMIT 10');
        }
		
		$query->execute(array('term' => '%'.$term.'%'));
		
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$data[] = array(
				'id' => $row['term'],
				'label' => $row['term'],
				'value' => $row['term']
			);
		}
		
		return $data;
	}


}

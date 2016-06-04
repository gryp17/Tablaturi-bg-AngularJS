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
			if (isset($row['upload_date'])) {
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
	public function getAutocompleteResults($type, $term) {
		$data = array();

		if ($type == 'band') {
			$query = $this->connection->prepare('SELECT DISTINCT(band) AS term FROM tab WHERE band LIKE :term LIMIT 10');
		} else {
			$query = $this->connection->prepare('SELECT DISTINCT(song) AS term FROM tab WHERE song LIKE :term LIMIT 10');
		}

		$query->execute(array('term' => '%' . $term . '%'));

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$data[] = array(
				'id' => $row['term'],
				'label' => $row['term'],
				'value' => $row['term']
			);
		}

		return $data;
	}

	/**
	 * Returns the search results for the specified type/band/song
	 * @param string $type
	 * @param string $band
	 * @param string $song
	 * @param int $limit
	 * @param int $offset
	 */
	public function search($type, $band, $song, $limit, $offset) {
		$data = array();

		$search = $this->generateSearchQuery($type, $band, $song, $limit, $offset);

		$query = $this->connection->prepare($search['query']);
		$query->execute($search['params']);

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$row['upload_date'] = Utils::formatDate($row['upload_date']);
			$row['modified_date'] = Utils::formatDate($row['modified_date']);
			$data[] = $row;
		}

		return $data;
	}
	
	/**
	 * Returns the total number of records that match the specified type/band/song criterias
	 * @param string $type
	 * @param string $band
	 * @param string $song
	 * @return int
	 */
	public function getSearchTotal($type, $band, $song){
		$search = $this->generateSearchQuery($type, $band, $song, null, null);
		
		$query = $this->connection->prepare($search['count_query']);
		$query->execute($search['count_params']);
		
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		return $result['total'];
	}

	/**
	 * Builds the correct query depending on the provided type/band/song
	 * Also returns the "count" query that is used in the pagination
	 * @param string $type
	 * @param string $band
	 * @param string $song
	 * @param int $limit
	 * @param int $offset
	 * @return array
	 */
	private function generateSearchQuery($type, $band, $song, $limit, $offset) {
		$result = array();
		
		if($type == 'all'){
			$type = '';
		}

		#band and song search
		if (strlen($band) > 0 && strlen($song) > 0) {

			#search query
			$result['query'] = 'SELECT * FROM tab '
				. 'WHERE type LIKE :type AND band LIKE :band AND song LIKE :song '
				. 'ORDER BY band, song, rating DESC, type, downloads DESC '
				. 'LIMIT :limit OFFSET :offset';

			$result['params'] = array(
				'type' => '%' . $type . '%',
				'band' => '%' . $band . '%',
				'song' => '%' . $song . '%',
				'limit' => $limit,
				'offset' => $offset
			);

			#count query
			$result['count_query'] = 'SELECT COUNT(ID) AS total FROM tab '
				. 'WHERE type LIKE :type AND band LIKE :band AND song LIKE :song';

			$result['count_params'] = array(
				'type' => '%' . $type . '%',
				'band' => '%' . $band . '%',
				'song' => '%' . $song . '%'
			);
		}
		#band search
		elseif(strlen($band) > 0){
			
			$result['query'] = 'SELECT * FROM tab '
				. 'WHERE type LIKE :type AND band LIKE :band '
				. 'ORDER BY band, song, rating DESC, type, downloads DESC '
				. 'LIMIT :limit OFFSET :offset';
			
			$result['params'] = array(
				'type' => '%' . $type . '%',
				'band' => '%' . $band . '%',
				'limit' => $limit,
				'offset' => $offset
			);
			
			$result['count_query'] = 'SELECT COUNT(ID) AS total FROM tab '
				. 'WHERE type LIKE :type AND band LIKE :band';
			
			$result['count_params'] = array(
				'type' => '%' . $type . '%',
				'band' => '%' . $band . '%'
			);
		}
		#song search
		else{
			
			$result['query'] = 'SELECT * FROM tab '
				. 'WHERE type LIKE :type AND song LIKE :song '
				. 'ORDER BY band, song, rating DESC, type, downloads DESC '
				. 'LIMIT :limit OFFSET :offset';

			$result['params'] = array(
				'type' => '%' . $type . '%',
				'song' => '%' . $song . '%',
				'limit' => $limit,
				'offset' => $offset
			);
			
			$result['count_query'] = 'SELECT COUNT(ID) AS total FROM tab '
				. 'WHERE type LIKE :type AND song LIKE :song';

			$result['count_params'] = array(
				'type' => '%' . $type . '%',
				'song' => '%' . $song . '%'
			);
		}
		
		return $result;
	}

}

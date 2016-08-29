<?php

class TabReportModel {

	private $connection;

	public function __construct() {
		$this->connection = DB::getInstance()->connection;
	}

	/**
	 * Adds new record in the tab_report table
	 * @param int $reported_tab_id
	 * @param int $author_id
	 * @param string $report
	 * @return boolean
	 */
	public function reportTab($reported_tab_id, $author_id, $report){
		$params = array('reported_ID' => $reported_tab_id, 'reporter_ID' => $author_id, 'report' => $report);
		$query = $this->connection->prepare('INSERT INTO tab_report (reported_ID, reporter_ID, report, date) VALUES (:reported_ID, :reporter_ID, :report, now())');
		return $query->execute($params);
	}

}

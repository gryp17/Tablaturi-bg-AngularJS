<?php

class UserReportModel {

	private $connection;

	public function __construct() {
		$this->connection = DB::getInstance()->connection;
	}

	/**
	 * Adds new record in the user_report table
	 * @param int $reported_user_id
	 * @param int $reporter_user_id
	 * @param string $report
	 * @return boolean
	 */
	public function reportUser($reported_user_id, $reporter_user_id, $report){
		$params = array('reported_ID' => $reported_user_id, 'reporter_ID' => $reporter_user_id, 'report' => $report);
		$query = $this->connection->prepare('INSERT INTO user_report (reported_ID, reporter_ID, report, date) VALUES (:reported_ID, :reporter_ID, :report, now())');
		return $query->execute($params);
	}

}

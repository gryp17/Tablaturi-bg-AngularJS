<?php

/**
 * Utils class
 *
 * @author plamen
 */
class Utils {

	/**
	 * Sends an email message
	 * @param string $from
	 * @param string $to
	 * @param string $subject
	 * @param string $message
	 */
	public static function sendEmail($from, $to, $subject, $message){
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$headers .= "From: $from \r\n";
		$headers .= "Reply-To: $from \r\n";
		$headers .= "Return-Path: $from\r\n";
		$headers .= "X-Mailer: PHP \r\n";

		return mail($to, $subject, $message, $headers);
	}
	
	/**
	 * Sends the contact us email message
	 * @param string $name
	 * @param string $email
	 * @param string $message
	 * @return boolean
	 */
	public static function sendContactUsEmail($name, $email, $message) {
		$from = $email;
		$to = 'admin@tablaturi-bg.com';
		$subject = 'Таблатури-BG запитване';

		$message = htmlspecialchars($message);

		$template = file_get_contents('app/views/email-templates/contact-us.php');
		$template = str_replace('{{name}}', $name, $template);
		$template = str_replace('{{email}}', $email, $template);
		$template = str_replace('{{message}}', $message, $template);

		return self::sendEmail($from, $to, $subject, $template);
	}
	
	/**
	 * Generates an activation link
	 * @param string $name
	 * @param string $email
	 * @return string
	 */
	public static function generateActivationLink($name, $email){
		$escaped_user = urlencode($name);
		$link = "http://tablaturi-bg.com/activate.php?user=$escaped_user&link=";
		$query = md5($name) . md5($email);
		return $link . $query;
	}
	
	/**
	 * Sends a confirmation email
	 * @param string $name
	 * @param string $email
	 * @return boolean
	 */
	public static function sendConfirmationEmail($name, $email){
		$from = 'admin@tablaturi-bg.com';
		$to = $email;
		$subject = 'Таблатури-BG активация';
		$link = self::generateActivationLink($name, $email);
		
		$template = file_get_contents('app/views/email-templates/confirmation.php');
		$template = str_replace('{{name}}', $name, $template);
		$template = str_replace('{{link}}', $link, $template);
		
		return self::sendEmail($from, $to, $subject, $template);
	}
	
	/**
	 * Sends a report user email to the administrator
	 * @param array $reported_user
	 * @param array $reporter_user
	 * @param string $report
	 * @return boolean
	 */
	public static function sendUserReportEmail($reported_user, $reporter_user, $report){
		$from = 'reports@tablaturi-bg.com';
		$to = 'admin@tablaturi-bg.com';
		$subject = "Таблатури-BG user report";
		
		$report = htmlspecialchars($report);
		
		$template = file_get_contents('app/views/email-templates/user-report.php');
		$template = str_replace('{{reported_username}}', $reported_user['username'], $template);
		$template = str_replace('{{reported_id}}', $reported_user['ID'], $template);
		$template = str_replace('{{reporter_username}}', $reporter_user['username'], $template);
		$template = str_replace('{{reporter_id}}', $reporter_user['ID'], $template);
		$template = str_replace('{{report}}', $report, $template);
				
		return self::sendEmail($from, $to, $subject, $template);
	}
	
	public static function sendTabReportEmail($reported_tab, $reporter_user, $report){
		$from = 'reports@tablaturi-bg.com';
		$to = 'admin@tablaturi-bg.com';
		$subject = "Таблатури-BG tab report";
		
		$report = htmlspecialchars($report);
		
		$template = file_get_contents('app/views/email-templates/tab-report.php');
		$template = str_replace('{{reported_tab_id}}', $reported_tab['ID'], $template);
		$template = str_replace('{{reported_tab_song}}', $reported_tab['song'], $template);
		$template = str_replace('{{reported_tab_band}}', $reported_tab['band'], $template);
		$template = str_replace('{{reporter_username}}', $reporter_user['username'], $template);
		$template = str_replace('{{reporter_id}}', $reporter_user['ID'], $template);
		$template = str_replace('{{report}}', $report, $template);
				
		return self::sendEmail($from, $to, $subject, $template);
	}
	
	/**
	 * Formats the date into javascript friendly format (from "2016-01-01 15:00:00" into "2016-01-01T15:00:00")
	 * @param string $input
	 * @return string
	 */
	public static function formatDate($input){
		return preg_replace('/\s/', 'T', $input);
	}
	
	/**
	 * Returns the page html
	 * @param string $url
	 * @param array $params
	 * @return string
	 */
	public static function getPageHtml($url, $params = array()) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		return curl_exec($ch);
	}

}

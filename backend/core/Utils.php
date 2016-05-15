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

}

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
	 * Loads the email template
	 * @param string $template_file
	 * @param array $data
	 * @return string
	 */
	private static function loadEmailTemplate($template_file, $data){
		$email_templates_dir = Config::EMAIL_TEMPLATES_DIR;
		
		//load the template file
		ob_start();
		include $email_templates_dir.$template_file.'.php';
		$template = ob_get_clean();
		
		//replace all placeholders with actual data
		foreach($data as $label => $value){
			$template = str_replace('{{'.$label.'}}', $value, $template);
		}
		
		return $template;
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
		$subject = 'Tablaturi-bg запитване';

		$message = htmlspecialchars($message);
		
		$data = array(
			'name' => $name,
			'email' => $email,
			'message' => $message
		);
		
		$template = self::loadEmailTemplate('contact-us', $data);

		return self::sendEmail($from, $to, $subject, $template);
	}
		
	/**
	 * Sends a confirmation email
	 * @param string $name
	 * @param string $email
	 * @return boolean
	 */
	public static function sendConfirmationEmail($name, $email, $link){
		$from = 'admin@tablaturi-bg.com';
		$to = $email;
		$subject = 'Tablaturi-bg активация на потребител';
		
		$data = array(
			'name' => $name,
			'link' => $link
		);
		
		$template = self::loadEmailTemplate('confirmation', $data);
				
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
		$subject = "Tablaturi-bg user report";
		
		$report = htmlspecialchars($report);
		
		$data = array(
			'reported_username' => $reported_user['username'],
			'reported_id' => $reported_user['ID'],
			'reporter_username' => $reporter_user['username'],
			'reporter_id' => $reporter_user['ID'],
			'report' => $report
		);
		
		$template = self::loadEmailTemplate('user-report', $data);
		
		return self::sendEmail($from, $to, $subject, $template);
	}
	
	/**
	 * Sends a tab report email to the administrator
	 * @param array $reported_tab
	 * @param array $reporter_user
	 * @param string $report
	 * @return boolean
	 */
	public static function sendTabReportEmail($reported_tab, $reporter_user, $report){
		$from = 'reports@tablaturi-bg.com';
		$to = 'admin@tablaturi-bg.com';
		$subject = "Tablaturi-bg tab report";
		
		$report = htmlspecialchars($report);
		
		$data = array(
			'reported_tab_id' => $reported_tab['ID'],
			'reported_tab_song' => $reported_tab['song'],
			'reported_tab_band' => $reported_tab['band'],
			'reporter_username' => $reporter_user['username'],
			'reporter_id' => $reporter_user['ID'],
			'report' => $report
		);
		
		$template = self::loadEmailTemplate('tab-report', $data);
				
		return self::sendEmail($from, $to, $subject, $template);
	}
	
	/**
	 * Sends a profile comment notification to the user
	 * @param array $recipient
	 * @param array $author
	 * @param string $content
	 * @return boolean
	 */
	public static function sendProfileCommentEmail($recipient, $author, $content){
		$from = 'admin@tablaturi-bg.com';
		$to = $recipient['email'];
		$subject = "Tablaturi-bg - нов коментар на профила Ви";
		
		$content = htmlspecialchars($content);
		
		$data = array(
			'author_username' => $author['username'],
			'author_id' => $author['ID'],
			'recipient_id' => $recipient['ID'],
			'content' => $content
		);
		
		$template = self::loadEmailTemplate('profile-comment-notification', $data);
		
		return self::sendEmail($from, $to, $subject, $template);
	}
	
	/**
	 * Sends an article comment notification to the article author
	 * @param array $recipient
	 * @param array $author
	 * @param string $content
	 * @return boolean
	 */
	public static function sendArticleCommentEmail($recipient, $author, $article_id, $content){
		$from = 'admin@tablaturi-bg.com';
		$to = $recipient['email'];
		$subject = "Tablaturi-bg - нов коментар на Ваша новина";
		
		$content = htmlspecialchars($content);
		
		$data = array(
			'author_username' => $author['username'],
			'author_id' => $author['ID'],
			'article_id' => $article_id,
			'content' => $content
		);
		
		$template = self::loadEmailTemplate('article-comment-notification', $data);
		
		return self::sendEmail($from, $to, $subject, $template);
	}
	
	/**
	 * Sends a tab comment notification to the user
	 * @param array $tab
	 * @param array $recipient
	 * @param array $author
	 * @param string $content
	 * @return boolean
	 */
	public static function sendTabCommentEmail($tab, $recipient, $author, $content){
		$from = 'admin@tablaturi-bg.com';
		$to = $recipient['email'];
		$subject = "Tablaturi-bg - нов коментар на Ваша таблатура";
		
		$content = htmlspecialchars($content);
		
		$data = array(
			'author_username' => $author['username'],
			'author_id' => $author['ID'],
			'tab_id' => $tab['ID'],
			'content' => $content
		);
		
		$template = self::loadEmailTemplate('tab-comment-notification', $data);
		
		return self::sendEmail($from, $to, $subject, $template);
	}
	
	/**
	 * Sends a reset password email containing a link from which the user can change their password
	 * @param string $email
	 * @param string $link
	 * @return boolean
	 */
	public static function sendPasswordResetEmail($email, $link){
		$from = 'admin@tablaturi-bg.com';
		$to = $email;
		$subject = "Tablaturi-bg - смяна на парола";
				
		$data = array(
			'link' => $link
		);
		
		$template = self::loadEmailTemplate('password-reset', $data);
		
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
	 * Generates a random token using the provided $input string
	 * @param string $input
	 * @return string
	 */
	public static function generateRandomToken($input){
		$input = md5($input.time().md5(mt_rand(0, 999999)));
		$input = str_split($input);
		$timestamp = str_split(md5(time()));
		$input = array_merge($input, $timestamp);
		shuffle($input);
		$input = implode('', $input);
		return $input;
	}
	
	/**
	 * Returns the page html
	 * @param string $url
	 * @param array $params
	 * @return string
	 */
	public static function getPageHtml($url, $params = array(), $authenticate = false) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		//if the authenticate flag is raised - authenticate before requesting the url
		if($authenticate === true){
			$ch = Utils::authenticate($ch);
		}
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

		return curl_exec($ch);
	}
	
	/**
	 * Authenticates in the guitarbackingtrack site
	 * @param object $ch
	 * @return object
	 */
	private static function authenticate($ch) {
		curl_setopt($ch, CURLOPT_URL, 'http://www.guitarbackingtrack.com/member.php');
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array('username' => Config::BT_NAME, 'password' => Config::BT_PASS));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_exec($ch);
		
		return $ch;
	}

	/**
	 * Returns the response headers
	 * @param string $url
	 * @return string
	 */
	public static function getHeaders($url, $params = array(), $authenticate = false){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		//if the authenticate flag is raised - authenticate before requesting the url
		if($authenticate === true){
			$ch = Utils::authenticate($ch);
		}
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_HEADER, true);
		
		return curl_exec($ch);
	}

}

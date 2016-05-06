<?php

require_once '/backend/models/User_model.php';

/**
 * Validator class used for user input validations
 */
class Validator {

	/**
	 * Checks if the passed value meets matches the rule's requirements
	 * @param string $field
	 * @param string $value
	 * @param string $rule
	 * @param array $params
	 * @return boolean
	 */
	public static function checkParam($field, $value, $rule, $params) {
		$result = true;
		
		#required rule
		if ($rule == "required") {
			if (!isset($value) || strlen($value) === 0) {
				return array("field" => $field, "error_code" => "empty_field");
			}
		}
		#integer rule
		if ($rule == "int") {
			if (!ctype_digit($value)) {
				return array("field" => $field, "error_code" => "invalid_int");
			}
		}
		#date rule
		if ($rule == "date") {
			if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
				return array("field" => $field, "error_code" => "invalid_date");
			}
		}
		#max-characters rule
		elseif (preg_match('/max-(\d+)/i', $rule, $matches)) {
			$max_length = $matches[1];
			if (strlen($value) > $max_length) {
				return array("field" => $field, "error_code" => "exceeds_characters_$max_length");
			}
		}
		#min-characters rule
		elseif (preg_match('/min-(\d+)/i', $rule, $matches)) {
			$min_length = $matches[1];
			if (strlen($value) < $min_length) {
				return array("field" => $field, "error_code" => "below_characters_$min_length");
			}
		}
		#unique[] field rule
		elseif (preg_match('/unique\[(.+?)\]/i', $rule, $matches)) {
			$unique_field = $matches[1];
			
			$user_model = new User_model();
			$result = $user_model->isUnique($unique_field, $value);
			
			if($user_model->isUnique($unique_field, $value) === false){
				return array("field" => $field, "error_code" => $unique_field."_in_use");
			}
		}
		#valid-email rule
		elseif ($rule == "valid-email") {
			if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
				return array("field" => $field, "error_code" => "invalid_email");
			}
		}
		#strong-passworld rule (at least 6 characters with 1 or more numbers)
		elseif ($rule == "strong-password") {
			if (strlen($value) < 6 || preg_match('/\d+/', $value) == false || preg_match('/[a-z]+/i', $value) == false) {
				return array("field" => $field, "error_code" => "weak_password");
			}
		} 
		#valid-characters rule (can contain only letters, digits, underscores and dashes)
		elseif ($rule == "valid-characters") {
			if (preg_match('/[^\w\d_-]/', $value)) {
				return array("field" => $field, "error_code" => "invalid_characters");
			}
		}
		#checks if the two fields are equal
		elseif (preg_match("/matches\[(.+?)\]/i", $rule, $matches)) {
			$match_field = $matches[1];
			
			if ($value !== $params[$match_field]) {
				return array("field" => $field, "error_code" => "no_match");
			}
		}
		#in[] rule
		elseif (preg_match("/in\[(.+?)\]/i", $rule, $matches)) {
			$list = $matches[1];
			$list = explode(";", $list);
			
			if(in_array($value, $list) === false){
				return array("field" => $field, "error_code" => "not_in_list");
			}
		}
		#matches-captcha rule
		elseif ($rule == "matches-captcha") {	
			if(strtolower($value) !== strtolower($_SESSION["captcha"]["code"])){
				return array("field" => $field, "error_code" => "invalid_captcha");
			}
		}

		return $result;
	}

}

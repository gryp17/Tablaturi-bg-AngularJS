<?php


/**
 * Validator class used for user input validations
 */
class Validator {
	
	/**
	 * Checks if the passed value meets matches the rule's requirements
	 * @param string $field
	 * @param string $value
	 * @param string $rule
	 * @return boolean
	 */
	public static function checkParam($field, $value, $rule){
		$result = true;
		
		#required rule
		if ($rule == "required") {
			if(!isset($value) || strlen($value) === 0){
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
			if (!preg_match('/^\d{4}-\d{2}-\d{2}\s\d{2}\:\d{2}\:\d{2}$/', $value)) {
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
		#unique field rule
		elseif (preg_match('/unique\[(.+?)\]/i', $rule, $matches)) {
			/*TODO: implement
			$unique_field = $matches[1];
			if (DB::is_unique($value, $unique_field) == false) {
				$result["status"] = false;
				$result["error"] = "$label already taken.";
			}*/
		}
		#valid-email rule
		elseif ($rule == "valid-email") {
			if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
				return array("field" => $field, "error_code" => "invalid_email");
			}
		}
		#strong-passworld rule (at least 6 characters with 1 or more numbers)
		elseif ($rule == "strong-password") {
			if (strlen($value) < 6 || preg_match('/\d+/', $value) == false) {
				return array("field" => $field, "error_code" => "weak_password");
			}
		}
		
		return $result;
	}
	
}

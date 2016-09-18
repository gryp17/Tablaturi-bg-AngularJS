<?php

class ErrorCodes {
	
	//core errors
	const INVALID_REQUEST = 'invalid_request';
	const ACCESS_DENIED = 'access_denied';
	const NOT_FOUND = 'not_found';
	const DB_ERROR = 'query_failed';
	const EMAIL_ERROR = 'send_email_failed';
	
	//validation errors
	const EMPTY_FIELD = 'empty_field';
	const AT_LEAST_ONE_FIELD_REQUIRED =  'at_least_one_field_required';
	const INVALID_INT = 'invalid_int';
	const INVALID_DATE = 'invalid_date';
	const EXCEEDS_CHARACTERS_ = 'exceeds_characters_'; //exceeds_characters_(\d+)
	const BELOW_CHARACTERS_ = 'below_characters_'; //below_characters_(\d+)
	const _IN_USE = '_in_use'; //(field)_in_use
	const INVALID_EMAIL = 'invalid_email';
	const INVALID_URL = 'invalid_url';
	const WEAK_PASSWORD = 'weak_password';
	const INVALID_CHARACTERS = 'invalid_characters';
	const NO_MATCH = 'no_match';
	const NOT_IN_LIST = 'not_in_list';
	const INVALID_CAPTCHA = 'invalid_captcha';
	const EXCEEDS_MAX_FILE_SIZE = 'exceeds_max_file_size';
	const INVALID_FILE_EXTENSION = 'invalid_file_extension';
	const EMAIL_NOT_FOUND = 'email_not_found';
	const INVALID_LOGIN = 'invalid_login';
	const INVALID_OR_EXPIRED_TOKEN = 'invalid_or_expired_token';
	
}

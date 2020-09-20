<?php //adduser-functions.php
error_reporting(E_ALL);
ini_set("display_errors", "1");

function validate_forename($field) {
	if ($field == "") return "No forename was given<br/>";
	else return "";
}

function validate_surname($field) {
	if ($field == "") return "No surname was given<br/>";
	else return "";
}

function validate_username($field) {
	if ($field == "") return "No username was entered.<br/>";
	else if (strlen($field) < 5)
		return "The username must be at least 5 characters long.<br/>";
	else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
		return "Usernames can only contain lowercase and uppercase characters, numbers, _ and -.<br/>";
	else return "";
}

function validate_password($field) {
	if ($field == "") return "No password was entered.<br/>";
	else if (strlen($field) < 6)
		return "Passwords must be at least 6 characters long.<br/>";
	else if (!preg_match("/[a-z]/", $field)	||
		!preg_match("/[A-Z]/", $field) ||
		!preg_match("/[0-9]/", $field))
			return "Passwords must contain at least one of each a-z, A-Z and 0-9.<br/>";
	else return "";
}

function validate_age($field) {
	if ($field == "") return "No age was entered.<br/>";
	else if ($field < 18 || $field > 110)
		return "Age must be between 18 and 110.<br/>";
	else return "";
}

function validate_email($field) {
	if ($field == "") return "No email was enteted.<br/>";
	else if (!((strpos($field, ".") > 0) && (strpos($field, "@") > 0)) ||
		preg_match("/[^a-zA-Z0-9.@_-]/", $field))
			return "Invalid email address<br/>";
	else return "";
}

function fix_string($string) {
	if (get_magic_quotes_gpc()) $string = stripslashes($string);
	return htmlentities($string);
}
?>

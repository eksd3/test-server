<?php //urlpost.php
error_reporting(E_ALL);
ini_set("display_errors", "1");

if (isset($_POST['url'])) {
	echo file_get_contents("http://" . sanitize_string($_POST['url']));
}

function sanitize_string($var) {
	$var = strip_tags($var);
	$var = htmlentities($var);
	return stripslashes($var);
}
?>

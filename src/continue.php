<?php // continue.php
error_reporting(E_ALL);
ini_set("display_errors", "1");
ini_set("session_gn.maxlifetime", 60 * 60 * 24);

function destroy_session_and_data()
{
	$_SESSION = array();
	setcookie(session_name(), "", time() - 2592000, "/");
	session_destroy();
}

session_start();

if (isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	$forename = $_SESSION['forename'];
	$surname = $_SESSION['surname'];

	destroy_session_and_data();

	echo "Welcome back $forename.<br/>
		Your full name is $forename $surname.<br/>
		Your username is '$username'.<br/>
		and your password is '$password'.";
}

else echo "Please click <a href='authenticate-user.php'>here</a> to log in.";
?>

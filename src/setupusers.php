<?php
error_reporting(E_ALL);
ini_set("display_errors", "1");

require_once "login.php";

function add_user($connection, $fn, $sn, $un, $pw) {
	$query = "INSERT INTO users VALUES('$fn', '$sn', '$un', '$pw')";
	$result = $connection->query($query);
		if (!$result) die($connection->error);
}

$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);

if ($connection->connect_error) die($connection->connect_error);

$query = "CREATE TABLE users (
	forename VARCHAR(32) NOT NULL,
	surname VARCHAR(32) NOT NULL,
	username VARCHAR(32) NOT NULL,
	password VARCHAR(32) NOT NULL )";
$result = $connection->query($query);

if (!$result) {
	echo "<br/>Table 'users' already exists. Listing all entries:<br/>";
	$query = "SELECT * FROM users";
	$result = $connection->query($query);
	$rows = $result->num_rows;
	for ($i = 0; $i < $rows; $i++) {
		$result->data_seek($i);
		$row = $result->fetch_array(MYSQLI_NUM);
		echo <<<_END
		<br/>
		<pre>
	Forename:	$row[0];
	Surname:	$row[1];
	Username:	$row[2];
	Password:	$row[3];
		</pre>
		<br/>
_END;
	}
	die;
}

$salt1	= "qm^h";
$salt2	= "@rj&1";

$forename	= "Bill";
$surname	= "Smith";
$username	= "bsmith";
$password	= "mysecret";
$token		= hash("ripemd128", "$salt1$password$salt2");

add_user($connection, $forename, $surname, $username, $token);

$forename	= "Pauline";
$surname	= "Jones";
$username	= "pjones";
$password	= "acrobat";
$token		= hash("ripemd128", "$salt1$password$salt2");

add_user($connection, $forename, $surname, $username, $token);


?>

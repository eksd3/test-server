<?php //adduser.php
error_reporting(E_ALL);
ini_set("display_errors", "1");

require_once "adduser-functions.php";
require_once "login.php";

$forename = $surname = $username = $password = $age = $email = "";
$hash1 = "@funk^";
$hash2 = "#niggerZ!";

if (isset($_POST['forename']))
	$forename = fix_string($_POST['forename']);
if (isset($_POST['surname']))
	$surname = fix_string($_POST['surname']);
if (isset($_POST['username']))
	$username = fix_string($_POST['username']);
if (isset($_POST['password'])) {
	$password_prehash = fix_string($_POST['password']);
	$password = hash("ripemd128", "$hash1$password_prehash$hash2");
}
if (isset($_POST['age']))
	$age = fix_string($_POST['age']);
if (isset($_POST['email']))
	$email = fix_string($_POST['email']);

$fail = validate_forename($forename); 
$fail .= validate_surname($surname);			
$fail .= validate_username($username);			
$fail .= validate_password($password_prehash);		
$fail .= validate_age($age);				
$fail .= validate_email($email);

if ($fail == "") {

echo <<<_END
<html lang="en">
	<head>
		<title>Success</title>
		<meta charset="UTF-8"/>
	</head>
	<body>
		<p>Success! Click <a href="validate.html">here</a> to continue.</p>
	</body>
</html>
_END;

	$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	if ($connection->connect_error) die($connection->connect_error);
	
	$query = "SELECT * FROM users";
	$result = $connection->query($query);
	$rows = $result->num_rows;
	$result->data_seek(2);
	$row = $result->fetch_array(MYSQLI_NUM);
	if ($row[2] == $username) echo "User " . $username . " already exists.<br/>";
	elseif ($row[2] != $username) {
		$query = "INSERT INTO users VALUES('$forename', '$surname', '$username', '$password', '$age', '$email', '')";
		$result = $connection->query($query);
		if (!$result) die("Connection error: " . $connection->error);
	}
	
	$query = "SELECT * FROM users";
	$result = $connection->query($query);
	$rows = $result->num_rows;
	for ($i = 0; $i < $rows; $i++) {
		$result->data_seek($i);
		$row = $result->fetch_array(MYSQLI_NUM);
		for ($j = 0; $j < 7; $j++)
		echo $row[$j] . "<br/>";
	
	}
}



?>

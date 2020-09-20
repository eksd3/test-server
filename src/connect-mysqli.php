<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "login.php";

$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	if ($connection->connect_error) die($connection->connect_error);

$query = "SELECT * FROM classics";
$result = $connection->query($query);
	if (!$result) die($connection->error);

$rows = $result->num_rows;

for ($i = 0; $i < $rows; $i++) {
	$result->data_seek($i);
	echo "Author: "	. $result->fetch_assoc()['author']	. "<br/>";
	$result->data_seek($i);
	echo "Title: "	. $result->fetch_assoc()['title']	. "<br/>";
	$result->data_seek($i);
	echo "Type: "	. $result->fetch_assoc()['type']	. "<br/>";
	$result->data_seek($i);
	echo "Year: "	. $result->fetch_assoc()['year']	. "<br/>";
	$result->data_seek($i);
	echo "ISBN: "	. $result->fetch_assoc()['isbn']	. "<br/><br/>";
}

$result->close();
$connection->close();
?>

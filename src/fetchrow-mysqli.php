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
	$row = $result->fetch_array(MYSQLI_ASSOC);

	echo "Author: "	. $row['author']	. "<br/>";
	echo "Title: "	. $row['title']		. "<br/>";
	echo "Type: "	. $row['type']		. "<br/>";
	echo "Year: "	. $row['year']		. "<br/>";
	echo "ISBN: "	. $row['isbn']		. "<br/><br/>";
}

$result->close();
$connection->close();
?>

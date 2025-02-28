<?php //temp.php
error_reporting(E_ALL);
ini_set("display_errors", "1");

require_once "login.php";

function get_post($connection, $var) {
	return $connection->real_escape_string($_POST[$var]);
}

$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connection->connect_error) die($connection->connect_error);

echo <<<_END
	<form action="temp.php" method="post">
	<pre>
		Author	<input type="text" name="author">
		Title	<input type="text" name="title">
		Type	<input type="text" name="type">
		Year	<input type="text" name="year">
		ISBN	<input type="text" name="isbn">
			<input type="submit" value="ADD ENTRY">
	</pre>
	</form>	
_END;

if 	(isset($_POST['author']) &&
	isset($_POST['title']) &&
	isset($_POST['type']) &&
	isset($_POST['year']) &&
	isset($_POST['isbn']))
{
	$author = get_post($connection, 'author');
	$title = get_post($connection, 'title');
	$type = get_post($connection, 'type');
	$year = get_post($connection, 'year');
	$isbn = get_post($connection, 'isbn');

	$query = "INSERT INTO classics VALUES ('$author', '$title', '$type', '$year', '$isbn')";
	
	$result = $connection->query($query);
		if (!$result) echo "INSERT failed: " . $query->error . "<br/>";
}

if (isset($_POST['delete']) && isset($_POST['isbn'])) {
	$isbn = get_post($connection, 'isbn');
	$query = "DELETE FROM classics WHERE isbn='$isbn'";
	$result = $connection->query($query);
	if (!$result) echo "DELETE failed: " . $query->error . "<br/>";
}

$query = "SELECT * FROM classics";
$result = $connection->query($query);

$rows = $result->num_rows;

for ($i = 0; $i < $rows; $i++) {
	$result->data_seek($i);
	$row = $result->fetch_array(MYSQLI_NUM);

	echo <<<_END
		<pre>
	Author	$row[0]
	Title	$row[1]
	Type	$row[2]
	Year	$row[3]
	ISBN	$row[4]

	<form action="temp.php" method="post">
		<input type="hidden" name="delete" value="yeah">
		<input type="hidden" name="isbn" value="$row[4]">
		<input type="submit" value="DELETE ENTRY">
	</form>
		</pre>
_END;
}

$result->close();
$connection->close();

?>

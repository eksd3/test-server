<?php
error_reporting(E_ALL);
ini_set("display_errors", "1");


if (isset($_POST['name']))
	$name = htmlentities($_POST['name']);
else $name = "(NOT SET)";

echo <<<_END
	<html>
		<head>
			<title>Form Test</title>
		</head>
		<body>
			Your name is: $name<br/>
			<form method="post" action="temp1.php">
				<input type="text" name="name">
				<input type="submit">
			</form>
		</body>
	</html>
_END;

?>

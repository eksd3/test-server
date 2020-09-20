<?php
error_reporting(E_ALL);
ini_set("display_errors", "1");

function sanitize_string($var) {
	$var = stripslashes($var);
	$var = htmlentities($var);
	$var = strip_tags($var);
	return $var;
}

echo <<<_END
<html>
<head><title="Celsius-Farenheit Converter"</title>
<body>	<pre>
	Enter either Farenheit or Celsius and click on Convert<br/>
	<form action="celsius-farenheit.php" method="post">
		Farenheit	<input type="text" name="f"/>
		Celsius		<input type="text" name="c"/>
				<input type="submit" value="Convert"/>
	</pre>
</body>
</html>
_END;

$f = $c = "";

if (($_POST['f'] != "") && ($_POST['c'] != ""))
	die("Fill out ONLY ONE of these forms");

if ($_POST['f'] != "") {
	$f = sanitize_string($_POST['f']);
	$c = intval((5/9) * ($f - 32));
	if ($c < -273) 
		echo "The given Farenheit value is below absolute zero Celsius ($c).";
	else	echo "<br/>$f F = $c C";
}

if ($_POST['c'] != "") {
	$c = sanitize_string($_POST['c']);
	$f = intval((9/5) * ($c + 32));
	echo "<br/>The given Celsius value is $f F";
}



?>

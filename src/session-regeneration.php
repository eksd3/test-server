<?php
error_reporting(E_ALL);
ini_set("display_errors", "1");

session_start();

if  (!isset($_SESSION['initiated']))
{
	$_SESSION['initiated'] = 1;
}

if (!isset($_SESSION['count'])) $_SESSION['count'] = 0;
else $_SESSION['count']++;

echo $_SESSION['count'];
?>

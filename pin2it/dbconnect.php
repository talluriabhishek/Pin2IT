<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'pin2it';
$link = mysql_connect($host,$user,$pass) or die(mysql_error());
$db = mysql_select_db($dbname) or die(mysql_error());
?>
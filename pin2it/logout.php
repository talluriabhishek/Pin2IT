<?php
require_once("dbconnection.php");
$conn = getMeDB();
session_start();

echo "<br /><br /><center> <b>Thanks for accessing our Pin2IT. Redirecting to Login Page!!!!</b></center>";
					
header("Refresh: 3;url=login.php");

session_destroy();
$conn->close();

header('Refresh: 2;url=login.php');

?>

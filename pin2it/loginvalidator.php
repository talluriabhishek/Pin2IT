<?php
require_once("dbconnection.php");
$conn = getMeDB();

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "select username from user where username=? and password=?";
$sql_login = $conn->prepare($sql);
$sql_login->bind_param("ss", $username,$password);
$sql_login->execute();

$sql_login ->store_result();
$count = $sql_login->num_rows;

if($count == 0)
{
	//echo 'no users';
	//$conn->close();
	header('Refresh: 0;url=login.php?error=1');
}
else
{
	$_SESSION["username"] = $username;
	$conn20 = getMeDB();
	
	header('Refresh: 2;url=homepage.php');
}


?>
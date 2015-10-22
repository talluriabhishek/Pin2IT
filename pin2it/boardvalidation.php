<?php
require_once("dbconnection.php");
$conn = getMeDB();

session_start();
$username = $_SESSION["username"];
$boardname = $_POST['boardname'];
$sharetype = $_POST['sharetype'];

$sql = "select username,boardname from pinboards where username=? and boardname=?";
$sql_login = $conn->prepare($sql);
$sql_login->bind_param("ss", $username,$boardname);
$sql_login->execute();

$sql_login ->store_result();
$count = $sql_login->num_rows;

if($count == 0)
{
	$conn2 = getMeDB();
		$sql2 = "insert into pinboards (username,boardname,sharetype) values(?,?,?)";
		$sql_login = $conn2->prepare($sql2);
		$sql_login->bind_param("sss", $username,$boardname,$sharetype);
		$sql_login->execute();
		header("Refresh: 0;url=homepage.php");
}
else
{
	header('Refresh: 2;url=homepage.php?error=1');
}


?>
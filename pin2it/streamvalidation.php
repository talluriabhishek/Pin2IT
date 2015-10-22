<?php
require_once("dbconnection.php");
$conn = getMeDB();

session_start();
$username = $_SESSION["username"];
$streamname = $_POST['streamname'];

$sql = "select username,streamname from streams where username=? and streamname=?";
$sql_stream = $conn->prepare($sql);
$sql_stream->bind_param("ss", $username,$streamname);
$sql_stream->execute();

$sql_stream ->store_result();
$count = $sql_stream->num_rows;

if($count == 0)
{
	$conn2 = getMeDB();
		$sql2 = "insert into streams (username,streamname) values(?,?)";
		$sql_login = $conn2->prepare($sql2);
		$sql_login->bind_param("ss", $username,$streamname);
		$sql_login->execute();
		header("Refresh: 0;url=homepage.php");
}

?>
<?php
require_once("dbconnection.php");
$conn = getMeDB();

session_start();
$username = $_SESSION["username"];
$boardname = $_POST['boardname'];
$picId = $_POST['picId'];

$sql = "select picId,username,boardname from pins where username=? and boardname=? and picId =?";
$sql_login = $conn->prepare($sql);
$sql_login->bind_param("sss", $picId,$username,$boardname);
$sql_login->execute();

$sql_login ->store_result();
$count = $sql_login->num_rows;
if($count == 0)
{
	$conn2 = getMeDB();
		$sql2 = "insert into pins (picId,boardname,username,time) values(?,?,?,sysdate())";
		$sql_pins = $conn2->prepare($sql2);
		$sql_pins->bind_param("iss", $picId,$boardname,$username);
		$sql_pins->execute();
		header("Refresh: 0;url=homepage.php");
}
else
{
	header('Refresh: 2;url=pictures.php?error=5');
}


?>
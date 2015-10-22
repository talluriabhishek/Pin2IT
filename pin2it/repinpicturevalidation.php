<?php
require_once("dbconnection.php");
$conn = getMeDB();
session_start();
$username = $_SESSION["username"];
$boardname = $_POST['boardname'];
$boardname2 = $_POST['boardname2'];
$otheruser = $_POST['otheruser'];
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
	
	$conn3 = getMeDB();
	$sql3 = "insert into repins (username,boardname,picId,boardname2,username2,time) values(?,?,?,?,?,sysdate())";
	$sql_repins = $conn3->prepare($sql3);
	$sql_repins->bind_param("ssiss", $username,$boardname,$picId,$boardname2,$otheruser);
	$sql_repins->execute();
	header("Refresh : 0;url =board.php?otheruser=$otheruser&boardname=$boardname2");
	
	
}


?>
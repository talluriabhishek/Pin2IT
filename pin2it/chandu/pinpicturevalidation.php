<?php
require_once("dbconnection.php");
$conn = getMeDB();

session_start();
$username = $_SESSION["username"];
$boardname = $_POST['boardname'];
$picId = $_POST['picId'];

$sql = "select username,boardname from pins where picId =?";
$sql_login = $conn->prepare($sql);
$sql_login->bind_param("s", $picId);
$sql_login->execute();
$sql_login ->store_result();
$count = $sql_login->num_rows;
$sql_prep_boards->bind_result($user1,$board1);

if ($count==0){
	$sql = "insert into pins (picId,boardname,username,time) values(?,?,?,sysdate())";
	$sql_pins = $conn->prepare($sql);
	$sql_pins->bind_param("iss", $picId,$boardname,$username);
	$sql_pins->execute();
	header("Refresh: 0;url=homepage.php");
} else {
	$conn2 = getMeDB();
	$sql2 = "select picId,username,boardname from pins where username=? and boardname=? and picId =?";
	$sql_login = $conn2->prepare($sql2);
	$sql_login->bind_param("sss", $picId,$username,$boardname);
	$sql_login->execute();
	$sql_login ->store_result();
	$count1 = $sql_login->num_rows;
	header('Refresh: 2;url=pictures.php?');
	if ($count1==0){
		$conn2 = getMeDB();
		$sql2 = "insert into re_pins (username, boardname,picId,username2,boardname2,time) values(?,?,?,?,?,sysdate())";
		$sql_login = $conn2->prepare($sql2);
		$sql_login->bind_param("sssss", $username,$boardname,$picId,$user1,$board1);
		$sql_login->execute();
		$sql_login ->store_result();
	} else {
		header('Refresh: 2;url=pictures.php?error=5');
	}

}

?>
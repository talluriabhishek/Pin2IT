<?php
require_once("dbconnection.php");
session_start();
$username = $_SESSION["username"];

$picId = $_POST['picId'];
$comment = $_POST['comment'];
$boardname = $_POST['boardname'];
if(isset($_POST['otheruser']) && ($_POST['otheruser'] != ''))
{
	$otherUser = $_POST['otheruser'];	
}else
{
	$otherUser = $username;
}

$conn = getMeDB();




$sql = "insert into comments (username,username2,boardname2,picId,comment,time) values(?,?,?,?,?,sysdate())";
$sql_comments = $conn->prepare($sql);

$sql_comments->bind_param("sssis", $username,$otherUser,$boardname,$picId,$comment);
$sql_comments->execute();


$conn1 = getMeDB();
$sql2 = "select * from comments where picId = $picId and boardname2 = '$boardname' order by time desc";

$result = $conn1->query($sql2);

$row1 = $result->fetch_row();
if($row2 = $result->fetch_row())
{
	echo $row2[4] . '||||' . $row1[4];
}else{
	echo $row1[4];
}



?>
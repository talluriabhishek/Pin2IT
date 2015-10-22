<?php
require_once("dbconnection.php");

session_start();
$username = $_SESSION["username"];

$boardname = $_POST['hiddenBoardId1'];
$otheruser = $_POST['hiddenUser'];
$streamname = $_POST['streamname'];

$conn = getMeDB();

$sql = "insert into followstreams (username,streamname,username2,boardname2,time) values(?,?,?,?,sysdate())";
$sql_followstreams = $conn->prepare($sql);
$sql_followstreams->bind_param("ssss", $username,$streamname,$otheruser,$boardname);
$sql_followstreams->execute();

header("Refresh: 0;url=board.php?boardname=$boardname&otheruser=$otheruser");

?>
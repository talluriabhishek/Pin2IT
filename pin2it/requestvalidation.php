<?php
require_once("dbconnection.php");
session_start();
$username = $_SESSION["username"];
$friend = $_POST['otherUser'];
$conn1 = getMeDB();
$status = 'request sent';

$sql_friends = "insert into friends (username,username2,status,time) values (?,?,?,sysdate())";
$sql_prep_friends = $conn1->prepare($sql_friends);
$sql_prep_friends->bind_param("sss", $username,$friend,$status);
$sql_prep_friends->execute();

?>
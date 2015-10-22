<?php
require_once("dbconnection.php");

$picId = $_POST['picId'];


$conn = getMeDB();

session_start();
$username = $_SESSION["username"];

$sql = "insert into likes (username,picId,time) values(?,?,sysdate())";
$sql_likes = $conn->prepare($sql);
$sql_likes->bind_param("si", $username,$picId);
$sql_likes->execute();

$conn1 = getMeDB();

$sql2 = "select count(*) from likes where picId = $picId";


$result = $conn1->query($sql2);

$row = $result->fetch_row();
echo $row[0];

?>
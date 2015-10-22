<?php
require_once("dbconnection.php");
session_start();
$username = $_SESSION["username"];
$friend = $_POST['friend'];

$conn1 = getMeDB();
$sql_friends = "UPDATE friends SET status = ?, timestamp = ? WHERE username = ? AND username2 = ?";
$sql_prep_friends = $conn1->prepare($sql_friends);
$time = date("Y-m-d h:i:sa");
if(isset($_POST['accept'])){
	$status = 'accepted';
} else {
	$status = 'rejected';
}

$sql_prep_friends->bind_param("ssss", $status,$time,$friend,$username);
$sql_prep_friends->execute();
header("Refresh: 0;url=homepage.php");
?>
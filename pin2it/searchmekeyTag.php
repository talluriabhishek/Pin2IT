<?php
require_once("dbconnection.php");
session_start();

$username = $_SESSION['username'];
$conn1 = getMeDB();

$srchString = $_POST['key'];

$wild="%$srchString%";

$sql2 = 'select url from pictures where username = "'.$username .'" and tags LIKE "' . $wild . '"' ;

$result = $conn1->query($sql2);

$picIdList = [];

//$totalStringsThis = '';
while($row = $result->fetch_row())
{
	$picIdList[] =$row[0];
}

$jsonEncoded = json_encode($picIdList);

print_r($jsonEncoded);

?>
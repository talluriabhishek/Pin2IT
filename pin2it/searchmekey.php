<?php
require_once("dbconnection.php");


$conn1 = getMeDB();

$srchString = $_POST['key'];

$wild="%$srchString%";

$sql2 = 'select * from user where username LIKE "' . $wild . '"';

$result = $conn1->query($sql2);

$userslist = [];

while($row = $result->fetch_row())
{
	$userslist[] = $row;
}

$usersencoded = json_encode($userslist);

print_r($usersencoded);
?>

<?php
require_once("config.php");
//Create connection
function getMeDB()
{
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pin2it";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
return $conn;
} 
?>
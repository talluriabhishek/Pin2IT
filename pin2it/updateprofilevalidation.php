<?PHP
require_once("dbconnection.php");
$conn = getMeDB();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$newfirstname=$_POST["newfirstname"];
$newlastname=$_POST["newlastname"];
$newpassword=$_POST["newpassword"];

session_start();
$username = $_SESSION["username"];

$conn2 = getMeDB();
$sql2 = "update user set firstname = ?,lastname = ?,password = ? where username = ?";
$sql_login = $conn2->prepare($sql2);
$sql_login->bind_param("ssss", $newfirstname,$newlastname,$newpassword,$username);
$sql_login->execute();
header("Refresh: 0;url=homepage.php");

?>	
		

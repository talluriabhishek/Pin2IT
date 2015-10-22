<!DOCTYPE html>
<?PHP
require_once("dbconnection.php");
$conn = getMeDB();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$username=$_POST["username"];
$firstname=$_POST["firstname"];
$lastname=$_POST["lastname"];
$password=$_POST["password"];
$email=$_POST["email"];
$rpassword=$_POST["rpassword"];

session_start();


$_SESSION["username"]=$username;

	$conn1 = getMeDB();
	$sql = "select * from user where username=?";
	$sql_login = $conn1->prepare($sql);
	$sql_login->bind_param("s", $username);
	$sql_login->execute();

	$sql_login ->store_result();
	$count = $sql_login->num_rows;
	if($count ==0)
	 {
		$conn2 = getMeDB();
		$sql2 = "insert into user (username,firstname,lastname,email,password) values(?,?,?,?,?)";
		$sql_login = $conn2->prepare($sql2);
		$sql_login->bind_param("sssss", $username,$firstname,$lastname,$email,$password);
		$sql_login->execute();
		header("Refresh: 0;url=homepage.php");
	 }

	else {
		header("Refresh: 0;url=login.php?error=2");
	}

?>	
		

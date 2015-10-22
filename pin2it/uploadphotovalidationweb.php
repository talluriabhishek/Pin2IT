<?php
require_once("dbconnection.php");
include("dbconnect.php");
$conn = getMeDB();

session_start();
$username = $_SESSION["username"];
$target_dir = "uploads/";


if(isset($_POST['url'])){
	
	$url = $_POST['url'];
	$name = basename($url);
	$name = md5($name);
	$name = $name . uniqid($name);
	$ext = pathinfo($url, PATHINFO_EXTENSION);
	$name = $name.".".$ext;
	$loc = $_SERVER['HTTP_ORIGIN']."/pin2it/uploads/".$name;
	$target_file = $target_dir . $name;
	$imgData =addslashes (file_get_contents($url));
	file_put_contents("uploads/$name",file_get_contents($url));
	$tag = $_POST['tags'];
	$sql="INSERT into pictures(picId,picture,tags,url,username) values ('','$imgData','$tag', '$loc','$username')";
	mysql_query($sql,$link) or die(mysql_error());
	$sql1='SELECT picId from pictures WHERE url = "'.$loc.'"';
	$query1 = mysql_query($sql1) or die(mysql_error());
	$result=mysql_fetch_array($query1);
	$sql = "select picId,username,boardname from pins where username=? and boardname=? and picId =?";
	$sql_login = $conn->prepare($sql);
	$sql_login->bind_param("sss", $result['picId'],$username,$POST['boardname']);
	$sql_login->execute();

	$sql_login ->store_result();
	$count = $sql_login->num_rows;
	if($count == 0)
	{
		$conn2 = getMeDB();
		$sql2 = "insert into pins (picId,boardname,username,time) values(?,?,?,sysdate())";
		$sql_pins = $conn2->prepare($sql2);
		$sql_pins->bind_param("iss", $result['picId'],$_POST['boardname'],$username);
		$sql_pins->execute();
		header("Refresh: 0;url=pictures.php");
	}
	else
	{
		header('Refresh: 2;url=pictures.php?error=5');
	}
	
	  
}else{
	  
	header("Refresh: 0;url=uploadphotoweb.php?error=1");
}	
 
 


?>
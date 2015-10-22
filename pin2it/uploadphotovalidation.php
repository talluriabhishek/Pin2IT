<?php
include("dbconnect.php");
$target_dir = "uploads/";


if(isset($_FILES['filename']) && $_FILES['filename']['size'] > 0){
	
 
	
	$size=$_FILES['filename']['size'];
 
	// getting the image info..
	$imgdetails = getimagesize($_FILES['filename']['tmp_name']);
	$mime_type = $imgdetails['mime']; 
 
	// checking for valid image type
	if(($mime_type=='image/jpeg')||($mime_type=='image/gif')){
	  // checking for size again
		
	    $filename=$_FILES['filename']['name'];	
	    $imgData =addslashes (file_get_contents($_FILES['filename']['tmp_name']));
		$name = $_FILES['filename']['name'];
		if (!get_magic_quotes_gpc()) {
			$name = addslashes($name);
		}
		$name = md5($name);
		$name = $name . uniqid($name);
		$path = $_FILES['filename']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$name = $name.".".$ext;
		$tag = $_POST['tags'];
		$loc = $_SERVER['HTTP_ORIGIN']."/pin2it/uploads/".$name;
		$target_file = $target_dir . $name;
		if (move_uploaded_file($_FILES['filename']['tmp_name'], $target_file)) {
			//echo "File is valid, and was successfully uploaded.\n";
		} else {
			echo "Possible file upload attack!\n";
		}
		//$null = '';
		//$conn1 = getMeDB();
		require_once('dbconnection.php');
		session_start();
		$username5 = $_SESSION['username'];
	    $sql="INSERT into pictures(picId,username,picture,tags,url) values ('','$username5','$imgData','$tag', '$loc')";
		//$sql_pictures = $conn1->prepare($sql);
		//$sql_pictures->bind_param("isss", $null,$imgData,$tag,$loc);
		//$sql_pictures->execute();
		mysql_query($sql,$link) or die(mysql_error());
		header("Refresh: 0;url=pictures.php");
	    
	  
	}else{
	  header("Refresh: 0;url=uploadphoto.php?error=1");
	}
 
}else{	
	header("Refresh: 0;url=uploadphoto.php?error=2");
  		
}	
 
 


?>
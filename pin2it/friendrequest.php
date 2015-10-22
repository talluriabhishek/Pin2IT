<?php
include("dbconnect.php");

$username = $_POST['username'];
$otheruser = $_POST['otheruser'];

$sql="INSERT into friends(username,username2,status,timestamp) values ('$username','$otheruser','', sysdate())";
mysql_query($sql,$link) or die(mysql_error());
?>
<!-- BEGIN INBOX DROPDOWN -->
<?php
$sql='SELECT username,timestamp from friends WHERE username2 = $username AND status = "request sent"';
$query=mysql_query($sql) or die(mysql_error);

$sql = 'SELECT username,timestamp from friends WHERE username2 = ? AND status = ?';
$sql_login = $conn->prepare($sql);
$sql_login->bind_param("ss", $result['username'],'request sent');
$sql_login->execute();
$sql_login ->store_result();
$count = $sql_login->num_rows;
echo '<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
		<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
		<i class="icon-envelope-open"></i>
		<span class="badge badge-default">'.$count.' </span>
		</a>
		<ul class="dropdown-menu">
			<li class="external">
				<h3>You have <span class="bold">'.$count.'</span> Messages</h3>
			</li>
			<li>
				<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
					while($result=mysql_fetch_array($query))
					{
						echo '<li>
								<a href="inbox.html?friend='. $result['username'].'">
								<span class="subject">
								<span class="from">'.$result['username'].' </span>';
								$str = $result['timestamp'];
								$time = date('d M ', strtotime($str));
								echo '<span class="time">'.$time.' </span>
								</span>
								<span class="message">
								You have a friend request from '.$result['username'].' </span>
								</a>
							</li>';
					}
					
				</ul>
			</li>
		</ul>
	</li>';
	?>
				<!-- END INBOX DROPDOWN -->
while($result=mysql_fetch_array($query))
{
	echo '<li>
			<a href="inbox.html?friend='. $result['username'].'">
			<span class="subject">
			<span class="from">'.$result['username'].' </span>';
			$str = $result['timestamp'];
			$time = date('d M ', strtotime($str));
			echo '<span class="time">'.$time.' </span>
			</span>
			<span class="message">
			You have a friend request from '.$result['username'].' </span>
			</a>
		</li>';
}

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
	$sql="INSERT into pictures(picId,picture,tags,url) values ('','$imgData','$tag', '$loc')";
	mysql_query($sql,$link) or die(mysql_error());
	echo '<html><body><img alt="" src="data:image/jpeg;base64,' . base64_encode($imgData) . '" /></body></html>';
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
		header("Refresh: 0;url=homepage.php");
	}
	else
	{
		header('Refresh: 2;url=pictures.php?error=5');
	}
	
	  
}else{
	  
	header("Refresh: 0;url=uploadphotoweb.php?error=1");
}	

?>
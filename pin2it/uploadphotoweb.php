<?php
if (empty($_GET)) {
	$error = 0;
}
else
{
	if (empty($_GET['error']))
	{
		
	}
	else
	{
		$error = $_GET['error'];
	}
}

if($error == 1){
	print "<font class='error'>Not a valid image file! Please upload jpeg or gif image.</font>";
}else if($error == 2){
	print "<font class='error'>Not a valid image file! Please upload jpeg or gif image.</font>";
}

require_once("dbconnection.php");

session_start();
$username = $_SESSION["username"];

$conn1 = getMeDB();
$sql_boards = "select boardname  from pinboards where username = ?";
$sql_prep_boards = $conn1->prepare($sql_boards);
$sql_prep_boards->bind_param("s", $username);
$sql_prep_boards->execute();

$sql_prep_boards ->store_result();
$count1 = $sql_prep_boards->num_rows;
$sql_prep_boards->bind_result($boardname);

$sql_prep_boards1 = $conn1->prepare($sql_boards);
$sql_prep_boards1->bind_param("s", $username);
$sql_prep_boards1->execute();

$sql_prep_boards1->store_result();
$sql_prep_boards1->bind_result($boardname);

$conn3 = getMeDB();
$sql_streams = "select streamname from streams where username = ?";
$sql_prep_streams = $conn3->prepare($sql_streams);
$sql_prep_streams->bind_param("s", $username);
$sql_prep_streams->execute();
$sql_prep_streams ->store_result();
$sql_prep_streams->bind_result($streamname);
$count3 = $sql_prep_streams->num_rows;

$conn4 = getMeDB();
$sql_friends = "select username2 from friends where username = ? and status = 'accepted'";
$sql_prep_friends = $conn4->prepare($sql_friends);
$sql_prep_friends->bind_param("s", $username);
$sql_prep_friends->execute();
$sql_prep_friends->store_result();
$sql_prep_friends->bind_result($friend);
$count4 = $sql_prep_friends->num_rows;

$conn5 = getMeDB();
$sql_friends1 = "select username from friends where username2 = ? and status = 'accepted'";
$sql_prep_friends1 = $conn5->prepare($sql_friends1);
$sql_prep_friends1->bind_param("s", $username);
$sql_prep_friends1->execute();
$sql_prep_friends1->store_result();
$sql_prep_friends1->bind_result($friend1);
$count5 = $sql_prep_friends->num_rows;

?>

<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 3.8.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | Page Layouts - Upload photo web</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="homepage.php">
			<img src="assets/admin/layout/img/logo.png" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		
		
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				
				<!-- BEGIN INBOX DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<?php
					require_once("dbconnection.php");

					$conn2 = getMeDB();
					$sql1 = 'SELECT username  from friends WHERE username2 = ? AND status = "request sent"';
					$sql_login = $conn2->prepare($sql1);
					$sql_login->bind_param("s", $username);
					$sql_login->execute();
					$sql_login ->store_result();
					$count = $sql_login->num_rows();
					$username6 = '';
					$sql_login->bind_result($username6);
				?>
				<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-envelope-open"></i>
						<span class="badge badge-default"><?php echo $count;?></span>
						</a>
				<ul class="dropdown-menu">
						<li class="external">
							<h3>You have <span class="bold"><?php echo $count ?></span> Messages</h3>
						</li>
						<li>
							<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
							<?php
							while($sql_login->fetch()) 
							{
							?>
						
							<li> 
							<?php
								echo '<a href="frenreqdecision.php?friend='. $username6.'">
												<span class="subject">
												<span class="from">'.$username6.' </span>';
							?>
								</span>
								<span class="message">
								You have a friend request from <?php echo $username6; ?> </span>
								</a>								
							</li>
							<?php }?>
							</ul>
						</li>
					</ul>
				</li>
				<!-- END INBOX DROPDOWN -->
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img alt="" class="img-circle" src="assets/admin/layout/img/avatar3_small.jpg"/>
					<span class="username username-hide-on-mobile">
					<?php
						echo $username ;
					?>
					</span>
					<i class="fa fa-angle-down"></i>
					</a>
					
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="updateprofile.php">
							<i class="icon-user"></i> Update Profile </a>
						</li>
						<li>
							<a href="logout.php">
							<i class="icon-calendar"></i> Logout </a>
						</li>
						
					</ul>
				</li>

				
				<!-- END USER LOGIN DROPDOWN -->
			</ul>
		</div>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="margin-top:25px;">
				<li class="start ">
					<a href="javascript:;">
					<i class="icon-rocket"></i>
					<span class="title">Boards</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
					<?php
						while($sql_prep_boards->fetch()) 
						{
						?>
						
						<li> 
						<?php
							echo '<a href="board.php?boardname='.$boardname.'"> '.$boardname.'</a>';
						?>
						</li>
					<?php }?>
						
					</ul>
				</li>
				<li>
					<a href="javascript:;">
					<i class="icon-rocket"></i>
					<span class="title">Friends</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
					<?php
						while($sql_prep_friends->fetch()) 
						{
						?>
						
						<li> 
						<?php
							$conn6 = getMeDB();
							$sql_user = "select firstname, lastname from user where username = ?";
							$sql_prep_user = $conn6->prepare($sql_user);
							$sql_prep_user->bind_param("s", $friend);
							$sql_prep_user->execute();
							$sql_prep_user->store_result();
							$sql_prep_user->bind_result($fname,$lname);
							$sql_prep_user->fetch();
							
							$friendname = $fname . ' ' . $lname;
							echo '<a href="otherprofile.php?otheruser='.$friend.'"> '.$friendname.'</a>';
						?>
						</li>
					<?php }?>
					
					<?php
						while($sql_prep_friends1->fetch()) 
						{
						?>
						
						<li> 
						<?php
							$conn7 = getMeDB();
							$sql_user1 = "select firstname, lastname from user where username = ?";
							$sql_prep_user1 = $conn7->prepare($sql_user1);
							$sql_prep_user1->bind_param("s", $friend1);
							$sql_prep_user1->execute();
							$sql_prep_user1->store_result();
							$sql_prep_user1->bind_result($fname,$lname);
							$sql_prep_user1->fetch();
							$friendname1 = $fname . ' ' . $lname;
							echo '<a href="otherprofile.php?otheruser='.$friend1.'"> '.$friendname1.'</a>';
						?>
						</li>
					<?php }?>
						
					</ul>
				</li>
				<li >
					<a href="javascript:;">
					<i class="icon-rocket"></i>
					<span class="title">Follow Streams</span>
					<span class="selected"></span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
					<?php
						while($sql_prep_streams->fetch()) 
						{
						?>
						
						<li> 
						<?php
							echo '<a href="stream.php?streamname='.$streamname.'"> '.$streamname.'</a>';
						?>
						</li>
					<?php }?>
						
					</ul>
				</li>
				<li >
					<a href="pictures.php">
					<i class="icon-rocket"></i>
					<span class="title">Pictures</span>
					<span class="selected"></span>
					<span class="arrow "></span>
					</a>
				</li>
				<li >
					<a href="search.php">
					<i class="icon-rocket"></i>
					<span class="title">Search</span>
					<span class="selected"></span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li> 
							<a href="search.php"> By Username</a>
							
						</li>
						<li> 
							
							<a href="searchtags.php"> By Tags</a>
						</li>
						
					</ul>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			
			<!-- BEGIN PAGE HEADER-->
			<div class="page-bar">
				<div >
					<a type="button" href="uploadphoto.php" class="btn btn-primary  col-md-2 " >Upload Photo</a>
					<a type="button" href="uploadphotoweb.php" class="btn btn-primary  col-md-2 " >Upload From Web</a>
					<a type="button" href="createboard.php" class="btn btn-primary  col-md-2 " >Create Board</a>
					<a type="button" href="createstream.php" class="btn btn-primary  col-md-2 " >Create Stream</a>
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<!-- UPLOAD PHOTO FORM -->
				<form action="uploadphotovalidationweb.php" class="form-horizontal form-bordered" method="post" enctype = "multipart/form-data">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-9 col-md-offset-4">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<label for="inputUrl"><b>URL: </b></label>
									<input type="url" id="inputUrl" name = "url">
									<br><br>
									<div>
									<b>Tags: </b><input type="text" name="tags"><br><br>
									</div></div>
								<div>
								<label class = "col-md-offset-1"><b> Board: </b></label>
								<select class="form-control input-medium select2me" data-placeholder="Select..." name = "boardname">
									<option value=""></option>
									<?php 
										while($sql_prep_boards1->fetch()) 
										{									
											echo '<option value="'.$boardname . '"> '. $boardname .'</option>';							
										}
									?>
								</select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<div class="row">
							<div class="col-md-9 col-md-offset-4">
								<button type="submit" class="btn purple"><i class="fa fa-check"></i> Upload</button>
								<a type="button" class="btn default" href="homepage.php">Cancel</a>
							</div>
						</div>
					</div>
				</form>
			<!-- END UPLOAD PHOTO FORM -->
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
	
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 2014 &copy; Metronic by keenthemes. <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
<script src="assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script src="assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/global/plugins/ckeditor/ckeditor.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/admin/pages/scripts/components-form-tools.js"></script>
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
      jQuery(document).ready(function() {    
         Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
      });
   </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
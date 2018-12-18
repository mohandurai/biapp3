<?php session_start();
if(!isset($_SESSION['user'])){
    
   echo '<script>window.location.href="index.php";</script>';
}
//error_reporting(0);
$servername = "localhost";
$username = "audineev";
$password = "rsa@2016!!";



//connection to the database
$dbhandle = mysql_connect($servername, $username, $password) 
  or die("Unable to connect to MySQL");
$selected = mysql_select_db("audineev_testing",$dbhandle) 
  or die("Could not select examples");
?>

<?php  include("../includes/dbcon.php");?>
<?php  include("../includes/function.php");?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8" />

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="plugins/colorpicker/colorpicker.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="plugins/ibutton/jquery.ibutton.css" media="screen">

<link rel="stylesheet" type="text/css" href="css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/themer.css" media="screen">

<title>Audi - Dashboard</title>

</head>

<body>

	<!-- Header -->
	<div id="mws-header" class="clearfix">
    
    	<!-- Logo Container -->
    	<div id="mws-logo-container">
        
        	<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        	<div id="mws-logo-wrap">
            	<img src="../img/logo.png" alt="mws admin" style="background:#fff;">
			</div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
                    
            
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
            
            	<!-- User Photo -->
            	<div id="mws-user-photo">
                	<img src="bootstrap/user.png" alt="User Photo">
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Hello, ADMIN!!
                        
                </div>
                    <ul>
                        <li><a href="logout.php">Logout</a></li>
                        <li><a href="change_password.php?sub=list">Change Password</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
    	<!-- Necessary markup, do not remove -->
		<div id="mws-sidebar-stitch"></div>
		<div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul>
                    <li><a href="city.php?sub=list"><i class="icon-list"></i> City</a></li>
                    <li><a href="centre.php?sub=list"><i class="icon-list"></i> Audi Centre</a></li>
                    <li><a href="jobs.php?sub=list"><i class="icon-list"></i> Job Posting</a></li>
                    <li><a href="application.php?sub=list"><i class="icon-list"></i> Application</a></li>
                    <li><a href="working.php?sub=list"><i class="icon-list"></i> Working at Audi</a></li>
                    <li><a href="advantages.php?sub=list"><i class="icon-list"></i> Advantages</a></li>
                    <li><a href="slider.php?sub=list"><i class="icon-list"></i> Slider</a></li>
                    <li><a href="terms.php?sub=list"><i class="icon-list"></i> Terms</a></li>
                </ul>
            </div>
        </div>

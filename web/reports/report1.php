<?php 

session_start();
error_reporting(0);

$p1 = explode("/",$_SERVER['REQUEST_URI']);

if (isset($_SERVER['HTTPS']) &&
  ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
  isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
  $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $protocol = 'https://';
  }
else {
    $protocol = 'http://';
}

$url3 = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/reports";
//echo $url3;
//exit;
?>

<html>
<head>
<style type="text">
        html, body {
			margin: 0;			/* Remove body margin/padding */
			padding: 0;
		    overflow: hidden;	/* Remove scroll bars on browser window */
	        font-size: 85.5%;
        }
		body {
			font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
		}
		
    </style>
    
    <title>Quattro Reports</title>
    
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url3; ?>/themes/smoothness/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url3; ?>/themes/ui.jqgrid.css" />
     
		
	<script src="<?php echo $url3; ?>/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo $url3; ?>/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="<?php echo $url3; ?>/js/jquery.jqGrid.min.js" type="text/javascript"></script>
	<script src="<?php echo $url3; ?>/js/jquery.jqChart.min.js" type="text/javascript"></script>
	<script src="<?php echo $url3; ?>/js/jquery-ui-custom.min.js" type="text/javascript"></script>
        

<!--  
	<script type="text/javascript" src="<?php //echo $url3; ?>/jsDatePick.jquery.min.1.3.js"></script>
	<script type="text/javascript" src="<?php //echo $url3; ?>/script.js"></script>
-->
		
<link rel="stylesheet" href="<?php echo $url3; ?>/style.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $url3; ?>/grid.css" type="text/css" />
<!--  
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $url3; ?>/jsDatePick_ltr.min.css" />
-->

<style type="text/css">
.ui-jqgrid-htable th{
    background: #BD0000 repeat-x !important;
    color: #ffffff !important;
    font-weight: bold !important;

}

</style>

</head>
<body>
<div id="testgrid" align="left">	

<?php 
if(isset($_REQUEST['year'])){
	$combine1="";
    $year1=$_REQUEST['year'];
    $category1=explode("_",$_REQUEST['categs']);

    $relatedid1=implode(",",$category1);
    $locationid1=$_REQUEST['locid'];
    $comb1=$_REQUEST['comb'];

	$_SESSION['relate']= $relatedid1;

	include "pmsrep_grid.php";
}
?>

</div>

</body>
</html>


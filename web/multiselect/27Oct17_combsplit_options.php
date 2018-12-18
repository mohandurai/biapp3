<?php
ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');
error_reporting(1);
$menuids = str_replace("_",",",$_REQUEST['menuids']);
$opt5 = $_REQUEST['combsp'];
//echo $menuids;
//exit;
if($opt5=="C") { $aaa = "0"; } else if($opt5=="S") { $aaa = "1"; } else { $aaa = "2"; } 

include_once("db.php");

$conn3 = mysqli_connect($host, $username, $password) or die(mysqli_error());  
$db = mysqli_select_db($conn3, $dbname) or die (mysqli_error());  
if ($conn3->connect_error) {
    die("Connection failed: " . $conn3->connect_error);
} 

$qry1 = "SELECT tblid, levelid FROM `bi_menus` WHERE `id` IN (".$menuids.")";
$res1 = mysqli_query($conn3,$qry1) or die(mysqli_error($conn3));

while($row1 = $res1->fetch_assoc()) 
{
   $tblid = $row1['tblid'];
   $levelid = $row1['levelid'];
}

if($opt5=="C") { 
	$qry2 = "SELECT refid, label, ischild FROM `split_combine_view` WHERE `level_id` = $levelid and stat = 'A' and flag = 'C' and ischild != 'Y' ORDER BY order_fld"; 
} else if($opt5=="S") { 
	$qry2 = "SELECT refid, label, ischild FROM `split_combine_view` WHERE `level_id` = $levelid and stat = 'A' and flag = 'S' and ischild = 'Y' ORDER BY order_fld"; 
} else { $qry2 = ""; } 


$res2 = mysqli_query($conn3,$qry2) or die(mysqli_error($conn3));

$str2a = "";

while($row2 = $res2->fetch_assoc()) 
{

   	  $str2a .= '<span class="ccc'.$row2['refid'].'"><input type="radio" value="'.$aaa.'~~'.$row2['refid'].'~~'.$tblid . '~~'. $row2['ischild'] .'" name="combinesel" /> ' . $row2['label'] .  ' </span>';

}
echo $str2a;
//echo $qry3;
exit;
?>

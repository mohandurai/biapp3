<?php
ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');
error_reporting(1);
$mid = str_replace("_",",",$_REQUEST['mids']);

include_once("db.php");

$conn3 = mysqli_connect($host, $username, $password) or die(mysqli_error());  
$db = mysqli_select_db($conn3, $dbname) or die (mysqli_error());  
if ($conn3->connect_error) {
    die("Connection failed: " . $conn3->connect_error);
} 

$qry1 = "SELECT refid, label FROM `split_combine_view` WHERE stat = 'A' AND flag = 'S' AND `parent_id` = ". $mid . " ORDER BY order_fld";
$res1 = mysqli_query($conn3,$qry1) or die(mysqli_error($conn3));

$str2a = "";
while($row1 = $res1->fetch_assoc()) 
{
   $str2a .= '<span style="color: red; margin-left: 20px; margin-bottom: 4px;"><input type="radio" value="1~~'.$row1['refid'].'" name="qqqq" /> ' . $row1['label'] .  ' </span>';
}

echo $str2a;
exit;
?>

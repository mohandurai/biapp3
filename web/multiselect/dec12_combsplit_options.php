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

$qry1 = "SELECT category, level, parent_id, tblid, levelid, tblrowid FROM `bi_menus_newch_12_dec_2017` WHERE `id` IN (".$menuids.") ";
//echo $qry1;
//exit;
$res1 = mysqli_query($conn3,$qry1) or die(mysqli_error($conn3));

$tblrowid = "";
$tblid = "";
while($row1 = $res1->fetch_assoc()) 
{
  
  if($row1['category']==1) {
    $tblid .= $row1['tblid']."_"; 
  } else {
    $tblid = $row1['tblid'];
  }
   
   $levelid = $row1['levelid'];
   $tblrowid .= $row1['tblrowid']."_";
   $mktsale = $row1['category'];
   $prntid = $row1['parent_id'];
}


// if($mktsale==1) {   ////////////// This block for Marketing Potential Category

//     //echo "MktPot " . $row1['level'] ;  exit; 

// //echo " <<<==== " . $tblid . " <<<==== " . $tblrowid . "</br>";
// //exit;

//     $qry1a = "SELECT levelid FROM `bi_menus_newch_12_dec_2017` WHERE `id` =".$prntid;
// // echo $qry1a;
// // exit;
//       $res1a = mysqli_query($conn3,$qry1a) or die(mysqli_error($conn3));

//       while($row1a = $res1a->fetch_assoc()) 
//       {
//           $levelid = $row1a['levelid'];
//       }

//       $qry1b = "SELECT refid, label FROM `split_combine_view` WHERE `level_id` = ". $levelid . " and flag = '".$opt5."' and ischild='Y'";
//       //echo $qry1b;
//       //exit; 
//       $res1b = mysqli_query($conn3,$qry1b) or die(mysqli_error($conn3));

//       $str2a = "";

//       while($row1b = $res1b->fetch_assoc()) 
//       {
//           $str2a .= "<div>";

//           $str2a .= '<input type="radio" name="level0" value="'.$aaa.'~~'.$row1b['refid'].'~~Q~~X" /> <label>' . $row1b['label'] . '</label></br>';

//               $qry2c = "SELECT refid, label FROM `split_combine_view` WHERE `level_id` = ". $levelid . " and flag = '".$opt5."' and ischild='N' ORDER BY order_fld"; 
            
//             //echo $levelid . " <<<==== " . $tblid . " <<<==== " . $tblrowid . "</br>";
//             //exit;
            
//             $res2c = mysqli_query($conn3,$qry2c) or die(mysqli_error($conn3));

//                 $str2a .= "<div class='sub1'>";

//                 while($row2c = $res2c->fetch_assoc()) 
//                 {
//                   $str2a .= '<div><input type="radio" name="level1" value="'.$aaa.'~~'.$row2c['refid'].'~~'.$tblid.'~~N~~'.substr($tblrowid,0,-1).'" /> <label>'.$row2c['label'].'</label></div>';
//                 }

//             $str2a .= "</div>";
         
//       }

//       echo $str2a;
//       exit;

// } 

// else {  ////////////// This block for Sales Category

  
  $qry2 = "SELECT refid, label,level_id, ischild FROM `split_combine_view` WHERE `level_id` = '".$levelid."'  and stat = 'A' and flag = '".$opt5."' and ischild = 'Y' ORDER BY order_fld"; 

//echo $qry2;
//exit;

  $res2 = mysqli_query($conn3,$qry2) or die(mysqli_error($conn3));

  $str2a = "";
                                  
  while($row2 = $res2->fetch_assoc()) 
  {

  $str2a .= "<div>";

  		$str2a .= '<input type="radio" name="level0" value="'.$aaa.'~~'.$row2['refid'].'~~'.$tblid . '~~'. $levelid .  '~~'. $row2['ischild'] .'" /> <label>'.$row2['label'].'</label></br>';

     	   $qry3 = "SELECT refid, label, level_id,ischild FROM `split_combine_view` WHERE parent_id = ". $row2['refid'] ." and `level_id` =
        '".$levelid."'  and stat = 'A' and flag = '".$opt5."' and ischild='N' ORDER BY order_fld";
          //echo $qry3;
          //exit;
     	   $res3 = mysqli_query($conn3,$qry3) or die(mysqli_error($conn3));

  		    $str2a .= "<div class='sub1'>";

          while($row3 = $res3->fetch_assoc()) 
        	{
           	$str2a .= '<div><input type="radio" name="level1" value="'.$aaa.'~~'.$row3['refid'].'~~'.$tblid . '~~'. $levelid . '~~'.$row3['ischild'] .'~~'. substr($tblrowid,0,-1) .'" /> <label>'.$row3['label'].'</label></div>';
        	}
  		

  	$str2a .= "</div>";
  }
  $str2a .= "</div>";
  echo $str2a;
  /*
  echo $qry1;
  "</br>";
  echo $qry2;
  */
  exit;

// }


?>


<?php

//echo "Inside the create temp Table ........";
//exit;

include_once("db2.php");

//echo $host." <<<=== ".$username." <<<=== ".$password." <<<=== ". $dbname;
//exit;

$conn3 = mysqli_connect($host, $username, $password) or die(mysqli_error());  
$db = mysqli_select_db($conn3, $dbname) or die (mysqli_error());  
if ($conn3->connect_error) {
    die("Connection failed: " . $conn3->connect_error);
} 

$qry1 = "CREATE TEMPORARY TABLE mktpotential (loc5 INT NOT NULL, loc7 INT NOT NULL, related_menu_id INT NOT NULL, 
ccp_name VARCHAR(100) NOT NULL, address VARCHAR(250) NOT NULL, latitude VARCHAR(100) NOT NULL, longitude VARCHAR(100) NOT NULL, 
loc15 INT NOT NULL, refid VARCHAR(100) NOT NULL, stat VARCHAR(1) NOT NULL)";
echo $res1 = mysqli_query($conn3,$qry1) or die(mysqli_error($conn3));


if(mysqli_error()) {
  echo "AAAAAAAAA Error: " . mysql_error();
}

$menus = str_replace("_",",",$_REQUEST['categs']);

$qry2 = "INSERT INTO mktpotential
SELECT loc5, loc7, related_menu_id, ccp_name, address, latitude, longitude, loc15, refid, stat FROM area_life_style_indicator_final
WHERE related_menu_id IN (".$menus.")";
echo $res2 = mysqli_query($conn3,$qry2) or die(mysqli_error($conn3));

if(mysqli_error()) {
  echo "BBBBBBBBBBB Error: " . mysql_error();
}

$sql = "select * from mktpotential limit 10";
$result = $conn3->query($sql);
while($row = $result->fetch_assoc()) {
	echo $row['loc5'] ." <<<=== ".$row['related_menu_id']." <<<=== ".$row['address']."</br>";
}

//echo "</br></br></br>";
//echo $qry1 . "</br></br></br>" . $qry2;
//exit;

?>
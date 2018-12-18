<?php	
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(0);

//$connection = mysql_connect("localhost", "kores_audineev2", "rew@2016"); // Establishing Connection with Server
//$db = mysql_select_db("kores_neev2", $connection); // Selecting Database

$filename = "../config/db2.php";		
		
// Open the file		
$fp = @fopen($filename, 'r');

// Add each line to an array		
if ($fp) {		
   $array = explode("\n", fread($fp, filesize($filename)));		
	foreach($array as $items)	
	{	
		if(strpos($items,"dsn")!== false){
	    	//echo "found" . "</br>";
	    	$itm = str_replace("'","", $items);
	    	$itm = str_replace(",","", $itm);
	    	list($p1, $p2) = explode(";", $itm);
	    	list($p1, $host) = explode("host=", $p1);
	    	list($p1, $dbname) = explode("dbname=", $p2);
	    	//echo $dbase . " <<== " . $dbname . "</br>";
	    	$host = trim($host);
	    	$dbname = trim($dbname);
	    	//exit;
	  	}
		
	  	if(strpos($items,"'username'")!== false){
	    	//echo "found" . "</br>";
	    	$itm = str_replace("'","", $items);
	    	$itm = str_replace(",","", $itm);
	    	list($p1, $p2) = explode("=>", $itm);
	    	//echo $p1 . " <<== " . $p2 . "</br>";
	    	$username = trim($p2);
	    	//exit;
	  	}
		
	  	if(strpos($items,"'password'")!== false){
	    	//echo "found" . "</br>";
	    	$itm = str_replace("'","", $items);
	    	$itm = str_replace(",","", $itm);
	    	list($p1, $p2) = explode("=>", $itm);
	    	//echo $p1 . " <<== " . $p2 . "</br>";
	    	$password = trim($p2);
	    	//exit;
	  	}
	}	
}		
		
//$host = "localhost";		
//$username = "root";		
//$password = "";		
//$dbname = "pms";		
		
//echo $host . " <<== " . $dbname . " <<== " . $username  . " <<== " . $password;		
//exit;		

		
	$con = mysqli_connect($host, $username, $password) or die(mysqli_error()); 	
	$db = mysqli_select_db($con, $dbname) or die (mysqli_error());	



?>

<?php	

 //$connection = mysql_connect("localhost", "kores_audineev2", "rew@2016"); // Establishing Connection with Server
//$db = mysql_select_db("kores_neev2", $connection); // Selecting Database
	

$filename = "config/db.php";		
		
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
//$password = "root";		
//$dbname = "cssgen";		
		
//echo $host . " <<== " . $dbname . " <<== " . $username  . " <<== " . $password;		
//exit;		
		
	$con = mysql_connect($host, $username, $password) or die(mysql_error()); 	
	$db = mysql_select_db($dbname,$con) or die (mysql_error());	


//  $connection = mysql_connect("localhost", "kores_audineev", "rew@2016!"); // Establishing Connection with Server
//  $db = mysql_select_db("kores_audineev", $connection); // Selecting Database

?>

<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "test2";

//echo $host . " <<== " . $dbname . " <<== " . $username  . " <<== " . $password;
//exit;
	
	$con = mysqli_connect($host, $username, $password) or die(mysqli_error()); 
	$res = mysqli_select_db($con,$dbname) or die (mysqli_error());


define('DB_DSN','mysql:host='.$host.';dbname='.$dbname);
define('DB_USER', $username);     // Your MySQL username
define('DB_PASSWORD', $password); // ...and password

define('ABSPATH', dirname(__FILE__).'/');

$conn = mysqli_connect($host,$username,$password);
$con=mysqli_select_db($conn,$dbname);
//require_once(ABSPATH.'tabs.php');
?>
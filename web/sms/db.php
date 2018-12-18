<?php
$server1 = "localhost"; //Your MySQL Server
$user1 = "tuneem_cigna"; //Your MySQL username
$pass1 = "rew@2015!"; //Password
$dbname1 = "tuneem_cigna";
$conn1 = mysql_connect($server1, $user1, $pass1) or die(mysql_error()); //Connect to ther serve
$db1 = mysql_select_db($dbname1, $conn1) or die(mysql_error()); //Select the database

// Using Class Functions

define("HOST","localhost");
define("MYSQL_USER", "tuneem_cigna");
define("PASSWORD", "rew@2015!");
define("MYSQL_DB","tuneem_cigna");

class database{
	function database(){
		mysql_connect(HOST,MYSQL_USER, PASSWORD) or die(mysql_error());
		mysql_select_db(MYSQL_DB) or die(mysql_error());
	}
}

$dynaurl3 = "http://www.tuneem.com/cigna/";

?>
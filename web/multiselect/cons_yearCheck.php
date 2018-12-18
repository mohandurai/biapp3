<?php

if( isset( $_REQUEST['year'] ) )
{

$period = $_REQUEST['year'];
//$host = 'http://192.168.10.82/phpmyadmin/';
$host = '192.168.10.82';
$user = 'root';
$pass = '1111';
$db_con=mysql_connect($host, $user, $pass);

$selected = mysql_select_db("biweb_mktgpot",$db_con) ;

 for($i=0;$i<count($period);$i++)
  {
   $year="p".$period[$i];
   $year=trim($year,",");
  }
  $selectdata ="select  PARTITION_NAME from information_schema.partitions WHERE TABLE_SCHEMA='biweb_mktgpot' AND TABLE_NAME = 'category_consumption_final' AND PARTITION_NAME='".$year."'";

$query = mysql_query($selectdata);
//var_dump($query);
$i=0; $r=array();

while($row = mysql_fetch_array($query))
{
	
 $r[$i]= $row['PARTITION_NAME'];
$i++;
}
echo json_encode($r);
 if(count($r)==0 )
   {
                    
  echo "data not available for selected year,please chose valid year!!!!!!!";

   }
 }
?>
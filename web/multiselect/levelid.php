<?php
//error_reporting(-1);
if( isset( $_REQUEST['menu_id'] ) )
{

$menu_id = $_REQUEST['menu_id'];
//$host = 'http://192.168.10.82/phpmyadmin/';
$host = '192.168.10.82';
$user = 'root';
$pass = '1111';

$db_con=mysql_connect($host, $user, $pass);

$st=mysql_select_db('biweb',$db_con);

 $selectdata ="SELECT levelid FROM `bi_menus_newch_12_dec_2017` where id='".$menu_id."'";
$query = mysql_query($selectdata);

$i=0; $r=array();

while($row = mysql_fetch_array($query))
{
	
	
 $r[$i]= $row['levelid'];
$i++;
}

echo json_encode($r);
}
?>
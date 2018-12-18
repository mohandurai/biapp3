<?php
require_once "db.php";
$rid = $_REQUEST['id'];
 $deid = $_REQUEST['did'];

$today = date("Y-m-d");  
$date = strtotime($today);
$logid = @Yii::$app->user->identity->id; 
 
if(isset($deid)){
	  $deletesql="update user set status='InActive' where id='$deid'";

                mysql_query($deletesql); 

 $rejoinsql="insert into rejoin_user(id, created_by, created_date) values('$deid','$logid','$today')";
                 mysql_query($rejoinsql);

}
if(isset($rid)){
	$rejoined = "update rejoin_user set status='Rejoined',reassign_by='$logid',reassign_date='$today' where id='$rid'";
 mysql_query($rejoined);
	$participant = "update user set status='Active' where id='$rid'";
 if(mysql_query($participant));
}
header('Location: https://biweb.com/sandbox/web/index.php?r=user/index');
?>

<?php
   require_once 'GCM.php';
   require_once 'db.php';
    
   $gcm = new GCM();
   
$sql = "select 'KB Test' as title, 'Test User' as name, device_key
from employee_master where emp_id=55";

$res = mysql_query($sql);
while($row = mysql_fetch_assoc($res))
{

/*while(ob_get_level() > 0) 
ob_end_flush();*/

  $msg = 'Dear '.$row['name'].' You have new '.$row['title'].' Reinforcement more details login to Royce Seed App';
     // $msg = "TS";
   $registatoin_ids = array($row['device_key']);
   $message = array("price" => $msg);
   
   /*print_r($registatoin_ids);
   print_r($message);   
   echo '<br><br>';*/
   
   echo $msg;
   
//$sql2 = "update reinforcement_question_score set delivered_status=1 where re_id='".$row['re_id']."' and emp_id='".$row['emp_id']."'";
//$res2 = mysql_query($sql2);

   $result = $gcm->send_notification($registatoin_ids, $message);
   echo $result;
}
?>

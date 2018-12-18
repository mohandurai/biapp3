<?php
   require_once 'GCM.php';
   require_once 'db.php';
    
   $gcm = new GCM();
   
$sql = "select a.class_id, a.class_name as title, b.emp_id, concat(c.first_name,' ',c. last_name) as name, c.device_key
from training_class a,training_participant b,employee_master c
where a.class_id=b.class_id and b.emp_id=c.emp_id and b.delivered_status=0 and c.device_key is not null
group by a.class_id,b.emp_id limit 10";

$res = mysql_query($sql);
while($row = mysql_fetch_assoc($res))
{

while(ob_get_level() > 0) 
ob_end_flush();

   $msg = 'Dear '.$row['name'].' You have new '.$row['title'].' Training class more details login to Royce Seed App';
   $registatoin_ids = array($row['device_key']);
   $message = array("price" => $msg);
   
   /*print_r($registatoin_ids);
   print_r($message);   
   echo '<br><br>';*/
   
   echo $msg;
   
$sql2 = "update training_participant set delivered_status=1 where class_id='".$row['class_id']."' and emp_id='".$row['emp_id']."'";
$res2 = mysql_query($sql2);

   $result = $gcm->send_notification($registatoin_ids, $message);
   echo $result;
}
?>
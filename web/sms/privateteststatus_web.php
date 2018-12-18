<?
require_once "db.php";
session_start();

function coursedetails($course_id)
{
	
	
	$sql1 = "SELECT private_mark FROM Course_assion where course_id='".$course_id."'";
	$res = mysql_query($sql1);
	
	
	//$row = mysql_fetch_object($res);
	//$row = mysql_fetch_assoc($res);
	//$nrw = mysql_num_rows($res);


   while($row = mysql_fetch_object($res))
    {

       // $data = array('userid'=>$row['employee_id'],'akey'=>$akey,'name'=>$row['name'],'mobile'=>$row['mobile'],'emp_code'=>$row['emp_code']);
	//$result[] = '{'.'userid:'.$row['employee_id'].',akey:'.$akey.'}';
	$result[] = $row;
	
	}
	$response1 = json_encode($result);
    return $response1;
}

?>
<?
require_once "db.php";
session_start();
function coursedetails($empid,$status)
{

	$sql2= "SELECT employee_id,email FROM users where email='".$empid."'";
	$res1 = mysql_query($sql2);
while($row1 = mysql_fetch_array($res1))
{
     $employee_id1= $row1['employee_id'];
}

if($status=='Assigned')
{

	$sql1 = "SELECT a.course_id,a.course_name,a.affected_date,a.process_status,b.folder_id,b.folder_name FROM Course_assion as a inner join tam_xerte_folderdetails as b where b.folder_id=a.course_name and a.empassigned_id='".$employee_id1."' and a.process_status='".$status."' and a.affected_date <= '".date("Y-m-d")."' order by a.affected_date asc";
	$res = mysql_query($sql1);


   while($row = mysql_fetch_object($res))
    {

       // $data = array('userid'=>$row['employee_id'],'akey'=>$akey,'name'=>$row['name'],'mobile'=>$row['mobile'],'emp_code'=>$row['emp_code']);
	//$result[] = '{'.'userid:'.$row['employee_id'].',akey:'.$akey.'}';
	$result[] = $row;
	
	}
	
	}else
	{
	
	
	$sql1 = "SELECT a.course_id,a.course_name,a.affected_date,a.process_status,b.folder_id,b.folder_name FROM Course_assion as a inner join tam_xerte_folderdetails as b where b.folder_id=a.course_name and a.empassigned_id='".$employee_id1."' and a.process_status='completed' and a.affected_date <= '".date("Y-m-d")."' order by a.affected_date desc";
	$res = mysql_query($sql1);


   while($row = mysql_fetch_object($res))
    {

       // $data = array('userid'=>$row['employee_id'],'akey'=>$akey,'name'=>$row['name'],'mobile'=>$row['mobile'],'emp_code'=>$row['emp_code']);
	//$result[] = '{'.'userid:'.$row['employee_id'].',akey:'.$akey.'}';
	$result[] = $row;
	
	}
	
	
	}
	
	
	$response1 = json_encode($result);
    return $response1;
}

?>
<?
require_once "db.php";
session_start();

function coursedetails($type)
{
	
	if($type=='private')
	{
	$sql1 = "SELECT folder_id,folder_name FROM tam_xerte_folderdetails where access='private' or access='public'";
	$res = mysql_query($sql1);
	}else
	{
	$sql1 = "SELECT folder_id,folder_name FROM tam_xerte_folderdetails where access='public'";
	$res = mysql_query($sql1);
	
	}
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
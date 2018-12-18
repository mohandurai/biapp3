<?
require_once "db.php";
session_start();

function coursedetails()
{
	
	
	
	$sql1 = "SELECT folder_id,folder_name FROM tam_xerte_folderdetails where access='public' ORDER BY `folder_id` ASC ";
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

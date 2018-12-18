<?
require_once "db.php";
session_start();

function coursedetails($empid,$status)
{


		
 
	/*	

 $con12=mysqli_connect("localhost","tuneem93_seed","seed123","tuneem93_seed");
			$check1="SELECT user_id FROM tam_xerte_scores WHERE user_id='".$empid."'";
			$rs1 = mysqli_query($con12,$check1);
			$data = mysqli_fetch_array($rs1, MYSQLI_NUM);
			if($data[0] > 0) {*/
			
			if($status==0)
			{
			 $sql1 = "SELECT folder_id,folder_name,user_id from (select folder_id,folder_name FROM tam_xerte_folderdetails where access='public') as a left outer join (select fid,user_id from tam_xerte_scores where user_id='".$empid."') b on a.folder_id=b.fid where user_id is null order by folder_id asc";
	$res = mysql_query($sql1);
	}
	else
	{
	 $sql1 = "SELECT folder_id,folder_name,user_id from (select folder_id,folder_name FROM tam_xerte_folderdetails where access='public') as a left outer join (select fid,user_id from tam_xerte_scores where user_id='".$empid."') b on a.folder_id=b.fid where user_id is not null order by folder_id desc";
	$res = mysql_query($sql1);
	
	}
	
			  /*
			}

			else
			{
	$sql1="SELECT folder_id,folder_name FROM tam_xerte_folderdetails WHERE access='public'";
       $res = mysql_query($sql1);   	
			}
	//$row = mysql_fetch_object($res);
	//$row = mysql_fetch_assoc($res);
	//$nrw = mysql_num_rows($res);

*/
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
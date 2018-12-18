<?
require_once "db.php";
session_start();

function coursedetails($empid,$folid)
{
	
	
	
	$sql1 = "SELECT user_id FROM tam_xerte_scores where user_id='".$empid."' and fid='".$folid."'";
	$res = mysql_query($sql1);
	//$row = mysql_fetch_object($res);
	//$row = mysql_fetch_assoc($res);
	$nrw = mysql_num_rows($res);


   if($nrw != 0)
    {

     
	$result = '[{"ststus":"yes"}]';
	
	}else
	{
	$result = '[{"ststus":"no"}]';
	}
	$response1 = $result;
    return $response1;
}

?>
<?
session_start();
require_once "db.php";
if(isset($_REQUEST['datas']))
{
$data = $_REQUEST['datas'];
	if($data=='ojt')
	{
	if($_SESSION['role_id']=='14')
	{
	$sql = "SELECT emp_id,emp_name FROM ojt_participant where ojt_id='".$_REQUEST['classid']."' and emp_id not in (SELECT distinct emp_id FROM supervisor_score where ojt_id='".$_REQUEST['classid']."')";
	}
	if($_SESSION['role_id']=='15')
	{
	$sql = "SELECT emp_id,emp_name FROM ojt_participant where ojt_id='".$_REQUEST['classid']."' and emp_id not in (SELECT distinct emp_id FROM mentor_score where ojt_id='".$_REQUEST['classid']."')";
	}
	/*$connection = Yii::app()->db;
	$command = $connection->createCommand($sql);
	$results = $command->queryAll();*/
	$res = mysql_query($sql);
	$r=0;
	echo "<select name='participant' id='participant'>";
	echo "<option value=''>-- Select --</option>";
	while($row = mysql_fetch_assoc($res))
	{
	//echo "<option value=". $results[$r]['dealership_id'] .">" . $results[$r]['dealership_name'] . "</option>";
	echo "<option value=". $row['emp_id'] .">" . $row['emp_name'] . "</option>";
	$r++;
	}
	echo "</select>";
	}
}

?>
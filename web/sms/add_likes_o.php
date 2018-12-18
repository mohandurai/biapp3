<?php
session_start();
if($_SESSION['login_id']=='')
{
    header('Location: index.php');   
}
require_once "db.php";
if(!empty($_POST["id"])) {


	switch($_POST["action"]){
		case "like":
		$emp_id = $_SESSION['emp_id'];
			//	$t_id=$_SESSION['class'];
				  $t_id=$_REQUEST['id'];
				  $sql1 = "SELECT lkid,likes FROM file_like where t_id='$t_id' and emp_id='$emp_id'";
		$res1 = mysql_query($sql1);
		$row1 = mysql_fetch_assoc($res1);
		//print_r($row1);
			if($row1==""){	
			//echo "hai";
			  $insql = "insert into file_like (t_id, emp_id, likes, created_date, modified_date,module_name) values ('$t_id','$emp_id',1,now(),now(),'offisocio')";
			$result= mysql_query($insql);
				}	
				else{
				//echo "sdfsdf";
				if($row1['likes']==1){
			$insql = "update file_like set likes='0', modified_date=now() where t_id='$t_id' and emp_id='$emp_id' and lkid='".$row1['lkid']."'";			
			}
			else{
			$insql = "update file_like set likes='1', modified_date=now() where t_id='$t_id' and emp_id='$emp_id' and lkid='".$row1['lkid']."'";			
			}
			$inres = mysql_query($insql);
				}
		break;		
		case "unlike":
		$emp_id = $_SESSION['emp_id'];
				$t_id=$_SESSION['class'];
		 $sql1 = "SELECT lkid,likes FROM file_like where t_id='$t_id' and emp_id='$emp_id'";
		$res1 = mysql_query($sql1);
		$row1 = mysql_fetch_assoc($res1);
		if($row1['likes']==1){
			$insql = "update file_like set likes='0', modified_date=now() where t_id='$t_id' and emp_id='$emp_id' and lkid='".$row1['lkid']."'";			
			}
			else{
			$insql = "update file_like set likes='1', modified_date=now() where t_id='$t_id' and emp_id='$emp_id' and lkid='".$row1['lkid']."'";			
			}
			$inres = mysql_query($insql);
		break;		
	}
}
?>
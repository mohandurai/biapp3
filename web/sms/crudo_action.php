<?php
session_start();

$_SESSION['login_id'] = 4;
$_SESSION['emp_id'] = 4;


require_once "db.php";
//print_r($_REQUEST);
 $action = $_POST["action"];
 
if(!empty($action)) { 
	switch($action) {
	
		case "add":
	//	print_r($_REQUEST);
			 $emp_id = $_SESSION['emp_id'];
			 $comment=$_REQUEST['txtmessage'];
			 $t_id=$_REQUEST['t_id'];
			 $txt=$_REQUEST['txt'];
			 $modname=$_REQUEST['modname'];
			 
			 $result = mysql_query("insert into file_comment ( t_id, emp_id, comments, created_date,module_name, block_status) values ('$t_id', '$emp_id', '$comment', now(),'$modname','0')");
			
			if($result){
				  $insert_id = mysql_insert_id();
			//	  echo "select concat('http://192.168.2.20/seed/',trim(b.profile_image_url)) as profile_com,concat(ifnull(b.first_name,''),'',ifnull(b.last_name,'')) as EmpName from file_comment a,employee_master b where a.emp_id=b.emp_id and  cmid='$insert_id'  ";
				  $res=mysql_query("select concat('http://www.tuneem.com/tuneem/web/images/',trim(b.profile_image_url)) as profile_com,concat(ifnull(b.first_name,''),'',ifnull(b.last_name,'')) as EmpName from file_comment a, user b where a.emp_id=b.id and cmid='$insert_id' ");
				 $con=mysql_fetch_row($res);
				/*  print_r($con);die; die;*/
				  $pr= $con[0];
				  $nm= $con[1];
				    $dt=date("Y-m-d h:i:s");
				    echo '<div class="cmd-part" >
<div class="image"><img style="width:40px;font-size:1em;" src="'.$pr.' "alt="" /></div>
<div class="prf-name"><span style="font-weight:bold;font-size:15px;color:#003366;">'.$nm.':</span> <span class="cmd"  id="message'.$txt.'_'.$t_id.'_'. $insert_id . '">' . $_POST["txtmessage"] . '</span><p style="font-weight:bold;color:#9197a3;font-size:10px;margin-top:5px;">'.$dt.'</p></div>


<div style="float:right;">
<button class="btnEditAction" name="edit" onClick="showEditBox(' . $insert_id . ')">Edit</button>
<button class="btnDeleteAction" name="delete" onClick="callCrudAction(\'delete\',' . $insert_id . ')">Delete</button>
</div>

</div>';
				 
				/*  echo  '<span style="border:1px solid #bcbcbc;"><img style="width:60px; margin-top:10px;" src="'.$pr.' "/>'.$nm.'</span><div class="message-box"  id="message'.$txt.'_'.$t_id.'_'. $insert_id . '">
						<div>
						<button class="btnEditAction" name="edit" onClick="showEditBox(' . $insert_id . ')">Edit</button>
<button class="btnDeleteAction" name="delete" onClick="callCrudAction(\'delete\',' . $insert_id . ')">Delete</button>
						</div>
						<div class="message-content'.$txt.'">' . $_POST["txtmessage"] . '</div></div>';*/
						
			}
			break;
			
		case "edit":
	//	echo "UPDATE file_comment set comments = '".$_POST["txtmessage"]."' and  modified_date='now()'  WHERE  cmid=".$_POST["message_id"];
			$result = mysql_query("UPDATE file_comment set comments = '".$_POST["txtmessage"]."',modified_date=now()  WHERE  cmid=".$_POST["message_id"]);
			if($result){
				  echo $_POST["txtmessage"];
			}
			break;			
		
		case "delete": 
			if(!empty($_POST["message_id"])) {
				mysql_query("DELETE FROM file_comment WHERE cmid=".$_POST["message_id"]);
			}
			break;
			
			case "like":
				$emp_id = $_SESSION['emp_id'];
				$t_id=$_SESSION['class'];
			$sql1 = "SELECT lkid FROM file_like where t_id='$t_id' and emp_id='$emp_id'";
		$res1 = mysql_query($sql1);
		$row1 = mysql_fetch_assoc($res1);
		$nrw = mysql_num_rows($res1);	
		
		
		if($nrw == 0)
		{
			$insql = "insert into file_like (t_id, emp_id, likes, created_date, modified_date,module_name) values ('$re_id','$userid',1,now(),now(),'offisocio')";
			$inres = mysql_query($insql);
		}
		else
		{
			$insql = "update file_like set likes='0', modified_date=now() where t_id='$t_id' and emp_id='$emp_id' and lkid='".$row1['lkid']."'";
			$inres = mysql_query($insql);
		}
		
		$sqq="SELECT t_id,sum(likes) as total FROM file_like where t_id='".$_REQUEST['class']."' group by t_id";
		$cc=mysql_query($sqq);
		$ccrow = mysql_fetch_assoc($cc);
		echo "hai";
			break;		
	}
}
?>
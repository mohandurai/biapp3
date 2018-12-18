<script src="dashboard/js/jquery.js" type="text/javascript"></script>
<link href="sms/css/slickQuiz.css" media="screen" rel="stylesheet" type="text/css">
<style type="text/css">
.imgpo{
margin-top:-18px;
margin-left:-32px;
}

 #dvLoading {
background:url(sms/loading-bar.GIF) no-repeat center center;
height: 100px;
width: 360px;
position: fixed;
left: 40%;
top: 50%;
margin: -25px 0 0 -25px;
z-index: 1000;
}
.quest
{
font-size:16px !important;
padding: 10px 0 !important;
}


.button {
	display: inline-block;
	zoom: 1; /* zoom and *display = ie7 hack for display:inline-block */
	*display: inline;
	vertical-align: baseline;
	margin: 0 2px;
	outline: none;
	cursor: pointer;
	text-align: center;
	text-decoration: none;
	font: 14px/100% Arial, Helvetica, sans-serif;
	padding: .5em 1.5em .55em;
	text-shadow: 0 1px 1px rgba(0,0,0,.3);
	-webkit-border-radius: .5em; 
	-moz-border-radius: .5em;
	border-radius: .5em;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
	box-shadow: 0 1px 2px rgba(0,0,0,.2);
}
.button:hover {
	text-decoration: none;
}
.button:active {
	position: relative;
	top: 1px;
}
/* gray */
.gray {
	color: #e9e9e9;
	border: solid 1px #555;
	background: #6e6e6e;
	background: -webkit-gradient(linear, left top, left bottom, from(#888), to(#575757));
	background: -moz-linear-gradient(top,  #888,  #575757);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#888888', endColorstr='#575757');
}
.gray:hover {
	background: #616161;
	background: -webkit-gradient(linear, left top, left bottom, from(#757575), to(#4b4b4b));
	background: -moz-linear-gradient(top,  #757575,  #4b4b4b);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#757575', endColorstr='#4b4b4b');
}
.gray:active {
	color: #afafaf;
	background: -webkit-gradient(linear, left top, left bottom, from(#575757), to(#888));
	background: -moz-linear-gradient(top,  #575757,  #888);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#575757', endColorstr='#888888');
}
.pink {
	color: #feeef5;
	border: solid 1px #FF3366;
	background: #FF3366;
	background: -webkit-gradient(linear, left top, left bottom, from(#FF3366), to(#f171ab));
	background: -moz-linear-gradient(top,  #FF3366,  #f171ab);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#FF3366', endColorstr='#f171ab');
}
.pink:hover {
	background: #FF0066;
	background: -webkit-gradient(linear, left top, left bottom, from(#FF0066), to(#e86ca4));
	background: -moz-linear-gradient(top,  #FF0066,  #e86ca4);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#FF0066', endColorstr='#e86ca4');
}
.pink:active {
	color: #f3c3d9;
	background: -webkit-gradient(linear, left top, left bottom, from(#f171ab), to(#feb1d3));
	background: -moz-linear-gradient(top,  #f171ab,  #feb1d3);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#f171ab', endColorstr='#feb1d3');
}

</style>
<?php
if($_SESSION['login_id']=='')
{
    header('Location: index.php');   
}
require_once "db.php";
/*$server1 = "localhost"; //Your MySQL Server
$user1 = "root"; //Your MySQL username
$pass1 = ""; //Password
$dbname1 = "rsalesar_seed2";
$conn1 = mysql_connect($server1, $user1, $pass1) or die(mysql_error()); //Connect to ther serve
$db1 = mysql_select_db($dbname1, $conn1) or die(mysql_error()); //Select the database*/

if($_REQUEST['submit']=="Submit")
{
	$z=0;
	$quiz = $_REQUEST['question_id'];
	while(count($quiz)>$z)
	{
	$id = 'question-'.$quiz[$z];
	$question_id = $quiz[$z];
	$ansarr =  $_REQUEST[$id][0];
	//print_r($ansarr);
	//$ansarr4 =  $_REQUEST[$id];
	$classid =  $_REQUEST['class_ids'];
	$empid = $_SESSION['emp_id'];
	$participant = $_REQUEST['participant'];
	if($_SESSION['role_id']=='14')
	{
		$sql = "insert into supervisor_score (question_id, emp_id, attempt, remark, time, ojt_id, supervisor_id) values ('$question_id','$participant', '1', '$ansarr', now(), '$classid', '$empid')";
		$res = mysql_query($sql);
	}
	if($_SESSION['role_id']=='15')
	{
		$sql = "insert into mentor_score (question_id, emp_id, attempt, remark, time, ojt_id, mentor_id) values ('$question_id','$participant','1', '$ansarr', now(), '$classid', '$empid')";
		$res = mysql_query($sql);
	}
	
	$z++;
	}
echo "<div align='center' style='color:#E43B78; font-weight:bold;'>Scores Saved Successfully.......</div>";
echo "<meta http-equiv='refresh' content='2;url=".$_SERVER['REQUEST_URI']."'>";
}

date_default_timezone_set('GMT');
$temp= strtotime("+5 hours 30 minutes"); 
$date = date("Y-m-d H:i:s",$temp);
$com_date = date("Y-m-d");
$emp_id = $_SESSION['emp_id'];


$valid_sql = "select a.ojt_id,a.ojt_name,a.start_date,a.end_date from ojt_training a,supervisor_master b where
a.supervisor_id=b.supervisor_id  and (b.emp_id='".$_SESSION['emp_code']."')
and a.start_date<=date(now()) and a.end_date>=date(now()) group by a.ojt_id";

$valid_res = mysql_query($valid_sql);

/*while($valid_row = mysql_fetch_assoc($valid_res))
{
$class[] = $valid_row['class_id'];
$percent[] = $valid_row['class_name'];
$status[] = $valid_row['status'];
}

//print_r($class);
print_r($status);*/


?>
<script type="text/javascript">




function get_participant(id)
{
$(document).ready(function() {
//alert(id);
var classid = $("#class").val();
       $.get("sms/ajax.php",{datas:'ojt',classid:classid},function(selecting)
		{
		//alert(selecting);
		//setTimeout(function(){},1000);
		$("#participant").html(selecting);
		});
  });
}


$(document).ready(function() {

$("#submitbtn").click(function() {
  var classid = $("#class").val();
   var participant = $("#participant").val();
  //alert(classid);
  if(classid=='')
  {
   alert("Please Choose The Ojt Training");
   document.getElementById("class_select").style.display = '';
   document.getElementById("question_select").value.style.display = 'none';
   return false;
  }
  if(participant=='')
  {
   alert("Please Select The Participant");
   document.getElementById("class_select").style.display = '';
   document.getElementById("question_select").value.style.display = 'none';
   return false;
  }
  if(classid!='' && participant!='')
  {
   document.getElementById("class_select").style.display = 'none';
   document.getElementById("dvLoading").style.display = '';
   //$("#question_select").load("sms/question.php", {classid:classid});
   $.get("sms/ojtquestion.php",{classid:classid,participant:participant},function(selecting)
		{
		//alert(selecting);
		//setTimeout(function(){},1000);
		$("#question_select").html(selecting);
		});
    document.getElementById("question_select").style.display = '';
  }
  
  return true;
  
  /*else
  {
   alert("Please Choose The Ojt Training");
   document.getElementById("class_select").style.display = '';
   document.getElementById("question_select").value.style.display = 'none';
  }*/
});
});
</script>
<div id="class_select">
<? //echo "<div align='center' style='color:#E43B78; font-weight:bold;'>Scores Saved Successfully.......</div>";?>
<table align="center" cellpadding="6" cellspacing="6">
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td>Select Ojt Training :</td>
<td>
<select id="class" name="class" style="width:250px;" onchange="get_participant(this.value);">
<option value="">-- Select --</option>
<? while($valid_row = mysql_fetch_assoc($valid_res))
{ ?>
<option value="<?=$valid_row['ojt_id']?>"><?=$valid_row['ojt_name']?></option>
<? }?>
</select>
</td>
</tr>
<tr>
<td>Select Participant :</td>
<td>
<select id="participant" name="participant" style="width:250px;">
<option value="">-- Select --</option>
</select>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td colspan="2" align="center"><input class="button pink" type="button" name="submitbtn" id="submitbtn" value="submit"></td>
</tr>
</table>
</div>
<div id="dvLoading" style="display:none;" align="center"></div>
<div id="question_select" style="display:none;">
</div>


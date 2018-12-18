<script src="dashboard/js/jquery.js" type="text/javascript"></script>
<link href="sms/css/slickQuiz.css" media="screen" rel="stylesheet" type="text/css">

<meta http-equiv="X-UA-Compatible" content="IE=7" />
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
	$ansarr =  $_REQUEST[$id];
	$ansarr4 =  $_REQUEST[$id];
	$re_id =  $_REQUEST['re_id'];
	$empid = $_SESSION['emp_id'];
	//print_r($ansarr);
	$num_ans = $_REQUEST['num_ans'][$z];
	if(count($ansarr)==0)
	{
	$ansarr = array(0);
	}
	//echo implode(',',$ansarr);
	$newarr =  implode(",",$ansarr);
	
	$sql="select m.maximum_att,m.marks,m.re_id,m.req_id,concat(m.re_id,'_',m1.file_location) as file_name from reinforcement_question m,
reinforcement_question_score s,reinforcement_master m1 where m.req_id=s.req_id and m1.re_id=m.re_id and m.req_id='$question_id'";
	$res = mysql_query($sql);
	$rt=mysql_fetch_assoc($res);
	
	$mark = $rt['marks'];
    $sql12="select m.marks from reinforcement_question m,reinforcement_question_score s where m.req_id=s.req_id and m.req_id='$question_id'
and m.correct_answer='".$newarr."'";
	$res12 = mysql_query($sql12);
	$rt12=mysql_fetch_assoc($res12);
	//$mark12 = $rt12['marks'];
	if(mysql_num_rows($res12)!=0)
	{
	$mark12 = $rt12['marks'];
	}
	else
	{
	$mark12 = 0;
	}	

    $sms_score = "select maximum_att,response from reinforcement_question_score where req_id='$question_id' and emp_id='$empid'";
	$sms_res = mysql_query($sms_score);
	$sms_ass = mysql_fetch_assoc($sms_res);
	//echo $sms_ass['question_id'].'=====>';
	
		$attempt = $sms_ass['maximum_att']+1;
		$emp="update reinforcement_question_score set response = '".$newarr."',marks ='$mark12' ,maximum_att = '1' where 
		req_id = '$question_id' and  emp_id = '$empid'";
		$empres = mysql_query($emp);

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


 $valid_sql = "select a.re_id,a.title,a.tag from reinforcement_master a,reinforcement_question_score b
where a.re_id=b.re_id and a.file_transfer_mode='GPRS' and b.emp_id='$emp_id' and b.maximum_att=0
and b.re_id not in (select re_id from reinforcement_question_score
where emp_id='$emp_id' and maximum_att>0 group by re_id,emp_id) group by a.re_id";

$valid_res = mysql_query($valid_sql);

?>
<script type="text/javascript">

$(document).ready(function() {
$("#submitbtn").click(function() {
  var classid = $("#class").val();
  //alert(classid);
  if(classid!='')
  {
   document.getElementById("class_select").style.display = 'none';
   document.getElementById("dvLoading").style.display = '';
   document.getElementById("question_select").style.display = 'none';
   document.getElementById("reinforce_select").style.display = '';
   $("#question_select").html('1');
   $.get("sms/reinforcekb.php",{classid:classid},function(selecting)
		{
		$("#reinforce_select").html(selecting);
		});
		
  }
  else
  {
   alert("Please Choose The Reinforcement");
   document.getElementById("class_select").style.display = '';
   document.getElementById("reinforce_select").style.display = 'none';
   document.getElementById("question_select").style.display = 'none';
  }
});
});

function gotoquiz(val)
{
//alert(val);
$(document).ready(function() {
if(val!='')
  {
   document.getElementById("dvLoading").style.display = '';
  $("#reinforce_select").html('1');
$.get("sms/reinforcequestion.php",{classid:val},function(selecting)
		{
		$("#question_select").html(selecting);
		 document.getElementById("dvLoading").style.display = 'none';
		});
    document.getElementById("question_select").style.display = '';
	document.getElementById("reinforce_select").style.display = 'none';
  }
  else
  {
   alert("Please Choose The Reinforcement");
   document.getElementById("class_select").style.display = '';
   document.getElementById("reinforce_select").style.display = 'none';
   document.getElementById("question_select").style.display = 'none';
  }
});
}

</script>

<script src='sms/js/pdf.js'></script>
<div id="class_select">
<? //echo "<div align='center' style='color:#E43B78; font-weight:bold;'>Scores Saved Successfully.......</div>";?>
<table align="center" cellpadding="6" cellspacing="6">
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td>Choose The Reinforcement :</td>
<td>
<select id="class" name="class" style="width:250px;">
<option value="">-- Select --</option>
<? while($valid_row = mysql_fetch_assoc($valid_res))
{ ?>
<option value="<?=$valid_row['re_id']?>"><?=$valid_row['re_id']?> - <?=$valid_row['title']?></option>
<? }?>
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
<div id="reinforce_select" style="display:none;"></div>
<div id="question_select" style="display:none;"></div>


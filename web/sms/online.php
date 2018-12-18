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
	$classid =  $_REQUEST['class_ids'];
	$empid = $_SESSION['emp_id'];
	//print_r($ansarr);
	$num_ans = $_REQUEST['num_ans'][$z];
	if(count($ansarr)==0)
	{
	$ansarr = array(0);
	}
	//echo implode(',',$ansarr);
	$newarr =  implode(",",$ansarr);
	//echo "<br>";
	
	$today12 = date("Y-m-d H:i:s");
    //echo $classid."<====>";
    $sql="select question_id, correct_answer, marks, max_attempt, num_correct_ans from question_master where question_id='$question_id'";
	$res = mysql_query($sql);
	$rt=mysql_fetch_assoc($res);
	$resp = '';
	
	$correct = explode(",",$rt['correct_answer']);
	$response = explode(",",$newarr);
	//echo $row['num_correct_ans'].'<===>'.count($response).'<br>';
	sort($response);
	
	//print_r($response);
	
	$class_sql="select maximum_att from training_class where class_id='$classid'";
	$class_res = mysql_query($class_sql);
	$class_rt=mysql_fetch_assoc($class_res);
	
	$sms_score = "select question_id, emp_id, response, attempt, marks from sms_scores where question_id='$question_id' and emp_id='$empid' and class_id='$classid'";
	$sms_res = mysql_query($sms_score);
	$sms_ass = mysql_fetch_assoc($sms_res);
	
if($question_id=='329' || $question_id=='330' || $question_id=='331' || $question_id=='332' || $question_id=='333' || $question_id=='334' || $question_id=='335' || $question_id=='336' || $question_id=='337' || $question_id=='338' || $question_id=='339' || $question_id=='340' || $question_id=='341' || $question_id=='342' || $question_id=='343' || $question_id=='344' || $question_id=='345' || $sms_ass['attempt']=='')
{
$max_attempt = 0;
}
else
{
$max_attempt = $sms_ass['attempt'];
}

//echo $class_rt['maximum_att'].'<====>'.$max_attempt.'<====>'.$rt['num_correct_ans'].'<====>'.count($response).'<br>';

	
	//echo $sms_ass['question_id'].'=====>';
if($class_rt['maximum_att']>$max_attempt)
{

$corearr = array("A","B","C","D","E");
$vals = $response;
$answerarr = array();

$c=array_diff($corearr,$vals);
$p = 0;
$miss_arr = array_keys($c);

while(count($corearr)>$p)
{
if($c[$p]!='')
{
$answerarr[] = "0";
}
else
{
$answerarr[] = $corearr[$p];
}
$p++;
}

$corearr2 = array("A","B","C","D","E");
$vals2 = $correct;
$answerarr2 = array();

$c2=array_diff($corearr2,$vals2);
$p2 = 0;
$miss_arr2 = array_keys($c2);

while(count($corearr2)>$p2)
{
if($c2[$p2]!='')
{
$answerarr2[] = "0";
}
else
{
$answerarr2[] = $corearr2[$p2];
}
$p2++;
}

/*print_r($answerarr);
print_r($answerarr2);
echo count($ansarr4);
echo "<br>";*/

$mark = 0;
if($num_ans==5)
{
  $w=0;
  while(5>$w)
  {
   if($answerarr[$w]==$answerarr2[$w] && count($ansarr4)!=0)
   {
    $mark= $mark+1;
   }
   else
   {
    $mark= $mark+0;
   }
   $w++;
  }
}
else if($num_ans==4)
{
  $w=0;
  while(4>$w)
  {
  //echo $answerarr[$w]."<====>".$answerarr2[$w]."<br>";
   if($answerarr[$w]==$answerarr2[$w] && count($ansarr4)!=0)
   {
    $mark= $mark+1;
   }
   else
   {
    $mark= $mark+0;
   }
   $w++;
  }
}
else if($num_ans==3)
{
  $w=0;
  while(3>$w)
  {
   if($answerarr[$w]==$answerarr2[$w] && count($ansarr4)!=0)
   {
    $mark= $mark+1;
   }
   else
   {
    $mark= $mark+0;
   }
   $w++;
  }

}
else if($num_ans==2)
{
  $w=0;
  while(2>$w)
  {
   if($answerarr[$w]==$answerarr2[$w] && count($ansarr4)!=0)
   {
    $mark= $mark+1;
   }
   else
   {
    $mark= $mark+0;
   }
   $w++;
  }

}
else
{
$mark = 0;
}

//echo $mark;  

   if($sms_ass['question_id']=='')
	{
		if(count($ansarr4)!=0)
		{
		 //$mark = 1;
		 $emp="insert into sms_scores (question_id, emp_id, response, attempt, marks, time, class_id) values ('".$rt['question_id']."','$empid','".implode(",",$response)."','1','".$mark."','$today12', '$classid')";
		$empres = mysql_query($emp);
		 $emp2="insert into sms_scores_new (question_id, emp_id, response, attempt, marks, time, class_id) values ('".$rt['question_id']."','$empid','".implode(",",$response)."','1','".$mark."','$today12', '$classid')";
		$empres2 = mysql_query($emp2);		
		}
		else
		{
		 //$mark = 0;
		 $emp="insert into sms_scores (question_id, emp_id, response, attempt, marks, time, class_id) values ('".$rt['question_id']."','$empid','".implode(",",$response)."','1','".$mark."','$today12', '$classid')";
		$empres = mysql_query($emp);
		$emp2="insert into sms_scores_new (question_id, emp_id, response, attempt, marks, time, class_id) values ('".$rt['question_id']."','$empid','".implode(",",$response)."','1','".$mark."','$today12', '$classid')";
		$empres2 = mysql_query($emp2);
		}
	}
	
	else
	{
		if(count($ansarr4)!=0)
		{
		//$mark = $rt['marks'];
		$attempt = $sms_ass['attempt']+1;
		$emp="update sms_scores set response = '".implode(",",$response)."',attempt = '$attempt',marks = '".$mark."',time = now() where question_id = '".$sms_ass['question_id']."' and  emp_id = '".$sms_ass['emp_id']."' and class_id='$classid'";
		$empres = mysql_query($emp);
		
		$emp2="insert into sms_scores_new (question_id, emp_id, response, attempt, marks, time, class_id) values ('".$rt['question_id']."','$empid','".implode(",",$response)."','$attempt','".$mark."','$today12', '$classid')";
		$empres2 = mysql_query($emp2);
		}
		else
		{
		//$mark = 0;
		$attempt = $sms_ass['attempt']+1;
		$emp="update sms_scores set response = '".implode(",",$response)."',attempt = '$attempt',marks = '".$mark."',time = now() where question_id = '".$sms_ass['question_id']."' and  emp_id = '".$sms_ass['emp_id']."' and class_id='$classid'";
		$empres = mysql_query($emp);
		
		$emp2="insert into sms_scores_new (question_id, emp_id, response, attempt, marks, time, class_id) values ('".$rt['question_id']."','$empid','".implode(",",$response)."','$attempt','".$mark."','$today12', '$classid')";
		$empres2 = mysql_query($emp2);
		
		}
	}
	
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

/*
$valid_sql = "select a.emp_id,a.class_id,a.class_name,a.percentage as classperc,a.maximum_att,b.perc,if(perc>percentage,'pass','fail')as status

from

(select a.emp_id,a.class_id,b.class_name,percentage,b.maximum_att from training_participant a,training_class b where a.class_id=b.class_id and b.mode='ONLINE' and  emp_id='$emp_id')as a


left outer join


(select a.emp_id,a.class_id,question_id,cntmarks,totalq,((cntmarks*100)/totalq)as perc

from

(select a.emp_id,a.class_id,question_id,count(case when marks>0 then 1 end ) as cntmarks

from (select a.emp_id,a.class_id,question_id,marks from
training_participant a
inner join sms_scores b on a.class_id=b.class_id and a.emp_id=b.emp_id
where a.emp_id='$emp_id') as a

group by class_id )as a

left outer join

(select t.class_id,count(a.question_id) as totalq from training_class t,question_master a,module_master b
where  t.module_id=b.module_id and a.module_id=b.module_id group by t.class_id)as

b on a.class_id=b.class_id)as b

on a.class_id=b.class_id  group by a.class_id";*/
$valid_sql="SELECT b.class_id, b.class_name FROM training_participant a,training_class b where a.class_id=b.class_id and a.emp_id='$emp_id' and b.start_date<=date(now()) and b.end_date>=date(now())  group by a.class_id";

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

$(document).ready(function() {
$("#submitbtn").click(function() {
  var classid = $("#class").val();
  //alert(classid);
  if(classid!='')
  {
   document.getElementById("class_select").style.display = 'none';
   document.getElementById("dvLoading").style.display = '';
   //$("#question_select").load("sms/question.php", {classid:classid});
   $.get("sms/question.php",{classid:classid},function(selecting)
		{
		//alert(selecting);
		//setTimeout(function(){},1000);
		$("#question_select").html(selecting);
		});
    document.getElementById("question_select").style.display = '';
  }
  else
  {
   alert("Please Choose The Training Class");
   document.getElementById("class_select").style.display = '';
   document.getElementById("question_select").value.style.display = 'none';
  }
});
});
</script>
<div id="class_select">
<? //echo "<div align='center' style='color:#E43B78; font-weight:bold;'>Scores Saved Successfully.......</div>";?>
<table align="center" cellpadding="6" cellspacing="6">
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td>Choose The Training Class :</td>
<td>
<select id="class" name="class" style="width:250px;">
<option value="">-- Select --</option>
<? while($valid_row = mysql_fetch_assoc($valid_res))
{ 
$score_sql = "SELECT attempt FROM sms_scores where class_id='".$valid_row['class_id']."' and emp_id='".$valid_row['emp_id']."' group by class_id,emp_id";
$score_res = mysql_query($score_sql);
$score_row = mysql_fetch_assoc($score_res);
if($valid_row['status']=='fail' && $score_row['attempt']<$valid_row['maximum_att']){?>
<option value="<?=$valid_row['class_id']?>"><?=$valid_row['class_name']?></option>
<? } else{
?>
<option value="<?=$valid_row['class_id']?>"><?=$valid_row['class_name']?></option>

<?
}}?>
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


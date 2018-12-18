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

</style>
<?php
if($_SESSION['login_id']=='')
{
    header('Location: index.php');   
}
require_once "db.php";

if($_REQUEST['submit']=="Submit")
{
	$z=0;
	$quiz = $_REQUEST['question_id'];
	while(count($quiz)>$z)
	{
	$id = 'question-'.$quiz[$z];
	$question_id = $quiz[$z];
	$ansarr =  $_REQUEST[$id];
	$classid =  $_REQUEST['class_ids'];
	$empid = $_SESSION['emp_id'];
	//print_r($ansarr);
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
   
   if($sms_ass['question_id']=='')
	{
		if($rt['num_correct_ans']>=count($response))
		{
			if($rt['correct_answer']==implode(",",$response))
			{
			$mark = $rt['marks'];
			$emp="insert into sms_scores (question_id, emp_id, response, attempt, marks, time, class_id) values ('".$rt['question_id']."','$empid','".implode(",",$response)."','1','".$mark."','$today12', '$classid')";
			$empres = mysql_query($emp);
			}
			else if(in_array($response[0], $correct) || in_array($response[1], $correct) || in_array($response[2], $correct) || 
			in_array($response[3], $correct)  || in_array($response[4], $correct) && ($row['correct_answer']!=implode(",",$response)))
			{
			$mark = $rt['marks']/2;
			$emp="insert into sms_scores (question_id, emp_id, response, attempt, marks, time, class_id) values ('".$rt['question_id']."','$empid','".implode(",",$response)."','1','".$mark."','$today12', '$classid')";
			$empres = mysql_query($emp);
			}
			else
			{
			$mark = 0;
			$emp="insert into sms_scores (question_id, emp_id, response, attempt, marks, time, class_id) values ('".$rt['question_id']."','$empid','".implode(",",$response)."','1','".$mark."','$today12', '$classid')";
			$empres = mysql_query($emp);
			}
	     }
		else
		{
		$mark = 0;
		$emp="insert into sms_scores (question_id, emp_id, response, attempt, marks, time, class_id) values ('".$rt['question_id']."','$empid','".implode(",",$response)."','1','".$mark."','$today12', '$classid')";
		$empres = mysql_query($emp);
		}
	}
	
	else
	{
		if($rt['num_correct_ans']>=count($response))
		{
			if($rt['correct_answer']==implode(",",$response))
			{
			$mark = $rt['marks'];
			$attempt = $sms_ass['attempt']+1;
			$emp="update sms_scores set response = '".implode(",",$response)."',attempt = '$attempt',marks = '".$mark."',time = now() where question_id = '".$sms_ass['question_id']."' and  emp_id = '".$sms_ass['emp_id']."' and class_id='$classid'";
			$empres = mysql_query($emp);
			}
			else if(in_array($response[0], $correct) || in_array($response[1], $correct) || in_array($response[2], $correct) || 
			in_array($response[3], $correct)  || in_array($response[4], $correct) && ($row['correct_answer']!=implode(",",$response)))
			{
			$mark = $rt['marks']/2;
			$attempt = $sms_ass['attempt']+1;
			$emp="update sms_scores set response = '".implode(",",$response)."',attempt = '$attempt',marks = '".$mark."',time = now() where question_id = '".$sms_ass['question_id']."' and  emp_id = '".$sms_ass['emp_id']."' and class_id='$classid'";
			$empres = mysql_query($emp);
			}
			else
			{
			$mark = 0;
			$attempt = $sms_ass['attempt']+1;
			$emp="update sms_scores set response = '".implode(",",$response)."',attempt = '$attempt',marks = '".$mark."',time = now() where question_id = '".$sms_ass['question_id']."' and  emp_id = '".$sms_ass['emp_id']."' and class_id='$classid'";
			$empres = mysql_query($emp);

			}
	     }
		else
		{
		$mark = 0;
		$attempt = $sms_ass['attempt']+1;
		$emp="update sms_scores set response = '".implode(",",$response)."',attempt = '$attempt',marks = '".$mark."',time = now() where question_id = '".$sms_ass['question_id']."' and  emp_id = '".$sms_ass['emp_id']."' and class_id='$classid'";
		$empres = mysql_query($emp);
		
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

on a.class_id=b.class_id  group by a.class_id";

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
    $.post("sms/question.php",{classid:classid},function(selecting)
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
<? } }?>
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

</html>

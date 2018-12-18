<?php 
//require_once"class.smscountry.php";
require_once"class.smsinfini.php";
require_once"db.php";
$sms = new SMSInfini();
//$sms = new SMSCountry();

// This function Not in use 
function mobile_employee_code($mobile)
{
	$sql="select emp_id from employee_master where mobile_no='$mobile'";
	$res = mysql_query($sql);
	$rt=mysql_fetch_assoc($res);
	return $rt['emp_id'];
}

// Validate responded users having valid mobile number or not
function get_class_employee_validate($class,$mobile)
{
    $sql="select class_id, class_code from training_class where class_code='$class'";
	$res = mysql_query($sql);
	$rt=mysql_fetch_assoc($res);
	
	/*$emp="select a.emp_id as id from employee_master a,training_participant b where a.emp_id=b.emp_id and b.class_id='".$rt['class_id']."' and a.mobile_no='$mobile'";
	$empres = mysql_query($emp);
	$emprt=mysql_fetch_assoc($empres);	
	return $emprt['id'];*/
	
	$emp="select emp_id as id from training_participant where class_id='".$rt['class_id']."' and mobile_no='$mobile'";
	$empres = mysql_query($emp);
	$emprt=mysql_fetch_assoc($empres);
	$arr[0] = $rt['class_id'];
	$arr[1] = $emprt['id'];
	return $arr;
}

function get_question_exsist($classcode,$question_id)
{    
	if($question_id=='329' || $question_id=='330' || $question_id=='331' || $question_id=='332' || $question_id=='333' || $question_id=='334' || $question_id=='335' || $question_id=='336' || $question_id=='337' || $question_id=='338' || $question_id=='339' || $question_id=='340' || $question_id=='341' || $question_id=='342' || $question_id=='343' || $question_id=='344' || $question_id=='345')
	{
	$nrw = 1;
	}
	else
	{	
	$sql = "select f.question_id from training_class a,question_master f where a.class_code='".$classcode."' and a.module_id=f.module_id and f.question_id='".$question_id."'";
	$res = mysql_query($sql);
	$nrw = mysql_num_rows($res);
	}
	return $nrw;
}


function get_employee_scores($empid,$question_id,$ans,$classid)
{
$today12 = date("Y-m-d H:i:s");
    //echo $classid."<====>";
    $sql="select question_id, correct_answer, marks, max_attempt from question_master where question_id='$question_id'";
	$res = mysql_query($sql);
	$rt=mysql_fetch_assoc($res);
	$resp = '';
	
	$sms_score = "select question_id, emp_id, response, attempt, marks from sms_scores where question_id='$question_id' and emp_id='$empid'";
	$sms_res = mysql_query($sms_score);
	$sms_ass = mysql_fetch_assoc($sms_res);
	//echo $sms_ass['question_id'].'=====>';
if($rt['max_attempt']>$sms_ass['attempt'])
{
	if($sms_ass['question_id']=='')
	{
	
		if($rt['correct_answer']==$ans)
		{
		$emp="insert into sms_scores (question_id, emp_id, response, attempt, marks, time, class_id) values ('".$rt['question_id']."','$empid','".$rt['correct_answer']."','1','".$rt['marks']."','$today12', '$classid')";
		$empres = mysql_query($emp);
		$resp = 'correct';
		}
		else
		{
		$emp="insert into sms_scores (question_id, emp_id, response, attempt, marks, time, class_id) values ('".$rt['question_id']."','$empid','$ans','1','0','$today12', '$classid')";
		$empres = mysql_query($emp);
		$resp = 'wrong';
		}
		
	
	}
	
	else
	{
		if($rt['correct_answer']==$ans)
		{
		$attempt = $sms_ass['attempt']+1;
		$emp="update sms_scores set response = '".$rt['correct_answer']."',attempt = '$attempt',marks = '".$rt['marks']."',time = now() where question_id = '".$sms_ass['question_id']."' and  emp_id = '".$sms_ass['emp_id']."' and class_id='$classid'";
		$empres = mysql_query($emp);
		$resp = 'correct';
		}
		else
		{
		 $attempt = $sms_ass['attempt']+1;
		$emp="update sms_scores set response = '$ans',attempt = '$attempt',marks = '0',time = now() where question_id = '".$sms_ass['question_id']."' and  emp_id = '".$sms_ass['emp_id']."' and class_id='$classid'";
		$empres = mysql_query($emp);
		$resp = 'wrong';
		}
		
	   
	}
}
else
{
$resp = "attempt over";
}
	
	return $resp;
}

//---------------------  survey starts here ----------------------------


function get_survey_employee_validate($mobile,$sid)
{
   	$emp="select emp_id as id from survey_empscore where mobile_no='$mobile' and sid='$sid'";
	$empres = mysql_query($emp);
	$emprt=mysql_fetch_assoc($empres);	
	return $emprt['id'];
}

function get_survey_employee_scores($empid,$question_id,$ans)
{
    $sql="select m.maximum_att from survey_master m,survey_empscore s where m.sid=s.sid and s.sid='$question_id' and emp_id='$empid'";
	$res = mysql_query($sql);
	$rt=mysql_fetch_assoc($res);
	$resp = '';
	
	$sms_score = "select maximum_att,response from survey_empscore where sid='$question_id' and emp_id='$empid'";
	$sms_res = mysql_query($sms_score);
	$sms_ass = mysql_fetch_assoc($sms_res);
	//echo $sms_ass['question_id'].'=====>';
if($rt['maximum_att']>$sms_ass['maximum_att'])
{
	
		$attempt = $sms_ass['maximum_att']+1;
		$emp="update survey_empscore set response = '$ans',maximum_att = '$attempt' where sid = '$question_id' and  emp_id = '$empid'";
		$empres = mysql_query($emp);
		$resp = 'accecpt';

}
else
{
$resp = "attempt over";
}
	
	return $resp;
}


//---------------------  Reinforce starts here ----------------------------


function get_reinforce_employee_validate($mobile,$question_id)
{
   //$emp="select a.emp_id as id from employee_master a,reinforcement_question_score b where a.emp_id=b.emp_id and a.mobile_no='$mobile' and b.q_id='$question_id'";
    $emp="select emp_id as id from reinforcement_question_score where mobile_no='$mobile' and  req_id='$question_id'";
	$empres = mysql_query($emp);
	$emprt=mysql_fetch_assoc($empres);	
	return $emprt['id'];
}

function get_reinforce_employee_scores($empid,$question_id,$ans)
{
    $sql="select m.maximum_att,m.marks from reinforcement_question m,reinforcement_question_score s where m.req_id=s.req_id and m.req_id='$question_id'";
	$res = mysql_query($sql);
	$rt=mysql_fetch_assoc($res);
	$mark = $rt['marks'];
	$resp = '';
	
	$sms_score = "select maximum_att,response from reinforcement_question_score where req_id='$question_id' and emp_id='$empid'";
	$sms_res = mysql_query($sms_score);
	$sms_ass = mysql_fetch_assoc($sms_res);
	//echo $sms_ass['question_id'].'=====>';
if($rt['maximum_att']>$sms_ass['maximum_att'])
{
	
		$attempt = $sms_ass['maximum_att']+1;
		$emp="update reinforcement_question_score set response = '$ans',marks ='$mark' ,maximum_att = '$attempt' where req_id = '$question_id' and  emp_id = '$empid'";
		$empres = mysql_query($emp);
		$resp = 'accecpt';

}
else
{
$resp = "attempt over";
}
	
	return $resp;
}


function smsob_integer_to_alphabet($answer_num){

	switch($answer_num){

		case 1:

			return 'A';

			break;

		case 2:

			return 'B';

			break;

		case 3:

			return 'C';

			break;

		case 4:

			return 'D';

			break;
		case 5:

			return 'E';

			break;

		default:

			return 0;

	}

return true;

}

function smsob_alphabet_to_integer($answer_num){

	switch($answer_num){

		case 'A':

			return 1;

			break;

		case 'B':

			return 2;

			break;

		case 'C':

			return 3;

			break;

		case 'D':

			return 4;

			break;
		
		case 'E':

			return 5;

			break;

	}

	return true;

}

function smsob_get_quiz_correct_response($e){
	return "Your Response Is Received Successfully For ".$e;
}

function smsob_get_quiz_incorrect_response($e){
	return "Your Response Is Received Successfully For ".$e;
}

function smsob_get_quiz_correct_response1($e,$no){
	return "Your Response for Question no. ".$no." Is Received Successfully For Class Training";
}

function smsob_get_quiz_incorrect_response1($e,$no){
	return "Your Response for Question no. ".$no." Is Received Successfully For Class Training";
}


///===============================================    All Code Starts Here     ======================================== /////////////

//$query = strtolower($_REQUEST['message']);

$msg = preg_replace('/\s+/', ' ',$_REQUEST['message']);
$query = strtolower($msg);
$message = explode(" ", $query);
$response = '';
//$mobilenumber = '+'.trim($_REQUEST['mobilenumber']);

$from[0]=$_REQUEST['from'];
$mobilenumber = $_REQUEST['from'];
$timezone = "Asia/Calcutta";
if(function_exists('date_default_timezone_set')) 
date_default_timezone_set($timezone);
$today = date("Y-m-d H:i:s");
$resp_sql = "insert into resposes(message, mobile_no, created_date) values ('".$_REQUEST['message']."','".$_REQUEST['from']."','$today')";
$resp_res = mysql_query($resp_sql);
$last_id = mysql_insert_id();


// $url = AUDI CL001 QUS_ID ANS & mobilenumber=9629017893


//print_r($message);
//echo substr($message[1], 0,3);
//exit;
if(isset($message[1]))
{

if(substr($message[1], 0,2)=='cl' && count($message)==4)
{
$mobile = substr($mobilenumber,-7-3);
$emp_id = get_class_employee_validate(strtoupper($message[1]),$mobile);
//print_r($emp_id);

	   if(isset($emp_id) && $emp_id[1]!='')
	   {
			
			$valid_question = get_question_exsist(strtoupper($message[1]),strtoupper($message[2]));
			if($valid_question!=0)
			{
				$score = get_employee_scores($emp_id[1],$message[2],strtoupper($message[3]),$emp_id[0]);
				$clss = strtoupper($message[1]);
				$resp_sql1 = "update resposes set identifier='".$clss."' , emp_id='".$emp_id[1]."' where rep_id='".$last_id."'";
				$resp_res1 = mysql_query($resp_sql1);
				
				if($score=='correct')
				{
				  $response = smsob_get_quiz_correct_response1("Class Training",$message[2]);
				}
				else if($score=='wrong')
				{
				  $response = smsob_get_quiz_incorrect_response1("Class Training",$message[2]);
				}
				else
				{
				  $response = "You have exceeded the max attempts for this quiz, your last attempt would be considered for scoring - By RSARWR";
				}
			}
			else
			{
			  $response = "Please check your Question No.  It is not related to current Training";
			}
	   }
	   else
	   {
		$response = "You are not added to the employee master data & hence cannot access the system - By RSARWR";
	   }
}

else if($message[1]=='s')
{
$mobile = substr($mobilenumber,-7-3);
$emp_id = get_survey_employee_validate($mobile,$message[2]);
   if(isset($emp_id))
   {
	$convet_ans = smsob_alphabet_to_integer(strtoupper($message[3]));
    $score = get_survey_employee_scores($emp_id,$message[2],$convet_ans);
	if($score=='accecpt')
	{
	  $response = smsob_get_quiz_correct_response("Survey");
	}
	else
	{
	  $response = "You have exceeded the max attempts for this quiz, your last attempt would be considered for scoring - By RSARWR";
	}
   }
   else
   {
    $response = "You are not added to the employee master data & hence cannot access the system - By RSARWR";
   }
	
}
else if($message[1]=='r')
{

$mobile = substr($mobilenumber,-7-3);
$emp_id = get_reinforce_employee_validate($mobile,$message[2]);
   if(isset($emp_id))
   {
	$convet_ans = smsob_alphabet_to_integer(strtoupper($message[3]));
    $score = get_reinforce_employee_scores($emp_id,$message[2],$convet_ans);
	if($score=='accecpt')
	{
	  $response = smsob_get_quiz_correct_response("Reinforcement");
	}
	else
	{
	  $response = "You have exceeded the max attempts for this quiz, your last attempt would be considered for scoring - By RSARWR";
	}
   }
   else
   {
    $response = "You are not added to the employee master data & hence cannot access the system - By RSARWR";
   }
	
}


else if($message[1]=='m')
{

$mobile = substr($mobilenumber,-7-3);

$query1 = $_REQUEST['message'];
$message1 = explode(" ", $query1);

$f=3;
while(count($message1)>$f)
{
$msg .= $message1[$f].' ';
$f++;
}

$sql = "update md_knowledge_bluster_detail set response='$msg' where mobile_no='$mobile' and md_id='$message[2]'";
$res = mysql_query($sql);

if($res)
{
$response = "Your Response Is Received Successfully For MD Speak";
}


/*$emp_id = get_mdspeak_employee_validate($mobile,$message[2]);
   if(isset($emp_id))
   {
	$convet_ans = smsob_alphabet_to_integer(strtoupper($message[3]));
    $score = get_reinforce_employee_scores($emp_id,$message[2],$convet_ans);
	if($score=='accecpt')
	{
	  $response = smsob_get_quiz_correct_response("Reinforcement");
	}
	else
	{
	  $response = "You have exceeded the max attempts for this quiz, your last attempt would be considered for scoring - By RSARWR";
	}
   }
   else
   {
    $response = "You are not added to the employee master data & hence cannot access the system - By RSARWR";
   }*/
	
}


// Employee Registration process  RSARWR G CL22  empcode 9688885607
else if($message[1]=='g')
{

$mobile = substr($mobilenumber,-7-3);
   
    $sql="insert into training_reg_details(class_code, up_mobile, msg_content, emp_code)values('".$message[2]."','".$message[4]."','".$_REQUEST['message']."','".$message[3]."')";
	$res=mysql_query($sql);

  $sql8="select emp_id from employee_master where emp_code='".strtoupper($message[3])."'";
  $res8=mysql_query($sql8);
  $row8 = mysql_fetch_assoc($res8);
  $emp_id=$row8['emp_id'];

$classcode=explode("cl",$message[2]);


  $sql6="update training_participant set mobile_no='".$message[4]."' where emp_id='".$emp_id."' and class_id='".$classcode[1]."'";
  $res6=mysql_query($sql6);
  
  if($res6)
  $response = "Your Mobile ".$message[4]. "Has been successfully Registered - By RSARWR";
 
 else
   
   $response = "You are not added to the employee master data & hence cannot access the system - By RSARWR";
   
	
}

else if($message[1]=='reg')
{

$mobile = substr($mobilenumber,-7-3);
   
	$sql="insert into employee_reg_details(mobile_no, msg_content, reg_time, active)values('$mobile','".$_REQUEST['message']."',now(),0)";
	$res=mysql_query($sql);
	$last_insertid = mysql_insert_id();
 
  $sql8="select emp_id from employee_master where emp_code='".strtoupper($message[2])."'";
  $res8=mysql_query($sql8);
  $row8 = mysql_fetch_assoc($res8);
  $emp_id=$row8['emp_id'];
  
  if($emp_id!='')
  {
   
	  $m_sql="select mobile_no from employee_master where emp_code='".strtoupper($message[2])."'";
	  $m_res=mysql_query($m_sql);
	  $m_row = mysql_fetch_assoc($m_res);
	  $m_mobile = $m_row['mobile_no'];
	  if($m_mobile==$mobile)
	  {
	      $response = "Your Mobile ".$message[4]." Has been successfully Registered - By RSARWR";		  
	      $up_sql = "update employee_reg_details set emp_id='$emp_id',emp_code='".strtoupper($message[2])."',active=1,sent_msg='$response',status='Valid Employee Mobile No' where id='$last_insertid'";
          $up_res=mysql_query($up_sql);
	  }
	  else
	  {
	       $response = "Invalid mobile no, please register with valid mobile no - By RSARWR";
		   $up_sql = "update employee_reg_details set emp_id='$emp_id',emp_code='".strtoupper($message[2])."',sent_msg='$response',status='In-Valid Mobile No' where id='$last_insertid'";
           $up_res=mysql_query($up_sql);
	  }

  }
  else
  {   
   $response = "You are not authorized user, Please contact your admin - By RSARWR";
   $up_sql = "update employee_reg_details set sent_msg='$response',status='Invalid Employee Code' where id='$last_insertid'";
   $up_res=mysql_query($up_sql);
  }
}

//================

else
{
$response = "Invalid SMS Format, kindly check with provided template & try again - By RSARWR";
}

}

else
{
$response = "Invalid SMS Format, kindly check with provided template & try again - By RSARWR";
}
//echo $response;

$response1=$sms->sendSingleSMS('RSARWR',$from,$response);
//$sms->sendSingleSMS('RSARWR',$mobilenumber,$response);

//exit;


?>
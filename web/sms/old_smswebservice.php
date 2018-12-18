<?php 
require_once"class.smscountry.php";
require_once"db.php";
$sms = new SMSCountry();

function mobile_employee_code($mobile)
{
	$sql="select emp_id from employee_master where mobile_no='$mobile'";
	$res = mysql_query($sql);
	$rt=mysql_fetch_assoc($res);
	return $rt['emp_id'];
}

function get_class_employee_validate($class,$mobile)
{
    $sql="select class_id, class_code from training_class where class_code='$class'";
	$res = mysql_query($sql);
	$rt=mysql_fetch_assoc($res);
	
	$emp="select a.emp_id as id from employee_master a,training_participant b where a.emp_id=b.emp_id and b.class_id='".$rt['class_id']."' and a.mobile_no='$mobile'";
	$empres = mysql_query($emp);
	$emprt=mysql_fetch_assoc($empres);	
	return $emprt['id'];
}


function get_employee_scores($empid,$question_id,$ans)
{
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
		$emp="insert into sms_scores (question_id, emp_id, response, attempt, marks, time) values ('".$rt['question_id']."','$empid','".$rt['correct_answer']."','1','".$rt['marks']."',now())";
		$empres = mysql_query($emp);
		$resp = 'correct';
		}
		else
		{
		$emp="insert into sms_scores (question_id, emp_id, response, attempt, marks, time) values ('".$rt['question_id']."','$empid','$ans','1','0',now())";
		$empres = mysql_query($emp);
		$resp = 'wrong';
		}
		
	
	}
	
	else
	{
		if($rt['correct_answer']==$ans)
		{
		$attempt = $sms_ass['attempt']+1;
		$emp="update sms_scores set response = '".$rt['correct_answer']."',attempt = '$attempt',marks = '".$rt['marks']."',time = now() where question_id = '".$sms_ass['question_id']."' and  emp_id = '".$sms_ass['emp_id']."'";
		$empres = mysql_query($emp);
		$resp = 'correct';
		}
		else
		{
		$attempt = $sms_ass['attempt']+1;
		$emp="update sms_scores set response = '$ans',attempt = '$attempt',marks = '0',time = now() where question_id = '".$sms_ass['question_id']."' and  emp_id = '".$sms_ass['emp_id']."'";
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


function get_survey_employee_validate($survey,$mobile)
{
   	$emp="select a.emp_id as id from employee_master a,survey_empscore b where a.emp_id=b.emp_id and a.mobile_no='$mobile'";
	$empres = mysql_query($emp);
	$emprt=mysql_fetch_assoc($empres);	
	return $emprt['id'];
}

function get_survey_employee_scores($empid,$question_id,$ans)
{
    $sql="select m.maximum_att from survey_master m,survey_empscore s where m.sid=s.sid and s.se_id='$question_id'";
	$res = mysql_query($sql);
	$rt=mysql_fetch_assoc($res);
	$resp = '';
	
	$sms_score = "select maximum_att,response from survey_empscore where se_id='$question_id' and emp_id='$empid'";
	$sms_res = mysql_query($sms_score);
	$sms_ass = mysql_fetch_assoc($sms_res);
	//echo $sms_ass['question_id'].'=====>';
if($rt['maximum_att']>$sms_ass['maximum_att'])
{
	
		$attempt = $sms_ass['maximum_att']+1;
		$emp="update survey_empscore set response = '$ans',attempt = '$attempt' where se_id = '$question_id' and  emp_id = '$empid'";
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


function get_reinforce_employee_validate($survey,$mobile,$question_id)
{
   $emp="select a.emp_id as id from employee_master a,reinforcement_question_score b where a.emp_id=b.emp_id and a.mobile_no='$mobile' and b.q_id='$question_id'";
	$empres = mysql_query($emp);
	$emprt=mysql_fetch_assoc($empres);	
	return $emprt['id'];
}

function get_reinforce_employee_scores($empid,$question_id,$ans)
{
    $sql="select m.maximum_att,m.marks from reinforcement_question m,reinforcement_question_score s where m.req_id=s.req_id and s.q_id='$question_id'";
	$res = mysql_query($sql);
	$rt=mysql_fetch_assoc($res);
	$mark = $rt['marks'];
	$resp = '';
	
	$sms_score = "select maximum_att,response from reinforcement_question_score where q_id='$question_id' and emp_id='$empid'";
	$sms_res = mysql_query($sms_score);
	$sms_ass = mysql_fetch_assoc($sms_res);
	//echo $sms_ass['question_id'].'=====>';
if($rt['maximum_att']>$sms_ass['maximum_att'])
{
	
		$attempt = $sms_ass['maximum_att']+1;
		$emp="update reinforcement_question_score set response = '$ans',marks ='$mark' ,maximum_att = '$attempt' where q_id = '$question_id' and  emp_id = '$empid'";
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

function smsob_get_quiz_correct_response(){
	return "Congratulations, your answer is Correct";
}

function smsob_get_quiz_incorrect_response(){
	return "Sorry, Your answer is incorrect";
}


///===============================================    All Code Starts Here     ======================================== /////////////

$query = strtolower($_REQUEST['message']);
$message = explode(" ", $query);
$response = '';
$mobilenumber = '+'.trim($_REQUEST['mobilenumber']);

// $url = AUDI CL001 QUS_ID ANS & mobilenumber=9629017893

if(isset($message[1]))
{
if(substr($message[1], 0,2)=='cl')
{

$emp_id = get_class_employee_validate(strtoupper($message[1]),$mobilenumber);
   if(isset($emp_id))
   {
    $score = get_employee_scores($emp_id,$message[2],strtoupper($message[3]));
	if($score=='correct')
	{
	  $response = smsob_get_quiz_correct_response();
	}
	else if($score=='wrong')
	{
	  $response = smsob_get_quiz_incorrect_response();
	}
	else
	{
	  $response = "Maximum Attempt is Over...........";
	}
   }
   else
   {
    $response = "You are not added to the employee master data & hence cannot access the system.";
   }
}

if(substr($message[1], 0,1)=='s')
{
$emp_id = get_survey_employee_validate(strtoupper($message[1]),$mobilenumber);
   if(isset($emp_id))
   {
	$convet_ans = smsob_alphabet_to_integer(strtoupper($message[3]));
    $score = get_survey_employee_scores($emp_id,$message[2],$convet_ans);
	if($score=='accecpt')
	{
	  $response = smsob_get_quiz_correct_response();
	}
	else
	{
	  $response = "Maximum Attempt is Over...";
	}
   }
   else
   {
    $response = "You are not added to the employee master data & hence cannot access the system.";
   }
	
}
if(substr($message[1], 0,1)=='r')
{
$emp_id = get_reinforce_employee_validate(strtoupper($message[1]),$mobilenumber,$message[2]);
   if(isset($emp_id))
   {
	$convet_ans = smsob_alphabet_to_integer(strtoupper($message[3]));
    $score = get_reinforce_employee_scores($emp_id,$message[2],$convet_ans);
	if($score=='accecpt')
	{
	  $response = smsob_get_quiz_correct_response();
	}
	else
	{
	  $response = "Maximum Attempt is Over...";
	}
   }
   else
   {
    $response = "You are not added to the employee master data & hence cannot access the system.";
   }
	
}
}

else
{
$response = "Invalid SMS Format, kindly check*try again - By CIOKlub";
}
//echo $response;
$sms->sendSingleSMS('RSARWR',$emp_mobile,$response);


?>
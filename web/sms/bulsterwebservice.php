<?php
//require_once"class.smscountry.php";
require_once"class.smsinfini.php";
require_once"db.php";
//$sms = new SMSCountry();
$sms = new SMSInfini();
//$sms->sendSingleSMS('RSARSA','+919629017893','test by sundar');
//echo $date = date('Y-m-d H:i:s');
$com_date = date('Y-m-d');

date_default_timezone_set('GMT');
$temp= strtotime("+5 hours 30 minutes"); 
$date = date("Y-m-d H:i:s",$temp);
//echo $date12;

if($_REQUEST['bulster']=="MDSPEAK")
{

$sql = "select m.md_id,m.description,s.mdkb_id,s.emp_id,s.emp_name,s.mobile_no from md_knowledge_master m,md_knowledge_bluster_detail s
where m.schedule_date<'$date' and m.md_id=s.md_id and s.delivered_status=0 and date(schedule_date)='$com_date'";

$msql = "SELECT keyword, content, reply_no, Idendifier FROM sms_account where Idendifier='M'";
$mres = mysql_query($msql);
$mresults = mysql_fetch_assoc($mres);

$keyword = $mresults['keyword'];
$content = $mresults['content'];
$reply_no = $mresults['reply_no'];
$Idendifier = $mresults['Idendifier'];

$res = mysql_query($sql);
while($row = mysql_fetch_assoc($res))
{
$emp_mobile1 = array();
$md_id = $row['md_id'];
$description = $row['description'];
$mdkb_id = $row['mdkb_id'];
$emp_id = $row['emp_id'];
$mobile_no = substr($row['mobile_no'],-7-3);
$emp_mobile = '+91'.$mobile_no;
$emp_mobile1[0] = $emp_mobile;

if(strlen($emp_mobile)==13)
{
	
//echo $response = $description;

$whole = $content.' '.$keyword.' '.'M'.' '.$md_id.' '.'Your Message'.' To '.$reply_no;
echo $total_msg = $description.' - '.$whole;

$sms->sendSingleSMS('RSARWR',$emp_mobile1,$total_msg);

$up_sql = "update md_knowledge_bluster_detail set delivered_status=1,delivered_date=now() where mdkb_id='$mdkb_id'";
$up_res = mysql_query($up_sql);

}
else
{
echo "Invalid Mobile Number....";
}

}
}

else if($_REQUEST['bulster']=="EMPENGAGE")
{
	
$sql = "select m.description,s.eakb_id,s.emp_id,s.emp_name,s.mobile_no from emp_engagement_master m,emp_engagement_activity_detail s
where m.schedule_date<'$date' and m.ee_id=s.ee_id and s.delivered_status=0 and date(schedule_date)='$com_date'";

$res = mysql_query($sql);
while($row = mysql_fetch_assoc($res))
{
$emp_mobile1 = array();
$description = $row['description'];
$eakb_id = $row['eakb_id'];
$emp_id = $row['emp_id'];
$mobile_no = substr($row['mobile_no'],-7-3);
$emp_mobile = '+91'.$mobile_no;
$emp_mobile1[0] = $emp_mobile;

if(strlen($emp_mobile)==13)
{
	
echo $response = $description;

$sms->sendSingleSMS('RSARWR',$emp_mobile1,$response);

$up_sql = "update emp_engagement_activity_detail set delivered_status=1,delivered_date=now() where eakb_id='$eakb_id'";
$up_res = mysql_query($up_sql);

}
else
{
echo "Invalid Mobile Number....";
}

}
	
}

else if($_REQUEST['bulster']=="REINFORCE")
{
	
$sql = "select s.rekb_id,m.re_id,m.description,s.emp_id,s.emp_name,s.mobile_no from
reinforcement_master m,reinforcement_detail s where m.schedule_date<'$date' and m.re_id=s.re_id
and s.delivered_status=0 and m.content_type='Text' and m.file_transfer_mode='SMS' and date(m.schedule_date)='$com_date' group by s.emp_id,m.re_id";

$res = mysql_query($sql);
while($row = mysql_fetch_assoc($res))
{
$emp_mobile1 = array();
$re_id = $row['re_id'];
$rekb_id = $row['rekb_id'];
$description = $row['description'];
$emp_id = $row['emp_id'];
$mobile_no = substr($row['mobile_no'],-7-3);
$emp_mobile = '+91'.$mobile_no;
$emp_mobile1[0] = $emp_mobile;
if(strlen($emp_mobile)==13)
{
	
echo $response = $description;

$sms->sendSingleSMS('RSARWR',$emp_mobile1,$response);

$up_sql = "update reinforcement_detail set delivered_status=1,delivered_date=now() where re_id='$re_id' and emp_id='$emp_id'";
$up_res = mysql_query($up_sql);

}
else
{
echo "Invalid Mobile Number....";
}

}
	
}

else if($_REQUEST['bulster']=="REINFORCEQUESTION")
{
	
$sql = "select sub.req_id,sub.question,sub.option_A,sub.option_B,sub.option_C,sub.option_D,sub.option_E,s.q_id,s.emp_id,s.mobile_no from
reinforcement_question sub,reinforcement_question_score s,reinforcement_master m where sub.start_date<'$date' and sub.end_date>'$date'
and sub.req_id = s.req_id and s.delivered_status=0 and sub.re_id=m.re_id and m.content_type='Text' and m.file_transfer_mode='SMS' and (date(sub.start_date)='$com_date' or date(sub.end_date)='$com_date')";

/*select m.description,sub.option_A,sub.option_B,sub.option_C,sub.option_D,sub.option_E,s.rekb_id,s.emp_id,s.emp_name,s.mobile_no from
reinforcement_master m,reinforcement_detail s,reinforcement_question sub where m.schedule_date<'2013-06-13 15:23:12' and m.re_id=s.re_id
and s.req_id = sub.req_id and s.delivered_status=0 and date(schedule_date)='2013-06-13'*/

$rep_sql = "SELECT keyword, content, reply_no, Idendifier FROM sms_account where Idendifier='R'";
$rep_res = mysql_query($rep_sql);
$rep_row = mysql_fetch_assoc($rep_res);
$keyword = $rep_row['keyword'];
$content = $rep_row['content'];
$reply_no = $rep_row['reply_no'];
$Idendifier = $rep_row['Idendifier'];

$res = mysql_query($sql);
while($row = mysql_fetch_assoc($res))
{
$emp_mobile1 = array();
$max = $row['req_id'];
$q_id = $row['q_id'];
$description = $row['question'];
$a = $row['option_A'];
$b = $row['option_B'];
$c = $row['option_C'];
$d = $row['option_D'];
$e = $row['option_E'];
//$eakb_id = $row['rekb_id'];
$emp_id = $row['emp_id'];
$mobile_no = substr($row['mobile_no'],-7-3);
$emp_mobile = '+91'.$mobile_no;
$emp_mobile1[0] = $emp_mobile;
if(strlen($emp_mobile)==13)
{
	
echo $response = $description;

if($a!='')
{
$msg1 = ' A)'.$a;
$opt1 = 'A';
}
if($b!='')
{
$msg2 = ' B)'.$b;
$opt2 = '/B';
}
if($c!='')
{
$msg3 = ' C)'.$c;
$opt3 = '/C';
}
if($d!='')
{
$msg4 = ' D)'.$d;
$opt4 = '/D';
}
if($e!='')
{
$msg5 = ' E)'.$e;
$opt5 = '/E';
}

$whole = $content.' '.$keyword.' '.'R'.' '.$max.' '.$opt1.$opt2.$opt3.$opt4.$opt5.' To '.$reply_no;
//$total_msg = $description.' A)'.$a.' B)'.$b.' C)'.$c.' D)'.$d.' E)'.$e;
$total_msg = $description.$msg1.$msg2.$msg3.$msg4.$msg5.' - '.$whole;

$sms->sendSingleSMS('RSARWR',$emp_mobile1,$total_msg);

$up_sql = "update reinforcement_question_score set delivered_status=1,delivered_date=now() where q_id='$q_id' and emp_id='$emp_id'";
$up_res = mysql_query($up_sql);

}
else
{
echo "Invalid Mobile Number....";
}

}
	
}


else if($_REQUEST['bulster']=="SURVEY")
{

$sql = "select m.sid,m.description,m.option_A,m.option_B,m.option_C,m.option_D,m.option_E,s.se_id,s.emp_id,s.emp_name,s.mobile_no from survey_master m,survey_empscore s
where m.start_date<='$date' and m.end_date>='$date' and m.sid=s.sid and s.delivery_status=0 and date(m.start_date)<='$com_date' and date(m.end_date)>='$com_date'";
/*
$sql = "select m.sid,m.description,m.option_A,m.option_B,m.option_C,m.option_D,m.option_E,s.se_id,s.emp_id,s.emp_name,s.mobile_no from survey_master m,survey_empscore s
where date(end_date)>=date(now())";
*/
$rep_sql = "SELECT keyword, content, reply_no, Idendifier FROM sms_account where Idendifier='S'";
$rep_res = mysql_query($rep_sql);
$rep_row = mysql_fetch_assoc($rep_res);
$keyword = $rep_row['keyword'];
$content = $rep_row['content'];
$reply_no = $rep_row['reply_no'];
$Idendifier = $rep_row['Idendifier'];

$res = mysql_query($sql);
while($row = mysql_fetch_assoc($res))
{
$emp_mobile1 = array();
$max = $row['sid'];
$description = $row['description'];
$a = $row['option_A'];
$b = $row['option_B'];
$c = $row['option_C'];
$d = $row['option_D'];
$e = $row['option_E'];
$se_id = $row['se_id'];
$emp_id = $row['emp_id'];
$mobile_no = substr($row['mobile_no'],-7-3);
$emp_mobile = '+91'.$mobile_no;
$emp_mobile1[0] = $emp_mobile;
if(strlen($emp_mobile)==13)
{
	
echo $response = $description;

if($a!='')
{
$msg1 = ' A)'.$a;
$opt1 = 'A';
}
if($b!='')
{
$msg2 = ' B)'.$b;
$opt2 = '/B';
}
if($c!='')
{
$msg3 = ' C)'.$c;
$opt3 = '/C';
}
if($d!='')
{
$msg4 = ' D)'.$d;
$opt4 = '/D';
}
if($e!='')
{
$msg5 = ' E)'.$e;
$opt5 = '/E';
}

$whole = $content.' '.$keyword.' '.'S'.' '.$max.' '.$opt1.$opt2.$opt3.$opt4.$opt5.' To '.$reply_no;

//$total_msg = $description.' A)'.$a.' B)'.$b.' C)'.$c.' D)'.$d.' E)'.$e;
$total_msg = $description.$msg1.$msg2.$msg3.$msg4.$msg5.' - '.$whole;

$sms->sendSingleSMS('RSARWR',$emp_mobile1,$total_msg);

$up_sql = "update survey_empscore set delivery_status=1,delivered_date=now() where se_id='$se_id'";
$up_res = mysql_query($up_sql);

}
else
{
echo "Invalid Mobile Number....";
}

}
	
}

else
{
	echo "cron job not run..........";
}

?>

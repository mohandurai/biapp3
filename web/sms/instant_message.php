<?
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

$sql = "select sub.req_id,sub.question,sub.option_A,sub.option_B,sub.option_C,sub.option_D,sub.option_E,s.q_id,s.emp_id,s.mobile_no from
reinforcement_question sub,reinforcement_question_score s,reinforcement_master m where sub.start_date<'$date' and sub.end_date>'$date'
and sub.req_id = s.req_id and s.delivered_status=1 and sub.re_id=m.re_id and m.content_type='Text' and m.file_transfer_mode='SMS' and (date(sub.start_date)='$com_date' or date(sub.end_date)='$com_date') and m.re_id=48";


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
echo $total_msg = $description.$msg1.$msg2.$msg3.$msg4.$msg5.' - '.$whole;

$sms->sendSingleSMS('RSARWR',$emp_mobile1,$total_msg);

/*$up_sql = "update reinforcement_question_score set delivered_status=1,delivered_date=now() where q_id='$q_id' and emp_id='$emp_id'";
$up_res = mysql_query($up_sql);*/

}
}

?>
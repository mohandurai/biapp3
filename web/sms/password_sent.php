<?
require_once"class.smsinfini.php";
require_once"db.php";
$sms = new SMSInfini();

$sql = "SELECT id, email, password,mobile FROM users where sms_status=0";
$res = mysql_query($sql);
while($row = mysql_fetch_assoc($res))
{
$emp_mobile1 = array();
$id = $row['id'];
$password = $row['password'];
$uname = $row['email'];
$mobile_no = substr($row['mobile'],-7-3);
$emp_mobile = '+91'.$mobile_no;
$emp_mobile1[0] = $emp_mobile;

if(strlen($emp_mobile)==13)
{
$response = 'Your Login details for games.biweb.com is '.$uname.' / '.$password;
$sms->sendSingleSMS('RSARWR',$emp_mobile1,$response);
$up_sql = "update users set sms_status=1 where id='$id'";
$up_res = mysql_query($up_sql);
}
else
{
echo "Invalid Mobile Number....";
}
}
?>
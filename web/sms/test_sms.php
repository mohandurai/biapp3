<? 

date_default_timezone_set('GMT');
$temp= strtotime("+5 hours 30 minutes"); 
$date = date("Y-m-d H:i:s",$temp);
echo $date


/*require_once"class.smscountry.php";
//require_once"db.php";
$sms = new SMSCountry();
$sms->sendSingleSMS('RSARWR','+919629017893','test by sundar');

echo "passss";*/

?>
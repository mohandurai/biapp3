<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
require 'PHPMailerAutoload.php';
$email = $_REQUEST['email'];
echo"aaaa";
if(isset($_REQUEST['email']) && isset($_REQUEST['rand']))
{
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "mail.tuneem.com";
$mail->Port = 465; //465 or 587
$mail->IsHTML(true);
$mail->Username = "info@tuneem.com";//info@tuneem.com
$mail->Password = "rew@2015!";// rew@2015!
$mail->SetFrom("info@tuneem.com");
$mail->Subject = "OTP for Chappie App Registration";
$mail->Body = "Hi, <br><br>Please use the following OTP to complete the registration.<br><br>".$_REQUEST['rand']."<br><br>Thanks,<br><br>Best Regards Chappie Team";
$mail->AddAddress($_REQUEST['email']);
if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
echo "Message has been sent";
}
echo "Mail Sent...";
}

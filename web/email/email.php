<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
require 'PHPMailerAutoload.php';
$email = $_REQUEST['email'];



if(isset($_REQUEST['email']) && isset($_REQUEST['token']))
{

include("email_config.php");
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = $host;
$mail->Port = $port; //465 or 587
$mail->IsHTML(true);
$mail->Username = $username;//info@tuneem.com
$mail->Password = $password;// rew@2015!
$mail->SetFrom($from);
$mail->Subject = "Password Reset Form";
$mail->Body = "<img src='http://tuneem.com/tuneem/web/assets/6c641bd3/admin-lte/img/rsa.png' width='100px' hieght='100px'/> <br>Hi ".$_REQUEST['username'].", <br><br> Follow the link below to reset your password: <br> ".$_REQUEST['url']."&token=".$_REQUEST['token'];
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

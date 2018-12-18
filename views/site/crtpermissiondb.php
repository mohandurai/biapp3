
<?

$_SESSION['userid'] = @Yii::$app->user->identity->id ;
$password=$_REQUEST['password'];
 $crtid=$_REQUEST['crtid'];
 $empid=$_REQUEST['empid'];
 $crtidsession=$_REQUEST['crtidsession'];

 $infocnt = Yii::$app->db->createCommand('SELECT session_password FROM crt_sessions_pass where crt_id="'.$crtid.'" and session_id="'.$crtidsession.'" and session_password="'.$password.'"')->queryAll();

if(isset($infocnt[0]['session_password']))
{
echo "correct";
}
else
{
echo "notcorrect";
}                               



?>

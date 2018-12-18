
<?

$_SESSION['userid'] = @Yii::$app->user->identity->id ;
$sessiontypeid=$_REQUEST['cstid'];
$password=$_REQUEST['password'];
 $crtid=$_REQUEST['crtid'];
 $empid=$_REQUEST['empid'];
 $crtidsession=$_REQUEST['crtidsession'];

 $infocnt = Yii::$app->db->createCommand('SELECT session_id FROM crt_session_type_pass where crt_id="'.$crtid.'" and session_id="'.$crtidsession.'" and session_type_id="'.$sessiontypeid.'" and 	session_type_password="'.$password.'"')->queryAll();

if(isset($infocnt[0]['session_id']))
{
echo "correct";
}
else
{
echo "notcorrect";
}                               



?>

<? 
session_start();
require_once "privateteststatus_web.php";

/*echo $_SESSION['login'].'<br>';
echo $_SESSION['id'].'<br>';
echo $_SESSION['timestamp'].'<br>';
echo $_SESSION['akey'].'<br>';*/


   if($_REQUEST['module']=='esn')
	{

         $log_function1 = coursedetails($_REQUEST['course_id']);
      
         echo $log_function1;
        
         exit;
	}
	else
	{
		$response = '{"message":{"success":"false","message":"invalid module"}}';
		echo $response;
		logout();
		exit;
	}










?>
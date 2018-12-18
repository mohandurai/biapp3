<? 
session_start();
require_once "userstatus.php";

/*echo $_SESSION['login'].'<br>';
echo $_SESSION['id'].'<br>';
echo $_SESSION['timestamp'].'<br>';
echo $_SESSION['akey'].'<br>';*/


   if($_REQUEST['course_id']!='')
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
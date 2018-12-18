<? 
session_start();

require_once "privateweb_func.php";

/*echo $_SESSION['login'].'<br>';
echo $_SESSION['id'].'<br>';
echo $_SESSION['timestamp'].'<br>';
echo $_SESSION['akey'].'<br>';*/

$empid=$_REQUEST['empid'];
$status=$_REQUEST['status'];
   if($_REQUEST['module']=='esn')
	{

         $log_function1 = coursedetails($empid,$status);
      
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

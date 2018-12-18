<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile; 
use yii\web\ForbiddenHttpException;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use  app\models\DealershipMaster;

use app\models\PasswordForm;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;


use yii\data\SqlDataProvider;
require_once "db.php";
$logid = @Yii::$app->user->identity->id;
$role = @Yii::$app->user->identity->role;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


    public function actionGeolist()
    {
        $pin=$_POST['pincode'];
        //echo $country=$_POST['categoryitemid'];
        // $subject_id =$subject; 
        //$tough_id=$tough;
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('select * from geography_master where pincode='.$pin.'');
        $res = $sql->queryAll();
        echo json_encode($res);
        return ;
    }


  /** Mohan Durai getting Role based users
     * Lists all User models.
     * @return mixed
     */

	public function actionGetrolebasedusers($rid)
	{
		$gselsql = "select id, first_name as username from user where role='" . $rid ."'";
		$categ_val = Yii::$app->db->createCommand($gselsql)->queryAll();
		//return $gselsql;
		return json_encode($categ_val,true);
	}

	public function showFewLines($data,$row)
	{
		$allData=$data->role;
		return substr($allData, '_', -1);
	}

    	public function actionChange_password()
	{
        	$model = new PasswordForm;
        	$uname=!empty($_GET['username'])?$_GET['username']:Yii::$app->user->identity->username;
        	$modeluser = User::find()->where([ 'username'=>$uname ])->one();
     
        	if($model->load(Yii::$app->request->post()))
		{
            		if($model->validate())
			{
                		try
				{
                    			echo $_GET['username'];
                    			$modeluser->password = $_POST['PasswordForm']['newpass'];             
                    			if($modeluser->save())
					{
                        			Yii::$app->getSession()->setFlash( 'success','Password changed' );
                        			if(Yii::$app->user->identity->role=='admin')
                        			return $this->redirect(['index']);
                        			else
                            			return $this->redirect(['/site/index']);
                        			// return $this->redirect(['index']);
                    			}
					else
					{
                        			echo $modeluser->getErrors();
                        			var_dump($modeluser->getErrors());
                       				die();
                        			Yii::$app->getSession()->setFlash( 'error','Password not changed' );
                    			}
                		}
				catch(Exception $e)
				{
                    			Yii::$app->getSession()->setFlash( 'error',"{$e->getMessage()}" );
                    			return $this->render('resetpass',[ 'model'=>$model ]);
                		}
            		}
			else
			{
                		return $this->render('change_password',[ 'model'=>$model ]);
            		}
        	}
		else
		{
            		return $this->render('change_password',[ 'model'=>$model ]);
        	}
    	}


    /**
     * Lists all User models.
     * @return mixed
     */
	public function actionIndex()
    	{
        	$searchModel = new UserSearch();
        	//$dataProvider = $searchModel->search(Yii::$app->request->post());
            // print_r(Yii::$app->request->queryParams);die;
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        	return $this->render('index', [
            		'searchModel' => $searchModel,
           		'dataProvider' => $dataProvider,
        	]);
    	}

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    	public function actionView($id)
    	{
        	return $this->render('view', [
            	'model' => $this->findModel($id),
        	]);
    	}

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    	public function actionCreate()
    	{
        	$model = new User();  
        	if ($model->load(Yii::$app->request->post())) 
		{
	      		$model->save(false);
            		return $this->redirect(['view', 'id' => $model->id]);
        	}
		else
		{
			return $this->redirect('index.php?r=site/createuser');

		      /* return $this->render('create', [createuser
		        'model' => $model,
		    ]);*/
        	}
    	}

   	public function actionReporttolist()
	{
       		$interviewerroles   =   $_POST['depdrop_all_params'];
       		$userLists     =   User::find()->select('id, first_name')->where(['role' => $interviewerroles['user-reports_to_role']])->all();
        
        	foreach ($userLists as $userList)
		{
            		$out[]= ['id' => $userList->id,'name' => $userList->first_name];  
        	}      

        	return json_encode(['output' => $out,'Selected'=>1]);
    	}
    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
       public function actionUpdate($id)
    	{
		$model = $this->findModel($id);	
		$model1 = new User();
		$model->password="pass@123";
		
			//$role = Yii::$app->request->post()['User']['db'] . "_" . Yii::$app->request->post()['User']['role'];

		//echo $role;
		//echo "<pre>";
		//print_r($_POST);
		//exit;
		 //$rolecheck = substr($role, 1);
		//echo $role[0]; 
		$role = $model->role;
		if($role[0]==6)
		{
			$model->usergroup=1;
		}
		else
		{
			$model->usergroup=$model->usergroup;
		}
       		if ($model->load(Yii::$app->request->post())&& $model->validate())
		{       
			$model->dealership = implode(',', $model->dealership);
            $model->save();
			//echo $model->usergroup; 		
			$model->file =UploadedFile::getInstances($model,'upload_image');
    			//print_r($model->file =UploadedFile::getInstances($model,'upload_image'));

  			$sql2="update auth_assignment set item_name='".$model->role."' where user_id='$id'";

                  	Yii::$app->db->createCommand($sql2)->execute(); 

   			foreach ($model->file as $file)
			{
               			$file1 ='profile/'.$file->name;              
 				$file->saveAs('profile/'.$file->name);
                	} 

           		$sql="update user set profile_image_url='$file1' where id='$id'";
                  	Yii::$app->db->createCommand($sql)->execute(); 
                
                        if($_POST['User']['date_of_leaving'] != '')
                        {
$to='';
$to=array();

$dp=Yii::$app->user->identity->dealership;
//$sql=mysql_query("select * from user where dealership='$dp' and status='Active' and audiindiauser='1'");
$sql=mysql_query("select * from user where role='admin'");
while($r=mysql_fetch_array($sql))
{

 $email=$r['email'];
array_push($to,$email);
}
$emp=$model->first_name.$model->last_name;
$text='Exit Interview for '.$emp.' will be conducted on '.$_POST['User']['date_of_leaving'].'';

    $mailer = Yii::$app->mailer->compose()
           
            ->setFrom('audi@rsalesarm.org')
      	    ->setTo(array('Akash@rsalesarm.com','rakesh@rsalesarm.com','regagandhi@rewire.co.in'))
            ->setSubject('Exit Interview By'.$emp)
            ->setTextBody($text);
          //  ->setCc($to); 
    if($mailer->send()){
    
return $this->redirect(['view', 'id' => $model->id]);
    }
  return $this->redirect(['view', 'id' => $model->id]);
                        
                         }
            		return $this->redirect(['view', 'id' => $model->id]);
        	}
		else
		{
            		return $this->render('update', [ 'model' => $model,    ]);
        	}
    	}

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
	$today = date("Y-m-d");  
	$date = strtotime($today);
	$logid = @Yii::$app->user->identity->id;        
//$this->findModel($id)->delete();
	 $deletesql="update user set status='InActive' where id='$id'";
         Yii::$app->db->createCommand($deletesql)->execute(); 

 	$rejoinsql="insert into rejoin_user(id, username, created_by, created_date) values('$id','$models->username','$logid','$today')";
        Yii::$app->db->createCommand($rejoinsql)->execute(); 
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
public function actionExport()
    {
$db_record = 'user';
// optional where query
//$where = 'WHERE 1 ORDER BY 1';
// filename for export
$csv_filename = 'User'.date('Y-m-d').'.xls';
// database variables

$csv_export = '';
// query to get data from database
$query = mysql_query("SELECT * FROM ".$db_record."");
$field = mysql_num_fields($query);
// create line with field names
for($i = 0; $i < $field; $i++) {
  $csv_export.= mysql_field_name($query,$i).';';
}
// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';
// loop through database query and fill export variable
while($row = mysql_fetch_array($query)) {
  // create line with field values
  for($i = 0; $i < $field; $i++) {
    $csv_export.= '"'.$row[mysql_field_name($query,$i)].'";';
  }	
  $csv_export.= '
';	
    }
// Export the data and prompt a csv file for download
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);
}
}

<?php

namespace app\controllers;

use Yii;
use app\models\UserGroupMaster;
use app\models\UserGroupMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ContentMaster;
use app\models\ModuleMasters;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\db\Query;
use yii\helpers\Url;
use app\models\DealershipMaster;
use app\models\DepartmentMaster;
use app\models\AuthItem;

/**
 * UserGroupMasterController implements the CRUD actions for UserGroupMaster model.
 */
class UserGroupMasterController extends Controller
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

    /**
     * Lists all UserGroupMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserGroupMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserGroupMaster model.
     * @param integer $id
     * @return mixed
     */

     public function actionItemlist()
    {

   	// $results=ArrayHelper::map(DealershipMaster::find()->all(),'dealership_id','dealership_name');

   	//$results=ArrayHelper::map(DepartmentMaster::find()->all(),'department_id','department_name');
        $out = [];

    	if (isset($_POST['depdrop_parents']))
	{
    		$id = end($_POST['depdrop_parents']);
    		if($id == 1)
		{
       			$list  =ArrayHelper::map(DepartmentMaster::find()->all(),'department_id','department_name');
    		}
		elseif($id == 3)
		{    
   			$list=ArrayHelper::map(DealershipMaster::find()->all(),'dealership_id','dealership_name');
		}
		else
		{
 			$list=ArrayHelper::map(AuthItem::find()->andWhere(['type' => 1])->all(),'name','name');
		} 
	}        
        foreach($list as $k=>$v)
        {
        	$out[] = ['id' => $k ,'name' => $v];
        }    

       	echo json_encode(['output' => $out, 'selected'=>1 ]);
     	return ;
        
    }

     public function actionRolelist()
     {
   	 //$cid = Yii::$app->request->post()['UserGroupMaster']['role'];       

    	switch($_REQUEST['category'])
    	{    
    		case "3":
    			$field="dealership";    
   			 break;
    
    		case "1":
        		$field="department";
    			break;
    
    		case "2":    
    			$field="role";
    			break;

    	}
	$names = $_REQUEST['categoryitemid'];
	if(is_array($names))
	{
 		$names='"'.implode('", "', $names).'"';
	}
	else
	{
		$names='"'.$names.'"';
	}
	$connection = \Yii::$app->db;
	$sql = $connection->createCommand('SELECT id as `index`,username as name FROM user where '.$field.' in ('.$names.')');
	$res = $sql->queryAll();
	return json_encode($res,true);
}



    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

	public function actionModitems() 
	{
         	$out = [];   
    		/*for($k=1;$k<= end($_POST['depdrop_parents']);$k++)
		    {
		    $out[] = ['id' => $k, 'name' => $k];
		    }*/
		$mod = $_POST['depdrop_params'][0];    
		$modname="\app\models\\". $modname1;

    		$query= $modname::find();  
    		$mod_prim_fields=$modname::select_fields();
    
    
    		$modresults=ArrayHelper::map($query->where(["status"=>"New"])->all(),$mod_prim_fields[0],$mod_prim_fields[1]);
    
    		foreach($modresults as $k=>$v)
    		{
    			$out[] = ['id' => $k, 'name' => $v];
    		}

    		//print_r($out);
    
	    /*$out = [
		['id'=>244, 'name'=>ArrayHelper::map(\app\models\InfonuggetsMaster::find()->all(),'infonuggets_id','subject_id')],
		['id'=>245, 'name'=>''],
	       
	    ];*/

        	echo json_encode(['output' => $out, 'selected'=>1 ]);
 		return ;
    
	}

    /**
     * Creates a new UserGroupMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

	public function actionCreate()
    	{
        	$model = new UserGroupMaster();
   		if ($model->load(Yii::$app->request->post()))
		{                 
            		$model->save(false);
                	$id = Yii::$app->db->getLastInsertID();
              		$sql="insert user_group_assign(group_id,emp_id) select ".$id." as group_id, u.id from user u where u.id in(".trim(Yii::$app->request->post()['UserGroupMaster']['users'],"[]").")";

  			Yii::$app->db->createCommand($sql)->execute();
            		return $this->redirect(['view', 'id' => $model->group_id]);
        	}
		else
		{
            		return $this->render('create', ['model' => $model,]);
        	}
    	}

    /**
     * Updates an existing UserGroupMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $sql = Yii::$app->db->createCommand('SELECT emp_id from user_group_assign where group_id='.$id);
    	$role = $sql->queryColumn();

        if ($model->load(Yii::$app->request->post()) && $model->save())
	{
		$sql3 = "DELETE FROM `user_group_assign` WHERE group_id=".$id;
            	Yii::$app->db->createCommand($sql3)->execute();
		$sql="insert user_group_assign(group_id,emp_id) select ".$id." as group_id, u.id from user u where u.id in(".trim(Yii::$app->request->post()['UserGroupMaster']['users'],"[]").")";

  		Yii::$app->db->createCommand($sql)->execute();

            	return $this->redirect(['view', 'id' => $model->group_id]);
        }
	else
	{
            return $this->render('update', [ 'model' => $model, 'selected_users' => $role, ]);
        }
    }

    /**
     * Deletes an existing UserGroupMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserGroupMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserGroupMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserGroupMaster::findOne($id)) !== null)
	{
            return $model;
        }
	else
	{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

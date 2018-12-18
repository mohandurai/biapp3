<?php

namespace app\controllers;

use Yii;
use app\models\RelatedLists;
use app\models\RelatedListsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RelatedListsController implements the CRUD actions for RelatedLists model.
 */
class RelatedListsController extends Controller
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
     * Lists all RelatedLists models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RelatedListsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RelatedLists model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RelatedLists model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RelatedLists();

        if ($model->load(Yii::$app->request->post()) ) {
            
         

            print_r(Yii::$app->request->post());
//$display_columns=explode(",",$model->display_columns);

//$second_table=$model->second_table;

//$display_columns = array_map(function ($str) use ($second_table) { return $second_table.".$str"; }, $display_columns);


//$display_columns=implode(",",$display_columns);


//$model->query= "select $display_columns from ".$model->first_table.",".$model->second_table." where ".$model->first_table.".".$model->first_table_key."=".$model->second_table.".".$model->second_table_key." and ".$model->first_table.".".$model->first_table_key."=";

$modname = preg_match('/\w+/',$model->model_name,$matches);

$modname = preg_split('/(?=[A-Z])/',$matches[0]);



  $str="";
  $newmodname= array();

  for($i=1; $i < sizeof($modname); $i++ )
  {
  $str=strtolower($modname[$i]);
  $newmodname[]=$str;
  }

    $model->controller = implode("-",$newmodname);          

echo "</pre>";




	    $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionColumns()
    {
	
$tblname=$_POST['table'];
$connection = \Yii::$app->db;
$sql = $connection->createCommand("show columns from $tblname");
$res = $sql->queryAll();
$i=0;
foreach($res as $k=>$v)
{

$records[$i]['id']=$v['Field'];
$records[$i]['text']=$v['Field'];

$i++;
}  


return json_encode($records,true);
	

}


    /**
     * Updates an existing RelatedLists model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

	$modname = preg_match('/\w+/',$model->model_name,$matches);

$modname = preg_split('/(?=[A-Z])/',$matches[0]);



  $str="";
  $newmodname= array();

  for($i=1; $i < sizeof($modname); $i++ )
  {
  $str=strtolower($modname[$i]);
  $newmodname[]=$str;
  }

    $model->controller = implode("-",$newmodname);    
$model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RelatedLists model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RelatedLists model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return RelatedLists the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RelatedLists::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace app\controllers;

use Yii;
use app\models\GeographyMaster;
use app\models\GeographyMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GeographyMasterController implements the CRUD actions for GeographyMaster model.
 */
class GeographyMasterController extends Controller
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
     * Lists all GeographyMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GeographyMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GeographyMaster model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
 public function actionUserlist()
    {
	$pincode=$_POST['category'];
	//echo $country=$_POST['categoryitemid'];
	// $subject_id =$subject; 
  //$tough_id=$tough;
  $connection = \Yii::$app->db;
$sql = $connection->createCommand('SELECT  geo_id,state, city,area,territory FROM geography_master where pincode='.$pincode.' ');
$res = $sql->queryAll();
/*

print_r($result);
$i=0;
foreach($result as $k=>$v)
{

 $final[$i]['id']=$k;
$final[$i]['name']=$v;
$i++;
}*/
//print_r($final);die;

    // echo json_encode(['output' => $final]);
	 echo json_encode($res);
		//echo  $final;
 return ;
	}
    /**
     * Creates a new GeographyMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GeographyMaster();

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'id' => $model->geo_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GeographyMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            return $this->redirect(['view', 'id' => $model->geo_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GeographyMaster model.
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
     * Finds the GeographyMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GeographyMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeographyMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

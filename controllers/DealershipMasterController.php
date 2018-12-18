<?php

namespace app\controllers;

use Yii;
use app\models\DealershipMaster;
use app\models\DealershipMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DealershipMasterController implements the CRUD actions for DealershipMaster model.
 */
class DealershipMasterController extends Controller
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
     * Lists all DealershipMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DealershipMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DealershipMaster model.
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
     * Creates a new DealershipMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DealershipMaster();

       if ($model->load(Yii::$app->request->post())) {
        $alert=$_POST['DealershipMaster']['segment'];
    if(is_array($alert))
	{
    		$model->segment= implode(',', $alert); 
 	}
        $model->audi_sales=$_POST["audi_sales"];
        $model->location_number=$_POST['DealershipMaster']['external_city_id'];
        $model->save(); 
 Yii::$app->session->setFlash('success', 'DealershipMaster Saved Successfully.');
            return $this->redirect(['view', 'id' => $model->dealership_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DealershipMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
 if ($model->load(Yii::$app->request->post())) {
        $alert=$_POST['DealershipMaster']['segment'];
        if(is_array($alert))
	{
    		$model->segment= implode(',', $alert); 
 	}
       $model->audi_sales=$_POST["audi_sales"];
 $model->location_number=$_POST['DealershipMaster']['external_city_id'];
        $model->save(); 
         Yii::$app->session->setFlash('success', 'DealershipMaster Update Successfully.');
            return $this->redirect(['view', 'id' => $model->dealership_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DealershipMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
 Yii::$app->session->setFlash('success', 'DealershipMaster Delete Successfully.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the DealershipMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DealershipMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DealershipMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

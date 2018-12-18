<?php

namespace app\controllers;

use Yii;
use app\models\CompanyMaster;
use app\models\CompanyMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * CompanyMasterController implements the CRUD actions for CompanyMaster model.
 */
class CompanyMasterController extends Controller
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
     * Lists all CompanyMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanyMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyMaster model.
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
     * Creates a new CompanyMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyMaster();

        //if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
		
         //   return $this->redirect(['view', 'id' => $model->company_id]);
    //    }
		if ($model->load(Yii::$app->request->post())) {
		
          $model->created_date = time();
         $model->modified_date = time();
           if ($model->save(false)) {  

 
			/*$connection = \Yii::$app->db;
			$id=$model->company_id;
			$emp_code='CMP'.$id;
			$sql='update company_master set company_code=:company_code where company_id=:company_id';
			$command=$connection->createCommand($sql);
			$command->bindParam(":company_code",$emp_code);
			$command->bindParam(":company_id",$id);
			$command->execute();   */
       
			return $this->redirect(['view', 'id' => $model->company_id]);   


           } 
        } 
		 else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CompanyMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->company_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CompanyMaster model.
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
     * Finds the CompanyMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CompanyMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

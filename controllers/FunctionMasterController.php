<?php

namespace app\controllers;

use Yii;
use app\models\FunctionMaster;
use app\models\FunctionMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * FunctionMasterController implements the CRUD actions for FunctionMaster model.
 */
class FunctionMasterController extends Controller
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
     * Lists all FunctionMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FunctionMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FunctionMaster model.
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
     * Creates a new FunctionMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FunctionMaster();

      // if ($model->load(Yii::$app->request->post()) && $model->save()) {
         //   return $this->redirect(['view', 'id' => $model->function_id]);
      //  } 
		if ($model->load(Yii::$app->request->post())) {
		
          $model->created_date = time();
         $model->modified_date = time();
           if ($model->save(false)) {   
		       $connection = \Yii::$app->db;
                $id=$model->function_id;
				$emp_code='FUN'.$id;
                $sql='update function_master set function_code=:function_code where function_id=:function_id';
                $command=$connection->createCommand($sql);
                $command->bindParam(":function_code",$emp_code);
                $command->bindParam(":function_id",$id);
                $command->execute();          
              return $this->redirect(['view', 'id' => $model->function_id]);
           } 
        } 
		else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FunctionMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->function_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FunctionMaster model.
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
     * Finds the FunctionMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return FunctionMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FunctionMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

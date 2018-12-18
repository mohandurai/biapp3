<?php

namespace app\controllers;

use Yii;
use app\models\SubCompetencyMaster;
use app\models\SubCompetencyMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubCompetencyMasterController implements the CRUD actions for SubCompetencyMaster model.
 */
class SubCompetencyMasterController extends Controller
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
     * Lists all SubCompetencyMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubCompetencyMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SubCompetencyMaster model.
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
     * Creates a new SubCompetencyMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SubCompetencyMaster();



          if ($model->load(Yii::$app->request->post())) 
		{
           
			if(!$model->save())
			 {
				echo 'Error to save Lead model<br />';
				   var_dump($model->getErrors());
			 }
			else
			{
			    $model->save();
				$connection=Yii::$app->db;
		                $id=$model->subcompetency_id;
				$subcompetency_code='SCT'.$id;
                $sql='update sub_competency_master set subcompetency_code=:subcompetency_code where subcompetency_id=:subcompetency_id';
                $command=$connection->createCommand($sql);
                $command->bindParam(":subcompetency_code",$subcompetency_code);
                $command->bindParam(":subcompetency_id",$id);
                $command->execute();
 Yii::$app->session->setFlash('success', 'SubCompetencyMaster Saved Successfully.');
			return $this->redirect(['view', 'id' => $model->subcompetency_id]);
			}
                } 
             else 
		{
            return $this->render('create', ['model' => $model, ]);
       		 }

    }

    /**
     * Updates an existing SubCompetencyMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
Yii::$app->session->setFlash('success', 'SubCompetencyMaster Update Successfully.');
            return $this->redirect(['view', 'id' => $model->subcompetency_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SubCompetencyMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
Yii::$app->session->setFlash('success', 'SubCompetencyMaster Delete Successfully.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the SubCompetencyMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SubCompetencyMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubCompetencyMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace app\controllers;

use Yii;
use app\models\ChannelMaster;
use app\models\ChannelMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChannelMasterController implements the CRUD actions for ChannelMaster model.
 */
class ChannelMasterController extends Controller
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
     * Lists all ChannelMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChannelMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ChannelMaster model.
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
     * Creates a new ChannelMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ChannelMaster();

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
		                $id=$model->channel_id;
				$channel_code='CHA'.$id;
                $sql='update channel_master set channel_code=:channel_code where channel_id=:channel_id';
                $command=$connection->createCommand($sql);
                $command->bindParam(":channel_code",$channel_code);
                $command->bindParam(":channel_id",$id);
                $command->execute();

			return $this->redirect(['view', 'id' => $model->channel_id]);
			}
                } 
             else 
		{
            return $this->render('create', ['model' => $model, ]);
       		 }
		
    }

    /**
     * Updates an existing ChannelMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->channel_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ChannelMaster model.
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
     * Finds the ChannelMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ChannelMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ChannelMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

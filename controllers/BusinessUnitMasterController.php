<?php

namespace app\controllers;

use Yii;
use app\models\BusinessUnitMaster;
use app\models\BusinessUnitMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * BusinessUnitMasterController implements the CRUD actions for BusinessUnitMaster model.
 */
class BusinessUnitMasterController extends Controller
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
     * Lists all BusinessUnitMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BusinessUnitMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BusinessUnitMaster model.
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
     * Creates a new BusinessUnitMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
			$model = new BusinessUnitMaster();

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
                $dealerid = Yii::$app->db->getLastInsertID();
                $userid=Yii::$app->user->id;
                $sqldealer="update user set dp='.$dealerid.' where id='.$userid.'";
                $command=$connection->createCommand($sqldealer);
                $id=$model->bunit_id;
				$business_unit_code='BU'.$id;
                $sql='update business_unit_master set business_unit_code=:business_unit_code where bunit_id=:bunit_id';
                $command=$connection->createCommand($sql);
                $command->bindParam(":business_unit_code",$business_unit_code);
                $command->bindParam(":bunit_id",$id);
                $command->execute();

			return $this->redirect(['view', 'id' => $model->bunit_id]);
						}
	         	           }
		                 else 
                                   {
						return $this->render('create', [
						'model' => $model,  ]);
				   }
		
  /*       if ($model->load(Yii::$app->request->post()) && $model->save()) 
            {
                   return $this->redirect(['view', 'id' => $model->bunit_id]);
            } 
			else 
			{
					return $this->render('create', [
					'model' => $model,
					]);
             } */
    }

    /**
     * Updates an existing BusinessUnitMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bunit_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BusinessUnitMaster model.
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
     * Finds the BusinessUnitMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return BusinessUnitMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BusinessUnitMaster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

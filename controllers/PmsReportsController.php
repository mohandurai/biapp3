<?php

/*

  Audineev Version 1
  Author          : biweb IT Services Pvt. Ltd.
  Developed By    : Mohan Durai
  Verified By     : 
  Change Log      : 12-08-16

  Purpose : This controller code for creating PMS Reports

*/


namespace app\controllers;

use Yii;
//use app\models\MdRepfilter;
//use app\models\MdRepfilterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MdRepfilterController implements the CRUD actions for MdRepfilter model.
 */
class PmsReportsController extends Controller
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
     * Lists all MdRepfilter models.
     * @return mixed
     */
    public function actionPmsreports()
    {
        return $this->render('pmsreports');
    }

	public function actionPmsreports2()
    {
        return $this->render('pmsreports2');
    }

    public function actionInvreport()
    {
        return $this->render('invreport');
    }

    public function actionUsgreport()
    {
        return $this->render('usgreport');
    }

    /**
     * Displays a single MdRepfilter model.
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
     * Creates a new MdRepfilter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MdRepfilter();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MdRepfilter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MdRepfilter model.
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
     * Finds the MdRepfilter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MdRepfilter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MdRepfilter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

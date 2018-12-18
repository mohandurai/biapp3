<?php

namespace app\controllers;

use Yii;
use app\models\RecruitmentStatus;
use app\models\RecruitmentStatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RecruitmentStatusController implements the CRUD actions for RecruitmentStatus model.
 */
class RecruitmentStatusController extends Controller
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
     * Lists all RecruitmentStatus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecruitmentStatusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPopup()
    {
        return $this->renderPartial('popup');
    }

    /**
     * Displays a single RecruitmentStatus model.
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
     * Creates a new RecruitmentStatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RecruitmentStatus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Ja_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RecruitmentStatus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
 
        if ($model->load(Yii::$app->request->post()) && $model->save()) {



        if(Yii::$app->request->post()['RecruitmentStatus']['status1']!="Selected")
        {

               return $this->redirect(['view', 'id' => $model->Ja_id]);
        }else
        {

$sql1 = Yii::$app->db->createCommand('SELECT * FROM oac_jobapplicant WHERE Ja_id="'.$model->Ja_id.'"')->queryAll();
       
            $jd=$sql1[0]['JobID'];
           
          


           return $this->redirect(array('site/signup','jd'=>$jd,'appid'=>$model->Ja_id));



        }

         
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RecruitmentStatus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
public function actionDateofjoinig()
    {
        return $this->renderPartial('dateofjoinig');
    }
    /**
     * Finds the RecruitmentStatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RecruitmentStatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RecruitmentStatus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

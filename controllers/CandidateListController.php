<?php

namespace app\controllers;

use Yii;
use app\models\CandidateList;
use app\models\CandidateListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CandidateListController implements the CRUD actions for CandidateList model.
 */
class CandidateListController extends Controller
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
     * Lists all CandidateList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CandidateListSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexselected()
    {
        $searchModel = new CandidateListSearch();
        $searchModel->isselected=true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexselected', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CandidateList model.
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
     * Creates a new CandidateList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CandidateList();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->resumefile = UploadedFile::getInstance($model, 'resumefile');

            if($model->save()){
                if($model->resumefile){

                    if($model->resumefile->saveAs('uploads/' .$model->id. $model->resumefile->baseName . '.' . $model->resumefile->extension)){
                        $sql2="delete from `documentsupload` where module='CandidateList' and modid=".$model->id;
                        Yii::$app->db->createCommand($sql2)->execute();

                        $parameters[] = array(':module'=>'CandidateList', ':filepath' =>'uploads/' .$model->id. $model->resumefile->baseName . '.' . $model->resumefile->extension,':filename'=>$model->id.$model->resumefile->baseName . '.' . $model->resumefile->extension, 
                ":modid"=>$model->id,":mime_type"=>$model->resumefile->extension);
                        Yii::$app->db->createCommand()->batchInsert('documentsupload', ['module','filepath','filename','modid','mime_type'], $parameters)->execute();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                    else{
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }

                }
                else{
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                
            }
            else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CandidateList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
$model->resumefile = UploadedFile::getInstance($model, 'resumefile');

            if($model->save()){
                if($model->resumefile){

                    if($model->resumefile->saveAs('uploads/' .$model->id. $model->resumefile->baseName . '.' . $model->resumefile->extension)){
                        $sql2="delete from `documentsupload` where module='CandidateList' and modid=".$model->id;
                        Yii::$app->db->createCommand($sql2)->execute();

                        $parameters[] = array(':module'=>'CandidateList', ':filepath' =>'uploads/' .$model->id. $model->resumefile->baseName . '.' . $model->resumefile->extension,':filename'=>$model->id.$model->resumefile->baseName . '.' . $model->resumefile->extension, 
                ":modid"=>$model->id,":mime_type"=>$model->resumefile->extension);
                        Yii::$app->db->createCommand()->batchInsert('documentsupload', ['module','filepath','filename','modid','mime_type'], $parameters)->execute();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                    else{
                        return $this->render('update', [
                            'model' => $model,
                        ]);
                    }

                }}
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CandidateList model.
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
     * Finds the CandidateList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CandidateList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CandidateList::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

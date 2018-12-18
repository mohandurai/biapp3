<?php

namespace app\controllers;

use Yii;
use app\models\MenuAllocation;
use app\models\MenuAllocationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\ForbiddenHttpException;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\SubcategoryMaster;
use app\models\BiMenus;
/**
 * MenuAllocationController implements the CRUD actions for MenuAllocation model.
 */
class MenuAllocationController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MenuAllocation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuAllocationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MenuAllocation model.
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
     * Creates a new MenuAllocation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MenuAllocation();


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
             $interviewerroles =  $model->parentmenu;
            $model->parentmenu   =   implode(",",json_decode($interviewerroles));
            $interviewerroles1 =  $model->childmenu;
            $model->childmenu   =   implode(",",json_decode($interviewerroles1));
           
             $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MenuAllocation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $interviewerroles =  $model->parentmenu;
            $model->parentmenu   =   implode(",",json_decode($interviewerroles));
            $interviewerroles1 =  $model->childmenu;
            $model->childmenu   =   implode(",",json_decode($interviewerroles1));
           
             $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MenuAllocation model.
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
     * Finds the MenuAllocation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MenuAllocation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MenuAllocation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     

         public function actionParent(){
        $interviewerroles   =  $_POST['interviewer_role'];
         if(!empty($interviewerroles)){
       $userLists     =   BiMenus::find()->select('id, title')->where(['category' => $interviewerroles,'parent_id'=>0])->all();
        //var_dump($candidateLists);
        foreach ($userLists as $userList) {
            echo "<option value='".$userList->id."'>".$userList->title."</option>";
        }
        return ;}
    }
     public function actionChild(){

        $interviewerroles   =json_decode($_POST['parentmenu']);
        if(!empty($interviewerroles)){
       $userLists     =   BiMenus::find()->select('id, title')->where(['parent_id' => $interviewerroles])->all();
        //var_dump($candidateLists);
        foreach ($userLists as $userList) {
            echo "<option value='".$userList->id."'>".$userList->title."</option>";
        }
        return ;}
    }
}

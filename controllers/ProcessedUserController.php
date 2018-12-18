<?php

namespace app\controllers;

use Yii;
use app\models\ProcessedUser;
use app\models\UserPImport;
use app\models\ProcessedUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * ProcessedUserController implements the CRUD actions for ProcessedUser model.
 */
class ProcessedUserController extends Controller
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
     * Lists all ProcessedUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProcessedUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProccesuser(){
        
        $models         = ProcessedUser::find()->andWhere(['processed_status'=>0])->all();
        $totalusrcnt    = ArrayHelper::map($models,'id','id');
        
        $k=0;
        $rows = [];        
        $succeessusrcnt =[];
        $failusrcnt =[];
        //$notprocessusrcnt =[];
        while (!empty($models)) {
            $models = ProcessedUser::find()->andWhere(['processed_status'=>'0'])->innerJoin('user','user.username=processed_user.reports_to')->select(['`processed_user`.*, `user`.id as userid, `user`.role as userrerole'])->all();
            if(!empty($models)){
                foreach ($models as $model) {
                    $user  = new UserPImport;
                    $user->attributes=$model->attributes;
                    $user->department = $model->departmentMaster->department_id;
                    $user->businessunit = $model->bunitMaster->bunit_id;
                    $user->role = $user->businessunit.'_'.$model->roleMaster->neev_designation;
                    $user->neev_designation = $model->roleMaster->id;
                    $user->dealership = ''.$model->dealershipMaster->dealership_id;
                    $user->reports_to = $model->userid;
                    $user->reports_to_role = $model->userrerole;
                    $user->validator = '';
                    $user->dp = $user->businessunit;
                    $model->audiindiauser='0';
                    
                    
                    if($user->validate()){
                        //array_push($succeessusrcnt, $model->id);
                        $succeessusrcnt[$model->id]=$model->id;
                        $rows[]=$user->attributes;
                        $user->save();
                        $model->processed_status='1';
                        $model->save(false);
                    }
                    else{
                        $model->processed_status='3';
                        $model->processed_status_message = json_encode($user->getErrors());
                        $model->save(false);
                        //array_push($failusrcnt, $model->id);
                        $failusrcnt[$model->id]=$model->id;
                        //echo $user->username.', ';
                        //var_dump($user->getErrors());
                    }
                }

                
            }            
            $k++;
            
            if($k==10)
            {
                break;
            }
        }
        
        $notprocessusrcnt = ArrayHelper::map(ProcessedUser::find()->andWhere(['processed_status'=>0])->all(),'id','id');
        ProcessedUser::updateAll(['processed_status' => '4','processed_status_message'=>'Invalid Reports to.'], 'processed_status = "0"');
        $resuls=['totalusrcnt'=>$totalusrcnt,'succeessusrcnt'=>$succeessusrcnt,'failusrcnt'=>$failusrcnt,'notprocessusrcnt'=>$notprocessusrcnt,'ctotalusrcnt'=>count($totalusrcnt),'csucceessusrcnt'=>count($succeessusrcnt),'cfailusrcnt'=>count($failusrcnt),'cnotprocessusrcnt'=>count($notprocessusrcnt)];
        echo json_encode($resuls);
    }

    /**
     * Displays a single ProcessedUser model.
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
     * Creates a new ProcessedUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProcessedUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProcessedUser model.
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
     * Deletes an existing ProcessedUser model.
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
     * Finds the ProcessedUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProcessedUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProcessedUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionExport(){
        $models= ProcessedUser::find()->all();
        $model = new ProcessedUser;
        $columns = $model->attributes;
        //var_dump($model->attributeLabels());
       
        $csv_export ='<table border="1" width="100%"><thead><tr>';
        foreach ($columns as $key => $value) {
           $csv_export.='<th>'.$key.'</th>';
        }                          
        
        $csv_export.='</tr></thead>';


        $filename = 'Processed User -'.Date('YmdGis').'.xls';
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=".$filename);

        //var_dump($models);

        if(!empty($models)){
            foreach ($models as $key => $model) {
                //echo "string";
                $csv_export.='<tr>';
                foreach ($columns as $key => $value) {
                   $csv_export.='<td>'.$model->$key.'</td>';
                } 

                $csv_export.='</tr>';
            }
        }

        echo $csv_export;
        
    }
}

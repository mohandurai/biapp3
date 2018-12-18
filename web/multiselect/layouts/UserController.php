<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile; 
use yii\web\ForbiddenHttpException;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;


use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;


use yii\data\SqlDataProvider;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();      

        if ($model->load(Yii::$app->request->post())) {
      

 $model->save(false);
           
           

      
            //$parameters[] = array(':module'=>'ContentMaster', ':filepath' =>$filepath,':filename'=>$file->baseName.'.'.$file->extension, ":modid"=>$model->content_id);
            


              
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

	return $this->redirect('index.php?r=site/signup');

/*            return $this->render('create', [
                'model' => $model,
            ]);*/
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

	
	$model1 = new User();
        $model->password="dummy";
       if ($model->load(Yii::$app->request->post()) && $model->save()) {

	$model->file =UploadedFile::getInstances($model,'upload_image');
    //print_r($model->file =UploadedFile::getInstances($model,'upload_image'));

   foreach ($model->file as $file) {
               $file1 ='profile/'.$file->name;              
 $file->saveAs('profile/'.$file->name);
                } 

           $sql="update user set profile_image_url='$file1' where id='$id'";


                  Yii::$app->db->createCommand($sql)->execute(); 

            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

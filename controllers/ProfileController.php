<?php

namespace app\controllers;

use Yii;
use app\models\Profile;
use app\models\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model; 
use app\models\Attachments; 
use yii\web\UploadedFile; 
use yii\helpers\ArrayHelper; 
use \yii\db\ActiveRecord; 
use yii\db\ActiveQuery; 
use yii\db\Query; 
use app\models\ContentType; 
use yii\helpers\Json;
/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
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
     * Lists all Profile models.
     * @return mixed
     */
     public function actionIndex() 
    { 
        $searchModel = new ProfileSearch(); 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); 

        
        
        if(isset($_REQUEST['ajaxtype'])) 
            { 
            if($_REQUEST['ajaxtype']=="2") 
            return $this->renderAjax('index', [ 'searchModel' => $searchModel, 
                        'dataProvider' => $dataProvider,"ajaxtype"=>2]); 
 
            } 
        else 
        { 
                return $this->render('index', [ 
            'searchModel' => $searchModel, 
            'dataProvider' => $dataProvider, 
        ]); 
            
        } 
    } 

    /** 
     * Displays a single ContentMaster model. 
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
     * Creates a new ContentMaster model. 
     * If creation is successful, the browser will be redirected to the 'view' page. 
     * @return mixed 
     */ 
    public function actionCreate() 
    { 
        $model = new Profile(); 
      if ($model->load(Yii::$app->request->post())) 
      {


             $title = $model->id;

 $model->emp_id=json_decode($model->emp_id);
 $model->emp_id=implode(",",$model->emp_id);

            $model->file =UploadedFile::getInstances($model,'file');           
        
            if(!$model->save())
    {
       // print_r($model->getErrors());
       // exit;
    }


  $sql2="delete from `documentsupload` where module='Profile' and modid=".$model->id;
  Yii::$app->db->createCommand($sql2)->execute(); 


$model_content_id=$model->id;



 if(!empty($model->file)){

           foreach ($model->file as $file) {
               /* $file->saveAs('uploads/'.$model_content_id.$file->baseName.$title.'.'.$file->extension);
                $filepath='uploads/'.$model_content_id.$file->baseName.$title.'.'.$file->extension;
                $filetype=$file->extension;
            $parameters[] = array(':module'=>'Profile', ':filepath' =>$filepath,':filename'=>$model_content_id.$file->baseName.'.'.$file->extension, 
                ":modid"=>$model->id,":mime_type"=>$filetype);*/
$file->saveAs('uploads/'.$model_content_id.$file->baseName.$title.'.'.$file->extension);
                       // $file1->saveAs('uploads/'.$model_content_id.$file->baseName.$title.'.pdf.');
                        $this->convertxlstophp('uploads/'.$model_content_id.$file->baseName.$title.'.'.$file->extension);
                        
                       $t=$model_content_id.$file->baseName.$title.'.'.$file->extension;
                      $c=$model_content_id.$file->baseName.$title.'.pdf';
			
                    $filepath='uploads/'.$model_content_id.$file->baseName.$title.'.'.$file->extension;
                    $filepath1='uploads/'.$model_content_id.$file->baseName.$title.'.pdf';
                    $filetype=$file->extension;
                    $filetype1='pdf';
                    $parameters[] = array(':module'=>'Profile', ':filepath' =>$filepath,':filename'=>$model_content_id.$file->baseName.'.'.$file->extension, 
                    ":modid"=>$model->id,":mime_type"=>$filetype);
                     $parameters[] = array(':module'=>'Profile', ':filepath' =>$filepath1,':filename'=>$filenamee, 
                    ":modid"=>$model->id,":mime_type"=>$filetype1);
              
                }   
  
       if($model->filetype=="8" && $model->content_sub_type=="Articulate" && !empty($model->file))
       {

    

    $zip=new \ZipArchive;
    $res=$zip->open($filepath);
        if ($res === TRUE) {
          $zip->extractTo('uploads/'.$model_content_id.$file->baseName.$title.'/');
          $zip->close();
        $parameters=array();
        $files=scandir('uploads/'.$model_content_id.$file->baseName.$title.'/');
            foreach($files as $k=>$v)
        {
         echo $v."<br>";
            if(preg_match("/html5.html/",$v,$matches))
            {
                echo "matched"."<br>";
            $parameters[] = array(':module'=>'Profile', ':filepath' =>'uploads/'.$model_content_id.$file->baseName.$title.'/'.$v,':filename'=>$model_content_id.$file->baseName.'.'.$file->extension, 
                ":modid"=>$model->id,":mime_type"=>$filetype);  
            }
        }
             
        } else {
          echo 'error in extract!';
        exit;
        }
    
 
       }




            Yii::$app->db->createCommand()->batchInsert('documentsupload', ['module','filepath','filename','modid','mime_type'], $parameters)->execute();
            }
               if($_REQUEST['ajaxtype']=="1"){
                return $this->redirect("index.php?r=profile/create");
            }
   elseif($_REQUEST['ajaxttype']=="1"){
                return $this->redirect("index.php?r=profile/create");
            }
            else{
            return $this->redirect(['view', 'id' => $model->id]);
        }
        }


         else { 
      
       if(isset($_REQUEST['ajaxtype'])) 
        { 

            if($_REQUEST['ajaxtype']=="1") 
            return $this->renderAjax('create', ['model' => $model,"ajaxtype"=>1]); 
        
        } 
            if(isset($_REQUEST['ajaxttype'])) 
        { 

            if($_REQUEST['ajaxttype']=="1") 
            return $this->renderAjax('create', ['model' => $model,"ajaxttype"=>1]); 
        
        }

           else 
            return $this->render('create', [ 
       
                'model' => $model, 
            ]); 
        } 
    } 


    public function actionUploadfiles(){

        $model = new Profile();
         $id  = $_REQUEST['id'];
        $position_type =UploadedFile::getInstances($model,'position_type['.$id.']');  
        $model_content_id =   $id;
        
        

                     
        $sql2="delete from `documentsupload` where module='Profile' and modid=".$id;
            
        Yii::$app->db->createCommand($sql2)->execute(); 
        if(!empty($position_type)){
               foreach ($position_type as $file) {
                    $file->saveAs('uploads/'.$model_content_id.$file->baseName.$title.'.'.$file->extension);
    $filename='uploads/'.$model_content_id.$file->baseName.$title.'.'.$file->extension;
            
                    $filepath='uploads/'.$model_content_id.$file->baseName.$title.'.'.$file->extension;
      $filepath1='uploads/'.$model_content_id.$file->baseName.$title.'.pdf';
     $this->convertxlstophp('uploads/'.$model_content_id.$file->baseName.$title.'.'.$file->extension);
                    $filetype=$file->extension;
                    $parameters[] = array(':module'=>'Profile', ':filepath' =>$filepath,':filename'=>$model_content_id.$file->baseName.'.'.$file->extension, 
                    ":modid"=>$id,":mime_type"=>$filetype);
     $parameters[] = array(':module'=>'Profile', ':filepath' =>$filepath1,':filename'=>$model_content_id.$file->baseName.'.pdf', 
                    ":modid"=>$id,":mime_type"=>"pdf");
 
 
              
            }
            Yii::$app->db->createCommand()->batchInsert('documentsupload', ['module','filepath','filename','modid','mime_type'], $parameters)->execute();
 
        }
    }

    public function convertxlstophp($file){
	//return true;
        $ch = curl_init();                    // initiate curl
        $url = "http://rewire.in/testunoconv.php"; // where you want to post data
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);  // tell curl you want to post something
        curl_setopt($ch, CURLOPT_POSTFIELDS, "filename=".Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl().'/'.$file); // define what you want to post
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return the output in string format
        $output = curl_exec ($ch); // execute
         
        curl_close ($ch); // close curl handle
        //echo Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl().'/'.$file;

        //var_dump($output);
        $pathinfo = pathinfo($file);
        $filename = 'http://rewire.in/uploads/'.$pathinfo['filename'].'.pdf';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $filename);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        if(!empty($post)) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        } 
        $content = curl_exec($ch);
        curl_close($ch);


        $content = file_get_contents($filename);        
        $path = 'uploads/'.$pathinfo['filename'].'.pdf';
        file_put_contents($path, $content);
    }

    /** 
     * Updates an existing ContentMaster model. 
     * If update is successful, the browser will be redirected to the 'view' page. 
     * @param string $id 
     * @return mixed 
     */ 
   public function actionUpdate($id)
    {
       $model = $this->findModel($id);

       $title=$model->id;
       $flg=0;

        if ($model->load(Yii::$app->request->post()) ) {

            //exit;
            
            $model->save(false);
$modehh=UploadedFile::getInstances($model,'upload_image');

            $model->file =UploadedFile::getInstances($model,'upload_image');
if($modehh!=null)
{

          $sql2="delete from `documentsupload` where module='Profile' and modid=".$id;

                  Yii::$app->db->createCommand($sql2)->execute(); 
              }
       
            foreach ($model->file as $file)
            {
                $flg=1;
                $file->saveAs('uploads/'.$file->baseName.$title.'.'.$file->extension);
                $filepath='uploads/'.$file->baseName.$title.'.'.$file->extension;
                 $filetype=$file->extension;
                $parameters[] = array(':modid'=>$id, ':module'=>'Profile', ':filepath' =>$filepath,
                    ':filename'=>$file->baseName.'.'.$file->extension,":mime_type"=>$filetype);
            }
         
            if($flg)
            {  
                  Yii::$app->db->createCommand()->delete('documentsupload', 'modid = '.$id)->execute();
                  Yii::$app->db->createCommand()->batchInsert('documentsupload', ['modid','module','filepath','filename','mime_type'], $parameters)->execute();

            }
            else
            {
                $model->file="Dummy";
            }

            if(!$model->save())
            {
                //echo 'Error to save Lead model<br />';
                var_dump($model->getErrors());
                //echo "<pre>";
                //print_r($model);
               // echo "</pre>";
               // exit;
            }
            else
            {
                $model->save();
            }

        return $this->redirect(['view', 'id' => $model->id]);
        } 
    
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /** 
     * Deletes an existing ContentMaster model. 
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
     * Finds the ContentMaster model based on its primary key value. 
     * If the model is not found, a 404 HTTP exception will be thrown. 
     * @param string $id 
     * @return ContentMaster the loaded model 
     * @throws NotFoundHttpException if the model cannot be found 
     */ 
    protected function findModel($id) 
    { 
        if (($model = Profile::findOne($id)) !== null) { 
            return $model; 
        } else { 
            throw new NotFoundHttpException('The requested page does not exist.'); 
        } 
    } 
 public function actionUsername()
    {
	$out = [];
	if(isset($_POST['name']))
	{	
$p=$_POST['name'];
$connection = \Yii::$app->db;
$sql = $connection->createCommand("SELECT * FROM user where role='".$p."' and dp='".Yii::$app->user->identity->dp."' and status='Active'");
$res = $sql->queryAll();
   foreach ($res as $key => $model) {
            echo "<option value='".$model['id']."'>";
            echo $model['username']."</option>";
        }
return;
}
}
}

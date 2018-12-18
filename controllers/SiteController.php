<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\CandidateList;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\NormsCalculator;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\helpers\ArrayHelper;
use app\models\User;
use yii\data\SqlDataProvider;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;
use Swift_Attachment;
use app\models\ChangeForm;

require_once "db.php";
use yii\base\ErrorException;

//ini_set('memory_limit','900M');
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionMarketingpotential()
    {
        
          return $this->render('marketingpotential',['viewno'=>1]);
    }
    
    public function actionSecondarysales()
    {
        
        
            return $this->render('secondarysales',['viewno'=>2]);
       
    }

    public function actionSales()
    {
        
          return $this->render('sales');
    }


    public function actionTertiarysales()
    {
        
          return $this->render('tertiarysales');
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
         'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                    
                

            if ($model->sendEmail()) {

                Yii::$app->getSession()->setFlash('success', 'EMail has been sent with the Password Change Link');
 //return $this->redirect(array('site/login'));
              //return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
 

            }
        }
return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
       
    }
/// Savecolor function //////
public function actionSavecolor()
    {



$connection=Yii::$app->db;
                $connection ->createCommand()
		    ->update('user', ['color' =>  $_POST['color']], 'id = '.\Yii::$app->user->identity->id )
		    ->execute();

}
public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        if(isset($_REQUEST['authclient'])){
        if($_REQUEST['authclient']=="facebook"){
 file_put_contents("profile/".$attributes['id'].'.jpeg', file_get_contents('https://graph.facebook.com/'.$attributes['id'].'/picture?type=large')); 
 }elseif($_REQUEST['authclient']=="linkedin"){
if(isset($attributes['picture-url']))
file_put_contents("profile/".$attributes['id'].'.jpeg', file_get_contents($attributes['picture-url'])); 
}
elseif($_REQUEST['authclient']=="google"){
if(isset($attributes['picture-url']))
file_put_contents("profile/".$attributes['id'].'.jpeg', file_get_contents($attributes['picture-url'])); 
}
else{
 file_put_contents("profile/".$attributes['id'].'.jpeg', file_get_contents($attributes['profile_image_url'])); 
}
    }

       
         $auth = \app\models\Auth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();

    
        
        if (Yii::$app->user->isGuest) {
            if ($auth) { // login
                $user = $auth->user;
                Yii::$app->user->login($user);
            } else { // signup
 if($_REQUEST['authclient']=="twitter")
{
$attributes['email']=$attributes['id']."@twitter.com";
$attributes['first_name']=$attributes['screen_name'];
$attributes['last_name']=$attributes['screen_name'];
}
 if($_REQUEST['authclient']=="linkedin")
{
$attributes['first_name']=$attributes['first-name'];
$attributes['last_name']=$attributes['last-name'];
}

                if (isset($attributes['email']) && User::find()->where(['email' => $attributes['email']])->exists()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $client->getTitle()]),
                    ]);
              
                } else {


                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        'username' => $attributes['email'],
                        'email' => $attributes['email'],
                        'password' => $password,
                        'first_name'=>$attributes['first_name'],
                        'last_name'=>$attributes['last_name'],
                        'role'=>'socialnetwork',
                        'mobile'=>'1234567890',
                        'reports_to'=>4,
                        'profile_image_url'=>"profile/".$attributes['id'].'.jpeg',
            			'department'=>2,
            			 'date_of_birth'=>'1970-01-01',
            			'country'=>2,
                         'zone'=>7,
                        'area'=>1,
                        'state'=>1,
                        'city'=>1,
                        'territory'=>1,
                        'supervisor'=>'No',
                        'trainer'=>2,'qualification'=>2,
                        'co_ordinator'=>2,
                        'channel'=>1,
                        'usergroup'=>4,
                        'function'=>1,
                        'company'=>2,
                        'businessunit'=>3,
                        'leader'=>1


                        
                    ]);
            $user->scenario = 'create';
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();
    


                    $transaction = $user->getDb()->beginTransaction();
                    if ($user->save()) {
                    
       
                      $auth_item = Yii::$app->authManager;
                              /*  $authorRole = $auth_item->getRole('socialnetwork');
                                $auth_item->assign($authorRole, $user->getId());  */
                        $auth = new \app\models\Auth([
                            'user_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string)$attributes['id'],
                            
                     
                        ]);
                        if ($auth->save(false)) {
                            $transaction->commit();
                            Yii::$app->user->login($user);
                        } else {
                            print_r($auth->getErrors());
                exit;
                        }
                    } else {
                        print_r($user->getErrors());
                exit;
                    }
                }
            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new \app\models\Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);
                $auth->save();
            }
        }
    }


    public function actionIndex()
    {
    

 if (\Yii::$app->user->isGuest) {
    return $this->redirect(array('login'));
    }
        return $this->render('index');

    }
 
    public function actionChange()
    {

        $model = new ChangeForm;

        $uname=!empty($_GET['username'])?$_GET['username']:Yii::$app->user->identity->username;
        $modeluser = User::find()->where([
            'username'=>$uname
        ])->one();
     
        if($model->load(Yii::$app->request->post())){

            if($model->validate()){

                try{
                    // $_GET['username'];
                     $modeluser->password = $_POST['ChangeForm']['newpass'];
                    $modeluser->login_status = 1;
                    if($modeluser->save(false)){

                        Yii::$app->getSession()->setFlash(
                            'success','Password changed'
                        );
                        // echo 'adfaf';

                        if(Yii::$app->user->identity->role=='admin')
                        return $this->redirect(['index']);
                        else
                            return $this->redirect(['/site/index']);
                        // return $this->redirect(['index']);
                    }else{

                        echo $modeluser->getErrors();
                        var_dump($modeluser->getErrors());
                
                        Yii::$app->getSession()->setFlash(
                            'error','Password not changed'
                        );

                    }
                }catch(Exception $e){

                    Yii::$app->getSession()->setFlash(
                        'error',"{$e->getMessage()}"
                    );
                    return $this->render('resetpass',[
                        'model'=>$model
                    ]);
                }
            }else{

                return $this->render('change',[
                    'model'=>$model
                ]);
            }
        }else{

            return $this->render('change',[
                'model'=>$model
            ]);
        }

    }

        public function actionLogin()
    	{
        	if (!\Yii::$app->user->isGuest)
		{
            		return $this->goHome();
        	}
        	$model = new LoginForm();
        	if ($model->load(Yii::$app->request->post()) && $model->login())
		{
            		return $this->goBack();
        	}
		else
		{
            		return $this->render('login', ['model' => $model,]);
        	}
    	}

    public function actionLogout()
    {
        Yii::$app->user->logout();
        

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

////////Added by joni///////
   public function actionRejoin()
    {
        return $this->render('rejoin');
    }
public function actionPopup()
    {
        return $this->render('popup');
    }



/////////End by joni///////
///////// Added by MohanDurai

    
    public function actionPremiumsales()
    {

 
  return $this->render('premiumsales', [
                'model' => $model,
            ]);

    } 
    
 
      public function actionCrt_participant()
    {
        
          return $this->render('crt_participant', [
                'model' => $model,
            ]);
    }

   public function actionAdminresetpassword()
    {

 
  return $this->render('adminresetpassword', [
                'model' => $model,
            ]);

    } 

    public function actionNamination()
    {
        
          return $this->render('namination', [
                'model' => $model,
            ]);
    }
    
       public function actionWalkins()
    {
        
          return $this->render('walkins', [
                'model' => $model,
            ]);
    }
   public function actionIipstatus()
    {
        return $this->render('iipstatus');
    }
        public function actionNaminationtest()
    {
        
          return $this->render('naminationtest', [
                'model' => $model,
            ]);
    }

  public function actionLogosummary()
    {

 
  return $this->render('logosummary', [
                'model' => $model,
            ]);

    }  
  public function actionParticipant_report()
    {

 
  return $this->render('participant_report', [
                'model' => $model,
            ]);

    }
    
    // for Questionwise_report --madhavan
    public function actionQuestionwise_report()
    {
 
  return $this->render('questionwise_report', [
                'model' => $model,
            ]);

    } 
    
     

public function actionQuizcrtview()
    {
        return $this->render('quizcrtview');
    }

 public function actionCrtpermission()
    {
        return $this->render('crtpermission');
    }
    public function actionCrtpermissiondb()
    {
        
         return $this->renderPartial('crtpermissiondb');
    }

 public function actionCrtsessionpermissiondb()
    {
        
         return $this->renderPartial('crtsessionpermissiondb');
    }

        public function actionEmpperformance()
    {
        return $this->render('empperformance');
    }

       public function actionRolestucture()
    {
        return $this->render('rolestucture');
    }

public function actionFxsummary()
    {

 
  return $this->render('fxsummary', [
                'model' => $model,
            ]);

    } 

    public function actionGeolist()
    {
        $pin=$_POST['pincode'];
        //echo $country=$_POST['categoryitemid'];
        // $subject_id =$subject; 
        //$tough_id=$tough;
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand('select * from geography_master where pincode='.$pin.'');
        $res = $sql->queryAll();
        echo json_encode($res);
        return ;
    }
 public function actionSessionverification()
    {
     return $this->render('crtsessionpermission.php');
    }
 public function actionTyssummary()
    {

 
  return $this->render('tyssummary', [
                'model' => $model,
            ]);

    } 
    
public function actionEvolution()
    {
        
          return $this->render('evolution', [
                'model' => $model,
            ]);
    }
    public function actionPopup_leader()
    {
        $this->renderPartial('popup_leader');
    }
	
//////   Sundarapandian added reports start	
	public function actionCrt_report()
    {
       return $this->render('crt_report', [
                'model' => $model,
            ]); 
			
		
    }
	public function actionCompliancereport()
    {
       return $this->render('compliancereport', [
                'model' => $model,
            ]); 
			
		
    }
//////   Sundarapandian added reports end	
////Added by Ayona 
public function actionKpi_report()
    {
       return $this->render('kpi_report', [
                'model' => $model,
            ]); 
			
		
    }
	
///Added by Ayona -end
///////// Added by vicky
    public function actionSurveycontent()
    {
     return $this->render('surveycontent');
    }
      public function actionSurveyquizcontent()
    {
     return $this->render('surveyquizcontent');
    }
    public function actionContentinfo()
    {
     return $this->render('infocontent');
    }
      public function actionQuizcontent()
    {
     return $this->render('quizcontent');
    }
      public function actionOjtquizcontant()
    {
     return $this->render('ojtquizcontant');
    }
        public function actionOjtcontent()
    {
        return $this->render('ojtcontent');
    }


       public function actionOnlinecertificate() 
    {
        return $this->render('onlinecertificate');
    }


         public function actionOnlinecertificatelist() 
    {
        return $this->render('onlinecertificatelist');
    }

	public function actionOnlineojtcertificate() 
	{
		return $this->render('onlineojtcertificate');
	}

	public function actionOnlineinfocertificate() 
	{
		return $this->render('onlineinfocertificate');
	}
    
    public function actionCrtquizcontant()
    {
     return $this->render('crtquizcontant');
    }
    public function actionCrtcontent()
    {
        return $this->render('crtcontent');
    }
    
///////// Added by vicky
    
    public function actionPopup_offisocio()
    {
        $this->renderPartial('popup_offisocio');
    }
    

    public function actionPopup_likesl()
    {
        
        $this->renderPartial('popup_likesl');
    }

     public function actionPlancalendar()
    {
        return $this->render('plancalendar');
    }

///////// Added by MohanDurai



public function beforeAction()
    {      
        if ($this->action->id == 'orgchartprint') {
            Yii::$app->controller->enableCsrfValidation = false;
        }

        if ($this->action->id == 'orgchartprint1') {
            Yii::$app->controller->enableCsrfValidation = false;
        }

        return true;

    }


    
 
public function actionMailreport($parh)
{

        try{
            $mailer = \Yii::$app->mailer->compose()
                   
                    ->setFrom('aaaa@gmail.com')
              	    ->setTo(array('bbbb@yahoo.com'))
                    ->setSubject('Test Mail Account Setup')
                    ->setCharset('UTF-8');
            $mailer->attach($parh);

            $mailer->setCc('cccc@yahoo.com'); 
            if($mailer->send()){
              echo 'success'; 
            }
           }     
        catch(Exception $e){
        var_dump($e->getErrors());
                 
            }
}
public function actionReport()
    {
           //   return $this->render('reportnotification');
$gapval=1;
$sql=mysql_query("SELECT id FROM norms_calculator ORDER BY id DESC LIMIT 1");
$r=mysql_fetch_array($sql);
$id=$r['id'];
 $this->redirect(['viewnorms','id'=>$id]);

//               $this->viewnorms($id);

    }
public function actionViewnorms($id) {
	// 'model' => $this->findModel($id);
        // get your HTML raw content without any layouts or scripts
        $dir = pathinfo(__dir__,PATHINFO_DIRNAME);
        $parh = $dir.'/web/uploads/Norms Calculator' . time() . '.pdf';
       $NormsCalculator=NormsCalculator::findOne($id);
        $content =Yii::$app->view->render('/norms-calculator/viewnorms',['id'=>$_GET['id']]);
         $destination = Pdf::DEST_FILE;
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            //'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_A4,
           'marginTop' => 20,
           'defaultFontSize' => 12,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'filename' => $parh,
            'destination' => $destination,
            'content' => $content,
            'options' => ['title' => 'Norms Calculator','ignore_invalid_utf8'=>true],
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kvm-mpdf-bootstrap.css',
            'methods' => [
               // 'SetHeader' =>['{PAGENO}'],
               // 'SetFooter' => ['{PAGENO}'],
            ]
        ]);
        
           //$pdf->save();
        // return the pdf output as per the destination setting
        $pdf->render(); 
 $this->redirect(['mailreport','parh'=>$parh]);


    }
 public function actionDownloadorgchartprintmail()
    {
       // $destination = 'D';
        // setup kartik\mpdf\Pdf component
        $dir = pathinfo(__dir__,PATHINFO_DIRNAME);
        $parh = $dir.'/web/uploads/'.$_REQUEST['file'];
        $parh1 = $dir.'/web/uploads/Organization Chartmail' . time() . '.pdf';
        $content = file_get_contents($parh);
        //$content = 'aa';
        $destination =  Pdf::DEST_FILE;
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            //'mode' => Pdf::MODE_CORE,
            'format' => 'A4-L',
           //'marginTop' => 20,
           //'defaultFontSize' => 12,
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'filename' => $parh1,
            'destination' => $destination,
            'content' => $content,
            'options' => ['title' => 'Organization Chartmail','ignore_invalid_utf8'=>true],
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kvp-mpdf-bootstrap.css',
            'methods' => [
               // 'SetHeader' =>['{PAGENO}'],
               // 'SetFooter' => ['{PAGENO}'],
            ]
        ]);
$pdf->render(); 
 $this->redirect(['mail','parh1'=>$parh1]);

       //
    }
    public function actionMark()
    {
       // $destination = 'D';
        // setup kartik\mpdf\Pdf component
        $dir = pathinfo(__dir__,PATHINFO_DIRNAME);
        $parh = $dir.'/web/uploads/firsttest.html';
        $parh1 = $dir.'/web/uploads/Organization Chartmail' . time() . '.pdf';
        $content = file_get_contents($parh);
        //$content = 'aa';
        $destination =  Pdf::DEST_FILE;
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            //'mode' => Pdf::MODE_CORE,
            'format' => 'A4-L',
           //'marginTop' => 20,
           //'defaultFontSize' => 12,
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'filename' => $parh1,
            'destination' => $destination,
            'content' => $content,
            'options' => ['title' => 'Organization Chartmail','ignore_invalid_utf8'=>true],
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kvp-mpdf-bootstrap.css',
            'methods' => [
               // 'SetHeader' =>['{PAGENO}'],
               // 'SetFooter' => ['{PAGENO}'],
            ]
        ]);
$pdf->render(); 
 //$this->redirect(['mail','parh1'=>$parh1]);

       //
    }
 public function actionMail($parh1){
        $html= $_POST['htmlcontent'];
$model=new NormsCalculator();
$emailto='';
$emailto=array();
$hrmail=$model->hruser->email;
array_push($emailto,$hrmail);
$ceodp=$model->dpuser->reports_to;
$audi=$model->audiindia->email;
array_push($emailto,$audi);
$sf=mysql_query("select email from user where id='$ceodp'");
$sg=mysql_fetch_array($sf);
$rg=$sg['email'];

array_push($emailto,$rg);

$ceo=$model->dpuser->email;
array_push($emailto,$ceo);



try{
    $mailer = \Yii::$app->mailer->compose()
           
            ->setFrom('mohandurai@gmail.com')
      	    ->setTo(array('shobamohandurai@yahoo.com'))
            ->setSubject('Test Mail Account')
            ->setCharset('UTF-8');

            //->setFrom('audi@biweb.org')
            //->setTo(array('Akash@biweb.com','rakesh@biweb.com','regagandhi@rewire.co.in'))
            //->setSubject('Organization Chart')
            //->setCharset('UTF-8');


    $mailer->attach($parh1);

    $mailer->setCc('mohandurai@gmail.com'); 
    if($mailer->send()){
     return $this->redirect('orgchart1');
    }
   }     
catch(Exception $e){
var_dump($e->getErrors());
         
    }
}



    public function actionAbout()
    {
        return $this->render('about');
    }

public function actionSignup()
    {
    if(Yii::$app->user->can('user-signup'))
    //    if (!\Yii::$app->user->isGuest) 
        {
        $model = new SignupForm();

        if(isset($_REQUEST['candidateid'])){
            $candidateid=$_REQUEST['candidateid'];
            $candidate=CandidateList::findOne($candidateid);

            $model->first_name=$candidate->first_name;
            $model->last_name=$candidate->last_name;
            $model->email=$candidate->email;
            $model->mobile=$candidate->mobile;
            $model->role=$candidate->role_id;
            $model->dealership=$candidate->dealer_id;
        }

        if ($model->load(Yii::$app->request->post())) {
        

            

            if ($user = $model->signup()) {
                /*if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }*/
            
                                    return $this->redirect("index.php?r=user/index");
        
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    else
    {
     throw new ForbiddenHttpException;
    }
    }

    public function actionCreateuser()
    {
    //if(Yii::$app->user->can('user-signup'))
        if (!\Yii::$app->user->isGuest) 
        {
        $model = new SignupForm();

        if(isset($_REQUEST['candidateid'])){
            $candidateid=$_REQUEST['candidateid'];
            $candidate=CandidateList::findOne($candidateid);

            $model->first_name=$candidate->first_name;
            $model->last_name=$candidate->last_name;
            $model->email=$candidate->email;
            $model->mobile=$candidate->mobile;
            $model->role=$candidate->role_id;
            $model->dealership=$candidate->dealer_id;
        }

        if ($model->load(Yii::$app->request->post())) {
        

            

            if ($user = $model->signup()) {
                /*if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }*/
            
                                    return $this->redirect("index.php?r=user/index");
        
            }
        }

        return $this->render('createuser', [
            'model' => $model,
        ]);
    }
    else
    {
     throw new ForbiddenHttpException;
    }
    }


public function actionReporttolist(){
       $interviewerroles   =   $_POST['depdrop_all_params'];
$interview=$_POST['interviewer_role'];
$interview1=$_POST['interviewer_role1'];
$dealership=$_POST['dealership_id'];

//var_dump($dealership);
       if($interview != '' && $dealership != '')
        {    $userLists     =   User::find()->select('id, first_name ')->andWhere(['role' => $interview])->andWhere(['status'=>'Active']);
$like = [];
array_push($like,'or');
array_push($like,['like','dealership','0',false]);
foreach ($dealership as $key => $dealer) {
          //$like = ['or',['like','dealership',$dealer,false],['like','dealership','%,'.$dealer.',%',false],['like','dealership','%,'.$dealer,false],['like','dealership',$dealer.',%',false]];
	array_push($like,['like','dealership',$dealer,false]);
	array_push($like,['like','dealership','%,'.$dealer.',%',false]);
	array_push($like,['like','dealership','%,'.$dealer,false]);
	array_push($like,['like','dealership',$dealer.',%',false]);
        //  array_push($arraycond, $like);
          # code...
        }
$userLists->andWhere($like);
$userLists = $userLists->all();
}
        else if(isset($interviewerroles['user-validator_role']))
            $userLists     =   User::find()->select('id, first_name')->where(['role' => $interviewerroles['user-validator_role']])->andwhere(['dp'=>yii::$app->user->identity->dp])->andWhere(['or',['like','dealership', yii::$app->user->identity->dealership, false],['like','dealership', yii::$app->user->identity->dealership.',%', false],['like','dealership', '%,'.yii::$app->user->identity->dealership.',%', false],['like','dealership', '%,'.yii::$app->user->identity->dealership, false]])->andWhere(['status'=>'Active'])->all();

 else if($interview1 != '' && $dealership != '')
{
            $userLists     =   User::find()->select('id, first_name')->where(['role' => $interview1])->andWhere(['status'=>'Active']);
$like = [];
array_push($like,'or');
array_push($like,['like','dealership','0',false]);
foreach ($dealership as $key => $dealer) {
          //$like = ['or',['like','dealership',$dealer,false],['like','dealership','%,'.$dealer.',%',false],['like','dealership','%,'.$dealer,false],['like','dealership',$dealer.',%',false]];
	array_push($like,['like','dealership',$dealer,false]);
	array_push($like,['like','dealership','%,'.$dealer.',%',false]);
	array_push($like,['like','dealership','%,'.$dealer,false]);
	array_push($like,['like','dealership',$dealer.',%',false]);
        //  array_push($arraycond, $like);
          # code...
        }
$userLists->andWhere($like);
$userLists = $userLists->all();

}

        else
            $userLists     =   User::find()->select('id, first_name')->where(['role' => $interviewerroles['signupform-reports_to_role'],'dp'=>yii::$app->user->identity->dp])->andWhere(['or',['like','dealership', yii::$app->user->identity->dealership, false],['like','dealership', yii::$app->user->identity->dealership.',%', false],['like','dealership', '%,'.yii::$app->user->identity->dealership.',%', false],['like','dealership', '%,'.yii::$app->user->identity->dealership, false]])->andWhere(['status'=>'Active'])->all();

        foreach ($userLists as $userList) {
	//var_dump($userList);
 echo "<option value='".$userList->id."'>";
            echo $userList->first_name."</option>";
           
        }
        

        return ;
    }


    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

public function actionDepdd1()
    {
        //return $this->render('depdd1');
        $pubid = $_REQUEST['catid'];
        foreach($pubid as $cc) {
            $a1 .= $cc . ",";
        }
        
        $a2 = substr($a1,0,-1);
        $sql77 = "SELECT id, name FROM bi_master_sub_catgry where catgry_id IN (".$a2.") ORDER BY catgry_id, name";
        $sql77_val = Yii::$app->db->createCommand($sql77)->queryAll();

        $options = "";

        foreach($sql77_val as $eee)
        {
            $options .= "<option value='".$eee['id']."'>".$eee['name']."</option>";
        }

        return $options;
    }


public function actionDashboard5()
    {
        return $this->render('dashboard5');
    }

public function actionDealernames()
    {
        return $this->renderPartial('dashboard5a');
    }


public function actionExport($filename,$query)
    {

$csv_filename =$filename.date('Y-m-d').'.csv';
// database variables

$csv_export = '';
// query to get data from database
//$query = mysql_query("SELECT * FROM ".$db_record."");

 $field = mysql_num_fields($query);
$row=mysql_num_rows($query);

// create line with field names
for($i = 0; $i < $field; $i++) {
  $csv_export.= mysql_field_name($query,$i).';';
}
// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';
// loop through database query and fill export variable
$count=1;
while($row = mysql_fetch_array($query)) {
  // create line with field values
$csv_export.='"'.$count.'",';

  for($i = 0; $i < $field; $i++) {


    $csv_export.= '"'.$row[mysql_field_name($query,$i)].'",';
  }

  $csv_export.= '
';
$count++;	
    }
// Export the data and prompt a csv file for download
//header("Content-type: application/vnd.ms-excel");
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);
}


// done by keerthana T 
//**************************************************************************************

public function actionValidate()
 {
           
   $period = $_REQUEST['year'];
   for($i=0;$i<count($period);$i++)
  {
   $year="p".$period[$i];
   $year=trim($year,",");

    }
//$error=new NotFoundHttpException("data not available");
          $connection = Yii::$app->db;
          $sql = $connection->createCommand( "select PARTITION_NAME from information_schema.partitions WHERE TABLE_SCHEMA='biweb_sales' AND TABLE_NAME = 'hul_city_sales' AND PARTITION_NAME='".$year."'");
                   $res = $sql->queryAll();
                     json_encode($res);
                   if(count($res)==0 )
                    {
                    
                echo "data not available for selected year,please chose valid year!!!!!!!";

                  }

                  
    }

 // public function actionPopulation()
 // {

 //  $period = $_REQUEST['year'];
 //   for($i=0;$i<count($period);$i++)
 //  {
 //   $year="pop".$period[$i];
 //   $year=trim($year,",");

 //    }

 //    $connection = Yii::$app->db;
 //          $sql = $connection->createCommand("SELECT state_id locid,2017 period,sum(age_5_9+((age_5_9*pop2017)/100 ))+sum(age_10_14+((age_10_14*pop2017)/100 ))+sum(age_15_19+((age_15_19*pop2017)/100 ))+sum(age_20_24+((age_20_24*pop2017)/100 ))+sum(age_25_29+((age_25_29*pop2017)/100 ))+sum(age_30_34+((age_30_34*pop2017)/100 ))+sum(age_35_39+((age_35_39*pop2017)/100 ))+sum(age_40_44+((age_40_44*pop2017)/100 ))+sum(age_45_49+((age_45_49*pop2017)/100 ))+sum(age_50_54+((age_50_54*pop2017)/100 ))+sum(age_55_59+((age_55_59*pop2017)/100 ))+sum(age_60_64+((age_60_64*pop2017)/100 ))+sum(age_65_69+((age_65_69*pop2017)/100 ))+sum(age_70_74+((age_70_74*pop2017)/100 ))+sum(age_75_79+((age_75_79*pop2017)/100 ))+sum(age_80+((age_80*pop2017)/100 ))+sum(age_not_stated+((age_not_stated*pop2017)/100 ))+sum(age_0_4+((age_0_4*pop2017)/100 )) result  FROM fifth_combo_district where  gender IN (1,2) AND ( marital IN (1,2,3,4,5))  AND ( religion IN (1,2,3,4,5,6,7,8))  AND ( education IN (1,2,3,4,5,6,7,8))  AND ( area IN (2,1))  AND ( stat != 'R')  AND ( country_id = '1')  GROUP BY locid");
 //                 $res = $sql->queryAll();
 //                     json_encode($res);

 // }   

public function actionValidatemark()
 {
           
   $period = $_REQUEST['year'];
   for($i=0;$i<count($period);$i++)
  {
   $year="p".$period[$i];
   $year=trim($year,",");

    }
//$error=new NotFoundHttpException("data not available");
          $connection = Yii::$app->db;
          $sql = $connection->createCommand("select  PARTITION_NAME from information_schema.partitions WHERE TABLE_SCHEMA='biweb_mktgpot' AND TABLE_NAME = 'category_consumption_final' AND PARTITION_NAME='".$year."'");
                   $res = $sql->queryAll();
                     json_encode($res);
                   if(count($res)==0 )
                    {
                    
                echo "data not available for selected year,please chose valid year!!!!!!!";

                  }

                  
    }


  // sub function for existing function   
   
public function children($id)
 {
     $parent=$id;
    $connection = Yii::$app->db;
    $sql = $connection->createCommand( "select a.*,b.* from bi_menu as a left join bi_menu_description as b on a.refid=b.ref_id where a.parent_id='".$parent."' and  stat !='R' order by a.order_fld asc");
      // print_r("select a.*,b.* from bi_menu as a left join bi_menu_description as b on a.refid=b.ref_id where a.parent_id='".$parent."' and  stat !='R'  order by a.order_fld asc");//die;
    $res1 = $sql->queryAll();         
    $result=array();
    for($i=0;$i<count($res1);$i++)
    {
        array_push($result,array("refid"=>$res1[$i]["refid"],"menu_name"=>$res1[$i]["menu_name"],"is_child"=>$res1[$i]["is_child"],"menu_id"=>$res1[$i]["menu_id"],"menu_item_id"=>$res1[$i]["menu_item_id"],"level_id"=>$res1[$i]["level_id"],"desc"=>$res1[$i]["description"],"operators_flag"=>$res1[$i]["operators_flag"]));
    }
    // "perators_flag"=>$res1[$i]["operators_flag"]
        return $result;
        
 
 }


 public function actionCalyearselect()
 {


$topmenuid= $_REQUEST['topmenuid'];
 $connection = Yii::$app->db;
 $sql = $connection->createCommand("SELECT distinct tm.period_name,tm.refid FROM timeline_master tm ,timeline_data td  where tm.refid=td.period_id and  td.second_lvl_menu_id='".$topmenuid."'");
    $res = $sql->queryAll();
    json_encode($res);
   // echo $res;
    if(count($res)!='')
    {

       // echo"good";
        echo json_encode($res);


    }


$topmenuid='';
    }
 public function actionCalyearsdisplay()
 {

//'".$topmenuid."'
 $topmenuid=$_REQUEST['topmenuid'];
$period_id =$_REQUEST['period_id'];
$period_type_id=$_REQUEST['period_type_id'];
 $connection = Yii::$app->db;
 $sql = $connection->createCommand("SELECT  distinct period_from,period_to FROM `timeline_data` WHERE period_id='".$period_id."' and period_type_id= '".$period_type_id."' and second_lvl_menu_id='".$topmenuid."' ");
    $res = $sql->queryAll();
    json_encode($res);
    if(count($res)!='')
    {

       // echo"good";
        echo json_encode($res);


    }


    }
 public function actionViewdisplay()
 {

//'".$topmenuid."'
 $topmenuid=$_REQUEST['topmenuid'];

 $connection = Yii::$app->db;
 $sql = $connection->createCommand("SELECT  distinct view_name from view_master ");
    $res = $sql->queryAll();
    json_encode($res);
    if(count($res)!='')
    {

       // echo"good";
        echo json_encode($res);


    }


    }

//*******************************************************************************************************

    public function actionChildmenu()
 {
           
           $parent_id = $_REQUEST['menuid'];
           
           $r='';
           $r .= '<select id="demo'.$parent_id.'" name="menuselect" multiple="multiple">';
           $menures=$this->children($parent_id);

            //print_r($menures);die;
           if(count($menures)>0)
           {
              for($i=0;$i<count($menures);$i++)
              {
                // if($menures[$i]==259474){
                //     print_r($menures[$i]);
                //     die;
                // }
                 $str='';$tempstr='';$operatpr_flag = '';$temp_operatpr_flag='';

                     if($menures[$i]['is_child']=='Y')
                     { 
                       
                        $str .=$menures[$i]["menu_name"];
                        $tempstr .=$str;
                        $operatpr_flag .= $menures[$i]["operators_flag"];
                        $temp_operatpr_flag .= $operatpr_flag;
                        $menures1=$this->children($menures[$i]["refid"]);
                        for($i1=0;$i1<count($menures1);$i1++)
                        {
                            $str='';
                            $str=$tempstr;
                            $operatpr_flag ='';
                            $operatpr_flag = $temp_operatpr_flag;
                          
                          if($menures1[$i1]['is_child']=='Y')
                            { 

                                $str .='/'.$menures1[$i1]["menu_name"];
                                $tempstr1 =$str;
                                  $operatpr_flag .='/'.$menures1[$i1]["operators_flag"];
                                  // print_r($operatpr_flag);die;
                                    $temp_operatpr_flag1=$operatpr_flag;
                                $menures2=$this->children($menures1[$i1]["refid"]);
                                // print_r($menures2);die;
                                 for($i2=0;$i2<count($menures2);$i2++)
                                {
                                   
                                    $str=$tempstr1;
                                    $operatpr_flag = $temp_operatpr_flag1; 
                                    // print_r($str);die;    
                                  if($menures2[$i2]['is_child']=='Y')
                                    { 

                                          $str .='/'.$menures2[$i2]["menu_name"];
                                          $tempstr2 =$str;
                                           $operatpr_flag .='/'.$menures2[$i2]["operators_flag"];
                                           $temp_operatpr_flag2 = $operatpr_flag;

                                         $menures3=$this->children($menures2[$i2]["refid"]);
                                         for($i3=0;$i3<count($menures3);$i3++)
                                        {
                                          //  $str='';
                                            $str=$tempstr2;
                                            $operatpr_flag = $temp_operatpr_flag2;
                                          if($menures3[$i3]['is_child']=='Y')
                                            { 
                                                 $str .='/'.$menures3[$i3]["menu_name"];
                                                  $tempstr3 =$str;
                                                   $operatpr_flag .='/'.$menures3[$i3]["operators_flag"];
                                                   $temp_operatpr_flag3 = $operatpr_flag;
                                                  $menures4=$this->children($menures3[$i3]["refid"]);
                                                 for($i4=0;$i4<count($menures4);$i4++)
                                                {
                                                    $str='';
                                                    $str=$tempstr3;
                                                    $operatpr_flag = '';
                                                    $operatpr_flag = $temp_operatpr_flag3;
                                                  if($menures4[$i4]['is_child']=='Y')
                                                    { 
                                                          $str .='/'.$menures4[$i4]["menu_name"];
                                                          $operatpr_flag.='/'.$menures4[$i4]["operators_flag"];

                                                         
                                                    }
                                                    else
                                                    {

                                             $r .='<option value="'.$menures4[$i4]["refid"].'" menu_id="'.$menures4[$i4]["menu_id"].'" level_id="'.$menures4[$i4]["level_id"].'" menu_item_id="'.$menures4[$i4]["menu_item_id"].'" data-section="'.$str.'" data-opflag = "'.$operatpr_flag.'" data-description="'.$menures4[$i4]["desc"].'">'.$menures4[$i4]["menu_name"].'</option>';
                                                    }


                                               }


                                            }
                                            else
                                            {

                                     $r .='<option value="'.$menures3[$i3]["refid"].'"  menu_id="'.$menures3[$i3]["menu_id"].'" level_id="'.$menures3[$i3]["level_id"].'" menu_item_id="'.$menures3[$i3]["menu_item_id"].'" data-section="'.$str.'" data-opflag = "'.$operatpr_flag.'" data-description="'.$menures3[$i3]["desc"].'">'.$menures3[$i3]["menu_name"].'</option>';
                                            }


                                       }
                                    }
                                    else
                                    {
                                        // print_r($operatpr_flag);die;
                             $r .='<option value="'.$menures2[$i2]["refid"].'"  menu_id="'.$menures2[$i2]["menu_id"].'" level_id="'.$menures2[$i2]["level_id"].'" menu_item_id="'.$menures2[$i2]["menu_item_id"].'" data-section="'.$str.'" data-opflag = "'.$operatpr_flag.'" data-description="'.$menures2[$i2]["desc"].'">'.$menures2[$i2]["menu_name"].'</option>';
                                    }


                               }

                            }
                            else
                            {
                                // print_r($operatpr_flag.' / '.$str);//die;
                                // print_r($str);//die;
                                $r .='<option value="'.$menures1[$i1]["refid"].'"  menu_id="'.$menures1[$i1]["menu_id"].'" level_id="'.$menures1[$i1]["level_id"].'" menu_item_id="'.$menures1[$i1]["menu_item_id"].'" data-section="'.$str.'" data-opflag = "'.$operatpr_flag.'" data-description="'.$menures1[$i1]["desc"].'">'.$menures1[$i1]["menu_name"].'</option>';
                            }

                        }

                     
                        
                    } 
                    else
                    {
                        $r .='<option value="'.$menures[$i]["refid"].'"  menu_id="'.$menures[$i]["menu_id"].'" level_id="'.$menures[$i]["level_id"].'" menu_item_id="'.$menures[$i]["menu_item_id"].'" data-section="'.$str.'" data-opflag = "'.$operatpr_flag.'" data-description="'.$menures[$i]["desc"].'">'.$menures[$i]["menu_name"].'</option>';
                    }
              }
           }

            $r .='</select>';
            echo $r;
        
}


public function actionGeomaster()
{

    if( isset($_REQUEST['mainlocation'] ) )
{
    $r=array();
    $mainlocation = $_REQUEST['mainlocation'];
    $sublocation = $_REQUEST['sublocation'];

    
    $selectdata="select refid,master_table from Geo_Hrchy_master where refid='".$mainlocation."' ";
    $query = yii::$app->db->createCommand($selectdata)->queryAll();
    for($i=0;$i<count($query);$i++)
    {
       $r[$i]= $query[$i]['refid'].",".$query[$i]['master_table'];
    }
   
    echo json_encode($r);
}
}

public function actionMastername()
{
    if( isset($_REQUEST['mastername'] ) )
{
       $r=array();

        $mastername = $_REQUEST['mastername'];
       
        $fileid = $_REQUEST['fileid'];
          $passid=$_REQUEST['passid'];
        $selectdata ="SELECT  location_name FROM `".$mastername."`  where '".$passid."' ='".$fileid."' and stat!='R'";
       $query = yii::$app->db->createCommand($selectdata)->queryAll();
        // echo $selectdata;
        // die;
    
        for($i=0;$i<count($query);$i++)
        {
                $r[$i]= $query[$i]['location_name'];
   
        }

        echo json_encode($r);
}
}

public function actionMenuenable()
{

if($_REQUEST['level'] != '')
{
     $level=$_REQUEST['level'];

          $part2="";$data=array();$data1=array();
       
            $part1=" select refid ,flag from split_combine_view where level_id IN ($level) and stat!='R' and parent_id=0 order by parent_id";

            $respart2=yii::$app->db->createCommand($part1)->queryAll();
            if(count($respart2)>0){

            for($i=0;$i<count($respart2);$i++){
            $data['id']=$respart2[$i]['refid'];


            $data['flag']=$respart2[$i]['flag'];
            array_push($data1,$data);   
            $part21=" select refid,flag from split_combine_view where  stat!='R' and parent_id='".$data['id']."' ";
            $respart21=yii::$app->db->createCommand($part21)->queryAll();
            for($j=0;$j<count($respart21);$j++){
            $data['id']=$respart21[$j]['refid'];

          
            $data['flag']=$respart2[$i]['flag'];
            array_push($data1,$data);  

            }


            }
            // array_push($data1,$grid_path);

                                    echo json_encode($data1);
                                   // die;

                                }
                                    else
                                    {
                                    echo "";
                                    }  

                        }
}
public function actionLevelmenu()
{
        if(isset($_REQUEST['levelview']) && $_REQUEST['level'] != '')
        {

            //     $pathinfo=yii::$app->db->createCommand("select grid_path from bimap_data where  levelid  in (".$_REQUEST['level'].")")->queryAll();
            //     // print_r($pathinfo);die;
            //     for($l=0;$l<count($pathinfo);$l++)
            //     {
            //     //$map_path = $pathinfo[$l]['map_path'];
            //     //$chart_path = $pathinfo[$l]['chart_path'];
            //          $grid_path = $pathinfo[$l]['grid_path'];
            //     }

            // $_SESSION['grid_path'] = $grid_path;
            // print_r($grid_path);die;

          $part2="";$data=array();$data1=array();
          $viewopt=$_REQUEST['flag'];
          $level=$_REQUEST['level'];
          $part1=" select refid,label,if(parent_id=0,'#',parent_id) as parent_id,view_optn,enablestat ,flag from split_combine_view where level_id IN ($level) and stat!='R' and parent_id=0 and flag='".$viewopt."' order by parent_id";

          $respart2=yii::$app->db->createCommand($part1)->queryAll();
          if(count($respart2)>0){
         
          for($i=0;$i<count($respart2);$i++){
            $data['id']=$respart2[$i]['refid'];
          
             $data['parent']=$respart2[$i]['parent_id'];
               $data['text']=$respart2[$i]['label'];
         $data['li_attr']=$respart2[$i]['view_optn'];
         $data['enaable']=$respart2[$i]['enablestat'];
          $data['flag']=$respart2[$i]['flag'];
            array_push($data1,$data);   
             $part21=" select refid,label,if(parent_id=0,'#',parent_id) as parent_id,view_optn,enablestat ,flag from split_combine_view where  stat!='R' and parent_id='".$data['id']."'";
             $respart21=yii::$app->db->createCommand($part21)->queryAll();
         for($j=0;$j<count($respart21);$j++){
            $data['id']=$respart21[$j]['refid'];
          
             $data['parent']=$respart21[$j]['parent_id'];
               $data['text']=$respart21[$j]['label'];
               $data['li_attr']=$respart2[$i]['view_optn'];
               $data['enaable']=$respart2[$i]['enablestat'];
              $data['flag']=$respart2[$i]['flag'];
            array_push($data1,$data);  

             }


          }
            // array_push($data1,$grid_path);
          
          echo json_encode($data1);}
          else
          {
            echo "";
          }
        }
}

public function actionGetpathres()
{
     if(isset($_REQUEST['levelview']) && $_REQUEST['level'] != '')
        {
                 $pathinfo=yii::$app->db->createCommand("select grid_path from bimap_data where  levelid  in (".$_REQUEST['level'].")")->queryAll();
                //print_r($pathinfo);die;
                $grid_path ='';
                for($l=0;$l<count($pathinfo);$l++)
                {
                
                     $grid_path = $pathinfo[$l]['grid_path'];
                }
                echo $grid_path;
        }
}

}

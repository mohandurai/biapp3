<?php

namespace app\controllers;
 
use Yii;
use yii\base\Model;
use app\models\Webservice;
use app\models\WebserviceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use app\models\User;
use app\models\LoginForm;
use yii\rbac\SharingRules;


require_once "db.php";
require_once("../config/web.php");

/**
 * WebserviceController implements the CRUD actions for Webservice model.
 */
class WebserviceController extends ActiveController
{
    public $modelClass='';
    public $scenario = Model::SCENARIO_DEFAULT;


protected function verbs()
    {
        return [
	    'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
            'logout' => ['POST'],
	    'login' => ['POST'],
        ];
    }



 
public function init() 
{



      parent::init();
 \Yii::$app->user->enableSession = true;
      $this->modelClass= @app."\models\\".Yii::$app->getRequest()->getQueryParam('module');
      $web_con_action=Yii::$app->getRequest()->getQueryParam('r');
      $web_con_action=explode("/",$web_con_action);



      switch($web_con_action[1])
      {
  case "create":
  if(Yii::$app->getRequest()->getQueryParam('scenario') !='')
        $this->createScenario=Yii::$app->getRequest()->getQueryParam('scenario');
  
  break;  
  case "update":
  if(Yii::$app->getRequest()->getQueryParam('scenario'))
        $this->updateScenario=Yii::$app->getRequest()->getQueryParam('scenario'); 
  break;  
          
    }

	
	
}





public function actionModellist()
{
if(!Yii::$app->user->isGuest)
{

foreach(\app\models\MobileIcons::find()->asArray()->all() as $k=>$v)
{
	foreach($v as $mk=>$mv)
	{
	if($mk=="module")
	$module=$mv;
	if($mk=="img_path")

	$iconpath=$mv;
        if($mk=="file_name")
	$icon_name=$mv;

	}
        $modiconfilename[$iconpath]=$icon_name;
       $modicon[$iconpath]=$module;
}


$modlist=array_diff(scandir("../models"),array("..","."));
$counterflg=0;
foreach($modlist as $k=>$v)
{ 
$modname = preg_match('/\w+/',$v,$matches);

$modname = preg_split('/(?=[A-Z])/',$matches[0]);
  $str="";
  $newmodname= array();

  for($i=1; $i < sizeof($modname); $i++ )
  {
  $str=strtolower($modname[$i]);
  $newmodname[]=$str;
  }

   $rbac_route= "/".implode("-",$newmodname)."/index";

if(Yii::$app->user->can($rbac_route)||Yii::$app->user->can("/".implode("-",$newmodname).'/*')
  ||Yii::$app->user->can("/*"))
  {
	  $return_arry['models'][$counterflg]['model_name']=$matches[0];
	  $img_path=array_search($matches[0],$modicon);
	  if($img_path)
	  {
	  $return_arry['models'][$counterflg]['img_path']=$img_path;
	  }
	  else
	  $return_arry['models'][$counterflg]['img_path']='';
	  
	  $return_arry['models'][$counterflg]['file_name']=$modiconfilename[$img_path] ;
	  $counterflg++;  
  }

}
return $return_arry;
}
else
 throw new \yii\web\HttpException(403, 'You are Not Logged In . Kindly Log In ');
        
}



public function actionLogin()
{
  $model = new $this->modelClass([
            'scenario' => $this->scenario,
        ]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="LoginForm")
  {
  throw new \yii\web\HttpException(404, 'Method Not Found');
  }

        else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) 
        {
    
          /*if (!\Yii::$app->user->isGuest) 
          {
          throw new \yii\web\HttpException(403, 'Already logged in Kindly Sign Out and Login ');
          }*/
            
           if($model->login())
           {
                $response['message']['success']="true";
                $response['message']['data']['akey']=\Yii::$app->user->identity->getAuthKey();
                $response['message']['data']['role_id']=\Yii::$app->user->identity->role;

                         $response['message']['data']['name']=\Yii::$app->user->identity->first_name.\Yii::$app->user->identity->last_name;

                $response['message']['data']['mobile']=\Yii::$app->user->identity->mobile;
                $response['message']['data']['userid']=\Yii::$app->user->identity->id;
                $response['message']['data']['user_name']=\Yii::$app->user->identity->username;
                $response['message']['data']['_csrf']=\Yii::$app->request->getCsrfToken();  
             return $response;
           }
           else
           {
            $response['message']['success']="false";
          $response['message']['data']="null";
          return $response;
           
           }
             
            
        }
  else
  {
      throw new \yii\web\HttpException(400, 'No Params Received');
  }

}



public function beforeAction($action)
 {
	
 return parent::beforeAction($action);
 }



public function actionLogout()
    {
      if(Yii::$app->getRequest()->getQueryParam('module')!="LoginForm")
      {
      throw new \yii\web\HttpException(404, 'Method Not Found');
      }
      Yii::$app->user->logout();

    } 


public function actions()
{

    $actions = parent::actions();

    $actions['index']['prepareDataProvider'] = function($action) 
    {
   $modelClass = $this->modelClass;
        return new \yii\data\ActiveDataProvider([
           'query' => $modelClass::find(),
     'pagination' => false,
        ]);
    };




    return $actions;
}




public function checkAccess($action, $model = null, $params = [])
    {

  if(!file_exists("../models/".Yii::$app->getRequest()->getQueryParam('module').".php"))
  throw new \yii\web\HttpException(404, 'Model Not Found'); 


  $controllername=Yii::$app->getRequest()->getQueryParam('module');
  $modname = preg_split('/(?=[A-Z])/',$controllername);
  $str="";
  $newmodname= array();

  for($i=1; $i < sizeof($modname); $i++ )
  {
  $str=strtolower($modname[$i]);
  $newmodname[]=$str;
  }



  $rbac_route= "/".implode("-",$newmodname)."/".$action;
  
  
  

  
  if(Yii::$app->getRequest()->getQueryParam('access_token') != '')
  {
    $user_info=\app\models\User::findIdentityByAccessToken(Yii::$app->getRequest()->getQueryParam('access_token'));
	if($user_info === false || $user_info =="")
	            throw new \yii\web\HttpException(403, 'Invalid Access Token');
	else
	{	
     Yii::$app->user->login($user_info); 
	 }
  
  }  
  else if (Yii::$app->user->isGuest && $action!='login') {
            throw new \yii\web\HttpException(403, 'Session Expired Kindly Log In ');
        }

   if(Yii::$app->user->can($rbac_route)||Yii::$app->user->can("/".implode("-",$newmodname).'/*')||Yii::$app->user->can("/*"))
  {
 
  return true;
  }

  else
  {
  throw new \yii\web\HttpException(403, 'You Are not allowed to view this page ');
  }

}




 public function invalid_session()
{
   logout();
   $response = '{"message":{"success":"false","message":"invalid session"}}';
   return $response;
}   







public function actionAvailablesurvey()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Surveycontentview")
    {
      throw new \yii\web\HttpException(404, 'Method Not Found');
    }
   else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid'])) 
   {  




 $sql2 = "select a.empid,a.survey_id,b.survey_title,b.survey_description, b.survey_tag,b.status,c.title as content,d.subject_name,
       e.f_name,f.filename,f.filepath,c.content_text
from survey_participant a,
     plain_survey b,
     content_master c,
     subject_master d,
     file_transfer e,
     documentsupload  f
where  a.survey_id=b.survey_id and
       b.survey_content = c.content_id and
       b.survey_subject = d.subject_id and
       c.content_type=e.f_id and
       b.survey_content=f.modid and
       	f.module='ContentMaster' and
a.status !='Closed' and empid='".$_REQUEST["userid"]."'";




 $res2 = mysql_query($sql2);
  $nrw = mysql_num_rows($res2);
  $class = array();
  while($row2 = mysql_fetch_assoc($res2))
  {
  $survey[] = array('survey_id'=>$row2['survey_id'],'title'=>$row2['survey_title'],'descrption'=>$row2['survey_description'],'f_name'=>$row2['f_name'],'tag'=>$row2['survey_tag'],'filename'=>$row2['filename'],'path'=>$row2['filepath'],'content'=>$row2['content'],'subject_name'=>$row2['subject_name'],'f_description'=>$row2['content_text']);
  } 

if($nrw==0)
       {
    
    $response['message']['success']="false";

       }
       else
       {
   

     $response['message']['success']="true";
     $response ['message']['data']['result']=$survey;


       }
       return $response;


   }
 else
   {
        throw new \yii\web\HttpException(400, 'No Params Received');
   }

}




public function actionSessionpassword()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['class_id'])) 
   { 


  $sql2 = "select a.crt_id, a.module_id, a.session_id,
b.session_password,c.session_name,
 c.status, c.description, session_pass_status
 from crt_question_mapping a,
      crt_sessions_pass b,
       session_masters c
       where  a.module_id=b.module_id and
       a.session_id=c.session_id and
       a.session_id = b.session_id and
       a.crt_id=b.crt_id and a.crt_id='".$_REQUEST["class_id"]."' group by c.session_id";



$res2 = mysql_query($sql2);
  $nrw = mysql_num_rows($res2);
  $class = array();
  while($row2 = mysql_fetch_assoc($res2))
  {
  $class[] = array('crt_id'=>$row2['crt_id'],'module_id'=>$row2['module_id'],'session_id'=>$row2['session_id'],'session_password'=>$row2['session_password'],'session_name'=>$row2['session_name'],'status'=>$row2['status'],'sess_type_status'=>$row2['session_pass_status'],'description'=>$row2['description']);
  } 


if($nrw == 0)
{
  //  $response = '{"message":{"success":"false","data":{"result":""}}}';


 $response['message']['success']="false";
 $response ['message']['data']['result']="";
  }
  else
  {
 //  $response = '{"message":{"success":"true","data":{"result":'.json_encode($class).'}}}';

$response['message']['success']="true";

$response['message']['data']['result']=$class;


  }







  return $response;







/*
$connection=\Yii::$app->db;
   $query2=$connection->createCommand($sql2);
   $response=$query2->queryAll();
   return $response;*/

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}



public function actionClasscertificate()
{

$model = new $this->modelClass([]);

    if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
     {
 throw new \yii\web\HttpException(404, 'Method Not Found');
     } 
    else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
    {  

$sql2 = "select a.crt_id,a.crt_title,a.role,ifnull(truncate((ifnull(gettot,0)/ifnull(tot,0))*100,2),0) as 
percentage from
(select a.crt_id, a.crt_title, concat(ifnull(b.first_name,''),' ',ifnull(b.last_name,'')) as name, b.role 
from crt a,user b, allocation_master c
where a.crt_id=c.mod_record_id and c.emp_id=b.id and c.emp_id='".$_REQUEST['userid']."' group by crt_id) as a
left outer join
(select a.crt_id,sum(c.marks) as tot from crt_question_mapping a,module_masters b ,question_master c,
session_masters d
where a.module_id=b.module_id and b.module_id=c.module_id and c.session_id=d.session_id group by a.crt_id) as b
on a.crt_id=b.crt_id
left outer join
(select a.crt_id,sum(b.marks) as gettot from
crt_question_mapping a,allocation_master b where a.crt_id=b.mod_record_id and b.emp_id='".$_REQUEST['userid']."' group by a.crt_id) as c
on a.crt_id=c.crt_id";

  $res2 = mysql_query($sql2);
  $nrw = mysql_num_rows($res2);
  $certificate = array();
  while($row2 = mysql_fetch_assoc($res2))
  {
     //$row2['percent'] = 75;
     if($row2['percentage']>=75)
     {
      $grade = "excellent";
     }
     if($row2['percentage']<75 && $row2['percentage']>=60)
     {
      $grade = "good";
     }
     if($row2['percentage']<60)
     {
      $grade = "average";
     }
      
  
  $certificate[] = array('name'=>$row2['crt_title'],'role_name'=>$row2['role'],
    'percent'=>$row2['percentage'],'grade'=>$grade,'class_name'=>$row2['crt_title']);
  } 
if($nrw==0)
       {
     //$response = '{"message":{"success":"false"}}';
    $response['message']['success']="false";

       }
       else
       {
    //$response = '{"message":{"success":"true","data":['.implode(",",$you).']}}';

     $response['message']['success']="true";
     $response['message']['data']['result']=$certificate;


       }
       return $response;

 


   }
    else
   {
        throw new \yii\web\HttpException(400, 'No Params Received');
   }


}




public function actionSurveyquestion()
{

$model = new $this->modelClass([]);
mysql_set_charset('utf8');

    if(Yii::$app->getRequest()->getQueryParam('module')!="Surveycontentview")
     {
 throw new \yii\web\HttpException(404, 'Method Not Found');
     } 
    else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['survey_id'])) 
    {  

  $sql2 = "select c.survey_id, c.survey_title, c.survey_tag, c.status, c.start_date, c.end_date,a.question_id, a.question_code, a.question, a.option_A, a.option_B,a.option_C, a.option_D, a.option_E, a.correct_answer, a.num_answers, a.cue, a.num_correct_ans,a.max_attempt from question_master a,
survey_participant b,plain_survey c,allocation_master d where b.survey_id='".$_REQUEST["survey_id"]."' and b.empid='".$_REQUEST["userid"]."' and b.survey_id=c.survey_id and b.empid=d.emp_id and b.survey_id=d.mod_record_id and d.related_question_id=a.question_id and b.status='NEW' and d.module='2'";


$res2 = mysql_query($sql2);
   $nrw = mysql_num_rows($res2);

  $survey = array();
  while($row2 = mysql_fetch_assoc($res2))
  {
  $survey[] = array('survey_id'=>$row2['survey_id'],'question_id'=>$row2['question_id'],'description'=>$row2['survey_title'],
'question'=>$row2['question'],'option_A'=>$row2['option_A'],'option_B'=>$row2['option_B'],'option_C'=>$row2['option_C'],'option_D'=>$row2['option_D'],
'option_E'=>$row2['option_E'],'num_answers'=>$row2['num_answers'],'num_correct_ans'=>$row2['num_correct_ans']);
  } 


  if($nrw ==0)
  {


     $response['message']['success']="false";
       $response['message']['data']['result']="";

  }
  else
  {



  $response['message']['success']="true";
     $response['message']['data']['result']=$survey;


 }

  return $response;



   }
    else
   {
        throw new \yii\web\HttpException(400, 'No Params Received');
   }


}




public function actionAvailableinfonuggets()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Infocontentview")
    {
      throw new \yii\web\HttpException(404, 'Method Not Found');
    }
   else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   {  

$sql2 = "select ant.empid,ant.info_nuggest_id,ant.title, ant.tag,ant.status,ant.content,ant.subject_name,
       ant.f_name,ifnull(bat.filename,'NA') as filename ,ifnull(bat.filepath,'NA') as filepath ,
       ant.content_text
from
(select a.empid,a.info_id as info_nuggest_id,b.title, b.tag,b.status,c.title as content,
       d.subject_name,e.f_name,c.content_text
from infonugget_participant a,
     info_nuggets b,
     subject_master d left outer join content_master c on c.subject = d.subject_id
     left outer join file_transfer e on c.content_type=e.f_id
where a.info_id=b.info_nuggest_id
and a.status !='Closed'
and b.status='Published'
and b.subject = d.subject_id
and a.empid='".$_REQUEST["userid"]."'
group by a.info_id) as ant

left outer join

(select b.info_nuggest_id,b.content,f.filename,f.filepath
from info_nuggets b left outer join documentsupload  f on b.content=f.modid and f.module='ContentMaster') as
 bat on ant.info_nuggest_id=bat.info_nuggest_id group by ant.info_nuggest_id";

 $res2 = mysql_query($sql2);
  $nrw = mysql_num_rows($res2);
  $reinforce = array();
  while($row2 = mysql_fetch_assoc($res2))
  {
  $reinforce[] = array('info_nuggest_id'=>$row2['info_nuggest_id'],'title'=>$row2['title'],'tag'=>$row2['tag'],'status'=>$row2['status'],'f_name'=>$row2['f_name'],'tag'=>$row2['tag'],'filename'=>$row2['filename'],'path'=>$row2['filepath'],'content'=>$row2['content'],'subject_name'=>$row2['subject_name'],'f_description'=>$row2['content_text']);
  } 


if($nrw == 0)
  {
  //$response = '{"message":{"success":"false","data":{"result":""}}}';


 $response['message']['success']="false";
 $response ['message']['data']['reinforce']="";
  }
  else
  {
 // $response = '{"message":{"success":"true","data":{"result":'.json_encode($class).'}}}';

$response['message']['success']="true";

$response['message']['data']['reinforce']=$reinforce;


  }

  return $response;





   }
 else
   {
        throw new \yii\web\HttpException(400, 'No Params Received');
   }

}




public function actionInfonuggetsdetails()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Infocontentview")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['id'])) 
   { 

       $sql2 = "select c. info_nuggest_id, c.title, c.tag, c.status, c.schedule_start_date,
       c.schedule_end_date,a.question_id, a.question_code, a.question, a.option_A, a.option_B, a.option_C,
        a.option_D, a.option_E, a.correct_answer, a.num_answers, a.cue, a.num_correct_ans,a.max_attempt
from question_master a,infonugget_participant b,info_nuggets c, allocation_master d
where b.info_id='".$_REQUEST["id"]."' and b.empid='".$_REQUEST["userid"]."' and b.info_id=c.info_nuggest_id
 and b.empid=d.emp_id and b.info_id=d.mod_record_id and d.related_question_id=a.question_id and
  b.status='NEW' and d.module='1' group by a.question_id";




  $res = mysql_query($sql2);
  //$row = mysql_fetch_object($res);
 $nrw = mysql_num_rows($res);

  while($row = mysql_fetch_assoc($res))
  {
  
  $reinforce[] = array('info_nuggest_id'=>$row['info_nuggest_id'],'questions_id'=>$row['question_id'],'question'=>$row['question'],'num_answers'=>$row['num_answers'],'num_correct_ans'=>$row['num_correct_ans'],'option_A'=>$row['option_A'],'option_B'=>$row['option_B'],'option_C'=>$row['option_C'],
'option_D'=>$row['option_D'],'option_E'=>$row['option_E'],'max_attempt'=>$row['max_attempt']);
 // $nrw = mysql_num_rows($res);
  }




  if($nrw == 0)
  {
  //$response = '{"message":{"success":"true","data":{"question":"null"}}}';

  $response['message']['success']="false";
  $response['message']['data']['question']="null";

  }
  else
  {
  //$response = '{"message":{"success":"true","data":{["reinforce":'.json_encode($reinforce).',"question":'.json_encode($question).']}}}';
  //$response = '{"message":{"success":"true","data":{"question":'.json_encode($reinforce).'}}}';

     $response['message']['success']="true";
  $response['message']['data']['question']=$reinforce;

  }
  return $response;


   }
 else
   {
        throw new \yii\web\HttpException(400, 'No Params Received');
   }

}






public function actionInfonuggetsupdatequestion()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Infocontentview")
    {

     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['data'])) 
   { 


$newdata = json_decode(urldecode(stripslashes($_REQUEST['data'])),true);
		if(count($newdata)!=0)
		{
		$x=0;



					while(count($newdata)>$x)
					{
					$sql="SELECT question_id,correct_answer,marks,max_attempt FROM question_master where question_id='".$newdata[$x]['req_id']."' group by question_id";
					
					
				$res = mysql_query($sql);
						$rt=mysql_fetch_assoc($res);
						$new_question_id[] = $rt['question_id'];
						
						//$new_file_name[] = $rt['file_name'];
						$new_infonugget_id[] = $newdata[$x]['re_id'];
						$new_infonugget_id1 = $newdata[$x]['re_id'];
						$mark = $rt['marks'];
						$correct_answer = $rt['correct_answer'];
						if($correct_answer==$newdata[$x]['response']){
						
						$marks=$mark;
						}else{
						$marks=0;
						}
				
						
						//	$attempt = $sms_ass['maximum_att']+1;
							$emp="update allocation_master set response = '".$newdata[$x]['answer']."',marks ='$marks' where module=1 and mod_record_id='".$newdata[$x]['re_id'] ."' and emp_id='$userid' and related_question_id='".$newdata[$x]['req_id'] ."'";
							$empres = mysql_query($emp);
							$participant = "update infonugget_participant set status='Closed', noattempts='1' where info_id='".$newdata[$x]['re_id']."' and empid='$userid'";
		$participantres =mysql_query($participant);
							//$resp = 'accecpt';
						$file = "select g.f_name,h.filename,h.path from plain_survey a,survey_question b,content_master e,subject_master f,file_transfer g,attachments h
where a.survey_id=b.survey_id and a.survey_content=e.content_id
and a.survey_subject=f.subject_id
and a.survey_content=h.record_id and  date(now()) between date(a.start_date) and date(a.end_date) and a.survey_id='".$newdata[$x]['re_id']."' group by a.survey_id";	
					$res1 = mysql_query($file);
						$rt1=mysql_fetch_assoc($res1);
						$new_file_name = $rt1['filename'];	
					
					$x++;
					}
			$unique=$new_infonugget_id;
			$unique2=$new_file_name;
			$duplicated=array();

			/*
				foreach($unique as $k=>$v) 
					{

					foreach($unique2 as $k=>$v) 
					{
					  if( ($kt=array_search($v,$unique))!==false and $k!=$kt )
					 { 
					 unset($unique[$kt]);
					 unset($unique2[$kt]);  
					 $duplicated[]=$v; 
					 }

				}}
			
			sort($unique); 
		 	sort($unique2);*/


	$response['message']['success']="true";
	$response['message']['message']="successfully Updated";
	$response['message']['data'][0]['infonugget_id']=$new_infonugget_id1;

	$response['message']['data'][0]['file_name']=$unique2;


      }
  else
  {


	$response['message']['success']="true";
	$response['message']['message']="no data updated";
	$response['message']['data'][]['infonugget_id']="";
	$response['message']['data'][]['file_name']="";

  }

return $response;
  }
 else
   {
        throw new \yii\web\HttpException(400, 'No Params Received');
   }

}




public function actionAvailableojt()
{
$model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="PlanOjt")
    {
throw new \yii\web\HttpException(404, 'Method Not Found');
    }
 else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 

$sql2 = "select distinct b.ojt_supervisor as empid,b.ojt_id,b.ojt_title, b.ojt_tag,b.ojt_description,
  b.status,b.start_date,b.end_date,c.title as content,d.subject_name,e.f_name,f.filename,f.filepath,
  c.content_text
from ojt_participant a,
     plan_ojt b,
     content_master c,
     subject_master d,
     file_transfer e,
     documentsupload  f
where  a.ojt_id=b.ojt_id and
       b.ojt_content = c.content_id and
       b.ojt_subject = d.subject_id and
       c.content_type=e.f_id and
       b.ojt_content=f.modid and
       f.module='ContentMaster' and
a.status !='Closed' and b.ojt_supervisor='".$_REQUEST['userid']."'
union

select distinct a.empid as empid,b.ojt_id,b.ojt_title, b.ojt_tag,b.ojt_description,b.status,b.start_date,b.end_date,c.title as content,d.subject_name,
       e.f_name,f.filename,f.filepath,c.content_text
from ojt_participant a,
     plan_ojt b,
     content_master c,
     subject_master d,
     file_transfer e,
     documentsupload  f
where  a.ojt_id=b.ojt_id and
       b.ojt_content = c.content_id and
       b.ojt_subject = d.subject_id and
       c.content_type=e.f_id and
       b.ojt_content=f.modid and
       f.module='ContentMaster' and
a.participant_status !='Closed' and a.empid='".$_REQUEST['userid']."'";



$res2 = mysql_query($sql2);
  $nrw = mysql_num_rows($res2);
  $class = array();
  while($row2 = mysql_fetch_assoc($res2))
  {
  $class[] = array('ojt_id'=>$row2['ojt_id'],'title'=>$row2['ojt_title'],'tag'=>$row2['ojt_tag'],
    'description'=>$row2['ojt_description'],'status'=>$row2['status'],'start_date'=>$row2['start_date'],'end_date'=>$row2['end_date'],'f_name'=>$row2['f_name'],'filename'=>$row2['filename'],'path'=>$row2['filepath'],'content'=>$row2['content'],'subject_name'=>$row2['subject_name'],'f_description'=>$row2['content_text']);
  } 


  if($nrw == 0)
  {
 // $response = '{"message":{"success":"false","data":{"result":""}}}';


    $response['message']['success']="false";

$response['message']['data']['result']="";
  }
  else
  {
//  $response = '{"message":{"success":"true","data":{"result":'.json_encode($class).'}}}';


    $response['message']['success']="true";

$response['message']['data']['result']=$class;
  }
  return $response;

}
 else
   {
        throw new \yii\web\HttpException(400, 'No Params Received');
   }

}



public function actionOjt()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="PlanOjt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['ojt_id'])) 
   { 



   $sql2="select distinct c.ojt_id,e.username, b.empid,a.question_id,a.question_code, a.question,
     a.option_A, a.option_B, a.option_C, a.option_D, a.option_E, a.correct_answer, 
     a.num_answers, a.cue, a.num_correct_ans,a.max_attempt
  from question_master a,ojt_participant b,plan_ojt c, allocation_master d,user e
where b.ojt_id='".$_REQUEST["ojt_id"]."' and (b.supviser_id='".$_REQUEST["userid"]."' or b.empid='".$_REQUEST["userid"]."') and
 b.ojt_id=c.ojt_id and b.empid=d.emp_id
 and b.ojt_id=d.mod_record_id and d.related_question_id=a.question_id and (b.status='NEW'
  or b.participant_status='NEW') and d.module='3' and b.empid=e.id";



  $res2 = mysql_query($sql2);
  $nrw = mysql_num_rows($res2);
  $class = array();
  while($row2 = mysql_fetch_assoc($res2))
  {
  $class[] = array('ojt_id'=>$row2['ojt_id'],'Participant_Name'=>$row2['username'],'Participant_id'=>$row2['empid'],'question_id'=>$row2['question_id'],'question'=>$row2['question'],'question_code'=>$row2['question_code'],
  'option_A'=>$row2['option_A'],
  'option_B'=>$row2['option_B'],
  'option_C'=>$row2['option_C'],
  'option_D'=>$row2['option_D'],
  'option_E'=>$row2['option_E'],
  'correct_answer'=>$row2['correct_answer'],
  'num_answers'=>$row2['num_answers'],
  'cue'=>$row2['cue'],
  'num_correct_ans'=>$row2['num_correct_ans'],
  );
  }

 if($nrw == 0)
  {
 // $response = '{"message":{"success":"false","data":{"result":""}}}';


    $response['message']['success']="false";

$response['message']['data']['result']="";
  }
  else
  {
//  $response = '{"message":{"success":"true","data":{"result":'.json_encode($class).'}}}';


    $response['message']['success']="true";

$response['message']['data']['result']=$class;
  }
  return $response;




 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}




public function actionUpdateojt()
{


 $model = new $this->modelClass([]);


  if(Yii::$app->getRequest()->getQueryParam('module')!="PlanOjt")
    {

     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['data'])) 
   { 

$dataview=stripslashes($_REQUEST['data']);
$newdata = json_decode($dataview,true);
$del_ojt = array();
$sessionval = array();
$del_arr = array();

//$role = get_role($_REQUEST['userid']);
$reviewid = $role['reviewid'];
$roleid = $role['role_id'];







if(count($newdata)!=0)
{
$x=0;

while(count($newdata)>$x)
{
$ojt_id = $newdata[$x]['ojt_id'];
$del_ojt[] = $newdata[$x]['ojt_id'];
$question_id = $newdata[$x]['question_id'];
$emp_id = $newdata[$x]['emp_id'];
$remark = $newdata[$x]['remark'];
$comments = $newdata[$x]['comments'];
//$file_location = $newdata[$x]['file_location'];
//$file_location = str_replace(" ", "_",$newdata[$x]['file_location']);
//$file_location = preg_replace("/[^-_a-z0-9]+/i", "_", $newdata[$x]['file_location']);
$option_A = $newdata[$x]['opt_a_rating'];
$option_B = $newdata[$x]['opt_b_rating'];
$option_C = $newdata[$x]['opt_c_rating'];
$option_D = $newdata[$x]['opt_d_rating'];
$option_E = $newdata[$x]['opt_e_rating'];
$option_F = $newdata[$x]['opt_f_rating'];
$option_G = $newdata[$x]['opt_g_rating'];
$option_H = $newdata[$x]['opt_h_rating'];
$option_I = $newdata[$x]['opt_i_rating'];
$option_J = $newdata[$x]['opt_j_rating'];

$sql="SELECT question_id,correct_answer,marks,max_attempt FROM question_master where question_id='".$newdata[$x]['question_id']."'";
   // $sql="select session_id from ojt_question_master where question_id='".$newdata[$x]['question_id']."'";
	$res = mysql_query($sql);
	$rt=mysql_fetch_assoc($res);
	$resp = '';
	$sessionval[$rt['session_id']] = $newdata[$x]['ojt_id'];
	//$question[$rt['session_id']] = $newdata[$x]['ojt_id'];
	$del_arr[] = array('emp_id'=>$emp_id,'question_id'=>$question_id,'ojt_id'=>$ojt_id);
	


 $supervisorid ="select distinct supviser_id from ojt_participant where ojt_id='$ojt_id'";

    $sid = mysql_query($supervisorid);
    $ressid = mysql_fetch_assoc($sid);
  
    $supID =$ressid['supviser_id'];


   if($userid == $emp_id)   // if condition true - he is participant
	{
	$insertParticipantScore="insert into ojt_participant_score(empid, ojt_id, question_id, attempt, marks, supervisor_id, comments, remarks, option_A, option_B, option_C, option_D, option_E,option_F, option_G, option_H,option_I, option_J, attempt_date) values('$emp_id','$ojt_id','$question_id',1,0,'$supID','$comment','$remark','$option_A','$option_B','$option_C','$option_D','$option_E','$option_F','$option_G',
'$option_H','$option_I','$option_J',now())";

          $empres = mysql_query($insertParticipantScore);


$participant = "update ojt_participant set participant_status='Closed', noattempts='1' where ojt_id='$ojt_id' and supviser_id='$userid' and empid='$emp_id'";
		$participantres =mysql_query($participant);

	} else
	{
	//echo 'HIIIII';
	 $insertsupscore="insert into ojt_supervisor_score(empid, ojt_id, question_id, attempt, marks, supervisor_id, comments, remarks, option_A, option_B, option_C, option_D, option_E,option_F, option_G, option_H,option_I, option_J, attempt_date) values('$emp_id','$ojt_id','$question_id',1,0,'$supID','$comments','$remark','$option_A','$option_B','$option_C','$option_D','$option_E','$option_F','$option_G',
'$option_H','$option_I','$option_J',now())";
	 
         $empres = mysql_query($insertsupscore);

	$participant = "update ojt_participant set status='Closed', noattempts='1' where ojt_id='$ojt_id' and supviser_id='$userid' and empid='$emp_id'";
		$participantres =mysql_query($participant);
	}



$today12 = \date("Y-m-d H:i:s");

$x++;
}

$newojt = array_unique($del_ojt);
$unique = array();
$unique2 = array();

foreach ($newojt as &$value) 
{
  


    $unique[] = $value;
}
$sessionval2 = $sessionval;
foreach ($sessionval2 as $key => $value)
 {

  
	$unique2[] = $key.'^'.$value;
	

}

//$response = '{"message":{"success":"true","message":"successfully Updated","data":{"ojt_id":'.json_encode($del_arr).'}}}';
$response['message']['success']="true";

$response['message']['message']="Successfully Updated";

$response['message']['data']['ojt_id']=$del_arr;




}
else
{
//$response = '{"message":{"success":"true","message":"no data updated","data":{"ojt_id":""}}}';

$response['message']['success']="true";

$response['message']['message']="No data updated";

$response['message']['data']['ojt_id']="";





}

return $response;


 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}






public function actionAvailabletrainingclass()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crtcontentview")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 

  $sql2 = "SELECT distinct a.empid,a.crt_id,b.crt_id, b.crt_title, b.trainer, b.crt_tag, b.crt_description,
  b.alert_method, b.alert_content, b.start_date,b.end_date,d.description,d.pre_coaching,
  concat(e.first_name,'',e.last_name) as Name

 FROM crt_participant a,
      crt b,
      module_masters d,
      user e

 where  a.crt_id = b.crt_id and
        a.empid = e.id and
        a.status !='Closed'  and
        a.empid='".$_REQUEST["userid"]."' and b.crt_module=d.module_id group by a.crt_id";


/* $connection=\Yii::$app->db;
   $query2=$connection->createCommand($sql2);
   $response=$query2->queryAll();
   return $response;*/

   $res2 = mysql_query($sql2);
  $nrw = mysql_num_rows($res2);
  $class = array();
  while($row2 = mysql_fetch_assoc($res2))
  {
  $class[] = array('crt_id'=>$row2['crt_id'],'title'=>$row2['crt_title'],'tag'=>$row2['crt_tag'],'description'=>$row2['crt_description'],'status'=>$row2['status'],'start_date'=>$row2['start_date'],'end_date'=>$row2['end_date'],'module_name'=>$row2['module_name'],'description'=>$row2['description'],'material'=>$row2['pre_coaching']);
  } 

  if($nrw == 0)
  {
  //$response = '{"message":{"success":"false","data":{"result":""}}}';


 $response['message']['success']="false";
 $response ['message']['data']['result']="";
  }
  else
  {
 // $response = '{"message":{"success":"true","data":{"result":'.json_encode($class).'}}}';

$response['message']['success']="true";

$response['message']['data']['result']=$class;


  }
  return $response;
  


 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}





public function actionTrainingclass()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['class_id'])) 
   { 


  $sql2 = "select a.cqm_id,a.crt_id,a.module_id, a.session_id, a.subject_id, a.question_id as question_map,
       b.question_id, b.question_code, b.question, b.option_A, b.option_B, b.option_C,
       b.option_D, b.option_E, b.correct_answer,b.max_attempt,b.num_answers, b.cue, b.num_correct_ans,b.question_type,
       c.crt_title, c.trainer, c.crt_tag, c.crt_description,c.alert_method, c.alert_content, c.start_date,
       c.end_date  FROM crt_question_mapping a, 
      question_master b,
      crt c
where a.question_id = b.question_id and
      a.crt_id = c.crt_id and
      a.crt_id='".$_REQUEST["class_id"]."'";  

  $res2 = mysql_query($sql2);
  $nrw = mysql_num_rows($res2);
  $class = array();
  while($row2 = mysql_fetch_assoc($res2))
  {
  $class[] = array('session_id'=>$row2['session_id'],'crt_id'=>$row2['crt_id'],'title'=>$row2['crt_title'],'tag'=>$row2['crt_tag'],'description'=>$row2['crt_description'],'status'=>$row2['status'],'start_date'=>$row2['start_date'],'end_date'=>$row2['end_date'],'question_id'=>$row2['question_id'],'question_type'=>$row2['question_type'],'question'=>$row2['question'],'question_code'=>$row2['question_code'],
  'option_A'=>$row2['option_A'],
  'option_B'=>$row2['option_B'],
  'option_C'=>$row2['option_C'],
  'option_D'=>$row2['option_D'],
  'option_E'=>$row2['option_E'],
  'correct_answer'=>$row2['correct_answer'],
  'num_answers'=>$row2['num_answers'],
  'cue'=>$row2['cue'],
  'num_correct_ans'=>$row2['num_correct_ans']);
  }   




  if($nrw == 0)
{
  //  $response = '{"message":{"success":"false","data":{"result":""}}}';


 $response['message']['success']="false";
 $response ['message']['data']['result']="";
  }
  else
  {
 //  $response = '{"message":{"success":"true","data":{"result":'.json_encode($class).'}}}';

$response['message']['success']="true";

$response['message']['data']['result']=$class;


  }


 return $response;


 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}







public function actionUpdatetrainingclass()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['data'])) 
   { 
		mysql_set_charset('utf8');
		$userid=$_REQUEST['userid'];	
		$dataview=stripslashes($_REQUEST['data']);
		$newdata = json_decode($dataview,true);
	
		//return print_r($newdata);
	//	print_r($newdata);
		$del_class = array();
		$del_session = array();	

		$del_questionid = array();	
		if(count($newdata)!=0)
		{
	
		$x=0;
		while(count($newdata)>$x)
		{
		 $classid = $newdata[$x]['class_id'];
		$del_class[] = $newdata[$x]['class_id'];
		$empid = $userid;
		$ans = $newdata[$x]['answer'];
		$today12 = date("Y-m-d H:i:s");
			//echo $classid."<====>";
			//$sql="select session_id,question_id, correct_answer, marks, max_attempt from question_master where question_id='".$newdata[$x]['question_id']."'";
			
			$sql="SELECT question_id,correct_answer,marks,max_attempt FROM question_master where question_id='".$newdata[$x]['question_id']."'";
			$sql1="SELECT question_id,session_id FROM crt_question_mapping where question_id='".$newdata[$x]['question_id']."'";
			$res1 = mysql_query($sql1);
			$rt1=mysql_fetch_assoc($res1);

			$res = mysql_query($sql);
			$rt=mysql_fetch_assoc($res);
			$resp = '';
			$marks = $rt['marks'];
			$sessionid = $rt1['session_id'];
			$sessionval = $rt1['session_id'];
			$del_session[$classid][] = $rt1['session_id'];
			$del_questionid[$classid][] = $rt1['question_id'];
			/*$sms_score = "select question_id, emp_id, response, attempt, marks from allocation_master where 
question_id='".$newdata[$x]['question_id']."' and class_id='$classid' and emp_id='$userid'";*/



	$sms_score = "select related_question_id, emp_id, response,  marks from allocation_master where 
related_question_id='".$newdata[$x]['question_id']."'  and emp_id='$userid'";


			$sms_res = mysql_query($sms_score)or die(mysql_error());
			$sms_ass = mysql_fetch_assoc($sms_res);
			
		
		//$max_attempt = $sms_ass['attempt'];
		$question_id = $newdata[$x]['question_id'];

				if($rt['correct_answer']==$ans)
				{
				$attempt = $sms_ass['attempt']+1;
				
				//$emp="update sms_scores set response = '".$rt['correct_answer']."',attempt = '$attempt',marks = '".$rt['marks']."',time = now() where question_id = '".$sms_ass['question_id']."' and  emp_id = '".$sms_ass['emp_id']."' and class_id='$classid'";
				$emp="update allocation_master set response = '".$newdata[$x]['response']."',marks ='$marks' where module=4 and mod_record_id='".$newdata[$x]['class_id']."' and emp_id='$userid' and related_question_id='".$newdata[$x]['question_id'] ."' ";
				$empres = mysql_query($emp);
	$participant = "update crt_participant set status='Closed', noattempts='1' where crt_id='".$newdata[$x]['class_id']."' and empid='$userid'";
		$participantres =mysql_query($participant);
		
$ssql = "update crt_session_type_participants set status='Closed',max_score='$marks' where crt_id='".$newdata[$x]['class_id']."' and emp_id='$userid'";
$participantres1 =mysql_query($ssql);

				$resp = 'correct';
				}
				else
				{
				 $attempt = $sms_ass['attempt']+1;
				$emp="update allocation_master set response = '".$newdata[$x]['response']."',marks =0 where module=4 and
 mod_record_id='".$newdata[$x]['class_id']."' and emp_id='$userid' and related_question_id='".$newdata[$x]['question_id'] ."'";
				$empres = mysql_query($emp);
				$resp = 'wrong';
				}
				
		$x++;
		}
		
		
		$newclass = array_unique($del_class);
		$unique = array();
		$unique2 = array();
		foreach ($newclass as &$value) {
		$unique[] = $value;
		//$newsession = array_unique($del_session[$value]);
		$newsession = array_unique($del_questionid[$value]);
		foreach ($newsession as &$value2) 
		{
		$unique2['class'.$value][] = $value2;
		}
		
		}


		//$response = '{"message":{"success":"true","message":"successfully Updated","data":{"class_id":'.json_encode($unique).',"session":'.json_encode($unique2).'}}}';

$response['message']['success']="true";
$response['message']['message']="successfully Updated";
$response['message']['data']['class_id']=$unique;
$response['message']['data']['session']=$unique2;



		//$response = '{"message":{"success":"true","message":"successfully Updated","data":{"class_id":'.json_encode($unique).',"session":'.$rt['session_id'].'}}}';
		}
  		else
 		 {
 // $response = '{"message":{"module":"nodata","success":"true","message":"no data updated","data":{"class_id":"","session":""}}}';

$response['message']['module']="nodata";

$response['message']['success']="true";

$response['message']['message']="no data updated";

$response['message']['data']['class_id']="";
$response['message']['data']['session']="";


  }


 return $response;


 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}





public function actionSessiontypepassword()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['class_id'])) 
   { 


 $sql2 = "select session_id, session_type_id, session_type, session_type_password,
  sess_type_pass_status,crt_id from crt_session_type_pass where crt_id='".$_REQUEST["class_id"]."' and 
  sess_type_pass_status=1";


/*$connection=\Yii::$app->db;
   $query2=$connection->createCommand($sql2);
   $response=$query2->queryAll();
   return $response;*/

   $res2 = mysql_query($sql2);
  $nrw = mysql_num_rows($res2);
  $class = array();
  while($row2 = mysql_fetch_assoc($res2))
  {
  $class[] = array('session_id'=>$row2['session_id'],'session_type_id'=>$row2['session_type_id'],'session_type'=>$row2['session_type'],'session_type_password'=>$row2['session_type_password'],'sess_type_pass_status'=>$row2['sess_type_pass_status'],'crt_id'=>$row2['crt_id']);
  } 

 
if($nrw == 0)
{
  //  $response = '{"message":{"success":"false","data":{"result":""}}}';


 $response['message']['success']="false";
 $response ['message']['data']['result']="";
  }
  else
  {
 //  $response = '{"message":{"success":"true","data":{"result":'.json_encode($class).'}}}';

$response['message']['success']="true";

$response['message']['data']['result']=$class;


  }

  return $response;


 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}




public function actionAvailablematerial()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {

     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['class_id'])) 
   { 


  $sql2 ="select distinct a.crt_id,f.emp_id,c.pre_coaching_id as material,c.pre_coaching_title as title,
c.pre_coaching_desc as description,e.filepath,e.filename,g.f_name as contenttype,d.content_text
 from crt a,module_masters b,pre_coaching_master c,content_master d,documentsupload e,allocation_master f,
 file_transfer g where a.crt_id='".$_REQUEST["class_id"]."' and a.crt_module=b.module_id and 
 b.pre_coaching_name=c.pre_coaching_id and c.pre_coaching_subject=d.subject and d.content_id=e.modid
  and c.pre_coaching_subject=d.subject and d.content_type=g.f_id and e.module='ContentMaster' 
  and f.mod_record_id='".$_REQUEST["class_id"]."' and f.emp_id='".$_REQUEST["userid"]."'";



// $connection=\Yii::$app->db;
//    $query2=$connection->createCommand($sql2);
//    $response=$query2->queryAll();
//    return $response;


  $res2 = mysql_query($sql2);
   $nrw = mysql_num_rows($res2);

  $class = array();
  while($row2 = mysql_fetch_assoc($res2))
  {
  $class[] = array('material_id'=>$row2[material],'title'=>$row2['title'], 'description'=>$row2['description'],'crt_id'=>$row2['crt_id'],'emp_id'=>$row2['emp_id'],'fileurl'=>$row2['filepath'],'file_name'=>$row2['filename'],'content_type'=>$row2['contenttype'],'f_description'=>$row2['content_text']);

  }


 if($nrw == 0)
  {
  //$response = '{"message":{"success":"false","data":{"result":""}}}';


 $response['message']['success']="false";
 $response ['message']['data']['result']="";
  }
  else
  {
 // $response = '{"message":{"success":"true","data":{"result":'.json_encode($class).'}}}';

$response['message']['success']="true";

$response['message']['data']['result']=$class;


  }

  return $response;

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}








public function actionMaterialquestion()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['class_id']) && isset($_POST['material_id'])) 
   { 

$materialid=$_REQUEST['material_id'];
$class_id=$_REQUEST['class_id'];

   $sql2 = "select distinct c.* from pre_coaching_master a,pre_coaching_question b,question_master c
 where a.pre_coaching_id='".$materialid."' and a.pre_coaching_id=b.pre_coaching_id and
  b.question_id=c.question_id";


$res2 = mysql_query($sql2);
  $nrw = mysql_num_rows($res2);
  $class = array();
  while($row2 = mysql_fetch_assoc($res2))
  {
   
  $class[] = array('question_id'=>$row2['question_id'],'question'=>$row2['question'],'option_A'=>$row2['option_A'],'option_B'=>$row2['option_B'],'option_C'=>$row2['option_C'],'option_D'=>$row2['option_D'],'option_E'=>$row2['option_E'],'correct_answer'=>$row2['correct_answer'], 'marks'=>$row2['marks'], 'num_answer'=>$row2['num_answers'],'num_correct_answer'=>$row2['num_correct_ans'],'crt_id'=>$class_id,'material_id'=>$materialid);

  } 
  
 if($nrw == 0)
  {
  //$response = '{"message":{"success":"false","data":{"result":""}}}';


 $response['message']['success']="false";
 $response ['message']['data']['result']="";
  }
  else
  {
 // $response = '{"message":{"success":"true","data":{"result":'.json_encode($class).'}}}';

$response['message']['success']="true";

$response['message']['data']['result']=$class;


  }

  return $response;



/*$connection=\Yii::$app->db;
   $query2=$connection->createCommand($sql2);
   $response=$query2->queryAll();
   return $response;*/

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}




public function actionAddfilecomment()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="EmployeeSpeak")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['data'])) 
   { 

        $dataview=$_REQUEST['data'];   

  // $dataview=stripslashes($data);


        $dataview=stripslashes($dataview);
        $newdata = json_decode($dataview,true);

if(count($newdata)!=0)
{
$x=0;
while(count($newdata)>$x)
{

$t_id = $newdata[$x]['t_id'];

$emp_id = $newdata[$x]['emp_id'];
$comments = $newdata[$x]['comments'];

$created_date = $newdata[$x]['created_date'];

$converttoutc  = strtotime($created_date);

    //$emp="insert into file_comment ( t_id, emp_id, comments, created_date,module_name) values ('$t_id', '$emp_id', '$comments', '$created_date','offisocio')";

        $emp="insert into `comment` (entity, text,created_by, updated_by, created_at, updated_at, module)
values ('$t_id', '$comments','$emp_id', '$emp_id', '$converttoutc','$converttoutc','employee-speaknew')";
    $empres = mysql_query($emp);


$x++;
}

//print_r($unique2);

//$response = '{"message":{"success":"true","message":"successfully Updated","data":{"ojt_id":'.json_encode($unique2).',"session_id":'.json_encode($unique2).'}}}';

//$response = '{"message":{"success":"true","message":"successfully Inserted","data":{"fileComment":"Success"}}}';

$response['message']['success']="true";
$response['message']['message']="Successfully Inserted";
$response['message']['data']['fileComment']="Success";

}
else
{
//$response = '{"message":{"success":"true","message":"no data updated","data":{"ojt_id":"","session_id":""}}}';

//$response = '{"message":{"success":"true","message":"no data updated","data":{"fileComment":""}}}';

$response['message']['success']="true";

$response['message']['message']="no data updated";

$response['message']['data']['fileComment']="";


}

return $response;





 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}



public function actionFilelikes()
{

 $model = new $this->modelClass([]);
 if(Yii::$app->getRequest()->getQueryParam('module')!="EmployeeSpeak")
    {


     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 

$userid=$_REQUEST['userid'];
      $sqlre="select b.lkid,a.t_id,a.total,ifnull(likes,'0') as likes,b.created_date from (SELECT t_id,sum(likes) as total FROM file_like where  module_name='offisocio' group by t_id) as a left outer join (SELECT a.lkid,a.t_id,a.likes,a.created_date FROM file_like a,user b 
where a.emp_id=b.id and module_name='offisocio' and  a.emp_id='$userid' group by t_id) as b on a.t_id=b.t_id";

	$resRe = mysql_query($sqlre);
	$nremark = mysql_num_rows($resRe);
	$remark = array();
	while($rowRw= mysql_fetch_assoc($resRe))
	{
	$remark[] = array('id'=>$rowRw['lkid'],'t_id'=>$rowRw['t_id'],'likes'=>$rowRw['likes'],'created_date'=>$rowRw['created_date']);
	}	

    if($nremark == 0)
    {
  // $response = '{"message":{"success":"false","data":{"result":""}}}';
      $response['message']['success']="false";
       $response['message']['data']="";

    }
    else
    {
  // $response = '{"message":{"success":"true","data":{"result":'.json_encode($remark).'}}}';
   $response['message']['success']="true";
   $response['message']['data']['result']=$remark;

    }
    return $response;
 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}



public function actionFilecomment()
{

 $model = new $this->modelClass([]);
 if(Yii::$app->getRequest()->getQueryParam('module')!="EmployeeSpeak")
    {


     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid'])) 
   { 

 $sqlre = "select a.id as cmid,a.entity as t_id,a.text as comments,a.created_at as created_date,concat(ifnull(b.first_name,''),'',ifnull(b.last_name,'')) as EmpName from comment a,user b,employee_speak c where a.created_by=b.id and a.entity=c.empspk_id and c.status ='Offisocio'";
	  
	  

	$resRe = mysql_query($sqlre);
	$nremark = mysql_num_rows($resRe);
	$remark = array();
	while($rowRw= mysql_fetch_assoc($resRe))
	{
            $ts = $rowRw['created_date'];
            $date = new \DateTime("@$ts");
            

	$remark[] = array('id'=>$rowRw['cmid'],'t_id'=>$rowRw['t_id'],'EmpName'=>$rowRw['EmpName'],'profileurl'=>'images/user1.jpg','comments'=>$rowRw['comments'],'created_date'=>$date->format('Y-m-d H:i:s') );
	}



    if($nremark == 0)
    {
  // $response = '{"message":{"success":"false","data":{"result":""}}}';
      $response['message']['success']="false";
       $response['message']['data']="";

    }
    else
    {
  // $response = '{"message":{"success":"true","data":{"result":'.json_encode($remark).'}}}';
   $response['message']['success']="true";
   $response['message']['data']['result']=$remark;

    }
    return $response;
 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}

/*
public function actionAddfilelikes()
{

 $model = new $this->modelClass([]);



  if(Yii::$app->getRequest()->getQueryParam('module')!="EmployeeSpeak")
    {


     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) 
   { 

$userid=$_REQUEST['userid'];

  $sqlre="select b.lkid,a.t_id,a.total,ifnull(likes,'0') as likes,b.created_date from (SELECT t_id,sum(likes) as total FROM file_like where  module_name='offisocio' group by t_id) as a left outer join (SELECT a.lkid,a.t_id,a.likes,a.created_date FROM file_like a,user b where a.emp_id=b.id
and module_name='offisocio' and  a.emp_id='$userid' group by t_id) as b on a.t_id=b.t_id";


	$resRe = mysql_query($sqlre) or die(mysql_error());
	$nremark = mysql_num_rows($resRe);
	$remark = array();
	while($rowRw= mysql_fetch_assoc($resRe))
	{
	$remark[] = array('id'=>$rowRw['lkid'],'t_id'=>$rowRw['t_id'],'likes'=>$rowRw['likes'],'created_date'=>$rowRw['created_date']);
	}	



   if($nremark == 0)
    {
   // $response = '{"message":{"success":"false","data":[]}}';

     $response['message']['success']="false";
   $response['message']['data']="";

    }
    else
    {
    //$response = '{"message":{"success":"true","data":{"total":"'.$row['total'].'","you":"'.$row1['likes'].'"}}}';
    //$response = '{"message":{"success":"true","data":{"total":{'.implode(",",$total).'},"you":'.implode(",",$you).'}}}';


  //  $response = '{"message":{"success":"true","data":['.implode(",",$you).']}}';

   $response['message']['success']="true";
   $response['message']['data']['result']=$remark;

    }
    return $response;


 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}
*/


public function actionAddfilelikes()
{

 $model = new $this->modelClass([]);



  if(Yii::$app->getRequest()->getQueryParam('module')!="EmployeeSpeak")
    {


     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['data'])) 
   { 
$userid=$_REQUEST['userid']; 
      $dataview=$_REQUEST['data']; 
         $dataview=stripslashes($dataview);  

  // $dataview=stripslashes($data);
$newdata = json_decode($dataview,true);

if(count($newdata)!=0)
{
$x=0;
while(count($newdata)>$x)
{
$t_id = $newdata[$x]['t_id'];
$emp_id = $newdata[$x]['emp_id'];
$likes = $newdata[$x]['likes'];
$sql1 = "SELECT lkid FROM file_like where t_id='$t_id' and emp_id='$emp_id' and module_name='offisocio'";
    $res1 = mysql_query($sql1);
    $row1 = mysql_fetch_assoc($res1);
    $nrw = mysql_num_rows($res1); 
    
    
    if($nrw == 0)
    {
      $insql = "insert into file_like (t_id, emp_id, likes, created_date, modified_date,module_name) values ('$t_id','$emp_id','$likes',now(),now(),'offisocio')";
      $inres = mysql_query($insql);
    }
    else
    {
      $insql = "update file_like set likes='$likes', modified_date=now() where t_id='$t_id' and emp_id='$userid' and lkid='".$row1['lkid']."' and module_name='offisocio'";
      $inres = mysql_query($insql);
    }
    
    $x++;
}

}   
    
    $sql = "SELECT t_id,sum(likes) as total FROM file_like group by t_id";
    $res = mysql_query($sql);
    //$row = mysql_fetch_assoc($res);
    $nrw1 = mysql_num_rows($res);
    
    //$sql2 = "SELECT re_id,likes FROM reinforcement_master_likes where emp_id='$userid' group by re_id";
    
    $sql2 = "select a.t_id,a.total,ifnull(likes,'null') as likes

    from

    (SELECT t_id,sum(likes) as total FROM file_like group by t_id) as a

    left outer join

    (SELECT t_id,likes FROM file_like where emp_id='$userid' group by t_id) as b

    on a.t_id=b.t_id;";
    $res2 = mysql_query($sql2);
    //$row1 = mysql_fetch_assoc($res1);
    $total = array();
    while($row = mysql_fetch_object($res))
    {
     $total[] = json_encode($row,true);
    }
    
    $you = array();
    while($row2 = mysql_fetch_object($res2))
    {
     //$you[] = json_encode($row2,true);
$you[] =$row2;
    }
    
    if($nrw1 == 0)
    {
   // $response = '{"message":{"success":"false","data":[]}}';

     $response['message']['success']="false";
   $response['message']['data']="";

    }
    else
    {
    //$response = '{"message":{"success":"true","data":{"total":"'.$row['total'].'","you":"'.$row1['likes'].'"}}}';
    //$response = '{"message":{"success":"true","data":{"total":{'.implode(",",$total).'},"you":'.implode(",",$you).'}}}';


  //  $response = '{"message":{"success":"true","data":['.implode(",",$you).']}}';

   $response['message']['success']="true";
   $response['message']['data']['result']=$you;

    }
    return $response;


 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}







public function actionOffisocio()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="EmployeeSpeak")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 

    $userid=$_REQUEST['userid'];

 $sqlre="SELECT a.empspk_id, a.title, a.description, b.filepath, b.filename, created_by as emp_id, created_date, modified_date, created_by, modified_by,
a.status, deleted, ''as assigned, assigned_group, b.id, module, filepath, filename, modid,
CONCAT( IFNULL( c.first_name,  '' ) ,  '', IFNULL( c.last_name,  '' ) ) AS EmpName
FROM employee_speak a, documentsupload b, user c,employee_speak_assign d
WHERE a.empspk_id = b.modid
AND a.status =  'Offisocio'
AND a.created_by = c.id
AND a.empspk_id=d.empspk_id and d.emp_id='$userid'";
  
  
  
  $resRe = mysql_query($sqlre);
  $nremark = mysql_num_rows($resRe);
  $remark = array();
  while($rowRw= mysql_fetch_assoc($resRe))
  {
  $remark[] = array('t_id'=>$rowRw['empspk_id'],'title'=>$rowRw['title'],'description'=>$rowRw['description'],
    'emp_name'=>$rowRw['EmpName'],'filename'=>$rowRw['filename'],'profileurl'=>'images/user1.jpg',
    'filepath'=>$rowRw['filepath'],'created_date'=>$rowRw['created_date']);
  } 
  if($nremark == 0)
  {
 // $response = '{"message":{"success":"false","data":{"result":""}}}';

    $response['message']['success']="false";
    $response['message']['data']['result']="";
  }
  else
  {
  //$response = '{"message":{"success":"true","data":{"result":'.json_encode($remark).'}}}';

    $response['message']['success']="true";
    $response['message']['data']['result']=$remark;
  }
  return $response;



 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}















public function actionSurveyquestionupdate()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Surveycontentview")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['data'])) 
   { 


  $userid=$_REQUEST['userid'];

$dataview=$_REQUEST['data'];

$newdata=stripslashes($dataview);

 $newdata = json_decode($dataview,true);  

/*$data=$_REQUEST['data'];
$dataview=stripslashes($data);
$newdata = $dataview;*/
//print_r($newdata);



      if(count($newdata)!=0)
      {
      $x=0;
      while(count($newdata)>$x)
      {
        
        $survey_id = $newdata[$x]['survey_id'];
         $del_class[] = $newdata[$x]['survey_id'];          
        $ids[] = array('survey_id'=>$survey_id);
        $sid = $newdata[$x]['sid'];
        $response1 = $newdata[$x]['response'];
        
        
        
      /*   echo  $emp="update survey_emp_details set response = '".$response1."',maximum_att = '1',delivery_status = '1' where sid = '".$sid."' and  survey_id='$survey_id'  and   emp_id = '$userid'";*/




 $emp="update survey_participant set noattempts = '1',status = 'Closed' where  survey_id='$survey_id'  and   empid = '$userid'";
	
						$empres = mysql_query($emp);
	$emp1="update allocation_master set response='".$response."' where related_question_id = '".$sid."' and  mod_record_id='$survey_id'  and 
  emp_id = '$userid' and module='2'";
	
						$empres = mysql_query($emp1);	

        
        
        $x++;
      }
       $newclass = array_unique($del_class);
        $unique = array();       
        foreach ($newclass as $value) {
            $unique[] = $value;
                  

        }
     
/*$response = '{"message":{"success":"true","message":"successfully Inserted",
"data":{"survey_id":'.json_encode($unique).'}}}';*/


 $response['message']['success']="true";
 $response ['message']['message']="successfully Inserted";
 $response['message']['data']['survey_id']=$unique;

      }
      else
      {
    
  /*    $response = '{"message":{"success":"true","message":"no data updated","data":{"surveyquestion_update":""}}}';*/

 $response['message']['success']="true";
 $response ['message']['message']="no data updated";
 $response['message']['data']['surveyquestion_update']="";

      }

return  $response;

      

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}












public function actionGet_mobmod_details()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 


 echo  $sql2 = "SELECT a.id, formtype, replace(b.module_name,' ','')as module, filedname, fieldlabel, 
  fieldtype, typeofdata, length, defaultvalue, a.status FROM Mobmodel_Geneartor a,menu_table b
where a.module=b.id";



$connection=\Yii::$app->db;
   $query2=$connection->createCommand($sql2);
   $response=$query2->queryAll();
   return $response;

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}



public function actionAvailable_kb()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) 
   { 



/* echo $sql2 = "select a.re_id,a.title,a.tag,a.content_type from reinforcement_master a,
 reinforcement_question_score b where a.re_id=b.re_id and a.file_transfer_mode like '%GPRS%' and
  b.emp_id='".$_REQUEST['userid']."' and b.maximum_att=0 and b.re_id not in (select re_id from
   reinforcement_question_score where emp_id='".$_REQUEST['userid']."' and
    maximum_att>0 group by re_id,emp_id) group by a.re_id";



$connection=\Yii::$app->db;
   $query2=$connection->createCommand($sql2);
   $response=$query2->queryAll();
   return $response;*/

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}




public function actionDevicemanagement()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['Regid'])) 
   { 


$userid=$_REQUEST['userid'];

$id=$_REQUEST['Regid'];

$imei=$_REQUEST['imei'];

$version=$_REQUEST['version'];

$sql2 = "update employee_master set device_key='$id',imei='$imei',version='$version' where emp_id='$userid'";



   $connection=\Yii::$app->db;
   $query2=$connection->createCommand($sql2);
  // $response=$query2->queryAll();

   if($query2->queryAll())
   {
$response = '{"message":{"success":"true"}}';

   }
   else
   {

$response = '{"message":{"success":"false"}}';
   }
   return $response;

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}


public function actionFiletransfer()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="EmployeeSpeak")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['data']) ) 
   { 

$userid=$_REQUEST['userid'];

$data=$_REQUEST['data'];




      $sql2 = "select concat(ifnull(first_name,''),' ',ifnull(last_name,'')) as name,role from user 
      where id='$userid'";


  $res2 = mysql_query($sql2);
  $nrw = mysql_num_rows($res2);
  $name = mysql_fetch_assoc($res2);
  $emp_name = $name['name'];
  $newdata = json_decode(urldecode(stripslashes($data)),true);
//  $newdata = array($newdata1);
  $role_id=$name['role'];



if(count($newdata)!=0)
  {

    $x=0;
            while(count($newdata)>$x)
            {
              if($role_id=='admin')
              {
              $role_id='Leader';
              }
              else
              {
              $role_id='New';
              }
$filepath="uploads/".$newdata[$x]['filename'];
            

 $emp="insert into employee_speak (title, description,  created_by,file_path, file_name,created_date,status) 
 values ('".$newdata[$x]['title']."','".$newdata[$x]['content']."','".$userid."','".$filepath."',
  '".$newdata[$x]['filename']."',now(),'".$role_id."')";
            $empres = mysql_query($emp);
            $insert_id=mysql_insert_id();
  $emp1="insert into documentsupload (module,filepath,filename, modid,mime_type) values ('EmployeeSpeak','".$filepath."',
  '".$newdata[$x]['filename']."','".$insert_id."','mime_type')";



            $empres1 = mysql_query($emp1);
            $x++;
            }


 // $response = '{"message":{"success":"true","data":{"result":'.json_encode($remark).'}}}';

 $response['message']['success']="true";
 $response ['message']['message']="successfully Inserted";
//$response = '{"message":{"success":"true","message":"successfully Inserted"}}';

  }
  else
  {

//$response = '{"message":{"success":"true","message":"no data"}}';

 // $response = '{"message":{"success":"false","data":{"result":""}}}';

     $response['message']['success']="true";
 $response ['message']['message']="no data";



  }
  return $response;

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}





public function actionLeadership()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="EmployeeSpeak")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 

$userid=$_REQUEST['userid'];


 $sqlre = "SELECT empspk_id, title, description, b.filepath, b.filename, created_by as emp_id, created_date, modified_date, created_by, modified_by,
status, deleted, created_by as assigned, assigned_group, id, module, filepath, filename, modid
FROM employee_speak a,documentsupload b
where a.empspk_id=b.modid and status='Leader'";

  $resRe = mysql_query($sqlre);
  $nremark = mysql_num_rows($resRe);
  $remark = array();
  while($rowRw= mysql_fetch_assoc($resRe))
  {
  $remark[] = array('t_id'=>$rowRw['empspk_id'],'title'=>$rowRw['title'],'description'=>$rowRw['description'],'filepath'=>$rowRw['filepath'],'filename'=>$rowRw['filename'],'created_date'=>$rowRw['created_date']);
  } 
  if($nremark == 0)
  {
 // $response = '{"message":{"success":"false","data":{"result":""}}}';

    $response['message']['success']="false";
    $response['message']['data']['result']="";
  }
  else
  {
  //$response = '{"message":{"success":"true","data":{"result":'.json_encode($remark).'}}}';
  
    $response['message']['success']="true";
    $response['message']['data']['result']=$remark;

  }
  return $response;


} 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}




public function actionLeaderlikes()
{



 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="EmployeeSpeak")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 
$userid=$_REQUEST['userid'];
$sql = "SELECT t_id,sum(likes) as total FROM file_like a group by t_id";
    $res = mysql_query($sql);
    //$row = mysql_fetch_assoc($res);
    $nrw = mysql_num_rows($res);
    
    //$sql1 = "SELECT re_id,likes FROM reinforcement_master_likes where emp_id='$userid' group by re_id";
     $sql1 = "select a.t_id,a.total,ifnull(likes,'null') as likes

    from

    (SELECT t_id,sum(likes) as total FROM file_like where module_name='leaderspeek' group by t_id) as a

    left outer join

    (SELECT t_id,likes FROM file_like where emp_id='$userid' and module_name='leaderspeek' group by t_id) as b

    on a.t_id=b.t_id;";
    $res1 = mysql_query($sql1);
    //$row1 = mysql_fetch_assoc($res1);
    $total = array();
    while($row = mysql_fetch_object($res))
    {
     $total[] = json_encode($row,true);
    }
    
    $you = array();
    while($row1 = mysql_fetch_object($res1))
    {
    // $you[] = json_encode($row1,true);

       $you[] = $row1;

    }
    
    if($nrw == 0)
    {
    //$response = '{"message":{"success":"false","data":[]}}';

    $response['message']['success']="false";
    $response['message']['data']="";
    }
    else
    {
    //$response = '{"message":{"success":"true","data":{"total":"'.$row['total'].'","you":"'.$row1['likes'].'"}}}';
    //$response = '{"message":{"success":"true","data":{"total":{'.implode(",",$total).'},"you":'.implode(",",$you).'}}}';
    //$response = '{"message":{"success":"true","data":['.implode(",",$you).']}}';

   
    $response['message']['success']="true";
    //$response['message']['data']=implode(",",$you);
    $response['message']['data']=$you;

    }
    return $response;


} 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}


public function actionLeadersetlikes()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="EmployeeSpeak")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')  && isset($_POST['userid']) && isset($_POST['data'])) 
   { 



       $data=$_REQUEST['data'];
       $userid=$_REQUEST['userid'];
     $status=$_REQUEST['status'];
    $dataview=stripslashes($data);
   $newdata = json_decode($dataview,true);
 

if(count($newdata)!=0)
{
$x=0;
while(count($newdata)>$x)
{
    $t_id = $newdata[$x]['t_id'];
    $emp_id = $newdata[$x]['emp_id'];
    $likes = $newdata[$x]['likes'];
    $sql1 = "SELECT lkid FROM file_like where t_id='$t_id' and emp_id='$emp_id' and module_name='leaderspeek'";
    $res1 = mysql_query($sql1);
    $row1 = mysql_fetch_assoc($res1);
    $nrw = mysql_num_rows($res1);     
    
    if($nrw == 0)
    {
      $insql = "insert into file_like (t_id, emp_id, likes, created_date, modified_date,module_name) values ('$t_id','$emp_id','$likes',now(),now(),'leaderspeek')";
      $inres = mysql_query($insql);
    }
    else
    {
      $insql = "update file_like set likes='$likes', modified_date=now() where t_id='$t_id' and emp_id='$userid' and lkid='".$row1['lkid']."' and module_name='leaderspeek'";
      $inres = mysql_query($insql);
    }
    
    $x++;
}

}   
    
   
    
    
    $sql = "SELECT t_id,sum(likes) as total FROM file_like group by t_id";
    $res = mysql_query($sql);
    //$row = mysql_fetch_assoc($res);
    $nrw1 = mysql_num_rows($res);
    
  
    
     $sql2="select a.t_id,a.total,ifnull(likes,'null') as likes
from (SELECT t_id,sum(likes) as total FROM file_like where module_name='leaderspeek'  group by t_id) as a
 left outer join (SELECT t_id,likes FROM file_like where emp_id='$userid'and module_name='leaderspeek'  group by t_id) as b on a.t_id=b.t_id;";
    $res2 = mysql_query($sql2);
    //$row1 = mysql_fetch_assoc($res1);
    $total = array();
    while($row = mysql_fetch_object($res))
    {
     $total[] = json_encode($row,true);
    }
    
    $you = array();
    while($row2 = mysql_fetch_object($res2))
    {
     $you[] = json_encode($row2,true);
    }
    
    if($nrw1 == 0)
    {
    //$response = '{"message":{"success":"false","data":[]}}';

         $response['message']['success']="false";
    $response['message']['data']="";

    }
    else
    {
 
   // $response = '{"message":{"success":"true","data":['.implode(",",$you).']}}';

       $response['message']['success']="true";
    $response['message']['data']=$you;
    }
    return $response;



 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}



public function actionLeadercomment()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="EmployeeSpeak")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['t_id'])) 
   { 


    $userid=$_REQUEST['userid'];
    $t_id=$_REQUEST['t_id'];

  $sqlre = "select a.id as cmid,a.entity as t_id,a.text as comments,a.created_at as created_date,
  concat(ifnull(b.first_name,''),'',ifnull(b.last_name,'')) as EmpName from comment a,user b,
  employee_speak c where a.created_by=b.id and a.entity=c.empspk_id and c.status ='Leader'";

  $resRe = mysql_query($sqlre);
  $nremark = mysql_num_rows($resRe);
  $remark = array();
  while($rowRw= mysql_fetch_assoc($resRe))
  {
               
           $ts = $rowRw['created_date'];
           $date = new \DateTime("@$ts");

  $remark[] = array('id'=>$rowRw['cmid'],'t_id'=>$rowRw['t_id'],'emp_id'=>$userid,
    'EmpName'=>$rowRw['EmpName'],'comments'=>$rowRw['comments'],'profileurl'=>'images/user1.jpg',
    'created_date'=>$date->format('Y-m-d H:i:s'));
  }


  if($nremark == 0)
  {
 // $response = '{"message":{"success":"false","data":{"result":""}}}';

     $response['message']['success']="true";
 $response ['message']['data']="";
  }
  else
  {


 // $response = '{"message":{"success":"true","data":{"result":'.json_encode($remark).'}}}';

 $response['message']['success']="true";
 $response ['message']['data']=$remark;
  }
  return $response;

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}


public function actionReinforcecomment()
{

  $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 

/*
$sql = "SELECT re_id,count(comments) as total FROM reinforcement_master_comment group by re_id";
$res = mysql_query($sql);
$nrw = mysql_num_rows($res);*/

 /*  $total = array();
    while($row = mysql_fetch_object($res))
    {
     $total[] = json_encode($row,true);
    }*/
    
 $sql1 = "select a.re_id,ifnull(cmid,'null') as cmid, ifnull(emp_id,'null') as 
emp_id,name,ifnull(comments,'null') as comments,a.total from (SELECT re_id,count(comments) as total 
FROM reinforcement_master_comment group by re_id) as a left outer join (SELECT cmid, re_id, a.emp_id,
concat(ifnull(b.first_name,''),'',ifnull(b.last_name,'')) as name, comments FROM reinforcement_master_comment a,
employee_master b where a.emp_id=b.emp_id and cmid in (select max(cmid) FROM reinforcement_master_comment
where cmid not in (select max(cmid) as id FROM reinforcement_master_comment group by re_id) group by re_id 
union all select max(cmid) as id FROM reinforcement_master_comment group by re_id)) as b on a.re_id=b.re_id";


 
     $res1 = mysql_query($sql1);
     $nrw = mysql_num_rows($res1);
    $you = array();
    while($row1 = mysql_fetch_object($res1))
    {
     //$you[] = json_encode($row1,true);

      $you[] =$row1;
    }

 if($nrw==0)
       {
     //$response = '{"message":{"success":"false"}}';
    $response['message']['success']="false";

       }
       else
       {
    //$response = '{"message":{"success":"true","data":['.implode(",",$you).']}}';

     $response['message']['success']="true";
     $response ['message']['data']=$you;


       }
       return $response;

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}



public function actionUpdatereinforcecomment()
{

  $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 

if($mode=='D')
  {
    $sql1 = "DELETE FROM reinforcement_master_comment where re_id='$re_id' and emp_id='$userid' 
    and cmid='$cmid'";
    $res1 = mysql_query($sql1);
  }
  else
  {   
    $sql1 = "SELECT cmid FROM reinforcement_master_comment where re_id='$re_id' and emp_id='$userid' 
    and cmid='$cmid'";
    $res1 = mysql_query($sql1);
    $row1 = mysql_fetch_assoc($res1);
    $nrw = mysql_num_rows($res1); 
    
    
    if($nrw == 0)
    {
      $insql = "insert into reinforcement_master_comment (re_id, emp_id, comments, created_date, modified_date) values ('$re_id','$userid','$comment',now(),now())";
      $inres = mysql_query($insql);
    }
    else
    {
      $insql = "update reinforcement_master_comment set comments='$comment', modified_date=now() where re_id='$re_id' and emp_id='$userid' and cmid='".$row1['cmid']."'";
      $inres = mysql_query($insql);
    }
  } 
    
 
    
    $sql = "SELECT re_id,count(comments) as total FROM reinforcement_master_comment group by re_id";

    $res = mysql_query($sql);
    //$row = mysql_fetch_assoc($res);
    $nrw1 = mysql_num_rows($res);
    
 

    $sql2 = "select a.re_id,ifnull(cmid,'null') as cmid, ifnull(emp_id,'null') as emp_id,name,
        ifnull(comments,'null') as comments,a.total
        
        from
        
        (SELECT re_id,count(comments) as total FROM reinforcement_master_comment group by re_id) as a
        
        left outer join
        
        (SELECT cmid, re_id, a.emp_id,concat(ifnull(b.first_name,''),'',ifnull(b.last_name,'')) as name, comments FROM 
        reinforcement_master_comment a,employee_master b where a.emp_id=b.emp_id and cmid in (select max(cmid) FROM reinforcement_master_comment
        where cmid not in (select max(cmid) as id FROM reinforcement_master_comment group by re_id) group by re_id union all
        select max(cmid) as id FROM reinforcement_master_comment group by re_id)) as b
        
        on a.re_id=b.re_id";
    
    $res2 = mysql_query($sql2);
    //$row1 = mysql_fetch_assoc($res1);
    
    
    $total = array();
    while($row = mysql_fetch_object($res))
    {
     $total[] = json_encode($row,true);
    }
    
    $you = array();
    while($row2 = mysql_fetch_object($res2))
    {
     $you[] = json_encode($row2,true);
    }









 if($nrw1==0)
       {
     //$response = '{"message":{"success":"false"}}';
    $response['message']['success']="false";

       }
       else
       {
    //$response = '{"message":{"success":"true","data":['.implode(",",$you).']}}';

     $response['message']['success']="true";
     $response ['message']['data']=$you;


       }
       return $response;

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}



public function actionLeadergetcomment()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="EmployeeSpeak")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 

 $sqlre = "select a.id as cmid,a.entity as t_id,a.text as comments,a.created_at as created_date,concat(ifnull(b.first_name,''),'',ifnull(b.last_name,'')) as EmpName from comment a,user b,employee_speak c where a.created_by=b.id and a.entity=c.empspk_id and c.status ='Leader'";

	$resRe = mysql_query($sqlre);
	$nremark = mysql_num_rows($resRe);
	$remark = array();
	while($rowRw= mysql_fetch_assoc($resRe))
	{
               
           $ts = $rowRw['created_date'];
         $date = new \DateTime("@$ts");

	$remark[] = array('id'=>$rowRw['cmid'],'t_id'=>$rowRw['t_id'],'emp_id'=>$userid,'EmpName'=>$rowRw['EmpName'],'comments'=>$rowRw['comments'],'profileurl'=>'images/user1.jpg','created_date'=>$date->format('Y-m-d H:i:s'));
	}

   if($nremark == 0)
    {
   //$response = '{"message":{"success":"false","data":{"result":""}}}';

       $response['message']['success']="false";
    }
    else
    {

  //  $response = '{"message":{"success":"true","data":['.implode(",",$you).']}}';
//$response = '{"message":{"success":"true","data":{"result":'.json_encode($remark).'}}}';

       $response['message']['success']="true";

         $response['message']['data']['result']=$remark;
    }
    return $response;

   } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}


public function actionLeadersetcomment()
{
//update_leader_comment
 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="EmployeeSpeak")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
 else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['comment']) && isset($_POST['t_id'])&&isset($_POST['userid']) ) 
   { 

mysql_set_charset('utf8');
          $userid=$_REQUEST['userid'];
          $t_id=$_REQUEST['t_id'];
          $comment=$_REQUEST['comment'];
          $mode=$_REQUEST['mode'];
          $cmid=$_REQUEST['cmid'];


 if($cmid =='') 
                    {
                    $cmid='0';  // setting some default value
                   }
  if($mode=='D')
  {
    //$sql1 = "DELETE FROM file_comment where t_id='$t_id' and emp_id='$userid' and cmid='$cmid'";
                $sql1 = "DELETE FROM comment where entity='$t_id' and created_by='$userid' and id='$cmid'";
    $res1 = mysql_query($sql1);
  }
  else
  {   
    //$sql1 = "SELECT cmid FROM file_comment where t_id='$t_id' and emp_id='$userid' and cmid='$cmid'";

                $sql1 = "SELECT id FROM comment where entity='$t_id' and created_by='$userid' and id=$cmid";

    $res1 = mysql_query($sql1);
    $row1 = mysql_fetch_assoc($res1);
    $nrw = mysql_num_rows($res1); 
    
    
    if($nrw == 0)
    {

       $converttoutc=time();
 $insql = "insert into comment (entity, text,created_by, updated_by, created_at, updated_at, module)
values ('$t_id', '$comment','$userid', '$userid', '$converttoutc','$converttoutc','employee-speaknew')";

      $inres = mysql_query($insql);
    }
    else
    {

                       $utcdate =\time();
     
$insql = "update comment set text='$comment', modified_date='$utcdate' where entity='$t_id' and created_by='$userid' and id='".$row1['id']."'";

      $inres = mysql_query($insql);
    }
  } 
    
    
    
    $sql = "SELECT a.entity as t_id,count(a.text) as total FROM comment a,employee_speak b where a.entity=b.empspk_id and b.status='Leader'  group by a.entity";
    $res = mysql_query($sql);
    //$row = mysql_fetch_assoc($res);
    $nrw1 = mysql_num_rows($res);
    
   
    $sql2 = "select a.t_id,ifnull(cmid,'null') as cmid, ifnull(emp_id,'null') as emp_id,name,
        ifnull(comments,'null') as comments,a.total

        from

        (SELECT a.entity as t_id,count(a.text) as total FROM comment a,employee_speak b where a.entity = b.empspk_id and b.status='Leader' group by a.entity) as a

        left outer join

        (SELECT a.id as cmid, a.entity as t_id, a.created_by as emp_id,concat(ifnull(b.first_name,''),'',ifnull(b.last_name,'')) as name, a.text as comments FROM
        comment a,user b,employee_speak c where a.created_by=b.id and a.entity=c.empspk_id and c.status='Leader' and a.id in (select max(id) FROM comment
        where id not in (select max(id) as id FROM comment group by entity) group by entity union all
        select max(id) as id FROM comment group by entity)) as b

        on a.t_id=b.t_id";
    
    $res2 = mysql_query($sql2);
    //$row1 = mysql_fetch_assoc($res1);
    
    
    $total = array();
    while($row = mysql_fetch_object($res))
    {
     $total[] = json_encode($row,true);
    }
    
    $you = array();
    while($row2 = mysql_fetch_object($res2))
    {
   $you[] = $row2;

//$you[] = json_encode($row2,true);
    

    }
    
    if($nrw1 == 0)
    {
    //$response = '{"message":{"success":"false","data":[]}}';

       $response['message']['success']="false";
    }
    else
    {

  //  $response = '{"message":{"success":"true","data":['.implode(",",$you).']}}';

       $response['message']['success']="true";

         $response['message']['data']=$you;
    }
    return $response;

   } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}




public function actionKbinfo()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 


$userid=$_REQUEST['userid'];


echo $sql2 = "SELECT re_id, title, description,tag FROM reinforcement_master where
  re_id in (SELECT a.re_id FROM reinforcement_question a,reinforcement_question_score b
  where a.req_id=b.req_id and b.maximum_att!=0 and b.emp_id='$userid' group by a.re_id)";


   $connection=\Yii::$app->db;
   $query2=$connection->createCommand($sql2);
 // $response=$query2->queryAll();

  if(!$query2->queryAll())
   {
$response = '{"message":{"success":"false","data":{"result":""}}}';
   }
   else
   {
  $response = '{"message":{"success":"true","data":{"result":'.json_encode($kbinfo).'}}}';
   }
   return $response;

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}

public function actionAvailableojt_cue()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 


$userid=$_REQUEST['userid'];

       $role = get_role($userid);


$reviewid = $role['reviewid'];
$roleid = $role['role_id'];
if($roleid==15) //mentor
{
$where_role = "and b.mentor_id='$reviewid'";
}
if($roleid==14) //supervisor
{
$where_role = "and b.supervisor_id='$reviewid'";
}

$sql2 = "select a.ojt_id,a.ojt_code,a.ojt_name,c.module_id,c.module_name,
concat(a.start_date,' ',TIME(STR_TO_DATE(a.start_time,'%h:%i %p'))) as start_date,
concat(a.end_date,' ',TIME(STR_TO_DATE(a.end_time,'%h:%i %p'))) as end_date
from ojt_training a,ojt_participant b,ojt_module_master c
where a.ojt_id=b.ojt_id and a.module_id=c.module_id $where_role group by a.ojt_id";


   $connection=\Yii::$app->db;
   $query2=$connection->createCommand($sql2);
  $response=$query2->queryAll();


   return $response;

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}




public function actionModulemaster()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Evolution")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 
       $sql2 = "SELECT module_id,module_name FROM module_masters";

      $connection=\Yii::$app->db;
      $query2=$connection->createCommand($sql2);
     $modules=$query2->queryAll();

if(count($modules) == 0)
  {
  $response = '{"message":{"success":"false","data":{"result":""}}}';
     $response['message']['success']="false";
     $response ['message']['data']['result']="";


  }
  else
  {
 

      $response['message']['success']="true";
     $response ['message']['data']['result']=$modules;


  }
  return $response;

} 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}




public function actionRemarks()
{

$model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) ) 
   { 

     $sqlre = "select  id,remark_name from remarks_master";

  $resRe = mysql_query($sqlre);
  $nremark = mysql_num_rows($resRe);
  $remark = array();
  while($rowRw= mysql_fetch_assoc($resRe))
  {
  $remark[] = array('id'=>$rowRw['id'],'remark_name'=>$rowRw['remark_name']);
  } 

  if($nremark == 0)
  {
 // $response = '{"message":{"success":"false","data":{"result":""}}}';
 $response['message']['success']="false";
 $response ['message']['data']['result']="";

  }
  else
  {
 // $response = '{"message":{"success":"true","data":{"result":'.json_encode($remark).'}}}';
   $response['message']['success']="true";
 $response ['message']['data']['result']=$remark;


  }
  return $response;




  } 
  else
  {
     throw new \yii\web\HttpException(400,'No Params Received');

  }

}

public function actionPremiumsales()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Crt")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['data']) ) 
   { 
       $data=$_REQUEST['data'];

      $dataview=stripslashes($data);
$newdata = json_decode($dataview,true);

if(count($newdata)!=0)
{
$x=0;
while(count($newdata)>$x)
{

$bills_cut = $newdata[$x]['bills_cut'];

$values_sold = $newdata[$x]['values_sold'];
$emp_id = $newdata[$x]['emp_id'];
$lines_sold = $newdata[$x]['lines_sold'];
$comment = $newdata[$x]['comment'];
$created_date = $newdata[$x]['created_date'];


    $emp="insert into premium_sales ( bills_cut, values_sold, lines_sold, comment, created_date, emp_id)
     values ('$bills_cut', '$values_sold', '$lines_sold', '$comment', now(), '$emp_id')";
    $empres = mysql_query($emp);


$x++;
}


//$response = '{"message":{"success":"true","message":"successfully Inserted",
//"data":{"premiumsales":"Success"}}}';

$response['message']['success']="true";
$response ['message']['message']="successfully Inserted";
$response['message']['data']['premiumsales']="Success";


}
else
{

//$response = '{"message":{"success":"true","message":"no data updated","data":{"premiumsales":""}}}';
$response['message']['success']="true";
$response ['message']['message']="no data updated";
$response['message']['data']['premiumsales']="";

}

       return $response;

 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}





public function actionEvolution()
{

 $model = new $this->modelClass([]);

  if(Yii::$app->getRequest()->getQueryParam('module')!="Evolution")
    {
     throw new \yii\web\HttpException(404, 'Method Not Found');
    }
  else if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && isset($_POST['userid']) && isset($_POST['data'])) 
   { 

    $userid=$_REQUEST['userid'];
    $data=$_REQUEST['data'];

   $dataview=stripslashes($data);
$newdata = json_decode($dataview,true);


if(count($newdata)!=0)
{
$x=0;
while(count($newdata)>$x)
{
mysql_set_charset('utf8');
  $emp_sql = "select id,concat(ifnull(first_name,''),' ',ifnull(last_name,'')) as name,mobile
from user where id='$userid'";


$emp_res = mysql_query($emp_sql) or die(mysql_error());



 $count_emp=mysql_num_rows($emp_res);

$emp_row = mysql_fetch_assoc($emp_res);

 $sql="insert into evolution (emp_id, emp_name, module_id, mobile_no, comment, created_date) 
values ('".$emp_row['id']."','".$emp_row['name']."','".$newdata[$x]['module_id']."','".$emp_row['mobile']."','".$newdata[$x]['comment']."',now())";
$res = mysql_query($sql);






$x++;
}

     $response['message']['success']="true";
     $response ['message']['message']="successfully Inserted";


//$response = '{"message":{"success":"true","message":"successfully Inserted"}}';
}
else
{
//$response = '{"message":{"success":"true","message":"no data updated"}}';

$response['message']['success']="true";
$response ['message']['message']="no data updated";
}

return $response;


 } 
else
{
   throw new \yii\web\HttpException(400,'No Params Received');

}

}




function get_role($userid)
{
	 $sql = "SELECT a.emp_id,a.emp_code,b.role_id FROM employee_master a,role_master b where a.role_id=b.role_id and emp_id='$userid'";
	$res = mysql_query($sql);
	$row = mysql_fetch_assoc($res);
	
	if($row['role_id']==15)
	{
	$sql1 = "SELECT mentor_id,emp_id FROM mentor_master where emp_id='".$row['emp_code']."'";
	$res1 = mysql_query($sql1);
	$row1 = mysql_fetch_assoc($res1);
	$ids = $row1['mentor_id'];
	}
	if($row['role_id']==14)
	{
	$sql1 = "SELECT supervisor_id,emp_id FROM supervisor_master where emp_id='".$row['emp_code']."'";
	$res1 = mysql_query($sql1);
	$row1 = mysql_fetch_assoc($res1);
	$ids = $row1['supervisor_id'];
	}
	
	$reviewid = $ids;
	
	$newarr = array('role_id'=>$row['role_id'],'reviewid'=>$reviewid);
	
	return $newarr;
}











}

?>

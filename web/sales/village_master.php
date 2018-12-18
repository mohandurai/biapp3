<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../../config/web.php');
new yii\web\Application($config); 
use yii\helpers\ArrayHelper;
error_reporting(0);
$login=Yii::$app->user->identity->id;
$clientuserid=Yii::$app->user->identity->client_user_id;
 // echo date("Y");
  // $year= echo date("Y");
  // echo $year;
if( isset($_REQUEST['fileid'] ) )
{
	$fileid=$_REQUEST['fileid'];
$sql_splittable="select state_id from biweb.taluk_master where refid=".$fileid."";

$split_res=yii::$app->db2->createCommand($sql_splittable)->queryAll();
            //print_r($split_res);die;
            echo json_encode($split_res);

}


?>
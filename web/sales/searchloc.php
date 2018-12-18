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


//	city_master,district_master,state_master,taluk_master,village_master,ward_master,world_master,country_master,colony_master
// print_r($_REQUEST);die;
// select u.first_name,a.first_name 
// from user u inner join author a on u.user_id=a.author_id
// where  u.first_name like'%gre%' or a.first_name like'%gre%';
//7 as loc 
 $sql_splittable= "select refid as data, 7 as loc,CONCAT(location_name,' - state') as value,southwest,northeast,center_coordinates,country_id from biweb.state_master where location_name  LIKE '%".$_REQUEST['q']."%' and stat != 'R' union select refid as data, 9 as loc,CONCAT(location_name,' - district') as value,southwest,northeast,center_coordinates,country_id from biweb.district_master where location_name  LIKE '%".$_REQUEST['q']."%' and stat != 'R' union select refid as data, 10 as loc,CONCAT(location_name,' - taluk') as value,southwest,northeast,center_coordinates,country_id from biweb.taluk_master where location_name  LIKE '%".$_REQUEST['q']."%' and stat != 'R' union select refid as data, 12 as loc,CONCAT(location_name,' - city') as value,southwest,northeast,center_coordinates,country_id from biweb.city_master where location_name  LIKE '%".$_REQUEST['q']."%' and stat != 'R' union select refid as data, 5 as loc,CONCAT(location_name,' - country') as value,southwest,northeast,center_coordinates,refid as country_id from biweb.country_master where location_name  LIKE '%".$_REQUEST['q']."%' and stat != 'R'";


// $sql_splittable= "select refid as data, 7 as loc,CONCAT(location_name,' - state') as value,center_coordinates from biweb.state_master where location_name  LIKE '%".$_REQUEST['q']."%' and stat != 'R' union select refid as data, 9 as loc,CONCAT(location_name,' - district') as value,center_coordinates from biweb.district_master where location_name  LIKE '%".$_REQUEST['q']."%' and stat != 'R' union select refid as data, 10 as loc,CONCAT(location_name,' - taluk') as value,center_coordinates from biweb.taluk_master where location_name  LIKE '%".$_REQUEST['q']."%' and stat != 'R' union select refid as data, 15 as loc,CONCAT(location_name,' - nbrnd') as value,center_coordinates from biweb.ward_master where location_name  LIKE '%".$_REQUEST['q']."%' and stat != 'R'";


 // print_r($sql_splittable);die;
     $split_res=yii::$app->db2->createCommand($sql_splittable)->queryAll();
           //print_r($split_res);die;
echo json_encode($split_res);
 
?>
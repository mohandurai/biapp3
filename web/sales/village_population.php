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
            $mainloc=$_REQUEST['mainloc'];
            //$mainloc=(int)$mainloc;
            $subloc=$_REQUEST['subloc'];
            //$subloc=(int)$subloc;
            $passid=$_REQUEST['passid'];

            $passid1=$_REQUEST['passid1'];

            $mastername=$_REQUEST['mastername'];
            $mastername1=$_REQUEST['mastername1'];
            $year=$_REQUEST['year'];
            if($mainloc===$subloc)
            {

               //  $sql_splittable=  "select  c.village_id locid, c.".$year.",b.location_name,b.center_coordinates,a.state_id from
               //                  biweb.taluk_master  a JOIN  biweb.village_master b  
               //               JOIN  biweb_pca.village_gender_a.state_id c ON a.refid = b.taluk_id and b.refid = c.village_id and and
               // c.stat!='R' and c.".$passid."=".$fileid." group by locid"

               $sql_splittable="select  a.village_id locid , a.".$year." result ,b.location_name,b.center_coordinates from ".$mastername1." a JOIN biweb.village_master b ON a.village_id=b.refid  and
               a.stat!='R' and a.".$passid."=".$fileid." group by locid";


            }
            else
            {

                // $sql_splittable=  "select  c.village_id locid, c.".$year.",b.location_name,b.center_coordinates,a.state_id   from
                //                 biweb.taluk_master  a JOIN  biweb.village_master b  
                //              JOIN  biweb_pca.village_gender_31 c ON a.refid = b.taluk_id and b.refid = c.village_id and and
                //            c.stat!='R' and c.".$passid1."=".$fileid." group by locid"

            $sql_splittable="select a.village_id locid , a.".$year." result ,b.location_name,b.center_coordinates from ".$mastername1." a JOIN biweb.village_master b ON a.village_id=b.refid and  a.stat!='R'and   a.".$passid1."= ".$fileid."  group by locid";	
           // echo $sql_splittable;
            }


            $split_res=yii::$app->db2->createCommand($sql_splittable)->queryAll();
            //print_r($split_res);die;
            echo json_encode($split_res);
}




?>
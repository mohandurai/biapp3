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


            $sql_splittable= "SELECT a.".$passid." locid ,b.center_coordinates,b.location_name ,2018 period,
            sum(a.age_5_9+((a.age_5_9*a.".$year.")/100 ))+sum(a.age_10_14+((a.age_10_14*a.".$year.")/100 ))+sum(a.age_15_19+((a.age_15_19*a.".$year.")/100 ))+sum(a.age_20_24+((a.age_20_24*a.".$year.")/100 ))+sum(a.age_25_29+((a.age_25_29*a.".$year.")/100 ))+sum(a.age_30_34+((a.age_30_34*a.".$year.")/100 ))+sum(a.age_35_39+((a.age_35_39*a.".$year.")/100 ))+sum(a.age_40_44+((a.age_40_44*a.".$year.")/100 ))+sum(a.age_45_49+((a.age_45_49*a.".$year.")/100 ))+sum(a.age_50_54+((a.age_50_54*a.".$year.")/100 ))+sum(a.age_55_59+((a.age_55_59*a.".$year.")/100 ))+sum(a.age_60_64+((a.age_60_64*a.".$year.")/100 ))+sum(a.age_65_69+((a.age_65_69*a.".$year.")/100 ))+sum(a.age_70_74+((a.age_70_74*a.".$year.")/100 ))+sum(a.age_75_79+((a.age_75_79*a.".$year.")/100 ))+sum(a.age_80+((a.age_80*a.".$year.")/100 ))+sum(a.age_not_stated+((a.age_not_stated*a.".$year.")/100 ))+sum(a.age_0_4+((a.age_0_4*a.".$year.")/100 )) result  FROM ".$mastername1." a JOIN ".$mastername." b  ON a.".$passid."=b.refid
              AND a.gender IN (1,2) AND ( a.maritalstatus IN (1,2,3,4,5))    AND ( a.education IN (1,2,3,4,5,6,7,8))  AND ( a.area IN (2,1))  AND ( a.stat != 'R') AND  (a.".$passid."=".$fileid.") GROUP BY a.".$passid." ";


            }



            else
            {

            $sql_splittable= "SELECT a.".$passid." locid ,b.center_coordinates,b.location_name ,2018 period,
            sum(a.age_5_9+((a.age_5_9*a.".$year.")/100 ))+sum(a.age_10_14+((a.age_10_14*a.".$year.")/100 ))+sum(a.age_15_19+((a.age_15_19*a.".$year.")/100 ))+sum(a.age_20_24+((a.age_20_24*a.".$year.")/100 ))+sum(a.age_25_29+((a.age_25_29*a.".$year.")/100 ))+sum(a.age_30_34+((a.age_30_34*a.".$year.")/100 ))+sum(a.age_35_39+((a.age_35_39*a.".$year.")/100 ))+sum(a.age_40_44+((a.age_40_44*a.".$year.")/100 ))+sum(a.age_45_49+((a.age_45_49*a.".$year.")/100 ))+sum(a.age_50_54+((a.age_50_54*a.".$year.")/100 ))+sum(a.age_55_59+((a.age_55_59*a.".$year.")/100 ))+sum(a.age_60_64+((a.age_60_64*a.".$year.")/100 ))+sum(a.age_65_69+((a.age_65_69*a.".$year.")/100 ))+sum(a.age_70_74+((a.age_70_74*a.".$year.")/100 ))+sum(a.age_75_79+((a.age_75_79*a.".$year.")/100 ))+sum(a.age_80+((a.age_80*a.".$year.")/100 ))+sum(a.age_not_stated+((a.age_not_stated*a.".$year.")/100 ))+sum(a.age_0_4+((a.age_0_4*a.".$year.")/100 )) result  FROM ".$mastername1." a JOIN ".$mastername." b  ON a.".$passid."=b.refid
            AND a.gender IN (1,2) AND ( a.maritalstatus IN (1,2,3,4,5))  AND  ( a.education IN (1,2,3,4,5,6,7,8))  AND ( a.area IN (2,1))  AND ( a.stat != 'R')  AND (a.".$passid1."=".$fileid.")
            GROUP BY a.".$passid."";

             }


            $split_res=yii::$app->db2->createCommand($sql_splittable)->queryAll();
            //print_r($split_res);die;
            echo json_encode($split_res);

}


?>

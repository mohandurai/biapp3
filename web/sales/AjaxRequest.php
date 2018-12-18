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
$res2= '';$res2r ='';
    if(isset($_REQUEST['nextlevel']))
    {
       $selectedlocation=$_REQUEST['id'];
       $currentfile=$_REQUEST['currentlevel'];

       if($currentfile=="SVG/1---21---21.svg")
       {
       $string=str_replace("SVG/","",$currentfile);
       $string1=str_replace(".svg","",$string);

       $file=explode("---",$string1);
       $currentlocation=$file[0];
       $mainlocation=$file[1];
       $sublocation=$file[2];


       }
       else if($currentfile=="SVG/1---21---1.svg")
       {
        $string=str_replace("SVG/","",$currentfile);
       $string1=str_replace(".svg","",$string);

       $file=explode("---",$string1);
       $currentlocation=$file[0];
       $mainlocation=$file[1];
       $sublocation=$file[2];
      
       }
       else
       {
        $string=str_replace("SVG","",$currentfile);
        $string=str_replace(".svg","",$string);
        $file1 =explode("/",$string);
        $fpath=$file1[3];
        $file= explode("---",$fpath);
        $currentlocation=$file[0];
        $mainlocation=$file[1];
        $sublocation=$file[2];
     }
   

 


  if($mainlocation==$sublocation)
  {
    // print_r("expression");die;
    $sql="select refid,master_table from Geo_Hrchy_master where refid=".$mainlocation;
    $res=yii::$app->db->createCommand($sql)->queryOne();
    $yu=($res['master_table']=='country_master') ? 'refid as country_id' : 'country_id';



    if($mainlocation==21 && $sublocation==21)
    {
    $cond="select sub_location_temp from map_level where main_location=".$mainlocation." and sub_location=".$sublocation ;
    }
    else
    {
    $sql2="select ".$yu.",center_coordinates,loc_id,southwest,northeast from ".$res['master_table']." where refid=".$selectedlocation;
    // print_r($sql2);die;
    $res2=yii::$app->db->createCommand($sql2)->queryOne();
    $cond="select sub_location_temp,  label_toggle from map_level where main_location=".$mainlocation." and sub_location=".$sublocation ." and
    country_id=".$res2['country_id'] ;

    }
    //print_r($cond);die;
    $resc=yii::$app->db->createCommand($cond)->queryOne();



    $str="";
    if($mainlocation==21 && $sublocation==21)
    {
    $str="SVG/".$selectedlocation.'---'.$mainlocation.'---'.$resc["sub_location_temp"].".svg";
    }

    else
    {


    $str="SVG/".$res2['country_id']."/".$mainlocation."---".$resc["sub_location_temp"]."/".$selectedlocation.'---'.$mainlocation.'---'.$resc["sub_location_temp"].".svg" ;


    }

    // echo $resc["sub_location_temp"];
    // print_r($res2);die;
    if($res2['southwest'] == '')
    {
      echo $str;
    }
    else
    {
      // print_r($res2);die;
      echo $str.'//'.$res2['center_coordinates'].'//'.$res2['southwest'].'//'.$res2['northeast'];
    }
     //echo $str;
  }

 
   elseif($mainlocation!=$sublocation)
   {

   	  $sql="select refid,master_table from Geo_Hrchy_master where refid=".$sublocation;
   	  $res=yii::$app->db->createCommand($sql)->queryOne();
         if($res['master_table']=="world_master" )
         {
         $yt="refid";
         }else if($res['master_table']=="country_master" )
         {
           $yt ="refid" ;
         } else
         {
         $yt="country_id";
         }

   	  $sql2="select * from ".$res['master_table']." where refid=".$selectedlocation;
      $res2=yii::$app->db->createCommand($sql2)->queryOne();
      $str="";

      $sqlc="select master_table from Geo_Hrchy_master where refid=".$mainlocation;
        $resc=yii::$app->db->createCommand($sqlc)->queryOne();   
        $sqlr= "select * from ".$res['master_table']." where refid=".$selectedlocation; 
       $resr=yii::$app->db->createCommand($sqlr)->queryOne();
      $str="SVG/".$res2[$yt]."/".$res2["nxt_mp_level"].'---'.$res2["nxt_mp_level"]."/".$res2['loc_id'].'---'.$res2["nxt_mp_level"].'---'.$res2["nxt_mp_level"].".svg";
   
          // print_r($sqlr);die;
          if($resr['southwest'] == '')
          {
            echo $str;
          }
          else
          {
            echo $str.'//'.$resr['center_coordinates'].'//'.$resr['southwest'].'//'.$resr['northeast'];
          }
  
   }
   else
   {
     echo 'No result';
   }

}

elseif(isset($_REQUEST['toggle']))
{
   $selectedlocation=$_REQUEST['id'];
   $currentfile=$_REQUEST['currentlevel'];

     if($currentfile=="SVG/1---21---21.svg")
   {
   $string=str_replace("SVG/","",$currentfile);
   $string1=str_replace(".svg","",$string);

   $file=explode("---",$string1);
   $currentlocation=$file[0];
   $mainlocation=$file[1];
   $sublocation=$file[2];

   }
   else if($currentfile=="SVG/1---21---1.svg")
   {
   $string=str_replace("SVG/","",$currentfile);
   $string1=str_replace(".svg","",$string);

   $file=explode("---",$string1);
   $currentlocation=$file[0];
   $mainlocation=$file[1];
   $sublocation=$file[2];
   }
   else
   {
    $string=str_replace("KML","",$currentfile);
    $string=str_replace(".svg","",$string);
    $file1 =explode("/",$string);
    $fpath=$file1[3];
    $file= explode("---",$fpath);
    $currentlocation=$file[0];
    $mainlocation=$file[1];
    $sublocation=$file[2];
   }

    if($mainlocation==$sublocation)
    {
      $selectdata="select master_table from Geo_Hrchy_master where refid='".$sublocation."'";
    }
    else if($mainlocation!=$sublocation)
    {
      $selectdata="select master_table from Geo_Hrchy_master where refid='".$mainlocation."'"; 
    }
 

   
   
    $query = yii::$app->db->createCommand($selectdata)->queryOne();

    //echo $query['master_table'];die;

        if($query['master_table']=="globe_master" )
         {
         $yt="refid";
         }else if($query['master_table']=="country_master" )
         {
           $yt ="refid" ;
         } else
         {
         $yt="country_id";
         }

     $sql2="select ".$yt." as country_id from ".$query['master_table']." where refid='".$currentlocation."'";
        // echo $sql2;die;
      $res2=yii::$app->db->createCommand($sql2)->queryOne();

   $str="";
 $toggle="select main_location,sub_location,".$currentlocation." as location,label_toggle from map_level where main_location=".$mainlocation." and country_id= '".$res2['country_id']."'";
  $restoggle=yii::$app->db->createCommand($toggle)->queryAll();
  for($k=0;$k<count($restoggle);$k++)
  {
    $str1="";
    if($restoggle[$k]['location'].'---'.$restoggle[$k]['main_location'].'---'.$restoggle[$k]['sub_location'] == $string1)
        $str1="checked";
   $str .="<label><input type='radio' name='toggleshow'   value='SVG/".$res2['country_id']."/".$restoggle[$k]['main_location']."---".$restoggle[$k]['sub_location']."/".$restoggle[$k]['location'].'---'.$restoggle[$k]['main_location'].'---'.$restoggle[$k]['sub_location']."'".$str1." ><span class='label-text'>".$restoggle[$k]['label_toggle']."</span></input> </label>";
  }
 //$str = preg_replace('/\s+/', '', $str);
  echo $str;

}

elseif(isset($_REQUEST['Draw']))
{
     if($_REQUEST['Draw']=='Circle')
     {
        $lat=(float)$_REQUEST['lat'];
        $lng=(float)$_REQUEST['lng'];
        $menu=implode(",",$_REQUEST['menu']);
        $rad=(float)$_REQUEST['rad'];
        $local=array(); $local1=array();$long=array();$lati=array();$addr=array();$ccp=array();

       $testquery="select a.longitude,a.latitude,a.distance,a.address,a.ccp_name,a.fld1054,a.image_name from
      (select fld1054,longitude,latitude,truncate((111.111 *
      DEGREES(ACOS(COS(RADIANS(latitude))
      * COS(RADIANS($lat))
      * COS(RADIANS(longitude - $lng))
      + SIN(RADIANS(latitude))
      * SIN(RADIANS($lat))))),2) AS distance,address,ccp_name,image_name from area_life_style_indicator_final
      )as a where a.distance < $rad and a.fld1054 in (".$menu.")";


      $res=yii::$app->db2->createCommand($testquery)->queryAll();

      for($v=0;$v<count($res);$v++)
      {

      array_push($long,$res[$v]['longitude']);
      array_push($lati,$res[$v]['latitude']);
      array_push($addr,$res[$v]['address']);
      array_push($ccp,$res[$v]['ccp_name']);
      array_push($local1,$res[$v]['image_name']);
      }

      if ($_REQUEST['type']==1)
      {
        // echo $val2." 1 ";
        $rad = $rad/2;
        // echo $val2." 2 "; //exit();
      }


      for($i=0;$i<count($long);$i++)
      {
      $dist=distance($lat,$lng,$lati[$i],$long[$i],'K');
      //if(($val2-$dist)<=5)
      if ($_REQUEST['type']==1)
      {
          if($dist<=$rad)
          {

            $r=$lati[$i].'****'.$long[$i].'****'.$addr[$i].'****'.$ccp[$i].'****'.$local1[$i];
            $local[$i]=$r;

          }
     }
     else
     {
     if($dist<=$rad)
      {
         $r=$lati[$i].'****'.$long[$i].'****'.$addr[$i].'****'.$ccp[$i].'****'.$local1[$i];
            $local[$i]=$r;
      }

     }
      }


      echo json_encode($local);

     }
     elseif($_REQUEST['Draw']=="Rect" || $_REQUEST['Draw']=="Poly")
     {
       $c = false;
        function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y) {
          $i = $j = $c = 0;

          for ($i = 0, $j = $points_polygon-1; $i < $points_polygon; $j = $i++) {
              if (($vertices_y[$i] >  $latitude_y != ($vertices_y[$j] > $latitude_y)) && ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i])) {
                  $c = !$c;
              }
          }

          return $c;
        }

     $x=$_REQUEST["x"];
     $y=$_REQUEST["y"];
     $points_polygon = count($x);
     $val3=implode(",",$_REQUEST["menu"]);
     $val5=trim($val3,",");

     $localmm=array();
     $localm=array();
     $longm=array();
     $latim=array();
     $addrm=array();
     $ccpm=array();

    $testquerym="select a.longitude,a.latitude,a.address,a.ccp_name,a.fld1054,a.image_name from area_life_style_indicator_final  as a where  a.fld1054 in (".$val5.")";


     $resm=yii::$app->db2->createCommand($testquerym)->queryAll();
     for($v=0;$v<count($resm);$v++)
    {

        array_push($longm,$resm[$v]['longitude']);
        array_push($latim,$resm[$v]['latitude']);
        array_push($addrm,$resm[$v]['address']);
        array_push($ccpm,$resm[$v]['ccp_name']);
         array_push($localm,$resm[$v]['image_name']);
    }
    if($_REQUEST['Draw']=="Poly")
     {
        for($i=0;$i<count($longm);$i++)
        {

        if (is_in_polygon($points_polygon, $x, $y, $latim[$i], $longm[$i])){


                  $r=$latim[$i].'****'.$longm[$i].'****'.$addrm[$i].'****'.$ccpm[$i].'****'.$localm[$i];
                $localmm[$i]=$r;
             }

         else{
        //  echo 'no';
         }

        }
    }
    else
    {
      for($i=0;$i<count($longm);$i++)
        {

                $r=$latim[$i].'****'.$longm[$i].'****'.$addrm[$i].'****'.$ccpm[$i].'****'.$localm[$i];
                $localmm[$i]=$r;

        }
    }


    echo json_encode($localmm);
     }
}
function distance($lat1, $lon1, $lat2, $lon2,$unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}

//mapname in back


if( isset($_REQUEST['drawshape'] ) )
{

    $mainlocation = $_REQUEST['mainlocation'];
    $sublocation=$_REQUEST['sublocation'];
    $drawshape=$_REQUEST['drawshape'];
    if($drawshape==1)
    {
  if($mainlocation==$sublocation)
    {
      $selectdata="select master_table from Geo_Hrchy_master where refid='".$mainlocation."'";
  
    }
    else if($mainlocation!=$sublocation)
    {
      $selectdata="select master_table from Geo_Hrchy_master where refid='".$sublocation."'";

    }

    //echo $selectdata;die;
        $query = yii::$app->db->createCommand($selectdata)->queryOne();
    echo $query['master_table']; 
    }
  }
if( isset($_REQUEST['label'] ))
{
             $fileid = $_REQUEST['fileid']; 
      $mainlocation = $_REQUEST['mainlocation'];
    $sublocation = $_REQUEST['sublocation'];
       if($mainlocation ==12 && $sublocation==12 &&  $fileid==73)
   {
    $fileid=14878;
   }
  
   if($mainlocation ==12 && $sublocation==15 &&  $fileid==73)
   {
    $fileid=14878;
   }
      if($mainlocation==12 && $sublocation==12 && $fileid==676)
   {
    $fileid=13346;
   }
    if($mainlocation==12 && $sublocation==15 && $fileid==676)
   {
    $fileid=13346;
   }
     if($mainlocation==$sublocation)
     {

    $selectdata="select refid,master_table from Geo_Hrchy_master where refid='".$sublocation."' ";
   
    $query = yii::$app->db->createCommand($selectdata)->queryOne();

        if($query['master_table']=="globe_master" )
         {
         $yt="refid";
         }else if($query['master_table']=="country_master" )
         {
           $yt ="refid" ;
         } else
         {
         $yt="country_id";
         }

     $sql2="select location_name,".$yt." as country_id from ".$query['master_table']." where refid=".$fileid;
     // echo $sql2;die;
      $res2=yii::$app->db->createCommand($sql2)->queryOne();
 
  $sql3="SELECT label FROM location_type WHERE country_id=".$res2['country_id']." and master_name='".$query['master_table']."'";
           //echo $sql3;die;
      $res3=yii::$app->db->createCommand($sql3)->queryOne();
     // $string1 ="";
     // $rt=$query['master_table'];
     //  $string1=str_replace("_master","",$rt);
        
    echo $res2["location_name"]."-".$res3["label"];
   }

  else if ($mainlocation!=$sublocation)
  {
 $selectdata="select refid,master_table from Geo_Hrchy_master where refid='".$mainlocation."' ";
   
    $query = yii::$app->db->createCommand($selectdata)->queryOne();

     if($query ['master_table']=="globe_master" )
         {
         $yt="refid";
         }else if($query['master_table']=="country_master" )
         {
           $yt ="refid" ;
         } else
         {
         $yt="country_id";
         }
     //echo $selectdata;die;
     $sql2="select location_name,".$yt." as country_id from ".$query['master_table']." where refid=".$fileid;
         //  echo $fileid;die;
      $res2=yii::$app->db->createCommand($sql2)->queryOne();
      ///echo $res2['country_id'];die;
   $sql3="SELECT label FROM location_type WHERE country_id=".$res2['country_id']." and master_name='".$query['master_table']."'";
   //echo $sql3;die;
      $res3=yii::$app->db->createCommand($sql3)->queryOne();
     // $string1 ="";
     // $rt=$query['master_table'];
     //  $string1=str_replace("_master","",$rt);
        
    echo $res2["location_name"]."-".$res3["label"];
  }
   
}



if( isset($_REQUEST['circle_result'] ) )
{
       $r=array();

        $mastername = $_REQUEST['mastername1'];
        //$refid = $_REQUEST['refid1'];
        $fileid = $_REQUEST['fileid1'];
        $passid = $_REQUEST['passid1'];
     $selectdata ="SELECT center_coordinates ,refid, location_name FROM `".$mastername."_master`  where  ".$passid." ='".$fileid."' and stat!='R'";

if($mastername=="city_master/village_master" )

       {

        $selectdata="";

        $selectdata ="SELECT center_coordinates ,refid, location_name FROM city_master  where  ".$passid." ='".$fileid."' and stat!='R' union SELECT center_coordinates ,refid, location_name FROM village_master  where  ".$passid." ='".$fileid."' and stat!='R'";
      }
       $query = yii::$app->db->createCommand($selectdata)->queryAll();
        // echo $selectdata;
        // die;

        for($i=0;$i<count($query);$i++)
        {
                $r[$i]= $query[$i]['center_coordinates'].",".$query[$i]['refid'].",".$query[$i]['location_name'];

        }

        echo json_encode($r);
}

if( isset($_REQUEST['parentlvl'] ) )
{

        $parentlvl = $_REQUEST['parentlvl'];
        $childlvl = $_REQUEST['childlvl'];
    if($parentlvl == $childlvl)
    {
       $sql="select master_table from Geo_Hrchy_master where refid=".$parentlvl;
      $res=yii::$app->db->createCommand($sql)->queryOne();  
    }
   else if($parentlvl != $childlvl)
    {
       $sql="select master_table from Geo_Hrchy_master where refid=".$childlvl;
      $res=yii::$app->db->createCommand($sql)->queryOne();  
    }

}
if( isset($_REQUEST['main_location'] ) && isset($_REQUEST['mouseover'] ) )
{

        $mainlocation = $_REQUEST['main_location'];
        $sublocation=$_REQUEST['sub_location'];
        $fileid=$_REQUEST['file_id'];

      $str=""; 
   if($mainlocation==21 && $sublocation==21)
   {
    $str="";
   }
   else if($mainlocation==21 && $sublocation==1)
   {

    $str="country";
   }
         else
         {
        
         if($mainlocation==$sublocation)
         {
       
          $sql1 = " SELECT master_name FROM location_type WHERE loc_type_id=".$sublocation." and stat!='R' ";

             $res1=yii::$app->db->createCommand($sql1)->queryOne(); 
              if($res1['master_name'] == "country_master")
              {

                $sql2= "SELECT refid as country_id  from ".$res1['master_name']." where refid=".$fileid; 
               // print_r($sql2);die;
                     $res2=yii::$app->db->createCommand($sql2)->queryOne(); 

              }
              else
              {
                $sql2= "SELECT  country_id from ".$res1['master_name']." where refid=".$fileid ; 
                     $res2=yii::$app->db->createCommand($sql2)->queryOne(); 
              }
            //print_r($sql2);die;
            
           $sql="SELECT label FROM location_type WHERE loc_type_id=".$mainlocation." and stat!='R' and country_id=".$res2['country_id'];

            $res=yii::$app->db->createCommand($sql)->queryOne();  
          
      } 
     else
     {
      // print_r($fileid);die;
           
             $sql1 = " SELECT master_name FROM location_type WHERE loc_type_id=".$mainlocation." and stat!='R' ";

             $res1=yii::$app->db->createCommand($sql1)->queryOne(); 
             //print_r($res1);die;
              if($res1['master_name']== "country_master")
              {

                $sql2= "SELECT refid as country_id  from ".$res1['master_name'] ." where refid=".$fileid; 
                     $res2=yii::$app->db->createCommand($sql2)->queryOne(); 

              }
              else
              {
                //print_r($fileid);die;
                  // $sql2= "SELECT country_id FROM state_master WHERE refid =";

                

                $sql2= "SELECT  country_id from ".$res1['master_name'] ." where refid=".$fileid  ; 
                     $res2=yii::$app->db->createCommand($sql2)->queryOne(); 
                                        //print_r($sql2);die;
              }
            
            
           $sql="SELECT label FROM location_type WHERE loc_type_id=".$sublocation." and stat!='R' and country_id=".$res2['country_id'];

          //$sql="SELECT label FROM location_type WHERE loc_type_id=".$sublocation." and stat!='R'  ";

            $res=yii::$app->db->createCommand($sql)->queryOne();  
          

     }
      
   

      $str= $res["label"] ;
    
  }

  echo $str;
}
//drawshape


?>

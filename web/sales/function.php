<?php

include("function1.php");
//intial stage done by gandhi
class Loadmap
 {

 	function init($login)
 	{
 		 $str="";
 		 $clientrights = "select loc_level,loc_id from client_user_access where client_user_id=".$login;
		 $res=yii::$app->db->createCommand($clientrights)->queryOne();
		 $secondcond="select main_location,sub_location from map_level where refid=".$res['loc_level'];
		 $res2=yii::$app->db->createCommand($secondcond)->queryOne();
		 $thirdsql="select refid,master_table from Geo_Hrchy_master where refid=".$res2['main_location'];
		 $res3=yii::$app->db->createCommand($thirdsql)->queryOne();
		
		 $str=$res['loc_id'].'---'.$res2['main_location'].'---'.$res2['sub_location'];
		 return $str;

 	}
 	function search()
 	{
 		$drop="";

		$sq1l="select refid,name from hul_alsi_master order by name asc";
		$res1=yii::$app->db->createCommand($sq1l)->queryAll();
		$drop .= "<select id='hul'  multiple='multiple' class='hultest' name='hul'>";
		$drop .="<option value=''>Select Category ...</option>";
		for($k=0;$k<count($res1);$k++)
		{
		      $drop .= "<option value=".$res1[$k]['refid'].">".str_replace("'","",$res1[$k]['name'])."</option>";

		}
		$drop .="</select>";
		return $drop;


 	}

 	 function say()
 {
     return 'Welcome to Brandidea';
 }
 	
 }

// if(isset($_REQUEST['datapost']))
// {
// 	$mapload=new Loadmap();
// 	$mapload1=new Loadmap1();
// 	//var_dump($mapload);
//   echo $fileloc=$mapload->say();
//    echo $fileloc1=$mapload1->sayone();
//     //echo 'rega';
// }
 






?>
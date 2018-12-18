<html>
<head>
<style type="text/css">
.certifiblockmain{
text-align:center;margin-top: -30px;
}
.certifiimgblock{
top:63%;position: absolute;
}
.certifiimgblock img{
width: 140px; height: 140px;
}

.certifiblocktext{
top:17%;position: absolute;
}

</style>
</head>
</html>
<?
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
use yii\helpers\Html;

$userid= @Yii::$app->user->identity->id ;
$grade='';
require_once "db.php";
//session_start();
//$contentid=$_REQUEST['id'];
//echo $_SESSION['userid'] = @Yii::$app->user->identity->id ;
  //$actual_link = "$_SERVER[REQUEST_URI]";
 //$name=explode('/',$actual_link );
  //$url="/".$name[1];




/*  $sql2 = "select a.crt_id,a.crt_title,a.role,ifnull(truncate((ifnull(gettot,0)/ifnull(tot,0))*100,2),0) as percentage ,name from
(select a.crt_id, a.crt_title, concat(ifnull(b.first_name,''),' ',ifnull(b.last_name,'')) as name, b.role from crt a,user b, allocation_master c
where a.crt_id=c.mod_record_id and c.emp_id=b.id and c.emp_id='$userid' group by crt_id) as a
left outer join
(select a.crt_id,sum(c.marks) as tot from crt_question_mapping a,module_masters b ,question_master c,session_masters d
where a.module_id=b.module_id and b.module_id=c.module_id and c.session_id=d.session_id group by a.crt_id) as b
on a.crt_id=b.crt_id
left outer join
(select a.crt_id,sum(b.marks) as gettot from
crt_question_mapping a,allocation_master b where a.crt_id=b.mod_record_id and b.emp_id='$userid' group by a.crt_id) as c
on a.crt_id=c.crt_id";*/


  $sql2="select a.crt_id,a.crt_title,a.role,ifnull(truncate((ifnull(gettot,0)/ifnull(tot,0))*100,2),0) as percentage,d.attempt_status

from
(select a.crt_id, a.crt_title, concat(ifnull(b.first_name,''),' ',ifnull(b.last_name,'')) as name, b.role from crt a,user b, allocation_master c
where a.crt_id=c.mod_record_id and c.emp_id=b.id and c.emp_id='".$userid."' group by crt_id) as a
left outer join
(select a.crt_id,sum(c.marks) as tot from crt_question_mapping a,module_masters b ,question_master c,session_masters d
where a.module_id=b.module_id and b.module_id=c.module_id and c.session_id=d.session_id group by a.crt_id) as b
on a.crt_id=b.crt_id
left outer join
(select a.crt_id,sum(b.marks) as gettot from
crt_question_mapping a,allocation_master b where a.crt_id=b.mod_record_id and b.emp_id='".$userid."' group by a.crt_id) as c
on a.crt_id=c.crt_id
left outer join
(select crt_id,attempt_status,emp_id from crt_session_type_participants where  emp_id='".$userid."' group by crt_id) as d on a.crt_id=d.crt_id where attempt_status='Closed'";






	$res2 = mysql_query($sql2)or die(mysql_error());


	$nrw = mysql_num_rows($res2);
	

	  

?>


<html>
      <div class="col-xs-12 col-sm-12 certifiblocktext">
  		 
     <table style="width:50%"   border="1">
        <tr> <td>CRT Name</td> <td>Status</td><td>View Certificate</td></tr>

       





<?php

	while($row2 = mysql_fetch_assoc($res2))
	{	   


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
	    





  echo "<tr><td>";
  echo  $row2['crt_title']; 

 
 
  echo "</td>";


  echo "<td>";
  echo  ucfirst($grade); 
  echo "</td>";


  echo "<td>";
echo '<a href="index.php?r=site/onlinecertificate&link=' . $row2['crt_id'] . '">Click </a>';
  echo "</td>";

    echo "</tr>";
     }

?>

</table>



      </div>
   




</html>









		
		
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


$crt_id=$_REQUEST['link'];
$grade='';
require_once "db.php";
//session_start();
//$contentid=$_REQUEST['id'];
//echo $_SESSION['userid'] = @Yii::$app->user->identity->id ;
  //$actual_link = "$_SERVER[REQUEST_URI]";
 //$name=explode('/',$actual_link );
  //$url="/".$name[1];


/*

  $sql2 = "select a.crt_id,a.crt_title,a.role,ifnull(truncate((ifnull(gettot,0)/ifnull(tot,0))*100,2),0) as percentage ,name from
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

/*
    $sql2="select a.crt_id,a.crt_title,a.role,ifnull(truncate((ifnull(gettot,0)/ifnull(tot,0))*100,2),0) as percentage,d.attempt_status,name

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
(select crt_id,attempt_status,emp_id from crt_session_type_participants where  emp_id='".$userid."' group by crt_id) as d on a.crt_id=d.crt_id where attempt_status='Closed' and a.crt_id='".$crt_id."'";

*/


  $sql2="select a.crt_id,a.emp_id,c.crt_title,concat(ifnull(b.first_name,''),' ',ifnull(b.last_name,'')) as name, b.role,
 ifnull(truncate((ifnull(sum(a.max_score),0)/ifnull(sum(a.max_marks),0))*100,2),0) as percentage,
if((select count(c.question_type)as cnt from crt_session_type_participants c  where c.attempt_status ='Open'
 and c.crt_id='".$crt_id."' group by c.crt_id)>0,'InProcess','Closed') as attempt_status,a.attempt_date
from crt_session_type_participants a,user b,crt c where a.emp_id=b.id  and a.crt_id=c.crt_id and a.emp_id='".$userid."' 
and a.crt_id='".$crt_id."' group by a.emp_id,a.crt_id";






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
	    
	
	//$certificate[] = array('name'=>$row2['crt_title'],'role_name'=>$row2['role'],'percent'=>$row2['percentage'],'grade'=>$grade,'class_name'=>$row2['crt_title']);


?>



<div>


<script>
function goBack() 
{
    window.history.back();
}
</script>
</div>
<div>

<FORM><INPUT Type="button"  onclick="goBack()" value="BACK"></FORM>


</div>


  <div class="col-sm-12 certifiblockmain">


    <div class="row">
      <div class="col-xs-12 col-sm-12">
        <?php echo Html::img('@web/images/bgc.jpg') ?>
      </div>
      <div class="col-xs-12 col-sm-12 certifiblocktext">
  		  <span style="font-weight:bold; color:#FF0000;margin-top:20px;">Cigna TTK Academy</span>
        <br><br>
        <span class="certify"><i>This is to certify that</i></span>
        <br><br>
       <span> <u id="name"> <?php echo $row2['name'];?></u></span>

        <span class="certify"><u id="sname"></u></span><br/><br/>
        <span class="certify"><i>has participated in</i></span> <br/><br/>

        <span class="certify"><u id="mname"></u> for the Role</span> <br/><br/>

         <span class="certify">of <u id="role"> <?php echo $row2['role'];?> </u></span> <br/><br/>

        <span class="certify"><i>and the performance is </i></span><br>
      </div>
      <div class="col-xs-12 col-sm-12 certifiimgblock">
        <?php
          //echo Html::img('@web/images/excellent.png') 

      if('excellent' == $grade)
          {
              echo Html::img('@web/images/excellent.png') ;

          }
            elseif ('good'==$grade) 
         {

         	echo Html::img('@web/images/good.png') ;

         }
         elseif('average'==$grade)
         {

         		echo Html::img('@web/images/average.png') ;
         }
       


          ?>

        
      </div>
    </div>
  </div>







<?	}


?>




		
		
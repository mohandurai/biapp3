<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.2.6.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/sms/js/crud_o.js" type="text/javascript"></script>

<style>
body{width:100%;}
/*.message-box{margin-bottom:20px;border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
.btnEditAction{background-color:#2FC332;border:0;padding:2px 10px;color:#FFF;}
.btnDeleteAction{background-color:#D60202;border:0;padding:2px 10px;color:#FFF;margin-bottom:15px;}
#btnAddAction{background-color:#09F;border:0;padding:5px 10px;color:#FFF;}*/
</style>
<?php
$emp_id=$_SESSION['emp_id'];
 $sqlCom="select lkid,t_id,likes,a.created_date,a.modified_date,concat(ifnull(b.first_name,''),'',ifnull(b.last_name,'')) as EmpName,b.emp_id,concat('http://192.168.2.20/seed/',trim(b.profile_image_url)) as profile_com from file_like a,employee_master b where a.emp_id=b.emp_id and module_name='leaderspeek' and likes='1' and  t_id='".$_REQUEST['parameter']."'group by  a.emp_id  "; 
 $connection = Yii::app()->db;
$command = $connection->createCommand($sqlCom);
$comments = $command->queryAll();
//echo "<pre>";print_r($comments); 
?>


<div class="form_style">
<div id="comment-list-box">
<?php
$r=0;
while($r<count($comments))
{
//print_r($comments);
//echo $comments[$r]["comments"]; 
?>
<div style="clear:both;">
<div class="image"><img class="image-popup" style="" src="<?=$comments[$r]["profile_com"]?>" alt="" /></div>
<div class="image-pop-comment" style=""><?=$comments[$r]["EmpName"]?></div>
</div>
<?php
$r++;
}
 ?>
</div>


</div>
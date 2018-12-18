<?
session_start();
 $user = @Yii::$app->user->identity->id;
     $id=$_REQUEST["id"];
       $userid=$_REQUEST['emp'];
 $infocnt2 = Yii::$app->db->createCommand('SELECT ojt_supervisor FROM plan_ojt  where ojt_id="'.$id.'"')->queryAll();
for($i=0;$i<count($infocnt2);$i++)
 {
		$superviserid= $infocnt2[$i]['ojt_supervisor'];		
}


	 //$superviserid = @Yii::$app->user->identity->id ;
	 $testbuton=$_REQUEST["testbuton"];
	 $empid=$_REQUEST["emp"];
     $id=$_REQUEST["id"];
	 $_SESSION['empid'] = $_REQUEST["emp"] ;
?>	
<?
$this->registerJs(
     '$("document").ready(function()
	{ 
      $(".status").change(function(){
	     var ojtid='.$id.';
	      var user='.$user.';
	     var superid = '.$superviserid.';
		 var empname=document.getElementById("empname").value;
   $.post("?r=ojtcontentview/checkteststatus",{empname:empname,ojtid:ojtid,superid:superid,user:user},function(selecting)
						{
	
						if(selecting==1)
						{
						alert("Already Completed");
						window.location.assign("index.php?r=site/ojtquizcontant&emp="+empname+"&id="+ojtid);
						}else
						{
		window.location.assign("index.php?r=site/ojtquizcontant&emp="+empname+"&id="+ojtid+"&testbuton=Y"+"&user="+user);						
				
						}
	}
						
						);

        });					
       });'
     );
?>


<style>
h1
{
display:none;
}

iframe{border:none; height: 500px;}
</style>

	<?
		 $infocnt = Yii::$app->db->createCommand('SELECT ojt_content as content,ojt_title as info FROM  plan_ojt  where ojt_id="'.$id.'"')->queryAll();
							   for($i=0;$i<count($infocnt);$i++)
							   {
								$content= $infocnt[$i]['content'];
								$info= $infocnt[$i]['info'];
								}
	
	?>
                                                <!--User Design-->
<div>
	<div align="center">
					<h3 class="ojt-head-title"><b>OJT Title - <? echo $info; ?></b></h3>
				</div>				
				<div align="left" class="row">
					
					<span class="ojt-select">Select Participant &nbsp;&nbsp;<img src="https://tuneem.com//tuneem/web/images/ojt-arrow.png"/></span><select name="empname"  class="status ojt-opt" id="empname" id="cd-dropdown">
						 <option value="" class="ojt-option">Select here</option>
						 					 
<?   
 
if($user==$superviserid){
$emplist = Yii::$app->db->createCommand('SELECT distinct(a.emp_id),first_name FROM  allocation_master as a inner join plan_ojt as b  inner join  user as c on a.emp_id=c.id and b.ojt_supervisor="'.$superviserid.'" and a.mod_record_id=b.ojt_id  and b.ojt_id="'.$id.'"')->queryAll();
}else{
$emplist = Yii::$app->db->createCommand('SELECT distinct(a.emp_id),first_name FROM  allocation_master as a, plan_ojt as b,user as c where a.emp_id="'.$user.'" and a.emp_id=c.id and b.ojt_supervisor="'.$superviserid.'" and a.mod_record_id=b.ojt_id  and b.ojt_id="'.$id.'"')->queryAll();
}
	for($l=0;$l<count($emplist);$l++)
	 { ?>
						<option  class="ojt-option"  <? if($emplist[$l]['emp_id']==$empid){ echo "selected" ; } ?>   value="<?=$emplist[$l]['emp_id'] ?>"><?=$emplist[$l]['first_name'] ?></option>
						 <? } ?>
					</select>
</div>			
			
</div>		
	
					<!--End user Design-->
<?
session_start();
$contentid=$_REQUEST['id'];
$_SESSION['userid'] = @Yii::$app->user->identity->id ;
  $actual_link = "$_SERVER[REQUEST_URI]";
 $name=explode('/',$actual_link );
  $url="/".$name[1];
?>
<?  if($testbuton=='Y' and $empid!="" and $id!="" ) { ?>
<div>
<iframe src="<?=$url ?>/quiz/ojtquiz.php?id=<?= $contentid ?>&emp=<?= $userid ?>&user=<?= $user ?>" width="100%" height="300"></iframe>
</div>

<?  } ?>





</script>
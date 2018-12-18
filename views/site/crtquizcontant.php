<?
session_start();
     $id=$_REQUEST["id"];
	 $superviserid = @Yii::$app->user->identity->id ;
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
	     var crtid='.$id.';
		 var empname=document.getElementById("empname").value;

   $.post("?r=crtcontentview/checkteststatus",{empname:empname,crtid:crtid},function(selecting)
						{
	
						if(selecting==1)
						{
						alert("Already Completed");
						window.location.assign("index.php?r=site/crtquizcontant&emp="+empname+"&id="+crtid);
						}else
						{

							window.location.assign("index.php?r=site/crtquizcontant&emp="+empname+"&id="+crtid+"&testbuton=Y");
						
				
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
				 $infocnt = Yii::$app->db->createCommand('select distinct d.pre_coaching_content as content,a.crt_title as info FROM  crt a,crt_question_mapping b,module_masters c,pre_coaching_master d where a.crt_id="'.$id.'" and a.crt_id=b.crt_id and b.module_id=c.module_id and c.pre_coaching_name=d.pre_coaching_id')->queryAll();

							   for($i=0;$i<count($infocnt);$i++)
							   {
								$content= $infocnt[$i]['content'];
								$info= $infocnt[$i]['info'];
								}
	
	?>
                                                <!--User Design-->
<div>
	<div align="center">
					<h3 class="crt-head-title"><b>CRT Title - <? echo $info; ?></b></h3>
				</div>				
				<div align="left" class="row">
					
					<span class="crt-select">Select Participant &nbsp;&nbsp;<img src="https://tuneem.com//tuneem/web/images/ojt-arrow.png"/></span><select name="empname"  class="status crt-opt" id="empname" id="cd-dropdown">
						 <option value="" class="crt-option">Select here</option>
						 					 
																<?   $emplist = Yii::$app->db->createCommand('SELECT distinct(a.emp_id),first_name FROM  allocation_master as a inner join crt as b  inner join  user as c on a.emp_id=c.id and a.mod_record_id=b.crt_id  and b.crt_id="'.$id.'"')->queryAll();
																				   for($l=0;$l<count($emplist);$l++)
																				   { ?>
						<option  class="crt-option"  <? if($emplist[$l]['emp_id']==$empid){ echo "selected" ; } ?>   value="<?=$emplist[$l]['emp_id'] ?>"><?=$emplist[$l]['first_name'] ?></option>
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
<iframe src="<?=$url ?>/quiz/crtquiz.php?id=<?= $contentid ?>" width="100%" height="300"></iframe>
</div>

<?  } ?>





</script>

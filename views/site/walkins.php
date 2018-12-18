<?
session_start();
    $id=$_REQUEST["id"];
    use yii\helpers\Html;
?>
<script>
function callquiz(eid,cid)
{
	var comm=document.getElementById("comm").value;
	var cate=document.getElementById("cat").value;
window.location.assign("index.php?r=site/walkinstest&cid="+cid+"&eid="+eid+"&comm="+comm+"&cate="+cate);
} 

</script>
<style>
h1
{
display:none;
}
.naminimg img
{
   width: 100px;
	height: 100px;
	border-radius: 50px;
	-webkit-border-radius: 50px;
	-moz-border-radius: 50px;
	box-shadow: 0 0 8px rgba(0, 0, 0, .8);
	-webkit-box-shadow: 0 0 8px rgba(0, 0, 0, .8);
	-moz-box-shadow: 0 0 8px rgba(0, 0, 0, .8);
	
}

.clenew{
clear:both;
}

.dh-border
{
	border:3px solid rgb(5,104,134);
}
.dh-cnt-title
{
margin-bottom:20px;
margin-top:20px;
}

.dh-font-color
{
	color:rgb(5,104,134);
}
	.dh-video
{
    width: 100%;
    height: auto;
}
	#dh-btn-test
{
	margin-top:10px;
}
embed[Attributes Style] 
{
	width: 100%;
	height: 100%;
}
.mastercol{
border:1px solid green;
}
.submastercol{
/*border:1px solid red;*/
} 
	</style>

<div>


				<?  $idval=$_REQUEST['id'];  
				
 $baseurl1= 'https://' . $_SERVER['HTTP_HOST'].$baseurl; 
$baseurl2= 'localhost' . $baseurl; 
				?>
				<center>
				<?php
			$ss = "localhost/".$filename;			
				?>
					 <? 
						 	
						  $infocnt1 = Yii::$app->db->createCommand('SELECT distinct crt_title FROM  crt where crt_id="'.$id.'"')->queryAll();
							   for($i=0;$i<count($infocnt1);$i++)
							   {								
								$crtname= $infocnt1[$i]['crt_title'];
								}
?>
							<div class="row">
					<div class="dh-cnt-title col-lg-12">
						<center><h4 class="dh-font-color"><b>Title :<?= $crtname;?></b></h4><center>
						<!--<h4 class="dh-font-color"><b>Subject :</b></h4>-->
					</div>
				</div>
				<?

	$infocnt = Yii::$app->db->createCommand('SELECT distinct emp_id,category_status FROM  crt_walkins where crt_id="'.$id.'" ')->queryAll();

							   for($i=0;$i<count($infocnt);$i++)
							   {								
								$info= $infocnt[$i]['emp_id'];								
								$cstatus= $infocnt[$i]['category_status'];				
													
	$cnt = Yii::$app->db->createCommand('SELECT profile_image_url,username  FROM  user where id="'.$info.'"')->queryAll();
							   for($m=0,$n=1;$m<count($cnt);$m++,$n++)
							   {
								$username= $cnt[$m]['username'];
								$filename= $cnt[$m]['profile_image_url'];
								$ext=explode('.',$filename) ;                                                            
 											$extention=$ext[1];				  
							   								
								 $baseurl= Yii::$app->getUrlManager()->getBaseUrl()."/".$filename;
							      $baseurl1= 'https://'.$_SERVER['HTTP_HOST'].$baseurl; 
							
						 ?>
<div  class="row mastercol" style="">
<!--<div class="clenew submastercol" style="border-bottom:none;">-->
<div class="col-md-2" style="padding-top:30px;">
			<div class="naminimg"  style="border:1px;">
			<img src="<?php echo $baseurl1; ?>" style="width:100px; height:100px;">
						</div>
</div>
<div class="col-md-3" style="height:150px; line-height:150px;"><?php 	echo $username; 
?>
<br>
</div>
<div class="col-md-4" style="height:150px; padding-top:20px;">
<textarea name="comment" id="comm" rows="5" cols="50"> </textarea>
</div>
<div class="col-md-2" style="height:150px; padding-top:70px;">
	<select name="category]" id="cat">
	<option value="<?php echo $cstatus; ?>"><?php echo $cstatus; ?></option>
	<option value="">---Select One---</option>
		<option value="Accept">Accept</option>
		<option value="Reject">Reject</option>
	</select>
</div>


<div class="col-md-1" style="height:150px; padding-top:50px;">
<button class="btn-success dh-cnt-title" onclick=callquiz(<?= $info?>,<?= $id?>)>>></button>
</div>
<?
}  }  ?>
</tr>    </div>
    <div style="clear:left;"> </div>
		</div>


		
		
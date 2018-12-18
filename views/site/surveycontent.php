<script>
function callquiz(contentid)
{
window.location.assign("index.php?r=site/surveyquizcontent&id="+contentid);
} 
function openPopupPage(relativeUrl, cd_id,emp_id)

{

 var param = { 'id' : cd_id, 'emp_id': emp_id };
 OpenWindowWithPost(relativeUrl, "width=1600, height=700, left=0, top=0, resizable=yes, margin=0 auto, scrollbars=yes", "NewFile", param);
 
}
function OpenWindowWithPost(url, windowoption, name, params)

{

 var form = document.createElement("form");

 form.setAttribute("method", "post");

 form.setAttribute("action", url);

 form.setAttribute("target", name);

 for (var i in params)

 {

   if (params.hasOwnProperty(i))

   {

     var input = document.createElement('input');

     input.type = 'hidden';

     input.name = i;

     input.value = params[i];

     form.appendChild(input);

   }

 }

 document.body.appendChild(form);

 //note I am using a post.htm page since I did not want to make double request to the page

 //it might have some Page_Load call which might screw things up.

 window.open("post.htm", name, windowoption);

 form.submit();

 document.body.removeChild(form);

}
 
</script>
<style>
h1
{
display:none;
}
.dh-border
{
	border:none;
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

	</style>

<div>
                		       <?
						          /*
						          <?= @Yii::$app->user->identity->id ?>
						           */ 
						         $id=$_REQUEST["id"];
						         ?>

						 <?  $infocnt = Yii::$app->db->createCommand('SELECT survey_content as content,survey_title as info FROM  plain_survey where survey_id="'.$id.'"')->queryAll();
							   for($i=0;$i<count($infocnt);$i++)
							   {
								$content= $infocnt[$i]['content'];
								$info= $infocnt[$i]['info'];
								}
								
								//conten tupe 
							   $cnt = Yii::$app->db->createCommand('SELECT title,content_type as contype FROM  content_master where content_id="'.$content.'"')->queryAll();
							   for($j=0;$j<count($cnt);$j++)
							   {
								$contype= $cnt[$j]['contype'];
							   }
								
								//conten tupe name
							    $cntname = Yii::$app->db->createCommand('SELECT f_name as content_name FROM  file_transfer where f_id="'.$contype.'"')->queryAll();
							   for($m=0;$m<count($cntname);$m++)
							   {
								  $content_name= $cntname[$m]['content_name'];
							   }
								$cnt = Yii::$app->db->createCommand('SELECT filename  FROM  documentsupload where modid="'.$content.'" and module="ContentMaster"')->queryAll();
							   for($m=0;$m<count($cnt);$m++)
							   {
								$filename= $cnt[$m]['filename'];
								$ext=explode('.',$filename) ;
                                                                $extention=$ext[1];


							   }
							   
							   
								//Image path
								 $cnttype = Yii::$app->db->createCommand('SELECT filepath  FROM  documentsupload where modid="'.$content.'" and module="ContentMaster"')->queryAll();
							   for($k=0;$k<count($cnttype);$k++)
							   {
								  $path= $cnttype[$k]['filepath'];
							   }	
								   $baseurl= Yii::$app->getUrlManager()->getBaseUrl()."/".$path;
						 ?>

				<div class="row">
					<div class="dh-cnt-title col-lg-12">
						<center><h4 class="dh-font-color"><b>Title :<?= $info;?></b></h4><center>
						<!--<h4 class="dh-font-color"><b>Subject :</b></h4>-->
					</div>
				</div>
				<!--<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<h4 class="dh-font-color"><b>Content Type :</b></h4>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<h4 class="dh-font-color"><b>Schedule Date :</b></h4>
					</div>
					
				</div>-->
 <div  class="dh-border row">
				<?  $idval=$_REQUEST['id'];  ?>
				<!--video Document-->
				<? if( $extention=='mp4') { ?>
					<center>
					<video autoplay controls class="dh-video survey-border" >
					<source src="<?= $baseurl;?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
					<source src="video/trailer.webm" type='video/webm; codecs="vp8, vorbis"'/>
					  Video not supported.
					</video>
					</center>
					<? } 
					else if($extention=='png' or $extention=='jpg')
					 { ?>
				<!--image Document-->
					<center>
					<img src="<?= $baseurl;?>" class="img-responsive survey-border">
					</center>
				<!--PDF Docuemtn-->
				<? } else if($extention=='Pdf' or $extention=='pdf') {?>

                           <?php  $baseurl1= 'https://' . $_SERVER['HTTP_HOST'].$baseurl; ?>
					
					
<center>
<iframe src="http://docs.google.com/gview?url=<?= $baseurl1 ?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>
					</center>
					<? } else if($extention=='xls' or $extention=='xlsx' or $extention=='docx' or $extention=='doc' or $extention=='ppt') { 

                                        $baseurl1= 'https://' . $_SERVER['HTTP_HOST'].$baseurl; ?>

				<center>
<iframe src="http://docs.google.com/gview?url=<?= $baseurl1 ?>&embedded=true" style="width:100%; height:500px;" frameborder="0"></iframe>
					</center>

				<? } else if($extention=='mp3') { ?>
				<!--Document--> 
					 <center>
					 <audio controls class="survey-border">
					<source src="<?= $baseurl;?>" type="audio/ogg">
					<source src="horse.mp3" type="audio/mpeg">
				     Your browser does not support the audio tag.
			     	</audio>
					</center> 
				<? } else { ?>
			   <center> 
			   <? echo "Please Upload Content";   ?>
			   </center>
				<? } ?>
    </div>
    <?
 $actual_link = "$_SERVER[REQUEST_URI]";
 $name=explode('/',$actual_link );
 $url="http://$_SERVER[HTTP_HOST]/".$name[1]."/quiz/surveyquiz.php";
 $contentid=$_REQUEST['id'];
 $empid=$_SESSION['userid'] = @Yii::$app->user->identity->id ;
 $_SESSION['contentid']=$contentid;
?>
		<div class="row" id="dh-btn-test">
				<center><button class="btn-success dh-cnt-title" onclick=openPopupPage('<?=$url?>','<?=$contentid?>','<?=$empid?>')>Take Test</button></center>
		</div>		
		</div>
		</div>
<style>
body
{
width:100%
margin:0 auto;
background-color:#e9eaed;
}
.cmd-part
{
clear:both;
width:100%;
}
.prf-name
{
float:left;
width:70%;
margin-left:10px;
font-size:13px;
color:#000;
}

button.btn
{
width:110px;
padding:10px 0px  10px 0px  !important;
background-color:#44a2ff  !important;
margin:0px 0px 0px 0px;
}
.message-content1
{
font-size:13px;
color:#000;margin-left:10px;
}
.srl
{

border:1px solid #003366;
    height: 450px;
    overflow: scroll;
	}
.banners
{
width:50%
margin:0 auto;
color:#003366;
border:1px solid #003366;
background-color:#fff;
}
.headerss
{
width:90%;
margin:0 auto;
}
.headerss1
{
width:100%;
}

.image
{
float:left;
border:1px solid #bcbcbc;
}
.profine-name
{
font-size:1em;
float:left;
line-height:25px;
margin:-5px 0px 0px 10px;
}
.right
{
float:right;
margin:10px 0px 0px 0px;
}
.bdy-img
{
width:100%;
margin:0 auto;
}
.bdy
{
margin:0 auto;
text-align:center;
padding-top:0px;
}
.para
{
text-align:left;
font-size:2em;
margin:20px 0px 0px 30px 
}
.cmt
{
float:left;
}
.para2
{
text-align:left;
font-size:2em;margin:10px 0px 0px 20px 
}
.para22
{
text-align:left;font-size:2em;
margin:0px 10px 0px 10px 
}
.input
{
text-align:left;
margin:10px 0px 0px 20px 
}
.comment
{
border-top:1px solid;
margin:0px 0px 0px 0px;
background-color:#f6f7f8;
}
.under:hover
{
text-decoration:underline;
}
.message-box{margin-bottom:20px;background:#FAF8F8;padding:10px;}
.btnEditAction{background-color:#2FC332;border:0;padding:2px 10px;color:#FFF;}
.btnDeleteAction{background-color:#D60202;border:0;padding:2px 10px;color:#FFF;margin-bottom:15px;}
#btnAddAction{background-color:#09F;border:0;padding:5px 10px;color:#FFF;}
</style>
<style>
body{width:610;}
.demo-table {width: 100%;border-spacing: initial;margin: 20px 0px;word-break: break-word;table-layout: auto;line-height:1.8em;color:#333;}
.demo-table th {background: #81CBFD;padding: 5px;text-align: left;color:#FFF;}
.demo-table td {border-bottom: #f0f0f0 1px solid;background-color: #ffffff;padding: 5px;}
.demo-table td div.feed_title{text-decoration: none;color:#40CD22;font-weight:bold;}
.demo-table ul{margin:0;padding:0;}
.demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
.demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
.btn-likes {float:left; padding: 0px 5px;cursor:pointer;color:red;}
.btn-likes input[type="button"]{width:15px;height:13px;border:0;cursor:pointer;}
.like {background:url('sms/like.png')}
.unlike {background:url('sms/unlike.jpg')}
.label-likes {font-size:12px;color:red ;height:20px;float:left;}
.desc {clear:both;color:#999;}

</style>
<link href="css/core_style.css" media="screen" rel="stylesheet" type="text/css">
		<script src="sms/js/jquery.min.js" type="text/javascript"></script> 
	    <script src="sms/js/mediaelement-and-player.min.js"></script>
		
 <script src="sms/js/crud_o.js"></script>
 <script src="sms/js/offisocio.js"></script>
<script src="sms/js/like_o.js" type="text/javascript"></script>

<style type="text/css">
.me-cannotplay
{
display:none;
}
</style>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/thickbox/jquery.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/thickbox/thickbox.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/thickbox/thickbox.css" media="screen, projection" />
<script type="text/javascript">
jQuery(document).ready(function(){
$('#suggestlist').click(function(){
var g = document.getElementById('find_vlues').value;
//alert(g);
if(g!=0)
{
$("#url").trigger('click');
}

});
});
</script>
<?php
if($_SESSION['login_id']=='')
{
    header('Location: index.php');   
}
require_once "db.php";
$emp_id = $_SESSION['emp_id'];
 $sql="select a.t_id,a.title,a.emp_id,a.emp_name,a.file_name,
concat('http://tuneem.com/seedsand/file_transfer/',file_name) as location,a.created_date,description,concat('http://tuneem.com/seedsand/',trim(b.profile_image_url)) as profile from reinforcement_file_transfer a,employee_master b WHERE a.emp_id=b.emp_id and a.status='O'"; 
//echo $sql . "</br>";
$resRe = mysql_query($sql);
	//$nremark = mysql_num_rows($resRe);
	$remark = array();
	$x=1;
	while($rowRw= mysql_fetch_assoc($resRe))
	{

	$name=$rowRw['emp_name'];
	$title=$rowRw['title'];
	$created_date=$rowRw['created_date'];
	$description=$rowRw['description'];
	$profile=$rowRw['profile'];
	$location=$rowRw['location'];
	 $file_location = $rowRw['file_name'];
	$files = explode(".",$file_location); 
	$t_id=$rowRw['t_id'];;
	 $sqlsum="select  sum(likes) as total  from  file_like where t_id='$t_id'";
	$consum=mysql_query($sqlsum);
	$consums=mysql_fetch_row($consum);
	//print_r($connsums);
	 $sqlsumu="select  count(comments) as total  from  file_comment where t_id='$t_id'";
	$consumu=mysql_query($sqlsumu);
	$consumsum=mysql_fetch_row($consumu);
?>
<div class="banners"  style="margin:auto;clear:both;">
<br/>
<div class="headerss">
<div class="headerss1">
<div class="image"><img style="width:40px" src="<?=$profile?>" alt="" /></div>
<div class="profine-name"><sapn class="under"><span style="font-weight:bold;"><?=$name?></span></sapn><br/><span style="font-weight:bold;color:#9197a3;"><?=$created_date?></span></div> 
<div class="right"></div>
</div>
</div>
<div style="clear:both"></div>

<div class="bdy-img">
<div style="color:#000;font-size:1.2em; margin:20px 0px 0px 30px;"><?=$title?></div>
<div class="bdy">
<?  if($files[1]=='jpg')
{ 
?>
<img src="<?=$location?>" height="400" width="500" />
<?   }?>




<? if($files[1]=='avi' || $files[1]=='mp3'|| $files[1]=='mp4')
{  ?>	
		

		<video  width="640" height="360" controls="control" preload="none">		
			<source src="<?=$location?>" type="video/mp4" />
		</video>

		
	



<? }?>
<?  if($files[1]=="xls" or $files[1]=="docx"){ ?>
				

				  <iframe src="https://docs.google.com/viewer?embedded=true&url=http://tuneem.com/seedsand/file_transfer/<?=$file_location?>"  width="600" height="600" scrolling="no"></iframe>
				
				<? }?>
<!--<img style="width:100%" src="<?=$location?>" alt="" />--></div>
</div>
<div class="para"><!--<sapn class="under">Like</sapn> . <sapn class="under">Comment</sapn> -->&#160;&#160;&#160;&#160;<sapn class="under">

<?php
 $query ="SELECT t_id,sum(likes) as total ,likes FROM file_like where t_id='".$t_id."' and likes=1  and module_name='offisocio'   group by t_id";
$count = mysql_query($query);
$counts=mysql_num_rows($count);
$tutorial = mysql_fetch_assoc($count);
//print_r($tutorial);
$query1 ="SELECT t_id,sum(likes) as total ,likes FROM file_like where t_id='".$t_id."' and emp_id='$emp_id'   group by t_id";
$count1 = mysql_query($query1);
$tutorial1 = mysql_fetch_assoc($count1);
if($tutorial1['likes']==1) {

$str_like = "unlike";
}
else{
$str_like = "like";
}

?>
 <div id="tutorial-<?php echo $t_id; ?>">
<input type="hidden" id="likes-<?php echo $t_id; ?>" value="<?php echo $tutorial["total"]; ?>">
<div class="btn-likes"><input type="button" title="<?php echo ucwords($str_like); ?>" class="<?php echo $str_like; ?>" onClick="addLikes(<?php echo $t_id; ?>,'<?php echo $str_like; ?>')" /></div>
<div class="label-likes"><?php if(!empty($tutorial["total"])) { echo "<a id='url' href='index.php?r=site/popup_likes&parameter=".$t_id."&keepThis=true&amp;TB_iframe=true&amp;height=400&amp;width=550' title='' style='text-decoration:none;color:#003366;' class='thickbox'>".$tutorial["total"] . " Like(s)&#160;&#160;</a>"; } ?></div>

</div>
<!--<img style="width:30px" src="Facebook_like_thumb.png" alt="" />-->


</span><sapn class="under"><img  src="sms/nexusae0_fbmessenger2.png" alt="" /></span>
<? if($consumsum[0]>2){
echo "<a id='url' href='index.php?r=site/popup_offisocio&parameter=".$t_id."&keepThis=true&amp;TB_iframe=true&amp;height=400&amp;width=550' title='' style='text-decoration:none;color:#003366;vertical-align:4px;' class='thickbox'>".$consumsum[0]."-More comments</a>";
}?>

</div>
<div class="comment">
<!--<div class="para2"><img style="width:30px" src="Facebook_like_thumb.png" alt="" /> Vicgnu G <span style="font-weight:bold;color:#9197a3;">likes this.</span></div>-->
<div class="para22">&#160;&#160;&#160;
 
<div class="form_style">
<div id="comment-list-box_<?=$t_id?>">
<?php
    $sqlCom="select cmid,t_id,comments,a.created_date,a.modified_date,concat(ifnull(b.first_name,''),'',ifnull(b.last_name,'')) as EmpName,b.emp_id,concat('http://tuneem.com/seedsand/',trim(b.profile_image_url)) as profile_com from file_comment a,employee_master b where a.emp_id=b.emp_id and module_name='offisocio' and  t_id='".$t_id."' ORDER BY  a.cmid DESC  limit 1"; 

$comments1= mysql_query($sqlCom);
//$comments = mysql_fetch_assoc($comments1);
//echo "<pre>";print_r($comments1);die;

while($comments = mysql_fetch_assoc($comments1)) {

?>
<div class="cmd-part"  id="cc_<?=$t_id?>">
<div class="image"><img style="width:40px;font-size:1em;" src="<?=$comments["profile_com"]?>" alt="" /></div>
<div class="prf-name"><span style="font-weight:bold;font-size:15px;color:#003366;"><?=$comments["EmpName"]?>:</span> <span class="cmd"  id="message_<?php echo $comments["cmid"];?>" ><?php echo $comments["comments"]; ?></span><p  style="font-weight:bold;color:#9197a3;font-size:10px;margin-top:5px;"><? if($comments['modified_date']!="0000-00-00 00:00:00")
{echo $comments['modified_date'];}else{echo $comments['created_date'];}?></p></div>
<?php
//$_SESSION["class"]=$t_id;
/*echo "em".$emp_id;
echo "em11".$comments["emp_id"];*/
if($emp_id==$comments["emp_id"]){
?>

<div style="float:right;" id='ed'>
<button class="btnEditAction" name="edit" onClick="showEditBox(<?php echo $comments["cmid"]; ?>)">Edit</button>
<button class="btnDeleteAction" name="delete" onClick="callCrudAction('delete',<?php echo $comments["cmid"]; ?>)">Delete</button>
</div>
<?php
}
?>
</div>
<?php
} ?>
</div>

<div stlye="width:100%;margin:0px 0px 60px 0px; clear:both;"  id="frmAdd">
<div  style="float:left;"><textarea name="txtmessage<?=$x;?>" id="txtmessage<?=$x?>" cols="65" rows="2"></textarea></div>
<div style="float:right"><button  class="btn" id="btnAddAction" name="submit" onClick="callCrudAction('add','','<?=$t_id?>','<?=$x?>')">Add</button></div><br/><br/><br/><br/><br/><br/><br/>
</div>
<!--<input type="text" style="width:80%; height:60px; color:#bcbcbc;vertical-align: 10px;font-size:0.87em;" name="firstname" value=" Write a Comment...">

-->
</div></div></div></div>
<?php 
$x++;
} ?>
</div>


<?php
session_start();
//echo "<pre>";
//print_r($_SESSION);
//exit;
$emp_id = $_SESSION['__id'];
$_SESSION['login_id'] = $emp_id;
$_SESSION['emp_id'] = $emp_id;
//echo $emp_id;
//exit;
?>
<style>
body
{
width:80%
margin:0 auto;
background-color:#fff;
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
    overflow: none;
	}
.banners
{
margin:30 auto;
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
body{width:inherit}
.demo-table {width: 100%;border-spacing: initial;margin: 20px 0px;word-break: break-word;table-layout: auto;line-height:1.8em;color:#333;}
.demo-table th {background: #81CBFD;padding: 5px;text-align: left;color:#FFF;}
.demo-table td {border-bottom: #f0f0f0 1px solid;background-color: #ffffff;padding: 5px;}
.demo-table td div.feed_title{text-decoration: none;color:#40CD22;font-weight:bold;}
.demo-table ul{margin:0;padding:0;}
.demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
.demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
.btn-likes {float:left; padding: 0px 5px;cursor:pointer;}
.btn-likes input[type="button"]{width:15px;height:13px;border:0;cursor:pointer;}
.like {background:url('like.png')}
.unlike {background:url('unlike.jpg')}
.label-likes {font-size:12px;color:red ;height:20px;float:left;}
.desc {clear:both;color:#999;}
</style>

<script src="js/jquery.min.js" type="text/javascript"></script> 
<script src="js/mediaelement-and-player.min.js"></script>
		
<script src="js/crud.js"></script>
<!-- <script src="js/offisocio.js"></script>  -->
<script src="js/like.js" type="text/javascript"></script>
<script type="text/javascript" >
									$(document).ready(function () {
												$('.commentsub').click(function(e) {
													$('.nocomments').css('display','block');
													$('.commentlistblock').css('display','none');
													
												});
												
												
	 											 $('.selectpdf').click(function(e) {
					 						 			$(".lside .inprogress").css("display","none");
 						 					 			$(".lside .pdffile").removeClass("hide");
											 			$(".lside .pdffile").css("display","block");

	 												});		
	 												
	 												
	 												
									});   
									
									$(function() {
									 while( $('.head div').height() > $('.head').height() ) {
												$('.head div').css('font-size', (parseInt($('.head div').css('font-size')) - 1) + "px" );
											}
									}); 
									$(function() {
									 while( $('.disc div').height() > $('.disc').height() ) {
												$('.disc div').css('font-size', (parseInt($('.disc div').css('font-size')) - 1) + "px" );
											}
									});
								
								</script>
<style type="text/css">
.me-cannotplay
{
display:none;
}
</style>
<script src="js/thickbox/jquery.js" type="text/javascript"></script>
<script src="js/thickbox/thickbox.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="js/thickbox/thickbox.css" media="screen, projection" />
<script type="text/javascript">
jQuery(document).ready(function(){
//	alert("Yessssssssssss");
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

<div class="srl">

<?php
//echo "<pre>";
//print_r($_SESSION);
//exit;
//$_SESSION['login_id'] = 4;
//$_SESSION['emp_id'] = 4;

if($_SESSION['login_id']=='')
{
    header('Location: index.php');   
}

require_once "db.php";

//echo $emp_id;
//exit;

//$sql3 = "SELECT b.role_id FROM role_master b, user c where c.role=b.role_code and c.id=" . $emp_id;
$sql3 = "SELECT b.data as role_id FROM auth_item b, user c where c.role=b.name and c.id=" . $emp_id;
//echo $sql3;
//exit;
$res3 = mysql_query($sql3);
$row3 = mysql_fetch_assoc($res3);
$roleid = $row3['role_id'];
//exit;

//$emp_id = $_SESSION['emp_id'];
//echo $roleid . " <<== " . $dynaurl3;
//exit;

 $sql="select a.empspkID, a.title, b.username as emp_name, c.filepath as filelocation, a.created_date, a.description, concat('" . $dynaurl3 . "web/images/',trim(b.profile_image_url)) as profile from empspeak a, user b, documentsupload c 
 		WHERE c.modid=a.empspkID and a.status='L' and FIND_IN_SET(" . $roleid . ",assigned) group by a.empspkID"; 
//echo $sql;
//exit;
	$resRe = mysql_query($sql);
	//$nremark = mysql_num_rows($resRe);
	$remark = array();
	$x=1;
	while($rowRw= mysql_fetch_assoc($resRe))
	{

	$title=$rowRw['title'];
	$created_date=$rowRw['created_date'];
	$description=$rowRw['description'];
	$profile=$rowRw['profile'];
	$location=$rowRw['location'];
	$file_location = $rowRw['filelocation'];
	$files = explode(".",$file_location); 
	$t_id =$rowRw['empspkID'];
	$sqlsum="select count(likes) as total  from  file_like where t_id='$t_id' and module_name='leaderspeek'";
	//print_r($connsums);
	$sqlsumu="select count(comments) as total from  file_comment where t_id='$t_id' and module_name='leaderspeek'";

//echo $sqlsumu;
//exit;
	$consum=mysql_query($sqlsum);
	$totlikes=mysql_fetch_assoc($consum);
	$totlike = $totlikes['total'];

	$consumu=mysql_query($sqlsumu);
	$totcmts=mysql_fetch_assoc($consumu);
	$totcmt = $totcmts['total'];

//echo $totcmt . " <<== " . $totlike;
//exit;

//echo "<pre>";
//print_r($files);
//print_r($_SESSION);
//exit;
?>

<div class="banners" style="margin:auto;clear:both;">
<br/>
<div class="headerss">
<div class="headerss1">
<div class="image"><img style="width:40px" src="<?=$profile?>" alt="" /></div>
<div class="profine-name"><sapn class="under"><span style="font-weight:bold;"><?=$name?></span></sapn><br/><span style="font-weight:bold;color:#9197a3;font-size:10px;"><?=$created_date?></span></div> 
<div class="right"></div>
</div>
</div>
<div style="clear:both"></div>

<div class="bdy-img">
<div style="color:#000;font-size:1.2em; margin:20px 0px 0px 30px;"><?=$title?></div>
<div class="bdy">
<div class="half prestart">

<?php
	if($files[1]=='jpg' || $files[1]=='jpeg' || $files[1]=='png' || $files[1]=='gif')
	{ 
	?>
		<img style="margin-top:10px; width:80%;" src="../<?=$files[0].'.'.$files[1]?>" />
	<?php
	} 
		elseif($files[1]=='mp4')
	{  
	?>	
		<video width="500" height="350" controls="control" preload="none">		
			<source src="../<?=$files[0].'.'.$files[1]?>" type="video/mp4" />
		</video>

	<?php
	} 
		elseif($files[1]=='pdf')
	{  
	?>	
	<iframe width="500" height="350" src="../<?=$files[0].'.'.$files[1]?>"></iframe>
	<?php
	} 
		elseif($files[1]=='3gp')
	{  
	?>	
			
		<video width="500" height="350" controls="control" preload="none">		
			<source src="../<?=$files[0].'.'.$files[1]?>" type="video/3gp" />
		</video>
	<?php
	} 
		elseif($files[1]=='mp3')
	{  
	?>	
	<!--	<video width="500" height="350" controls="control" preload="none">		
			<source src="../<?=$files[0].'.'.$files[1]?>" type="audio/mp3" />
		</video>
	-->
		<audio controls>
		  <source src="../<?=$files[0].'.'.$files[1]?>" type="audio/mp3">
		</audio>
	<?php
	} 
		elseif($files[1]=='mpg')
	{  
	?>	
			
		<video width="500" height="350" controls="control" preload="none">		
			<source src="../<?=$files[0].'.'.$files[1]?>" type="video/mpg" />
		</video>

	<?php
	} 
		elseif($files[1]=="xls" or $files[1]=="docx")
	{ 
	?>
					
		  <iframe src="https://docs.google.com/viewer?embedded=true&url=" . $dynaurl3 . "<?=$files[0].'.'.$files[1]?>"  width="600" height="600" scrolling="no"></iframe>
					
	<?php } ?>

</div>
</div>


<?php
$query ="SELECT t_id, sum(likes) as total ,likes FROM file_like where t_id='".$t_id."' and likes=1 and module_name='leaderspeek' group by t_id";
$count = mysql_query($query);
$tutorial = mysql_fetch_assoc($count);

$query1 ="SELECT t_id, sum(likes) as total ,likes FROM file_like where t_id='".$t_id."' and emp_id='$emp_id' group by t_id";
$count1 = mysql_query($query1);
$tutorial1 = mysql_fetch_assoc($count1);

/*
echo $query . "</br></br>" . $query1;
echo "<pre>";
print_r($tutorial);
print_r($tutorial1);
exit;
*/


if($tutorial1['likes']==1) {
	$str_like = "unlike";
}
else 
{
	$str_like = "like";
}

?>

<div id="tutorial-<?php echo $t_id; ?>">
<input type="hidden" id="likes-<?php echo $t_id; ?>" value="<?php echo $tutorial["total"]; ?>">
<div class="btn-likes"><input type="button" alt="<?php echo ucwords($str_like); ?>" class="<?php echo $str_like; ?>" onClick="addLikes(<?php echo $t_id; ?>,'<?php echo $str_like; ?>','leaderspeek')" /></div>
<div class="label-likes"><?php if(!empty($tutorial["total"])) { echo "<a id='url' href='index.php?r=site/popup_likesl&parameter=".$t_id."&keepThis=true&amp;TB_iframe=true&amp;height=400&amp;width=750' title='' style='text-decoration:none;color:#003366;' class='thickbox'>".$tutorial["total"] . " Like(s)&#160;&#160;</a>"; } ?></div>
</div>

</span><sapn class="under"><img src="nexusae0_fbmessenger2.png" alt="" /></span>
<?php
//echo $consumsum;
//exit;
if(intval($totcmt)>1) {
   echo "<a id='url' href='../index.php?r=site/popup_leader&parameter=". $t_id ."&keepThis=true&amp; TB_iframe=true&amp;height=400&amp;width=750' title='' style='text-decoration:none;color:#003366;vertical-align:4px;font-size:12px;' class='thickbox'>" . $totcmt . "-More comments</a>";
}
?>

</div>

<div class="comment">
<!--<div class="para2"><img style="width:30px" src="Facebook_like_thumb.png" alt="" /> Vicgnu G <span style="font-weight:bold;color:#9197a3;">likes this.</span></div>-->
<div class="para22">&#160;&#160;&#160;
 
<div class="form_style">
<div id="comment-list-box_<?=$t_id?>" >
<?php
    $sqlCom="select 
    a.cmid,
    a.t_id,
    a.comments,
    a.created_date,
    a.modified_date,
    concat(ifnull(b.first_name, ''),
            '',
            ifnull(b.last_name, '')) as EmpName,
    a.emp_id,
    concat('" . $dynaurl3 . "web/images/',
            trim(b.profile_image_url)) as profile_com
from
    file_comment a,
    user b
where
    a.emp_id = b.id
        and a.module_name = 'leaderspeek'
        and a.t_id ='".$t_id."' ORDER BY a.cmid DESC  limit 1"; 

//echo $sqlCom;
//print_r($comments);
//exit;

$comments1= mysql_query($sqlCom);

while($comments = mysql_fetch_assoc($comments1)) 
{
	
?>
	<div class="cmd-part" id="cc_<?=$t_id?>" >
	<div class="image"><img style="width:40px; margin-top:0px;" src="<?=$comments["profile_com"]?>" alt="" /></div>
	<div class="prf-name"><span style="font-weight:bold;font-size:15px;color:#003366;"><?=$comments["EmpName"]?>:</span> 
	<span class="cmd" id="message_<?php echo $comments['cmid'];?>"><?php echo $comments["comments"]; ?></span>
	<p style="font-weight:bold;color:#9197a3;font-size:10px;margin-top:5px;">
	<?php if($comments['modified_date'] != "0000-00-00 00:00:00")
		{ 
			echo $comments['modified_date'];
		} else { 
			echo $comments['created_date'];
		}
	?>
	</p></div>

	<?php
	//echo " UUUUUUUU " . $emp_id . "</br>";
	//print_r($comments);
	if($emp_id==$comments["emp_id"])
	{
	?>
	<div style="float:right;" id='ed'>
	<button class="btnEditAction" name="edit" onClick="showEditBox(<?php echo $comments["cmid"]; ?>)">Edit</button>
	<button class="btnDeleteAction" name="delete" onClick="callCrudAction('delete',<?php echo $comments["cmid"]; ?>)">Delete</button>
	</div>
	<?php
	}
	?>
	</div>


	<div class="message-content"><?php echo $comments["comments"]; ?></div>

<?php } ?>

<div stle="width:100%;margin:0px 0px 60px 0px; clear:both;"  id="frmAdd">
<div style="float:left;"><textarea name="txtmessage<?=$x;?>" id="txtmessage<?=$x?>" cols="65" rows="2"></textarea></div>
<div style="float:right"><button  class="btn" id="btnAddAction" name="submit" onClick="callCrudAction('add','','<?=$t_id?>','<?=$x?>','leaderspeek')">Add</button></div><br/><br/><br/><br/><br/><br/><br/>
</div>

</div></div></div></div></div></div>

<?php 
$x++;
} 
?>
</div></div>
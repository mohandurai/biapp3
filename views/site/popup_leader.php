<script src="./sms/js/jquery-1.2.6.min.js" type="text/javascript"></script>
<script src="./sms/js/jquery.min.js" type="text/javascript"></script>
<script src="./sms/js/crud.js" type="text/javascript"></script>

<style>
body{width:100%;}
</style>

<?php
require_once "./sms/db.php";
//echo $server1 . " <<=== " . $user1 . " <<=== " . $pass1 . " <<=== " . $dbname1;
//exit;

//$_SESSION['emp_id'] = 4;
$emp_id=$_SESSION['emp_id'];
//echo $emp_id;
//exit;
$sqlCom="select cmid, t_id, b.id, a.comments,a.created_date,a.modified_date,concat(ifnull(b.first_name,'')) as EmpName,b.id,concat('http://www.tuneem.com/tuneem/web/images/', trim(b.profile_image_url)) as profile_com from file_comment a, user b where a.emp_id=b.id and module_name='leaderspeek' and t_id='".$_REQUEST['parameter']."' ORDER BY  a.cmid DESC"; 
//echo $sqlCom;
//exit;
$qry = mysql_query($sqlCom);
//echo "<pre>";
//print_r($qry); 
//exit;
?>

<div class="form_style">
<div id="comment-list-box" class="cmd-part">

<?php
while($row = mysql_fetch_assoc($qry))
{
?>
<div class="cmd-part" id="cc_<?php echo $row['t_id']; ?>">
<div class="image"><img class="cmd-part-img" style="" src="<?php echo $row['profile_com']; ?>" width="50px" height="40px" alt=""/></div>
<div class="prf-name">
	<span class="prf-name-span"> <?php echo $row["EmpName"]; ?>: </span>
<span class="cmd" id="message_<?php echo $row['cmid']; ?>">
<?php echo $row["comments"]; ?>
</span>
<p class="commentspar">

<?php 
if($row['modified_date']!='0000-00-00 00:00:00')
{ echo $row['modified_date']; } else { echo $row['created_date']; }
?> 

</p></div>

<?php
if($emp_id==$row["id"]) {
?>
<div style="float:right;" id="ed">
<button class="btnEditAction" name="edit" onClick="showEditBox(<?php echo $row['cmid']; ?>)">Edit</button>
<button class="btnDeleteAction" name="delete" onClick="callCrudAction('delete',<?php echo $row['cmid']; ?>)">Delete 
</button>
</div>
<?php } ?>
</div>

<?php 
} 
$param = $_REQUEST["parameter"];
//echo $param;
?>
</div>

<div id="frmAdd">
<textarea name="txtmessage" id="txtmessage1" cols="67" rows="5"></textarea>
  <p>
	<button id="btnAddAction" name="submit" onClick="callCrudAction('add','','<?php echo $param; ?>','1','leaderspeek')">Add
	</button>
  </p>
</div>
</div>
<?php 
exit;
?>
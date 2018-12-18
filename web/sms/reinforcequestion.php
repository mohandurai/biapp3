<!--<style type="text/css">
body
{
font-family:"Audi_Normal",Sans-Serif !important;
font-size:10px;
}
</style>-->
<?
session_start();
if($_SESSION['login_id']=='')
{
    header('Location: index.php');   
}
require_once "db.php";

date_default_timezone_set('GMT');
$temp= strtotime("+5 hours 30 minutes"); 
$date = date("Y-m-d H:i:s",$temp);
$com_date = date("Y-m-d");
$emp_id = $_SESSION['emp_id'];


$all_sql = "select b.re_id,b.title,b.description,b.tag,b.schedule_date,b.content_type,b.location,
b.file_transfer_mode,b.req_id as question_id,b.question,b.num_answers,b.option_A,b.option_B,b.option_C,b.option_D,
b.option_E,b.marks,b.correct_answer,b.maximum_att,b.maxincrement

from

(select a.re_id,a.tag from reinforcement_master a,reinforcement_question_score b
where a.re_id=b.re_id and a.file_transfer_mode='GPRS' and a.re_id='".$_REQUEST['classid']."' and b.emp_id='".$_SESSION['emp_id']."' and b.maximum_att=0
and b.re_id not in (select re_id from reinforcement_question_score
where emp_id='".$_SESSION['emp_id']."' and maximum_att>0 group by re_id,emp_id) group by a.re_id) as a

inner join

(select a.re_id,a.title,a.description,a.tag,a.schedule_date,a.content_type,if(LOWER(SUBSTRING_INDEX(a.file_location,'.',-1))='zip',
concat('http://biweb.com/seed/upload_file/',a.re_id,'_',SUBSTRING_INDEX(a.file_location,'.',1)),
concat('http://biweb.com/seed/upload_file/',a.re_id,'_',a.file_location)) as location,
a.file_transfer_mode,b.req_id,b.question,b.num_answers,b.option_A,b.option_B,b.option_C,b.option_D,
b.option_E,b.marks,b.correct_answer,b.maximum_att,c.maximum_att as maxincrement
from reinforcement_master a,reinforcement_question b,reinforcement_question_score c
where a.re_id=b.re_id and b.req_id=c.req_id and c.emp_id='".$_SESSION['emp_id']."' and
a.re_id not in (select re_id from reinforcement_question_score
where emp_id='".$_SESSION['emp_id']."' and maximum_att>0 group by re_id,emp_id)
and c.maximum_att=0 and a.file_transfer_mode='GPRS' group by a.re_id,b.req_id,c.emp_id) as b

on a.re_id=b.re_id";

$all_res = mysql_query($all_sql);
$all_nrw = mysql_num_rows($all_res);

while($all_row = mysql_fetch_assoc($all_res))
{
if($all_row['num_answers']==2)
{
$val2[] = '{ "q": "'.$all_row['question'].'", "id": "'.$all_row['question_id'].'" , "num_ans": "'.$all_row['num_answers'].'" ,"a":[{"option": "'.$all_row['option_A'].'"},{"option": "'.$all_row['option_B'].'"}],"a2":[{"alphaoption": "1"},{"alphaoption": "2"}]}';
}
if($all_row['num_answers']==3)
{
$val2[] = '{ "q": "'.$all_row['question'].'", "id": "'.$all_row['question_id'].'" , "num_ans": "'.$all_row['num_answers'].'" , "a":[{"option": "'.$all_row['option_A'].'"},{"option": "'.$all_row['option_B'].'"},{"option": "'.$all_row['option_C'].'"}],"a2":[{"alphaoption": "1"},{"alphaoption": "2"},{"alphaoption": "3"}]}';
}
if($all_row['num_answers']==4)
{
$val2[] = '{ "q": "'.$all_row['question'].'", "id": "'.$all_row['question_id'].'" , "num_ans": "'.$all_row['num_answers'].'" , "a":[{"option": "'.$all_row['option_A'].'"},{"option": "'.$all_row['option_B'].'"},{"option": "'.$all_row['option_C'].'"},{"option": "'.$all_row['option_D'].'"}],"a2":[{"alphaoption": "1"},{"alphaoption": "2"},{"alphaoption": "3"},{"alphaoption": "4"}]}';
}
if($all_row['num_answers']==5)
{
$val2[] = '{ "q": "'.$all_row['question'].'", "id": "'.$all_row['question_id'].'" , "num_ans": "'.$all_row['num_answers'].'" , "a":[{"option": "'.$all_row['option_A'].'"},{"option": "'.$all_row['option_B'].'"},{"option": "'.$all_row['option_C'].'"},{"option": "'.$all_row['option_D'].'"},{"option": "'.$all_row['option_E'].'"}],"a2":[{"alphaoption": "1"},{"alphaoption": "2"},{"alphaoption": "3"},{"alphaoption": "4"},{"alphaoption": "5"}]}';
}
}
if($all_nrw!=0)
{
$val = implode(",",$val2);
}

/*$all_sql2 = "select a.class_id,b.module_id,b.module_name,c.question_id,c.question,c.option_A,c.option_B, 
c.option_C,c.option_D,c.option_E from training_class a,module_master b,question_master c where '$date'
between concat(a.start_date,' ',STR_TO_DATE(UPPER(a.start_time), '%h:%i %p')) and 
concat(a.end_date,' ',STR_TO_DATE(UPPER(a.end_time), '%h:%i %p')) and a.module_id=b.module_id
and b.module_id=c.module_id group by a.module_id";*/

$all_sql2 = "select b.re_id,b.title,b.description,b.tag,b.schedule_date,b.content_type,b.location,
b.file_transfer_mode,b.req_id as question_id,b.question,b.num_answers,b.option_A,b.option_B,b.option_C,b.option_D,
b.option_E,b.marks,b.correct_answer,b.maximum_att,b.maxincrement

from

(select a.re_id,a.tag from reinforcement_master a,reinforcement_question_score b
where a.re_id=b.re_id and a.file_transfer_mode='GPRS' and a.re_id='".$_REQUEST['classid']."' and b.emp_id='".$_SESSION['emp_id']."' and b.maximum_att=0
and b.re_id not in (select re_id from reinforcement_question_score
where emp_id='".$_SESSION['emp_id']."' and maximum_att>0 group by re_id,emp_id) group by a.re_id) as a

inner join

(select a.re_id,a.title,a.description,a.tag,a.schedule_date,a.content_type,if(LOWER(SUBSTRING_INDEX(a.file_location,'.',-1))='zip',
concat('http://biweb.com/seed/upload_file/',a.re_id,'_',SUBSTRING_INDEX(a.file_location,'.',1)),
concat('http://biweb.com/seed/upload_file/',a.re_id,'_',a.file_location)) as location,
a.file_transfer_mode,b.req_id,b.question,b.num_answers,b.option_A,b.option_B,b.option_C,b.option_D,
b.option_E,b.marks,b.correct_answer,b.maximum_att,c.maximum_att as maxincrement
from reinforcement_master a,reinforcement_question b,reinforcement_question_score c
where a.re_id=b.re_id and b.req_id=c.req_id and c.emp_id='".$_SESSION['emp_id']."' and
a.re_id not in (select re_id from reinforcement_question_score
where emp_id='".$_SESSION['emp_id']."' and maximum_att>0 group by re_id,emp_id)
and c.maximum_att=0 and a.file_transfer_mode='GPRS' group by a.re_id,b.req_id,c.emp_id) as b

on a.re_id=b.re_id";

$all_res2 = mysql_query($all_sql2);
$all_nrw2 = mysql_num_rows($all_res2);

while($all_row2 = mysql_fetch_assoc($all_res2))
{
$module = $all_row2['title'];
}
if($all_nrw2!=0)
{
$modulename = $module;
}
?>

        <meta content="text/html; charset=utf-8" http-equiv="content-type">
        <link href="sms/css/reset.css" media="screen" rel="stylesheet" type="text/css">
        <!-- <link href="sms/css/slickQuiz.css" media="screen" rel="stylesheet" type="text/css">-->
        <link href="sms/css/master.css" media="screen" rel="stylesheet" type="text/css">
		<link href="css/core_style.css" media="screen" rel="stylesheet" type="text/css">


<script type="text/javascript">

function backfun()
{
window.location = 'index.php?r=site/reinforceonline';
}
</script>
<? if($all_nrw2!=0)
{ ?>
    
<form name="quiz" id="quiz" action="" method="post">
<input type="hidden" name="class_ids" id="class_ids" value="<?=$_REQUEST['classid']?>" />
<div id="slickQuiz">
        <h1 class="quizName"><!-- where the quiz name goes --></h1>
        <div class="quizArea">
            <div class="quizHeader">
                <!-- where the quiz main copy goes -->

                <!--<a class="button startQuiz" href="#">Get Started!</a>-->
            </div>

            <!-- where the quiz gets built -->
        </div>

        <div class="quizResults" style="display:none;">
            <h3 class="quizScore">You Scored: <span><!-- where the quiz score goes --></span></h3>

            <h3 class="quizLevel"><strong>Ranking:</strong> <span><!-- where the quiz ranking level goes --></span></h3>

            <div class="quizResultsCopy">
                <!-- where the quiz result copy goes -->
            </div>
        </div>
</div>
</form>
        <script src="sms/js/jquery.js"></script>
        <!--<script src="js/slickQuiz-config.js"></script>-->
		<? echo '<script type="text/javascript">
		var quizJSON = {
        "info": {
                  "name":    "'.$modulename.'"
		         },
        "questions": ['.$val.']
        };
		</script>';?>
		
        <script src="sms/js/slickQuiz.js"></script>
        <script src="sms/js/master.js"></script>
		
<? } else{?>
<div style="font-weight:bold; color:#000000; margin-top:30px;">No Questions Available!!!
<br /><br />
<input type="button" class="button pink" name="back" id="back" value="Back" onclick="backfun();" />
</div>

<? }?>
<script>
document.getElementById("dvLoading").style.display = 'none';
</script>

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


/*if($_REQUEST['submit']=="Submit")
{
	$z=0;
	$quiz = $_REQUEST['question_id'];
	while(count($quiz)>$z)
	{
	$id = 'question-'.$quiz[$z];
	$question_id = $quiz[$z];
	$ansarr =  $_REQUEST[$id];
	//print_r($ansarr);
	if(count($ansarr)==0)
	{
	$ansarr = array(0);
	}
	echo implode(',',$ansarr);
	echo "<br>";
	//echo "select question_id,correct_answer,num_correct_ans,num_answers from question_master where question_id='".$quiz[$z]."'";
	$z++;
	}
}
*/
date_default_timezone_set('GMT');
$temp= strtotime("+5 hours 30 minutes"); 
$date = date("Y-m-d H:i:s",$temp);
$com_date = date("Y-m-d");
$emp_id = $_SESSION['emp_id'];
/*$all_sql = "select a.class_id,b.module_id,b.module_name,c.question_id,c.question,c.option_A,c.option_B, 
c.option_C,c.option_D,c.option_E,c.num_answers from training_class a,module_master b,question_master c where '$date'
between concat(a.start_date,' ',STR_TO_DATE(UPPER(a.start_time), '%h:%i %p')) and 
concat(a.end_date,' ',STR_TO_DATE(UPPER(a.end_time), '%h:%i %p')) and a.module_id=b.module_id
and b.module_id=c.module_id";*/

$all_sql = "SELECT a.ojt_id,a.ojt_name,c.question_id, c.question FROM ojt_training a,ojt_module_master b,ojt_question_master c
where a.module_id=b.module_id and b.module_id=c.module_id and a.module_id=c.module_id and a.ojt_id='".$_REQUEST['classid']."'";


$all_res = mysql_query($all_sql);
$all_nrw = mysql_num_rows($all_res);

while($all_row = mysql_fetch_assoc($all_res))
{
/*if($all_row['num_answers']==2)
{
$val2[] = '{ "q": "'.$all_row['question'].'", "id": "'.$all_row['question_id'].'" , "num_ans": "'.$all_row['num_answers'].'" ,"a":[{"option": "'.$all_row['option_A'].'"},{"option": "'.$all_row['option_B'].'"}],"a2":[{"alphaoption": "A"},{"alphaoption": "B"}]}';
}
if($all_row['num_answers']==3)
{
$val2[] = '{ "q": "'.$all_row['question'].'", "id": "'.$all_row['question_id'].'" , "num_ans": "'.$all_row['num_answers'].'" , "a":[{"option": "'.$all_row['option_A'].'"},{"option": "'.$all_row['option_B'].'"},{"option": "'.$all_row['option_C'].'"}],"a2":[{"alphaoption": "A"},{"alphaoption": "B"},{"alphaoption": "C"}]}';
}
if($all_row['num_answers']==4)
{
$val2[] = '{ "q": "'.$all_row['question'].'", "id": "'.$all_row['question_id'].'" , "num_ans": "'.$all_row['num_answers'].'" , "a":[{"option": "'.$all_row['option_A'].'"},{"option": "'.$all_row['option_B'].'"},{"option": "'.$all_row['option_C'].'"},{"option": "'.$all_row['option_D'].'"}],"a2":[{"alphaoption": "A"},{"alphaoption": "B"},{"alphaoption": "C"},{"alphaoption": "D"}]}';
}
if($all_row['num_answers']==5)
{
$val2[] = '{ "q": "'.$all_row['question'].'", "id": "'.$all_row['question_id'].'" , "num_ans": "'.$all_row['num_answers'].'" , "a":[{"option": "'.$all_row['option_A'].'"},{"option": "'.$all_row['option_B'].'"},{"option": "'.$all_row['option_C'].'"},{"option": "'.$all_row['option_D'].'"},{"option": "'.$all_row['option_E'].'"}],"a2":[{"alphaoption": "A"},{"alphaoption": "B"},{"alphaoption": "C"},{"alphaoption": "D"},{"alphaoption": "E"}]}';
}*/

$val2[] = '{ "q": "'.$all_row['question'].'", "id": "'.$all_row['question_id'].'" , "num_ans": "5" , "a":[{"option": "Very Good"},{"option": "Good"},{"option": "Moderate"},{"option": "Poor"},{"option": "Very Poor"}],"a2":[{"alphaoption": "Very Good"},{"alphaoption": "Good"},{"alphaoption": "Moderate"},{"alphaoption": "Poor"},{"alphaoption": "Very Poor"}]}';

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

$all_sql2 = "SELECT a.ojt_id,a.ojt_name,c.question_id, c.question FROM ojt_training a,ojt_module_master b,ojt_question_master c
where a.module_id=b.module_id and b.module_id=c.module_id and a.module_id=c.module_id and a.ojt_id='".$_REQUEST['classid']."' group by a.ojt_id";

$all_res2 = mysql_query($all_sql2);
$all_nrw2 = mysql_num_rows($all_res2);

while($all_row2 = mysql_fetch_assoc($all_res2))
{
$module[] = $all_row2['ojt_name'];
}
if($all_nrw2!=0)
{
$modulename = implode(",",$module);
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
window.location = 'index.php?r=site/ojtonline';
}
</script>
<? if($all_nrw2!=0)
{ ?>
    
<form name="quiz" id="quiz" action="" method="post">
<input type="hidden" name="class_ids" id="class_ids" value="<?=$_REQUEST['classid']?>" />
<input type="hidden" name="participant" id="participant" value="<?=$_REQUEST['participant']?>" />
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
		
        <script src="sms/js/ojtslickQuiz.js"></script>
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

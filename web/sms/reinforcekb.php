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


$all_sql2 = "select b.re_id,b.title,b.description,b.tag,b.schedule_date,b.content_type,b.location,b.file_location,
b.file_transfer_mode,b.req_id as question_id,b.question,b.num_answers,b.option_A,b.option_B,b.option_C,b.option_D,
b.option_E,b.marks,b.correct_answer,b.maximum_att,b.maxincrement

from

(select a.re_id,a.tag from reinforcement_master a,reinforcement_question_score b
where a.re_id=b.re_id and a.file_transfer_mode='GPRS' and a.re_id='".$_REQUEST['classid']."' and b.emp_id='".$_SESSION['emp_id']."' and b.maximum_att=0
and b.re_id not in (select re_id from reinforcement_question_score
where emp_id='".$_SESSION['emp_id']."' and maximum_att>0 group by re_id,emp_id) group by a.re_id) as a

inner join

(select a.re_id,a.title,a.description,a.tag,a.schedule_date,a.content_type,if(LOWER(SUBSTRING_INDEX(a.file_location,'.',-1))='zip',
concat('http://rewire.in/tuneemnew/upload_file/',a.re_id,'_',SUBSTRING_INDEX(a.file_location,'.',1)),
concat('http://rewire.in/tuneemnew/upload_file/',a.re_id,'_',a.file_location)) as location,a.file_location,
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
$re_id = $all_row2['re_id'];
$title = $all_row2['title'];
$content_type = $all_row2['content_type'];
$file_location = $all_row2['re_id'].'_'.$all_row2['file_location'];
}
?>
		<link href="css/core_style.css" media="screen" rel="stylesheet" type="text/css">
		<script src="sms/js/jquery.min.js" type="text/javascript"></script> 
	   <script src="sms/js/mediaelement-and-player.min.js"></script>
	    <link  href="sms/css/mediaelementplayer.min.css" rel="Stylesheet" />
	    <link  href="sms/css/mejs-skins.css" rel="Stylesheet" />

<style type="text/css">
.me-cannotplay
{
display:none;
}
</style>
	   <script type="text/javascript" >
									$(document).ready(function () {
												$('.commentsub').click(function(e) {
													$('.nocomments').css('display','block');
													$('.commentlistblock').css('display','none');
													
												});
												
												
												  $('.ready').click(function(e) {
					 						 			/* $(".lside .prestart").css("display","none");
											 			$(".lside .inprogress").css("display","block");
 						 					 			$(".lside .inprogress").removeClass("hide"); */
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
<script type="text/javascript">

function backfun()
{
window.location = 'index.php?r=site/reinforceonline';
}
jQuery(document).ready(function($) {

// declare object for video
var player = new MediaElementPlayer('#player1', {
features: ['playpause','loop','current','progress','duration','volume']
});

});
</script>
<input type="hidden" id="urlid" name="urlid" value="<?=$file_location?>" >	
<? if($all_nrw2!=0)
{ ?>
 <h1 class="quizName"><?=$title;?></h1>
 <br />
 <br />
<!-- <?=$content_type?>
 <?=$file_location?>-->
      <!-- <video id="player1" width="640" height="360" controls="control" preload="none">		
			<source src="upload_file/<?=$file_location?>" type="video/mp4" />
		</video>-->
<? if($content_type=='Image')
{ ?>
<img src="upload_file/<?=$file_location?>" height="400" width="500" />
<? }?>

<? if($content_type=='Flash')
{ ?>
<object width="600" height="600" data="upload_file/<?=$file_location?>">
</object>
<? }?>

<? if($content_type=='Url')
{ 
$files = explode(".",$file_location); 
?>
<iframe src="upload_file/<?=$files[0]?>/" width="600" height="600" scrolling="no">
</iframe>
<? }?>

<? if($content_type=='Video' || $content_type=='Audio')
{ ?>	
		

		<video  width="640" height="360" controls="control" preload="none">		
			<source src="upload_file/<?=$file_location?>" type="video/mp4" />
		</video>

		
	

<? } ?>
<?  if($content_type=="PDF")
				 { ?>
					
					
					
					
					<div class="half pdffile jai" >
										
						<div style="margin-left:2%;">
						  <button id="prev" style="background: rosybrown;color:#fff;">Previous</button>
						  <button id="next" style="background: rosybrown;color:#fff;">Next</button>
									  &nbsp; &nbsp;
									<span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
											</div>
											<div class="canvas">
											  <canvas id="the-canvas" style="border:1px solid black"></canvas>
											</div>
					</div>	

					
				<? } ?>
<?  if($content_type=="Excel" or $content_type=="Document"){ ?>
				

				  <iframe src="https://docs.google.com/viewer?embedded=true&url=http://tuneem.com/seed/upload_file/<?=$file_location?>"  width="600" height="600" scrolling="no"></iframe>
				
				<? }?>

	<input type="hidden" id="urlid" name="urlid" value="<? echo $file_location;?>" >	
 <br />
 <br />
<input type="button" class="button pink" name="quiz" id="quiz" value="Go to Quiz" onclick="gotoquiz(<?=$re_id?>);" />
<? } else{?>
<div style="font-weight:bold; color:#000000; margin-top:30px;">No Kb Available!!!
<br /><br />
<input type="button" class="button pink" name="back" id="back" value="Back" onclick="backfun();" />
</div>

<? }?>
<script>
document.getElementById("dvLoading").style.display = 'none';
</script>


 <!-- <script src="/tascdemo/tascquiznew/js/mediaelement-and-player.min.js"></script>-->
<script src="http://mozilla.github.io/pdf.js/build/pdf.js"></script>

<!--<script src='sms/js/pdf.js'></script>-->
<script id="script">


  //

  // If absolute URL from the remote server is provided, configure the CORS
  // header on that server.
  //
 //var urlid=document.getElementById("urlid").value;

  //var url = 'tuneem.com/seed/upload_file/'+urlid;
//alert(url);
var url='http://tuneem.com/seed/upload_file/200_FiniteElementAnalysis.pdf';


  //
  // Disable workers to avoid yet another cross-origin issue (workers need
  // the URL of the script to be loaded, and dynamically loading a cross-origin
  // script does not work).
  //
  // PDFJS.disableWorker = true;

  //
  // In cases when the pdf.worker.js is located at the different folder than the
  // pdf.js's one, or the pdf.js is executed via eval(), the workerSrc property
  // shall be specified.
  //
  // PDFJS.workerSrc = '../../build/pdf.worker.js';

  var pdfDoc = null,
      pageNum = 1,
      pageRendering = false,
      pageNumPending = null,
      scale = 0.8,
      canvas = document.getElementById('the-canvas'),
      ctx = canvas.getContext('2d');

  /**
   * Get page info from document, resize canvas accordingly, and render page.
   * @param num Page number.
   */
  function renderPage(num) {
    pageRendering = true;
    // Using promise to fetch the page
    pdfDoc.getPage(num).then(function(page) {
      var viewport = page.getViewport(scale);
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      // Render PDF page into canvas context
      var renderContext = {
        canvasContext: ctx,
        viewport: viewport
      };
      var renderTask = page.render(renderContext);

      // Wait for rendering to finish
      renderTask.promise.then(function () {
        pageRendering = false;
        if (pageNumPending !== null) {
          // New page rendering is pending
          renderPage(pageNumPending);
          pageNumPending = null;
        }
      });
    });

    // Update page counters
    document.getElementById('page_num').textContent = pageNum;
  }

  /**
   * If another page rendering in progress, waits until the rendering is
   * finised. Otherwise, executes rendering immediately.
   */
  function queueRenderPage(num) {
    if (pageRendering) {
      pageNumPending = num;
    } else {
      renderPage(num);
    }
  }

  /**
   * Displays previous page.
   */
  function onPrevPage() {
    if (pageNum <= 1) {
      return;
    }
    pageNum--;
    queueRenderPage(pageNum);
  }
  document.getElementById('prev').addEventListener('click', onPrevPage);

  /**
   * Displays next page.
   */
  function onNextPage() {
    if (pageNum >= pdfDoc.numPages) {
      return;
    }
    pageNum++;
    queueRenderPage(pageNum);
  }
  document.getElementById('next').addEventListener('click', onNextPage);

  /**
   * Asynchronously downloads PDF.
   */
</script>
  <script>
  
  PDFJS.getDocument(url).then(function (pdfDoc_) {
    pdfDoc = pdfDoc_;
    document.getElementById('page_count').textContent = pdfDoc.numPages;

    // Initial/first page rendering
    renderPage(pageNum);
  });
</script>

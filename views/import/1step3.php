<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
//use yii\web\UploadedFile;
use wbraganca\dynamicform\DynamicFormWidget;
//use app\models\Attachments;
use yii\helpers\ArrayHelper;
//use app\models\FileTransfer;
use kartik\select2\Select2;
use app\models\Modules;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\CityMaster */
/* @var $form yii\widgets\ActiveForm */

?>
<script type="text/javascript">
function automap() {
    $('td.header').each( function() {
        var num = $(this).attr('num');
        $('#select_' + num).val( $(this).html().toLowerCase() );
    } );
}
function get_download(val)
{
	//alert(val);
	if('<?=$_SESSION['message']['success']?>' > 0 && val=='success')
	{
		//window.location = "index.php?r=import/step5&file="+'<?=$_SESSION['message']['success_path']?>';
		window.open("index.php?r=import/step5&file="+'<?=$_SESSION['message']['success_path']?>','_blank');
	}
	if('<?=$_SESSION['message']['error']?>' > 0 && val=='error')
	{
		//window.location = "index.php?r=import/step5&file="+'<?=$_SESSION['message']['error_path']?>';
		window.open("index.php?r=import/step5&file="+'<?=$_SESSION['message']['error_path']?>','_blank');
	}
	if(val=='total')
	{
		//window.location = "index.php?r=import/step5&file="+'<?=$_SESSION['message']['actual_path']?>';
		window.open("index.php?r=import/step5&file="+'<?=$_SESSION['message']['actual_path']?>','_blank');
	}
}
</script>
<style>
.content
{
padding: 50px 15px !important;
}
.col-lg-3
{
margin-left: 30px;
width: 30% !important;
}
.progress {
    height: 30px;
    font-size: 30px;
	vertical-align:middle;
}
.progress-bar
{
	vertical-align:middle !important;
	 font-size: 17px;
	padding-top: 5px;
	color: #000000;
}
</style>
<div class="import-form">

		<?php if(Yii::$app->session->hasFlash('csv_error')): ?>
		<div class="alert alert-danger" role="alert">
			<?= Yii::$app->session->getFlash('csv_error') ?>
		</div>
		<?php endif; ?>

	<?php $form = ActiveForm::begin(['id' => 'dynamic-form','options'=>['enctype'=>'multipart/form-data','class' => 'form-vertical']]); ?>
	<p class="headblockdetails">Import CSV :</p>
	<div class="fieldsblock">	            
	<div class="row col-lg-12">
	<div class="col-lg-12"> 
	<div style="text-align: center"><small>
	[Step 3 out of 3] - Final import of data
	</small></div><hr/>
	<? //echo $_SESSION['message']['total'].'<=====>'.$_SESSION['message']['success'].'<========>'.$_SESSION['message']['error'] ?>
	<br/>
	<div id="upload-progress">
	<?= yii\bootstrap\Progress::widget(['percent' => 0, 'label' => '0%','barOptions' => ['class'=>'progress-bar-success progress-bar-striped active']]) ?>
	</div>
	<div id="after-upload" style="display:none;">
		<!-- Small boxes (Stat box) -->
		<div class="row" align="center">

		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-green">
			<div class="inner">
			  <h3 id="upload-total">0</h3>
			  <p>Total Records</p>
			</div>
			<div class="icon">
			  <i class="fa fa-files-o"></i>
			</div>
			<a href="#" onclick="get_download('total')" class="small-box-footer">
			  click here to download <i class="fa fa-arrow-circle-right"></i>
			</a>
		  </div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-yellow">
			<div class="inner">
			  <h3 id="upload-success">0</h3>
			  <p>Uploaded Records</p>
			</div>
			<div class="icon">
			 <i class="fa fa-thumbs-o-up"></i>
			</div>
			<a href="#" onclick="get_download('success')" class="small-box-footer">
			  click here to download <i class="fa fa-arrow-circle-right"></i>
			</a>
		  </div>
		</div><!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-red">
			<div class="inner">
			  <h3 id="upload-error">0</h3>
			  <p>Error Records</p>
			</div>
			<div class="icon">
			 <i class="fa fa-thumbs-o-down"></i>
			</div>
			<a href="#" onclick="get_download('error')" class="small-box-footer">
			  click here to download <i class="fa fa-arrow-circle-right"></i>
			</a>
		  </div>
		</div><!-- ./col -->
		</div><!-- /.row -->
	</div>		
	</div>
	</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>

<?php if(empty($_SESSION['message'])){?>
<script type="text/javascript">
var csrf = '<?=Yii::$app->request->getCsrfToken()?>';
$.ajax({
xhr: function()
{
var xhr = new XMLHttpRequest();			
//Upload progress
xhr.upload.addEventListener("progress", function(evt) {
if (evt.lengthComputable) {
var percentComplete = Math.round(evt.loaded * 100 / evt.total);
//Do something with upload progress
//console.log(percentComplete + '%');
//alert(percentComplete);
$(".progress-bar").width(percentComplete + '%');
$(".progress-bar").html('');
$(".progress-bar").html('<div style="color:#000000;">' + percentComplete +' % Complete</div>');
}
}, false);
return xhr;
},
url: "index.php?r=import/step4",
dataType: 'JSON',
/* cache: false,
contentType: false,
processData: false, */
type: 'post',
data: {_csrf : csrf},
success: function(attributes) {				
	if(attributes.success=="true")
	{
		/* $('#upload-progress').hide();
		$('#after-upload').show();
		$('#upload-total').html('<?=$_SESSION['message']['total']?>');
		$('#upload-success').html('<?=$_SESSION['message']['success']?>');
		$('#upload-error').html('<?=$_SESSION['message']['error']?>'); */
		window.location = "index.php?r=import/step3";
	}
	else
	{
		alert(attributes.message);
		window.location = "index.php?r=import/step1";
	}	
}
});
</script>
<?php } else {?>
<script>
$('#upload-progress').hide();
$('#after-upload').show();
$('#upload-total').html('<?=$_SESSION['message']['total']?>');
$('#upload-success').html('<?=$_SESSION['message']['success']?>');
$('#upload-error').html('<?=$_SESSION['message']['error']?>');
</script>
<? }?>


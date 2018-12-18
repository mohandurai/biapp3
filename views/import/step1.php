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
<script>
function get_hide()
{
	//alert("Testing");
	$(".file-preview").remove();
}
</script>
<script type="text/javascript">
function get_template(val)
{
var modelname = $("#import-model option:selected").text();
	if(val!="")
	{
		var csrf = '<?=Yii::$app->request->getCsrfToken()?>';
		$.ajax({
		url: "index.php?r=import/step6",
		dataType: 'JSON',
		type: 'post',
		data: {_csrf : csrf,model:val},
		success: function(attributes) {				
			if(attributes.success=="true")
			{
				$('#template').show();
				$('#selcted_model').html(modelname+' Template');
				$('#download-div').html('<a href="index.php?r=import/step7&file='+attributes.filelocation+'" target="_blank" style="color:green;">Click Here To Download '+attributes.file+'</a>');
			}
			else
			{
				alert(attributes.message);
			}	
		}
		});
	}
}
</script>
<style>
.content
{
padding: 50px 15px !important;
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
	[Step 1 out of 3] - Upload CSV file
	</small></div><hr/>
	
	<?php 
	$dir = "../models";
	$dh  = opendir($dir);
	$files = array();	
	while (false !== ($filename = readdir($dh))) {		
		$file = $filename;		
		$php_extension =  explode(".", $file);
		$php_extension = end($php_extension);
		if (strpos(strtolower($file),'search') !== false || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', strtolower($file)) || preg_match('/[0-9]/', $file))
		{
		}
		else
		{
			if(strtolower($php_extension)=="php")
			{
				$modelname = str_replace(".php","",$filename);
				$files[$modelname] = $modelname;
			}
		}
	}

	ksort($files);
	//removing unwanted models
	$removemodels = array('Auth', 'AuthItem', 'Authitem','Import');
	foreach ($removemodels as $key => $val)
	{
		unset($files[$val]);
	}
	if($_REQUEST['id']==1){
	$listData = array("MonthlyEmployeeContest"=>"Monthly Employee Contest");
	}else if($_REQUEST['id']==2){
	$listData = array("MonthlyDealerContest"=>"Monthly Dealer Contest");
	}else if($_REQUEST['id']==3){
	$listData = array("QuarterlyEmployeeContest"=>"Quarterly Employee Contest");
	}
	else if($_REQUEST['id']==4){
	$listData = array("QuarterlyDealerContest"=>"Quarterly Dealer Contest");
	}
	else{
	$listData = $files;
	}
	echo $form->field($model, 'model')->dropDownList(
	$listData, 
	['prompt'=>'Select...','onChange' => 'get_template(this.value);']);
	?>
	
	<div class="form-group" id="template" style="display:none;">
	<label class="control-label" for="import-model" id="selcted_model"></label>
	<div id="download-div"><a href="#"></a></div>
	<div class="help-block"></div>
	</div>
	
   <? echo $form->field($model, 'file_source')->widget(FileInput::classname(), [
    'options'=>['accept'=>'csv', 'multiple'=>false,'onchange'=>'get_hide()'],
    'pluginOptions'=>['allowedFileExtensions'=>['csv'], 'showUpload' => false,
	 'initialPreview'=>false]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Upload' , ['class' => 'btn btn-primary']) ?>
    </div>
	
	</div>
	</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>

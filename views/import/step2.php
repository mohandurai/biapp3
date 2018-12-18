<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Modules;
use yii\helpers\Url;

?>
<script type="text/javascript">
function automap() {
    $('td.header').each( function() {
        var num = $(this).attr('num');
        //$('#select_' + num).val( $(this).html().toLowerCase() );
		var csv_column = $(this).html();
			$('#select_' + num +' option').each(function() {				
				if($(this).text().trim() == csv_column.trim()) {
				$(this).attr('selected', 'selected');            
				}                     
			}); 
    } );
}
var disabled = [];
var disableOptions = function (obj,value) {
  //console.log(disabled);
    $('option').prop('disabled', false);
	var cnt = 0;
    $.each(disabled, function(key, val){
        //$('option[value="' + val + '"]').prop('disabled', true);
		if(val==value)
		{
			cnt = cnt+1;
		}		
    });
	if(cnt > 1)
	{
		alert("Alredy Model Column Selected...");
		$(obj).val('');
	}
};

function get_count(obj,val)
{
    disabled = [];
    $('select').each(function(){
        if($(this).val() != ''){
            $('option').prop('disabled', false);
            disabled.push( $(this).val() );
        }
    });
    disableOptions(obj,val);
}
$(window).load(function() {
  $(".field-import-mapping").height(1);
});
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
	<?= $form->field($model, 'mapping')->hiddenInput(['maxlength' => 45, 'value' => 'CSV'])->label('',['style'=>'height:1px;']); ?>
	<p class="headblockdetails">Import CSV :</p>
	<div class="fieldsblock">	            
	<div class="row col-lg-12">
	<div class="col-lg-12"> 
	<div style="text-align: center; padding-bottom:10px !important;"><small>
	[Step 2 out of 3] - Define fields mapping
	</small></div>
	<?php $unique_required = $_SESSION['data']['model_required'];
		if(count($unique_required)!=0): ?>
		<div class="alert alert-info" role="alert" style="color:#000000;">
			<? echo 'kindly map the following required fields <br> ( '.implode(",",$unique_required).' )';?>
		</div>
	<?php endif; ?>
	<hr/>
	<table border="1" align="center" class="table table-striped table-bordered">
	<thead>
	<tr>
	  <th width="40%">Model column <br/>
	  <input type="button" value="Auto-map" class="auto-map" onclick="automap()"/></th>
	  <th width="30%">CSV header</th>
	  <th width="30%">CSV example</th>
	</tr>
	</thead>
	<?php 
	$arr_fields = $_SESSION['data']['model_columns'];
	$arr_headers = $_SESSION['data']['csv_headers'];
	$arr_examples = $_SESSION['data']['csv_example'];
	$fields_select = '<select name="mapping[%s]" id="select_%d" onchange="get_count(this,this.value);"><option value="">- select -</option>';
	foreach( $arr_fields as $key => $field)
	{
			$fields_select .= '<option value="'.htmlspecialchars($key).'">'.htmlspecialchars($field).'</option>';
	}
	$fields_select .= '</select>';
	//exit;
	$k=0; foreach($arr_headers as $i=>$header) :?>
	<tr>
	  <td align="center"><?php echo sprintf( $fields_select, htmlspecialchars( $header['name'] ), $k )?></td>
	  <td align="center" class="header" num="<?=$k++?>"><?php echo htmlspecialchars( trim( $header['name'] ))?></td>
	  <td align="center"><i><?php echo htmlspecialchars( $arr_examples[$i]['name'] )?></i></td>
	</tr>
	<?php endforeach; ?>
	</table>
	<br/>
	
	<?php
	$arr_mapped = $_SESSION['data']['mapped_columns'];
	foreach( $arr_headers as $mappedkey => $mappedvalue)
	{		
		if(!empty($arr_mapped[$mappedvalue['name']]))
		{?>
			<script>
			var select_id = '<?=select_."$mappedkey"?>';
			var select_value = '<?=$arr_mapped[$mappedvalue['name']]?>';
			$("#"+select_id).val(select_value);
			</script>
		<?php }
	}
	?>

    <div class="form-group" align="center">
        <?= Html::submitButton('Import' , ['class' => 'btn btn-primary']) ?>
    </div>
	
	</div>
	</div>
	</div>

    <?php ActiveForm::end(); ?>

</div>

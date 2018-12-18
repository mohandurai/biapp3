<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;    
use  app\models\FunctionMaster;
use  app\models\ChannelMaster;
use  app\models\ChannelFunctionType;

/* @var $this yii\web\View */
/* @var $model app\models\ChannelMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="channel-master-form">

    <?php $form = ActiveForm::begin(); ?>
    <p class="headblockdetails">Channel Masters :</p>
						 <div class="fieldsblock">	            
	                
	                <div class="row col-lg-12">
							<div class="col-lg-12"> 

    
	<?= $form->field($model, 'channel_parent')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ChannelMaster::find()->all(),'channel_id','channel_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Chennel Parent ...'],
    'pluginOptions' => [ 'allowClear' => true  ], 
          ]);
?>
</div>
</div>

  <div class="row col-lg-12">
							<div class="col-lg-12"> 

    <?= $form->field($model, 'channel_name')->textInput(['maxlength' => 45]) ?>
</div>
</div>
    
	  <div class="row col-lg-12">
							<div class="col-lg-12"> 
	<?= $form->field($model, 'channel_function_type_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ChannelFunctionType::find()->all(),'channel_function_id','channel_function_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Channel Function Type ...'],
    'pluginOptions' => [ 'allowClear' => true  ], 
          ]);
?> 
</div>
</div>
	
	
  <div class="row col-lg-12">
							<div class="col-lg-12"> 
    <?= $form->field($model, 'description')->textInput(['maxlength' => 45]) ?>
	
</div>
</div>
</div>
	

	
	
	
	<?
/* 
   

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'modified_date')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'modified_by')->textInput(['maxlength' => 11]) ?>

     */
   ?>
    <div class="form-group topspace">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
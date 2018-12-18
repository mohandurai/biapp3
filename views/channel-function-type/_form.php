<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChannelFunctionType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="channel-function-type-form">

    <?php $form = ActiveForm::begin(); ?>
    <p class="headblockdetails">Channel Function Type :</p>
						 <div class="fieldsblock">	            
	                
	                <div class="row col-lg-12">
							<div class="col-lg-12"> 

    <?= $form->field($model, 'channel_function_name')->textInput(['maxlength' => 45]) ?>
    </div>
    </div>

 <div class="row col-lg-12">
							<div class="col-lg-12"> 
    <?= $form->field($model, 'channel_function_description')->textInput(['maxlength' => 45]) ?>
    </div>
    </div>

	
	
	<?
	/* 
    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'modified_by')->textInput() ?>

    <?= $form->field($model, 'modified_date')->textInput() ?>

    <?= $form->field($model, 'bunit_id')->textInput() ?>
	 */
	?>

</div>
    <div class="form-group topspace">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
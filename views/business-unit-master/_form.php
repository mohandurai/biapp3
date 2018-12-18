<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use  app\models\BusinessUnitMaster;
use  app\models\CompanyMaster;
/* @var $this yii\web\View */
/* @var $model app\models\BusinessUnitMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-unit-master-form">

    <?php $form = ActiveForm::begin(); ?>


<p class="headblockdetails">Dealer Principle Master :</p>
						 <div class="fieldsblock">



 <div class="row col-lg-12">
							<div class="col-lg-12">	
	
	<?= $form->field($model, 'business_unit_parent')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(BusinessUnitMaster::find()->all(),'bunit_id','business_unit_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a DP Parent ...'],
    'pluginOptions' => [ 'allowClear' => true  ], 
          ]);
?>

</div>
</div>

	            
	                
	                <div class="row col-lg-12">
							<div class="col-lg-12">

   




    <?= $form->field($model, 'business_unit_name')->textInput(['maxlength' => 45]) ?>
</div>
</div>




 <div class="row col-lg-12">
							<div class="col-lg-12">
	<?= $form->field($model, 'company_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(CompanyMaster::find()->all(),'company_id','company_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Company ...'],
    'pluginOptions' => [ 'allowClear' => true  ], 
          ]);
?>

</div>
</div>
</div>	
	<?php
/* 

 <?= $form->field($model, 'business_unit_code')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'modified_date')->textInput() ?>

    <?= $form->field($model, 'modified_by')->textInput(['maxlength' => 45]) ?>
	 */
	?>
	

    <div class="form-group topspace">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

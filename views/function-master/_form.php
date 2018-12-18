<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use  app\models\CompanyMaster;
use  app\models\BusinessUnitMaster;
use  app\models\FunctionMaster;
/* @var $this yii\web\View */
/* @var $model app\models\FunctionMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="function-master-form">

    <?php $form = ActiveForm::begin(); ?>
    






    <? //= $form->field($model, 'function_code')->textInput(['maxlength' => 45]) ?>
    <p class="headblockdetails">Function Master :</p>
						 <div class="fieldsblock">



<div class="row col-lg-12">
							<div class="col-lg-12">
<?= $form->field($model, 'function_parent')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(FunctionMaster::find()->all(),'function_id','function_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Function  Parent ...'],
    'pluginOptions' => [ 'allowClear' => true  ], 
          ]);
?>
</div>
</div>


	            
	                
	                <div class="row col-lg-12">

<div class="col-lg-12"> 

    <?= $form->field($model, 'function_name')->textInput(['maxlength' => 45]) ?>
    
    </div>
    </div>
    
    <div class="row col-lg-12">
							<div class="col-lg-12">
<?= $form->field($model, 'company_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(CompanyMaster::find()->all(),'company_id','company_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Company  ...'],
    'pluginOptions' => [ 'allowClear' => true  ], 
          ]);
?>
</div>
</div>
    <? //= $form->field($model, 'company_id')->textInput(['maxlength' => 11]) ?>
    <div class="row col-lg-12">
							<div class="col-lg-12">
<?= $form->field($model, 'bunit_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(BusinessUnitMaster::find()->all(),'bunit_id','business_unit_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Business Unit Master  ...'],
    'pluginOptions' => [ 'allowClear' => true  ], 
          ]);
?>
</div>
</div>


    <? //= $form->field($model, 'bunit_id')->textInput() ?>

<div class="row col-lg-12">
							<div class="col-lg-12">
    <?= $form->field($model, 'desc')->textInput(['maxlength' => 45]) ?>
    </div>
    </div>
    </div>

    <? //= $form->field($model, 'created_date')->textInput() ?>

    <? //= $form->field($model, 'modified_date')->textInput() ?>

    <? //= $form->field($model, 'created_by')->textInput() ?>

    <? //= $form->field($model, 'modified_by')->textInput() ?>

    <div class="form-group topspace">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

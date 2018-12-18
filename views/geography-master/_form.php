<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\CountryMaster;
use app\models\StateMaster;
use app\models\CityMaster;
use app\models\ZoneMaster;
/* @var $this yii\web\View */
/* @var $model app\models\GeographyMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geography-master-form">

    <?php $form = ActiveForm::begin(); ?>

<p class="headblockdetails">Geography Master:</p>
						 

<p></p>
	 <div class="fieldsblock">	
	                 <div class="row col-lg-12">
							<div class="col-lg-6"> 
<?= $form->field($model, 'country')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(CountryMaster::find()->all(),'id','country_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Country...'],
    'pluginOptions' => [ 'allowClear' => true  ], 
          ]);
?>
    
    </div>
    
							<div class="col-lg-6"> 
<?= $form->field($model, 'state')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(StateMaster::find()->all(),'s_id','state_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a State...'],
    'pluginOptions' => [ 'allowClear' => true  ], 
          ]);
?>
    </div>
    </div>

	                 <div class="row col-lg-12">
							<div class="col-lg-6"> 
<?= $form->field($model, 'city')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(CityMaster::find()->all(),'city_id','city_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a City...'],
    'pluginOptions' => [ 'allowClear' => true  ], 
          ]);
?>
    
    </div>
    

							<div class="col-lg-6"> 
    <?= $form->field($model, 'area')->textInput(['maxlength' => 45]) ?>
    </div>
        </div>
    
    	                 <div class="row col-lg-12">
							<div class="col-lg-6"> 

    <?= $form->field($model, 'territory')->textInput(['maxlength' => 45]) ?>
    </div>
    						<div class="col-lg-6"> 
	<?= $form->field($model, 'village')->textInput(['maxlength' => 11]) ?>
	</div>
<div class="col-lg-6"> 
   <?= $form->field($model, 'zone')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ZoneMaster::find()->all(),'id','zone_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Zone...'],
    'pluginOptions' => [ 'allowClear' => true  ], 
          ]);
?>
    </div>
	</div>

</div>	
	
<p></p>
	 <div class="fieldsblock">	
	                 <div class="row col-lg-12">
			<div class="col-lg-6"> 
    <?= $form->field($model, 'pincode')->textInput(['maxlength' => 45]) ?>
    </div>
<div class="col-lg-6"> 
    <?= $form->field($model, 'continental')->textInput(['maxlength' => 45]) ?>
    </div>
    </div>
</div>
    

    <div class="form-group topspace">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

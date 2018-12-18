<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\StateMaster;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\CityMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-master-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'city_name')->textInput(['maxlength' => 45]) ?>

     <?= $form->field($model, 's_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(StateMaster::find()->all(),'s_id','state_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a State...'],
    'pluginOptions' => [ 'allowClear' => true  ], 
          ]);
?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

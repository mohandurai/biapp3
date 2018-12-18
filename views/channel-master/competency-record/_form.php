<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use dosamigos\datepicker\DatePicker;
use kartik\widgets\SwitchInput;
use app\models\Competency;

/* @var $this yii\web\View */
/* @var $model app\models\CompetencyRecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="competency-question-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'competency')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Competency::find()->all(),'comid','competency'),
    'language' => 'en',
    'options' => ['attribute'=>'Module','placeholder' => 'Select a competency ...',
   // 'onchange' => ''
    ],

    'pluginOptions' => [
        'allowClear' => true
    ],  
   //'pluginEvents' => [
   // "change" => "function() {module1(this.value); document.getElementById('modname').value=$('#country-country').select2('data').text; }"]
       
]);
?>
<?= $form->field($model, 'question')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
